<div class="container-fluid mt-2 p-2">
    <div class="row mt-1">
        <div class="col-12 p-0">
            <div class="col-12">
                <h5 class="mb-0 py-3">Etapas</h5>
            </div>
            <div class="col-12">
                <a href="#!" class="btn btn-sm btn-success btn-lg toolbar" data-toggle="modal" data-target="#ModalEtapas" onclick="$('#dvAnexo').removeClass('d-none');">ADICIONAR</a>
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="tableDepto" data-toolbar=".toolbar" toobar data-toggle="table" data-flat="true" data-search="true" data-show-pagination-switch="true" data-pagination="true" data-show-export="true" data-detail-formatter="detailFormatter" data-page-list="[2, 5, 25, 50, 100, ALL]" data-url="<?= base_url('etapas/retEtapas') ?>">
                            <thead class="thead-light">
                                <tr>
                                    <th data-field="id_etapa" data-align="center" data-sortable="true">ID</th>
                                    <th data-field="etapa" data-halign="center" data-align="center" data-sortable="true">Etapa</th>
                                    <th data-field="descricao" data-halign="center" data-align="center" data-sortable="true">Descrição</th>
                                    <th data-field="dtcria" data-halign="center" data-align="center" data-sortable="true">Data de criação</th>
                                    <th data-halign="center" data-align="center" data-formatter="opcoesDepto">Opções</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function opcoesDepto(index, row) {
            return `<button type="button" class="btn btn-outline-primary btn-sm" onclick='imgEtapa(` + row.id_etapa + `)'><i class="fa-regular fa-images"></i></button> <button type="button" class="btn btn-outline-success btn-sm" onclick='altEtapas(` + JSON.stringify(row) + `);'><i class="fas fa-edit"></i></button> <button type="button" class="btn btn-outline-danger btn-sm" onclick="delEtapas(` + row.id_etapa + `);"><i class="fas fa-trash-alt"></i></button>`;
        }

        function altEtapas(value) {

            $('#txtIdEtapa').val(value.id_etapa);
            $('#txtNomeEtapa').val(value.etapa);
            $('#txtDescEtapa').val(value.descricao);
            $('#txtEtaDtLimit').val(value.data_fim);
            $('#SlEtaPrioridade').selectpicker('val', value.prioridade);
            $('#slEtapProjeto').selectpicker('val', value.id_projeto);
            $('#slEtapResponsavel').selectpicker("val", value.responsavel);
            $('#dvAnexo').addClass('d-none');
            $('#ModalEtapas').modal('show');
        }
    </script>