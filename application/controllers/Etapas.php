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

    public function cadEtapa()
    {
        error_reporting(E_ERROR | E_PARSE);

        $files    = $_FILES['anexoEtapa'];
        $value = $this->input->post();

        $nameFil = md5($files['name']) . '.' . pathinfo($files['name'], PATHINFO_EXTENSION);

        $configuracao = array(
            "upload_path"   => "./assets/uploads/imgEtapas/",
            'allowed_types' => 'jpg|jpeg|png|gif|pdf|zip|rar|doc|xls|csv',
            'file_name'     => $nameFil,
            'max_size'      => '500'
        );

        $value['anexo'] = $nameFil;

        $this->load->library('upload');
        $this->upload->initialize($configuracao);
        if ($this->upload->do_upload('anexoEtapa')) {
            $this->load->model('M_insert');
            $return = $this->M_insert->cadEtapa($value);
        } else {

            $return = array(
                'code' => 2,
                'message' =>  trim($this->upload->display_errors())
            );
        }

        echo json_encode($return);
    }


    // Método que fará o download do arquivo
    public function Download()
    {
        // recuperamos o terceiro segmento da url, que é o nome do arquivo
        $arquivo = $this->uri->segment(3);
        // recuperamos o segundo segmento da url, que é o diretório
        $diretorio = $this->uri->segment(2);
        // definimos original path do arquivo
        $arquivoPath = '.assets/uploads/' . $diretorio . "/" . $arquivo;

        // forçamos o download no browser
        // passando como parâmetro o path original do arquivo
        force_download($arquivoPath, null);
    }
}
