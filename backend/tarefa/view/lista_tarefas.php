<?php
/**
 * Created by PhpStorm.
 * User: prust
 * Date: 15/01/2019
 * Time: 09:40
 */
require_once '../Conexao.php';
require_once '../TarefaModel.php';
require_once '../TarefaController.php';

$tarefa = new \Tarefa\TarefaModel();
$aTarefas = $tarefa->getAll();

?>
<?php foreach($aTarefas as $tarefa):?>

<tr>
    <td><?=$tarefa->titulo?></td>
    <td class="w-25 text-center">
        <button class="btn btn-sm btn-info" data-id="<?=$tarefa->id?>" onclick="Tarefa.abreModalEditaTarefa(this)"><span class="fa fa-pencil"></span> Editar</button>
        <button class="btn btn-sm btn-danger ml-2" data-id="<?=$tarefa->id?>" onclick="Tarefa.deleteTarefa(this)"><span class="fa fa-remove"></span> Excluir</button>
    </td>
</tr>

<?php endforeach;?>

