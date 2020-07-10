<?php
    include_once "../config/conexao.php";

    $sqlVerificaDados = $connect->prepare("SELECT CRM FROM medico WHERE id_medico = ?");
    $sqlVerificaDados->bind_param("i", $_POST['id']);
    $sqlVerificaDados->execute();

    $resultDados = $sqlVerificaDados->get_result();

    $resDados = $resultDados->fetch_assoc();

    if($resDados['CRM'] == $_POST['crm']){

        $sqlAtualizaMedico = $connect->prepare("UPDATE medico SET nome = ? WHERE id_medico = ?");
        $sqlAtualizaMedico->bind_param("si", $_POST['nome'], $_POST['id']);
        
    }else{

        $sqlAtualizaMedico = $connect->prepare("UPDATE medico SET nome = ?, CRM = ? WHERE id_medico = ?");
        $sqlAtualizaMedico->bind_param("ssi", $_POST['nome'], $_POST['crm'], $_POST['id']);

    }

    

    if($sqlAtualizaMedico->execute()){
        $sqlAtualizaCtt = $connect->prepare("UPDATE contato SET telefone = ? WHERE tipo_contato = 3 AND id_especifico = ?");
        $sqlAtualizaCtt->bind_param("si", $_POST['telefone'], $_POST['id']);
        
        if($sqlAtualizaCtt->execute()){
            echo json_encode(array("cod" => "1", "msg" => "Cadastro atualizado com sucesso!", "class" => "green"));
        }else{
            echo json_encode(array("cod" => "0", "msg" => "Erro ao atualizar cadastro!", "erro" => $connect->error, "class" => "red"));
        }
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Não foi possivel verificar o CRM", "erro" => $_POST['cnpj_Medico'], "class" => "red"));
    } 

    $connect->close();


?>