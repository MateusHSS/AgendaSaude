<?php
    include_once "../config/conexao.php";


    $sqlInsereClinica = $connect->prepare("INSERT INTO clinica (razao_social, nome_fantasia, CNPJ) VALUES (?, ?, ?)");
    $sqlInsereClinica->bind_param("sss", $_POST['razao_social'], $_POST['nome_fantasia'], $_POST['cnpj_clinica']);
    $sqlInsereClinica->execute();

    $idClinica = $connect->insert_id;

    if($sqlInsereClinica->affected_rows > 0){
        $sqlInsereCtt = $connect->prepare("INSERT INTO contato (telefone, tipo_contato, id_especifico) VALUES (?, 1, ?)");
        $sqlInsereCtt->bind_param("si", $_POST['telefone_clinica'], $idClinica);
        $sqlInsereCtt->execute();

        $sqlInsereEndereco = $connect->prepare("INSERT INTO endereco (cep, rua, numero, bairro, cidade, tipo_endereco, id_especifico) VALUES (?, ?, ?, ?, ?, 1, ?)");
        $sqlInsereEndereco->bind_param("ssissi", $_POST['cep_clinica'], $_POST['rua_clinica'], $_POST['num_clinica'], $_POST['bairro_clinica'], $_POST['cidade_clinica'], $idClinica);
        $sqlInsereEndereco->execute();

        if($sqlInsereCtt->affected_rows > 0 && $sqlInsereEndereco->affected_rows > 0){
            echo json_encode(array("cod" => "1", "msg" => "Clinica cadastrada com sucesso!", "class" => "green"));
        }else{
            echo json_encode(array("cod" => "0", "msg" => "Erro ao cadastrar clinica!", "erro" => $connect->error, "class" => "red"));
        }
    }else{
        echo json_encode(array("cod" => "0", "msg" => "CNPJ ja cadastrado!", "erro" => $connect->error, "class" => "red"));
    }
    
    


    $connect->close();


?>