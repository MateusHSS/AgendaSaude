<?php
    include_once "../config/conexao.php";

    $sqlExcluiUsuario = $connect->prepare("DELETE FROM usuario WHERE id_usuario = ?");
    $sqlExcluiUsuario->bind_param("i", $_POST['id']);
    $sqlExcluiUsuario->execute();

    if($sqlExcluiUsuario->affected_rows > 0){
        echo json_encode(array("cod" => "1", "msg" => "Usuário excluído com sucesso!", "class" => "green"));
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Erro ao excluir usuário selecionado!", "erro" => $connect->error, "class" => "red"));
    }


?>