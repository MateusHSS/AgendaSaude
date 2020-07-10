<?php
    include_once "../config/conexao.php";

    $sqlSelecionaMedico = $connect->prepare("SELECT medico.*, contato.telefone FROM medico
            INNER JOIN contato ON contato.id_especifico = medico.id_medico
        WHERE contato.tipo_contato = 3 AND medico.id_medico = ?");
    $sqlSelecionaMedico->bind_param("i", $_POST['id']);
    $sqlSelecionaMedico->execute();

    $resultMedico = $sqlSelecionaMedico->get_result();

    if($sqlSelecionaMedico->affected_rows > 0){
        echo json_encode(array("cod" => "1", "dados" => $resultMedico->fetch_assoc()));
    }else{
        echo json_encode(array("cod" => "0"));
    }

?>