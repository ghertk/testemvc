<div class="main-content col-10">
    <h1 class="main-item">Nós temos hoje <?= $numAnuncios; ?> anúncios.</h1>
</div>

<div class="col-3 side-content">
    <h4 class="side-item">Pesquisar</h4>
    <form method="get" class="side-item">
        <div class="row">
            <label class="side-item" for="filtros[categoria]">Categoria:</label>
            <select class="side-item" name="filtros[categoria]">
                <option></option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id']; ?>"><?= $cat['nome']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="row">
            <label class="side-item" for="filtros[minpreco]">Preço minimo:</label>
            <input class="side-item" id="minpreco" type="text" name="filtros[minpreco]" />
        </div>
        <div class="row">
            <label class="side-item" for="filtros[maxpreco]">Preço maximo:</label>
            <input class="side-item" id="maxpreco" type="text" name="filtros[maxpreco]" />
        </div>
        <div class="row">
            <label class="side-item" for="estado">Estado de Conservação:</label>
            <select class="side-item" id="estado" name="filtros[estado]" style="width: 100%">
                <option></option>
                <option value="1">Ruim</option>
                <option value="2">Bom</option>
                <option value="3">Ótimo</option>
            </select>
        </div>
        <div>
            <input type="submit" value="Buscar" class="btn" style="background-color: #2d89ef;color: white;" />
        </div>
    </form>
</div>
<div class="col-9">
    <?php foreach ($anuncios as $anuncio): ?>
        <div class="list-item">
            <div class="imagem">
                <img src="<?= BASE_URL.'assets/imagens/'?><?=($anuncio['imgsrc'] != '') ? $anuncio['imgsrc'] : 'default.jpg'; ?>" />
            </div>
            <div class="info">
                <div class="row">
                    <a href="<?= BASE_URL.'anuncios/mostrar/'.$anuncio['id']; ?>"><?= $anuncio['titulo']; ?></a>
                </div>
                <div class="row">
                    <?php foreach ($categorias as $categoria) {
                        if ($categoria['id'] == $anuncio['categoria_id']) {?>
                            <span><?= $categoria['nome']?></span>
                        <?php }
                    }?>
                </div>
            </div>
            <div class="preco">
                <span>R$: <?= $anuncio['valor']; ?></span>
            </div>
        </div>
    <?php endforeach; ?>
</div>