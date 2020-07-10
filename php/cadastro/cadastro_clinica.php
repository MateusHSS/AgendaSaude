<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastro de clínica</title>
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
            <h4 class='center'>Clínica</h4>
            <form method='post' class='center' id="cadastro_clinica">
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
                        <input id="bairro_clinica" type="text" class="validate bairro" name='bairro_clinica' required>
                        <label for="bairro_clinica">Bairro</label>
                    </div>
                    <div class="input-field col l6">
                        <input id="cidade_clinica" type="text" class="validate cidade" name='cidade_clinica' required>
                        <label for="cidade_clinica">Cidade</label>
                    </div>
                </div>
                <div class="row">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Incluir
                        <i class="material-icons right">send</i>
                    </button>
                </div>
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
    <script src="../../js/cadastros/cadastro_clinica.js"></script>
    
</body>

</html>