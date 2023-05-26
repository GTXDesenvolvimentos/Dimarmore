
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
    public function retAllProjects($id_departamento = null, $id_projeto = null, $responsavel = null, $id_etapa = null)
    {
        $id_etapa = is_null($id_etapa) ? $this->input->post('id_etapa'): $id_etapa;

        //RETORNO DE TABELA PROJETOS
        $this->db->select('A.id_projeto as id_projeto');
        $this->db->select('A.id_departamento as id_departamento');
        $this->db->select('A.responsavel as id_responsavel');
        $this->db->select('A.nome as nomeProjeto');
        $this->db->select("DATE_FORMAT(A.dtentrega, '%d/%m/%Y') AS dtEntregaProjeto", FALSE);
<<<<<<< HEAD
        $this->db->select("A.dtentrega AS dtEntregaProjetoE", FALSE);
        
        

        $this->db->select('A.descricao as descrPropjeto');
=======
        $this->db->select('A.descricao as descrProjeto');
>>>>>>> 98829ec0b67e0f339a75218a55b711b97103e6c0
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
        isset($id_etapa) == true && $id_etapa != '' ? $this->db->where('E.id_etapa', $id_etapa) : '';
        $this->db->where('A.status !=', 'D');
        $this->db->join("tbl_departamentos B", "A.id_departamento = B.id_departamento", "inner");
        $this->db->join("tbl_users C", "A.responsavel = C.id_users", "inner");
        $this->db->join("tbl_etapas E", "A.id_projeto = E.id_projeto", "inner");
        $retorno = $this->db->get('tbl_projetos A');
        return $retorno->result();
    }


    ////////////////////////////////////////
    // RETORNO DE ETAPAS                  //
    // CRIADO POR MARCIO SILVA            //
    // DATA: 22/05/2022                   //
    ////////////////////////////////////////
    public function retEtapas()
    {

        $this->db->select('*');
        // $this->db->select("DATE_FORMAT(dtcria, '%d/%m/%Y') AS dtcria", FALSE);
        $this->db->where('status !=', 'D');
        $retorno = $this->db->get('tbl_etapas');
        return $retorno;
    }

    ////////////////////////////////////////
    // RETORNO DE ETAPAS                  //
    // CRIADO POR MARCIO SILVA            //
    // DATA: 22/05/2022                   //
    ////////////////////////////////////////
    public function retUsers()
    {
        $this->db->select('id_users, id_departamento, nome, registro, usuario, nivel, status, DATE_FORMAT(dtcria, "%d/%m/%Y")');
        $this->db->where('status != "D"');
        $retorno = $this->db->get('tbl_users');

        return $retorno->result();
    }


    ////////////////////////////////////////
    // RETORNO DE TODOS OS PROJETOS       //
    // CRIADO POR ELIEL FELIX             //
    // DATA: 22/05/2023                   //
    ////////////////////////////////////////
    public function retAtividades()
    {
        $this->db->select('*');
        $this->db->select("DATE_FORMAT(dtcria, '%d/%m/%Y') AS dtcria", FALSE);
        $this->db->select("DATE_FORMAT(data_fim, '%d/%m/%Y') AS data_fim", FALSE);
        $this->db->where('status !=', 'D');
        $retorno = $this->db->get('tbl_atividades');
        return $retorno->result();
    }

    ////////////////////////////////////////
    // RETORNO DE ATIVIDADES              //
    // CRIADO POR MARCIO SILA             //
    // DATA: 31/05/2019                   //
    ////////////////////////////////////////
    public function retAtividades2()
    {
        $id_atividade = $this->input->post('id_atividade');
        $id_situacao = $this->input->post('id_situacao');
        $this->db->select('A.situacao as situacao');
        $this->db->select('A.id_atividade as id_atividade');
        $this->db->select('A.id_projeto as id_projeto');
        $this->db->select('A.atividade as nome_atividade');
        $this->db->select('A.descricao as descricao_atividade');
        $this->db->select("DATE_FORMAT(A.dtcria, '%d/%m/%Y') AS data_criacao", FALSE);
        $this->db->select('C.nome as responsavel');
        $this->db->select('A.anexo as anexo');
        $this->db->select('A.prioridade as prioridade');
        $this->db->select('B.descricao as descricao_projeto');
        $this->db->select('B.nome as nome_projeto');
        $this->db->select('D.descricao as nome_dep');
        $this->db->join("tbl_projetos B", "A.id_projeto = B.id_projeto", "inner");
        $this->db->join("tbl_users C", "A.id_usuario = C.id_users", "inner");
        $this->db->join("tbl_departamentos D", "A.id_departamento = D.id_departamento", "inner");
        isset($id_atividade) == true && $id_atividade != '' ? $this->db->where('A.id_atividade', $id_atividade) : '';
        // isset($id_projeto) == true && $id_projeto != '' ? $this->db->where('A.id_projeto', $id_projeto) : '';
        isset($id_situacao) == true && $id_situacao != '' ? $this->db->where('A.id_atividade', $id_situacao) : '';
        $this->db->where('A.status !=', 'D');
        $retorno = $this->db->get('tbl_atividades A');
    }

    ////////////////////////////////////////
    // RETORNO DE ETAPAS                  //
    // CRIADO POR MARCIO SILVA            //
    // DATA: 22/05/2022                   //
    ////////////////////////////////////////
    public function retProjeto()
    {

        $this->db->select('*');
        $this->db->where('status !=', 'D');
        $retorno = $this->db->get('tbl_projetos');

        return $retorno;
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
}
