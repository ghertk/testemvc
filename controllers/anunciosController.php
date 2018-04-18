<?php
class anunciosController extends Controller {
    public function index() {
        $anuncio = new Anuncio($_SESSION['cLogin']);
        $dados = array(
            'itens' => $anuncio->getListaUsuario()
        );
        $this->loadTemplate('anuncios', $dados);
    }

    public function criar() {
        $categoria = new Categoria();
        $retorno = $this->validarFormularioAnuncio();
        $dados = array(
            'anuncio' => $retorno[0],
            'mensagens' => $retorno[1],
            'erros' => $retorno[2]
        );
        $dados['categorias'] = $categoria->getLista();
        $this->loadTemplate('criarAnuncio', $dados);
    }

    public function validarFormularioAnuncio() {
        $anuncio = new Anuncio($_SESSION['cLogin']);
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
            $imgname = $this->validarImagem($_FILES['imagem']);
            if ($imgname != '') {
                $anuncio->setImgname($imgname);
            } else {
                $mensagens[] = "Arquivo invalido";
                $erros = true;
            }
            if(!$erros) {
                if ($anuncio->cadastrar()) {
                    header('Location: '.BASE_URL.'anuncios');
                    die();
                }
            }
        }
        return array($anuncio, $mensagens, $erros);
    }

    public function alterar($param) {
        $anuncio = new Anuncio($_SESSION['cLogin']);
        $categoria = new Categoria();
        $dados = array(
            'anuncio' => $anuncio,
            'mensagem' => array(),
            'mostrar' => false
        );
        $anuncio->getAnuncio($param);
        if ($anuncio->getUsuario() != $_SESSION['cLogin']) {
            echo "Acesso negado";
            die();
        }
        $dados['categorias'] = $categoria->getLista();
        $this->loadTemplate('alterarAnuncio', $dados);
    }

    public function remover($param) {
        $anuncio = new Anuncio($_SESSION['cLogin']);
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

    private function validarImagem($imagem) {
        $nomeimg = '';
        if (isset($imagem['tmp_name']) && !empty($imagem['tmp_name'])) {
            $nomeimg = md5($imagem['tmp_name'] + rand(0, 99999));
            if ($imagem['type'] == "image/jpeg") {
                $extencao = '.jpeg';
                $nomeimg = $nomeimg.$extencao;
                move_uploaded_file($imagem['tmp_name'], '/var/www/html/assets/imagens/'.$nomeimg);
            }
            if ($imagem['type'] == "image/png") {
                $extencao = '.png';
                $nomeimg = $nomeimg.$extencao;
                move_uploaded_file($imagem['tmp_name'], '/var/www/html/assets/imagens/'.$nomeimg);
            }
        }
        return $nomeimg;
    }
}
