
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_delete extends CI_Model {
    ////////////////////////////////////////
    // DELETAR Contribuintes                     
    // CRIADO POR MARCIO SILVA          
    // DATA: 31/05/2019                  
    ////////////////////////////////////////
    public function delContribuintes() {
        $id_contribuinte = $this->input->post('id_contribuinte');
        $this->db->where('id_contribuinte', $id_contribuinte);
        $contribuintes = array('status'=>'D');
        $this->db->update('tbl_contribuintes',$contribuintes);
        return 1;
    }
    
    
    ////////////////////////////////////////
    // DELETAR PERIODO DE MOVIMENTO                     
    // CRIADO POR MARCIO SILVA          
    // DATA: 31/05/2019                  
    ////////////////////////////////////////
    public function delPeriodoMovimento() {
        $id_movimento = $this->input->post('id_movimento');
        $this->db->where('id_movimento', $id_movimento);
        $movimento = array('status'=>'D');
        $this->db->update('tbl_dtmovimento',$movimento);
        return 1;
    }
    
    
    
    
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
    
    
    ////////////////////////////////////////
    // FINALIZAR LANCAMENTOS                   
    // CRIADO POR MARCIO SILVA           
    // DATA: 31/05/2019                  
    ////////////////////////////////////////
    public function fecharLancamento() {
        $nro_doc = $this->input->post('nro_doc');
        $this->db->where('nro_doc', $nro_doc);
        $movimento = array('status'=>'F');
        $this->db->update('tbl_movimento',$movimento);
        
        $this->db->where('nro_doc', $nro_doc);
        $tbl_dizimos = array('status'=>'F');
        $this->db->update('tbl_dizimos',$tbl_dizimos);
        
        $this->db->where('nro_doc', $nro_doc);
        $tbl_ofertas = array('status'=>'F');
        $this->db->update('tbl_ofertas',$tbl_ofertas);
        
        return 1;
    }
    
    
    ////////////////////////////////////////
    // DELETAR DESPESAS          
    // CRIADO POR MARCIO SILVA          
    // DATA: 31/05/2019                  
    ////////////////////////////////////////
    public function delDespesas() {
        $id_despesa = $this->input->post('id_despesa');
        $this->db->where('id_despesa', $id_despesa);
        $despesas = array('status'=>'D');
        $this->db->update('tbl_despesas',$despesas);
        return 1;
    }
    
    ////////////////////////////////////////
    // DELETAR DESPESAS          
    // CRIADO POR MARCIO SILVA          
    // DATA: 31/05/2019                  
    ////////////////////////////////////////
    public function delOfertas() {
        $id_oferta = $this->input->post('id_oferta');
        $this->db->where('id_oferta', $id_oferta);
        $tbl_ofertas = array('status'=>'D');
        $this->db->update('tbl_ofertas',$tbl_ofertas);
        return 1;
    }
    
    
    ////////////////////////////////////////
    // DELETAR DIZIMOS          
    // CRIADO POR MARCIO SILVA          
    // DATA: 31/05/2019                  
    ////////////////////////////////////////
    public function delDizimos() {
        $id_dizimo = $this->input->post('id_dizimo');
        $this->db->where('id_dizimo', $id_dizimo);
        $tbl_dizimos = array('status'=>'D');
        $this->db->update('tbl_dizimos',$tbl_dizimos);
        return 1;
    }
    

    
    
}