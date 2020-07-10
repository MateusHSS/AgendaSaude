$(document).ready(function(){

    $("#atualiza_dados_perfil").validate({
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

    $(".button_edita").click(function(){
        var id = $(this).attr("data-id");

        $.post( "../../php/controller/seleciona/dados_perfil.php", {'id':id})
            .done(function(data) {
                data = $.parseJSON(data);
                $("#atualiza_dados_perfil").attr("data-id", data.dados.id_perfil);
                $("#nome_titulo").text(data.dados.descricao);
                $("#descricao").select();
                $("#descricao").val(data.dados.descricao);
                $("#descricao").blur();
        }, "json");
    });

    $("#atualiza_dados_perfil").submit(function(e){
        if($("#atualiza_dados_perfil").validate().errorList.length == 0){
            $.post( "../../php/controller/atualiza/atualiza_perfil.php", $("#atualiza_dados_perfil").serialize() + "&id=" + $("#atualiza_dados_perfil").attr("data-id"))
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

        $.post( "../../php/controller/seleciona/dados_perfil.php", {'id':id})
            .done(function(data) {
                data = $.parseJSON(data);
                $("#confirma_exclui_button").attr("data-id", data.dados.id_perfil);
                $("#nome_exclui").text(data.dados.descricao);
        }, "json");
    });

    $("#confirma_exclui_button").click(function(e){
        
        $.post( "../../php/controller/exclui/exclui_perfil.php", {'id' : $(this).attr("data-id")})
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