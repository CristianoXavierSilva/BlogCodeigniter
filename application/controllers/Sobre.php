<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sobre extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('funcoes');
        $this->load->model('usuarios_model', 'modelusuarios');
        $this->load->model('categorias_model', 'modelcategorias');
        $this->categorias = $this->modelcategorias->getCategorias();
    }

    public function index() {
         
        $dados['categorias'] = $this->categorias;
        $dados['autores'] = $this->modelusuarios->getAutores();
        
        //Informações a serem carregadas n cabeçalho
        $dados['titulo'] = 'Sobre Nós';
        $dados['subtitulo'] = 'Conheça nossa equipe';
        
        $this->load->view('frontend/template/html-header', $dados);
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/sobre');
        $this->load->view('frontend/template/aside');
        $this->load->view('frontend/template/footer');
        $this->load->view('frontend/template/html-footer');
    }

    public function autores($id, $slug = null) {
        
        $dados['categorias'] = $this->categorias;
        $dados['autores'] = $this->modelusuarios->getAutor($id);
        
        //Informações a serem carregadas n cabeçalho
        $dados['titulo'] = 'Sobre nós';
        $dados['subtitulo'] = 'Autor';
        
        $this->load->view('frontend/template/html-header', $dados);
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/autor');
        $this->load->view('frontend/template/aside');
        $this->load->view('frontend/template/footer');
        $this->load->view('frontend/template/html-footer');
    }
}