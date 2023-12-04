<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{

    ////////////////////////////////////////
    // HOME PADRAO DE TAREFAS                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                   
    ////////////////////////////////////////  
    public function index()
    {

        // echo '<pre>';
        // print_r($_SESSION);
        // echo '</pre>';
        // exit;

        $variables['nivel'] = $this->session->userdata('nivel');

        $this->load->model('M_retorno');
        $this->load->view('includes/header');
        $this->load->view('includes/menu_sup');
        $this->load->view('v_home', $variables);
        $this->load->view('includes/modal');
        $this->load->view('includes/footer');
    }

    ////////////////////////////////////////
    // RETORNO DE ATIVIDADES              
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                 
    ////////////////////////////////////////   
    public function retAtividades()
    {
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retAtividades('', '', '', '', $this->session->userdata('id_users'));
        echo json_encode($retorno);
    }

    ////////////////////////////////////////
    // CADASTRO DE ATIVIDADES              
    // CRIADO POR MARCIO SILVA            
    // DATA: 25/05/2023                 
    ////////////////////////////////////////   
    public function cadAtividades()
    {
        $files = $_FILES['anexoAtividade'];
        if ($_FILES['anexoAtividade']['tmp_name'] !== '') {
            $anexo = md5($files['name'] . date('dmYHis')) . '.' . pathinfo($files['name'], PATHINFO_EXTENSION);
            $configuracao = array(
                "upload_path"   => "./assets/uploads/",
                'allowed_types' => 'jpg|png|gif|pdf|jpeg',
                'file_name'     => $anexo,
                'max_size'      => '500'
            );
            $this->load->library('upload');
            $this->upload->initialize($configuracao);
            if ($this->upload->do_upload('anexoAtividade')) {
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
        if ($this->input->post('txtIdAtividade') !== '') {
            $this->form_validation->set_rules('txtNomeAtividade', 'Nome da atividade', 'required');
            $this->form_validation->set_rules('txtDescAtividade', 'Descrição', 'required');
            $this->form_validation->set_rules('slAtivDepto', 'Departamento', 'required');
            $this->form_validation->set_rules('slAtivProjeto', 'Projeto', 'required');
            $this->form_validation->set_rules('slAtivEtapas', 'Etapa', 'required');
        } else {
            $this->form_validation->set_rules('txtNomeAtividade', 'Nome da atividade', 'required|is_unique[tbl_etapas.etapa]');
            $this->form_validation->set_rules('txtDescAtividade', 'Descrição', 'required');
            $this->form_validation->set_rules('slRespAtividade', 'Responsável', 'required');
            $this->form_validation->set_rules('slAtivDepto', 'Departamento', 'required');
            $this->form_validation->set_rules('slAtivProjeto', 'Projeto', 'required');
            $this->form_validation->set_rules('slAtivEtapas', 'Etapa', 'required');
            $this->form_validation->set_rules('txtDataFimAtividade', 'Data', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $return = array(
                'code' => 2,
                'message' => validation_errors()
            );
        } else {
            if ($this->input->post("txtIdAtividade") !== '') {
                if ($_FILES['anexoAtividade']['tmp_name'] !== '') {
                    $dados = array(
                        "id_atividade" => $this->input->post("txtIdAtividade"),
                        "id_etapa" => $this->input->post("slAtivEtapas"),
                        "atividade" => $this->input->post("txtNomeAtividade"),
                        "descricao" => $this->input->post("txtDescAtividade"),
                        "prioridade" => '',
                        "responsavel" => $this->input->post("slRespAtividade"),
                        "situacao" => $this->input->post("slAtivStatus"),
                        "data_fim" => $this->input->post("txtDataFimAtividade"),
                        "anexo" => $anexo,
                        "usucria" => $this->session->userdata('id_users')
                    );
                } else {
                    $dados = array(
                        "id_atividade" => $this->input->post("txtIdAtividade"),
                        "id_etapa" => $this->input->post("slAtivEtapas"),
                        "atividade" => $this->input->post("txtNomeAtividade"),
                        "descricao" => $this->input->post("txtDescAtividade"),
                        "prioridade" => '',
                        "responsavel" => $this->input->post("slRespAtividade"),
                        "situacao" => $this->input->post("slAtivStatus"),
                        "data_fim" => $this->input->post("txtDataFimAtividade"),
                        "usucria" => $this->session->userdata('id_users')
                    );
                }
            } else {
                $dados = array(
                    "id_atividade" => $this->input->post("txtIdAtividade"),
                    "id_etapa" => $this->input->post("slAtivEtapas"),
                    "atividade" => $this->input->post("txtNomeAtividade"),
                    "descricao" => $this->input->post("txtDescAtividade"),
                    "prioridade" => '',
                    "responsavel" => $this->input->post("slRespAtividade"),
                    "situacao" => $this->input->post("slAtivStatus"),
                    "data_fim" => $this->input->post("txtDataFimAtividade"),
                    "anexo" => $anexo,
                    "usucria" => $this->session->userdata('id_users')
                );
            }
            $this->load->model('M_insert');
            $return = $this->M_insert->cadAtividades($dados);
        }
        echo json_encode($return);
    }

    /////////////////////////////////////////
    // ALTERAÇÃO DE STATUS DE ATIVIDADE
    // CRIADO POR ELIEL AMORIM            
    // DATA: 31/05/2023                 
    ////////////////////////////////////////  
    public function altsituacao()
    {
        $form = $this->input->post();

        $files = $_FILES['anexoLogAtividade'];
        if ($_FILES['anexoLogAtividade']['tmp_name'] !== '') {
            $anexo = md5($files['name'] . date('dmYHis')) . '.' . pathinfo($files['name'], PATHINFO_EXTENSION);
            $configuracao = array(
                "upload_path"   => "./assets/uploads/",
                'allowed_types' => 'jpg|png|gif|pdf|jpeg',
                'file_name'     => $anexo,
                'max_size'      => '500'
            );
            $this->load->library('upload');
            $this->upload->initialize($configuracao);
            if ($this->upload->do_upload('anexoLogAtividade')) {
            } else {
                $return = array(
                    'code' => 2,
                    'message' =>  trim($this->upload->display_errors())
                );
                echo json_encode($return);
                exit();
            }
        }

        $dados = [
            "id_atividade" => $form['id_atividade'],
            "movimento"    => "",
            "anexo"        => isset($anexo) ? $anexo : '',
            "descricao"    => $form['txtLogDescAtividade'],
            "data"         => date('Y-m-d'),
            "dtcria"       => date('Y-m-d H:i:s'),
            "status_mov"   => $form['slAltSituacao']
        ];

        $this->load->model('M_insert');
        $retorno = $this->M_insert->altsituacao($dados);
        echo json_encode($retorno);
    }

    function buscaHistorico()
    {
        $form = $this->input->post();

        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->buscaHistorico($form);
        echo json_encode($retorno);
    }

    ////////////////////////////////////////
    // RETORNO DE ATIVIDADES FILTRADAS              
    // CRIADO POR ELIEL FELIX            
    // DATA: 29/11/2023                 
    ////////////////////////////////////////   
    public function filtro()
    {
        $filtro = $this->input->post('tipo');
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->filtro($filtro);
        echo json_encode($retorno);
    }

    public function excluir()
    {
        $id = $this->input->post('id_ativ');
        $this->load->model('M_delete');
        $retorno = $this->M_delete->delAtividade($id);
        echo json_encode($retorno);
    }
}
