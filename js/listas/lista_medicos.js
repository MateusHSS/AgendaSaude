$(document).ready(function(){

    $("#telefone").mask("(99)9999-9999");

    $(".button_edita").click(function(){
        var id = $(this).attr("data-id");

        $.post( "../../php/controller/seleciona/dados_medico.php", {'id':id})
            .done(function(data) {
                data = $.parseJSON(data);
                $("#atualiza_dados_medico").attr("data-id", data.dados.id_medico);
                $("#nome_titulo").text(data.dados.nome);
                $("#nome").select();
                $("#nome").val(data.dados.nome);
                $("#telefone").select();
                $("#telefone").val(data.dados.telefone);
                $("#crm").select();
                $("#crm").val(data.dados.CRM);
                $("#crm").blur();
        }, "json");
    });

    $("#atualiza_dados_medico").validate({
        rules: {
            nome: {
                required: true
            },
            telefone: {
                required: true
            },
            crm: {
                required: true
            }
        },
        //For custom messages
        messages: {
            nome: "Campo obrigatório",
            telefone: "Campo obrigatório",
            crm: {
                required: "Campo obrigatório"
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

    $("#atualiza_dados_medico").submit(function(e){
        if($("#atualiza_dados_medico").validate().errorList.length == 0){
            $.post( "../../php/controller/atualiza/atualiza_medico.php", $("#atualiza_dados_medico").serialize() + "&id=" + $("#atualiza_dados_medico").attr("data-id"))
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

        $.post( "../../php/controller/seleciona/dados_medico.php", {'id':id})
            .done(function(data) {
                data = $.parseJSON(data);
                $("#confirma_exclui_button").attr("data-id", data.dados.id_medico);
                $("#nome_exclui").text(data.dados.nome);
        }, "json");
    });

    $("#confirma_exclui_button").click(function(e){
        
        $.post( "../../php/controller/exclui/exclui_medico.php", {'id' : $(this).attr("data-id")})
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
})