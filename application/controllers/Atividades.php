<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Atividades extends MY_Controller
{

    ////////////////////////////////////////
    // HOME PADRAO DE TAREFAS                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                   
    ////////////////////////////////////////  
    public function index()
    {
        $this->load->model('M_retorno');
        $retorno['projetos'] = $this->M_retorno->retAllProjects();
        $retorno['depto'] = $this->M_retorno->retDepto();
        $retorno['usuarios'] = $this->M_retorno->retUsers();
        $this->load->view('includes/header');
        $this->load->view('includes/menu_sup');
        $this->load->view('v_atividades', $retorno);
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
        $retorno = $this->M_retorno->retAtividades();
        echo json_encode($retorno);
    }

    ////////////////////////////////////////
    // RETORNO DE DETALHE TAREFAS              
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                 
    ////////////////////////////////////////   
    public function retDetTarefas()
    {
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retTarefas('');
        $retornoLog = $this->M_retorno->retLogTarefas();
        $ret = array(
            "tarefas" => $retorno->result(),
            "logTarefas" => $retornoLog->result()
        );

        echo json_encode($ret);
    }

    ////////////////////////////////////////
    // RETORNO DE LOG DE TAREFAS              
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                 
    ////////////////////////////////////////   
    public function retlOGTarefas()
    {
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retTarefas();
        echo json_encode($retorno->result());
    }

    ////////////////////////////////////////
    // CADASTRAR TAREFAS
    // CRIADO POR MARCIO SILVA
    // DATA: 08/02/2023                   
    //////////////////////////////////////// 
    public function cadTarefas()
    {
        $this->load->library('upload');
        $this->form_validation->set_rules('slProjeto', 'Projeto', 'required');
        $this->form_validation->set_rules('txtNomeTarefa', 'Tarefa', 'required');
        $this->form_validation->set_rules('descricaoTarefa', 'Descrição da Tarefa', 'required');
        

        if ($this->form_validation->run() == FALSE) {
            $return[] = array(
                'ret' => 3,
                'msg' => validation_errors()
            );
        } else {
            if ($_FILES['file']['tmp_name'] != '') {
                $nomeImg = date('YmdHis') . $_FILES['file']['name'];
                $caminhoArquivo = './assets/uploads/' . $nomeImg;
                if (!move_uploaded_file($_FILES['file']['tmp_name'], $caminhoArquivo)) {
                    $return[] = array(
                        'cod' => 0,
                        'msg' => 'Tarefa cadastrada com sucesso!'
                    );
                }
            }else{
                $nomeImg = '';
            }  
          

            $id_departamento = $this->input->post('sldepto');
            $id_projeto = $this->input->post('slProjeto');
            $id_usuario = $this->input->post('slresp');
            $tarefa = $this->input->post('txtNomeTarefa');
            $situacao = '';
            $tarefa = $this->input->post('txtNomeTarefa');
            $descricao = $this->input->post('descricaoTarefa');
            $prioridade = $this->input->post('slprioridade');
            

            $tbl_tarefas = array(
                "id_departamento" => $id_departamento,
                "id_projeto" => $id_projeto,
                "id_usuario" => $id_usuario,
                "tarefa" => $tarefa,
                "descricao" => $descricao,
                "anexo" => $nomeImg,
                "prioridade" =>$prioridade,
                "situacao" => $situacao
            );

            $this->load->model('M_insert');
            $retorno = $this->M_insert->cadTarefa($tbl_tarefas);
            if ($retorno == 1) {
                $return[] = array(
                    'ret' => 1,
                    'msg' => 'Tarefa cadastrada com sucesso!'
                );
            } else {
                $return[] = array(
                    'ret' => 2,
                    'msg' => 'Alterada alterada com sucesso!'
                );
            }
        }
        echo json_encode($return);
    }


    ////////////////////////////////////////
    // CADASTRAR SITUAÇÃO DE  TAREFAS
    // CRIADO POR MARCIO SILVA
    // DATA: 08/02/2023                   
    //////////////////////////////////////// 
    public function cadSituacao()
    {
        $this->form_validation->set_rules('id_situacao', 'id_situacao', 'required');
        $this->form_validation->set_rules('situacaoTarefa', 'Descrição', 'required');
        $this->form_validation->set_rules('slSituacao', 'Descrição do status', 'required');


        if ($this->form_validation->run() == FALSE) {
            $return[] = array(
                'ret' => 3,
                'msg' => validation_errors()
            );
        } else {
            
            $id_situacao = $this->input->post('id_situacao');
            $descricao = $this->input->post('situacaoTarefa');
            $situacao = $this->input->post('slSituacao');


            $status = array(
                "id_tarefa" => $id_situacao,
                "data" => date('Y-m-d'),
                "descricao" => $descricao,
                "status" => $situacao
            );

            $dados = array(
                "id_tarefa" => $id_situacao,
                "descricao" => $descricao,
                "situacao" => $situacao,
            );

            $this->load->model('M_update');
            $this->load->model('M_insert');
            $retorno = $this->M_update->altSituacaoTarefa($dados);
            if ($retorno == 1) {
                $retorno = $this->M_insert->statusTarefa($status);
                $return[] = array(
                    'ret' => 1,
                    'msg' => 'Tarefa alterada com sucesso!'
                );
            } 
        }
        echo json_encode($return);
    }

    public function retAllProjects()
    {
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retAllProjects();
        echo json_encode($retorno);
    }

}
