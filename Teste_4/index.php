<?php

if ($_POST) {
    function registrar () {
        $arquivo = "registros.php";
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) exit("Atenção: E-mail inválido.");
        $tamanhoTelefone = strlen(preg_replace('/[^0-9]/', '', $_POST['telefone']));
        if ($tamanhoTelefone < 10 || $tamanhoTelefone > 11) exit("Atenção: Telefone inválido");

        verificaLoginEmail($arquivo);

        $handle = fopen($arquivo, 'a');

        $index = md5($_POST["login"]);
        $entrada = '$registros[\''.$index.'\'] = [' . "\n";
        fwrite($handle, $entrada);

        $_POST["senha"] = md5($_POST["senha"]);

        foreach ($_POST as $k => $v) {
            $entrada = "\t" . '\''.$k.'\' => \''.$v.'\',' . "\n";
            fwrite($handle, $entrada);
        }

        $entrada = '];' . "\n\n";
        fwrite($handle, $entrada);
        fclose($handle);

        exit("Registro salvo com sucesso!");
    }

    function verificaLoginEmail ($arquivo) {
        include_once($arquivo);
        if (!empty($registros)) {
            $index = md5($_POST["login"]);
            foreach ($registros as $k => $v) {
                if ($index == $k) {
                    exit("Erro: Login ". $_POST["login"] . " já em uso.");
                }
                if ($_POST["email"] == $v["email"]) {
                    exit("Erro: E-mail ". $_POST["email"] . " já em uso.");
                }
            }
        }
    }
    registrar();
}

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
        <!-- Bootstrap core CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <!-- Material Design Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
        <title>Solução do quarto teste</title>
    </head>
    <body>
        <form class="border border-light p-5">
            <p class="h4 mb-4 text-center">SOLUÇÃO DO QUARTO TESTE</p>
            <p class="h5 mb-4 text-center">Formulário</p>
            <input name="nome" type="text" id="nome" class="form-control mb-4" placeholder="Nome">
            <input name="sobrenome" type="text" id="sobrenome" class="form-control mb-4" placeholder="Sobrenome">
            <input name="telefone" type="text" id="telefone" class="form-control mb-4" maxlength="15" placeholder="(00) 00000-0000">
            <input name="email" type="email" id="email" class="form-control mb-4" placeholder="E-mail">
            <!-- Grid row -->
            <div class="row">
                <!-- Grid column -->
                <div class="col">
                    <input name="login" type="login" id="login" class="form-control mb-4" placeholder="Login">
                </div>
                <!-- Grid column -->
                <!-- Grid column -->
                <div class="col">
                    <input name="senha" type="password" id="senha" class="form-control mb-4" placeholder="Senha">
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
            <button type="submit" id="submit" class="btn btn-info btn-block my-4">Registrar</button>
        </form>
        <!-- JQuery -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Bootstrap tooltips -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
        <!-- Bootstrap core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
        <!-- Scripts para validação do formulário -->
        <script src="scripts.js"></script>
    </body>
</html>
