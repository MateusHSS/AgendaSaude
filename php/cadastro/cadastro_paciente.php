<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de paciente</title>
    <link rel="shortcut icon" href="../../img/agSaude.ico" type="image/x-icon" />
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
    <link rel="stylesheet" href="../../css/cadastro.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>

<body>
    <header>

        <nav class="nav">
            <div class="nav-wrapper">
                <div class="container">
                    <a href="#" class="brand-logo"><img src="../../img/logo.png" id="logo"></a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="controller/logout.php">Sair</a></li>
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
            <h4 class='center'>Paciente</h4>
            <form method='post' class='center' id="cadastro_paciente">
                <div class="row">
                    <div class="input-field col l6">
                        <input id="nome_paciente" type="text" class="validate" name='nome_paciente'>
                        <label for="nome_paciente">Nome completo</label>
                    </div>
                    <div class="input-field col l6">
                        <input id="telefone_paciente" type="text" class="validate" name='telefone_paciente'>
                        <label for="telefone_paciente">Telefone</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col l6">
                        <input id="cpf_paciente" type="text" class="validate" name='cpf_paciente'>
                        <label for="cpf_paciente">CPF</label>
                    </div>
                    <div class="input-field col l6">
                        <input id="cep_paciente" type="text" class="validate cep" name='cep_paciente'>
                        <label for="cep_paciente">CEP</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col l6">
                        <input id="rua_paciente" type="text" class="validate rua" name='rua_paciente'>
                        <label for="rua_paciente">Rua</label>
                    </div>
                    <div class="input-field col l6">
                        <input id="num_paciente" type="text" class="validate numero" name='num_paciente'>
                        <label for="num_paciente">Número</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col l6">
                        <input id="bairro_paciente" type="text" class="validate bairro" name='bairro_paciente'>
                        <label for="bairro_paciente">Bairro</label>
                    </div>
                    <div class="input-field col l6">
                        <input id="cidade_paciente" type="text" class="validate cidade" name='cidade_paciente'>
                        <label for="cidade_paciente">Cidade</label>
                    </div>
                </div>
                <button class="btn waves-effect waves-light" type="submit" name="action">Incluir
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
    </main>





    <!--JavaScript at end of body for optimized loading-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"
        integrity="sha256-yE5LLp5HSQ/z+hJeCqkz9hdjNkk1jaiGG0tDCraumnA=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
    <script src="../../js/buscaEndereco.js"></script>
    <script src="../../js/cadastros/cadastro_paciente.js"></script>
</body>

</html>