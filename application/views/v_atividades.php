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
                                <th data-field="nomeAtividade" data-halign="center" data-align="left" data-sortable="true">Atividade</th>
                                <th data-field="descrAtividade" data-halign="center" data-align="left" data-sortable="true">Descrição</th>
                                <th data-field="sitAtividade" data-halign="center" data-align="center" data-sortable="true" data-formatter="situacao">Situação</th>
                                <th data-field="dtEntregaAtividade" data-halign="center" data-align="center" data-sortable="true">Data prevista</th>
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
        function optAtividade(index, row) {
            return `<button type="button" class="btn btn-outline-success btn-sm" onclick='altAtividade(` + JSON.stringify(row) + `);'><i class="fas fa-edit"></i></button> <button type="button" class="btn btn-outline-danger btn-sm" onclick="delAtividade(' + row.id_atividade + ');"><i class="fas fa-trash-alt"></i></button>`;
        }

        function altAtividade(value) {
            //selectProjetos(value.id_departamento);
            $('#txtIdAtividade').val(value.id_atividade);
            $('#slAtivDepto').selectpicker('val', value.id_departamento);
            //$('#slAtivProjeto').selectpicker('val', value.id_projeto);
            $('#slAtivProjeto').html('<option value="' +value.id_projeto + '">' +value.nomeProjeto + '</option>');
            //$('#slRespAtividade').selectpicker('val', value.responsavel);
           // $('#txtNomeProjeto ').val(value.nome);
            //$('#txtDescProjeto').val(value.descricao);
           // $('#txtDataFimProjeto').val(value.dtentrega);
           // $('#slRespProjeto').selectpicker('val', value.responsavel);
            
            $('#ModalAtividades').modal('show');

        }
    </script>