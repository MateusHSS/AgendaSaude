<?php
    include_once "../config/conexao.php";

    $sqlSelecionaClinica = $connect->prepare("SELECT clinica.*, contato.*, endereco.* FROM clinica
            INNER JOIN contato ON contato.id_especifico = clinica.id_clinica
            INNER JOIN endereco ON endereco.id_especifico = clinica.id_clinica
        WHERE contato.tipo_contato = 1 AND endereco.tipo_endereco = 1 AND clinica.id_clinica = ?");
    $sqlSelecionaClinica->bind_param("i", $_POST['id']);
    $sqlSelecionaClinica->execute();

    $resultClinica = $sqlSelecionaClinica->get_result();

    if($sqlSelecionaClinica->affected_rows > 0){
        echo json_encode(array("cod" => "1", "dados" => $resultClinica->fetch_assoc()));
    }else{
        echo json_encode(array("cod" => "0"));
    }

?>