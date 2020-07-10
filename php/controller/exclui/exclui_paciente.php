<?php
    include_once "../config/conexao.php";

    $sqlExcluiMedico = $connect->prepare("DELETE FROM paciente WHERE id_paciente = ?");
    $sqlExcluiMedico->bind_param("i", $_POST['id']);
    $sqlExcluiMedico->execute();

    if($sqlExcluiMedico->affected_rows > 0){

        $sqlExcluiCtt = $connect->prepare("DELETE FROM contato WHERE tipo_contato = 4 AND id_especifico = ?");
        $sqlExcluiCtt->bind_param("i", $_POST['id']);
        $sqlExcluiCtt->execute();

        $sqlExcluiEndereco = $connect->prepare("DELETE FROM endereco WHERE tipo_endereco = 2 AND id_especifico = ?");
        $sqlExcluiEndereco->bind_param("i", $_POST['id']);
        $sqlExcluiEndereco->execute();

        if($sqlExcluiCtt->affected_rows > 0 && $sqlExcluiEndereco->affected_rows > 0){
            echo json_encode(array("cod" => "1", "msg" => "Paciente excluído com sucesso!", "class" => "green"));
        }else{
            echo json_encode(array("cod" => "0", "msg" => "Erro ao excluir paciente selecionado!", "erro" => $connect->error, "class" => "red"));
        }
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Erro ao excluir paciente selecionado", "erro" => $_POST['id'], "class" => "red"));
    }


?>