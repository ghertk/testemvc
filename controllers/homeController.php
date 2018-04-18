<?php
class homeController extends Controller {

    public function index() {
        $anuncio = new Anuncio($_SESSION['cLogin']);
        $categoria = new Categoria();
        $anuncios = $anuncio->getLista();
        $dados = array();
        $dados['numAnuncios'] = count($anuncios);
        $dados['anuncios'] = $anuncios;
        $dados['categorias'] = $categoria->getLista();
        $this->loadTemplate('home', $dados);
    }
}