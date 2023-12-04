
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

        // VERIFICAR DEMAIS ATIVIDADES PARA A ETAPA ESCOLHIDA
        $this->db->select('id_atividade,
                            CASE situacao 
                                WHEN "I" THEN "E"
                                WHEN "E" THEN "E"
                                WHEN "P" THEN "P"
                                WHEN "A" THEN "P"
                                WHEN "C" THEN "C"
                                WHEN "R" THEN "R"
                            END as situacao', FALSE);

        $this->db->from('tbl_atividades');
        $this->db->where('id_etapa', $dados['id_etapa']);
        $cons = $this->db->get();

        // DEFINE SITUAÇÃO QUE ETAPA RECEBE NO UPDATE
        $situacao = in_array($dados['situacao'], ['P', 'A']) ? 'P' : '';
        $situacao = in_array($dados['situacao'], ['I', 'E']) ? 'E' : '';
        $situacao = $situacao == '' ? $dados['situacao'] : $situacao;

        $update = array(
            'situacao' => $situacao
        );

        // VERIFICAR SE A ATIVIDADE PRESENTE É A PRIMEIRA DA ETAPA
        if ($cons->num_rows() > 0) {
            // NÃO É A PRIMEIRA, PORTANTO, VERIFICAR SE TODAS AS EXISTENTES POSSUEM A MESMA SITUAÇÃO

            $cons = $cons->result();

            // ARRAY DE TODAS AS SITUAÇÕES JÁ EXISTENTES
            foreach ($cons as $linha) {
                $status[] = $linha->situacao;
            }

            $this->db->select('situacao');
            $this->db->where('id_etapa', $dados['id_etapa']);
            $status_etapa = $this->db->get('tbl_etapas');

            // ATUAL SITUAÇÃO DA ETAPA
            $status_etapa = $status_etapa->row()->situacao;

            if (count(array_unique($status)) == 1) { // SE TODOS AS SITUAÇÕES DE ATIVIDADE IGUAIS...
                if ($status[0] == $situacao) {
                    /* 
                     *  NÃO HAVERÁ ALTERAÇÃO NA TABELA DE ETAPA
                     *  POIS NOVA SITUAÇÃO DE ATIVIDADE É IGUAL A TODAS AS OUTRAS
                     */
                } else {

                    // CONTAGEM DE QUANTAS ATIVIDADES TEM A ETAPA
                    // CONTAR QUANTAS SITUAÇÕES DE ATIVIDADES QUE EXISTEM NA ETAPA, SE FOR 1 ...
                    if (count($status) == 1) {

                        if ($this->input->post("txtIdAtividade") == '') { // VERIFICAR SE É UMA CRIAÇÃO DE ATIVIDADE
                            if ($status[0] == $situacao) {
                                /* NADA */
                            } else {
                                /* ATUALIZAR ETAPA PARA EXECUTANDO */
                                $this->db->where('id_etapa', $dados['id_etapa']);
                                $this->db->update('tbl_etapas', ['situacao' => 'E']);

                                if ($this->db->trans_status() === FALSE) {
                                    $this->db->trans_rollback();
                                    $return = array(
                                        'code' => 0,
                                        'message' => "Não Foi Possível Atualizar a Situação da Etapa da Atividade."
                                    );

                                    return $return;
                                }
                            }
                        } else { // SE ATIVIDADE ESTIVER SENDO EDITADA, A SITUAÇÃO DA ETAPA VAI SEGUIR A DESSA ATIVIDADE POIS SÓ EXISTE ELA

                            $this->db->where('id_etapa', $dados['id_etapa']);
                            $this->db->update('tbl_etapas', $update);

                            if ($this->db->trans_status() === FALSE) {
                                $this->db->trans_rollback();
                                $return = array(
                                    'code' => 0,
                                    'message' => "Não Foi Possível Atualizar a Situação da Etapa da Atividade."
                                );

                                return $return;
                            }
                        }
                    } else {

                        // SE A SITUAÇÃO DA ETAPA FOR PENDENTE E SITUAÇÃO DA ATIVIDADE TRABALHADA FOR CONCLUÍDA, REVISADA, INICIADA OU EXECUTANDO
                        if ($status_etapa == 'P' && in_array($dados['situacao'], ['C', 'R', 'I', 'E'])) {
                            // ATUALIZAR ETAPA PARA SIT. E

                            $this->db->where('id_etapa', $dados['id_etapa']);
                            $this->db->update('tbl_etapas', ['situacao' => 'E']);

                            if ($this->db->trans_status() === FALSE) {
                                $this->db->trans_rollback();
                                $return = array(
                                    'code' => 0,
                                    'message' => "Não Foi Possível Atualizar a Situação da Etapa da Atividade."
                                );

                                return $return;
                            }
                        } else if ($status_etapa == 'C' && in_array($dados['situacao'], ['R', 'C']) === false) {
                            // ATUALIZAR ETAPA PARA SIT. E

                            $this->db->where('id_etapa', $dados['id_etapa']);
                            $this->db->update('tbl_etapas', ['situacao' => 'E']);

                            if ($this->db->trans_status() === FALSE) {
                                $this->db->trans_rollback();
                                $return = array(
                                    'code' => 0,
                                    'message' => "Não Foi Possível Atualizar a Situação da Etapa da Atividade."
                                );

                                return $return;
                            }
                        }

                        // SE ELE ESTIVER PENDENTE, ATUALIZA SE ESTATUS SE AGORA FOR CONCLUIDO, EXECUTANDO INICIADO, REVISADO PARA EXECUTANDO


                    }

                    // SE ESTIVER CONCLUIDO, E STATUS ATUAL É DIFERENTE DE CONCLUÍDO
                    // SE FOR REVISADA, NÃO ATUALIZA
                    // SE FOR OUTRO ATUALIZA ETAPA PARA EXECUTANDO
                }
            } else {
                // HABILITA VERIFICAÇÃO DA SITUAÇÃO DA ETAPA APÓS UPDATE DA ATIVIDADE
                $executar = true;
            }
        } else { // É A PRIMEIRA ATIVIDADE DA ETAPA, PORTANTO, SUA SITUAÇÃO DEVE SE REFLETIR NA SITUAÇÃO DA ETAPA

            $this->db->where('id_etapa', $dados['id_etapa']);
            $this->db->update('tbl_etapas', $update);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return = array(
                    'code' => 0,
                    'message' => "Não Foi Possível Atualizar a Situação da Etapa da Atividade."
                );

                return $return;
            }
        }

        /* INSERT OU UPDATE DE ATIVIDADE */
        if ($this->input->post("txtIdAtividade") == '') {
            $this->db->insert('tbl_atividades', $dados);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $return = array(
                    'code' => 0,
                    'message' => "Erro ao gravar os dados!"
                );

                return $return;
            } else {
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

                return $return;
            } else {
                $return = array(
                    'code' => 1,
                    'message' => "Atividade atualizada com sucesso!"
                );
            }
        }

        if (isset($executar)) {
            $this->db->select('id_atividade,
            CASE situacao 
                WHEN "I" THEN "E"
                WHEN "E" THEN "E"
                WHEN "P" THEN "P"
                WHEN "A" THEN "P"
                WHEN "C" THEN "C"
                WHEN "R" THEN "R"
            END as situacao', FALSE);
            $this->db->from('tbl_atividades');
            $this->db->where('id_etapa', $dados['id_etapa']);
            $cons = $this->db->get();

            // RESETAR VARIÁVEL
            unset($status);

            foreach ($cons->result() as $linha) {
                $status[] = $linha->situacao;
            }

            // SE APÓS CRIAÇÃO / EDIÇÃO DE ATIVIDADE, TODAS POSSUÍREM A MESMA SITUAÇÃO
            if (count(array_unique($status)) == 1) {
                /* ATUALIZAR ETAPA PARA SITUAÇÃO DA NOVA ATIVIDADE, SE ATUAL SITUAÇÃO DE ETAPA DIFERIR */
                if ($status_etapa != $situacao) {
                    $this->db->where('id_etapa', $dados['id_etapa']);
                    $this->db->update('tbl_etapas', $update);

                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        $return = array(
                            'code' => 0,
                            'message' => "Não Foi Possível Atualizar a Situação da Etapa da Atividade."
                        );

                        return $return;
                    }
                }
            } else {
                /* ATUALIZAR ETAPA PARA SITUAÇÃO DE EXECUTANDO, SE ALGUMA ATIVIDADE FOR PENDENTE OU EXECUTANDO */
                if (in_array('P', $status) || in_array('E', $status)) {
                    if ($status_etapa != 'E') {
                        $this->db->where('id_etapa', $dados['id_etapa']);
                        $this->db->update('tbl_etapas', ['situacao' => 'E']);

                        if ($this->db->trans_status() === FALSE) {
                            $this->db->trans_rollback();
                            $return = array(
                                'code' => 0,
                                'message' => "Não Foi Possível Atualizar a Situação da Etapa da Atividade."
                            );

                            return $return;
                        }
                    }
                } else {
                    $this->db->where('id_etapa', $dados['id_etapa']);
                    $this->db->update('tbl_etapas', ['situacao' => 'C']);

                    if ($this->db->trans_status() === FALSE) {
                        $this->db->trans_rollback();
                        $return = array(
                            'code' => 0,
                            'message' => "Não Foi Possível Atualizar a Situação da Etapa da Atividade."
                        );

                        return $return;
                    }
                }
            }
        }
        // SE CHEGAR AQUI, TUDO OCORREU SEM ERROS
        $this->db->trans_commit();
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
                'message' => "Situação atualizada com sucesso!"
            );
        }

        return $return;
    }
}
