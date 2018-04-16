<?php
class Usuario extends Model {
    private $nome;
    private $email;
    private $senha;
    private $telefone;

    public function cadastrar($nome, $email, $senha, $telefone) {
        $sql = $this->bd->prepare("SELECT id FROM usuario WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        if($sql->rowCount() == 0) {
            $sql = $this->bd->prepare("INSERT INTO usuario (nome, email, senha, telefone) VALUES (:nome, :email, :senha, :telefone)");
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':senha', md5($senha));
            $sql->bindValue(':telefone', $telefone);
            $sql->execute();
            return true;
        } else {
            return false;
        }
    }

    public function logar($email, $senha) {
        $sql = $this->bd->prepare("SELECT id FROM usuario WHERE email = :email AND senha = :senha");
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', md5($senha));
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
}