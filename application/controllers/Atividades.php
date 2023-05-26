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
        // $retorno['projetos'] = $this->M_retorno->retAllProjects();
        // $retorno['depto'] = $this->M_retorno->retDepto();
        // $retorno['usuarios'] = $this->M_retorno->retUsers();
        $this->load->view('includes/header');
        $this->load->view('includes/menu_sup');
        $this->load->view('v_atividades');
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
    // CADASTRO DE ATIVIDADES              
    // CRIADO POR MARCIO SILVA            
    // DATA: 25/05/2023                 
    ////////////////////////////////////////   
    public function cadAtividades()
    {
        $this->load->model('M_insert');
        $retorno = $this->M_insert->cadAtividades();
        echo json_encode($retorno);
    }
}
