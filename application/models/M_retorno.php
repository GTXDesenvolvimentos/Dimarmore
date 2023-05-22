
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_retorno extends CI_Model
{
    ////////////////////////////////////////
    // RETORNO DE LOGIN                   //
    // CRIADO POR MARCIO SILVA            //
    // DATA: 31/05/2019                   //
    ////////////////////////////////////////
    public function login($dados)
    {
        $this->db->where('usuario', $dados['email']);
        $this->db->where('senha', md5($dados['password']));
        $this->db->where('A.status !=', 'D');
        $retorno = $this->db->get('tbl_users A');

        if ($retorno->num_rows() > 0) {
            $this->session->set_userdata("id_users", $retorno->row()->id_users);
            $this->session->set_userdata("nome", $retorno->row()->nome);
            $this->session->set_userdata("nivel", $retorno->row()->nivel);
            $this->session->set_userdata("status", $retorno->row()->status);
            $this->session->set_userdata("logado", 1);
            return true;
        } else {
            return false;
        }
    }

    ////////////////////////////////////////
    // RETORNO DE DEPARTAMENTOS           //
    // CRIADO POR MARCIO SILVA            //
    // DATA: 31/05/2019                   //
    ////////////////////////////////////////
    public function retDepto()
    {

        $this->db->select('*');
        $this->db->select("DATE_FORMAT(dtcria, '%d/%m/%Y') AS dtcria", FALSE);
        $this->db->where('status !=', 'D');
        $retorno = $this->db->get('tbl_departamentos');
        return $retorno;
    }


    ////////////////////////////////////////
    // RETORNO DE ETAPAS                  //
    // CRIADO POR MARCIO SILVA            //
    // DATA: 22/05/2022                   //
    ////////////////////////////////////////
    public function retEtapas()
    {

        $this->db->select('*');
        // $this->db->select("DATE_FORMAT(dtcria, '%d/%m/%Y') AS dtcria", FALSE);
        $this->db->where('status !=', 'D');
        $retorno = $this->db->get('tbl_etapas');
        return $retorno;
    }

    ////////////////////////////////////////
    // RETORNO DE ETAPAS                  //
    // CRIADO POR MARCIO SILVA            //
    // DATA: 22/05/2022                   //
    ////////////////////////////////////////
    public function retUsers()
    {

        $this->db->select('*');
        $this->db->where('status !=', 'D');
        $retorno = $this->db->get('tbl_users');

        return $retorno;
    }



































    ////////////////////////////////////////
    // RETORNO DE CONGREGACOES
    // CRIADO POR MARCIO SILVA 
    // DATA: 31/05/2019           
    ////////////////////////////////////////
    public function retCongregacoes()
    {
        if ($this->input->post('id_congregacao') == TRUE) {
            $id_congregacao = $this->input->post('id_congregacao');
            $this->db->where('A.id_congregacao', $id_congregacao);
        }
        $this->db->select('A.id_congregacao');
        $this->db->select('A.nome_congregacao');
        $this->db->select('C.logradouro');
        $this->db->select('C.bairro');
        $this->db->select('C.cep');
        $this->db->select('C.uf');
        $this->db->select('C.localidade');
        $this->db->select('A.numero');
        $this->db->select('A.descricao');
        $this->db->where('A.status !=', 'D');
        $this->db->where('B.id_setor', $this->session->userdata('id_setor'));
        $this->db->join("tbl_enderecos C", "A.id_endereco = C.id_endereco", "inner");
        $this->db->join("tbl_setor B", "A.id_setor = B.id_setor", "inner");
        $retorno = $this->db->get('tbl_congregacoes A');
        return $retorno;
    }

    public function busca_cep()
    {
        $cep = $this->input->post('cep');
        $cep1 = preg_replace("/[^0-9]/", "", $cep);
        //$cep1 = '06825030';
        $this->db->where('status !=', 'D');
        $this->db->where('cep', $cep1);
        $retorno = $this->db->get('tbl_enderecos');

        if ($retorno->num_rows() > 0) {
            return $retorno->result();
        } else {
            $url = "http://viacep.com.br/ws/$cep1/xml/";
            $xml = simplexml_load_file($url);
            if ($xml->erro != TRUE) {
                $grava_end = array(
                    "cep" => $cep1,
                    "logradouro" => $xml->logradouro,
                    "bairro" => $xml->bairro,
                    "localidade" => $xml->localidade,
                    "uf" => $xml->uf
                );
                $this->db->insert('tbl_enderecos', $grava_end);
                $id_endereco = $this->db->insert_id();
                $this->db->where('status !=', 'D');
                $this->db->where('id_endereco', $id_endereco);
                $ret = $this->db->get('tbl_enderecos');
                if ($ret->num_rows() > 0) {
                    $return = $ret->result();
                }
            } else {
                $return = $xml;
            }
            return $return;
        }


        //        $cep1 = preg_replace("/[^0-9]/", "", $cep);
        //        $url = "http://viacep.com.br/ws/$cep1/xml/";
        //        $xml = simplexml_load_file($url);
        //        return json_encode($xml);
        //        echo json_encode($xml);
        //$endereco = get_endereco("37500405");
        //echo $endereco;
    }

    ////////////////////////////////////////
    // RETORNA FUNÇOES (CARGO)            
    // CRIADO POR MARCIO SILVA            
    // DATA: 24/06/2019                   
    ////////////////////////////////////////    
    public function retFuncoes()
    {
        if ($this->input->post('id_funcao') == TRUE) {
            $id_funcao = $this->input->post('id_funcao');
            $this->db->where('id_funcao', $id_funcao);
        }
        $this->db->where('status !=', 'D');
        $retorno = $this->db->get('tbl_funcoes');
        return $retorno;
    }



    ////////////////////////////////////////
    // RETORNO DE PERÍODOS DE MOVIMENTOS
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////   
    public function retPeriodosMovimentos()
    {
        if ($this->input->post('id_movimento') == TRUE) {
            $id_movimento = $this->input->post('id_movimento');
            $this->db->where('id_movimento', $id_movimento);
        }
        $this->db->select('*');
        $this->db->order_by('A.id_movimento', 'desc');
        $this->db->select("DATE_FORMAT(A.dt_abertura, '%d/%m/%Y') AS dt_abertura", FALSE);
        $this->db->select("DATE_FORMAT(A.dt_fechamento, '%d/%m/%Y') AS dt_fechamento", FALSE);
        $this->db->where('A.status !=', 'D');
        $retorno = $this->db->get('tbl_dtmovimento A');
        return $retorno;
    }





    ////////////////////////////////////////
    // RETORNO DE DIZIMOS           
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////
    public function retDizimos()
    {
        if ($this->input->post('id_dizimo') == TRUE) {
            $id_dizimo = $this->input->post('id_dizimo');
            $this->db->where('A.id_dizimo', $id_dizimo);
        }

        if ($this->input->post('nro_doc') == TRUE) {
            $nro_doc = $this->input->post('nro_doc');
            $this->db->where('A.nro_doc', $nro_doc);
        } else {
            $this->db->where('A.status', 'A');
        }


        $this->db->select('*');
        $this->db->select("DATE_FORMAT(A.data, '%d/%m/%Y') AS data", FALSE);
        $this->db->select('A.descricao');
        $this->db->order_by('B.nome_contribuinte');
        $this->db->where('C.id_congregacao', $this->session->userdata('id_congregacao'));
        $this->db->join("tbl_contribuintes B", "A.id_contribuinte = B.id_contribuinte", "inner");
        $this->db->join("tbl_congregacoes C", "B.id_congregacao = C.id_congregacao", "inner");
        $retorno = $this->db->get('tbl_dizimos A');
        return $retorno;
    }

    ///////////////////////////////////////
    // RETORNO DE DATA DE LANÇAMENTOS     //
    // CRIADO POR MARCIO SILVA            //
    // DATA: 31/05/2019                   //
    ////////////////////////////////////////
    public function retdtmovimento()
    {
        $this->db->limit(1);
        $this->db->order_by('A.id_movimento', 'desc');
        $this->db->where('A.status', 'A');
        $this->db->select("DATE_FORMAT(dt_abertura, '%d/%m/%Y') AS dt_abertura", FALSE);
        $this->db->select("DATE_FORMAT(dt_fechamento, '%d/%m/%Y') AS dt_fechamento", FALSE);
        $this->db->where('A.id_setor', $this->session->userdata('id_setor'));
        $retorno = $this->db->get('tbl_dtmovimento A');
        return $retorno;
    }

    public function retDataPeriodo($id_movimento)
    {
        $id_setor = $this->session->userdata('id_setor');
        if ($id_movimento == NULL) {
            $ret_periodo = $this->db->query("select * from tbl_dtmovimento where id_movimento = (select max(id_movimento) as id_dtmovimento from tbl_dtmovimento where id_setor = $id_setor and status != 'D');");
        } else {
            $ret_periodo = $this->db->query("select * from tbl_dtmovimento where id_movimento = $id_movimento and id_setor = $id_setor and status != 'D';");
        }

        if ($ret_periodo->num_rows() > 0) {
            return $ret_periodo;
        } else {
            return 0;
        }
    }

    public function retDataPeriodos()
    {
        $id_setor = $this->session->userdata('id_setor');
        $ret_periodo = $this->db->query("select * from tbl_dtmovimento where id_setor = $id_setor and status != 'D'");
        return $ret_periodo;
    }

    public function retCountDizimos()
    {
        $id_movimento = $this->input->post('id_movimento');
        $retorno = $this->retDataPeriodo($id_movimento);
        $dt_abertura = $retorno->row()->dt_abertura;
        $dt_fechamento = $retorno->row()->dt_fechamento;
        $id_congregacao = $this->session->userdata('id_congregacao');

        $ret_dizimos = $this->db->query("
            SELECT sum(valor_entrada) valor_entrada 
            FROM tbl_dizimos 
            where id_congregacao = $id_congregacao
            and data between '$dt_abertura' and '$dt_fechamento'
            and status != 'D'
        ");
        if ($ret_dizimos->num_rows() > 0) {
            $retDizimos = $ret_dizimos->row()->valor_entrada == NULL ? '0.00' : number_format($ret_dizimos->row()->valor_entrada, 2, ',', '.');
        } else {
            $retDizimos = '0.00';
        }
        return $retDizimos;
    }

    public function retCountOfertas()
    {
        $id_movimento = $this->input->post('id_movimento');
        $retorno = $this->retDataPeriodo($id_movimento);
        $dt_abertura = $retorno->row()->dt_abertura;
        $dt_fechamento = $retorno->row()->dt_fechamento;
        $id_congregacao = $this->session->userdata('id_congregacao');

        $ret_ofertas = $this->db->query("
            SELECT sum(valor_entrada) valor_entrada 
            FROM tbl_ofertas 
            where id_congregacao = $id_congregacao
            and data between '$dt_abertura' and '$dt_fechamento'
            and status != 'D'
        ");

        $retOfertas = $ret_ofertas->row()->valor_entrada == NULL ? '0.00' : number_format($ret_ofertas->row()->valor_entrada, 2, ',', '.');
        return $retOfertas;
    }

    public function retCountDespesas()
    {
        $id_movimento = $this->input->post('id_movimento');
        $retorno = $this->retDataPeriodo($id_movimento);
        $dt_abertura = $retorno->row()->dt_abertura;
        $dt_fechamento = $retorno->row()->dt_fechamento;
        $id_congregacao = $this->session->userdata('id_congregacao');

        $ret_despesa = $this->db->query("
            SELECT sum(valor_despesa) valor_despesa 
            FROM tbl_despesas 
            where id_congregacao = $id_congregacao
            and data_despesa between '$dt_abertura' and '$dt_fechamento'
            and status != 'D'
        ");

        $retDespesa = $ret_despesa->row()->valor_despesa == NULL ? '0.00' : number_format($ret_despesa->row()->valor_despesa, 2, ',', '.');
        return $retDespesa;
    }

    private function count_dizimo($nro_doc)
    {
        $id_congregacao = $this->session->userdata('id_congregacao');
        $ret_dizimos = $this->db->query(""
            . "SELECT sum(valor_entrada) valor_entrada "
            . "FROM tbl_dizimos "
            . "where id_congregacao = $id_congregacao "
            . "and nro_doc = $nro_doc "
            . "and status != 'D'"
            . "");
        $retDizimos = $ret_dizimos->row()->valor_entrada == NULL ? '0.00' : number_format($ret_dizimos->row()->valor_entrada, 2, ',', '.');
        return $retDizimos;
    }

    private function count_oferta($nro_doc)
    {
        $id_congregacao = $this->session->userdata('id_congregacao');
        $ret_ofertas = $this->db->query("SELECT sum(valor_entrada) valor_entrada FROM tbl_ofertas where id_congregacao = $id_congregacao and nro_doc = $nro_doc and status != 'D'");
        $retOfertas = $ret_ofertas->row()->valor_entrada == NULL ? '0.00' : number_format($ret_ofertas->row()->valor_entrada, 2, ',', '.');
        return $retOfertas;
    }

    ////////////////////////////////////////
    // RETORNO DE LANÇAMENTOS ABERTOS     //
    // CRIADO POR MARCIO SILVA            //
    // DATA: 31/05/2019                   //
    ////////////////////////////////////////
    public function retLanAbertos()
    {
        $id_movimento = $this->input->post('id_movimento');
        $retorn = $this->retDataPeriodo($id_movimento);
        $dt_abertura = $retorn->row()->dt_abertura;
        $dt_fechamento = $retorn->row()->dt_fechamento;


        $this->db->where("data BETWEEN '$dt_abertura' AND '$dt_fechamento'");
        $this->db->where('A.status', 'A');
        $this->db->select("*", FALSE);
        $this->db->select("DATE_FORMAT(A.data, '%d/%m/%Y') AS data", FALSE);
        $this->db->where('A.id_congregacao', $this->session->userdata('id_congregacao'));
        $retorno = $this->db->get('tbl_movimento A');

        foreach ($retorno->result() as $linha) :
            $dizimoP = str_replace(".", "", $this->count_dizimo($linha->nro_doc));
            $ofertaP = str_replace(".", "", $this->count_oferta($linha->nro_doc));
            $dizimoV = str_replace(",", ".", $dizimoP);
            $ofertaV = str_replace(",", ".", $ofertaP);
            $total = ($dizimoV + $ofertaV);


            $ret[] = array(
                "id_movimento" => $linha->id_movimento,
                "nro_doc" => $linha->nro_doc,
                "descricao" => $linha->descricao,
                "data" => $linha->data,
                "dizimos" => 'R$ ' . $this->count_dizimo($linha->nro_doc),
                "ofertas" => 'R$ ' . $this->count_oferta($linha->nro_doc),
                "total" => 'R$ ' . number_format($total, 2, ',', '.'),
            );
        endforeach;
        return $ret;
    }

    ////////////////////////////////////////
    // RETORNO DE LANÇAMENTOS ABERTOS     //
    // CRIADO POR MARCIO SILVA            //
    // DATA: 31/05/2019                   //
    ////////////////////////////////////////
    public function retLancamentos()
    {
        $id_movimento = $this->input->post('id_movimento');
        $retorn = $this->retDataPeriodo($id_movimento);
        $dt_abertura = $retorn->row()->dt_abertura;
        $dt_fechamento = $retorn->row()->dt_fechamento;



        $this->db->where("data BETWEEN '$dt_abertura' AND '$dt_fechamento'");
        $this->db->select("*", FALSE);
        $this->db->select("DATE_FORMAT(A.data, '%d/%m/%Y') AS data", FALSE);
        $this->db->order_by('A.nro_doc', 'asc');
        $this->db->where('A.id_congregacao', $this->session->userdata('id_congregacao'));
        $retorno = $this->db->get('tbl_movimento A');

        foreach ($retorno->result() as $linha) :
            $dizimoP = str_replace(".", "", $this->count_dizimo($linha->nro_doc));
            $ofertaP = str_replace(".", "", $this->count_oferta($linha->nro_doc));
            $dizimoV = str_replace(",", ".", $dizimoP);
            $ofertaV = str_replace(",", ".", $ofertaP);
            $total = ($dizimoV + $ofertaV);


            $ret[] = array(
                "id_movimento" => $linha->id_movimento,
                "nro_doc" => $linha->nro_doc,
                "descricao" => $linha->descricao,
                "data" => $linha->data,
                "dizimos" => 'R$ ' . $this->count_dizimo($linha->nro_doc),
                "ofertas" => 'R$ ' . $this->count_oferta($linha->nro_doc),
                "total" => 'R$ ' . number_format($total, 2, ',', '.'),
            );
        endforeach;
        return $ret;
    }

    ////////////////////////////////////////
    // RETORNO DE DIZIMOS           
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////
    public function retOfertas()
    {
        if ($this->input->post('id_oferta') == TRUE) {
            $id_oferta = $this->input->post('id_oferta');
            $this->db->where('A.id_oferta', $id_oferta);
        }
        $this->db->select('*');
        $this->db->select("DATE_FORMAT(A.data, '%d/%m/%Y') AS data", FALSE);
        $this->db->select('A.descricao');
        $this->db->where('A.status', 'A');
        $this->db->order_by('A.data', 'asc');
        $this->db->where('B.id_congregacao', $this->session->userdata('id_congregacao'));
        $this->db->join("tbl_congregacoes B", "A.id_congregacao = B.id_congregacao", "inner");
        $retorno = $this->db->get('tbl_ofertas A');
        return $retorno;
    }

    ////////////////////////////////////////
    // RETORNO DE DESPESAS           
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////
    public function retDespesas()
    {
        if ($this->input->post('id_despesa') == TRUE) {
            $id_despesa = $this->input->post('id_despesa');
            $this->db->where('A.id_despesa', $id_despesa);
        }

        $id_movimento = $this->input->post('id_movimento');
        $retorn = $this->retDataPeriodo($id_movimento);
        $dt_abertura = $retorn->row()->dt_abertura;
        $dt_fechamento = $retorn->row()->dt_fechamento;

        $this->db->where("A.data_despesa BETWEEN '$dt_abertura' AND '$dt_fechamento'");

        $this->db->select('*');
        $this->db->select("DATE_FORMAT(A.data_despesa, '%d/%m/%Y') AS data_despesa", FALSE);
        $this->db->select('A.descricao');
        //$this->db->where('A.status', 'A');
        $this->db->order_by('A.id_despesa');
        $this->db->where('C.id_congregacao', $this->session->userdata('id_congregacao'));
        $this->db->join("tbl_tipos_despesas B", "B.id_tipo_despesa = A.id_tipo_despesa", "inner");
        $this->db->join("tbl_congregacoes C", "B.id_congregacao = C.id_congregacao", "inner");
        $retorno = $this->db->get('tbl_despesas A');
        return $retorno;
    }

    ////////////////////////////////////////
    // RETORNO DE TIPO DAS DESPESAS           
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////
    public function retTipoDespesas()
    {
        if ($this->input->post('id_tipo_despesa') == TRUE) {
            $id_tipo_despesa = $this->input->post('id_tipo_despesa');
            $this->db->where('A.id_tipo_despesa', $id_tipo_despesa);
        }
        $this->db->select('*');
        $this->db->select('A.descricao');
        $this->db->where('A.status !=', 'D');
        $this->db->order_by('A.id_tipo_despesa');

        if ($this->session->userdata('nivel') != 3) {
            $this->db->where('B.id_congregacao', $this->session->userdata('id_congregacao'));
        }

        $this->db->join("tbl_congregacoes B", "B.id_congregacao = A.id_congregacao", "inner");
        $this->db->join("tbl_setor C", "B.id_setor = C.id_setor", "inner");
        $retorno = $this->db->get('tbl_tipos_despesas A');
        return $retorno;
    }
}
