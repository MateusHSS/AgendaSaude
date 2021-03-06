<?php
    include_once "../config/conexao.php";

        $sqlAtualizaPerfil = $connect->prepare("UPDATE perfil SET descricao = ? WHERE id_perfil = ?");
        $sqlAtualizaPerfil->bind_param("si", $_POST['descricao'], $_POST['id']);
        $sqlAtualizaPerfil->execute()
    

    if($sqlAtualizaPerfil->affected_rows > 0){
        echo json_encode(array("cod" => "1", "msg" => "Cadastro atualizado com sucesso!", "class" => "green"));
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Erro ao atualizar cadastro!", "erro" => $connect->error, "class" => "red"));
    }

    $connect->close();


?>