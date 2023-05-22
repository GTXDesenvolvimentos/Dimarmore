<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Projetos extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(['form_validation', 'session']);
        $this->load->database();
    }

    public function index()
    {
        /////////////////////////////////////////////////
        //// TELA DE PROJETOS
        /////////////////////////////////////////////////
        $this->load->view('includes/header');
        $this->load->view('includes/menu_sup');
        $this->load->view('v_projetos');
        $this->load->view('includes/modal');
        $this->load->view('includes/footer');
        /////////////////////////////////////////////////
    }

    public function retAllProjects(){
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retAllProjects();
        echo json_encode($retorno);
    }

    public function retAllDeptos(){
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retAllProjects();
        echo json_encode($retorno);
    }

    /*
    public function login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtEmail', 'Email', 'required');
        $this->form_validation->set_rules('txtPassword', 'Senha', 'required');

        if ($this->form_validation->run() == FALSE) {
            $erros = array(
                'message' => validation_errors(),
                'code' => 2
            );
            echo json_encode($erros);
        } else {
            $dados = array(
                "email" => $this->input->post('txtEmail'),
                "password" => $this->input->post('txtPassword'),
            );

            $return = $this->m_retorno->login($dados);

            if ($return == true) {
                $retorno = array(
                    'message' => "Logado com sucesso!!!!",
                    'code' => 1
                );
                echo json_encode($retorno);
            } else {
                $retorno = array(
                    'message' => "Usuário ou senha inválido!",
                    'code' => 0
                );
                echo json_encode($retorno);
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('');
    }
    */
}
