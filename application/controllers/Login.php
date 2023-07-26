<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(['form_validation', 'session']);
        $this->load->database();
        //$this->load->model('m_retorno');
    }

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

            $this->load->model('m_retorno');
            $return = $this->m_retorno->login($dados);

            if($return == true){
                $retorno = array(
                    'message' => "Logado com sucesso!!!!",
                    'code' => 1
                );
                echo json_encode($retorno);
            }else{
                $retorno = array(
                    'message' => "Usuário ou senha inválido!",
                    'code' => 0
                );
                echo json_encode($retorno);
            }
           
        }











        // if ($this->form_validation->run() == FALSE) {
        //     /////////////////////////////////////////////////
        //     //// TELA DE LOGIN
        //     /////////////////////////////////////////////////
        //     $return['msg'] = '<div class="col-12 mb-1 p-0"><div class="card bg-danger text-white shadow"><div class="card-body">Atenção...<hr class="m-1"><div class="text-white-100">' . validation_errors() . '</div></div></div></div>';
        //     $this->load->view('includes/header');
        //     $this->load->view('v_login', $return);
        //     $this->load->view('includes/footer');
        //     /////////////////////////////////////////////////
        // } else {
        //     $dados = array(
        //         "email" => $this->input->post('email'),
        //         "password" => $this->input->post('password')
        //     );

        //     $return = $this->m_retorno->login($dados);

        //     if ($return === FALSE) {
        //         $return['msg'] = '<div class="col-12 mb-1 p-0"><div class="card bg-danger text-white shadow"><div class="card-body">Atenção...<hr class="m-1"><div class="text-white-100">Usuário ou senha inválido!<br>Tente novamente</div></div></div></div>';
        //         $this->load->view('includes/header');
        //         $this->load->view('v_login', $return);
        //         $this->load->view('includes/footer');
        //     } else {
        //         redirect('home');
        //     }
        // }
    }


    public function register()
    {
        /////////////////////////////////////////////////
        //// TELA DE LOGIN
        /////////////////////////////////////////////////
        if ($this->uri->segment(3) == '') {
            redirect('login');
        } else {
            $return['patrocinador'] = $this->uri->segment(3);
            $this->load->view('includes/header');
            $this->load->view('v_register', $return);
            $this->load->view('includes/footer');
        }
    }

    public function registerUser()
    {
        $this->form_validation->set_rules('name', 'Nome', 'required');
        $this->form_validation->set_rules('surname', 'Sobrenome', 'required');
        $this->form_validation->set_rules('contact', 'Contato', 'required|is_unique[tbl_users.contact]');
        $this->form_validation->set_rules('cpf', 'CPF', 'required|is_unique[tbl_users.document]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tbl_users.email]');
        $this->form_validation->set_rules('password', 'Senha', 'required');
        $this->form_validation->set_rules('repassword', 'Confirmação de Senha', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $return['msg'] = '<div class="col-12 mb-1 p-0"><div class="card bg-danger text-white shadow"><div class="card-body">Atenção...<hr class="m-1"><div class="text-white-100">' . validation_errors() . '</div></div></div></div>';
            $return['patrocinador'] = $this->input->post('patrocinador');
            $this->load->view('includes/header');
            $this->load->view('v_register', $return);
            $this->load->view('includes/footer');
        } else {
            $id_indicado = $this->m_retorno->patrocinador($this->input->post('patrocinador'));
            if ($id_indicado->num_rows() > 0) {
                $dados = array(
                    "id_indicado" =>  $id_indicado->row()->id_indicado,
                    "name" => $this->input->post('name'),
                    "surname" => $this->input->post('surname'),
                    "contact" => $this->input->post('contact'),
                    "document" => $this->input->post('cpf'),
                    "email" => $this->input->post('email'),
                    "password" => md5($this->input->post('password')),
                    "status_users" => 'P'
                );
                $validaCpf = $this->m_retorno->validaCpf($dados['document']);

                if ($validaCpf !== true) {
                    $return['msg'] = '<h5 class="alert alert-danger card-title text-center">CPF inválido! tente novamente.</h5>';
                    $this->load->view('includes/header');
                    $this->load->view('v_register', $return);
                    $this->load->view('includes/footer');
                } else {
                    $ret = $this->m_insert->cadUsuario($dados);
                    if ($ret === 1) {
                        $return['patrocinador'] = $this->input->post('patrocinador');
                        $return['msg'] = '<div class="col-12 mb-1 p-0 text-center"><div class="card bg-success text-white shadow"><div class="card-body">Parabéns!<hr class="m-1"><div class="text-white-100">Cadastro efetuado com sucesso!<a href="' . base_url() . '" class="btn btn-primary">Faça o login</a></div></div></div></div>';
                        $this->load->view('includes/header');
                        $this->load->view('v_register', $return);
                        $this->load->view('includes/footer');
                    } else {
                    }
                }
            } else {
                $return['msg'] = '<div class="col-12 mb-1 p-0"><div class="card bg-danger text-white shadow"><div class="card-body">Atenção...<hr class="m-1"><div class="text-white-100">Cód. patrocinador inexistente! <br> entre em comtato conosco!</div></div></div></div>';
                $return['patrocinador'] = $this->input->post('patrocinador');
                $this->load->view('includes/header');
                $this->load->view('v_register', $return);
                $this->load->view('includes/footer');
            }
        }
    }



    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
