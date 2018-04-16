<?php
class anunciosController extends Controller {
    public function index() {
        $anuncio = new Anuncio();
        $dados = array(
            'itens' => $anuncio->getListaUsuario($_SESSION['cLogin'])
        );
        $this->loadTemplate('anuncios', $dados);
    }

    public function criar() {
        $categoria = new Categoria();
        $anuncio = new Anuncio();
        $dados = array(
            'mensagem' => array(),
            'mostrar' => false
        );
        if (!empty($_POST)) {
            $mensagens = array();
            if (isset($_POST['categoria']) && !empty($_POST['categoria'])) {
                $dados['categoria'] = $_POST['categoria'];
            } else {
                $mensagens[] = 'A categoria deve ser selecionada';
                $dados['mostrar'] = true;
            }
            if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {
                $dados['titulo'] = $_POST['titulo'];
            } else {
                $mensagens[] = 'O campo de titulo deve ser peenchido';
                $dados['mostrar'] = true;
            }
            if (isset($_POST['valor']) && !empty($_POST['valor'])) {
                if(is_numeric($_POST['valor'])) {
                    $dados['valor'] = $_POST['valor'];
                } else {
                    $mensagens[] = 'Valor invalido';
                    $dados['mostrar'] = true;
                }
            } else {
                $mensagens[] = 'O campo de valor deve ser preenchido';
                $dados['mostrar'] = true;
            }
            if (isset($_POST['descricao']) && !empty($_POST['descricao'])) {
                $dados['descricao'] = $_POST['descricao'];
            } else {
                $mensagens[] = 'O campo de descrição deve ser preenchido';
                $dados['mostrar'] = true;
            }
            if (isset($_POST['estado']) && !empty($_POST['estado'])) {
                $dados['estado'] = $_POST['estado'];
            } else {
                $mensagens[] = 'O estado deve ser selecionado';
                $dados['mostrar'] = true;
            }
            if(!empty($dados['categoria']) && !empty($dados['titulo']) && !empty($dados['valor']) &&
                !empty($dados['descricao']) && !empty($dados['estado'])) {
                if ($anuncio->cadastrar($dados['categoria'], $dados['titulo'], $dados['valor'], $dados['descricao'], $dados['estado'], $_SESSION['cLogin'])) {
                    header('Location: '.BASE_URL.'anuncios');
                    die();
                }
            }
            $dados['mensagem'] = $mensagens;
        }
        $dados['categorias'] = $categoria->getLista();
        $this->loadTemplate('criarAnuncio', $dados);
    }

    public function alterar($param) {
        $anuncio = new Anuncio();
        $categoria = new Categoria();
        $dados = array(
            'mensagem' => array(),
            'mostrar' => false
        );
        $item = $anuncio->getAnuncio($param);
        $item = $item[0];
        if ($item['usuario_id'] != $_SESSION['cLogin']) {
            echo "Acesso negado";
            die();
        }
        if (empty($_POST)) {
            $aux = $anuncio->getAnuncio($param);
            $dados['anuncio'] = $aux[0];
        } else {
            $mensagens = array();
            if (isset($_POST['categoria']) && !empty($_POST['categoria'])) {
                $dados['anuncio']['categoria_id'] = $_POST['categoria'];
            } else {
                $mensagens[] = 'A categoria deve ser selecionada';
                $dados['mostrar'] = true;
            }
            if (isset($_POST['titulo']) && !empty($_POST['titulo'])) {
                $dados['anuncio']['titulo'] = $_POST['titulo'];
            } else {
                $mensagens[] = 'O campo de titulo deve ser peenchido';
                $dados['mostrar'] = true;
            }
            if (isset($_POST['valor']) && !empty($_POST['valor'])) {
                if(is_numeric($_POST['valor'])) {
                    $dados['anuncio']['valor'] = $_POST['valor'];
                } else {
                    $mensagens[] = 'Valor invalido';
                    $dados['mostrar'] = true;
                }
            } else {
                $mensagens[] = 'O campo de valor deve ser preenchido';
                $dados['mostrar'] = true;
            }
            if (isset($_POST['descricao']) && !empty($_POST['descricao'])) {
                $dados['anuncio']['descricao'] = $_POST['descricao'];
            } else {
                $mensagens[] = 'O campo de descrição deve ser preenchido';
                $dados['mostrar'] = true;
            }
            if (isset($_POST['estado']) && !empty($_POST['estado'])) {
                $dados['anuncio']['estado'] = $_POST['estado'];
            } else {
                $mensagens[] = 'O estado deve ser selecionado';
                $dados['mostrar'] = true;
            }
            if(!empty($dados['anuncio']['categoria']) && !empty($dados['anuncio']['titulo']) && !empty($dados['anuncio']['valor']) &&
                !empty($dados['anuncio']['descricao']) && !empty($dados['anuncio']['estado'])) {
                if ($anuncio->alterar($param, $dados['anuncio']['categoria'], $dados['anuncio']['titulo'], $dados['anuncio']['valor'], $dados['anuncio']['descricao'],
                    $dados['anuncio']['estado'], $_SESSION['cLogin'])) {
                    header('Location: '.BASE_URL.'anuncios');
                    die();
                }
            }
            $dados['mensagem'] = $mensagens;
        }
        $dados['categorias'] = $categoria->getLista();
        $this->loadTemplate('alterarAnuncio', $dados);
    }

    public function remover($param) {
        $anuncio = new Anuncio();
        $item = $anuncio->getAnuncio($param);
        $item = $item[0];
        if ($item['usuario_id'] == $_SESSION['cLogin']) {
            $anuncio->remover($param);
            header('Location: '.BASE_URL.'anuncios');
            die();
        } else {
            echo "Acesso negado";
        }
    }
}
