<style>
    .disabled {
        pointer-events: none;
        touch-action: none;
    }

    .modal-backdrop {
        width: 5000px;
        height: 5000px;
    }

    /* 
    .table-bordered table,
    .table-bordered th,
    .table-bordered td,
    .table-bordered thead td, .table-bordered thead th,
    .table .thead-light th {
        border: 1px solid black;
    } */


    @media (max-width: 500px) and (orientation: portrait) {
        /* RETRATO */

        body {
            zoom: 95%;
            overflow-x: hidden !important;
        }

        #div_tabAtiv {
            zoom: 70%;
        }

        #tableHistorico {
            zoom: 70%;
        }

        .modal-fullscreen .modal-dialog {
            max-width: 100%;
            margin: 0;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100vh;
            display: flex;
            position: fixed;
            z-index: 100000;
        }
    }

    @media (max-width: 800px) and (orientation: landscape) {
        /* PAISAGEM */

        /* body{
            zoom: 70%;
        } */




        .modal-fullscreen .modal-dialog {
            max-width: 100vh;
            margin: 0;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100vw;
            height: 100vh;
            display: flex;
            position: fixed;
            z-index: 100000;
        }

        #div_tabAtiv {
            zoom: 70%;
        }

        #tableHistorico {
            zoom: 70%;
        }
    }

    td {
        padding: 10px !important;
        font-size: 14px;
        color: #000;
    }
</style>

