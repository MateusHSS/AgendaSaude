<?php
    include_once "../config/conexao.php";

    $sqlSelecionaEmpresa = $connect->prepare("SELECT empresa.*, contato.* FROM empresa
    INNER JOIN contato ON contato.id_especifico = empresa.id_empresa
    WHERE contato.tipo_contato = 2 AND empresa.id_empresa = ?");
    $sqlSelecionaEmpresa->bind_param("i", $_POST['id']);
    $sqlSelecionaEmpresa->execute();

    $resultEmpresa = $sqlSelecionaEmpresa->get_result();

    if($resultEmpresa->num_rows > 0){
        echo json_encode(array("cod" => "1", "dados" => $resultEmpresa->fetch_assoc()));
    }else{
        echo json_encode(array("cod" => "0", "erro" => $connect->error));
    }

?>