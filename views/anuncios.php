<div class="row">
    <h1>Meus anuncios</h1>
</div>
<div class="row">
    <a href="<?= BASE_URL; ?>anuncios/criar"><button class="btn col-3">Criar anuncio</button></a>
</div>
<div class="row">
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Titulo</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($itens as $item) {?>
            <tr>
                <td><img src="<?= BASE_URL.'/assets/imagens/'.$item['imgsrc']; ?>" /></td>
                <td><?= $item['titulo']; ?></td>
                <td><?= $item['valor']; ?></td>
                <td>
                    <a href="<?= BASE_URL; ?>anuncios/alterar/<?= $item['id']; ?>" class="alert btn btn-inline">Altrar</a>
                    <a href="<?= BASE_URL; ?>anuncios/remover/<?= $item['id']; ?>" class="cancel btn btn-inline">Remover</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>