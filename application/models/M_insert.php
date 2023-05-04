
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
    public function cadUsuario($dados)
    {
        $this->db->trans_begin();
        $this->db->insert('tbl_users', $dados);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $retorno = 0;
        } else {
            $dados = array("codigo" => date('mdhis'));
            $this->db->insert('tbl_indicados', $dados);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                $retorno = 0;
            } else {
                $this->db->trans_commit();
                $retorno = 1;
            }
        }
        return $retorno;
    }


    ////////////////////////////////////////
    // CADASTRO DE CONGREGAÇÃO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////   
    public function cadCongregacao()
    {
        $nome_congregacao = $this->input->post('nome_congregacao');
        $id_setor = $this->session->userdata('id_setor');
        $descricao = $this->input->post('descricao');
        $id_endereco = $this->input->post('id_endereco');
        $numero = $this->input->post('nro');

        $tbl_congregacao = array(
            "nome_congregacao" => $nome_congregacao,
            "id_setor" => $id_setor,
            "id_endereco" => $id_endereco,
            "numero" => $numero,
            "descricao" => $descricao
        );

        if ($this->input->post('id_congregacao') == TRUE) {
            $id_congregacao = $this->input->post('id_congregacao');
            $this->db->where('id_congregacao', $id_congregacao);
            $this->db->update('tbl_congregacoes', $tbl_congregacao);
            $retorno = 2;
        } else {
            $this->db->insert('tbl_congregacoes', $tbl_congregacao);
            $retorno = 1;
        }

        return $retorno;
    }


    ////////////////////////////////////////
    // CADASTRO DE PERÍODOS DE MOVIMENTOS                    
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////   
    public function cad_PeriodosMovimentos()
    {
        $id_movimento = $this->input->post('id_movimento');
        $id_setor = $this->session->userdata('id_setor');
        $dt_abertura = data_sql($this->input->post('dt_abertura'));
        $dt_fechamento = data_sql($this->input->post('dt_fechamento'));
        $descricao = $this->input->post('descricao');

        $tbl_dtmovimento = array(
            "id_setor" => $id_setor,
            "dt_abertura" => $dt_abertura,
            "dt_fechamento" => $dt_fechamento,
            "descricao" => $descricao,
            "status" =>  "A"
        );

        $ret = $this->db->query("select * from tbl_dtmovimento where id_setor = $id_setor and status = 'A'");
        $cad = $ret->num_rows() > 0 ? 1 : 2;


        if ($this->input->post('id_movimento') == TRUE) {
            $this->db->where('id_movimento', $id_movimento);
            $this->db->update('tbl_dtmovimento', $tbl_dtmovimento);
            $retorno = 2;
        } else {
            if ($cad == 1) {
                $retorno = 3;
            } else {
                $this->db->insert('tbl_dtmovimento', $tbl_dtmovimento);
                $retorno = 1;
            }
        }

        return $retorno;
    }



    ////////////////////////////////////////
    // CADASTRO DE TIPO DE DESPESA                    
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////   
    public function cadTipoDespesa()
    {
        $nome_despesa = $this->input->post('nome_despesa');
        $id_congregacao = $this->input->post('id_congregacao');
        $descricao = $this->input->post('descricao');

        $tbl_tipo_despesas = array(
            "nome_despesa" => $nome_despesa,
            "id_congregacao" => $id_congregacao,
            "descricao" => $descricao
        );

        if ($this->input->post('id_tipo_despesa') == TRUE) {
            $id_tipo_despesa = $this->input->post('id_tipo_despesa');
            $this->db->where('id_tipo_despesa', $id_tipo_despesa);
            $this->db->update('tbl_tipos_despesas', $tbl_tipo_despesas);
            $retorno = 2;
        } else {
            $this->db->insert('tbl_tipos_despesas', $tbl_tipo_despesas);
            $retorno = 1;
        }

        return $retorno;
    }

    ////////////////////////////////////////
    // BUSCA DO MOVIMENTO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////   
    private function sequencia($id_congregacao)
    {
        $ret = $this->db->query("SELECT max(movimento) + 1 movimento FROM tbl_movimento where id_congregacao = $id_congregacao");
        $retorno = $ret->row()->movimento == NULL ? 1 : $ret->row()->movimento;
        return $retorno;
    }

    ////////////////////////////////////////
    // BUSCA PERIODO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////   
    private function busca_periodo($data, $id_setor)
    {
        $ret = $this->db->query("select * from tbl_dtmovimento where id_setor = $id_setor and status != 'F'and '$data' BETWEEN dt_abertura AND dt_fechamento and id_movimento = (select max(id_movimento) as id_dtmovimento from tbl_dtmovimento where id_setor = $id_setor and status != 'D')");
        $retorno = $ret->num_rows() > 0 ? 1 : 2;
        return $retorno;
    }

    ////////////////////////////////////////
    // CADASTRO DO CONTRIBUINTE                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////   
    public function cadLancamento()
    {
        $id_congregacao = $this->session->userdata('id_congregacao');
        $id_setor = $this->session->userdata('id_setor');
        $numero_doc = $this->input->post('numero_doc');
        $dt_doc = data_sql($this->input->post('dt_doc'));
        $descricao_doc = $this->input->post('descricao_doc');
        $sequencia = $this->sequencia($id_congregacao);

        $tbl_movimento = array(
            "id_congregacao" => $id_congregacao,
            "nro_doc" => $numero_doc,
            "tipo" => 'E',
            "movimento" => $sequencia,
            "descricao" => $descricao_doc,
            "data" => $dt_doc,
            "valor_movimento" => 0.00,
            "dizimo" => 0.00,
            "oferta" => 0.00,
            "status" => 'A'
        );

        $periodo = $this->busca_periodo($dt_doc, $id_setor);
        if ($periodo === 1) {
            if ($this->input->post('id_movimento') == TRUE) {
                $id_movimento = $this->input->post('id_movimento');
                $this->db->where('id_movimento', $id_movimento);
                $this->db->update('tbl_movimento', $tbl_movimento);
                $retorno = 2;
            } else {
                $this->db->insert('tbl_movimento', $tbl_movimento);
                $retorno = 1;
            }
        } else {
            $retorno = 4;
        }

        return $retorno;
    }

    ////////////////////////////////////////
    // CADASTRO DE DÍZIMOS                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////   
    public function cadDizimo()
    {
        $id_contribuinte = $this->input->post('idContribuinteD');
        $id_funcao = '';
        $id_congregacao = $this->session->userdata('id_congregacao');
        $id_setor = $this->session->userdata('id_setor');
        if ($this->input->post('txt_doc1') == TRUE) {
            $nro_doc = $this->input->post('txt_doc1');
        } else {
            $nro_doc = $this->session->userdata('nro_doc');
        }
        $data = $this->input->post('dtLancamentoD');
        $valor_real = str_replace(".", "", $this->input->post('valorD'));
        $valor_entrada = str_replace(",", ".", $valor_real);
        $descricaoD = $this->input->post('descricaoD');


        $tbl_dizimos = array(
            "id_contribuinte" => $id_contribuinte,
            "id_funcao" => $id_funcao,
            "id_congregacao" => $id_congregacao,
            "nro_doc" => $nro_doc,
            "data" => data_sql($data),
            "valor_entrada" => $valor_entrada,
            "anexo" => '',
            "descricao" => $descricaoD,
            "status" => 'A'
        );
        $periodo = $this->busca_periodo(data_sql($data), $id_setor);
        if ($periodo === 1) {
            if ($this->input->post('id_dizimoD') == TRUE) {
                $id_dizimo = $this->input->post('id_dizimoD');
                $this->db->where('id_dizimo', $id_dizimo);
                $this->db->update('tbl_dizimos', $tbl_dizimos);
                $retorno = 2;
            } else {
                $this->db->insert('tbl_dizimos', $tbl_dizimos);
                $retorno = 1;
            }
        } else {
            $retorno = 4;
        }

        return $retorno;
    }

    ////////////////////////////////////////
    // CADASTRO DE OFERTAS                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////   
    public function cadOferta()
    {

        $id_congregacao = $this->session->userdata('id_congregacao');
        $id_setor = $this->session->userdata('id_setor');
        if ($this->input->post('txt_doc2') == TRUE) {
            $nro_doc = $this->input->post('txt_doc2');
        } else {
            $nro_doc = $this->session->userdata('nro_doc');
        }
        $data = $this->input->post('dtLancamentoO');
        $valor_real = str_replace(".", "", $this->input->post('valorO'));
        $valor_entrada = str_replace(",", ".", $valor_real);
        $descricaoO = $this->input->post('descricaoO');


        $tbl_ofertas = array(
            "id_congregacao" => $id_congregacao,
            "nro_doc" => $nro_doc,
            "data" => data_sql($data),
            "valor_entrada" => $valor_entrada,
            "anexo" => '',
            "descricao" => $descricaoO,
            "status" => 'A'
        );

        $periodo = $this->busca_periodo(data_sql($data), $id_setor);
        if ($periodo === 1) {
            if ($this->input->post('id_ofertaO') == TRUE) {
                $id_oferta = $this->input->post('id_ofertaO');
                $this->db->where('id_oferta', $id_oferta);
                $this->db->update('tbl_ofertas', $tbl_ofertas);
                $retorno = 2;
            } else {
                $this->db->insert('tbl_ofertas', $tbl_ofertas);
                $retorno = 1;
            }
        } else {
            $retorno = 4;
        }

        return $retorno;
    }

    ////////////////////////////////////////
    // CADASTRO DE DEPESAS             
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////   
    public function cadDespesa()
    {
        $id_congregacao = $this->session->userdata('id_congregacao');
        $id_setor = $this->session->userdata('id_setor');
        $data_despesa = $this->input->post('data_despesa');
        $valor_desp = str_replace(".", "", $this->input->post('valor_despesa'));
        $valor_despesa = str_replace(",", ".", $valor_desp);
        $id_tipo_despesa = $this->input->post('id_tipo_despesa');
        $descricao_despesa = $this->input->post('descricao_despesa');


        $tbl_despesas = array(
            "id_congregacao" => $id_congregacao,
            "id_tipo_despesa" => $id_tipo_despesa,
            "data_despesa" => data_sql($data_despesa),
            "valor_despesa" => $valor_despesa,
            "anexo" => '',
            "descricao" => $descricao_despesa,
            "status" => 'A'
        );
        $periodo = $this->busca_periodo(data_sql($data_despesa), $id_setor);
        if ($periodo === 1) {
            if ($this->input->post('id_despesa') == TRUE) {
                $id_despesa = $this->input->post('id_despesa');
                $this->db->where('id_despesa', $id_despesa);
                $this->db->update('tbl_despesas', $tbl_despesas);
                $retorno = 2;
            } else {
                $this->db->insert('tbl_despesas', $tbl_despesas);
                $retorno = 1;
            }
        } else {
            $retorno = 4;
        }
        return $retorno;
    }

    public function fecharMovimento()
    {
        $retorno = $this->m_retorno->retDataPeriodo();
        $dt_abertura = $retorno->row()->dt_abertura;
        $dt_fechamento = $retorno->row()->dt_fechamento;
        $id_congregacao = $this->session->userdata('id_congregacao');

        $this->db->where('status', 'A');
        $this->db->where("data BETWEEN '$dt_abertura' AND '$dt_fechamento'");
        $this->db->where('id_congregacao', $id_congregacao);
        $return = $this->db->get('tbl_movimento');

        if ($return->num_rows() > 0) {
            $ret = 3;
        } else {
            $id_movimento = $return->row()->id_movimento;
            echo $id_movimento;
            exit();

            $tbl_dtmovimento = array(
                "status" => 'V'
            );
            $this->db->where('id_movimento', $id_movimento);
            $this->db->update('tbl_dtmovimento', $tbl_dtmovimento);
            $ret = 1;
        }

        //$retorno = 2;
        return $ret;
    }
}
