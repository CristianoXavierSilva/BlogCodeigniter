<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth {

    public function check() {

        $CI = &get_instance();

        if (!isset($CI->session)) {
            $CI->load->library('session');
        }

        $controller = $CI->uri->segment(1);
        if ($controller == 'admin') {

            $action = $CI->uri->segment(2);
            if ($action != 'login') {
                if (!$CI->session->userdata('logado')) {
                    redirect(base_url('admin/login', 'location', 302));
                }
            }
        }
    }

}
