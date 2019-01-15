<?php
/**
 * Created by PhpStorm.
 * User: prust
 * Date: 14/01/2019
 * Time: 18:42
 */

namespace Tarefa;

use Tarefa\TarefaModel;

class TarefaController extends TarefaModel {

    private $Model = null;

    public function gerenciaRequest($request){
        $tarefa = $this->getModel();

        http_response_code(200);

        switch($request['acao'] ){
            case 'get':
                return $tarefa->get($request['id']);
                break;
            case 'save':
                return $tarefa->save($request);
                break;
            case 'PUT':
                $tarefa->id = $request['id'];
                return $tarefa->save($request);
                break;
            case 'delete':
                return $tarefa->remove($request['id']);
                break;
        }

        return json_encode([]);
    }

    private function getModel(){
        if($this->Model){
            return $this->Model;
        } else {
            $this->Model = new TarefaModel();
            return $this->Model;
        }
    }

}