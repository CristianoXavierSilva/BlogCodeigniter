<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Postagens_model extends CI_Model {
    
    public $id;
    public $categoria;
    public $titulo;
    public $subtitulo;
    public $conteudo;
    public $data;
    public $img;
    public $user;

    public function __construct() {
        parent::__construct();
    }
    
    public function getPostDestaques() {
        
        $this->db->select('usuario.id AS idautor, usuario.nome, postagens.id,'
                . 'postagens.titulo, postagens.subtitulo, postagens.user, postagens.data, postagens.img');
        $this->db->from('postagens');
        $this->db->join('usuario', 'usuario.id = postagens.user');
        $this->db->limit(4);
        $this->db->order_by('data', 'DESC');        
        
        return $this->db->get()->result();
    }
    
    public function getCategoriaPublic($id) {
        
        $this->db->select('usuario.id AS idautor, usuario.nome, postagens.id,'
                . 'postagens.titulo, postagens.subtitulo, postagens.user, '
                . 'postagens.data, postagens.img, postagens.categoria');
        $this->db->from('postagens');
        $this->db->join('usuario', 'usuario.id = postagens.user');
        $this->db->where('postagens.categoria ='.$id);
        $this->db->order_by('data', 'DESC');
        
        return $this->db->get()->result();
    }
    
    public function getPublic($id) {
        
        $this->db->select('usuario.id AS idautor, usuario.nome, postagens.id,'
                . 'postagens.titulo, postagens.subtitulo, postagens.user, '
                . 'postagens.data, postagens.img, postagens.categoria, postagens.conteudo');
        $this->db->from('postagens');
        $this->db->join('usuario', 'usuario.id = postagens.user');
        $this->db->where('postagens.id ='.$id);
        
        return $this->db->get()->result();
    }
    
    public function getTitulo($id) {
        
        $this->db->select('id, titulo');
        $this->db->from('postagens');
        $this->db->where('id = '.$id);
        
        return $this->db->get()->result();
    }
}

