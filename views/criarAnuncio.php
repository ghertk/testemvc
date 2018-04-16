<?php if($mostrar): ?>
    <div class="error">
        <ul>
            <?php foreach ($mensagem as $chave => $valor) {?>
                <li><?= $valor; ?></li>
            <?php }?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">
    <div class="row">
        <label for="categoria" class="col-3">Categoria:</label>
        <select name="categoria" class="col-9" autofocus>
            <option value="">Escolha um categoria</option>
            <?php foreach($categorias as $valor) { ?>
                <option value="<?= $valor['id']; ?>" <?= (($valor['id'] == $categoria)? 'selected': '') ;?>><?= $valor['nome']; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="row">
        <label for="titulo" class="col-3">Titulo:</label>
        <input type="text" name="titulo" class="col-9" placeholder="Informe o titulo do anuncio" value="<?= $titulo; ?>" />
    </div>
    <div class="row">
        <label for="valor" class="col-3">Valor:</label>
        <input type="text" name="valor"  class="col-9" placeholder="Informe o valor do item do anuncio" value="" />
    </div>
    <div class="row">
        <label for="descricao" class="col-3">Descrição:</label>
        <textarea name="descricao" class="col-9" placeholder="Descreva o item do anuncio" rows="5"><?= $descricao; ?></textarea>
    </div>
    <div class="row">
        <label for="estado" class="col-3">Estado:</label>
        <select name="estado" class="col-9">
            <option value="" <?= (empty($estado)) ? 'selected' : ''; ?>>Escolha um estado</option>
            <option value="1" <?= ($estado == 1) ? 'selected' : ''; ?>>Ruim</option>
            <option value="2" <?= ($estado == 2) ? 'selected' : ''; ?>>Bom</option>
            <option value="3" <?= ($estado == 3) ? 'selected' : ''; ?>>Otimo</option>
        </select>
    </div>
    <div class="row">
        <input type="submit" value="Criar anuncio" />
        <input type="reset" value="Limpar formulario" />
    </div>
</form>