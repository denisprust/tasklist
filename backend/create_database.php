<?php
/**
 * Created by PhpStorm.
 * User: prust
 * Date: 15/01/2019
 * Time: 11:02
 */

require_once 'tarefa/Conexao.php';
require_once 'tarefa/TarefaModel.php';
require_once 'tarefa/TarefaController.php';

try
{
    $con = new PDO('mysql:host=localhost;dbname=tasklist;charset=utf8', 'root', '');
    echo '<br> - Ok, conectado e Base já existe! ';
}
catch (PDOException $e)
{
    print_r($e);
    echo 'Erro = número(<b>'.$e->getCode().'</b>) , mensagem(<b>'.$e->getMessage().'</b>) ';
    if($e->getCode()=='1049'){
        echo '<br> - - Base(tasklist) não existe!';
        echo '<br> - - Conecta apenas no banco';
        try{
            $con = new PDO('mysql:host=localhost', 'root', '');
            echo '<br> - - - Ok Banco (localhost) conectado sem a Base! ';

            $numero_linhas_afetado = $con->exec("CREATE DATABASE tasklist"  );
            if($numero_linhas_afetado>0){
                $con = new PDO('mysql:host=localhost;dbname=tasklist;charset=utf8', 'root', '');
                echo '<br> - - - Ok Base (tasklist) criada com sucesso! ';

                $TarefaModel = new \Tarefa\TarefaModel();
                echo '<br> - - - Tarefa => '.$TarefaModel->criaTabela();

            }
            else{
                echo '<br> - - - Erro ao criar a Base (tasklist)!';
            }
        }
        catch (PDOException $e){

        }
    }
}