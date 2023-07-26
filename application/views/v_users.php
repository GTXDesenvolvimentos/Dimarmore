<div class="container-fluid mt-2 p-2">
    <div class="row mt-1">
        <div class="col-12 p-0">
            <div class="col-12">
                <h5 class="mb-0 py-3">Usuários</h5>
            </div>
            <div class="col-12">
                <a href="#!" class="btn btn-sm btn-success btn-lg toolbar" data-toggle="modal" data-target="#ModalUser">ADICIONAR</a>
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush" id="tableUsers" data-toolbar=".toolbar" toobar data-toggle="table" data-flat="true" data-search="true" data-show-pagination-switch="true" data-pagination="true" data-show-export="true" data-detail-formatter="detailFormatter" data-page-list="[2, 5, 25, 50, 100, ALL]" data-url="<?= base_url('usuarios/retUsers') ?>">
                            <thead class="thead-light">
                                <tr>
                                    <th data-field="nome" data-halign="center" data-align="left" data-sortable="true">Nome</th>
                                    <th data-field="usuario" data-halign="center" data-align="left" data-sortable="true">E-mail</th>
                                    <th data-field="nivel" data-halign="center" data-align="center" data-sortable="true" data-formatter="nivel">Nível</th>
                                    <th data-halign="center" data-align="center" data-formatter="opcoesUser">Opções</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        
        function opcoesUser(index, row) {
            return `<button type="button" class="btn btn-outline-success btn-sm" onclick='altUser(` + JSON.stringify(row) + `);'><i class="fas fa-edit"></i></button> <button type="button" class="btn btn-outline-danger btn-sm" onclick="delUser(` + row.id_users + `);"><i class="fas fa-trash-alt"></i></button>`;
        }

        function altUser(value) {
            $('#txtIdUser').val(value.id_users);
            $('#txtNomeUser').val(value.nome);
            $('#txtEmailUser').val(value.usuario);
            $('#slNivelUser').selectpicker('val', value.nivel);
            $('#ModalUser').modal('show');
        }

        function nivel(index, row) {
            if (row.nivel == 1) {
                return '<button type="button" class="btn btn-outline-danger btn-sm">Administrador</i></button>';
            } else {
                return '<button type="button" class="btn btn-outline-success btn-sm">Usuário</i></button>';
            }
        }
    </script>