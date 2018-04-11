<?php
class Model {
    protected $db;

    public function __construct() {
        global $bd;
        $this->db = $bd;
    }
}