<?php
    include_once "../config/conexao.php";

    $sqlVerificaDados = $connect->prepare("SELECT CPF FROM paciente WHERE id_paciente = ?");
    $sqlVerificaDados->bind_param("i", $_POST['id']);
    $sqlVerificaDados->execute();

    $resultDados = $sqlVerificaDados->get_result();

    $resDados = $resultDados->fetch_assoc();

    if($resDados['CPF'] == $_POST['cpf']){

        $sqlAtualizaPaciente = $connect->prepare("UPDATE paciente SET nome_completo = ? WHERE id_paciente = ?");
        $sqlAtualizaPaciente->bind_param("si", $_POST['nome'], $_POST['id']);
        
    }else{

        $sqlAtualizaPaciente = $connect->prepare("UPDATE paciente SET nome_completo = ?, CPF = ? WHERE id_paciente = ?");
        $sqlAtualizaPaciente->bind_param("ssi", $_POST['nome'], $_POST['cpf'], $_POST['id']);

    }

    

    if($sqlAtualizaPaciente->execute()){
        $sqlAtualizaCtt = $connect->prepare("UPDATE contato SET telefone = ? WHERE tipo_contato = 4 AND id_especifico = ?");
        $sqlAtualizaCtt->bind_param("si", $_POST['telefone'], $_POST['id']);

        $sqlAtualizaEndereco = $connect->prepare("UPDATE endereco SET cep = ?, rua = ?, numero = ?, bairro = ?, cidade = ? WHERE tipo_endereco = 2 AND id_especifico = ?");
        $sqlAtualizaEndereco->bind_param("ssissi", $_POST['cep'], $_POST['rua'], $_POST['num'], $_POST['bairro'], $_POST['cidade'], $_POST['id']);
        
        if($sqlAtualizaCtt->execute() && $sqlAtualizaEndereco->execute()){
            echo json_encode(array("cod" => "1", "msg" => "Cadastro atualizado com sucesso!", "class" => "green"));
        }else{
            echo json_encode(array("cod" => "0", "msg" => "Erro ao atualizar cadastro!", "erro" => $connect->error, "class" => "red"));
        }
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Não foi possivel verificar o CNPJ", "erro" => $_POST['cnpj_clinica'], "class" => "red"));
    }
    
    


    $connect->close();


?>