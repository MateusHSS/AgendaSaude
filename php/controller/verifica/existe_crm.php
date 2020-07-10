<?php
    include_once "../config/conexao.php";

    $crm = $_POST['crm'];

    $sqlVerificaCRM = $connect->prepare("SELECT * FROM medico WHERE CRM = ?");
    $sqlVerificaCRM->bind_param("s", $crm);
    $sqlVerificaCRM->execute();

    $resultVerficiaCRM = $sqlVerificaCRM->get_result();

    if($resultVerficiaCRM->num_rows == 0){
        echo 'true';
    }else{
        echo 'false';
    }

?>