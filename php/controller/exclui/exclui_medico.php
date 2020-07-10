<?php
    include_once "../config/conexao.php";

    $sqlExcluiMedico = $connect->prepare("DELETE FROM medico WHERE id_medico = ?");
    $sqlExcluiMedico->bind_param("i", $_POST['id']);
    $sqlExcluiMedico->execute();

    if($sqlExcluiMedico->affected_rows > 0){

        $sqlExcluiCtt = $connect->prepare("DELETE FROM contato WHERE tipo_contato = 3 AND id_especifico = ?");
        $sqlExcluiCtt->bind_param("i", $_POST['id']);
        $sqlExcluiCtt->execute();

        if($sqlExcluiCtt->affected_rows > 0){
            echo json_encode(array("cod" => "1", "msg" => "Médico excluído com sucesso!", "class" => "green"));
        }else{
            echo json_encode(array("cod" => "0", "msg" => "Erro ao excluir médico selecionado!", "erro" => $connect->error, "class" => "red"));
        }
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Erro ao excluir médico selecionado", "erro" => $_POST['id'], "class" => "red"));
    }


?>