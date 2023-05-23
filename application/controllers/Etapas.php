<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Etapas extends MY_Controller
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
        $this->load->view('v_etapas');
        $this->load->view('includes/modal');
        $this->load->view('includes/footer');
    }

    ////////////////////////////////////////
    // RETORNA DEPARTAMENTO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 08/02/2023                   
    ////////////////////////////////////////
    public function retEtapas()
    {
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retEtapas();
        echo json_encode($retorno->result());
    }

    public function retUsers()
    {
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retUsers();
        echo json_encode($retorno->result());
    }

    public function cadEtapa()
    {

        $this->load->library('form_validation');
        if ($this->input->post('txtIdDepto') !== '') {
            $this->form_validation->set_rules('txtNomeEtapa', 'Nome da etapa', 'required');
            $this->form_validation->set_rules('txtDescEtapa', 'Departamento', 'required');
            $this->form_validation->set_rules('txtEtaDtLimit', 'Data limite do projeto', 'required');
            $this->form_validation->set_rules('SlPrioridade', 'Prioridade', 'required');
            $this->form_validation->set_rules('SlResponsavel', 'Responsável', 'required');
        } else {
            $this->form_validation->set_rules('txtNomeEtapa', 'Código do departamento', 'required|is_unique[tbl_departamentos.cod_departamento]');
            $this->form_validation->set_rules('txtDescEtapa', 'Departamento', 'required|is_unique[tbl_departamentos.descricao]');
        }
        if ($this->form_validation->run() == FALSE) {
            $return = array(
                'code' => 2,
                'message' => validation_errors()
            );
        } else {
            $value = $this->input->post();
            $file = $_FILES;

            $config['upload_path']          = './uploads/imgEtapas/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100;
            $config['max_width']            = 1080;
            $config['max_height']           = 1920;

            $this->load->library('upload', $file);

            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());

                $this->load->view('upload_form', $error);
            } else {
                $data = array('upload_data' => $this->upload->data());

                $this->load->view('upload_success', $data);
            }


            echo "<pre>";
            print_r($data);
            echo "</pre>";
            exit();


            $this->load->model('M_insert');
            $return = $this->M_insert->cadEtapa($value);
        }
        echo json_encode($return);
    }
}
