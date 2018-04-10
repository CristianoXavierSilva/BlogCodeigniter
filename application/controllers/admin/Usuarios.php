<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuarios_model', 'modelusuarios');
    }

    public function index() {

        if (!$this->session->userdata('logado')) {
            redirect(base_url('admin/login'));
        }

        $this->load->library('table');
        $dados['usuarios'] = $this->modelusuarios->getAutores();

        //Informações a serem carregadas n cabeçalho
        $dados['titulo'] = 'Painel Administrativo';
        $dados['subtitulo'] = 'Usuários';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/usuarios');
        $this->load->view('backend/template/html-footer');
    }

    public function inserir() {

        if (!$this->session->userdata('logado')) {
            redirect(base_url('admin/login'));
        }

        $this->load->model('usuarios_model', 'modelusuarios');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt-nome', 'Nome do Usuário', 'required|min_length[3]');
        $this->form_validation->set_rules('txt-email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('txt-historico', 'Histórico', 'required|min_length[20]');
        $this->form_validation->set_rules('txt-user', 'Usuário', 'required|min_length[3]|is_unique[usuario.user]');
        $this->form_validation->set_rules('txt-senha', 'Senha', 'required|min_length[3]');
        $this->form_validation->set_rules('txt-confirm-senha', 'Confirmar Senha', 'required|matches[txt-senha]');

        if ($this->form_validation->run() == FALSE) {
            $this->inserir();
        } else {

            $nome = $this->input->post('txt-nome');
            $email = $this->input->post('txt-email');
            $historico = $this->input->post('txt-historico');
            $user = $this->input->post('txt-user');
            $senha = $this->input->post('txt-senha');

            if ($this->modelusuarios->adicionar($nome, $email, $historico, $user, $senha)) {
                redirect(base_url('admin/usuarios'));
            } else {
                echo 'Erro ao tentar adicionar nova categoria...';
            }
        }
    }

    public function atualizar($id) {

        if (!$this->session->userdata('logado')) {
            redirect(base_url('admin/login'));
        }

        $dados['usuarios'] = $this->modelusuarios->getUsuario($id);

        //Informações a serem carregadas n cabeçalho
        $dados['titulo'] = 'Painel Administrativo';
        $dados['subtitulo'] = 'Usuários';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/alterar-usuario');
        $this->load->view('backend/template/html-footer');
    }

    public function salvar($id) {

        if (!$this->session->userdata('logado')) {
            redirect(base_url('admin/login'));
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt-nome', 'Nome do Usuário', 'required|min_length[3]');
        $this->form_validation->set_rules('txt-email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('txt-historico', 'Histórico', 'required|min_length[20]');
        $this->form_validation->set_rules('txt-user', 'Usuário', 'required|min_length[3]|is_unique[usuario.user]');
        $this->form_validation->set_rules('txt-senha', 'Senha', 'required|min_length[3]');
        $this->form_validation->set_rules('txt-confirm-senha', 'Confirmar Senha', 'required|matches[txt-senha]');

        if ($this->form_validation->run() == FALSE) {

            $id = $this->input->post('txt-id');
            $this->atualizar($id);
        } else {

            $id = $this->input->post('txt-id');
            $nome = $this->input->post('txt-nome');
            $email = $this->input->post('txt-email');
            $historico = $this->input->post('txt-historico');
            $user = $this->input->post('txt-user');
            $senha = $this->input->post('txt-senha');

            if ($this->modelusuarios->atualizar($id, $nome, $email, $historico, $user, $senha)) {
                redirect(base_url('admin/usuarios'));
            } else {
                echo 'Erro ao tentar adicionar nova categoria...';
            }
        }
    }

    public function excluir($id) {

        if (!$this->session->userdata('logado')) {
            redirect(base_url('admin/login'));
        }

        if ($this->modelusuarios->excluir($id)) {
            redirect(base_url('admin/usuarios'));
        } else {
            echo 'Erro ao tentar excluir a categoria...';
        }
    }

    public function addFoto() {

        if (!$this->session->userdata('logado')) {
            redirect(base_url('admin/login'));
        }

        $id = $this->input->post('id');
        $config['upload_path'] = './assets/uploads/usuarios';
        $config['allowed_types'] = 'jpg';
        $config['file_name'] = $id . 'jpg';
        $config['overwrite'] = true;
        $this->load->library('upload', $config);
        
        if (!$this->upload->do_upload()) {
            echo $this->upload->display_errors();
        } else {

            $config2['image_library'] = 'gd2';
            $config2['source_image'] = './assets/uploads/usuarios/' . $id . '.jpg';
            $config2['create_thumb'] = false;
            $config2['width'] = 200;
            $config2['height'] = 200;
            
            $this->load->library('image_lib');
            $this->image_lib->initialize($config2);
            $this->image_lib->clear();

            if ($this->image_lib->resize()) {

                if ($this->modelusuarios->updateFoto($id)) {
                    redirect(base_url('admin/usuarios/atualizar/' . $id));
                } else {
                    echo 'Erro ao tentar atualizar imagem...';
                }
            } else {
                echo $this->image_lib->display_errors();
            }
        }
    }

    public function pagLogin() {

        //Informações a serem carregadas n cabeçalho
        $dados['titulo'] = 'Painel Administrativo';
        $dados['subtitulo'] = 'Entrar no sistema';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/login');
        $this->load->view('backend/template/html-footer');
    }

    public function login() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt-user', 'Usuário', 'required|min_length[3]');
        $this->form_validation->set_rules('txt-pass', 'Senha', 'required|min_length[3]');
        if ($this->form_validation->run() == FALSE) {
            $this->pagLogin();
        } else {

            $usuario = $this->input->post('txt-user');
            $senha = $this->input->post('txt-pass');
            $this->db->where('user', $usuario);
            $this->db->where('senha', md5($senha));
            $userlogado = $this->db->get('usuario')->result();

            if (count($userlogado) == 1) {
                $dadosSessao['userLogado'] = $userlogado[0];
                $dadosSessao['logado'] = true;
                $this->session->set_userdata($dadosSessao);
                redirect(base_url('admin'));
            } else {

                $dadosSessao['userLogado'] = null;
                $dadosSessao['logado'] = false;
                $this->session->set_userdata($dadosSessao);
                redirect(base_url('admin/login'));
            }
        }
    }

    public function logout() {

        $dadosSessao['userLogado'] = null;
        $dadosSessao['logado'] = false;
        $this->session->set_userdata($dadosSessao);
        redirect(base_url('admin/login'));
    }

}
