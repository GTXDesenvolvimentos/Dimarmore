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
    // RETORNA ETAPAS                
    // CRIADO POR MARCIO SILVA            
    // DATA: 08/02/2023                   
    ////////////////////////////////////////
    public function retEtapas()
    {
        $id_projeto = $this->input->post('id_projeto');
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retEtapas('','',$id_projeto,'');
        echo json_encode($retorno->result());
    }


    public function cadEtapa()
    {

        $anexo = null;
        $files = $_FILES['anexoEtapa'];
        if ($_FILES['anexoEtapa']['tmp_name'] !== '') {
            $anexo = md5($files['name']) . '.' . pathinfo($files['name'], PATHINFO_EXTENSION);
            $configuracao = array(
                "upload_path"   => "./assets/uploads/",
                'allowed_types' => 'jpg|png|gif|pdf|jpeg',
                'file_name'     => $anexo,
                'max_size'      => '500'
            );
            $this->load->library('upload');
            $this->upload->initialize($configuracao);
            if ($this->upload->do_upload('anexoEtapa')) {
            } else {
                $return = array(
                    'code' => 2,
                    'message' =>  trim($this->upload->display_errors())
                );
                echo json_encode($return);
                exit();
            }
        }

        $this->load->library('form_validation');
        if ($this->input->post('txtIdEtapa') !== '') {
            $this->form_validation->set_rules('txtNomeEtapa', 'Nome da etapa', 'required');
            $this->form_validation->set_rules('txtDescEtapa', 'Descrição', 'required');
        } else {
            $this->form_validation->set_rules('txtNomeEtapa', 'Nome da etapa', 'required|is_unique[tbl_etapas.etapa]');
            $this->form_validation->set_rules('txtDescEtapa', 'Descrição', 'required');
            $this->form_validation->set_rules('SlEtaPrioridade', 'Responsável', 'required');
            // $this->form_validation->set_rules('slEtapResponsavel', 'Responsável', 'required');
            $this->form_validation->set_rules('slEtapProjeto', 'Departamento', 'required');
            $this->form_validation->set_rules('txtEtaDtLimit', 'Data', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $return = array(
                'code' => 2,
                'message' => validation_errors()
            );
        } else {
            if ($this->input->post("txtIdEtapa") !== '') {
                if ($_FILES['anexoEtapa']['tmp_name'] !== '') {
                    $dados = array(
                        "id_projeto" => $this->input->post("slEtapProjeto"),
                        "etapa" => $this->input->post("txtNomeEtapa"),
                        "descricao" => $this->input->post("txtDescEtapa"),
                        "prioridade" => $this->input->post("SlEtaPrioridade"),
                        "responsavel" => '',
                        "situacao" => $this->input->post("SlEtapaStatus"),
                        "data_fim" => $this->input->post("txtEtaDtLimit"),
                        "anexo" => $anexo,
                        "usucria" => $this->session->userdata('id_users')
                    );
                } else {
                    $dados = array(
                        "id_projeto" => $this->input->post("slEtapProjeto"),
                        "etapa" => $this->input->post("txtNomeEtapa"),
                        "descricao" => $this->input->post("txtDescEtapa"),
                        "prioridade" => $this->input->post("SlEtaPrioridade"),
                        "responsavel" => '',
                        "situacao" => $this->input->post("SlEtapaStatus"),
                        "data_fim" => $this->input->post("txtEtaDtLimit"),
                        "usucria" => $this->session->userdata('id_users')
                    );
                }
            } else {
                $dados = array(
                    "id_etapa" => $this->input->post("txtIdEtapa"),
                    "id_projeto" => $this->input->post("slEtapProjeto"),
                    "etapa" => $this->input->post("txtNomeEtapa"),
                    "descricao" => $this->input->post("txtDescEtapa"),
                    "prioridade" => $this->input->post("SlEtaPrioridade"),
                    "responsavel" => '',
                    "situacao" => $this->input->post("SlEtapaStatus"),
                    "data_fim" => $this->input->post("txtEtaDtLimit"),
                    "anexo" => $anexo,
                    "usucria" => $this->session->userdata('id_users')
                );
            }
            $this->load->model('M_insert');
            $return = $this->M_insert->cadEtapa($dados);
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

    public function imgEtapa()
    {
        $etapas = $this->input->post('id_etapa');
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->imgEtapa($etapas);
        echo json_encode($retorno->result());
    }
}
