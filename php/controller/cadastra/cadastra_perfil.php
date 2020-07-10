<?php
    include_once "../config/conexao.php";

    $sqlInserePerfil = $connect->prepare("INSERT INTO perfil (descricao) VALUE (?)");
    $sqlInserePerfil->bind_param("s", $_POST['descricao']);
    $sqlInserePerfil->execute();

    if($sqlInserePerfil->affected_rows > 0){
        echo json_encode(array("cod" => "1", "msg" => "Perfil cadastrado com sucesso!", "class" => "green"));
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Erro ao cadastrar perfil!", "erro" => $connect->error, "class" => "red"));
    }

?>