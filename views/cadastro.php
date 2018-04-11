<form action="<?= BASE_URL;?>cadastro/" method="post">
    <div class="row">
        <label for="nome" class="col-2">Nome:</label>
        <input type="text" class="col-9" name="nome" placeholder="Informe seu nome" />
    </div>
    <div class="row">
        <label for="email" class="col-2">E-mail:</label>
        <input type="email" class="col-9" name="email" placeholder="Informe seu email" />
    </div>
    <div class="row">
        <label for="telefone" class="col-2">Telefone:</label>
        <input type="tel" class="col-9" name="telefone" placeholder="Informe seu telefone" />
    </div>
    <div class="row">
        <label for="senha" class="col-2">Senha:</label>
        <input type="password" class="col-9" name="senha" placeholder="Informe sua senha" />
    </div>
    <input type="submit" value="Enviar" />
</form>