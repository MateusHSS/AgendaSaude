$(document).ready(function() {

    $("#view").mousedown(function(){
        $("#senha").attr("type", "text");
    });

    $("#view").mouseup(function(){
        $("#senha").attr("type", "password");
    });

    $("#view").mouseout(function(){
        $("#senha").attr("type", "password");
    });

    $("#fechar").click(function(){
        if(confirm("Ao voltar ao menu principal, voce perdera os dados da pagina atual. Confirma?")){
            window.location.replace('../../php/home.php');
        }
    });

    $("select").formSelect();

    $("#cadastro_usuario").validate({
        rules: {
            user: {
                required: true
            },
            senha: {
                required: true
            },
            confirma_senha: {
                required: true,
                equalTo: '#senha'
            }
        },
        //For custom messages
        messages: {
            user: "Campo obrigatório",
            senha: "Campo obrigatório",
            confirma_senha :{
                required: "Campo obrigatório",
                equalTo: "As senhas nao coincidem"
            }
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            error.css({'color' : 'red', 'float' : 'left', 'font-size' : '80%'});
            var placement = $(element).data('error');
            if (placement) {
                $(placement).append(error);
            } else {
                error.insertAfter(element);
            }
        }
    });

    $("#cadastro_usuario").submit(function(e){
        if($("#cadastro_usuario").validate().errorList.length == 0){
            $.post( "../../php/controller/cadastra/cadastra_usuario.php", $( "#cadastro_usuario" ).serialize())
                .done(function(data) {
                    data = $.parseJSON(data);
                    M.toast({
                        html: data.msg,
                        classes: data.class
                    });
                    if(data.cod == '1'){
                        $("input").each(function(){
                            $(this).val('');
                        });
                    }else{                      
                        console.log(data.erro);
                    }
            }, "json");

            e.preventDefault();
        }else{
            e.preventDefault();
        }
    });
});