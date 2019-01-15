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

$tarefaModel = new \Tarefa\TarefaModel();
$tarefaController = new \Tarefa\TarefaController();
$aTarefas = $tarefaModel->getAll();

?>

<?php if (sizeof($aTarefas)):?>
    <?php foreach($aTarefas as $tarefa):?>

    <tr class="<?= ($tarefa->status == '2' ? 'linha-concluido' : 'linha-pendente')?>">
        <td><?=$tarefa->titulo?></td>
        <td><?=$tarefaController->getDescricaoStatus($tarefa->status)?></td>
        <td class="w-25 text-center">
            <button class="btn btn-sm btn-info" data-id="<?=$tarefa->id?>" onclick="Tarefa.abreModalEditaTarefa(this)"><span class="fa fa-pencil"></span> Editar</button>
            <button class="btn btn-sm btn-danger ml-2" data-id="<?=$tarefa->id?>" onclick="Tarefa.deleteTarefa(this)"><span class="fa fa-remove"></span> Excluir</button>

            <?php if($tarefa->status == '2'):?>
                <button class="btn btn-sm btn-success ml-2" data-toggle="tooltip" title="concluída" data-id="<?=$tarefa->id?>" onclick="Tarefa.finalizaTarefa(this,false)"><span class="fa fa-check"></span></button>
            <?php else: ?>
                <button class="btn btn-sm btn-primary ml-2" data-toggle="tooltip" title="pendente" data-id="<?=$tarefa->id?>" onclick="Tarefa.finalizaTarefa(this,true)"><span class="fa fa-exclamation"></span></button>
            <?php endif;?>
        </td>
    </tr>

    <?php endforeach;?>
<?php else: ?>
    <tr>
        <td colspan="2"  class="alert alert-info text-center">
            Nenhuma tarefa cadastrada.
        </td>
    </tr>
<?php endif;?>
