<div class="container-fluid mt-2 p-2">
<div class="row mt-1">
        <div class="col-12 p-0">
            <div class="col-12">
                <h5 class="mb-0 py-1">Etapas</h5>
            </div>
            <div class="col-12">
                <a href="#!" class="btn btn-sm btn-success btn-lg toolbar" data-toggle="modal" data-target="#ModalEtapas">ADICIONAR</a>
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" 
                        id="tableEtapa" 
                        data-toolbar=".toolbar" 
                        toobar data-toggle="table" 
                        data-flat="true" 
                        data-search="true" 
                        data-show-pagination-switch="true" 
                        data-pagination="true" 
                        data-show-export="true" 
                        data-page-list="[2, 5, 25, 50, 100, ALL]" 
                        data-show-toggle="true" 
                        data-show-fullscreen="true" 
                        data-show-columns="true" 
                        data-show-columns-toggle-all="true" 
                        data-click-to-select="true"
                        data-minimum-count-columns="2" 
                        data-show-pagination-switch="true" 
                        data-mobile-responsive="true"
                        data-url="<?= base_url('etapas/retEtapas') ?>">
                            <thead class="thead-light">
                                <tr>
                                    <th data-field="nomeEtapa" data-halign="center" data-align="left" data-sortable="true">Etapa</th>
                                    <th data-field="descrEtapa" data-halign="center" data-align="left" data-sortable="true">Descrição</th>
                                    <th data-field="priorEtapa" data-halign="center" data-align="center" data-sortable="true" data-formatter="prioridade">Prioridade</th>
                                    <th data-field="sitEtapa" data-halign="center" data-align="center" data-sortable="true" data-formatter="situacao">Situação</th>
                                    <th data-field="nomeProjeto" data-halign="center" data-align="left" data-sortable="true">Projeto</th>
                                    <th data-field="descrDepartamento" data-halign="center" data-align="left" data-sortable="true">depto</th>
                                    <th data-field="nomeResponsavel" data-halign="center" data-align="left" data-sortable="true">Responsável</th>
                                    <th data-field="dtEntregaEtapa" data-halign="center" data-align="center" data-sortable="true">Data final prevista</th>
                                    <th data-field="anexoEtapa" data-halign="center" data-align="center" data-sortable="true" data-formatter="viewAnexo">Anexo</th>
                                    <th data-halign="center" class="" data-align="center" data-formatter="opcoesEtapas">opções</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <script>
        function opcoesEtapas(index, row) {
            return ` <button type="button" class="btn btn-outline-success btn-sm" onclick='altEtapas(` + JSON.stringify(row) + `);'><i class="fas fa-edit"></i></button> <button type="button" class="btn btn-outline-danger btn-sm" onclick="delEtapas(` + row.id_etapa + `);"><i class="fas fa-trash-alt"></i></button>`;
        }

        function altEtapas(value) {
            $('#txtIdEtapa').val(value.id_etapa);
            $('#txtNomeEtapa').val(value.nomeEtapa);
            $('#txtDescEtapa').val(value.descrEtapa);
            $('#txtEtaDtLimit').val(value.dtEntregaEtapaE);
            $('#SlEtaPrioridade').selectpicker('val', value.priorEtapa);
            $('#slEtapProjeto').selectpicker('val', value.id_projeto);
            $('#slEtapResponsavel').selectpicker("val", value.idResponsavel);
            $('#ModalEtapas').modal('show');
        }
    </script>