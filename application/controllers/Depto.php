<?php

defined('BASEPATH') or exit('No direct script access allowed');

class depto extends MY_Controller
{

    ////////////////////////////////////////
    // HOME PADRAO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////  
    public function index()
    {
        $this->load->view('includes/header');
        $this->load->view('includes/menu_sup');
        $this->load->view('v_depto');
        $this->load->view('includes/footer');
    }

    ////////////////////////////////////////
    // RETORNA DEPARTAMENTO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 08/02/2023                   
    ////////////////////////////////////////
    public function retDepto()
    {
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retDepto();
        echo json_encode($retorno->result());
    }

    ////////////////////////////////////////
    // CADASTRA DEPARTAMENTO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                   
    ////////////////////////////////////////
    public function cadastrarDepartamento()
    {
        $this->form_validation->set_rules('cod_departamento', 'Código do departamento', 'required|is_unique[tbl_departamentos.cod_departamento]');
        $this->form_validation->set_rules('descricao', 'Departamento', 'required|is_unique[tbl_departamentos.descricao]');

        if ($this->form_validation->run() == FALSE) {
            $return[] = array(
                'ret' => 3,
                'msg' => validation_errors()
            );
        } else {

            $value = $this->input->post();

            $this->load->model('M_insert');
            $returno = $this->M_insert->cadastrarDepartamento($value);

            if ($returno == 1) {
                $return[] = array(
                    'ret' => 1,
                    'msg' => 'Departamento cadastrado com sucesso!'
                );
            } else {
                $return[] = array(
                    'ret' => 0,
                    'msg' => 'Não foi possível realizar a inserção do departamento!'
                );
            }
        }
        echo json_encode($return);
    }

    ////////////////////////////////////////
    // DELETAR DEPARTAMENTO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                   
    ////////////////////////////////////////
    public function del_departamento()
    {
        $id_departamento = $this->input->post('id_departamento');
        $this->load->model('M_retorno');
        $retorno = $this->M_retorno->retUsuarios($id_departamento);
       
        if ($retorno->num_rows() > 0) {
            $return[] = array(
                'ret' => 3,
                'msg' => 'Existem funcionários cadastrados com esse departamento.'
            );
        } else {
            $this->load->model('M_delete');
            $returno = $this->M_delete->del_departamento($id_departamento);

            if ($returno == 1) {
                $return[] = array(
                    'ret' => 1,
                    'msg' => 'Departamento deletado com sucesso!'
                );
            } else {
                $return[] = array(
                    'ret' => 0,
                    'msg' => 'Não foi possível deletar o departamento!'
                );
            }
        }
        echo json_encode($return);
    }
}
