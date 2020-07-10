<?php

    include_once "../config/conexao.php";

    $sqlInsereMedico = $connect->prepare("INSERT INTO medico (nome, CRM) VALUES (?, ?)");
    $sqlInsereMedico->bind_param("ss", $_POST['nome_medico'], $_POST['crm_medico']);
    $sqlInsereMedico->execute();

    $idMedico = $connect->insert_id;

    if($sqlInsereMedico->affected_rows > 0){
        $sqlInsereCtt = $connect->prepare("INSERT INTO contato (telefone, tipo_contato, id_especifico) VALUES (?, 3, ?)");
        $sqlInsereCtt->bind_param("si", $_POST['telefone_medico'], $idMedico);
        $sqlInsereCtt->execute();

        if($sqlInsereCtt->affected_rows > 0){
            echo json_encode(array("cod" => "1", "msg" => "Médico cadastrado com sucesso!", "class" => "green"));
        }else{
            echo json_encode(array("cod" => "0", "msg" => "Erro ao cadastrar médico!", "erro" => $connect->error, "class" => "red"));
        }
    }else{
        echo json_encode(array("cod" => "0", "msg" => "CRM já cadastrado!", "erro" => $connect->error, "class" => "red"));
    }

    

?>