
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_retorno extends CI_Model
{
    ////////////////////////////////////////
    // RETORNO DE LOGIN                   //
    // CRIADO POR MARCIO SILVA            //
    // DATA: 31/05/2019                   //
    ////////////////////////////////////////
    public function login($dados)
    {
        $this->db->where('usuario', $dados['email']);
        $this->db->where('senha', md5($dados['password']));
        $this->db->where('A.status !=', 'D');
        $retorno = $this->db->get('tbl_users A');

        if ($retorno->num_rows() > 0) {
            $this->session->set_userdata("id_users", $retorno->row()->id_users);
            $this->session->set_userdata("nome", $retorno->row()->nome);
            $this->session->set_userdata("nivel", $retorno->row()->nivel);
            $this->session->set_userdata("status", $retorno->row()->status);
            $this->session->set_userdata("logado", 1);
            return true;
        } else {
            return false;
        }
    }


    ////////////////////////////////////////
    // RETORNO DE USUARIOS                //
    // CRIADO POR MARCIO SILVA            //
    // DATA: 22/05/2022                   //
    ////////////////////////////////////////
    public function retUsers()
    {
        $this->db->select('id_users, nome, registro, usuario, nivel, status, DATE_FORMAT(dtcria, "%d/%m/%Y")');
        $this->db->where('status != "D"');
        $retorno = $this->db->get('tbl_users');

        return $retorno->result();
    }


    ////////////////////////////////////////
    // RETORNO DE DEPARTAMENTOS           //
    // CRIADO POR MARCIO SILVA            //
    // DATA: 31/05/2019                   //
    ////////////////////////////////////////
    public function retDepto()
    {
        $this->db->select('*');
        $this->db->select("DATE_FORMAT(dtcria, '%d/%m/%Y') AS dtcria", FALSE);
        $this->db->where('status !=', 'D');
        $retorno = $this->db->get('tbl_departamentos');
        return $retorno;
    }

    ////////////////////////////////////////
    // RETORNO DE TODOS OS PROJETOS       //
    // CRIADO POR ???                     //
    // DATA: 22/05/2023                   //
    ////////////////////////////////////////
    public function retAllProjects($id_departamento = null, $id_projeto = null, $responsavel = null)
    {
        //RETORNO DE TABELA PROJETOS
        $this->db->select('A.id_projeto as id_projeto');
        $this->db->select('A.id_departamento as id_departamento');
        $this->db->select('A.responsavel as id_responsavel');
        $this->db->select('A.nome as nomeProjeto');
        $this->db->select("DATE_FORMAT(A.dtentrega, '%d/%m/%Y') AS dtEntregaProjeto", FALSE);
        $this->db->select("A.dtentrega AS dtEntregaProjetoE", FALSE);
        $this->db->select('A.descricao as descrPropjeto');
        $this->db->select('A.data_fim as dtfimProjeto');
        $this->db->select('A.anexo as anexoProjeto');
        $this->db->select('A.usucria as usucriaPropjeto');
        $this->db->select('A.situacao as situacaoPropjeto');
        $this->db->select('A.status as statusPropjeto');
        $this->db->select("DATE_FORMAT(A.dtcria, '%d/%m/%Y') AS dtcria", FALSE);
        //RETORNO DE TABELA DEPARTAMENTOS
        $this->db->select('B.cod_departamento as codDepartamento');
        $this->db->select('B.descricao as descrDepartamento');
        //RETORNO DE TABELA USERS - RESPONSÁVEL
        $this->db->select('C.id_users as idResponsavel');
        $this->db->select('C.nome as nomeResponsavel');
        //PARAMETROS DE CONSULTAS
        isset($id_departamento) == true && $id_departamento != '' ? $this->db->where('B.id_departamento', $id_departamento) : '';
        isset($id_projeto) == true && $id_projeto != '' ? $this->db->where('A.id_projeto', $id_projeto) : '';
        isset($responsavel) == true && $responsavel != '' ? $this->db->where('A.responsavel', $responsavel) : '';
        $this->db->join("tbl_users C", "A.responsavel = C.id_users", "inner");
        $this->db->join("tbl_departamentos B", "A.id_departamento = B.id_departamento", "inner");
        $this->db->where('A.status !=', 'D');
        $retorno = $this->db->get('tbl_projetos A');
        return $retorno->result();
    }


    ////////////////////////////////////////
    // RETORNO DE ETAPAS                  //
    // CRIADO POR MARCIO SILVA            //
    // DATA: 22/05/2022                   //
    ////////////////////////////////////////
    public function retEtapas($id_etapa = null, $id_departamento = null, $id_projeto = null, $responsavel = null)
    {

        //RETORNO DE TABELA ETAPAS
        $this->db->select('A.id_etapa as id_etapa');
        $this->db->select('A.etapa as nomeEtapa');
        $this->db->select('A.descricao as descrEtapa');
        $this->db->select('A.prioridade as priorEtapa');
        $this->db->select('A.situacao as sitEtapa');
        $this->db->select('A.anexo as anexoEtapa');
        $this->db->select('A.dtcria as dtcriaEtapa');
        $this->db->select('A.status as statusEtapa');
        $this->db->select('A.usucria as usucriaEtapa');
        $this->db->select('A.data_fim as dtEntregaEtapaE');
        $this->db->select("DATE_FORMAT(A.data_fim, '%d/%m/%Y') AS dtEntregaEtapa", FALSE);
        //RETORNO DE TABELA PROJETOS
        $this->db->select('B.id_projeto as id_projeto');
        $this->db->select('B.id_departamento as id_departamento');
        $this->db->select('B.responsavel as id_responsavel');
        $this->db->select('B.nome as nomeProjeto');
        $this->db->select("DATE_FORMAT(B.dtentrega, '%d/%m/%Y') AS dtEntregaProjeto", FALSE);
        $this->db->select("B.dtentrega AS dtEntregaProjetoE", FALSE);
        $this->db->select('B.descricao as descrPropjeto');
        $this->db->select('B.data_fim as dtfimProjeto');
        $this->db->select('B.anexo as anexoProjeto');
        $this->db->select('B.usucria as usucriaPropjeto');
        $this->db->select('B.situacao as situacaoPropjeto');
        $this->db->select('B.status as statusPropjeto');
        $this->db->select("DATE_FORMAT(A.dtcria, '%d/%m/%Y') AS dtcria", FALSE);
        //RETORNO DE TABELA DEPARTAMENTOS
        $this->db->select('C.cod_departamento as codDepartamento');
        $this->db->select('C.descricao as descrDepartamento');
        //PARAMETROS DE CONSULTAS
        isset($id_departamento) == true && $id_departamento != '' ? $this->db->where('C.id_departamento', $id_departamento) : '';
        isset($id_projeto) == true && $id_projeto != '' ? $this->db->where('A.id_projeto', $id_projeto) : '';
        isset($responsavel) == true && $responsavel != '' ? $this->db->where('A.responsavel', $responsavel) : '';
        isset($id_etapa) == true && $id_etapa != '' ? $this->db->where('A.id_etapa', $id_etapa) : '';
        $this->db->join("tbl_projetos B", "A.id_projeto = B.id_projeto", "inner");
        $this->db->join("tbl_departamentos C", "B.id_departamento = C.id_departamento", "inner");
        $this->db->where('A.status !=', 'D');
        $retorno = $this->db->get('tbl_etapas A');
        return $retorno;
    }



    ////////////////////////////////////////
    // RETORNO DE TODOS OS ATIVIDADES     //
    // DATA: 22/05/2023                   //
    ////////////////////////////////////////
    public function retAtividades($id_atividade = null, $id_etapa = null, $id_departamento = null, $id_projeto = null, $responsavel = null)
    {
        //RETORNO DE TABELA ATIVIDADE
        $this->db->select('A.id_atividade id_atividade');
        $this->db->select('A.atividade as nomeAtividade, CONCAT(CONCAT(A.atividade, " - "), A.descricao) as atividade');
        $this->db->select('A.descricao as descrAtividade');
        $this->db->select('A.prioridade as priorAtividade');
        $this->db->select('A.responsavel as respAtividade');
        $this->db->select('A.situacao as sitAtividade');
        $this->db->select('A.anexo as anexoAtividade');
        $this->db->select('A.dtcria as dtcriaAtividade');
        $this->db->select('A.status as statusAtividade');
        $this->db->select('A.usucria as usucriaAtividade');
        $this->db->select('A.data_fim as dtEntregaAtividadeE');
        $this->db->select("DATE_FORMAT(A.data_fim, '%d/%m/%Y') AS dtEntregaAtividade", FALSE);
        //RETORNO DE TABELA ETAPAS
        $this->db->select('E.id_etapa as id_etapa');
        $this->db->select('E.etapa as nomeEtapa, CONCAT(CONCAT(E.etapa, " - "), E.descricao) as etapa');
        $this->db->select('E.descricao as descrEtapa');
        $this->db->select('E.prioridade as priorEtapa');
        $this->db->select('E.responsavel as respEtapa');
        $this->db->select('E.situacao as sitEtapa');
        $this->db->select('E.anexo as anexoEtapa');
        $this->db->select('E.dtcria as dtcriaEtapa');
        $this->db->select('E.status as statusEtapa');
        $this->db->select('E.usucria as usucriaEtapa');
        $this->db->select('E.data_fim as dtEntregaEtapaE');
        $this->db->select("DATE_FORMAT(E.data_fim, '%d/%m/%Y') AS dtEntregaEtapa", FALSE);
        //RETORNO DE TABELA PROJETOS
        $this->db->select('B.id_projeto as id_projeto');
        $this->db->select('B.id_departamento as id_departamento');
        $this->db->select('B.responsavel as id_responsavel');
        $this->db->select('B.nome as nomeProjeto, CONCAT(CONCAT(B.nome , " - "), B.descricao) as projeto');
        $this->db->select("DATE_FORMAT(B.dtentrega, '%d/%m/%Y') AS dtEntregaProjeto", FALSE);
        $this->db->select("B.dtentrega AS dtEntregaProjetoE", FALSE);
        $this->db->select('B.descricao as descrPropjeto');
        $this->db->select('B.data_fim as dtfimProjeto');
        $this->db->select('B.anexo as anexoProjeto');
        $this->db->select('B.usucria as usucriaPropjeto');
        $this->db->select('B.situacao as situacaoPropjeto');
        $this->db->select('B.status as statusPropjeto');
        $this->db->select("DATE_FORMAT(A.dtcria, '%d/%m/%Y') AS dtcria", FALSE);
        //RETORNO DE TABELA DEPARTAMENTOS
        $this->db->select('C.id_departamento as id_departamento');
        $this->db->select('C.cod_departamento as codDepartamento');
        $this->db->select('C.descricao as descrDepartamento');
        //RETORNO DE TABELA USERS - RESPONSÁVEL
        $this->db->select('D.id_users as idResponsavel');
        $this->db->select('D.nome as nomeResponsavel');
        //PARAMETROS DE CONSULTAS
        isset($id_departamento) == true && $id_departamento != '' ? $this->db->where('C.id_departamento', $id_departamento) : '';
        isset($id_projeto) == true && $id_projeto != '' ? $this->db->where('A.id_projeto', $id_projeto) : '';
        isset($responsavel) == true && $responsavel != '' ? $this->db->where('A.responsavel', $this->session->userdata('id_users')) : '';
        isset($id_etapa) == true && $id_etapa != '' ? $this->db->where('A.id_etapa', $id_etapa) : '';
        $this->db->join("tbl_etapas E", "A.id_etapa = E.id_etapa", "inner");
        $this->db->join("tbl_users D", "A.responsavel = D.id_users", "inner");
        $this->db->join("tbl_projetos B", "B.id_projeto = E.id_projeto", "inner");
        $this->db->join("tbl_departamentos C", "B.id_departamento = C.id_departamento", "inner");
        $this->db->where('A.status !=', 'D');
        $this->db->order_by("A.data_fim", "asc");
        $retorno = $this->db->get('tbl_atividades A');
        return $retorno->result();
    }


    ////////////////////////////////////////
    // RETORNO DE TODOS OS ATIVIDADES     //
    // DATA: 22/05/2023                   //
    ////////////////////////////////////////
    public function retDash()
    {
        //RETORNO DE TABELA ATIVIDADE
        $this->db->select('A.id_atividade id_atividade');
        $this->db->select('A.atividade as nomeAtividade, CONCAT(CONCAT(A.atividade, " - "), A.descricao) as atividade');
        $this->db->select('A.descricao as descrAtividade');
        $this->db->select('A.prioridade as priorAtividade');
        $this->db->select('A.responsavel as respAtividade');
        $this->db->select('A.situacao as sitAtividade');
        $this->db->select('A.anexo as anexoAtividade');
        $this->db->select('A.dtcria as dtcriaAtividade');
        $this->db->select('A.status as statusAtividade');
        $this->db->select('A.usucria as usucriaAtividade');
        $this->db->select('A.data_fim as dtEntregaAtividadeE');
        $this->db->select("DATE_FORMAT(A.data_fim, '%d/%m/%Y') AS dtEntregaAtividade", FALSE);
        //RETORNO DE TABELA ETAPAS
        $this->db->select('E.id_etapa as id_etapa');
        $this->db->select('E.etapa as nomeEtapa, CONCAT(CONCAT(E.etapa, " - "), E.descricao) as etapa');
        $this->db->select('E.descricao as descrEtapa');
        $this->db->select('E.prioridade as priorEtapa');
        $this->db->select('E.responsavel as respEtapa');
        $this->db->select('E.situacao as sitEtapa');
        $this->db->select('E.anexo as anexoEtapa');
        $this->db->select('E.dtcria as dtcriaEtapa');
        $this->db->select('E.status as statusEtapa');
        $this->db->select('E.usucria as usucriaEtapa');
        $this->db->select('E.data_fim as dtEntregaEtapaE');
        $this->db->select("DATE_FORMAT(E.data_fim, '%d/%m/%Y') AS dtEntregaEtapa", FALSE);
        //RETORNO DE TABELA PROJETOS
        $this->db->select('B.id_projeto as id_projeto');
        $this->db->select('B.id_departamento as id_departamento');
        $this->db->select('B.responsavel as id_responsavel');
        $this->db->select('B.nome as nomeProjeto, CONCAT(CONCAT(B.nome , " - "), B.descricao) as projeto');
        $this->db->select("DATE_FORMAT(B.dtentrega, '%d/%m/%Y') AS dtEntregaProjeto", FALSE);
        $this->db->select("B.dtentrega AS dtEntregaProjetoE", FALSE);
        $this->db->select('B.descricao as descrPropjeto');
        $this->db->select('B.data_fim as dtfimProjeto');
        $this->db->select('B.anexo as anexoProjeto');
        $this->db->select('B.usucria as usucriaPropjeto');
        $this->db->select('B.situacao as situacaoPropjeto');
        $this->db->select('B.status as statusPropjeto');
        $this->db->select("DATE_FORMAT(A.dtcria, '%d/%m/%Y') AS dtcria", FALSE);
        //RETORNO DE TABELA DEPARTAMENTOS
        $this->db->select('C.id_departamento as id_departamento');
        $this->db->select('C.cod_departamento as codDepartamento');
        $this->db->select('C.descricao as descrDepartamento');
        //RETORNO DE TABELA USERS - RESPONSÁVEL
        $this->db->select('D.id_users as idResponsavel');
        $this->db->select('D.nome as nomeResponsavel');
        //PARAMETROS DE CONSULTAS
        $this->db->join("tbl_atividades A", "A.id_etapa = E.id_etapa", "left");
        $this->db->join("tbl_users D", "A.responsavel = D.id_users", "left");
        $this->db->join("tbl_projetos B", "B.id_projeto = E.id_projeto", "inner");
        $this->db->join("tbl_departamentos C", "B.id_departamento = C.id_departamento", "inner");
        //this->db->where('E.status !=', 'D');
        //$this->db->where('A.status !=', 'D');
        //$this->db->where('A.situacao !=', 'R');
        $retorno = $this->db->get('tbl_etapas E');
        return $retorno->result();
    }


    ////////////////////////////////////////
    // RETORNO DE TODAS AS TAREFAS        //
    // CRIADO POR ELIEL FELIX             //
    // DATA: 27/07/2023                   //
    ////////////////////////////////////////
    public function retTarefas()
    {
        // USUÁRIO(2) OU ADM(1)
        if ($this->session->userdata('nivel') == 2) { // USUÁRIO

            $this->db->where('status !=', 'D');
            $this->db->where("situacao !=", 'R');
            $this->db->select('id_cabec');
            $this->db->where('responsavel', $this->session->userdata('id_users'));
            $cabec_tarefas = $this->db->get('tbl_user_tarefas');
            $cabec_tarefas = $cabec_tarefas->result_array();

            // echo '<pre>';
            // print_r($cabec_tarefas);
            // echo '</pre>';
            // exit;

            // USAR CABECS PARA BUSCAR TODOS OS CABEÇALHOS RELACIONADOS OU QUE ELE POSSUA DIREITO
            $cabecs = implode(',', $cabec_tarefas);

            foreach ($cabec_tarefas as $valor) {
                $this->db->where('id_cabec =', $valor->id_cabec);
                $this->db->where('status !=', 'D');
                $this->db->where("situacao !=", 'R');
                $this->db->order_by('id_tarefa');
                $tarefas = $this->db->get('tbl_user_tarefas');
                $valor->tarefas = $tarefas->result();
            }
        } else if ($this->session->userdata('nivel') == 1) { // ADM

            $this->db->where('status !=', 'D');
            $this->db->where("situacao !=", 'R');
            $cabec_tarefas = $this->db->get('tbl_cabec_tarefas');
            $cabec_tarefas = $cabec_tarefas->result();

            foreach ($cabec_tarefas as $cabec) {

                $this->db->where('id_cabec =', $cabec->id_cabec);
                $this->db->where('status !=', 'D');
                $this->db->where("situacao !=", 'R');
                $this->db->order_by('id_tarefa');
                $tarefas = $this->db->get('tbl_user_tarefas');
                $cabec->tarefas = $tarefas->result();
            }
        } else {
            // NÍVEL DE ACESSO AINDA NÃO CADASTRADO
        }

        return $cabec_tarefas;
    }







    ////////////////////////////////////////
    // RETORNO DE CODIGO DE IMAGEM        //
    // CRIADO POR MARCIO SILVA            //
    // DATA: 22/05/2022                   //
    ////////////////////////////////////////
    public function imgEtapa($etapa)
    {
        $this->db->select('*');
        $this->db->where('id_etapa', $etapa);
        $retorno = $this->db->get('tbl_etapas');

        return $retorno;
    }

    ////////////////////////////////////////
    // RETORNO HISTÓRICO DE ATIVIDADE     //
    // CRIADO POR ELIEL AMORIM            //
    // DATA: 02/06/2023                   //
    ////////////////////////////////////////
    public function buscaHistorico($dados)
    {

        $this->db->order_by('seq desc');
        $this->db->where('id_atividade', $dados['id_atividade']);
        $this->db->select('*, DATE_FORMAT(data, "%d/%m/%Y") as reg_data');
        $retorno = $this->db->get('tbl_status_atividades');
        $retorno = $retorno->result();

        return $retorno;
    }
}
