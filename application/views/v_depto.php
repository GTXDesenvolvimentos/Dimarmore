<div class="container-fluid mt-4">
    <div class="row mt-1">
        <div class="col-xl-12 mb-12 mb-xl-12">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">DEPARTAMENTO</h3>
                        </div>

                        <div class="col text-right">
                            <a href="#!" class="btn btn-sm btn-outline-warning btn-lg" data-toggle="modal" data-target="#ModalDepto">ADICIONAR</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive pb-3 ">
                    <div class="col">
                        <div class="card shadow col">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush"
                                       id="table_depto"
                                       data-toggle="table"
                                       data-flat="true"
                                       data-search="true"
                                       data-show-pagination-switch="true"
                                       data-pagination="true"
                                       data-show-export="true"
                                       data-detail-formatter="detailFormatter"
                                       data-page-list="[2, 5, 25, 50, 100, ALL]"
                                       data-url="<?= base_url('depto/retDepto') ?>">
                                    <thead class="thead-light">
                                        <tr>
                                            <th data-field="id_departamento" data-align="center" data-sortable="true">ID</th>
                                            <th data-field="cod_departamento" data-halign="center" data-align="right" data-sortable="true">Código do departamento</th>
                                            <th data-field="descricao" data-halign="center" data-align="left" data-sortable="true">Descrição</th>
                                            <th data-field="dtcria" data-halign="center" data-align="center" data-sortable="true">Data de criação</th>                            
                                            <th data-halign="center" data-align="center" data-formatter="opcoesDepto">Opções</th>
                                        </tr>
                                    </thead>
                                </table>
                                <script>

                                    function opcoesDepto(value, row) {
                                        return '<button type="button" class="btn btn-outline-danger btn-sm" onclick="del_departamento(' + row.id_departamento + ');"><i class="fas fa-trash-alt"></i></button>';
                                    }
                                </script>
                            </div>
                        </div>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" data-backdrop="static" id="ModalDepto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de Departamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" onclick="limpaDireitosAcessos();">&times;</span>
                </button>
            </div>
            <form method="post" id="cadastrarDepartamento">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-12 col-sm-12">
                            <label>Código do departamento:</label>
                            <input type="number" class="form-control" name="cod_departamento" id="cod_departamento" placeholder="Código do departamento">
                        </div>
                        
                        <div class="form-group col-md-12 col-sm-12">
                            <label>Descrição:</label>
                            <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Nome da descrição">
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-success"  style="background-color: #fff6ef;">
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" onclick="limpaDireitosAcessos();">Sair</button>
                    <button type="submit" class="btn btn-outline-warning btn-mini">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>




