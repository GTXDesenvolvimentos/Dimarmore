<div class="container-fluid mt-2 p-2">
    <div class="row mt-1">
        <div class="col-12 p-0">
            <div class="col-12">
                <h5 class="mb-0 py-3">Atividades</h5>
            </div>
            <div class="col-12">
                <button type="button" class="btn btn-sm btn-success btn-lg toolbar" data-toggle="modal" data-target="#ModalAtividades">ADICIONAR</button>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="tableAtividades" data-toolbar=".toolbar" toobar data-toggle="table" data-flat="true" data-search="true" data-show-pagination-switch="true" data-pagination="true" data-show-export="true" data-detail-formatter="detailFormatter" data-page-list="[2, 5, 25, 50, 100, ALL]" data-url="<?= base_url('atividades/retAtividades') ?>">
                        <thead class="thead-light">
                            <tr>
                                <!-- <th data-field="nomeAtividade" data-halign="center" data-align="left" data-sortable="true">Atividade</th>
                                <th data-field="descrAtividade" data-halign="center" data-align="left" data-sortable="true">Descrição</th> -->
                                <th data-field="atividade" data-halign="center" data-align="left" data-sortable="true">Atividade</th>
                                <th data-field="nomeResponsavel" data-halign="center" data-align="left" data-sortable="true">Responsável</th>
                                <th data-field="etapa" data-halign="center" data-align="left" data-sortable="true">Etapa</th>
                                <th data-field="projeto" data-halign="center" data-align="left" data-sortable="true">Projeto</th>
                                <th data-field="sitAtividade" data-halign="center" data-align="center" data-sortable="true" data-formatter="situation">Situação</th>
                                <th data-field="dtEntregaAtividade" data-halign="center" data-align="center" data-sortable="true">Data prevista</th>
                                <th data-field="" data-halign="center" data-align="center" data-sortable="true" data-formatter="viewHistoric">Histórico</th>
                                <th data-field="anexoAtividade" data-halign="center" data-align="center" data-sortable="true" data-formatter="viewAnexo">Anexo</th>
                                <th data-halign="center" data-align="center" data-formatter="optAtividade">Opções</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Reabre modal de Histórico quando fechar anexo
        reabre_modal = 0;

        function optAtividade(index, row) {
            return `<button type="button" class="btn btn-outline-success btn-sm" onclick='altAtividade(` + JSON.stringify(row) + `);'><i class="fas fa-edit"></i></button> <button type="button" class="btn btn-outline-danger btn-sm" onclick="delAtividade(' + row.id_atividade + ');"><i class="fas fa-trash-alt"></i></button>`;
        }

        function viewHistoric(index, row) {
            return `<button type="button" class="btn btn-outline-success btn-sm" onclick='buscaHistorico(` + row.id_atividade + `)'><i class="fas fa-search"></i></button>`;
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

        function situation(value, row) {
            // console.log(row)
            if (value == 'A') {
                return `<button class="btn btn-sm btn-outline-dark btn-block" data-toggle="modal" data-target="#modalAltSituacao" onclick='posicionaValor(` + JSON.stringify(row) + `)'>Aguardando</button>`;
            } else if (value == `P`) {
                return `<button class="btn btn-sm btn-outline-danger btn-block" data-toggle="modal" data-target="#modalAltSituacao" onclick='posicionaValor(` + JSON.stringify(row) + `)'>Pendente</button>`;
            } else if (value == `E`) {
                return `<button class="btn btn-sm btn-outline-warning btn-block" data-toggle="modal" data-target="#modalAltSituacao" onclick='posicionaValor(` + JSON.stringify(row) + `)'>Executando</button>`;
            } else if (value == `C`) {
                return `<button class="btn btn-sm btn-outline-success btn-block" data-toggle="modal" data-target="#modalAltSituacao" onclick='posicionaValor(` + JSON.stringify(row) + `)'>Concluída</button>`;
            } else if (value == `I`) {
                return `<button class="btn btn-sm btn-outline-primary btn-block" data-toggle="modal" data-target="#modalAltSituacao" onclick='posicionaValor(` + JSON.stringify(row) + `)'>Iniciada</button>`;
            }
        }

       
    </script>