<?php
class Anuncio extends Model {
    private $categoriaId;
    private $titulo;
    private $valor;
    private $descricao;
    private $estado;
    private $imgname;
    private $usuario;

    public function __construct() {
        parent::__construct();
    }

    public function cadastrar() {
        $sql = $this->bd->prepare("INSERT INTO anuncio (usuario_id, categoria_id, titulo, valor, descricao, estado, imgsrc) VALUES (:usuario, :categoria, :titulo, :valor, :descricao, :estado, :imagem)");
        $sql->bindValue(':usuario', $this->usuario);
        $sql->bindValue(':categoria', $this->categoriaId);
        $sql->bindValue(':titulo', $this->titulo);
        $sql->bindValue(':valor', $this->valor);
        $sql->bindValue(':descricao', $this->descricao);
        $sql->bindValue(':estado', $this->estado);
        $sql->bindValue(':imagem', $this->imgname);
        $sql->execute();
        return true;
    }

    public function alterar($id) {
        $sql = $this->bd->prepare("UPDATE anuncio SET categoria_id = :categoria, titulo = :titulo, valor = :valor, descricao = :descricao, estado = :estado, imgsrc = :imagem WHERE usuario_id = :usuario and id = :id");
        $sql->bindValue(":categoria", $this->categoriaId);
        $sql->bindValue(":titulo", $this->titulo);
        $sql->bindValue(":valor", $this->valor);
        $sql->bindValue(":descricao", $this->descricao);
        $sql->bindValue(":estado", $this->estado);
        $sql->bindValue(":usuario", $this->usuario);
        $sql->bindValue(':imagem', $this->imgname);
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
    public function getCategoriaId() {
        return $this->categoriaId;
    }

    public function setCategoriaId($categoriaId) {
        $this->categoriaId = $categoriaId;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function setTitulo($titulo) {
        $this->titulo = $titulo;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function getImgname() {
        return $this->imgname;
    }

    public function setImgname($imgname) {
        $this->imgname = $imgname;
    }

    public function getUsuario() {
        return $this->usuario;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function getListaUsuario($usuarioId) {
        $sql = $this->bd->prepare("SELECT * FROM anuncio WHERE usuario_id = :usuario");
        $sql->bindValue(':usuario', $usuarioId);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLista() {
        $sql = $this->bd->prepare("SELECT * FROM anuncio");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAnuncio($id) {
        $sql = $this->bd->prepare("SELECT * FROM anuncio WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        $anuncio = $sql->fetchAll(PDO::FETCH_ASSOC);
        $anuncio = $anuncio[0];
        $this->usuario = $anuncio['usuario_id'];
        $this->categoriaId = $anuncio['categoria_id'];
        $this->titulo = $anuncio['titulo'];
        $this->descricao = $anuncio['descricao'];
        $this->valor = $anuncio['valor'];
        $this->estado = $anuncio['estado'];
        $this->imgname = $anuncio['imgsrc'];
    }
}