<div class="container-fluid mt-2 p-2">
    <div class="col-12">
        <h5 class="mb-0 py-3">Projetos</h5>
    </div>
    <!-- <div class="col-12"> -->
    <div class="toolbar">
        <button class="btn btn-sm btn-success btn-lg toolbar" data-target="#ModalProjeto" onclick="">ADICIONAR</button>
    </div>
    <div class="table-responsive">
        <div class="table-responsive">
            <table class="table align-items-center table-flush" id="tableAtividades" data-toolbar=".toolbar" data-toggle="table" data-search="true" data-show-pagination-switch="true" data-pagination="true" data-show-export="true" data-page-list="[2, 5, 25, 50, 100, ALL]" data-url="<?= base_url('atividades/retAtividades') ?>">
                <thead class="thead-light">
                    <tr>
                        <th data-field="id_projeto" data-align="center" data-sortable="true">ID</th>
                        <th data-field="id_departamento" data-align="center" data-sortable="true">Deparatamento</th>
                        <th data-field="responsavel" data-halign="center" data-align="center" data-sortable="true">Responsável</th>
                        <th data-field="nome" data-halign="center" data-align="center" data-sortable="true">Projeto</th>
                        <th data-field="descricao" data-halign="center" data-align="center" data-sortable="true">Descrição</th>
                        <th data-field="situacao" data-halign="center" data-align="center" data-sortable="true">Situação</th>
                        <th data-field="data_fim" data-halign="center" data-align="center" data-sortable="true">Data prevista</th>
                        <th data-field="anexo" data-halign="center" data-align="center" data-sortable="true">ANEXO</th>
                        <th data-halign="center" data-align="center" data-formatter="optProject">Opções</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- </div> -->
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
</script>