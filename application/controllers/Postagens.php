<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Postagens extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('categorias_model', 'modelcategorias');
        $this->categorias = $this->modelcategorias->getCategorias();
    }

    public function index($id, $slug = null) {

        $this->load->model('postagens_model', 'postagens');
         
        $dados['categorias'] = $this->categorias;
        $dados['postagem'] = $this->postagens->getPublic($id);
        
        //Informações a serem carregadas n cabeçalho
        $dados['titulo'] = 'Publicação';
        $dados['subtitulo'] = '';
        $dados['cat_titulo'] = $this->postagens->getTitulo($id);
        
        $this->load->view('frontend/template/html-header', $dados);
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/publicacao');
        $this->load->view('frontend/template/aside');
        $this->load->view('frontend/template/footer');
        $this->load->view('frontend/template/html-footer');
    }

}
