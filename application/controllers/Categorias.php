<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('funcoes');
        $this->load->model('categorias_model', 'modelcategorias');
        $this->categorias = $this->modelcategorias->getCategorias();
    }

    public function index($id, $slug = null) {

        $this->load->model('publicacoes_model', 'postagens');
         
        $dados['categorias'] = $this->categorias;
        $dados['postagem'] = $this->postagens->getCategoriaPublic($id);
        
        //Informações a serem carregadas n cabeçalho
        $dados['site_titulo'] = 'Categorias';
        $dados['titulo'] = 'Categorias';
        $dados['subtitulo'] = '';
        $dados['cat_titulo'] = $this->modelcategorias->getTitulo($id);
        
        $this->load->view('frontend/template/html-header', $dados);
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/categoria');
        $this->load->view('frontend/template/aside');
        $this->load->view('frontend/template/footer');
        $this->load->view('frontend/template/html-footer');
    }

}
