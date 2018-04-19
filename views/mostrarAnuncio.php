<div style="margin-top: 100px">
    <h1><?= $anuncio->getTitulo(); ?></h1>
    <h2><?= $catnome; ?></h2>
</div>
<div>
    <h3>R$ <?= $anuncio->getValor(); ?></h3>
</div>
<div>
    <h2>Contato</h2>
    <?php if (!empty($usuario->getTelefone())): ?>
        <h3>telefone: <?= $usuario->getTelefone(); ?></h3>
    <?php endif; ?>
    <h3>E-mail: <?= $usuario->getEmail(); ?></h3>
</div>