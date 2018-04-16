<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <title>Pagina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>assets/css/style.css" />
</head>
<body>
    <nav>
        <ul>
            <li><a href="<?= BASE_URL; ?>">Home</a></li>
            <?php if(isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])):?>
                <li><a href="<?= BASE_URL; ?>anuncios/">Meus anuncios</a></li>
                <li style="float: right"><a href="<?= BASE_URL; ?>login/sair">Sair</a></li>
            <?php else: ?>
                <li style="float: right"><a href="<?= BASE_URL; ?>cadastro">Cadastre-se</a></li>
                <li style="float: right"><a href="<?= BASE_URL; ?>login">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="conteudo">
        <?php $this->loadViewInTemplate($viewName, $viewData); ?>
    </div>
</body>
</html>