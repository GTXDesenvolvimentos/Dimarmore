
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_delete extends CI_Model
{

    ////////////////////////////////////////
    // DELETAR CONGREGACOES                     
    // CRIADO POR MARCIO SILVA          
    // DATA: 31/05/2019                  
    ////////////////////////////////////////
    public function delDepto($id_departamento)
    {
        $this->db->trans_begin();
        $this->db->where('id_departamento', $id_departamento);
        $dados = array('status' => 'D');
        $this->db->update('tbl_departamentos', $dados);


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return = array(
                'code' => 0,
                'message' => "Erro ao deletar o departamento!"
            );
        } else {
            $this->db->trans_commit();
            $return = array(
                'code' => 1,
                'message' => "Deparatamento deletado com sucesso!"
            );
        }
        return $return;
    }

    ////////////////////////////////////////
    // DELETAR ETAPAS    
    // CRIADO POR MARCIO SILVA          
    // DATA: 31/05/2019                  
    ////////////////////////////////////////
    public function delEtapa($id_etapas)
    {
        $this->db->trans_begin();
        $this->db->where('id_etapa', $id_etapas);
        $dados = array('status' => 'D');
        $this->db->update('tbl_etapas', $dados);


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return = array(
                'code' => 0,
                'message' => "Erro ao deletar o departamento!"
            );
        } else {
            $this->db->trans_commit();
            $return = array(
                'code' => 1,
                'message' => "Deparatamento deletado com sucesso!"
            );
        }
        return $return;
    }
}
