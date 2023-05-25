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

    public function retAllProjects()
    {
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retAllProjects();
        echo json_encode($retorno);
    }


    public function cadProjeto()
    {
        $files = $_FILES['anexoProjeto'];
        $anexo = '';
        if ($_FILES['anexoProjeto']['tmp_name'] !== '') {
            $anexo = md5($files['name']) . '.' . pathinfo($files['name'], PATHINFO_EXTENSION);
            $configuracao = array(
                "upload_path"   => "./assets/uploads/",
                'allowed_types' => 'jpg|png|gif|pdf',
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
            $this->form_validation->set_rules('txtNomeProjeto', 'Nome do projeto', 'required|is_unique[tbl_departamentos.cod_departamento]');
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

            $value = $this->input->post();
            $this->load->model('M_insert');
            $return = $this->M_insert->cadProjeto($dados);
        }
        echo json_encode($return);
    }


}
