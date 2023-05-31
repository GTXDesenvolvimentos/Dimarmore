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

        //"txtIdUser"
        //"txtNomeUser"
        //"txtEmailUser"
        //"txtSenhaUser"
        //"txtConfirmaSenhaUser"
        //"slNivelUser"
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
                        "responsavel" => $this->input->post("slEtapResponsavel"),
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
                        "responsavel" => $this->input->post("slEtapResponsavel"),
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
                    "responsavel" => $this->input->post("slEtapResponsavel"),
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
    public function delDepto()
    {
        $id_departamento = $this->input->post('id_departamento');
        $this->load->model('M_delete');
        $return = $this->M_delete->delDepto($id_departamento);
        echo json_encode($return);
    }
}
