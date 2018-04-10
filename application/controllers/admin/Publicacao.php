<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Publicacao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logado')) {
            redirect(base_url('admin/login'));
        }

        $this->load->model('categorias_model', 'modelcategorias');
        $this->load->model('publicacoes_model', 'modelpost');
        $this->categorias = $this->modelcategorias->getCategorias();
    }

    public function index() {

        $this->load->library('table');
        $dados['categorias'] = $this->categorias;
        $dados['publicacoes'] = $this->modelpost->getPublics();

        //Informações a serem carregadas n cabeçalho
        $dados['titulo'] = 'Painel Administrativo';
        $dados['subtitulo'] = 'Publicação';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/publicacao');
        $this->load->view('backend/template/html-footer');
    }

    public function inserir() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt-titulo', 'Título da publicação', 'required|min_length[3]');
        $this->form_validation->set_rules('txt-subtitulo', 'Subtítulo da publicação', 'required|min_length[3]');
        $this->form_validation->set_rules('txt-conteudo', 'Conteúdo da publicação','required|min_length[20]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {
            $categoria = $this->input->post('select-categoria');
            $titulo = $this->input->post('txt-titulo');
            $subtitulo = $this->input->post('txt-subtitulo');
            $conteudo = $this->input->post('txt-conteudo');
            $data = $this->input->post('txt-data');
            $user = $this->input->post('txt-usuario');
            
            if ($this->modelpost->adicionar($categoria, $titulo, $subtitulo, $conteudo, $data, $user)) {
                redirect(base_url('admin/publicacao'));
            } else {
                echo 'Erro ao tentar adicionar nova categoria...';
            }
        }
    }

    public function atualizar($id) {

        $this->load->library('table');
        $dados['categorias'] = $this->modelcategorias->getCategorias();
        $dados['publicacoes'] = $this->modelpost->getPost($id);
        
        //Informações a serem carregadas n cabeçalho
        $dados['titulo'] = 'Painel Administrativo';
        $dados['subtitulo'] = 'Publicação';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/alterar-publicacao');
        $this->load->view('backend/template/html-footer');
    }

    public function salvar($id) {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt-titulo', 'Título da publicação', 'required|min_length[3]');
        $this->form_validation->set_rules('txt-subtitulo', 'Subtítulo da publicação', 'required|min_length[3]');
        $this->form_validation->set_rules('txt-conteudo', 'Conteúdo da publicação','required|min_length[20]');
        
        if ($this->form_validation->run() == FALSE) {
            $this->atualizar($id);
        } else {
            
            $id = $this->input->post('txt-id');
            $categoria = $this->input->post('select-categoria');
            $titulo = $this->input->post('txt-titulo');
            $subtitulo = $this->input->post('txt-subtitulo');
            $conteudo = $this->input->post('txt-conteudo');
            $data = $this->input->post('txt-data');
            
            if ($this->modelpost->atualizar($id, $categoria, $titulo, $subtitulo, $conteudo, $data)) {
                redirect(base_url('admin/publicacao'));
            } else {
                echo 'Erro ao tentar adicionar nova publicação...';
            }
        }
    }

    public function excluir($id) {
        if ($this->modelpost->excluir($id)) {
            redirect(base_url('admin/publicacao'));
        } else {
            echo 'Erro ao tentar excluir a publicaçãp...';
        }
    }

    public function addFoto() {

        if (!$this->session->userdata('logado')) {
            redirect(base_url('admin/login'));
        }

        $id = $this->input->post('id');
        $config['upload_path'] = './assets/uploads/posts';
        $config['allowed_types'] = 'jpg';
        $config['file_name'] = $id . '.jpg';
        $config['overwrite'] = true;
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload()) {
            echo $this->upload->display_errors();
        } else {

            $config2['image_library'] = 'gd2';
            $config2['source_image'] = './assets/uploads/posts/' . $id . '.jpg';
            $config2['create_thumb'] = false;
            $config2['width'] = 900;
            $config2['height'] = 300;
            
            $this->load->library('image_lib');
            $this->image_lib->initialize($config2);
            $this->image_lib->clear();

            if ($this->image_lib->resize()) {

                if ($this->modelpost->updateFoto($id)) {
                    redirect(base_url('admin/publicacao/atualizar/' . $id));
                } else {
                    echo 'Erro ao tentar atualizar imagem...';
                }
            } else {
                echo $this->image_lib->display_errors();
            }
        }
    }
}
