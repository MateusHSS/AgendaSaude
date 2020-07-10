<?php
    include_once "../config/conexao.php";

    $sqlExcluiEmpresa = $connect->prepare("DELETE FROM empresa WHERE id_empresa = ?");
    $sqlExcluiEmpresa->bind_param("i", $_POST['id']);
    $sqlExcluiEmpresa->execute();

    if($sqlExcluiEmpresa->affected_rows > 0){

        $sqlExcluiCtt = $connect->prepare("DELETE FROM contato WHERE tipo_contato = 2 AND id_especifico = ?");
        $sqlExcluiCtt->bind_param("i", $_POST['id']);
        $sqlExcluiCtt->execute();

        if($sqlExcluiCtt->affected_rows > 0){
            echo json_encode(array("cod" => "1", "msg" => "Empresa excluída com sucesso!", "class" => "green"));
        }else{
            echo json_encode(array("cod" => "0", "msg" => "Erro ao excluir empresa selecionada!", "erro" => $connect->error, "class" => "red"));
        }
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Erro ao excluir empresa selecionada", "erro" => $_POST['id'], "class" => "red"));
    }


?>