<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model {

    public $id;
    public $opcoes;
    public $valor;

    public function __construct() {
        parent::__construct();
    }

    public function getOption($value) {

        $this->db->where('opcoes', $value);
        return $this->db->get('options')->result();
    }
}
