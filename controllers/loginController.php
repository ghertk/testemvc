<?php
class loginController extends Controller {
    public function index() {
        $usuario = new Usuario();
        $dados = array(
            'email' => '',
            'mensagem' => '',
            'mostrar' => false
        );

        if (!empty($_POST)) {
            $id = 0;
            $dados['email'] = $_POST['email'];
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