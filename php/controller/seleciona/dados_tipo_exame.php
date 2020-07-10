<?php
    include_once "../config/conexao.php";

    $sqlSelecionaTipoExame = $connect->prepare("SELECT tipo_exame.* FROM tipo_exame
        WHERE tipo_exame.id_tipo_exame = ?");
    $sqlSelecionaTipoExame->bind_param("i", $_POST['id']);
    $sqlSelecionaTipoExame->execute();

    $resultTipoExame = $sqlSelecionaTipoExame->get_result();

    if($resultTipoExame->num_rows > 0){
        echo json_encode(array("cod" => "1", "dados" => $resultTipoExame->fetch_assoc()));
    }else{
        echo json_encode(array("cod" => "0", "erro" => $connect->error));
    }

?>