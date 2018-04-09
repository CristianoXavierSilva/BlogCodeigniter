<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('categorias_model', 'modelcategorias');
        $this->categorias = $this->modelcategorias->getCategorias();
    }

    public function index() {

        $this->load->model('postagens_model', 'postagens');
         
        $dados['categorias'] = $this->categorias;
        $dados['postagem'] = $this->postagens->getPostDestaques();
        
        //Informações a serem carregadas n cabeçalho
        $dados['titulo'] = 'Página Inicial';
        $dados['subtitulo'] = 'Postagens Recentes';
        
        $this->load->view('frontend/template/html-header', $dados);
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/home');
        $this->load->view('frontend/template/aside');
        $this->load->view('frontend/template/footer');
        $this->load->view('frontend/template/html-footer');
    }

}
