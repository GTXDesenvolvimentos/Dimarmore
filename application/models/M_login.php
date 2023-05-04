
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_login extends CI_Model {

    ////////////////////////////////////////
    // MODEL DE LOGIN                     //
    // CRIADO POR MARCIO SILVA            //
    // DATA: 31/05/2019                   //
    ////////////////////////////////////////
    public function logar() {
        $usuario = $this->input->post("usuario");
        $senha = sha1($this->input->post("senha"));
        $this->db->where('usuario', $usuario);
        $this->db->where('senha', $senha);
        $this->db->where('status!=', 'D');
        $retorno = $this->db->get('tbl_users');
        if ($retorno->num_rows() > 0) {
            $this->session->set_userdata("id_users", $retorno->row()->id_users);
            $this->session->set_userdata("id_departamento", $retorno->row()->id_departamento);
            $this->session->set_userdata("nome", $retorno->row()->nome);
            $this->session->set_userdata("registro", $retorno->row()->registro);
            $this->session->set_userdata("nome_contribuinte", $retorno->row()->nome_contribuinte);
            $this->session->set_userdata("logado", 1);
            return $retorno->row()->nivel;
        } else {
                return 0;
            }
        }
    }


