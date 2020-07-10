<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Página inicial</title>
    <link rel="shortcut icon" href="../img/vli.ico" type="image/x-icon" />

    <!--Import Google Icon Font-->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Import materialize.css-->

    <link type="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.css" media="screen,projection" />

    <!--Let browser know website is optimized for mobile-->

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Compiled and minified CSS -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- CSS DA PAGINA -->
    <link rel="stylesheet" href="../css/home.css">

    <!-- Compiled and minified JavaScript -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

</head>

<body>
    <header>

        <nav class="nav-extended">
            <div class="nav-wrapper">
                <div class="container">
                    <a href="#" class="brand-logo"><img src="../img/logo.png" id="logo"></a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="controller/logout.php">Sair</a></li>
                    </ul>
                </div>
            </div>

            <div class="container">

                <!-- MENU CADASTRO -->

                <ul id="cadastro-menu" class="dropdown-content">
                    <li><a href='cadastro/cadastro_clinica.php'>Clínica</a></li>
                    <li><a href='cadastro/cadastro_empresa.php'>Empresa</a></li>
                    <li><a href='cadastro/cadastro_exame.php'>Exame</a></li>
                    <li><a href='cadastro/cadastro_medico.php'>Médico</a></li>
                    <li><a href='cadastro/cadastro_paciente.php'>Paciente</a></li>
                    <li><a href='cadastro/cadastro_perfil.php'>Perfil</a></li>
                    <li><a href='cadastro/cadastro_tipo_exame.php'>Tipo de exame</a></li>
                    <li><a href='cadastro/cadastro_usuario.php'>Usuário</a></li>
                </ul>

                <!-- MENU CONSULTA -->

                <ul id="consulta-menu" class="dropdown-content">
                    <li><a href='consulta/clinicas_cadastradas.php'>Clínica</a></li>
                    <li><a href='consulta/empresas_cadastradas.php'>Empresa</a></li>
                    <li><a href='consulta/exames_cadastrados.php'>Exame</a></li>
                    <li><a href='consulta/medicos_cadastrados.php'>Médico</a></li>
                    <li><a href='consulta/pacientes_cadastrados.php'>Paciente</a></li>
                    <li><a href='consulta/perfis_cadastrados.php'>Perfil</a></li>
                    <li><a href='consulta/tipos_exame_cadastrados.php'>Tipo de exame</a></li>
                    <li><a href='consulta/usuarios_cadastrados.php'>Usuário</a></li>
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



    </main>

    <footer>

    </footer>


    <!--JavaScript at end of body for optimized loading-->

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
        integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>

    <script type='text/javascript'>
    $('.dropdown-trigger').dropdown({

        container: document.body,
        hover: true,
        coverTrigger: false

    });
    </script>
</body>

</html>