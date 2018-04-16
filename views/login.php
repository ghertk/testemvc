<?php if($mostrar): ?>
    <div class="error">
        <ul>
            <li><?= $mensagem; ?></li>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= BASE_URL; ?>login" method="post">
    <div class="row">
        <label for="email" class="col-3">Email:</label>
        <input name="email" type="email" class="col-9" placeholder="Informe seu email de acesso" autofocus />
    </div>
    <div class="row">
        <label for="senha" class="col-3">Senha:</label>
        <input name="senha" type="password" class="col-9" placeholder="Informe sua senha" />
    </div>
    <div class="row">
        <input type="submit" value="Enviar" />
    </div>
</form>