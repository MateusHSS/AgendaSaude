$(document).ready(function() {
    
    $("#fechar").click(function(){
        if(confirm("Ao voltar ao menu principal, voce perdera os dados da pagina atual. Confirma?")){
            window.location.replace('../../php/home.php');
        }
    });
    
    $("#telefone_medico").mask("(99)9999-9999");

    $("select").formSelect();

    $("#cadastro_medico").validate({
        rules: {
            nome_medico: {
                required: true
            },
            telefone_medico: {
                required: true
            },
            crm_medico: {
                required: true,
                remote: {
                    url: "../../php/controller/verifica/existe_crm.php",
                    type: "post",
                    data: {
                        crm : function(){
                            return $("#crm_medico").val();
                        }
                    }
                }
            }
        },
        //For custom messages
        messages: {
            nome_medico: "Campo obrigatório",
            telefone_medico: "Campo obrigatório",
            crm_medico: {
                required: "Campo obrigatório",
                remote: "CRM ja cadastrado"
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

    $("#cadastro_medico").submit(function(e){
        if($("#cadastro_medico").validate().errorList.length == 0){
            $.post( "../../php/controller/cadastra/cadastra_medico.php", $( "#cadastro_medico" ).serialize())
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