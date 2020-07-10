<?php
    include_once "../config/conexao.php";

    if(isset($_POST['senha'])){
        $senha = md5($_POST['senha']);

        $sqlAtualizaUsuario = $connect->prepare("UPDATE usuario SET user = ?, senha = ? WHERE id_usuario = ?");
        $sqlAtualizaUsuario->bind_param("ssi", $_POST['user'], $senha, $_POST['id']);
        $sqlAtualizaUsuario->execute();

    }else{
        $sqlAtualizaUsuario = $connect->prepare("UPDATE usuario SET user = ? WHERE id_usuario = ?");
        $sqlAtualizaUsuario->bind_param("si", $_POST['user'], $_POST['id']);
        $sqlAtualizaUsuario->execute();
    }

    
    

    if($sqlAtualizaUsuario->affected_rows > 0){
        echo json_encode(array("cod" => "1", "msg" => "Cadastro atualizado com sucesso!", "class" => "green"));
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Erro ao atualizar cadastro!", "erro" => $connect->error, "class" => "red"));
    }

    $connect->close();


?>