<?php
    include_once "../config/conexao.php";

    $senha = md5($_POST['senha']);

    $sqlInsereUsuario = $connect->prepare("INSERT INTO usuario (user, senha) VALUES (?, ?)");
    $sqlInsereUsuario->bind_param("ss", $_POST['user'], $senha);
    $sqlInsereUsuario->execute();

    if($sqlInsereUsuario->affected_rows > 0){
        echo json_encode(array("cod" => "1", "msg" => "Usuário cadastrado com sucesso!", "class" => "green"));
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Erro ao cadastrar usuário!", "erro" => $connect->error, "class" => "red"));
    }

?>