<?php
    include_once "../controller/config/conexao.php";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pacientes cadastrados</title>
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
    <link rel="stylesheet" href="../../css/pacientes_cadastrados.css">

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
        <div class="row">
            <div class="container">
                <div class="col l12">
                    <?php

                $sqlSomaPacientes = $connect->prepare("SELECT COUNT(*) AS total FROM paciente");
                $sqlSomaPacientes->execute();
                $resultSoma = $sqlSomaPacientes->get_result();
                $resSoma = $resultSoma->fetch_assoc();

            ?>
                    <div class="row">
                        <h5 class='left'>Pacientes<i
                                class="material-icons">keyboard_arrow_right</i><?php echo $resSoma['total'] ?></h5>
                    </div>
                    <div class="row z-depth-2" id="listagem_paciente">
                        <table class="centered striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                $sqlListaPacientes = $connect->prepare("SELECT paciente.*, contato.telefone, endereco.* FROM paciente
                INNER JOIN contato ON contato.id_especifico = paciente.id_paciente 
                INNER JOIN endereco ON endereco.id_especifico = paciente.id_paciente
                WHERE contato.tipo_contato = 4 AND endereco.tipo_endereco = 2");
                $sqlListaPacientes->execute();

                $resultPacientes = $sqlListaPacientes->get_result();

                    if($resultPacientes->num_rows < 0){
                        ?>
                                <tr>
                                    <td colspan="4">
                                        Nenhum paciente cadastrado ate o momento...
                                    </td>
                                </tr>
                                <?php
                    }else{
                        while($resPacientes = $resultPacientes->fetch_assoc()){
                            ?>
                                <tr>
                                    <td><?php echo $resPacientes['id_paciente'] ?></td>
                                    <td><?php echo $resPacientes['nome_completo'] ?></td>
                                    <td><?php echo $resPacientes['CPF'] ?></td>
                                    <td>
                                        <button class="btn btn-small button_edita white red-text modal-trigger"
                                            data-target="edita" data-id="<?php echo $resPacientes['id_paciente'] ?>"><i
                                                class="material-icons">edit</i></button>
                                        <button class="btn btn-small button_exclui white red-text modal-trigger"
                                            data-target="exclui" data-id="<?php echo $resPacientes['id_paciente'] ?>"><i
                                                class="material-icons">delete</i></button>
                                    </td>
                                </tr>
                                <?php
                        }
                    }
                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL EDITAR -->
        <div id="edita" class="modal">
            <div class="modal-content">
                <i class='material-icons right modal-close' id='fechar_modal'>close</i>
                <h4 id="nome_titulo"></h4>
                <form method='post' class='center' id="atualiza_dados_paciente" data-id="">
                    <div class="row">
                        <div class="input-field col l6">
                            <input id="nome" type="text" class="validate" name='nome'>
                            <label for="nome">Nome completo</label>
                        </div>
                        <div class="input-field col l6">
                            <input id="telefone" type="text" class="validate" name='telefone'>
                            <label for="telefone">Telefone</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l6">
                            <input id="cpf" type="text" class="validate" name='cpf'>
                            <label for="cpf">CPF</label>
                        </div>
                        <div class="input-field col l6">
                            <input id="cep" type="text" class="validate cep" name='cep'>
                            <label for="cep">CEP</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l6">
                            <input id="rua" type="text" class="validate rua" name='rua'>
                            <label for="rua">Rua</label>
                        </div>
                        <div class="input-field col l6">
                            <input id="num" type="text" class="validate numero" name='num'>
                            <label for="num">Número</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l6">
                            <input id="bairro" type="text" class="validate bairro" name='bairro'>
                            <label for="bairro">Bairro</label>
                        </div>
                        <div class="input-field col l6">
                            <input id="cidade" type="text" class="validate cidade" name='cidade'>
                            <label for="cidade">Cidade</label>
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
                <i class='material-icons right modal-close' id='fechar_modal'>close</i>
                <h5>Confirma que deseja excluir <span id="nome_exclui"></span></h5>
                <p class="red-text">ATENÇÃO: Esta ação não poderá ser revertida posteriormente!</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat green-text"
                    id="confirma_exclui_button" data-id="">Confirma</a>
                <a href="" class="modal-close waves-effect waves-red btn-flat red-text">Cancela</a>
            </div>
        </div>
    </main>





    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
        integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
    <script src="../../js/buscaEndereco.js"></script>
    <script src="../../js/listas/lista.js"></script>
    <script src="../../js/listas/lista_pacientes.js"></script>
</body>

</html>