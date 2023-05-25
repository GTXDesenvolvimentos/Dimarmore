<div class="container-fluid mt-2 p-2">
    <div class="row mt-1">
        <div class="col-12 p-0">
            <div class="col-12">
                <h5 class="mb-0 py-3">Atividades</h5>
            </div>
            <div class="col-12">
                <button type="button" class="btn btn-sm btn-success btn-lg toolbar" data-toggle="modal" data-target="#ModalAtividades" onclick="retAllProjects();">ADICIONAR</button>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush" id="tableAtividades" data-toolbar=".toolbar" toobar data-toggle="table" data-flat="true" data-search="true" data-show-pagination-switch="true" data-pagination="true" data-show-export="true" data-detail-formatter="detailFormatter" data-page-list="[2, 5, 25, 50, 100, ALL]" data-url="<?= base_url('atividades/retAtividades') ?>">
                        <thead class="thead-light">
                            <tr>
                                <th data-field="id_atividade" data-align="center" data-sortable="true">ID</th>
                                <th data-field="id_etapa" data-align="center" data-sortable="true">ID etapa</th>
                                <th data-field="atividade" data-halign="center" data-align="center" data-sortable="true">Atividade</th>
                                <th data-field="descricao" data-halign="center" data-align="center" data-sortable="true">Descrição</th>
                                <th data-field="prioridade" data-halign="center" data-align="center" data-sortable="true">Prioridade</th>
                                <th data-field="situacao" data-halign="center" data-align="center" data-sortable="true">Situação</th>
                                <th data-field="data_fim" data-halign="center" data-align="center" data-sortable="true">Data prevista</th>
                                <th data-field="anexo" data-halign="center" data-align="center" data-sortable="true">Anexo</th>
                                <th data-halign="center" data-align="center" data-formatter="optProject">Opções</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function optProject(index, row) {
            return `<button type="button" class="btn btn-outline-success btn-sm" onclick='altProjeto(` + JSON.stringify(row) + `);'><i class="fas fa-edit"></i></button> <button type="button" class="btn btn-outline-danger btn-sm" onclick="delProjeto(' + row.id_departamento + ');"><i class="fas fa-trash-alt"></i></button>`;
        }

        function altProjeto(value) {
            $('#txtIdProjeto').val(value.id_projeto);
            $('#txtNomeProjeto ').val(value.nome);
            $('#txtDescProjeto').val(value.descricao);
            $('#txtDataFimProjeto').val(value.dtentrega);
            $('#slRespProjeto').selectpicker('val', value.responsavel);
            $('#slDepProjeto').selectpicker('val', value.id_departamento);

            $('#ModalProjeto').modal('show');

            // "slRespProjeto"
            // "slDepProjeto"
            // ""

        }

        function retAllProjects() {
            $.ajax({
                url: base_url + 'projetos/retAllProjects',
                dataType: 'json',
                type: 'post',
                success: function(ret) {
                    console.log(ret)

                    $.each(ret, function(index, row) {
                        $('#slProjeto').append('<option value="' + row.id_projeto + '"> ' + row.id_projeto + ' - ' + row.descricao + ' </option>').selectpicker('refresh')
                    })


                }
            })

            // QUERY PARA RETORNAR TODOS OS DADOS DE UMA VEZ. RECOMENDADO USO DE ARRAYCOLUMN

            // select p.id_projeto, p.nome, p.descricao, e.id_etapa, e.etapa, e.descricao, d.id_departamento, d.descricao
            // from tbl_projetos p, tbl_etapas e, tbl_departamentos d
            // where p.id_projeto = e.id_projeto
            // and d.id_departamento = e.id_departamento
            // and p.status != 'D'
            // and e.status != 'D'
            // and d.status != 'D';

        }
    </script>