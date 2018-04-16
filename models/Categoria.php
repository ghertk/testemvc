<?php
class Categoria extends Model {
    public function getLista() {
        $array = array();
        $sql = $this->bd->query("SELECT * FROM categoria");
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }
}