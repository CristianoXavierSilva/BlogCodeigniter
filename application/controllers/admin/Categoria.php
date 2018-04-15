<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('categorias_model', 'modelcategorias');
        $this->categorias = $this->modelcategorias->getCategorias();
    }

    public function index($publicado = null) {

        $this->load->library('table');
        $dados['categorias'] = $this->categorias;
        //Informações a serem carregadas n cabeçalho
        $dados['titulo'] = 'Painel Administrativo';
        $dados['subtitulo'] = 'Categoria';
        $dados['publicado'] = $publicado;
        
        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/categoria');
        $this->load->view('backend/template/html-footer');
    }

    public function inserir() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt-categoria', 'Nome da categoria', 'required|min_length[3]|is_unique[categoria.titulo]');
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $titulo = $this->input->post('txt-categoria');
            if ($this->modelcategorias->adicionar($titulo)) {
                redirect(base_url('admin/categoria/1'));
            } else {
                echo 'Erro ao tentar adicionar nova categoria...';
            }
        }
    }

    public function atualizar($id) {

        $this->load->library('table');
        $dados['categorias'] = $this->modelcategorias->getCategoria($id);
        //Informações a serem carregadas n cabeçalho
        $dados['titulo'] = 'Painel Administrativo';
        $dados['subtitulo'] = 'Categoria';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/alterar-categoria');
        $this->load->view('backend/template/html-footer');
    }

    public function salvar($id) {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt-categoria', 'Nome da categoria', 'required|min_length[3]|is_unique[categoria.titulo]');
        if ($this->form_validation->run() == FALSE) {
            $this->atualizar($id);
        } else {
            $id = $this->input->post('txt-id');
            $titulo = $this->input->post('txt-categoria');
            if ($this->modelcategorias->atualizar($id, $titulo)) {
                redirect(base_url('admin/categoria'));
            } else {
                echo 'Erro ao tentar adicionar nova categoria...';
            }
        }
    }

    public function excluir($id) {
        
        if ($this->modelcategorias->excluir($id)) {
            redirect(base_url('admin/categoria'));
        } else {
            echo 'Erro ao tentar excluir a categoria...';
        }
    }

}
