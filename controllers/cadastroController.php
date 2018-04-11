<?php
class cadastroController extends Controller {
    public function index() {
        $dados = array();
        $this->loadTemplate("cadastro");
    }
}