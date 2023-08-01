
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class m_insert extends CI_Model
{

    ////////////////////////////////////////
    // CADASTRO DE USUARIOS               
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////   
    public function cadUser($dados)
    {


        $this->db->trans_begin();
        if ($this->input->post("txtIdUser") == '') {
            $this->db->insert('tbl_users', $dados);
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
                    'message' => "Usuário cadastrado com sucesso!"
                );
            }
        } else {
            $this->db->where('id_users', $this->input->post("txtIdUser"));
            $this->db->update('tbl_users', $dados);
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
                    'message' => "Usuário atualizado com sucesso!"
                );
            }
        }
        return $return;
    }



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
        if ($this->input->post("txtIdProjeto") == '') {
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
            $this->db->where('id_projeto', $this->input->post("txtIdProjeto"));
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
        $this->db->trans_begin();
        if ($this->input->post("txtIdEtapa") == '') {
            $this->db->insert('tbl_etapas', $dados);
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
                    'message' => "Etapa cadastrada com sucesso!"
                );
            }
        } else {
            $this->db->where('id_etapa', $this->input->post("txtIdEtapa"));
            $this->db->update('tbl_etapas', $dados);
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
                    'message' => "Etapa atualizada com sucesso!"
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
        $this->db->trans_begin();
        if ($this->input->post("txtIdAtividade") == '') {
            $this->db->insert('tbl_atividades', $dados);
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
                    'message' => "Atividade cadastrada com sucesso!"
                );
            }
        } else {
            $this->db->where('id_atividade', $this->input->post("txtIdAtividade"));
            $this->db->update('tbl_atividades', $dados);
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
                    'message' => "Atividade atualizada com sucesso!"
                );
            }
        }
        return $return;
    }

    ////////////////////////////////////////
    // CADASTRO DE TAREFA
    // CRIADO POR ELIEL FELIX            
    // DATA: 29/07/2023
    ////////////////////////////////////////   
    public function cadTarefas($dados)
    {
        $this->db->trans_begin();
        if ($this->input->post("txtIdTarefa") == '') {
            $this->db->insert('tbl_user_tarefas', $dados);
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
                    'message' => "Tarefa cadastrada com sucesso!"
                );
            }
        } else {
            $this->db->where('id_tarefa', $this->input->post("txtIdTarefa"));
            $anexoexiste = $this->db->get('tbl_user_tarefas');
            $anexoexiste = $anexoexiste->result();

            if (trim($anexoexiste[0]->anexo) != '') {
                if (isset($dados['anexo'])) {
                    if ($dados['anexo'] == '') {
                        unset($dados['anexo']);
                    } else {
                        if (file_exists('assets/uploads/' . trim($anexoexiste[0]->anexo))) {
                            if (!unlink('assets/uploads/' . trim($anexoexiste[0]->anexo))) { // APAGA ANEXO ANTIGO E SUBSTUI PELO NOVO
                                $this->db->trans_rollback();
                                $return = array(
                                    'code' => 0,
                                    'message' => "Não foi possível apagar o antigo anexo!"
                                );
                                return $return;
                            }
                        }
                    }
                }
            }

            // echo '<pre>';
            // print_r($anexoexiste->result());
            // echo '</pre>';
            // exit;

            $this->db->where('id_tarefa', $this->input->post("txtIdTarefa"));
            $this->db->update('tbl_user_tarefas', $dados);
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
                    'message' => "Tarefa atualizada com sucesso!"
                );
            }
        }
        return $return;
    }


    ////////////////////////////////////////
    // CADASTRO CARD DE TAREFA
    // CRIADO POR ELIEL FELIX            
    // DATA: 30/07/2023
    ////////////////////////////////////////   
    public function cadCabecTarefas($dados)
    {
        $this->db->trans_begin();
        if ($this->input->post("txtIdCabec") == '') {
            $this->db->insert('tbl_cabec_tarefas', $dados);
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
                    'message' => "Tarefa cadastrada com sucesso!"
                );
            }
        } else {

            $this->db->where('id_cabec', $this->input->post("txtIdCabec"));
            $anexoexiste = $this->db->get('tbl_cabec_tarefas');
            $anexoexiste = $anexoexiste->result();

            if (trim($anexoexiste[0]->anexo) != '') {
                if (isset($dados['anexo'])) {
                    if ($dados['anexo'] == '') {
                        unset($dados['anexo']);
                    } else {
                        if (file_exists('assets/uploads/' . trim($anexoexiste[0]->anexo))) {
                            if (!unlink('assets/uploads/' . trim($anexoexiste[0]->anexo))) { // APAGA ANEXO ANTIGO SE UM NOVO ESTIVER SENDO CADASTRADO
                                $this->db->trans_rollback();
                                $return = array(
                                    'code' => 0,
                                    'message' => "Não foi possível apagar o antigo anexo!"
                                );
                                return $return;
                            }
                        }
                    }
                }
            }

            $this->db->where('id_cabec', $this->input->post("txtIdCabec"));
            $this->db->update('tbl_cabec_tarefas', $dados);
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
                    'message' => "Tarefa atualizada com sucesso!"
                );
            }
        }
        return $return;
    }
    ////////////////////////////////////////
    // CADASTRO DE STATUS ATIVIDADE
    // CRIADO POR ELIEL AMORIM            
    // DATA: 31/05/2023
    ////////////////////////////////////////   
    public function altsituacao($dados)
    {
        $this->db->where('id_atividade', $dados['id_atividade']);
        $this->db->select('max(seq) as sequencia');
        $seq = $this->db->get('tbl_status_atividades');
        $dados['seq'] = $seq->row()->sequencia + 1;

        $this->db->trans_begin();

        $this->db->insert('tbl_status_atividades', $dados);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $return = array(
                'code' => 0,
                'message' => "Erro ao gravar os dados!"
            );
            return $return;
        }

        $this->db->where('id_atividade', $dados['id_atividade']);
        $this->db->update('tbl_atividades', ['situacao' => $dados['status_mov']]);

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
                'message' => "Atividade cadastrada com sucesso!"
            );
        }

        return $return;
    }
}
