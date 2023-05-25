
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
    // CRIADO POR ELIEL FELIX             //
    // DATA: 22/05/2023                   //
    ////////////////////////////////////////
    public function retAllProjects()
    {
        $this->db->select('*');
        $this->db->select("DATE_FORMAT(dtcria, '%d/%m/%Y') AS dtcria", FALSE);
        // $this->db->where('status !=', 'D');
        $retorno = $this->db->get('tbl_projetos');
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

        $this->db->select('*');
        $this->db->where('status !=', 'D');
        $retorno = $this->db->get('tbl_users');

        return $retorno;
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
  
