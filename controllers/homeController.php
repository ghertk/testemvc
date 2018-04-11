<?php
class homeController extends Controller {

    public function index() {
        $anuncios = new Anuncios();

        $dados = array(
            'quantidade' => $anuncios->getQuantidade()
        );
        $this->loadTemplate('home', $dados);
    }
}