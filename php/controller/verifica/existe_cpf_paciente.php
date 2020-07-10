<?php
    include_once "../config/conexao.php";

    $cpf = $_POST['cpf'];

    $sqlVerificaCPF = $connect->prepare("SELECT * FROM paciente WHERE CPF = ?");
    $sqlVerificaCPF->bind_param("s", $cpf);
    $sqlVerificaCPF->execute();

    $resultVerficiaCPF = $sqlVerificaCPF->get_result();

    if($resultVerficiaCPF->num_rows == 0){
        echo 'true';
    }else{
        echo 'false';
    }

?>