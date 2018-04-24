<?php if($erros): ?>
    <?php foreach ($mensagens as $chave => $valor) {?>
        <div class="error">
            <?= $valor; ?>
        </div>
    <?php }?>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <div class="row">
        <label for="categoria" class="col-3">Categoria:</label>
        <select name="categoria" id="categoria" class="col-9" autofocus>
            <option value="">Escolha um categoria</option>
            <?php foreach($categorias as $valor) { ?>
                <option value="<?= $valor['id']; ?>" <?= ($valor['id'] == $anuncio->getCategoriaId())? 'selected': ''; ?>><?= $valor['nome']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="row">
        <label for="titulo" class="col-3">Titulo:</label>
        <input type="text" name="titulo" class="col-9" placeholder="Informe o titulo do anuncio" value="<?= $anuncio->getTitulo(); ?>" />
    </div>
    <div class="row">
        <label for="valor" class="col-3">Valor:</label>
        <input type="text" name="valor"  class="col-9" placeholder="Informe o valor do item do anuncio" value="<?= $anuncio->getValor(); ?>" />
    </div>
    <div class="row">
        <label for="descricao" class="col-3">Descrição:</label>
        <textarea name="descricao" class="col-9" placeholder="Descreva o item do anuncio" rows="5"><?= $anuncio->getDescricao(); ?></textarea>
    </div>
    <div class="row">
        <label for="estado" class="col-3">Estado:</label>
        <select name="estado" id="estado" class="col-9">
            <option value="" >Escolha um estado</option>
            <option value="1" <?= ($anuncio->getEstado() == 1) ? 'selected': ''; ?>>Ruim</option>
            <option value="2" <?= ($anuncio->getEstado() == 2) ? 'selected': ''; ?>>Bom</option>
            <option value="3" <?= ($anuncio->getEstado() == 3) ? 'selected': ''; ?>>Otimo</option>
        </select>
    </div>
    <div class="row">
        <label for="imagem" class="col-3">Imagem</label>
        <input type="file" name="imagem"  class="col-9" />
    </div>
    <div class="row">
        <input type="submit" value="Criar anuncio" />
        <input type="reset" value="Limpar formulario" />
    </div>
</form>