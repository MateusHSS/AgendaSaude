$(document).ready(function() {
    
    $("#fechar").click(function(){
        if(confirm("Ao voltar ao menu principal, voce perdera os dados da pagina atual. Confirma?")){
            window.location.replace('../../php/home.php');
        }
    });
    
    $("#cpf_paciente").mask("999.999.999-99");

    $("#cep_paciente").mask("99999-999");

    $("#telefone_paciente").mask("(99)9999-9999");

    $("select").formSelect();

    $("#cadastro_paciente").validate({
        rules: {
            nome_paciente: {
                required: true
            },
            telefone_paciente: {
                required: true
            },
            cpf_paciente: {
                required: true,
                CPF: true,
                remote: {
                    url: "../../php/controller/verifica/existe_cpf_paciente.php",
                    type: "post",
                    data: {
                        cpf : function(){
                            return $("#cpf_paciente").val();
                        }
                    }
                }
            },
            rua_paciente: {
                required: true
            },
            bairro_paciente: {
                required: true
            },
            cidade_paciente: {
                required: true
            }
        },
        //For custom messages
        messages: {
            nome_paciente: "Campo obrigatório",
            telefone_paciente: "Campo obrigatório",
            rua_paciente: "Campo obrigatório",
            bairro_paciente: "Campo obrigatório",
            cidade_paciente: "Campo obrigatório",
            cpf_paciente: {
                required: "Informe o CPF do paciente",
                remote: "CPF já cadastrado"
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

    $("#cadastro_paciente").submit(function(e){
        if($("#cadastro_paciente").validate().errorList.length == 0){
            $.post( "../../php/controller/cadastra/cadastra_paciente.php", $( "#cadastro_paciente" ).serialize())
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

