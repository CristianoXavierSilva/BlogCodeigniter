<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Model {
    
    public $id;
    public $titulo;

    public function __construct() {
        parent::__construct();
    }
    
    public function getCategorias() {
        
        $this->db->order_by('titulo', 'ASC');
        return $this->db->get('categoria')->result();
    }
}

