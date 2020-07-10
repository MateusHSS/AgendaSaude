$(document).ready(function(){

    //MASCARAS DE CAMPO
    $("#cnpj_clinica").mask("99.999.999/9999-99");
    $("#cep_clinica").mask("99999-999");
    $("#telefone_clinica").mask("(99)9999-9999");

    $("select").formSelect();

    //VALIDA FORMULARIO
    $("#atualiza_dados_clinica").validate({
        rules: {
            razao_social: {
                required: true
            },
            nome_fantasia: {
                required: true
            },
            telefone_clinica: {
                required: true
            },
            cnpj_clinica: {
                required: true,
                CNPJ: true
            },
            cep_clinica: {
                required: true
            }
        },
        //For custom messages
        messages: {
            razao_social: "Campo obrigatório",
            nome_fantasia: "Campo obrigatório",
            telefone_clinica: "Campo obrigatório",
            cep_clinica: "Campo obrigatório",
            rua_clinica: "Campo obrigatório",
            num_clinica: "Campo obrigatório",
            bairro_clinica: "Campo obrigatório",
            cidade_clinica: "Campo obrigatório",
            cnpj_clinica: {
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

        $.post( "../../php/controller/seleciona/dados_clinica.php", {'id':id})
            .done(function(data) {
                data = $.parseJSON(data);
                $("#atualiza_dados_clinica").attr("data-id", data.dados.id_clinica);
                $("#nome_titulo").text(data.dados.razao_social);
                $("#razao_social").select();
                $("#razao_social").val(data.dados.razao_social);
                $("#nome_fantasia").select();
                $("#nome_fantasia").val(data.dados.nome_fantasia);
                $("#telefone_clinica").select();
                $("#telefone_clinica").val(data.dados.telefone);
                $("#cnpj_clinica").select();
                $("#cnpj_clinica").val(data.dados.CNPJ);
                $("#cep_clinica").select();
                $("#cep_clinica").val(data.dados.cep);
                $("#rua_clinica").select();
                $("#rua_clinica").val(data.dados.rua);
                $("#num_clinica").select();
                $("#num_clinica").val(data.dados.numero);
                $("#bairro_clinica").select();
                $("#bairro_clinica").val(data.dados.bairro);
                $("#cidade_clinica").select();
                $("#cidade_clinica").val(data.dados.cidade);
                $("#cidade_clinica").blur();
                
        }, "json");
    });

    $(".button_exclui").click(function(){
        var id = $(this).attr("data-id");

        $.post( "../../php/controller/seleciona/dados_clinica.php", {'id':id})
            .done(function(data) {
                data = $.parseJSON(data);
                $("#confirma_exclui_button").attr("data-id", data.dados.id_clinica);
                $("#nome_exclui").text(data.dados.razao_social);
        }, "json");
    });

    $("#atualiza_dados_clinica").submit(function(e){
        if($("#atualiza_dados_clinica").validate().errorList.length == 0){
            $.post( "../../php/controller/atualiza/atualiza_clinica.php", $("#atualiza_dados_clinica").serialize() + "&id=" + $("#atualiza_dados_clinica").attr("data-id"))
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
        
        $.post( "../../php/controller/exclui/exclui_clinica.php", {'id' : $(this).attr("data-id")})
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