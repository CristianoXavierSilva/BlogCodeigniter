<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contato extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('funcoes');
        $this->load->model('categorias_model', 'modelcategorias');
        $this->categorias = $this->modelcategorias->getCategorias();
    }

    public function index($enviado = null) {
        
        $dados['categorias'] = $this->categorias;
        $dados['titulo'] = 'Contato';
        $dados['subtitulo'] = '';
        $dados['enviado'] = $enviado;
        
        $this->load->view('frontend/template/html-header', $dados);
        $this->load->view('frontend/template/header');
        $this->load->view('frontend/contato');
        $this->load->view('frontend/template/aside');
        $this->load->view('frontend/template/footer');
        $this->load->view('frontend/template/html-footer');
    }
    
    public function enviar_mensagem() {
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtNome', 'Nome','required');
        $this->form_validation->set_rules('txtEmail', 'Email','required|valid_email');
        $this->form_validation->set_rules('txtAssunto', 'Assunto','required');
        $this->form_validation->set_rules('txtMensagem', 'Mensagem','required');
        $this->load->model('options_model', 'modelopcoes');
        
        if($this->form_validation->run()) {
            
            $nome = $this->input->post('txtNome');
            $email = $this->input->post('txtEmail');
            $assunto = $this->input->post('txtAssunto');
            $mensagem = $this->input->post('txtMensagem');
            $ip = $this->input->ip_address();
            
            $this->load->library('email');
            $this->email->from($email, $nome);
            $this->email->to($this->modelopcoes->getOption('email'));
            $this->email->subject($assunto);
            $this->email->messange(
                    "<p><strong> Nome: </strong>$nome</p>"
                  . "<p><strong> Email: </strong>$email</p>"
                  . "<p><strong> Mensagem: </strong>$mensagem</p>"
                  . "<p><strong> IP do usuário: </strong>$ip</p>"
            );
            
            if($this->email->send()) {
                redirect(base_url("contato/1"));
            } else {
                redirect(base_url("contato/2"));
            }
        } else {
            $this->index(); 
        }
    }
}
