<?php
class homeController extends Controller {

    public function index() {
        $anuncio = new Anuncio();
        $categoria = new Categoria();
        if (!empty($_GET)) {
            $anuncios = $anuncio->getListaFiltro($_GET['filtros']);
        } else {
            $anuncios = $anuncio->getLista();
        }
        $dados = array();
        $dados['numAnuncios'] = count($anuncios);
        $dados['anuncios'] = $anuncios;
        $dados['categorias'] = $categoria->getLista();
        $this->loadTemplate('home', $dados);
    }
}