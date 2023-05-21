
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_delete extends CI_Model {
    
    ////////////////////////////////////////
    // DELETAR CONGREGACOES                     
    // CRIADO POR MARCIO SILVA          
    // DATA: 31/05/2019                  
    ////////////////////////////////////////
    public function delCongregacao() {
        $id_congregacao = $this->input->post('id_congregacao');
        $this->db->where('id_congregacao', $id_congregacao);
        $congregacoes = array('status'=>'D');
        $this->db->update('tbl_congregacoes',$congregacoes);
        return 1;
    }
    
}