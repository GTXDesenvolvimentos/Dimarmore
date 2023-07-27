<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tarefas extends MY_Controller
{

    ////////////////////////////////////////
    // HOME PADRAO DE TAREFAS                     
    // CRIADO POR ELIEL FELIX
    // DATA: 27/07/2023                   
    ////////////////////////////////////////  
    public function index()
    {
        $this->load->model('M_retorno');
        $this->load->view('includes/header');
        $this->load->view('includes/menu_sup');
        $this->load->view('v_tarefas');
        $this->load->view('includes/modal');
        $this->load->view('includes/footer');
    }

    
    ////////////////////////////////////////
    // RETORNA DASHBOARD DE TAREFAS                 
    // CRIADO POR ELIEL FELIX 
    // DATA: 27/07/2023                   
    ////////////////////////////////////////
    
    public function retTarefas()
    {
        // $dados = [[
        //     'anexoAtividade' => "8da5c3ebae5f1f3fb14cac9606625e2d.jpg",
        //     'anexoEtapa' => null,
        //     'anexoProjeto' => "fb249c2cd7add04d305527baec71a03e.jpg",
        //     'atividade' => "Atividade teste 01 - Descrião da atividade teste 01",
        //     'codDepartamento' => "0001",
        //     'descrAtividade' => "Descrião da atividade teste 01",
        //     'descrDepartamento' => "Dep. teste 01",
        //     'descrEtapa' => "Descrição da etapa teste 01",
        //     'descrPropjeto' => "Descrição do projeto teste 01",
        //     'dtEntregaAtividade' => "18/06/2023",
        //     'dtEntregaAtividadeE' => "2023-06-18",
        //     'dtEntregaEtapa' => "30/06/2023",
        //     'dtEntregaEtapaE' => "2023-06-30",
        //     'dtEntregaProjeto' => "28/07/2023",
        //     'dtEntregaProjetoE' => "2023-07-28",
        //     'dtcria' => "18/06/2023",
        //     'dtcriaAtividade' => "2023-06-18 15:47:33",
        //     'dtcriaEtapa' => "2023-06-18 15:46:43",
        //     'dtfimProjeto' => null,
        //     'etapa' => "Etapa teste 01 - Descrição da etapa teste 01",
        //     'idResponsavel' => "39",
        //     'id_atividade' => "123",
        //     'id_departamento' => "78",
        //     'id_etapa' => "134",
        //     'id_projeto' => "195",
        //     'id_responsavel' => "44",
        //     'nomeAtividade' => "Atividade teste 01",
        //     'nomeEtapa' => "Etapa teste 01",
        //     'nomeProjeto' => "Projeto teste 01",
        //     'nomeResponsavel' => "Marcio Batista da Silva",
        //     'priorAtividade' => "",
        //     'priorEtapa' => "10",
        //     'projeto' => "Projeto teste 01 - Descrição do projeto teste 01",
        //     'respAtividade' => "39",
        //     'respEtapa' => "0",
        //     'sitAtividade' => "R",
        //     'sitEtapa' => "P",
        //     'situacaoPropjeto' => "P",
        //     'statusAtividade' => "",
        //     'statusEtapa' => "",
        //     'statusPropjeto' => "",
        //     'usucriaAtividade' => "39",
        //     'usucriaEtapa' => "44",
        //     'usucriaPropjeto' => "39"
        // ]];

        // echo json_encode($dados);

        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retTarefas();
        echo json_encode($retorno);
    }
}
