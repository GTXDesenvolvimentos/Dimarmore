<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Account extends CI_Controller
{

    ////////////////////////////////////////
    // HOME PADRAO                     
    // CRIADO POR MARCIO SILVA            
    // DATA: 31/05/2019                   
    ////////////////////////////////////////    
    public function index()
    {
        //$retorno['into_top'] = $this->load->view('includes/into/into_top', '', TRUE);
        $this->load->view('includes/header');
        $this->load->view('includes/menu_left');
        $this->load->view('includes/menu_sup');
        $this->load->view('v_account');
        $this->load->view('includes/footer');
    }

    public function uploadimg()
    {
        $config['upload_path']          = './assets/uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 200;
        $config['max_width']            = 8024;
        $config['max_height']           = 8068;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $msg['img'] = '<div class="col-12 mb-4 px-0"><div class="card bg-danger text-white shadow"><div class="card-body"><h4>Atenção!</h4>' . $this->upload->display_errors() . '<div class="text-white-50 small"></div></div></div></div>';
        } else {

            $msg['img'] = '<div class="col-12 mb-4 px-0"><div class="card bg-success text-white shadow"><div class="card-body"><h4>Sucesso!</h4>Imagem alterada com sucesso!<div class="text-white-50 small"></div></div></div></div>';
        }
        $this->load->view('includes/header');
        $this->load->view('includes/menu_left');
        $this->load->view('includes/menu_sup');
        $this->load->view('v_account', $msg);
        $this->load->view('includes/footer');
    }



















    public function indexqqq()
    {
        $this->load->model('local/M_funcoes');
        $retorno['cadastro'] = $this->M_funcoes->retCadastro();
        $this->load->view('includes/header');
        //$this->load->view('includes/menu_left');
        //$this->load->view('includes/menu_sup');
        $this->load->view('master/v_pessoais', $retorno);
        $this->load->view('includes/footer');
    }

    public function retCadastro()
    {
        $this->load->model('local/M_funcoes');
        $retorno = $this->M_funcoes->retCadastro();
        echo json_encode($retorno->result());
    }

    public function print_etiqueta()
    {
        $this->load->library('mpdf123/mpdf');

        ini_set('memory_limit', '1024M');
        ob_start();
        $stylesheet = NULL;

        $this->load->model('int_telefonia/m_retorno');

        $this->load->model('local/M_funcoes');
        $retorno['linha_rel'] = $this->M_funcoes->retCadastro();


        $this->load->view('master/v_printrel', $retorno);


        $html = ob_get_clean();
        //
        $mpdf = new mPDF('c', '', '', '', 6, 6, 12, 5, 5, 5);
        //        $mpdf->setTitle('RELATÓRIO DE CHAMADAS TELEFÔNICAS');
        //
        //        $header = '<table  width="100%" style="border-bottom: solid 1px #000;">
        //                    <thead>
        //                        <tr heigth="100px">
        //                            <td width="20%" style="padding-bottom: 7px;"><img src=\'assets/image/logo.png\' width=\'145\' /></td>
        //                            <td width="40%" colspan="2" style="text-align:center; vertical-align: bottom; padding: 0px;">
        //                                <h2>RELATÓRIO DE CHAMADAS TELEFÔNICAS</h2>
        //                            </td>
        //                            <td width="20%" style="text-align: right">Página {PAGENO} / {nbpg}</td>
        //                        </tr>
        //                    </thead>
        //                </table>';
        //
        //        $mpdf->SetHTMLHeader($header);
        //
        //        $footer = ' <table width="100%">
        //                <tr>
        //                    <td colspan="2" style="text-align: center; vertical-align: top; font-size: 12px; border-bottom: 1px solid #000; padding-bottom: 1px;">' . $msg_filter . '</td>
        //                </tr>
        //                <tr>
        //                    <td width="20%" style="font-size: 12px;text-align:center;">' . dataServ() . ' - ' . horaServ() . '</td>
        //                    <td width="80%" style="font-size: 12px; text-align: center;">Av. Paulo Ayres, n° 240 - Taboão da Serra - SP - CEP 06767-220 - Telefone (11) 2186-3700</td>
        //                </tr>
        //            </table>';
        //        $mpdf->SetHTMLFooter($footer);
        $mpdf->WriteHTML($stylesheet, 1);
        $mpdf->WriteHTML($html);
        //        
        //
        $mpdf->OutPut();
    }
}
