<?php if($mostrar): ?>
    <div class="error">
        <ul>
            <?php foreach ($mensagem as $chave => $valor) {?>
                <li><?= $valor; ?></li>
            <?php }?>
        </ul>
    </div>
<?php endif; ?>

<form method="POST" action="<?= BASE_URL; ?>cadastro">
    <div class="row">
        <label for="email" class="col-3">E-mail:</label>
        <input type="email" class="col-9" id="email" name="email" placeholder="Informe seu e-mail de contato" value="<?= $email; ?>" autofocus />
    </div>
    <div class="row">
        <label for="nome" class="col-3">Nome:</label>
        <input type="text" class="col-9" id="nome" name="nome" placeholder="Informe seu nome" value="<?= $nome; ?>" />
    </div>
    <div class="row">
        <label for="senha" class="col-3">Senha:</label>
        <input type="password" class="col-9" id="senha" name="senha" placeholder="Informe sua senha" />
    </div>
    <div class="row">
        <label for="repsenha" class="col-3">Repita a senha:</label>
        <input type="password" class="col-9" id="repsenha" name="repsenha" placeholder="Repita a senha" />
    </div>
    <div class="row">
        <label for="telefone" class="col-3">Telefone:</label>
        <input type="tel" class="col-9" id="telefone" name="telefone" placeholder="Informe seu telefone de contato" value="<?= $telefone; ?>" />
    </div>
    <div class="row">
        <input type="submit" value="Cadastrar" />
        <input type="reset" value="Limpar formulario" />
    </div>
</form>