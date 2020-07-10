<?php
    include_once "../config/conexao.php";

    $sqlSelecionaPerfil = $connect->prepare("SELECT perfil.* FROM perfil
        WHERE perfil.id_perfil = ?");
    $sqlSelecionaPerfil->bind_param("i", $_POST['id']);
    $sqlSelecionaPerfil->execute();

    $resultPerfil = $sqlSelecionaPerfil->get_result();

    if($resultPerfil->num_rows > 0){
        echo json_encode(array("cod" => "1", "dados" => $resultPerfil->fetch_assoc()));
    }else{
        echo json_encode(array("cod" => "0", "erro" => $connect->error));
    }

?>