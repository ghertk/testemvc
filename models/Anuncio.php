<?php
class Anuncio extends Model {
    public function cadastrar($categoria, $titulo, $valor, $descricao, $estado, $usuario) {
        $sql = $this->bd->prepare("INSERT INTO anuncio (usuario_id, categoria_id, titulo, valor, descricao, estado) VALUES (:usuario, :categoria, :titulo, :valor, :descricao, :estado)");
        $sql->bindValue(':usuario', $usuario);
        $sql->bindValue(':categoria', $categoria);
        $sql->bindValue(':titulo', $titulo);
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':descricao', $descricao);
        $sql->bindValue(':estado', $estado);
        $sql->execute();
        return true;
    }

    public function alterar($id, $categoria, $titulo, $valor, $descricao, $estado, $usuario) {
        $sql = $this->bd->prepare("UPDATE anuncio SET categoria_id = :categoria, titulo = :titulo, valor = :valor, descricao = :descricao, estado = :estado WHERE usuario_id = :usuario and id = :id");
        $sql->bindValue(":categoria", $categoria);
        $sql->bindValue(":titulo", $titulo);
        $sql->bindValue(":valor", $valor);
        $sql->bindValue(":descricao", $descricao);
        $sql->bindValue(":estado", $estado);
        $sql->bindValue(":usuario", $usuario);
        $sql->bindValue(":id", $id);
        $sql->execute();
        return true;
    }

    public function remover($id) {
        $sql = $this->bd->prepare("DELETE FROM anuncio WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return true;
    }

    public function getListaUsuario($usuario) {
        $sql = $this->bd->prepare("SELECT * FROM anuncio WHERE usuario_id = :usuario");
        $sql->bindValue(':usuario', $usuario);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLista() {}

    public function getAnuncio($id) {
        $sql = $this->bd->prepare("SELECT * FROM anuncio WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}