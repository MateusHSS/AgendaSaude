<?php
    include_once "../config/conexao.php";

        $sqlAtualizaTipoExame = $connect->prepare("UPDATE tipo_exame SET descricao = ? WHERE id_tipo_exame = ?");
        $sqlAtualizaTipoExame->bind_param("si", $_POST['descricao'], $_POST['id']);
        $sqlAtualizaTipoExame->execute();
    

    if($sqlAtualizaTipoExame->affected_rows > 0){
        echo json_encode(array("cod" => "1", "msg" => "Cadastro atualizado com sucesso!", "class" => "green"));
    }else{
        echo json_encode(array("cod" => "0", "msg" => "Erro ao atualizar cadastro!", "erro" => $connect->error, "class" => "red"));
    }

    $connect->close();


?>