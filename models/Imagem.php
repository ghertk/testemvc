<?php
class Imagem {
    private $nome;

    private function validarImagem($imagem) {
        if (isset($imagem['tmp_name']) && !empty($imagem['tmp_name'])) {
            $nomeimg = md5($imagem['tmp_name'] + rand(0, 99999));
            switch ($imagem['type']) {
                case "image/jpeg":
                    $extencao = '.jpeg';
                    break;
                case "image/png":
                    $extencao = '.png';
                    break;
                default:
                    return false;

            }
            $this->nome = $nomeimg.$extencao;
            move_uploaded_file($imagem['tmp_name'], '/var/www/html/assets/imagens/'.$this->nome);
            return true;
        }
        return false;
    }

    public function criar($imagem) {
        return $this->validarImagem($imagem);
    }

    public function alterar($novaImagem, $nomeAnterior) {
        if ($this->validarImagem($novaImagem)) {
                $this->remover($nomeAnterior);
                return true;
        }
        return false;
    }

    public function remover($nome) {
        unlink("/var/www/html/assets/imagens/".$nome);
    }

    public function getNome() {
        return $this->nome;
    }
}