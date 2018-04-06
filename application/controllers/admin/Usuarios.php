<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {

        //Informações a serem carregadas n cabeçalho
        $dados['titulo'] = 'Painel Administrativo';
        $dados['subtitulo'] = 'Home';

        $this->load->view('backend/template/html-header', $dados);
        $this->load->view('backend/template/template');
        $this->load->view('backend/home');
        $this->load->view('backend/template/html-footer');
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
            $this->db->where('senha', $senha);
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
