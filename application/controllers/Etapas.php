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


    public function retProjeto()
    {
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retProjeto();
        echo json_encode($retorno->result());
    }

    public function cadEtapa()
    {
        error_reporting(E_ERROR | E_PARSE);

        $value = $this->input->post();

        if ($value['txtIdEtapa'] == '') {
            $files    = $_FILES['anexoEtapa'];
            $nameFil = md5($files['name']) . '.' . pathinfo($files['name'], PATHINFO_EXTENSION);

            $configuracao = array(
                "upload_path"   => "./assets/uploads/imgEtapas/",
                'allowed_types' => 'jpg|jpeg|png|gif|pdf|zip|rar|doc|xls|csv',
                'file_name'     => $nameFil,
                'max_size'      => '500'
            );

            $value['anexo'] = $nameFil;

            $this->load->library('upload');
            $this->upload->initialize($configuracao);
            if ($this->upload->do_upload('anexoEtapa')) {
                $this->load->model('M_insert');
                $return = $this->M_insert->cadEtapa($value);
            } else {

                $return = array(
                    'code' => 2,
                    'message' =>  trim($this->upload->display_errors())
                );
            }
        } else {
            $this->load->model('M_insert');
            $return = $this->M_insert->cadEtapa($value);
        }
        echo json_encode($return);
    }

    ////////////////////////////////////////
    // DELETAR DEPARTAMENTO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                   
    ////////////////////////////////////////
    public function delEtapa()
    {
        $id_etapas = $this->input->post('id_etapa');
        $this->load->model('M_delete');
        $return = $this->M_delete->delEtapa($id_etapas);
        echo json_encode($return);
    }
}
