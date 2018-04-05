<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()	{
            
                $dados['mensagem'] = "Olá Mundo!";
		$this->load->view('welcome_message', $dados);
	}
}
