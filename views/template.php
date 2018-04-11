<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <title>Pagina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL;?>assets/css/style.css" />
</head>
<body>
    <nav>
        <ul>
            <li><a href="<?= BASE_URL ?>">Home</a></li>
            <li><a href="<?= BASE_URL ?>login">Login</a></li>
            <li><a href="<?= BASE_URL ?>cadastro">Cadastre-se</a></li>
        </ul>
    </nav>
    <div>
        <?php $this->loadViewInTemplate($viewName, $viewData);?>
    </div>
</body>
</html>