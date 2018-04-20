<?php
class anunciosController extends Controller {

    public function index() {
        Core::isLogado();

        $anuncio = new Anuncio();
        $dados = array(
            'itens' => $anuncio->getListaUsuario($_SESSION['cLogin'])
        );

        $this->loadTemplate('anuncios', $dados);
    }

    public function criar() {
        Core::isLogado();

        $categoria = new Categoria();
        $retorno = $this->validarFormularioAnuncio();
        $imagem = new Imagem();
        $anuncio = $retorno[0];
        $erros = $retorno[2];

        if (!empty($_FILES['imagem'])) {
            $imagem->criar($_FILES['imagem']);
            $anuncio->setImgname($imagem->getNome());
        }

        if (!empty($_POST)) {
            if(!$erros) {
                if ($anuncio->cadastrar()) {
                     header('Location: '.BASE_URL.'anuncios');
                     die();
                }
            }
        }

        $dados = array(
            'anuncio' => $anuncio,
            'mensagens' => $retorno[1],
            'erros' => $erros
        );

        $dados['categorias'] = $categoria->getLista();
        $this->loadTemplate('criarAnuncio', $dados);
    }

    public function alterar($param) {
        Core::isLogado();

        $categoria = new Categoria();
        $retorno = $this->validarFormularioAnuncio();
        $anuncio = $retorno[0];
        $erros = $retorno[2];
        $imagem = new Imagem();

        if (!empty($_FILES['imagem'])) {
            $anuncio->buscarImgname($param);
            $imagem->alterar($_FILES['imagem'], $anuncio->getImgname());
            $anuncio->setImgname($imagem->getNome());
        }

        if (!empty($_POST)) {
            if(!$erros) {
                if ($anuncio->alterar($param)) {
                    header('Location: '.BASE_URL.'anuncios');
                    die();
                }
            }
        }

        $dados = array(
            'anuncio' => $anuncio,
            'mensagem' => $retorno[1],
            'erros' => $erros
        );

        $anuncio->getAnuncio($param);
        if ($anuncio->getUsuario() != $_SESSION['cLogin']) {
            echo "Acesso negado";
            die();
        }

        $dados['categorias'] = $categoria->getLista();
        $this->loadTemplate('alterarAnuncio', $dados);
    }

    public function mostrar($param) {
        $anuncio = new Anuncio();
        $anuncio->getAnuncio($param);
        $categoria = new Categoria();
        $categorias = $categoria->getLista();
        foreach ($categorias as $categoria) {
            if ($categoria['id'] == $anuncio->getCategoriaId()) {
                $nome = $categoria['nome'];
                break;
            }
        }

        $usuario = new Usuario();
        $dados = array(
            'anuncio' => $anuncio,
            'catnome' => $nome,
            'usuario' => $usuario->getUsuario($anuncio->getUsuario())
        );
        $this->loadTemplate('mostrarAnuncio', $dados);
    }

    public function validarFormularioAnuncio() {
        $anuncio = new Anuncio();
        $anuncio->setUsuario($_SESSION['cLogin']);
        $mensagens = array();
        $erros = false;

        if (!empty($_POST)) {
            if ($this->validarCategoria($_POST['categoria']) ) {
                $anuncio->setCategoriaId($_POST['categoria']);
            } else {
                $mensagens[] = "Categoria invalida";
                $erros = true;
            }

            if ($this->validarTitulo($_POST['titulo'])) {
                $anuncio->setTitulo($_POST['titulo']);
            } else {
                $mensagens[] = "Titulo invalido";
                $erros = true;
            }

            if ($this->validarValor($_POST['valor'])) {
                $anuncio->setValor($_POST['valor']);
            } else {
                $mensagens[] = "Valor invalido";
                $erros = true;
            }

            if ($this->validarDescricao($_POST['descricao'])) {
                $anuncio->setDescricao($_POST['descricao']);
            } else {
                $mensagens[] = "Descrição invalida";
                $erros = true;
            }

            if ($this->validarEstado($_POST['estado'])) {
                $anuncio->setEstado($_POST['estado']);
            } else {
                $mensagens[] = "Estado invalido";
                $erros = true;
            }
        }
        return array($anuncio, $mensagens, $erros);
    }

    public function remover($param) {
        Core::isLogado();
        $anuncio = new Anuncio();
        $anuncio->getAnuncio($param);
        $imagem = new Imagem();
        $imagem->remover($anuncio->getImgname());

        if ($anuncio->getUsuario() == $_SESSION['cLogin']) {
            echo "ok";
            $anuncio->remover($param);
            header('Location: '.BASE_URL.'anuncios');
            die();
        }
    }

    private function validarCategoria($categoria) {
        if (isset($categoria) && !empty($categoria)) {
            return true;
        }
        return false;
    }

    private function validarTitulo($titulo) {
        if (isset($titulo) && !empty($titulo)) {
            return true;
        }
        return false;
    }

    private function validarValor($valor) {
        if (isset($valor) && !empty($valor)) {
            if(is_numeric($valor)) {
                return true;
            }
        }
        return false;
    }

    private function validarDescricao($descricao) {
        if (isset($descricao) && !empty($descricao)) {
            return true;
        }
        return false;
    }

    private function validarEstado($estado){
        if (isset($estado) && !empty($estado)) {
            return true;
        }
        return false;
    }
}
