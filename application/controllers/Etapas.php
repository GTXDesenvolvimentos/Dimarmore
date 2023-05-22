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
}
