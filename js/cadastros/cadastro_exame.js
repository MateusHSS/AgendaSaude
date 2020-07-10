$(document).ready(function() {
    
    $("#fechar").click(function(){
        if(confirm("Ao voltar ao menu principal, voce perdera os dados da pagina atual. Confirma?")){
            window.location.replace('../../php/home.php');
        }
    });
    
    $("select").formSelect();

    $.validator.setDefaults({
        ignore: []
    });

    $("#cadastro_exame").validate({
        rules: {
            nome_exame: {
                required: true,
                remote: {
                    url: "../../php/controller/verifica/existe_exame.php",
                    type: "post",
                    data: {
                        nome : function(){
                            return $("#nome_exame").val();
                        },
                        tipo : function(){
                            return $("#tipo_exame").val();
                        }
                    }
                }
            },
            tipo_exame: {
                required: true
            }          
        },
        //For custom messages
        messages: {
            nome_exame: {
                required: "Campo obrigatório",
                remote: "Exame ja cadastrado"
            },
            tipo_exame: {
                required: "Selecione um tipo de exame"
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

    $("#cadastro_exame").submit(function(e){
        if($("#cadastro_exame").validate().errorList.length == 0){
            $.post( "../../php/controller/cadastra/cadastra_exame.php", $( "#cadastro_exame" ).serialize())
                .done(function(data) {
                    data = $.parseJSON(data);
                    M.toast({
                        html: data.msg,
                        classes: data.class,
                        completeCallback: function(){
                            location.reload();
                        }
                    });
                    if(data.cod == '1'){
                        $("input").each(function(){
                            $(this).val('');
                            $('#cadastro_exame')[0].reset();
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