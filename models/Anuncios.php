<?php
class Anuncios extends Model{
    public function getQuantidade() {
        $sql = "SELECT COUNT(*) as c FROM anuncio";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            return $sql['c'];
        }
        return 0;
    }
}