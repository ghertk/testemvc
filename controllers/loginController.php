<?php
class loginController extends Controller {
    public function index() {
        $usuario = new Usuario();
        $dados = array(
            'mensagem' => '',
            'mostrar' => false
        );

        if (!empty($_POST)) {
            if (!empty($_POST['email']) && !empty($_POST['senha'])) {
                $id = $usuario->logar($_POST['email'], $_POST['senha']);
            }
            if(!$id) {
                $dados['mensagem'] = 'Usuario ou senha incorretos';
                $dados['mostrar'] = true;
            } else {
                $_SESSION['cLogin'] = $id['id'];
                header('Location: '.BASE_URL);
                die();
            }
        }

        $this->loadTemplate('login', $dados);
    }

    public function sair() {
        Core::isLogado();
        unset($_SESSION['cLogin']);
        header('Location: '.BASE_URL);
        die();
    }
}