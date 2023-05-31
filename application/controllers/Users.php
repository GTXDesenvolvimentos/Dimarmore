<?php

defined('BASEPATH') or exit('No direct script access allowed');

class users extends MY_Controller
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
        var_dump($this->input->post());
        exit();
        $this->load->library('form_validation');
        if ($this->input->post('txtIdUser') !== '') {
            $this->form_validation->set_rules('txtNomeUser', 'Nome', 'required');
            $this->form_validation->set_rules('txtEmailUser', 'Email', 'required|is_unique[tbl_departamentos.cod_departamento]');
            $this->form_validation->set_rules('slNivelUser', 'Nivel', 'required');
        } else {
            $this->form_validation->set_rules('txtNomeUser', 'Nome', 'required');
            $this->form_validation->set_rules('txtEmailUser', 'Email', 'required|is_unique[tbl_departamentos.cod_departamento]');
            $this->form_validation->set_rules('txtSenhaUser', 'Senha', 'required');
            $this->form_validation->set_rules('txtConfirmaSenhaUser', 'Confirme senha', 'required');
            $this->form_validation->set_rules('slNivelUser', 'Nivel', 'required');
        }

//         "txtIdUser"
// "txtNomeUser"
// "txtEmailUser"
// "txtSenhaUser"
// "txtConfirmaSenhaUser"
// "slNivelUser"

        if ($this->form_validation->run() == FALSE) {
            $return = array(
                'code' => 2,
                'message' => validation_errors()
            );
        } else {
            $value = $this->input->post();
            $this->load->model('M_insert');
            $return = $this->M_insert->cadDepto($value);
        }
        echo json_encode($return);
    }

    ////////////////////////////////////////
    // DELETAR DEPARTAMENTO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                   
    ////////////////////////////////////////
    public function delDepto()
    {
        $id_departamento = $this->input->post('id_departamento');
        $this->load->model('M_delete');
        $return = $this->M_delete->delDepto($id_departamento);
        echo json_encode($return);
    }
}
