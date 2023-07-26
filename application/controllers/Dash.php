<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class dash extends MY_Controller {

    ////////////////////////////////////////
    // HOME PADRAO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////    
    public function index() {
       $this->load->view('includes/header');
       $this->load->view('includes/menu_sup');
       $this->load->view('v_dash');
       $this->load->view('includes/footer');
       $this->load->view('includes/modal');
    }

    ////////////////////////////////////////
    // RETORNA DE DASHBOARD                
    // CRIADO POR MARCIO SILVA            
    // DATA: 08/02/2023                   
    ////////////////////////////////////////
    public function retDash()
    {
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retDash();
        echo json_encode($retorno);
    }



}