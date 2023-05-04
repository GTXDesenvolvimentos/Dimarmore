<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Message extends CI_Controller
{
    public function index()
    {
        /////////////////////////////////////////////////
        //// TELA DE LOGIN
        /////////////////////////////////////////////////
        $this->load->view('includes/header');
        $this->load->view('v_login');
        $this->load->view('includes/footer');
        /////////////////////////////////////////////////
    }

    public function loginError()
    {
        $error['msg'] = '<h5 class="alert alert-danger card-title text-center">Usuário ou senha inválido!</h5>';
        $error['redir'] = '';
        $this->load->view('includes/header');
        $this->load->view('v_login', $error);
        $this->load->view('includes/footer');
    }
}
