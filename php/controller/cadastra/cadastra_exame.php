<?php
    include_once "../config/conexao.php";

    $sqlInsereExame = $connect->prepare("INSERT INTO exame (descricao, tipo) VALUES (?, ?)");
    $sqlInsereExame->bind_param("si", $_POST['nome_exame'], $_POST['tipo_exame']);
    $sqlInsereExame->execute();

    if($sqlInsereExame->affected_rows > 0){
        echo json_encode(array("cod" => "1", "msg" => "Exame cadastrado com sucesso!", "class" => "green"));
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Erro ao cadastrar exame!", "erro" => $connect->error, "class" => "red"));
    }


?>