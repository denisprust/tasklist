<?php
/**
 * Created by PhpStorm.
 * User: prust
 * Date: 15/01/2019
 * Time: 09:05
 */

include 'header.php';

?>

    <div class="container pt-4">
        <div class="card">
            <div class="card-header">
                <span class="font-weight-bold">Tarefas:</span>
                <button class="btn btn-dark float-right btn-sm" onclick="Tarefa.abreModalNovaTarefa()"><span class="fa fa-plus"> Nova tarefa</span></button>
            </div>
            <div class="card-body">
                <table class="table table-condensed table-bordered" id="lista-tarefas">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Status</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Carregado por AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
include 'modal_tarefa.php';
include 'footer.php';