<?php
    include_once "../config/conexao.php";

    $sqlInsereTipoExame = $connect->prepare("INSERT INTO tipo_exame (descricao) VALUE (?)");
    $sqlInsereTipoExame->bind_param("s", $_POST['descricao']);
    $sqlInsereTipoExame->execute();

    if($sqlInsereTipoExame->affected_rows > 0){
        echo json_encode(array("cod" => "1", "msg" => "Tipo de exame cadastrado com sucesso!", "class" => "green"));
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Erro ao cadastrar tipo de exame!", "erro" => $connect->error, "class" => "red"));
    }

?>