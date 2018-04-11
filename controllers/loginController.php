<?php
class loginController extends Controller {
    public function index() {
        $dados = array();
        $this->loadTemplate('login');
    }

    public function logar($param) {

    }
}