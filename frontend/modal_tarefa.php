<!-- Modal -->
<div class="modal fade" id="modalTarefa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nova tarefa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                    <input type="hidden" id="tarefaId" value="">
                    <div class="row">
                        <div class="col-12">
                            <label for="titulo">Título:</label>
                            <input type="text" id="titulo" name="titulo" class="form-control">
                        </div>
                        <div class="col-12">
                            <label for="descricao">Descrição:</label>
                            <textarea id="descricao" name="descricao" class="form-control"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success" onclick="Tarefa.salvaNovaTarefa()">Salvar</button>
                </div>
        </div>
    </div>
</div>