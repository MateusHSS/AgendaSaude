$(document).ready(function(){

    //MASCARAS DE CAMPO
    $("#cnpj_empresa").mask("99.999.999/9999-99");

    $("#telefone_empresa").mask("(99)9999-9999");

    $("select").formSelect();

    //VALIDA FORMULARIO
    $("#atualiza_dados_empresa").validate({
        rules: {
            razao_social: {
                required: true
            },
            nome_fantasia: {
                required: true
            },
            telefone_empresa: {
                required: true
            },
            cnpj_empresa: {
                required: true,
                CNPJ: true
            }
        },
        //For custom messages
        messages: {
            razao_social: "Campo obrigatório",
            nome_fantasia: "Campo obrigatório",
            telefone_empresa: "Campo obrigatório",
            cnpj_empresa: {
                required: "Informe o CNPJ da clinica"
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

    $.validator.addMethod('CNPJ', function(cnpj, element) {
        cnpj = cnpj.replace(/[^\d]+/g, '');
    
        if (cnpj == '') return false;
    
        if (cnpj.length != 14)
            return false;
    
        // Elimina CNPJs invalidos conhecidos
        if (cnpj == "00000000000000" ||
            cnpj == "11111111111111" ||
            cnpj == "22222222222222" ||
            cnpj == "33333333333333" ||
            cnpj == "44444444444444" ||
            cnpj == "55555555555555" ||
            cnpj == "66666666666666" ||
            cnpj == "77777777777777" ||
            cnpj == "88888888888888" ||
            cnpj == "99999999999999")
            return false;
    
        // Valida DVs
        tamanho = cnpj.length - 2
        numeros = cnpj.substring(0, tamanho);
        digitos = cnpj.substring(tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
            return false;
    
        tamanho = tamanho + 1;
        numeros = cnpj.substring(0, tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
            return false;
    
        return true;
    }, 'CNPJ inválido');

    $(".button_edita").click(function(){
        var id = $(this).attr("data-id");

        $.post( "../../php/controller/seleciona/dados_empresa.php", {'id':id})
            .done(function(data) {
                data = $.parseJSON(data);
                $("#atualiza_dados_empresa").attr("data-id", data.dados.id_empresa);
                $("#nome_titulo").text(data.dados.razao_social);
                $("#razao_social").select();
                $("#razao_social").val(data.dados.razao_social);
                $("#nome_fantasia").select();
                $("#nome_fantasia").val(data.dados.nome_fantasia);
                $("#telefone_empresa").select();
                $("#telefone_empresa").val(data.dados.telefone);
                $("#cnpj_empresa").select();
                $("#cnpj_empresa").val(data.dados.CNPJ);
                $("#cnpj_empresa").blur();
                
        }, "json");
    });

    $(".button_exclui").click(function(){
        var id = $(this).attr("data-id");

        $.post( "../../php/controller/seleciona/dados_empresa.php", {'id':id})
            .done(function(data) {
                data = $.parseJSON(data);
                $("#confirma_exclui_button").attr("data-id", data.dados.id_empresa);
                $("#nome_exclui").text(data.dados.razao_social);
        }, "json");
    });

    $("#atualiza_dados_empresa").submit(function(e){
        if($("#atualiza_dados_empresa").validate().errorList.length == 0){
            $.post( "../../php/controller/atualiza/atualiza_empresa.php", $("#atualiza_dados_empresa").serialize() + "&id=" + $("#atualiza_dados_empresa").attr("data-id"))
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

    $("#confirma_exclui_button").click(function(e){
        
        $.post( "../../php/controller/exclui/exclui_empresa.php", {'id' : $(this).attr("data-id")})
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