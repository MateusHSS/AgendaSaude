<?php
    include_once "../config/conexao.php";

    $sqlVerificaExame = $connect->prepare("SELECT * FROM exame WHERE descricao = ? AND tipo = ?");
    $sqlVerificaExame->bind_param("si", $_POST['nome'], $_POST['tipo']);
    $sqlVerificaExame->execute();

    $resultVerficiaExame = $sqlVerificaExame->get_result();

    if($resultVerficiaExame->num_rows == 0){
        echo 'true';
    }else{
        echo 'false';
    }

?>