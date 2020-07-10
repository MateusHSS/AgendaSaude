<?php
    include_once "../config/conexao.php";

    $sqlSelecionaPaciente = $connect->prepare("SELECT paciente.*, contato.telefone, endereco.* FROM paciente
            INNER JOIN contato ON contato.id_especifico = paciente.id_paciente
            INNER JOIN endereco ON endereco.id_especifico = paciente.id_paciente
        WHERE contato.tipo_contato = 4 AND endereco.tipo_endereco = 2 AND paciente.id_paciente = ?");
    $sqlSelecionaPaciente->bind_param("i", $_POST['id']);
    $sqlSelecionaPaciente->execute();

    $resultPaciente = $sqlSelecionaPaciente->get_result();

    if($sqlSelecionaPaciente->affected_rows > 0){
        echo json_encode(array("cod" => "1", "dados" => $resultPaciente->fetch_assoc()));
    }else{
        echo json_encode(array("cod" => "0"));
    }

?>