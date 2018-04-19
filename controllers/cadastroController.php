<?php
class cadastroController extends Controller {
    public function index() {
        $usuario = new Usuario();
        $dados = array(
            'nome' => '',
            'email' => '',
            'telefone' => '',
            'mensagem' => array(),
            'mostrar' => false
        );
        if (!empty($_POST)) {
            $mensagem = array();
            if (isset($_POST['nome']) && !empty($_POST['nome'])) {
                $dados['nome'] = $_POST['nome'];
            } else {
                $mensagem[] = 'Campo de nome deve ser preenchido';
            }
            if (isset($_POST['email']) && !empty($_POST['email'])) {
                $dados['email'] = $_POST['email'];
            } else {
                $mensagem[] = 'Campo de email deve ser preenchido';
            }
            if (isset($_POST['telefone'])) {
                $dados['telefone'] = $telefone = $_POST['telefone'];
            }
            if (isset($_POST['senha']) && !empty($_POST['senha'])) {
                if ($_POST['senha'] == $_POST['repsenha']) {
                    $senha = $_POST['senha'];
                } else {
                    $mensagem[] = 'Senhas diferentes';
                }
            } else {
                $mensagem[] = 'Campo de senha deve ser preenchido';
            }

            if (!empty($dados['nome']) && !empty($dados['email']) && !empty($senha)) {
                if ($usuario->cadastrar($dados['nome'], $dados['email'], $senha, $dados['telefone'])) {
                    header('Location: '.BASE_URL.'login');
                    die();
                } else {
                    $mensagem[] = 'Usuario ja cadastrado';
                    $dados['mostrar'] = true;
                }
            } else {
                $dados['mensagem'] = $mensagem;
                $dados['mostrar'] = true;
            }
        }
        $this->loadTemplate('cadastro', $dados);
    }
}