<?php
    include_once "../config/conexao.php";

    $sqlInserePaciente = $connect->prepare("INSERT INTO paciente (nome_completo, CPF) VALUES (?, ?)");
    $sqlInserePaciente->bind_param("ss", $_POST['nome_paciente'], $_POST['cpf_paciente']);
    $sqlInserePaciente->execute();

    $idPaciente = $connect->insert_id;

    if($sqlInserePaciente->affected_rows > 0){
        $sqlInsereEndereco = $connect->prepare("INSERT INTO endereco (cep, rua, numero, bairro, cidade, tipo_endereco, id_especifico) VALUES (?, ?, ?, ?, ?, 2, ?)");
        $sqlInsereEndereco->bind_param("ssissi", $_POST['cep_paciente'], $_POST['rua_paciente'], $_POST['num_paciente'], $_POST['bairro_paciente'], $_POST['cidade_paciente'], $idPaciente);
        $sqlInsereEndereco->execute();

        $erro = $connect->error;

        $sqlInsereCtt = $connect->prepare("INSERT INTO contato (telefone, tipo_contato, id_especifico) VALUES (?, 4, ?)");
        $sqlInsereCtt->bind_param("si", $_POST['telefone_paciente'], $idPaciente);
        $sqlInsereCtt->execute();

        if($sqlInsereCtt->affected_rows > 0 && $sqlInsereEndereco->affected_rows > 0){
            echo json_encode(array("cod" => "1", "msg" => "Paciente cadastrado com sucesso!", "class" => "green"));
        }else{
            echo json_encode(array("cod" => "0", "msg" => "Erro ao cadastrar paciente!", "erro" => $erro, "class" => "red"));
        }
    }else{
        echo json_encode(array("cod" => "0", "msg" => "CPF ja cadastrado!", "erro" => $connect->error, "class" => "red"));
    }

?>