<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('funcoes');
        $this->load->model('categorias_model', 'modelcategorias');
        $this->categorias = $this->modelcategorias->getCategorias();
    }

    public function index($id, $name, $jump = null, $post_por_page = null) {

        $this->load->model('publicacoes_model', 'modelpost');
        $this->load->library('pagination');
        $dados['categorias'] = $this->categorias;
        
        $post_por_page = 2;
        $config['base_url'] = base_url("categoria/".$id."/".$name);
        $config['total_rows'] = $this->modelpost->countCat($id);
        $config['per_page'] = $post_por_page; 
        $this->pagination->initialize($config);
        
        $dados['postagem'] = $this->modelpost->getCategoriaPublic($id, $jump, $post_por_page);
        $dados['links_pagination'] = $this->pagination->create_links();
        
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
