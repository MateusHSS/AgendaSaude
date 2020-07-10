<?php
    include_once "../controller/config/conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clínicas cadastradas</title>
    <link rel="shortcut icon" href="../../img/vli.ico" type="image/x-icon" />
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- FONTE DA LOGO -->
    <link href="https://fonts.googleapis.com/css?family=Fauna+One&display=swap" rel="stylesheet">

    <!-- CSS DA PAGINA -->
    <link rel="stylesheet" href="../../css/consulta.css">
    <link rel="stylesheet" href="../../css/clinicas_cadastradas.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>

<body>
    <header>

        <nav class="nav-extended">
            <div class="nav-wrapper">
                <div class="container">
                    <a href="#" class="brand-logo"><img src="../../img/logo.png" id="logo"></a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="controller/logout.php">Sair</a></li>
                    </ul>
                </div>
            </div>

            <div class="container">

                <!-- MENU CADASTRO -->

                <ul id="cadastro-menu" class="dropdown-content">
                    <li><a href='../cadastro/cadastro_clinica.php'>Clínica</a></li>
                    <li><a href='../cadastro/cadastro_empresa.php'>Empresa</a></li>
                    <li><a href='../cadastro/cadastro_exame.php'>Exame</a></li>
                    <li><a href='../cadastro/cadastro_medico.php'>Médico</a></li>
                    <li><a href='../cadastro/cadastro_paciente.php'>Paciente</a></li>
                    <li><a href='../cadastro/cadastro_perfil.php'>Perfil</a></li>
                    <li><a href='../cadastro/cadastro_tipo_exame.php'>Tipo de exame</a></li>
                    <li><a href='../cadastro/cadastro_usuario.php'>Usuário</a></li>
                </ul>

                <!-- MENU CONSULTA -->

                <ul id="consulta-menu" class="dropdown-content">
                    <li><a href='clinicas_cadastradas.php'>Clínica</a></li>
                    <li><a href='empresas_cadastradas.php'>Empresa</a></li>
                    <li><a href='exames_cadastrados.php'>Exame</a></li>
                    <li><a href='medicos_cadastrados.php'>Médico</a></li>
                    <li><a href='pacientes_cadastrados.php'>Paciente</a></li>
                    <li><a href='perfis_cadastrados.php'>Perfil</a></li>
                    <li><a href='tipos_exame_cadastrados.php'>Tipo de exame</a></li>
                    <li><a href='usuarios_cadastrados.php'>Usuário</a></li>
                </ul>

                <!-- MENU AGENDAMENTO -->

                <ul id="agendamento-menu" class="dropdown-content">
                    <li><a href='#'>Novo</a></li>
                    <li><a href='#'>Lista</a></li>
                </ul>

                <div class="nav-content">

                    <ul class="tabs transparent">

                        <li class="tab"><a class="dropdown-trigger active white-text"
                                data-target="agendamento-menu">AGENDAMENTO<i
                                    class='material-icons right'>arrow_drop_down</i></a></li>

                        <li class="tab"><a class="dropdown-trigger active white-text"
                                data-target="cadastro-menu">CADASTRO<i
                                    class='material-icons right'>arrow_drop_down</i></a></li>

                        <li class="tab"><a class="dropdown-trigger active white-text"
                                data-target="consulta-menu">CONSULTA<i
                                    class='material-icons right'>arrow_drop_down</i></a></li>

                    </ul>

                </div>

            </div>

        </nav>

    </header>

    <main>
        <div class="container">
            <div class="row right">
                <i class='material-icons right' id='fechar'>close</i>
            </div>
            <?php

                $sqlSomaClinicas = $connect->prepare("SELECT COUNT(*) AS total FROM clinica");
                $sqlSomaClinicas->execute();
                $resultSoma = $sqlSomaClinicas->get_result();
                $resSoma = $resultSoma->fetch_assoc();

            ?>
            <div class="row">
                <h4 class='left'>Clínicas <i
                        class="material-icons">keyboard_arrow_right</i><?php echo $resSoma['total'] ?></h4>
            </div>
            <div class="row" id="listagem_clinicas">
                <?php
                $sqlListaClinicas = $connect->prepare("SELECT clinica.*, contato.*, endereco.* FROM clinica
                INNER JOIN contato ON contato.id_especifico = clinica.id_clinica
                INNER JOIN endereco ON endereco.id_especifico = clinica.id_clinica
                WHERE contato.tipo_contato = 1 AND endereco.tipo_endereco = 1");
                $sqlListaClinicas->execute();

                $resultClinicas = $sqlListaClinicas->get_result();

                    if($resultClinicas->num_rows == 0){
                        ?>
                <div class="row z-depth-2">
                    <div class="row col l12 center">
                        <p>Nenhuma clinica cadastrada ate o momento...</p>
                    </div>
                </div>
                <?php
                    }else{
                        while($resClinicas = $resultClinicas->fetch_assoc()){
                            ?>
                <div class="row z-depth-2">
                    <div class="col l6">
                        <p><span>Razao social: </span><?php echo $resClinicas['razao_social'] ?></p>
                        <p><span>Nome fantasia: </span><?php echo $resClinicas['nome_fantasia'] ?></p>
                        <p><span>CNPJ: </span><?php echo $resClinicas['CNPJ'] ?></p>
                        <p><span>Telefone: </span><?php echo $resClinicas['telefone'] ?></p>
                    </div>
                    <div class="col l4">
                        <p><span>CEP: </span><?php echo $resClinicas['cep'] ?></p>
                        <p><span>Rua: </span><?php echo $resClinicas['rua'] ?></p>
                        <p><span>Nº: </span><?php echo $resClinicas['numero'] ?></p>
                        <p><span>Bairro: </span><?php echo $resClinicas['bairro'] ?></p>
                        <p><span>Cidade: </span><?php echo $resClinicas['cidade'] ?></p>
                    </div>
                    <div class="col l2 center">
                        <p>
                            <div class="row">
                                <button class="btn white red-text btn-small modal-trigger button_edita"
                                    data-target="edita" data-id="<?php echo $resClinicas['id_clinica'] ?>">Editar<i
                                        class="material-icons right">edit</i></button>
                            </div>
                            <div class="row">
                                <button class="btn red white-text btn-small modal-trigger button_exclui"
                                    data-target="exclui" data-id="<?php echo $resClinicas['id_clinica'] ?>">Excluir<i
                                        class="material-icons right">delete</i></button>
                            </div>
                        </p>
                    </div>
                </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>

        <!-- MODAL EDITAR -->
        <div id="edita" class="modal">
            <div class="modal-content">
                <i class='material-icons right modal-close' id='fechar'>close</i>
                <h4 id="nome_titulo"></h4>
                <form method='post' class='center' id="atualiza_dados_clinica" data-id="">
                    <div class="row">
                        <div class="input-field col l6">
                            <input id="razao_social" type="text" class="validate" name='razao_social' required>
                            <label for="razao_social">Razão social</label>
                        </div>
                        <div class="input-field col l6">
                            <input id="nome_fantasia" type="text" class="validate" name='nome_fantasia' required>
                            <label for="nome_fantasia">Nome fantasia</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l6">
                            <input id="telefone_clinica" type="text" class="validate" name='telefone_clinica' required>
                            <label for="telefone_clinica">Telefone</label>
                        </div>
                        <div class="input-field col l6">
                            <input id="cnpj_clinica" type="text" class="validate" name='cnpj_clinica' required>
                            <label for="cnpj_clinica">CNPJ</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l6">
                            <input id="cep_clinica" type="text" class="validate cep" name='cep_clinica' required>
                            <label for="cep_clinica">CEP</label>
                        </div>
                        <div class="input-field col l4">
                            <input id="rua_clinica" type="text" class="validate rua" name='rua_clinica' required>
                            <label for="rua_clinica">Rua</label>
                        </div>
                        <div class="input-field col l2">
                            <input id="num_clinica" type="text" class="validate numero" name='num_clinica' required>
                            <label for="num_clinica">Número</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l6">
                            <input id="bairro_clinica" type="text" class="validate bairro" name='bairro_clinica'
                                required>
                            <label for="bairro_clinica">Bairro</label>
                        </div>
                        <div class="input-field col l6">
                            <input id="cidade_clinica" type="text" class="validate cidade" name='cidade_clinica'
                                required>
                            <label for="cidade_clinica">Cidade</label>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Atualizar
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- MODAL EXCLUI -->
        <div id="exclui" class="modal">
            <div class="modal-content">
                <i class='material-icons right modal-close' id='fechar'>close</i>
                <h5>Confirma que deseja excluir <span id="nome_exclui"></span></h5>
                <p class="red-text">ATENÇÃO: Esta ação não poderá ser revertida posteriormente!</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat green-text" id="confirma_exclui_button" data-id="">Confirma</a>
                <a href="#!" class="modal-close waves-effect waves-red btn-flat red-text">Cancela</a>
            </div>
        </div>

    </main>





    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
        integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
    <script src="../../js/listas/lista.js"></script>
    <script src="../../js/listas/lista_clinicas.js"></script>
</body>

</html>