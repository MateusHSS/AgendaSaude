<?php
    include_once "../config/conexao.php";

    $sqlInsereEmpresa = $connect->prepare("INSERT INTO empresa (razao_social, nome_fantasia, CNPJ) VALUES (?, ?, ?)");
    $sqlInsereEmpresa->bind_param("sss", $_POST['razao_social'], $_POST['nome_fantasia'], $_POST['cnpj_empresa']);
    $sqlInsereEmpresa->execute();

    $idEmpresa = $connect->insert_id;

    if($sqlInsereEmpresa->affected_rows > 0){
        $sqlInsereCtt = $connect->prepare("INSERT INTO contato (telefone, tipo_contato, id_especifico) VALUES (?, 2, ?)");
        $sqlInsereCtt->bind_param("si", $_POST['telefone_empresa'], $idEmpresa);
        $sqlInsereCtt->execute();

        if($sqlInsereCtt->affected_rows > 0){
            echo json_encode(array("cod" => "1", "msg" => "Empresa cadastrada com sucesso!", "class" => "green"));
        }else{
            echo json_encode(array("cod" => "0", "msg" => "Erro ao cadastrar empresa!", "erro" => $connect->error, "class" => "red"));
        }
    }else{
        echo json_encode(array("cod" => "0", "msg" => "CNPJ ja cadastrado!", "erro" => $connect->error, "class" => "red"));
    }

    
?>