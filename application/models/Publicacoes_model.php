<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Publicacoes_model extends CI_Model {

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

//    public function getCategoriaPublic($id) {
//
//        $this->db->select('usuario.id AS idautor, usuario.nome, postagens.id,'
//                . 'postagens.titulo, postagens.subtitulo, postagens.user, '
//                . 'postagens.data, postagens.img, postagens.categoria');
//        $this->db->from('postagens');
//        $this->db->join('usuario', 'usuario.id = postagens.user');
//        $this->db->where('postagens.categoria =' . $id);
//        $this->db->order_by('data', 'DESC');
//
//        return $this->db->get()->result();
//    }
    
    public function getCategoriaPublic($id, $jump, $post_por_page) {

        $this->db->select('usuario.id AS idautor, usuario.nome, postagens.id,'
                . 'postagens.titulo, postagens.subtitulo, postagens.user, '
                . 'postagens.data, postagens.img, postagens.categoria');
        $this->db->from('postagens');
        $this->db->join('usuario', 'usuario.id = postagens.user');
        $this->db->where('postagens.categoria =' . $id);
        $this->db->order_by('data', 'DESC');
        
        if($jump && $post_por_page) {
            $this->db->limit($post_por_page, $jump);
        } else {
            $this->db->limit(2);
        }

        return $this->db->get()->result();
    }

    public function getPublic($id) {

        $this->db->select('usuario.id AS idautor, usuario.nome, postagens.id,'
                . 'postagens.titulo, postagens.subtitulo, postagens.user, '
                . 'postagens.data, postagens.img, postagens.categoria, postagens.conteudo');
        $this->db->from('postagens');
        $this->db->join('usuario', 'usuario.id = postagens.user');
        $this->db->where('postagens.id =' . $id);

        return $this->db->get()->result();
    }

//    public function getPublics() {
//
//        $this->db->order_by('data', 'DESC');
//        return $this->db->get('postagens')->result();
//    }
    
    public function getPublics($pular = null, $post_por_page) {

        $this->db->order_by('data', 'DESC');
        
        if($pular && $post_por_page) {
            $this->db->limit($post_por_page, $pular);
        } else {
            $this->db->limit(5);
        }
        
        return $this->db->get('postagens')->result();
    }

    public function getTitulo($id) {

        $this->db->select('id, titulo');
        $this->db->from('postagens');
        $this->db->where('id = ' . $id);

        return $this->db->get()->result();
    }

    public function adicionar($categoria, $titulo, $subtitulo, $conteudo, $data, $user) {

        $dados['categoria'] = $categoria;
        $dados['titulo'] = $titulo;
        $dados['subtitulo'] = $subtitulo;
        $dados['conteudo'] = $conteudo;
        $dados['data'] = $data;
        $dados['user'] = $user;
        return $this->db->insert('postagens', $dados);
    }

    public function getPost($id) {

        $this->db->where('md5(id)', $id);
        return $this->db->get('postagens')->result();
    }

    public function atualizar($id, $categoria, $titulo, $subtitulo, $conteudo, $data) {
        
        $dados['categoria'] = $categoria;
        $dados['titulo'] = $titulo;
        $dados['subtitulo'] = $subtitulo;
        $dados['conteudo'] = $conteudo;
        $dados['data'] = $data;
        
        $this->db->where('id', $id);
        return $this->db->update('postagens', $dados);
    }

    public function excluir($id) {
        $this->db->where('md5(id)', $id);
        return $this->db->delete('postagens');
    }

    public function updateFoto($id) {
        
        $dados['img'] = $id.'.jpg';
        $this->db->where('md5(id)', $id);
        
        return $this->db->update('postagens', $dados);
    }
    
    public function count() {
        return $this->db->count_all('postagens');
    }
    
    public function countCat($id) {
        
        $this->db->where('categoria', $id);
        return $this->db->count_all_results('postagens');
    }
}
