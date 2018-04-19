<?php
class homeController extends Controller {

    public function index() {
        if (!empty($_GET)) {
            $filtros = $_GET['filtros'];
            if ($filtros['categoria']) {
                // TODO
            }

            if ($filtros['minpreco']) {
                // TODO
            }

            if ($filtros['maxpreco']) {
                // TODO
            }

            if ($filtros['estado']) {
                // TODO
            }
        }
        $anuncio = new Anuncio();
        $categoria = new Categoria();
        $anuncios = $anuncio->getLista();
        $dados = array();
        $dados['numAnuncios'] = count($anuncios);
        $dados['anuncios'] = $anuncios;
        $dados['categorias'] = $categoria->getLista();
        $this->loadTemplate('home', $dados);
    }
}