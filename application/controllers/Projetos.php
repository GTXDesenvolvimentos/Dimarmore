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

    public function retAllDeptos()
    {
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retAllProjects();
        echo json_encode($retorno);
    }


    public function cadProjeto()
    {
        //ar_dump($this->input->post());
        error_reporting(E_ERROR | E_PARSE);

        $files    = $_FILES['anexoProjeto'];
        $configuracao = array(
            "upload_path"   => "./assets/uploads/",
            'allowed_types' => 'jpg|png|gif|pdf|zip|rar|doc|xls|csv',
            'file_name'     => md5($files['name']).'.'.pathinfo($files['name'], PATHINFO_EXTENSION),
            'max_size'      => '500'
        );
        $this->load->library('upload');
        $this->upload->initialize($configuracao);
        if ($this->upload->do_upload('anexoProjeto')) {
            echo 'Arquivo salvo com sucesso.';
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
