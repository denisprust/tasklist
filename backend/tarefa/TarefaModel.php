<?php

/**
 * Created by PhpStorm.
 * User: prust
 * Date: 14/01/2019
 * Time: 18:15
 */

namespace Tarefa;

use Tarefa\Conexao;

class TarefaModel extends Conexao{

    public $id    = '';
    public $descricao  = '';
    public $titulo = '';
    public $status = 1;
    public $data_alteracao = '';
    public $data_cadastro  = '';
    public $data_remocao   = '';
    public $Erro = '';

    public function __construct($id = '', $titulo = '', $descricao = '',$status = '')
    {
        parent::__construct();

        $this->id = $id;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->status = $status;
    }

    public function criaTabela(){
        $res = $this->pdo->exec(
"CREATE TABLE tarefa (
             id INT NOT NULL AUTO_INCREMENT ,
             titulo VARCHAR(255) NOT NULL ,
             descricao VARCHAR(255) NOT NULL ,
             status ENUM('1','2','3') NOT NULL ,
             data_cadastro DATETIME NOT NULL ,
             data_alteracao DATETIME ,
             data_remocao DATETIME ,
             data_conclusao DATETIME ,
            PRIMARY KEY (id),
            INDEX index_titulo_tarefa (titulo)
        )");

        return $res === false ? 'Erro: '.$this->pdo->errorInfo()[2] : 'Ok' ;
    }

    public function remove($id){

        $sql = " 
                UPDATE tarefa
                SET data_remocao = now()
                   ,status = '3'
                WHERE id = ".$id;

        try{
            $stt = $this->pdo->prepare($sql);
            $stt->execute();
            return $stt->rowCount();
        }
        catch(\PDOException  $e ){
            $this->Erro = $e->getCode(). ' - '. $e->getMessage();
            return false;
        }

    }

    public function get($id)
    {
        $str = " SELECT * FROM tarefa WHERE id = ".$id;

        try{

            $stt = $this->pdo->prepare($str);
            $stt->execute();
            for($i=0; $row = $stt->fetch(); $i++){ // padrao PDO::FETCH_ASSOC
                $this->id = $row['id'];
                $this->titulo = $row['titulo'];
                $this->descricao = $row['descricao'];
                $this->data_alteracao = $row['data_alteracao'];
                $this->data_cadastro = $row['data_cadastro'];
                $this->data_remocao = $row['data_remocao'];
                $this->status = $row['status'];
            }
            return $this;
        }
        catch(\PDOException  $e ){
            echo "Error: ".$e;
            return false;
        }
    }

    public function getAll( $where='' )
    {
        $arr_ret = [];
        $where   = $where=='' ? 'WHERE status != \'3\''  : "WHERE status != '3' ".$where;

        $sql = "
            SELECT *
            FROM tarefa
            ".$where." ";

        try{
            $stt = $this->pdo->prepare($sql);
            $stt->execute();
            while($row=$stt->fetch(\PDO::FETCH_OBJ)) {
                array_push($arr_ret, $row);
            }
        }
        catch(\PDOException  $e ) {
            echo "Error: " . $e;
        }

        return $arr_ret;
    }

    public function save($tarefa){
        if( !isset($tarefa['id']) || !$tarefa['id']){
            $tarefa['status'] = 1;
            // Novo
            $sql = " 
              INSERT INTO tarefa
              (titulo
              ,descricao
              ,status
              ,data_cadastro
              )
              VALUES ( '{$tarefa['titulo']}'
                     , '{$tarefa['descricao']}'
                     , '{$tarefa['status']}'
                     , now() 
                 )";

            try{
                $stt = $this->pdo->prepare($sql);
                $stt->execute();
                $this->id = $this->pdo->lastInsertId();
            }
            catch(\PDOException  $e ){
                $this->Erro = $e->getCode(). ' - '. $e->getMessage();
                return false;
            }

        }
        else{
            // Update
            $sql = " 
              UPDATE tarefa
                  SET titulo = '{$tarefa['titulo']}'
                    , descricao = '{$tarefa['descricao']}'
                    , data_alteracao = now() 
                WHERE id = {$tarefa['id']}";

            try{
                $stt = $this->pdo->prepare($sql);
                $stt->execute();
                return $stt->rowCount();
            }
            catch(\PDOException  $e ){
                $this->Erro = $e->getCode(). ' - '. $e->getMessage();
                return false;
            }
        }
    }

}

