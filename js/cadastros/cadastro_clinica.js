$(document).ready(function() {

    //CONFIRMA SE O USUARIO DESEJA SAIR DA PAGINA AO CLICAR NO X
    $("#fechar").click(function(){
        if(confirm("Ao voltar ao menu principal, voce perdera os dados da pagina atual. Confirma?")){
            window.location.replace('../../php/home.php');
        }
    });
    
    //MASCARAS DE CAMPO
    $("#cnpj_clinica").mask("99.999.999/9999-99");
    $("#cep_clinica").mask("99999-999");
    $("#telefone_clinica").mask("(99)9999-9999");

    $("select").formSelect();

    //VALIDA FORMULARIO
    $("#cadastro_clinica").validate({
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
                CNPJ: true,
                remote: {
                    url: "../../php/controller/verifica/existe_cnpj_clinica.php",
                    type: "post",
                    data: {
                        cnpj : function(){
                            return $("#cnpj_clinica").val();
                        }
                    }
                }
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
                required: "Informe o CNPJ da clinica",
                remote: "CNPJ ja cadastrado"
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


    $("#cadastro_clinica").submit(function(e){
        if($("#cadastro_clinica").validate().errorList.length == 0){
            $.post( "../../php/controller/cadastra/cadastra_clinica.php", $( "#cadastro_clinica" ).serialize())
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

