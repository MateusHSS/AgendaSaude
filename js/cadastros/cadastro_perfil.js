$(document).ready(function() {

    $("#fechar").click(function(){
        if(confirm("Ao voltar ao menu principal, voce perdera os dados da pagina atual. Confirma?")){
            window.location.replace('../../php/home.php');
        }
    });

    $("select").formSelect();

    $("#cadastro_perfil").validate({
        rules: {
            descricao: {
                required: true
            }
        },
        //For custom messages
        messages: {
            descricao: "Campo obrigatório"
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

    $("#cadastro_perfil").submit(function(e){
        if($("#cadastro_perfil").validate().errorList.length == 0){
            $.post( "../../php/controller/cadastra/cadastra_perfil.php", $( "#cadastro_perfil" ).serialize())
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