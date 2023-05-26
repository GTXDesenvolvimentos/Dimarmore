<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends MY_Controller
{

    ////////////////////////////////////////
    // HOME PADRAO DE TAREFAS                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                   
    ////////////////////////////////////////  
    public function index()
    {

    }

    ////////////////////////////////////////
    // RETORNO DE ATIVIDADES              
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                 
    ////////////////////////////////////////   
    public function retUsers()
    {
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retUsers();
        echo json_encode($retorno);
    }
}
