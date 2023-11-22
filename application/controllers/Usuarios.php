<?php

defined('BASEPATH') or exit('No direct script access allowed');

class usuarios extends MY_Controller
{

    ////////////////////////////////////////
    // HOME PADRAO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////  
    public function index()
    {
        $this->load->view('includes/header');
        $this->load->view('includes/menu_sup');
        $this->load->view('v_users');
        $this->load->view('includes/modal');
        $this->load->view('includes/footer');
    }

    ////////////////////////////////////////
    // RETORNA DEPARTAMENTO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 08/02/2023                   
    ////////////////////////////////////////
    public function retUsers()
    {
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retUsers();
        echo json_encode($retorno);
    }

    ////////////////////////////////////////
    // CADASTRA DEPARTAMENTO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                   
    ////////////////////////////////////////
    public function cadUser()
    {
        $this->load->library('form_validation');
        if ($this->input->post('txtIdUser') !== '') {
            $this->form_validation->set_rules('txtNomeUser', 'Nome', 'required');
            $this->form_validation->set_rules('txtEmailUser', 'Email', 'required|valid_email|is_unique[tbl_departamentos.cod_departamento]');
            if ($this->input->post('txtSenhaUser') !== '') {
                $this->form_validation->set_rules('txtSenhaUser', 'Senha', 'required');
                $this->form_validation->set_rules('txtConfirmaSenhaUser', 'Confirme senha', 'required');
            }
            $this->form_validation->set_rules('slNivelUser', 'Nivel', 'required');
        } else {
            $this->form_validation->set_rules('txtNomeUser', 'Nome', 'required');
            $this->form_validation->set_rules('txtEmailUser', 'Email', 'required|valid_email|is_unique[tbl_departamentos.cod_departamento]');
            $this->form_validation->set_rules('txtSenhaUser', 'Senha', 'required');
            $this->form_validation->set_rules('txtConfirmaSenhaUser', 'Confirme senha', 'required');
            $this->form_validation->set_rules('slNivelUser', 'Nivel', 'required');
        }


        if ($this->form_validation->run() == FALSE) {
            $return = array(
                'code' => 2,
                'message' => validation_errors()
            );
        } else {
            if ($this->input->post("txtIdEtapa") !== '') {
                $dados = array(
                    "id_users" => $this->input->post("txtIdUser"),
                    "nome" => $this->input->post("txtNomeUser"),
                    "usuario" => $this->input->post("txtEmailUser"),
                    "senha" => md5($this->input->post("txtSenhaUser")),
                    "nivel" => $this->input->post("slNivelUser"),
                    "usucria" => $this->session->userdata('id_users')
                );
            } else {
                $dados = array(
                    "id_users" => $this->input->post("txtIdUser"),
                    "nome" => $this->input->post("txtNomeUser"),
                    "usuario" => $this->input->post("txtEmailUser"),
                    "senha" => md5($this->input->post("txtSenhaUser")),
                    "nivel" => $this->input->post("slNivelUser"),
                    "usucria" => $this->session->userdata('id_users')
                );
            }
            $this->load->model('M_insert');
            $return = $this->M_insert->cadUser($dados);
        }
        echo json_encode($return);
    }

    ////////////////////////////////////////
    // DELETAR DEPARTAMENTO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                   
    ////////////////////////////////////////
    public function delUser()
    {
        $id_user = $this->input->post('txtIdUser');
        $this->load->model('M_delete');
        $return = $this->M_delete->delUser($id_user);
        echo json_encode($return);
    }
}
