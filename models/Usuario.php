<?php
class Usuario extends Model {
    private $nome;
    private $email;
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

    public function getUsuario($id) {
        $sql = $this->bd->prepare("SELECT * FROM usuario WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
        $this->nome = $usuario['nome'];
        $this->telefone = $usuario['telefone'];
        $this->email = $usuario['email'];
        return $this;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTelefone() {
        return $this->telefone;
    }
}