<?php
    include_once "../config/conexao.php";

    $sqlSelecionaUsuario = $connect->prepare("SELECT usuario.* FROM usuario WHERE id_usuario = ?");
    $sqlSelecionaUsuario->bind_param("i", $_POST['id']);
    $sqlSelecionaUsuario->execute();

    $resultUsuario = $sqlSelecionaUsuario->get_result();

    if($resultUsuario->num_rows > 0){
        echo json_encode(array("cod" => "1", "dados" => $resultUsuario->fetch_assoc()));
    }else{
        echo json_encode(array("cod" => "0", "erro" => $connect->error));
    }

?>