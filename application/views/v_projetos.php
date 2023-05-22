<div class="container-fluid mt-2 p-2">
    <div class="row mt-1">
        <div class="col-12 p-0">
            <div class="col-12">
                <h5 class="mb-0 py-3">Projetos</h5>
            </div>
            <div class="col-12">
                <a href="#!" class="btn btn-sm btn-success btn-lg toolbar" data-toggle="modal" data-target="#ModalProjeto">ADICIONAR</a>
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="tableDepto" data-toolbar=".toolbar" toobar data-toggle="table" data-flat="true" data-search="true" data-show-pagination-switch="true" data-pagination="true" data-show-export="true" data-detail-formatter="detailFormatter" data-page-list="[2, 5, 25, 50, 100, ALL]" data-url="<?= base_url('projetos/retAllProjects') ?>">
                            <thead class="thead-light">
                                <tr>
                                    <th data-field="id_projeto" data-align="center" data-sortable="true">ID PROJETO</th>
                                    <th data-field="id_departamento" data-align="center" data-sortable="true">ID DEPARTAMENTO</th>
                                    <th data-field="responsavel" data-halign="center" data-align="center" data-sortable="true">RESPONSÁVEL</th>
                                    <th data-field="nome" data-halign="center" data-align="center" data-sortable="true">NOME</th>
                                    <th data-field="dtentrega" data-halign="center" data-align="center" data-sortable="true">DT. ENTREGA</th>
                                    <th data-field="descricao" data-halign="center" data-align="center" data-sortable="true">DESCRIÇÃO</th>
                                    <th data-field="situacao" data-halign="center" data-align="center" data-sortable="true">SITUAÇÃO</th>
                                    <th data-field="data_fim" data-halign="center" data-align="center" data-sortable="true">DT. FIM</th>
                                    <th data-field="anexo" data-halign="center" data-align="center" data-sortable="true">ANEXO</th>
                                    <th data-field="dtcria" data-halign="center" data-align="center" data-sortable="true">DT. CRIAÇÃO</th>                                   
                                    <th data-field="usucria" data-halign="center" data-align="center" data-sortable="true">CRIADO POR</th>
                                    <th data-field="status" data-halign="center" data-align="center" data-sortable="true">STATUS</th>
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
        function optProject(index, row) {
            return `<button type="button" class="btn btn-outline-success btn-sm" onclick='altDepto(` + JSON.stringify(row) + `);'><i class="fas fa-edit"></i></button> <button type="button" class="btn btn-outline-danger btn-sm" onclick="delDepto(' + row.id_departamento + ');"><i class="fas fa-trash-alt"></i></button>`;
        }

        function altDepto(value){
            console.log(value.id_departamento);
            $('#txtIdDepto').val(value.id_departamento);
            $('#txtCodDepto').val(value.cod_departamento);
            $('#txtDescDepto').val(value.descricao);
            $('#ModalDepto').modal('show');
         }
    </script>


    