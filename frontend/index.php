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
                <button class="btn btn-dark float-right" onclick="Tarefa.abreModalNovaTarefa()"><span class="fa fa-plus"> Nova tarefa</span></button>
            </div>

            <div class="card-body">
                <table class="table table-condensed table-hover table-bordered" id="lista-tarefas">
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>



<?php
include 'modal_tarefa.php';
include 'footer.php';