<?php
    include_once "../config/conexao.php";

    $cnpj = $_POST['cnpj'];

    $sqlVerificaCNPJ = $connect->prepare("SELECT * FROM empresa WHERE CNPJ = ?");
    $sqlVerificaCNPJ->bind_param("s", $cnpj);
    $sqlVerificaCNPJ->execute();

    $resultVerficiaCNPJ = $sqlVerificaCNPJ->get_result();

    if($resultVerficiaCNPJ->num_rows == 0){
        echo 'true';
    }else{
        echo 'false';
    }

?>