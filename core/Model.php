<?php
class Model {
    protected $bd;

    public function __construct() {
        global $bd;
        $this->bd = $bd;
    }
}