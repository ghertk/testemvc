<?php
class cadastroController extends Controller {
    public function index() {
        $usuario = new Usuario();
        $dados = array(
            'nome' => '',
            'email' => '',
            'telefone' => '',
            'mensagem' => array(),
            'erro' => false
        );

        if (!empty($_POST)) {
            $mensagem = array();
            if ($this->validarNome()) {
                $dados['nome'] = $_POST['nome'];
            } else {
                $mensagem[] = 'Campo de nome deve ser preenchido';
                $dados['erro'] = true;
            }

            if ($this->validarEmail()) {
                $dados['email'] = $_POST['email'];
            } else {
                $mensagem[] = 'Campo de email deve ser preenchido';
                $dados['erro'] = true;
            }

            if (isset($_POST['telefone'])) {
                $dados['telefone'] = $telefone = $_POST['telefone'];
            }

            if ($this->validarSenha()) {
                $senha = $_POST['senha'];
            } else {
                $mensagem[] = 'Campo de senha deve ser preenchido';
                $dados['erro'] = true;
            }

            if (!empty($dados['nome']) && !empty($dados['email']) && !empty($senha)) {
                if ($usuario->cadastrar($dados['nome'], $dados['email'], $senha, $dados['telefone'])) {
                    header('Location: '.BASE_URL.'login');
                    die();
                } else {
                    $mensagem[] = 'Usuario ja cadastrado';
                    $dados['erro'] = true;
                }
            }
        }
        $this->loadTemplate('cadastro', $dados);
    }

    private function validarNome() {
        if (isset($_POST['nome']) && !empty($_POST['nome'])) {
            return true;
        }
        return false;
    }

    private function validarEmail() {
        if (isset($_POST['email']) && !empty($_POST['email'])) {
            return true;
        }
        return false;
    }

    private function validarSenha() {
        if (isset($_POST['senha']) && !empty($_POST['senha'])) {
            if ($_POST['senha'] == $_POST['repsenha']) {
                return true;
            }
        }
        return false;
    }
}