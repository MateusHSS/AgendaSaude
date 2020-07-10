<?php
    include_once "../config/conexao.php";

    $sqlExcluiTipoExame = $connect->prepare("DELETE FROM tipo_exame WHERE id_tipo_exame = ?");
    $sqlExcluiTipoExame->bind_param("i", $_POST['id']);
    $sqlExcluiTipoExame->execute();

    if($sqlExcluiTipoExame->affected_rows > 0){
        echo json_encode(array("cod" => "1", "msg" => "Tipo de exame excluído com sucesso!", "class" => "green"));
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Erro ao excluir tipo de exame selecionado!", "erro" => $connect->error, "class" => "red"));
    }


?>