<div class="container mt-2 p-2">
    <div class="row mt-1">
        <div class="col-12 p-0">
            <div class="col-12">
                <h5 class="mb-0 py-3">Minhas Atividades</h5>
            </div>
            <div class="col-12">
                <div class="toolbar">
                    <!-- <button type="button" class="btn btn-sm btn-success btn-lg" data-toggle="modal" data-target="#ModalAtividades">ADICIONAR</button> -->
                    <button type="button" id="btn_todas" class="btn btn-sm btn-outline-info btn-lg" onclick="filtro('todas');">TODAS</button>
                    <button type="button" id="btn_aberto" class="btn btn-sm btn-info btn-lg" onclick="filtro('aberto');">EM ABERTO</button>
                    <button type="button" id="btn_revisar" class="btn btn-sm btn-outline-info btn-lg" onclick="filtro('revisar');">A REVISAR</button>
                    <button type="button" id="btn_concluida" class="btn btn-sm btn-outline-info btn-lg" onclick="filtro('concluida');">CONCLUÍDAS</button>
                </div>
                <div class="" id="div_tabAtiv"> <!--  data-show-export="true" -->
                    <table class="table align-items-center table-flush" id="tableAtividades" data-toggle="table" data-toolbar=".toolbar" data-flat="true" data-detail-view-by-click="true" data-page-list="[2, 5, 25, 50, 100, ALL]">
                        <thead class="thead-light">
                            <tr>
                                <!-- <th data-field="nomeAtividade" data-halign="center" data-align="left" data-sortable="true">Atividade</th>
                                <th data-field="descrAtividade" data-halign="center" data-align="left" data-sortable="true">Descrição</th> -->
                                <th class="col-1" data-field="dtEntregaAtividade" data-halign="center" data-align="center" data-sortable="true">Dt. prevista</th>
                                <th class="col-1" data-field="sitAtividade" data-halign="center" data-align="center" data-sortable="true" data-formatter="situation1">Situação</th>
                                <th class="col-2" data-field="atividade" data-halign="center" data-align="left" data-sortable="true">Atividade</th>
                                <th class="col-2" data-field="etapa" data-halign="center" data-align="left" data-sortable="true">Etapa</th>
                                <th class="col-2" data-field="projeto" data-halign="center" data-align="left" data-sortable="true">Projeto</th>
                                <!-- <th data-field="nomeResponsavel" data-halign="center" data-align="left" data-sortable="true">Responsável</th> -->
                                <th class="col-1" data-field="hist" data-halign="center" data-align="center" data-sortable="true" data-formatter="viewHistoric">Histórico</th>
                                <th class="col-1" data-field="anexoAtividade" data-halign="center" data-align="center" data-sortable="true" data-formatter="anexo">Anexo</th>
                                <?php if ($nivel != 2) { ?><th class="col-2" data-field="opc" data-halign="center" data-align="center" data-formatter="optAtividade">Opções</th><?php } ?>
                            </tr>
                        </thead>
                    </table>
                    <table class="table align-items-center table-flush d-none" id="tbl_atraso" data-toggle="table" data-flat="true" data-page-list="[2, 5, 25, 50, 100, ALL]" data-detail-view="true">
                        <thead class="thead-light">
                            <tr>
                                <!-- <th data-field="nomeAtividade" data-halign="center" data-align="left" data-sortable="true">Atividade</th>
                                <th data-field="descrAtividade" data-halign="center" data-align="left" data-sortable="true">Descrição</th> -->
                                <th data-field="dtEntregaAtividade" data-halign="center" data-align="left">Atrasadas</th>
                                <!-- <th data-field="sitAtividade" data-halign="center" data-align="center" data-sortable="true" data-formatter="situation1">Situação</th>
                                <th data-field="atividade" data-halign="center" data-align="left" data-sortable="true">Atividade</th>
                                <th data-field="etapa" data-halign="center" data-align="left" data-sortable="true">Etapa</th>
                                <th data-field="projeto" data-halign="center" data-align="left" data-sortable="true">Projeto</th> -->
                                <!-- <th data-field="nomeResponsavel" data-halign="center" data-align="left" data-sortable="true">Responsável</th> -->
                                <!-- <th data-field="hist" data-halign="center" data-align="center" data-sortable="true" data-formatter="viewHistoric">Histórico</th>
                                <th data-field="anexoAtividade" data-halign="center" data-align="center" data-sortable="true" data-formatter="anexo">Anexo</th>
                                <th data-field="opc" data-halign="center" data-align="center" data-formatter="optAtividade">Opções</th> -->
                            </tr>
                        </thead>
                    </table>
                    <table class="table align-items-center table-flush d-none" id="tbl_hoje" data-toggle="table" data-flat="true" data-detail-view-by-click="true" data-page-list="[2, 5, 25, 50, 100, ALL]">
                        <thead class="thead-light">
                            <tr>
                                <th colspan="<?= $nivel !== '2' ? '8' : '7' ?>" data-halign="center" data-align="left">Hoje - <?= date('d/m/Y') ?></th>
                            </tr>
                            <tr>
                                <!-- <th data-field="nomeAtividade" data-halign="center" data-align="left" data-sortable="true">Atividade</th>
                                <th data-field="descrAtividade" data-halign="center" data-align="left" data-sortable="true">Descrição</th> -->
                                <th class="col-1 d-none" data-field="dtEntregaAtividade" data-halign="center" data-align="center" data-sortable="true">Dt. prevista</th>
                                <th class="col-1" data-field="sitAtividade" data-halign="center" data-align="center" data-sortable="true" data-formatter="situation1">Situação</th>
                                <th class="col-2" data-field="atividade" data-halign="center" data-align="left" data-sortable="true">Atividade</th>
                                <th class="col-2 " data-field="nomeEtapa" data-halign="center" data-align="left" data-sortable="true">Etapa</th>
                                <th class="col-2 " data-field="nomeProjeto" data-halign="center" data-align="left" data-sortable="true">Projeto</th>
                                <!-- <th data-field="nomeResponsavel" data-halign="center" data-align="left" data-sortable="true">Responsável</th> -->
                                <th class="col-1" data-field="hist" data-halign="center" data-align="center" data-sortable="true" data-formatter="viewHistoric">Histórico</th>
                                <th class="col-1" data-field="anexoAtividade" data-halign="center" data-align="center" data-sortable="true" data-formatter="anexo">Anexo</th>
                                <?php if ($nivel !== '2') { ?> <th class="col-2" data-field="opc" data-halign="center" data-align="center" data-formatter="optAtividade">Opções</th><?php } ?>
                            </tr>
                        </thead>
                    </table>
                    <table class="table align-items-center table-flush d-none" id="tbl_futuro" data-toggle="table" data-flat="true" data-detail-view-by-click="true" data-page-list="[2, 5, 25, 50, 100, ALL]" data-detail-view="true">
                        <thead class="thead-light">
                            <tr>
                                <!-- <th data-field="nomeAtividade" data-halign="center" data-align="left" data-sortable="true">Atividade</th>
                                <th data-field="descrAtividade" data-halign="center" data-align="left" data-sortable="true">Descrição</th> -->
                                <th data-field="dtEntregaAtividade" data-halign="center" data-align="left">Próximas</th>
                                <!-- <th data-field="sitAtividade" data-halign="center" data-align="center" data-sortable="true" data-formatter="situation1">Situação</th>
                                <th data-field="atividade" data-halign="center" data-align="left" data-sortable="true">Atividade</th>
                                <th data-field="etapa" data-halign="center" data-align="left" data-sortable="true">Etapa</th>
                                <th data-field="projeto" data-halign="center" data-align="left" data-sortable="true">Projeto</th>
                                <th data-field="hist" data-halign="center" data-align="center" data-sortable="true" data-formatter="viewHistoric">Histórico</th>
                                <th data-field="anexoAtividade" data-halign="center" data-align="center" data-sortable="true" data-formatter="anexo">Anexo</th>
                                <th data-field="opc" data-halign="center" data-align="center" data-formatter="optAtividade">Opções</th> -->
                            </tr>
                        </thead>
                    </table>
                </div>

                <!-- <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="tableAtividades2" data-toolbar=".toolbar" toobar data-toggle="table" data-flat="true" data-search="true" data-show-pagination-switch="true" data-pagination="true" data-show-export="true" data-detail-formatter="detailFormatter" data-page-list="[2, 5, 25, 50, 100, ALL]" data-url="<?php // base_url('home/retAtividades') 
                                                                                                                                                                                                                                                                                                                                                                    ?>">
                        <thead class="thead-light">
                            <tr>
                                <th data-field="dtEntregaAtividade" data-halign="center" data-align="center" data-sortable="true">Data prevista</th>
                                <th data-field="sitAtividade" data-halign="center" data-align="center" data-sortable="true" data-formatter="situation1">Situação</th>
                                <th data-field="atividade" data-halign="center" data-align="left" data-sortable="true">Atividade</th>
                                <th data-field="etapa" data-halign="center" data-align="left" data-sortable="true">Etapa</th>
                                <th data-field="projeto" data-halign="center" data-align="left" data-sortable="true">Projeto</th>
                                <th data-field="" data-halign="center" data-align="center" data-sortable="true" data-formatter="viewHistoric">Histórico</th>
                                <th data-field="anexoAtividade" data-halign="center" data-align="center" data-sortable="true" data-formatter="anexo">Anexo</th>
                                <th data-halign="center" data-align="center" data-formatter="optAtividade">Opções</th>
                            </tr>
                        </thead>
                    </table>
                </div> -->
            </div>
        </div>
    </div>

    <!-- 1ª coluna: “data prevista” - ordenar pelo mais antigo
    2ª coluna: “situação”
    3ª - atividade
    4ª - etapa
    5ª - projeto
    6ª - responsável
    7ª, 8ª, 9º - histórico, anexo, opções -->

    <script>
        // Reabre modal de Histórico quando fechar anexo
        reabre_modal = 0;

        filtrado = '';

        // CONTROLE DE EXPANDIR TODAS AS ATIVIDADES CONFORME CLICA NA LABEL ATRASADAS OU PRÓXIMAS
        // fut_exp = false;
        // atra_exp = false;

        // IDENTIFICA SE É DISPOSITIVO MÓVEL
        mobile = false;

        // NÍVEL DE ACESSO AO SISTEMA (USUÁRIO, ADM, ...?)
        nivel = <?= $nivel ?>;

        function optAtividade(index, row) {

            // DEIXA BOTÃO MAIOR SE FOR MOBILE
            btn_maior = mobile ? "btn-block" : 'btn-sm';

            if (row.sitAtividade == 'R') {
                ret = `<button type="button" class="btn btn-secondary disabled ${btn_maior}" ><i class="fas fa-edit"></i></button> <button type="button" class="btn btn-secondary ${btn_maior} disabled"><i class="fas fa-trash-alt"></i></button>`;
            } else {
                ret = `<button type="button" class="btn btn-outline-success ${btn_maior}" onclick='altAtividade(` + JSON.stringify(row) + `);'><i class="fas fa-edit"></i></button> <button type="button" class="btn btn-outline-danger ${btn_maior}" onclick="delAtividade(${row.id_atividade});"><i class="fas fa-trash-alt"></i></button>`;
            }

            return ret;
        }

        function delAtividade(id) {


            Swal.fire({
                title: "Excluir",
                text: 'Se confirmado, esse registro será excluído e não poderá ser recuperado, prosseguir?',
                icon: "question",
                confirmButtonColor: "#268917",
                denyButtonText: "Cancelar",
                confirmButtonText: "Prosseguir",
                showDenyButton: true,
                reverseButtons: true,
                preConfirm: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    excluir(id);
                }
            });
        }

        // Exclui Atividade
        function excluir(id) {
            $.ajax({
                url: base_url + "home/excluir",
                data: {
                    id_ativ: id
                },
                type: "POST",
                dataType: "json",
                cache: false,
                beforeSend: function() {
                    swal.fire({
                        title: "Aguarde!",
                        text: "Excluindo Atividade...",
                        imageUrl: base_url + "/assets/img/gifs/loader.gif",
                        showConfirmButton: false,
                    });
                },
                success: function(data) {
                    if (data.code == 2) {
                        swal.fire({
                            title: "Atenção!",
                            html: data.message,
                            icon: "info",
                            confirmButtonColor: "#0b475a",
                            confirmButtonText: "Voltar",
                        });
                    } else if (data.code == 0) {
                        swal.fire("Atenção!", data.message, "warning");
                    } else if (data.code == 1) {

                        Swal.fire({
                            title: "Sucesso!",
                            text: data.message,
                            icon: "success",
                            confirmButtonColor: "#268917",
                            confirmButtonText: "Sair",
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                filtro(filtrado);
                            }
                        });


                    }
                },
                error: function(xhr, er) {
                    swal.fire("Atenção!", "Não foi possível excluir o registro!", "error");
                },
            });
        }

        function viewHistoric(index, row) {

            btn_maior = mobile ? "btn-block" : 'btn-sm';

            return `<button type="button" class="btn btn-outline-success ${btn_maior} " onclick='buscaHistorico(` + row.id_atividade + `)'><i class="fas fa-search"></i></button>`;
        }

        function anexo(index, row) {

            // console.log(row)

            btn_maior = mobile ? "btn-block" : 'btn-sm';

            if (row.anexoAtividade != "" && row.anexoAtividade != null) {
                return (
                    `<buttom class="btn btn-outline-primary ${btn_maior}" onclick="ver_anexo('${row.anexoAtividade}' , '${row.nomeAtividade}');"><i class="fa-regular fa-images"></i></button`
                );
            }
        }

        function ver_anexo(anexoAtividade, nomeAtividade) {


            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
                url = base_url + "/assets/uploads/" + anexoAtividade;

                // Cria um novo elemento 'a'
                var elemento = $("<a/>");

                // Define o URL do arquivo que você deseja baixar
                elemento.attr("href", url);

                // Define o atributo 'download' para o nome desejado do arquivo baixado
                elemento.attr("download", 'Anexo ' + nomeAtividade);

                // Aciona o evento de clique no elemento para iniciar o download
                elemento[0].click();

                // Remove o elemento
                elemento.remove();

                return;
            }

            modalAnexo(anexoAtividade);
        }

        function altAtividade(value) {

            $('#txtIdAtividade').val(value.id_atividade);
            $('#slAtivDepto').selectpicker('val', value.id_departamento);

            selectProjetos(value.id_departamento, {
                projeto: value.id_projeto,
                etapa: value.id_etapa
            })

            $('#txtNomeAtividade').val(value.nomeAtividade);
            $('#txtDescAtividade').val(value.descrAtividade);
            $('#slRespAtividade').selectpicker('val', value.id_responsavel);
            $('#slAtivStatus').selectpicker('val', value.sitAtividade);

            if (typeof(value.dtEntregaAtividade) == 'string') {
                $('#txtDataFimAtividade').val((value.dtEntregaAtividade).split('/').reverse().join('-'));
            }
            $('#ModalAtividades').modal('show');
        }

        function situation1(value, row) {

            btn_maior = mobile ? "btn-block" : 'btn-sm';

            if (value == 'A') {
                return `<button class="btn btn-outline-dark ${btn_maior}" data-toggle="modal" data-target="#modalAltSituacao" onclick='posicionaValor(` + JSON.stringify(row) + `)'>Aguardando</button>`;
            } else if (value == `P`) {
                return `<button class="btn btn-outline-danger ${btn_maior}" data-toggle="modal" data-target="#modalAltSituacao" onclick='posicionaValor(` + JSON.stringify(row) + `)'>Pendente</button>`;
            } else if (value == `I`) {
                // return `<button class="btn btn-outline-primary ${btn_maior}" data-toggle="modal" data-target="#modalAltSituacao" onclick='posicionaValor(` + JSON.stringify(row) + `)'>Iniciada</button>`;
                return `<button class="btn btn-outline-dark ${btn_maior}" data-toggle="modal" data-target="#modalAltSituacao" onclick='posicionaValor(` + JSON.stringify(row) + `)'>Aguardando</button>`;
            } else if (value == `C`) {
                return `<button class="btn btn-outline-success ${btn_maior}" data-toggle="modal" data-target="#modalAltSituacao" onclick='posicionaValor(` + JSON.stringify(row) + `)'>Concluída</button>`;
            } else if (value == `E`) {
                return `<button class="btn btn-outline-warning ${btn_maior}" data-toggle="modal" data-target="#modalAltSituacao" onclick='posicionaValor(` + JSON.stringify(row) + `)'>Executando</button>`;
            } else if (value == `R`) {
                return `<button class="btn btn-secondary ${btn_maior} disabled">Revisada</button>`;
            }
        }

        function filtro(btn) {

            filtrado = btn;

            $('div.toolbar button:not(button.btn-success)').addClass('btn-outline-info').removeClass('btn-info')
            $(`#btn_${btn}`).addClass('btn-info').removeClass('btn-outline-info');
            $('#tableAtividades').bootstrapTable('removeAll');


            $.ajax({
                url: base_url + "home/filtro",
                data: {
                    tipo: btn
                },
                type: "POST",
                dataType: "json",
                cache: false,
                beforeSend: function() {
                    swal.fire({
                        title: "Aguarde!",
                        text: "Filtrando Atividades...",
                        imageUrl: base_url + "/assets/img/gifs/loader.gif",
                        showConfirmButton: false,
                    });
                },

                success: function(data) {

                    if ($.inArray(btn, ['revisar', 'concluida', 'todas']) !== -1) {
                        // $('#tableAtividades').load(data);
                        // console.log(data.length);

                        $('#tbl_atraso, #tbl_hoje, #tbl_futuro').addClass('d-none');
                        $('#tableAtividades').removeClass('d-none');

                        $('#tableAtividades').bootstrapTable('showColumn', 'sitAtividade')
                        $('#tableAtividades').bootstrapTable('showColumn', 'atividade')
                        // $('#tableAtividades').bootstrapTable('showColumn', 'etapa')
                        // $('#tableAtividades').bootstrapTable('showColumn', 'projeto')
                        // $('#tableAtividades').bootstrapTable('showColumn', 'hist')
                        $('#tableAtividades').bootstrapTable('showColumn', 'anexoAtividade')
                        // $('#tableAtividades').bootstrapTable('showColumn', 'opc')

                        if (data.length == 0) {
                            swal.fire({
                                title: "Atenção!",
                                html: 'Nenhuma Atividade Foi Encontrada Para Esse Filtro.',
                                icon: "info",
                            });
                            return;
                        }

                        swal.close();

                        $('#tableAtividades').bootstrapTable('append', data)

                        $('#tableAtividades').on('post-body.bs.table', function(e, args) {
                            $('.accordion-toggle').off('click').on('click', function() {
                                $($(this).data('target')).collapse('toggle');
                            })
                        })

                        // console.log(mobile);
                        // if (mobile) {
                        //     setTimeout(function() {
                        //         $('.btn-sm').removeClass('btn-sm');
                        //     }, 5000)
                        // }


                    } else if (btn == 'aberto') {

                        // console.log('213')

                        $('#tableAtividades').addClass('d-none');

                        // console.log(data.atraso.length);

                        $('#tbl_atraso').bootstrapTable('removeAll');
                        if (data.atraso.length > 0) {



                            $('#tbl_atraso').bootstrapTable('destroy');

                            $('#tbl_atraso').bootstrapTable({
                                detailView: true,
                                onExpandRow: function(index, row, $detail) {
                                    $detail.html('Carregando dados...');
                                    columns = [{
                                            field: 'sitAtividade',
                                            title: 'Situação',
                                            align: 'center',
                                            valign: 'middle',
                                            formatter: situation1,
                                            class: 'col-2'

                                        },
                                        {
                                            field: 'atividade',
                                            title: 'Atividade',
                                            align: 'center',
                                            valign: 'middle',
                                            class: 'col-2'
                                        },
                                        {
                                            field: 'nomeEtapa',
                                            title: 'Etapa',
                                            align: 'center',
                                            valign: 'middle',
                                            class: 'col-2'
                                        },
                                        {
                                            field: 'nomeProjeto',
                                            title: 'Projeto',
                                            align: 'center',
                                            valign: 'middle',
                                            class: 'col-2'
                                        },
                                        // {
                                        //     field: 'nomeAtividade',
                                        //     title: 'Atividade',
                                        //     align: 'center',
                                        //     valign: 'middle',
                                        //     class: 'col-2'
                                        // },
                                        // {
                                        //     field: 'descrAtividade',
                                        //     title: 'Descrição',
                                        //     align: 'center',
                                        //     valign: 'middle',
                                        //     class: 'col-2'
                                        // },
                                        {
                                            field: 'hist',
                                            title: 'Histórico',
                                            align: 'center',
                                            valign: 'middle',
                                            formatter: viewHistoric,
                                            class: 'col-1'
                                        },
                                        {
                                            field: 'anexoAtividade',
                                            title: 'Anexo',
                                            align: 'center',
                                            valign: 'middle',
                                            formatter: anexo,
                                            class: 'col-1'
                                        },
                                        <?php if ($nivel != 2) { ?> {
                                                field: '',
                                                title: 'Opções',
                                                align: 'center',
                                                valign: 'middle',
                                                formatter: optAtividade,
                                                class: 'col-2'
                                            }
                                        <?php } ?>,
                                    ];
                                    // console.log(row.atividades);
                                    $detail.html('<table data-show-print="true" class="tbl_sub_atraso table table-bordered no-table-hover table-striped table-sm mb-2"><thead class="thead-light"></thead></table>').find('table').bootstrapTable({
                                        columns: columns,
                                        data: row.atividades,
                                    });

                                    if (screen.orientation.angle == 0) {
                                        $('.tbl_sub_atraso').bootstrapTable('hideColumn', 'nomeEtapa');
                                        $('.tbl_sub_atraso').bootstrapTable('hideColumn', 'nomeProjeto');
                                    }
                                    if (mobile) {
                                        $('.btn-sm').removeClass('btn-sm');
                                    }
                                }
                            });

                            // $('div.th-inner:contains("Atrasadas")').on('click', () => {

                            //     if (atra_exp === false) {
                            //         $('#tbl_atraso').bootstrapTable('expandAllRows');
                            //         atra_exp = true;
                            //     } else {
                            //         $('#tbl_atraso').bootstrapTable('collapseAllRows');
                            //         atra_exp = false;
                            //     }

                            // })

                            $('#tbl_atraso').bootstrapTable('append', data.atraso);
                            $('#tbl_atraso').removeClass('d-none');
                        }

                        $('#tbl_futuro').bootstrapTable('removeAll');

                        if (data.futuro.length > 0) {

                            $('#tbl_futuro').bootstrapTable('destroy');

                            $('#tbl_futuro').bootstrapTable({
                                detailView: true,
                                onExpandRow: function(index, row, $detail) {
                                    $detail.html('Carregando dados...');
                                    columns = [{
                                            field: 'sitAtividade',
                                            title: 'Situação',
                                            align: 'center',
                                            valign: 'middle',
                                            formatter: situation1,
                                            class: 'col-2'

                                        },
                                        // {
                                        //     field: 'nomeAtividade',
                                        //     title: 'Atividade',
                                        //     align: 'center',
                                        //     valign: 'middle',
                                        //     class: 'col-2'
                                        // },
                                        // {
                                        //     field: 'descrAtividade',
                                        //     title: 'Descrição',
                                        //     align: 'center',
                                        //     valign: 'middle',
                                        //     class: 'col-2'
                                        // },
                                        {
                                            field: 'atividade',
                                            title: 'Atividade',
                                            align: 'center',
                                            valign: 'middle',
                                            class: 'col-2'
                                        },
                                        {
                                            field: 'nomeEtapa',
                                            title: 'Etapa',
                                            align: 'center',
                                            valign: 'middle',
                                            class: 'col-2'
                                        },
                                        {
                                            field: 'nomeProjeto',
                                            title: 'Projeto',
                                            align: 'center',
                                            valign: 'middle',
                                            class: 'col-2'
                                        },
                                        {
                                            field: 'hist',
                                            title: 'Histórico',
                                            align: 'center',
                                            valign: 'middle',
                                            formatter: viewHistoric,
                                            class: 'col-1'
                                        },
                                        {
                                            field: 'anexoAtividade',
                                            title: 'Anexo',
                                            align: 'center',
                                            valign: 'middle',
                                            formatter: anexo,
                                            class: 'col-1'
                                        },
                                        <?php if ($nivel != 2) { ?> {
                                                field: '',
                                                title: 'Opções',
                                                align: 'center',
                                                valign: 'middle',
                                                formatter: optAtividade,
                                                class: 'col-2'
                                            }
                                        <?php } ?>
                                    ];
                                    // console.log(row.atividades);
                                    $detail.html('<table data-show-print="true" class="tbl_sub_futuro table table-bordered no-table-hover table-striped table-sm mb-2"><thead class="thead-light"></thead></table>').find('table').bootstrapTable({
                                        columns: columns,
                                        data: row.atividades,
                                    });

                                    if (screen.orientation.angle == 0) {
                                        $('.tbl_sub_futuro').bootstrapTable('hideColumn', 'nomeEtapa');
                                        $('.tbl_sub_futuro').bootstrapTable('hideColumn', 'nomeProjeto');
                                    }

                                    if (mobile) {
                                        $('.btn-sm').removeClass('btn-sm');
                                    }
                                }
                            })

                            $('#tbl_futuro').bootstrapTable('append', data.futuro);

                            // $('div.th-inner:contains("Próximas")').on('click', () => {

                            //     if (fut_exp === false) {
                            //         $('#tbl_futuro').bootstrapTable('expandAllRows');
                            //         fut_exp = true;
                            //     } else {
                            //         $('#tbl_futuro').bootstrapTable('collapseAllRows');
                            //         fut_exp = false;
                            //     }

                            // })



                            // Destrói a tabela
                            // $('#tableAtividades').bootstrapTable('destroy');

                            // // Inicializa a tabela com a visualização de detalhes ativada
                            // $('#tableAtividades').bootstrapTable({
                            //     detailView: true,
                            //     onExpandRow: function(index, row, $detail) {
                            //         $detail.html('Carregando dados...');
                            //         columns = [{
                            //                 field: 'situacao',
                            //                 title: 'Situação',
                            //                 align: 'center',
                            //                 valign: 'middle',
                            //                 formatter: situation1

                            //             }, {
                            //                 field: 'atividade',
                            //                 title: 'Atividade',
                            //                 align: 'center',
                            //                 valign: 'middle'
                            //             },
                            //             {
                            //                 field: 'descricao',
                            //                 title: 'Descrição',
                            //                 align: 'center',
                            //                 valign: 'middle'
                            //             },
                            //             {
                            //                 field: 'anexo',
                            //                 title: 'Anexo',
                            //                 align: 'center',
                            //                 valign: 'middle',
                            //                 formatter: anexo
                            //             },
                            //             {
                            //                 field: '',
                            //                 title: 'Opções',
                            //                 align: 'center',
                            //                 valign: 'middle',
                            //                 formatter: optAtividade
                            //             },
                            //         ];
                            //         console.log(row.atividades);
                            //         $detail.html('<table id="tbl_atividades"  data-show-print="true" class="table table-bordered thead-dark no-table-hover table-striped table-sm mb-2"></table>').find('table').bootstrapTable({
                            //             columns: columns,
                            //             data: row.atividades,
                            //         });
                            //     }
                            // });

                            // $('#tableAtividades').bootstrapTable('load', data);

                            // console.log(data);

                            // /* ESCONDER COLUNAS */

                            // $('#tableAtividades').bootstrapTable('hideColumn', 'sitAtividade')
                            // $('#tableAtividades').bootstrapTable('hideColumn', 'atividade')
                            // $('#tableAtividades').bootstrapTable('hideColumn', 'etapa')
                            // $('#tableAtividades').bootstrapTable('hideColumn', 'projeto')
                            // $('#tableAtividades').bootstrapTable('hideColumn', 'hist')
                            // $('#tableAtividades').bootstrapTable('hideColumn', 'anexoAtividade')
                            // $('#tableAtividades').bootstrapTable('hideColumn', 'opc')

                        }

                        $('#tbl_hoje').bootstrapTable('removeAll');
                        $('#tbl_hoje, #tbl_futuro').removeClass('d-none');

                        if (data.diario.length > 0) {

                            $('#tbl_hoje').bootstrapTable('append', data.diario);

                        }


                    }

                    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
                        mobile = true;

                        $('.btn-sm').removeClass('btn-sm');

                        $('.container').addClass('container-fluid').removeClass('container');

                        // alert(typeof screen.orientation.angle);

                        $('#tableHistorico').bootstrapTable('hideColumn', 'id_atividade')

                        if (screen.orientation.angle == 0) {
                            $("#tbl_hoje").bootstrapTable("hideColumn", "nomeEtapa");

                            $("#tbl_hoje").bootstrapTable("hideColumn", "nomeProjeto");

                            $("#tableAtividades").bootstrapTable("hideColumn", "hist");
                            $("#tableAtividades").bootstrapTable("hideColumn", "etapa");
                            $("#tableAtividades").bootstrapTable("hideColumn", "projeto");

                            $('.tbl_sub_futuro').bootstrapTable('hideColumn', 'nomeEtapa');
                            $('.tbl_sub_futuro').bootstrapTable('hideColumn', 'nomeProjeto');

                            $('.tbl_sub_atraso').bootstrapTable('hideColumn', 'nomeEtapa');
                            $('.tbl_sub_atraso').bootstrapTable('hideColumn', 'nomeProjeto');
                        }
                        // $('th>div:contains("Data prevista")').text("Dt. limite");



                        // DETECTA ROTAÇÃO DO DISPOSITIVO E AJUSTA CONFORME A TELA FICAR
                        $(window).resize(function() {
                            if ($(window).height() > $(window).width()) {
                                console.log("Modo retrato!");
                                $('#tableHistorico').bootstrapTable('hideColumn', 'id_atividade')
                                $("#tbl_hoje").bootstrapTable("hideColumn", "nomeEtapa");
                                $("#tbl_hoje").bootstrapTable("hideColumn", "nomeProjeto");

                                $('.tbl_sub_futuro').bootstrapTable('hideColumn', 'nomeEtapa');
                                $('.tbl_sub_futuro').bootstrapTable('hideColumn', 'nomeProjeto');

                                $('.tbl_sub_atraso').bootstrapTable('hideColumn', 'nomeEtapa');
                                $('.tbl_sub_atraso').bootstrapTable('hideColumn', 'nomeProjeto');

                                $("#tableAtividades").bootstrapTable("hideColumn", "hist");
                                $("#tableAtividades").bootstrapTable("hideColumn", "etapa");
                                $("#tableAtividades").bootstrapTable("hideColumn", "projeto");
                            } else {
                                console.log("Modo paisagem!");

                                $('#tableHistorico').bootstrapTable('showColumn', 'id_atividade')
                                $("#tableAtividades").bootstrapTable("showColumn", "hist");
                                $("#tbl_hoje").bootstrapTable("showColumn", "nomeEtapa");
                                $("#tbl_hoje").bootstrapTable("showColumn", "nomeProjeto");

                                $('.tbl_sub_futuro').bootstrapTable('showColumn', 'nomeEtapa');
                                $('.tbl_sub_futuro').bootstrapTable('showColumn', 'nomeProjeto');

                                $('.tbl_sub_atraso').bootstrapTable('showColumn', 'nomeEtapa');
                                $('.tbl_sub_atraso').bootstrapTable('showColumn', 'nomeProjeto');

                                $("#tableAtividades").bootstrapTable("showColumn", "hist");
                                $("#tableAtividades").bootstrapTable("showColumn", "etapa");
                                $("#tableAtividades").bootstrapTable("showColumn", "projeto");
                            }
                        });

                    }

                    swal.close();
                    // if (data.code == 2) {
                    // swal.fire({
                    //     title: "Atenção!",
                    //     html: data.message,
                    //     icon: "info",
                    //     showConfirmButton: false,
                    // });
                    // } else if (data.code == 0) {
                    //     swal.fire("Atenção!", data.message, "warning");
                    // } else {
                    //     window.location.href = base_url;
                    // }
                },
                error: function(xhr, er) {
                    swal.fire("Atenção!", "Ocorreu um erro ao retornar os dados!", "error");
                },
            });
        }

        // EXECUTA QUANDO PÁGINA COMPLETAMENTE CARREGADA
        // document.addEventListener("DOMContentLoaded", function() {
        //     $('#tbl_atraso').on('post-body.bs.table', function(e, data) {

        //         // Adiciona um manipulador de eventos de clique à célula
        //         $('td:nth-child(2) span').on('click', function() {
        //             var index = $(this).parent().parent().data('index');
        //             $('#tbl_atraso').bootstrapTable('expandRow', index);
        //         });
        //     });

        // });

        document.addEventListener("DOMContentLoaded", function() {
            $('#tbl_atraso').on('post-body.bs.table', function(e, data) {

                $('td:nth-child(2)>span').off('click');
                // Adiciona um manipulador de eventos de clique à célula
                $('td:nth-child(2)>span').on('click', function() {
                    var index = $(this).parent().parent().data('index');
                    var row = $('#tbl_atraso').bootstrapTable('getData')[index];

                    console.log(linhas[index])

                    if (linhas[index] == false || typeof(linhas[index]) == 'undefined') {
                        // Se a linha está em colapso, expanda
                        $('#tbl_atraso').bootstrapTable('expandRow', index);
                        linhas[index] = true;
                    } else {
                        // Se a linha já está expandida, entre em colapso
                        $('#tbl_atraso').bootstrapTable('collapseRow', index);
                        linhas[index] = false;
                    }

                    console.log(linhas[index])
                });

                $('td>.detail-icon>.fa-minus').on('click', function() {
                    var index = $(this).parent().parent().parent().data('index');
                    var row = $('#tbl_atraso').bootstrapTable('getData')[index];

                    linhas[index] = false;

                })

                $('td>.detail-icon>.fa-plus').on('click', function() {
                    var index = $(this).parent().parent().parent().data('index');
                    var row = $('#tbl_atraso').bootstrapTable('getData')[index];

                    linhas[index] = true;

                })

            });
        });

        linhas = []
    </script>