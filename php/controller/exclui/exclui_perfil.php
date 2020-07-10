<?php
    include_once "../config/conexao.php";

    $sqlExcluiPerfil = $connect->prepare("DELETE FROM perfil WHERE id_perfil = ?");
    $sqlExcluiPerfil->bind_param("i", $_POST['id']);
    $sqlExcluiPerfil->execute();

    if($sqlExcluiPerfil->affected_rows > 0){
        echo json_encode(array("cod" => "1", "msg" => "Paciente excluído com sucesso!", "class" => "green"));
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Erro ao excluir paciente selecionado!", "erro" => $connect->error, "class" => "red"));
    }


?>