<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {

    public function check() {

        $system = &get_instance();

        if (!isset($system->session)) {
            $system->load->library('session');
        }

        $controller = $system->uri->segment(1);
        if ($controller == 'admin') {
            
            $action = $system->uri->segment(2);
            if ($action != 'login') {
                if (!$system->session->userdata('logado')) {
                    redirect(base_url('admin/login'));
                    exit;
                }
            }
        }
    }
}
