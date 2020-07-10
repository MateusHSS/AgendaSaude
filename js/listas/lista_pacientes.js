$(document).ready(function(){
    $("#telefone").mask("(99)9999-9999");

    $("#cpf").mask("999.999.999-99");

    $("#atualiza_dados_paciente").validate({
        rules: {
            nome: {
                required: true
            },
            telefone: {
                required: true
            },
            cpf: {
                required: true,
                CPF: true
            },
            rua: {
                required: true
            },
            bairro: {
                required: true
            },
            cidade: {
                required: true
            }
        },
        //For custom messages
        messages: {
            nome: "Campo obrigatório",
            telefone: "Campo obrigatório",
            rua: "Campo obrigatório",
            bairro: "Campo obrigatório",
            cidade: "Campo obrigatório",
            cpf: {
                required: "Informe o CPF do paciente"
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

    jQuery.validator.addMethod('CPF', function(cpf, element) {
        cpf = cpf.replace(/[^\d]+/g, '');
        var numeros, digitos, soma, i, resultado, digitos_iguais;
        digitos_iguais = 1;
        if (cpf.length < 11)
            return false;
        for (i = 0; i < cpf.length - 1; i++)
            if (cpf.charAt(i) != cpf.charAt(i + 1)) {
                digitos_iguais = 0;
                break;
            }
        if (!digitos_iguais) {
            numeros = cpf.substring(0, 9);
            digitos = cpf.substring(9);
            soma = 0;
            for (i = 10; i > 1; i--)
                soma += numeros.charAt(10 - i) * i;
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0))
                return false;
            numeros = cpf.substring(0, 10);
            soma = 0;
            for (i = 11; i > 1; i--)
                soma += numeros.charAt(11 - i) * i;
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1))
                return false;
            return true;
        } else
            return false;
    }, 'CPF inválido');

    $(".button_edita").click(function(){
        var id = $(this).attr("data-id");

        $.post( "../../php/controller/seleciona/dados_paciente.php", {'id':id})
            .done(function(data) {
                data = $.parseJSON(data);
                $("#atualiza_dados_paciente").attr("data-id", data.dados.id_paciente);
                $("#nome_titulo").text(data.dados.nome_completo);
                $("#nome").select();
                $("#nome").val(data.dados.nome_completo);
                $("#telefone").select();
                $("#telefone").val(data.dados.telefone);
                $("#cpf").select();
                $("#cpf").val(data.dados.CPF);
                $("#cep").select();
                $("#cep").val(data.dados.cep);
                $("#rua").select();
                $("#rua").val(data.dados.rua);
                $("#num").select();
                $("#num").val(data.dados.numero);
                $("#bairro").select();
                $("#bairro").val(data.dados.bairro);
                $("#cidade").select();
                $("#cidade").val(data.dados.cidade);
                $("#cidade").blur();
        }, "json");
    });

    $("#atualiza_dados_paciente").submit(function(e){
        if($("#atualiza_dados_paciente").validate().errorList.length == 0){
            $.post( "../../php/controller/atualiza/atualiza_paciente.php", $("#atualiza_dados_paciente").serialize() + "&id=" + $("#atualiza_dados_paciente").attr("data-id"))
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

        $.post( "../../php/controller/seleciona/dados_paciente.php", {'id':id})
            .done(function(data) {
                data = $.parseJSON(data);
                $("#confirma_exclui_button").attr("data-id", data.dados.id_paciente);
                $("#nome_exclui").text(data.dados.nome_completo);
        }, "json");
    });

    $("#confirma_exclui_button").click(function(e){
        
        $.post( "../../php/controller/exclui/exclui_paciente.php", {'id' : $(this).attr("data-id")})
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