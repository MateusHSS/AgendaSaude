<?php
    include_once "../config/conexao.php";

    $sqlExcluiClinica = $connect->prepare("DELETE FROM clinica WHERE id_clinica = ?");
    $sqlExcluiClinica->bind_param("i", $_POST['id']);
    $sqlExcluiClinica->execute();

    if($sqlExcluiClinica->affected_rows > 0){
        $sqlExcluiEndereco = $connect->prepare("DELETE FROM endereco WHERE tipo_endereco = 1 AND id_especifico = ?");
        $sqlExcluiEndereco->bind_param("i", $_POST['id']);
        $sqlExcluiEndereco->execute();

        $sqlExcluiCtt = $connect->prepare("DELETE FROM contato WHERE tipo_contato = 1 AND id_especifico = ?");
        $sqlExcluiCtt->bind_param("i", $_POST['id']);
        $sqlExcluiCtt->execute();

        if($sqlExcluiCtt->affected_rows > 0 && $sqlExcluiEndereco->affected_rows > 0){
            echo json_encode(array("cod" => "1", "msg" => "Clínica excluída com sucesso!", "class" => "green"));
        }else{
            echo json_encode(array("cod" => "0", "msg" => "Erro ao excluir clínica selecionada!", "erro" => $connect->error, "class" => "red"));
        }
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Erro ao excluir clínica selecionada", "erro" => $_POST['id'], "class" => "red"));
    }


?>