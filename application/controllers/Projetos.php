<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Projetos extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library(['form_validation', 'session']);
        $this->load->database();
    }

    ////////////////////////////////////////
    // FUNÇÃO PRINCIPAL INDEX                 
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                   
    ////////////////////////////////////////
    public function index()
    {
        $this->load->model('m_retorno');
        $return['usuarios'] = $this->m_retorno->retUsers();
        $return['deptos'] = $this->m_retorno->retDepto();
        $this->load->view('includes/header');
        $this->load->view('includes/menu_sup');
        $this->load->view('v_projetos', $return);
        $this->load->view('includes/modal');
        $this->load->view('includes/footer');
    }

    ////////////////////////////////////////
    // FUNÇÃO DE RETORNO PROJETOS           
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                   
    ////////////////////////////////////////
    public function retAllProjects()
    {
        $id_departamento = $this->input->post('id_departamento');
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retAllProjects($id_departamento,'','');
        echo json_encode($retorno);
    }

    ////////////////////////////////////////
    // FUNÇÃO DE CADASTRO PROJETOS     
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                   
    ////////////////////////////////////////
    public function cadProjeto()
    {
        $files = $_FILES['anexoProjeto'];
        if ($_FILES['anexoProjeto']['tmp_name'] !== '') {
            $anexo = md5($files['name']) . '.' . pathinfo($files['name'], PATHINFO_EXTENSION);
            $configuracao = array(
                "upload_path"   => "./assets/uploads/",
                'allowed_types' => 'jpg|png|gif|pdf|jpeg',
                'file_name'     => $anexo,
                'max_size'      => '500'
            );
            $this->load->library('upload');
            $this->upload->initialize($configuracao);
            if ($this->upload->do_upload('anexoProjeto')) {
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
        if ($this->input->post('txtIdProjeto') !== '') {
            $this->form_validation->set_rules('txtNomeProjeto', 'Nome do projeto', 'required');
            $this->form_validation->set_rules('txtDescProjeto', 'Descrição', 'required');
        } else {
            $this->form_validation->set_rules('txtNomeProjeto', 'Nome do projeto', 'required|is_unique[tbl_projetos.nome]');
            $this->form_validation->set_rules('txtDescProjeto', 'Descrição', 'required');
            $this->form_validation->set_rules('slRespProjeto', 'Responsável', 'required');
            $this->form_validation->set_rules('slDepProjeto', 'Departamento', 'required');
            $this->form_validation->set_rules('txtDataFimProjeto', 'Data', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $return = array(
                'code' => 2,
                'message' => validation_errors()
            );
        } else {
            if ($this->input->post("txtIdProjeto") !== '') {
                if ($_FILES['anexoProjeto']['tmp_name'] !== '') {
                    $dados = array(
                        "nome" => $this->input->post("txtNomeProjeto"),
                        "descricao" => $this->input->post("txtDescProjeto"),
                        "responsavel" => $this->input->post("slRespProjeto"),
                        "id_departamento" => $this->input->post("slDepProjeto"),
                        "dtentrega" => $this->input->post("txtDataFimProjeto"),
                        "anexo" => $anexo,
                        "usucria" => $this->session->userdata('id_users')
                    );
                } else {
                    $dados = array(
                        "nome" => $this->input->post("txtNomeProjeto"),
                        "descricao" => $this->input->post("txtDescProjeto"),
                        "responsavel" => $this->input->post("slRespProjeto"),
                        "id_departamento" => $this->input->post("slDepProjeto"),
                        "dtentrega" => $this->input->post("txtDataFimProjeto"),
                        "usucria" => $this->session->userdata('id_users')
                    );
                }
            } else {
                $dados = array(
                    "id_projeto" => $this->input->post("txtIdProjeto"),
                    "nome" => $this->input->post("txtNomeProjeto"),
                    "descricao" => $this->input->post("txtDescProjeto"),
                    "responsavel" => $this->input->post("slRespProjeto"),
                    "id_departamento" => $this->input->post("slDepProjeto"),
                    "anexo" => $anexo,
                    "dtentrega" => $this->input->post("txtDataFimProjeto"),
                    "usucria" => $this->session->userdata('id_users')
                );
            }
            $value = $this->input->post();
            $this->load->model('M_insert');
            $return = $this->M_insert->cadProjeto($dados);
        }
        echo json_encode($return);
    }

    ////////////////////////////////////////
    // DELETAR PROJETO        
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                   
    ////////////////////////////////////////
    public function delProjeto()
    {
        $id_projeto = $this->input->post('id_projeto');
        $this->load->model('M_delete');
        $return = $this->M_delete->delProjeto($id_projeto);
        echo json_encode($return);
    }
}
