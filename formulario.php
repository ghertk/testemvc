<?php
include "database.php";
$bd = new DataBase("127.0.0.1", "teste", "root", "agape2012");
$bd->delete("usuario",
    $bd->subQuery("SELECT id FROM usuario WHERE nome = 'Julio'")
);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formulario do teste</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
    <?php include_once "barrasuperior.php";?>
    <div id="conteudo">
        <form id="form" action="database.php" method="POST">
            <div class="row">
                <label for="email" class="col-3">E-mail:</label>
                <input id="email" type="email" class="col-9" name="email" value="<?= $email ?>" placeholder="Informe seu e-mail" autofocus required size="80" />
            </div>
            <div class="row">
                <label for="nome" class="col-3">Nome:</label>
                <input id="nome" type="text" class="col-9" name="nome" value="<?= $nome ?>" placeholder="Informe seu nome" required size="80" />
            </div>
            <div class="row">
                <label for="senha" class="col-3">Senha:</label>
                <input id="senha" type="password" class="col-9" name="senha" placeholder="Informe sua senha" required />
            </div>
            <div class="row">
                <label for="repsenha" class="col-3">Repita sua senha</label>
                <input id="repsenha" type="password" class="col-9" name="repsenha" placeholder="Informe novamente sua senha" required />
            </div>
            <div class="row">
                <input id="btnenviar" class="btn" type="submit" value="Enviar" />
                <input type="reset" class="btn" value="Limpar" />
                <input type="button" class="btn cancel" value="Cancelar" />
            </div>
        </form>
    </div>
    <script src="main.js"></script>
</body>
</html>
