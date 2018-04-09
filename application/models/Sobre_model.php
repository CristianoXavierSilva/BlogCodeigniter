<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sobre_model extends CI_Model {
    
    public $id;
    public $titulo;
    public $texto;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getEmpresa() {
        
        return $this->db->get('empresa')->result();
    }
}