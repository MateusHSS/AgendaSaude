$(document).ready(function(){

    $("#view").mousedown(function(){
        $("#senha").attr("type", "text");
    });

    $("#view").mouseup(function(){
        $("#senha").attr("type", "password");
    });

    $("#view").mouseout(function(){
        $("#senha").attr("type", "password");
    });

    $("#atualiza_dados_usuario").validate({
        rules: {
            user: {
                required: true
            },
            confirma_senha: {
                equalTo: '#senha'
            }
        },
        //For custom messages
        messages: {
            user: "Campo obrigatório",
            confirma_senha :{
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

    $(".button_edita").click(function(){
        var id = $(this).attr("data-id");

        $.post( "../../php/controller/seleciona/dados_usuario.php", {'id':id})
            .done(function(data) {
                data = $.parseJSON(data);
                $("#atualiza_dados_usuario").attr("data-id", data.dados.id_usuario);
                $("#nome_titulo").text(data.dados.user);
                $("#user").select();
                $("#user").val(data.dados.user);
                $("#user").blur();
        }, "json");
    });

    $("#atualiza_dados_usuario").submit(function(e){
        if($("#atualiza_dados_usuario").validate().errorList.length == 0){
            $.post( "../../php/controller/atualiza/atualiza_usuario.php", $("#atualiza_dados_usuario").serialize() + "&id=" + $("#atualiza_dados_usuario").attr("data-id"))
                .done(function(data) {
                    data = $.parseJSON(data);
                    M.toast({
                        html: data.msg,
                        classes: data.class
                    });
                    if(data.cod == '1'){
                        $(".modal").modal('close');
                        location.reload();
                    }else{
                        console.log(data.erro);
                    }
            }, "json");

            e.preventDefault();
        }else{
            e.preventDefault();
        }
    });

    $(".button_exclui").click(function(){
        var id = $(this).attr("data-id");

        $.post( "../../php/controller/seleciona/dados_usuario.php", {'id':id})
            .done(function(data) {
                data = $.parseJSON(data);
                $("#confirma_exclui_button").attr("data-id", data.dados.id_usuario);
                $("#nome_exclui").text(data.dados.user);
        }, "json");
    });

    $("#confirma_exclui_button").click(function(e){
        
        $.post( "../../php/controller/exclui/exclui_usuario.php", {'id' : $(this).attr("data-id")})
            .done(function(data) {
                data = $.parseJSON(data);
                M.toast({
                    html: data.msg,
                    classes: data.class
                });
                if(data.cod == '1'){
                    $(".modal").modal('close');
                    location.reload();
                }else{
                    console.log(data.erro);
                }
        }, "json");

        e.preventDefault();
    });
});