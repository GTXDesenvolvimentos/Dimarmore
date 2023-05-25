<?php

defined('BASEPATH') or exit('No direct script access allowed');

class deptos extends MY_Controller
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
        $this->load->view('v_depto');
        $this->load->view('includes/modal');
        $this->load->view('includes/footer');
    }

    ////////////////////////////////////////
    // RETORNA DEPARTAMENTO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 08/02/2023                   
    ////////////////////////////////////////
    public function retDepto()
    {
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retDepto();
        echo json_encode($retorno->result());
    }

    ////////////////////////////////////////
    // CADASTRA DEPARTAMENTO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                   
    ////////////////////////////////////////
    public function cadDepto()
    {
        $this->load->library('form_validation');
        if ($this->input->post('txtIdDepto') !== '') {
            $this->form_validation->set_rules('txtCodDepto', 'Código do departamento', 'required');
            $this->form_validation->set_rules('txtDescDepto', 'Departamento', 'required');
        } else {
            $this->form_validation->set_rules('txtCodDepto', 'Código do departamento', 'required|is_unique[tbl_departamentos.cod_departamento]');
            $this->form_validation->set_rules('txtDescDepto', 'Departamento', 'required|is_unique[tbl_departamentos.descricao]');
        }

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
