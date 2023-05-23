
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_insert extends CI_Model
{

    ////////////////////////////////////////
    // CADASTRO DE USUARIOS                
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
    // CADASTRO DE ETAPAS
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////   
    public function cadEtapa($dados)
    {

        $this->db->select("d.id_departamento, p.id_projeto");
        $this->db->where('d.id_departamento', 51);
        $this->db->where('d.id_departamento', 'p.id_departamento');
        $retorno = $this->db->get('tbl_projetos p, tbl_departamentos d')->result;

        $values = array(
            "id_departamento" => 51,
            "id_projeto" => 1,
            "etapa" => $dados['txtNomeEtapa'],
            "descricao" => $dados['txtDescEtapa'],
            "prioridade" => $dados['SlPrioridade'],
            "data_inicio" => date('d/m/Y'),
            "data_fim" => $dados['txtEtaDtLimit'],
            "responsavel" => $dados['SlResponsavel'],
            "anexo" => $dados['anexo']
        );

        $this->db->trans_begin();
        if ($dados['txtIdEtapa'] == '') {
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
            $this->db->where('tbl_etapas', $dados['txtIdEtapa']);
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
}
