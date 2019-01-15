<?php
/**
 * Created by PhpStorm.
 * User: prust
 * Date: 14/01/2019
 * Time: 18:05
 */

require_once 'Conexao.php';
require_once 'TarefaModel.php';
require_once 'TarefaController.php';

use Tarefa\TarefaModel;
use Tarefa\TarefaController;

$post    = filter_input_array(INPUT_POST);
$get     = filter_input_array(INPUT_GET);
$request = ($post ? $post : []) + ($get ? $get : []);

$tarefa = new TarefaController();

$data = $tarefa->gerenciaRequest($request);

if($tarefa->Erro){
    echo json_encode([
            'message' => $tarefa->Erro,
            'success' => false
        ]);
} else {
    echo json_encode(['success' => true,'data' => $data]);
}
