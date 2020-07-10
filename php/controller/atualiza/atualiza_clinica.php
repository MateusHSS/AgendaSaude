<?php
    include_once "../config/conexao.php";

    $sqlVerificaDados = $connect->prepare("SELECT CNPJ FROM clinica WHERE id_clinica = ?");
    $sqlVerificaDados->bind_param("i", $_POST['id']);
    $sqlVerificaDados->execute();

    $resultDados = $sqlVerificaDados->get_result();

    $resDados = $resultDados->fetch_assoc();

    if($resDados['CNPJ'] == $_POST['cnpj_clinica']){

        $sqlAtualizaClinica = $connect->prepare("UPDATE clinica SET razao_social = ?, nome_fantasia = ? WHERE id_clinica = ?");
        $sqlAtualizaClinica->bind_param("ssi", $_POST['razao_social'], $_POST['nome_fantasia'], $_POST['id']);
        
    }else{

        $sqlAtualizaClinica = $connect->prepare("UPDATE clinica SET razao_social = ?, nome_fantasia = ?, CNPJ = ? WHERE id_clinica = ?");
        $sqlAtualizaClinica->bind_param("sssi", $_POST['razao_social'], $_POST['nome_fantasia'], $_POST['cnpj_clinica'], $_POST['id']);

    }

    

    if($sqlAtualizaClinica->execute()){
        $sqlAtualizaCtt = $connect->prepare("UPDATE contato SET telefone = ? WHERE tipo_contato = 1 AND id_especifico = ?");
        $sqlAtualizaCtt->bind_param("si", $_POST['telefone_clinica'], $_POST['id']);

        $sqlAtualizaEndereco = $connect->prepare("UPDATE endereco SET cep = ?, rua = ?, numero = ?, bairro = ?, cidade = ? WHERE tipo_endereco = 1 AND id_especifico = ?");
        $sqlAtualizaEndereco->bind_param("ssissi", $_POST['cep_clinica'], $_POST['rua_clinica'], $_POST['num_clinica'], $_POST['bairro_clinica'], $_POST['cidade_clinica'], $_POST['id']);
        
        if($sqlAtualizaCtt->execute() && $sqlAtualizaEndereco->execute()){
            echo json_encode(array("cod" => "1", "msg" => "Cadastro atualizado com sucesso!", "class" => "green"));
        }else{
            echo json_encode(array("cod" => "0", "msg" => "Erro ao atualizar cadastro!", "erro" => $connect->error, "class" => "red"));
        }
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Não foi possivel verificar o CNPJ", "erro" => $_POST['cnpj_clinica'], "class" => "red"));
    }

    //echo json_encode(array("cod" => "1", "msg" => "CNPJ ja cadastrado!", "erro" => $connect->error, "class" => "red"));
    
    


    $connect->close();


?>