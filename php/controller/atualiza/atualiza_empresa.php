<?php
    include_once "../config/conexao.php";

    $sqlVerificaDados = $connect->prepare("SELECT CNPJ FROM empresa WHERE id_empresa = ?");
    $sqlVerificaDados->bind_param("i", $_POST['id']);
    $sqlVerificaDados->execute();

    $resultDados = $sqlVerificaDados->get_result();

    $resDados = $resultDados->fetch_assoc();

    if($resDados['CNPJ'] == $_POST['cnpj_empresa']){

        $sqlAtualizaEmpresa = $connect->prepare("UPDATE empresa SET razao_social = ?, nome_fantasia = ? WHERE id_empresa = ?");
        $sqlAtualizaEmpresa->bind_param("ssi", $_POST['razao_social'], $_POST['nome_fantasia'], $_POST['id']);
        
    }else{

        $sqlAtualizaEmpresa = $connect->prepare("UPDATE empresa SET razao_social = ?, nome_fantasia = ?, CNPJ = ? WHERE id_empresa = ?");
        $sqlAtualizaEmpresa->bind_param("sssi", $_POST['razao_social'], $_POST['nome_fantasia'], $_POST['cnpj_empresa'], $_POST['id']);

    }

    

    if($sqlAtualizaEmpresa->execute()){
        $sqlAtualizaCtt = $connect->prepare("UPDATE contato SET telefone = ? WHERE tipo_contato = 2 AND id_especifico = ?");
        $sqlAtualizaCtt->bind_param("si", $_POST['telefone_empresa'], $_POST['id']);
        
        if($sqlAtualizaCtt->execute()){
            echo json_encode(array("cod" => "1", "msg" => "Cadastro atualizado com sucesso!", "class" => "green"));
        }else{
            echo json_encode(array("cod" => "0", "msg" => "Erro ao atualizar cadastro!", "erro" => $connect->error, "class" => "red"));
        }
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Não foi possivel verificar o CNPJ", "erro" => $_POST['cnpj_clinica'], "class" => "red"));
    }

    $connect->close();


?>