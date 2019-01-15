var host =  window.location.protocol + "//" +window.location.host;
var URL_REQUEST = host+'/tasklist2/backend/tarefa';

Tarefa = {
    init: function(){
        this.listaTarefas();
    }
    , abreModalNovaTarefa: function(){
        var modal = $('#modalTarefa');

        modal.find('#tarefaId').val('');
        modal.find('#titulo').val('');
        modal.find('#descricao').val('');
        modal.modal('show');
    }
    , salvaNovaTarefa: function(){
        var modal = $('#modalTarefa');
        var data = {};

        if(! modal.find('#titulo').val()){
            swal('Atenção','Informe o título da tarefa','error');
            return false;
        }

        if(! modal.find('#descricao').val()){
            swal('Atenção!','Informe a descrição da tarefa','error');
            return false;
        }

        data['id']        = modal.find('#tarefaId').val();
        data['titulo']    = modal.find('#titulo').val();
        data['descricao'] = modal.find('#descricao').val();
        data['acao']      = 'save';

        $.ajax({
            url: URL_REQUEST+'/request_tarefa.php',
            method: 'POST',
            data: data,
            success: function(response){
                response = JSON.parse(response);
                if(response.success){
                    Tarefa.listaTarefas();
                    modal.modal('hide');
                    swal('','Tarefa salva com sucesso!','success');
                } else {
                    swal('Atenção!',response.message,'error');
                }

            },
            error: function(response){
            }
        })
    }
    , deleteTarefa: function(elem){
        if(confirm('Tem certeza de que deseja excluir esta tarefa?')){
            var tarefaId = $(elem).data('id');
            var data = {};

            data['id']   = tarefaId;
            data['acao'] = 'delete';

            $.ajax({
                url: URL_REQUEST+'/request_tarefa.php',
                method: 'POST',
                data: data,
                success: function(response){
                    response = JSON.parse(response);
                    if(response.success){
                        Tarefa.listaTarefas();
                        swal('','Tarefa excluída com sucesso!','success');
                    } else {
                        swal('Atenção!',response.message,'error');
                    }

                },
                error: function(response){
                    console.log(response);
                }
            })
        }

    }
    , listaTarefas: function(){

        $.post(URL_REQUEST+'/view/lista_tarefas.php',function(data){
            $('#lista-tarefas tbody').html(data);
        })

    }
    , abreModalEditaTarefa: function(elem){
        var modal = $('#modalTarefa');
        var tarefaId = $(elem).data('id');
        var data = {};

        data['id']   = tarefaId;
        data['acao'] = 'get';

        modal.find('#titulo').val('');
        modal.find('#descricao').val('');
        modal.modal('show');

        $.ajax({
            url: URL_REQUEST+'/request_tarefa.php',
            method: 'POST',
            data: data,
            success: function(response){
                response = JSON.parse(response);
                if(response.success){
                    var data = response.data;

                    modal.find('#tarefaId').val(data.id);
                    modal.find('#titulo').val(data.titulo);
                    modal.find('#descricao').val(data.titulo);
                } else {
                    swal('Atenção!',response.message,'error');
                }

            },
            error: function(response){
                console.log(response);
            }
        })
    }


}

$(document).ready(function(){
   Tarefa.init();
});