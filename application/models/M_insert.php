
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_insert extends CI_Model
{

    ////////////////////////////////////////
    // CADASTRO DE DEPARTAMENTO               
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////   
    public function cadDepto($dados)
    {
        $values = array(
            "cod_departamento" => $dados['txtCodDepto'],
            "descricao" => $dados['txtDescDepto'],
        );

        $this->db->trans_begin();
        if ($dados['txtIdDepto'] == '') {
            $this->db->insert('tbl_departamentos', $values);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return = array(
                    'code' => 0,
                    'message' => "Erro ao gravar os dados!"
                );
            } else {
                $this->db->trans_commit();
                $return = array(
                    'code' => 1,
                    'message' => "Departamento cadastrado com sucesso!"
                );
            }
        } else {
            $this->db->where('id_departamento', $dados['txtIdDepto']);
            $this->db->update('tbl_departamentos', $values);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return = array(
                    'code' => 0,
                    'message' => "Erro ao atualizar os dados!"
                );
            } else {
                $this->db->trans_commit();
                $return = array(
                    'code' => 1,
                    'message' => "Departamento atualizado com sucesso!"
                );
            }
        }
        return $return;
    }

    ////////////////////////////////////////
    // CADASTRO DE PROJETO               
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////   
    public function cadProjeto($dados)
    {

        $this->db->trans_begin();
        if ($dados['id_projeto'] == '') {
            $this->db->insert('tbl_projetos', $dados);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return = array(
                    'code' => 0,
                    'message' => "Erro ao gravar os dados!"
                );
            } else {
                $this->db->trans_commit();
                $return = array(
                    'code' => 1,
                    'message' => "Projeto cadastrado com sucesso!"
                );
            }
        } else {
            $this->db->where('id_projeto', $dados['id_projeto']);
            $this->db->update('tbl_projetos', $dados);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return = array(
                    'code' => 0,
                    'message' => "Erro ao atualizar os dados!"
                );
            } else {
                $this->db->trans_commit();
                $return = array(
                    'code' => 1,
                    'message' => "Projeto atualizado com sucesso!"
                );
            }
        }
        return $return;
    }



    ////////////////////////////////////////
    // CADASTRO DE ETAPAS
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////   
    public function cadEtapa($dados)
    {
        $this->db->select("id_departamento, id_projeto");
        $this->db->where('id_projeto', $dados['slEtapProjeto']);
        $retorno = $this->db->get('tbl_projetos')->result();

        $this->db->trans_begin();
        if ($dados['txtIdEtapa'] == '') {
            $values = array(
                "id_departamento" => $retorno[0]->id_departamento,
                "id_projeto" => $retorno[0]->id_projeto,
                "etapa" => $dados['txtNomeEtapa'],
                "descricao" => $dados['txtDescEtapa'],
                "prioridade" => $dados['SlPrioridade'],
                "data_inicio" => date('d/m/Y'),
                "data_fim" => $dados['txtEtaDtLimit'],
                "responsavel" => $dados['slResponsavel'],
                "anexo" => $dados['anexo']
            );
            $this->db->insert('tbl_etapas', $values);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return = array(
                    'code' => 0,
                    'message' => "Erro ao gravar os dados!"
                );
            } else {
                $this->db->trans_commit();
                $return = array(
                    'code' => 1,
                    'message' => "Etapa cadastrado com sucesso!"
                );
            }
        } else {
            $values = array(
                "id_departamento" => $retorno[0]->id_departamento,
                "id_projeto" => $retorno[0]->id_projeto,
                "etapa" => $dados['txtNomeEtapa'],
                "descricao" => $dados['txtDescEtapa'],
                "prioridade" => $dados['SlPrioridade'],
                "data_inicio" => date('d/m/Y'),
                "data_fim" => $dados['txtEtaDtLimit'],
                "responsavel" => $dados['slResponsavel'],
            );
            $this->db->where('id_etapa', $dados['txtIdEtapa']);
            $this->db->update('tbl_etapas', $values);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return = array(
                    'code' => 0,
                    'message' => "Erro ao atualizar os dados!"
                );
            } else {
                $this->db->trans_commit();
                $return = array(
                    'code' => 1,
                    'message' => "Etapa atualizado com sucesso!"
                );
            }
        }
        return $return;
    }

    ////////////////////////////////////////
    // CADASTRO DE ATIVIDADE
    // CRIADO POR ELIEL AMORIM            
    // DATA: 25/05/2023
    ////////////////////////////////////////   
    public function cadAtividades($dados)
    {

        

    }
}
