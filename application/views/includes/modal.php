<!-- MODAL DEPARTAMENTO -->
<div class="modal" id="ModalDepto">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="formDepartamentos">
                <div class="modal-header">
                    <h4 class="modal-title">Departamentos</h4>
                    <button type="button" class="close" data-dismiss="modal" onclick="clearForm();">&times;</button>
                </div>
                <input type="number" name="txtIdDepto" id="txtIdDepto">
                <div class="modal-body p-2">
                    <div class="form-group col-12">
                        <label class="m-0">Código do departamento:</label>
                        <input type="number" class="form-control" name="txtCodDepto" id="txtCodDepto" placeholder="Código do departamento">
                    </div>

                    <div class="form-group col-12">
                        <label class="m-0">Descrição:</label>
                        <input type="text" class="form-control" name="txtDescDepto" id="txtDescDepto" placeholder="Descrição do departamento">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="clearForm();">Sair</button>
                    <button type="button" class="btn btn-success" id="btnDepartamentos">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL PROJETOS -->
<div class="modal" id="ModalProjeto">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="formDepartamentos">
                <div class="modal-header">
                    <h4 class="modal-title">Departamentos</h4>
                    <button type="button" class="close" data-dismiss="modal" onclick="clearForm();">&times;</button>
                </div>
                <input type="number" name="txtIdDepto" id="txtIdDepto">
                <div class="modal-body p-2">
                    <div class="form-group col-12">
                        <label class="m-0">Departamento:</label>
                        <select name="slDepto" id="slDepto" class="selectpicker form-control" onchange="" data-style="">
                        <option value="">SELECIONE UMA OPÇÃO</option>
                    </div>

                    <div class="form-group col-12">
                        <label class="m-0">Descrição:</label>
                        <input type="text" class="form-control" name="txtDescDepto" id="txtDescDepto" placeholder="Descrição do departamento">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="clearForm();">Sair</button>
                    <button type="button" class="btn btn-success" id="btnDepartamentos">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- MODAL ETAPAS -->
<div class="modal" id="ModalEtapas">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="formEtapas">
                <div class="modal-header">
                    <h4 class="modal-title">Etapas</h4>
                    <button type="button" class="close" data-dismiss="modal" onclick="clearForm();">&times;</button>
                </div>
                <input type="number" name="txtIdEtapa" id="txtIdEtapa">
                <div class="modal-body p-2">
                    <div class="form-group col-12">
                        <label class="m-0">Nome da etapa:</label>
                        <input type="number" class="form-control" name="txtNomeEtapa" id="txtNomeEtapa" placeholder="Nome da etapa">
                    </div>

                    <div class="form-group col-12">
                        <label class="m-0">Descrição:</label>
                        <textarea type="text" class="form-control" name="txtDescEtapa" id="txtDescEtapa" placeholder="Descrição da etapa"></textarea>
                    </div>
                    <div class="form-group col-12">
                        <!-- <label class="m-0">Prioridade:</label> -->
                        <select id="SlPrioridade" name="SlPrioridade" class="selectpicker form-control">
                            <option value="">PRIORIDADE</option>
                            <option value="A">AGUARDANDO</option>
                            <option value="P">PENDENTE</option>
                            <option value="E">EXECUTANDO</option>
                            <option value="C">CONCLUIDO</option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <!-- <label class="m-0">Responsável:</label> -->
                        <select id="SlResponsavel" name="SlResponsavel" class="selectpicker form-control">
                            <option value="">RESPONSÁVEL</option>
                            <?php
                            foreach ($users->result() as $linhas) {
                            ?>
                                <option value="<?= $linhas->id_users ?>" class="text-uppercase"><?= $linhas->nome ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label class="m-0">Anexar:</label>
                        <input type="file" class="form-control" name="docAnexo" id="docAnexo" placeholder="Anexar arquivos">
                    </div>
                    <div class="form-group col-12">
                        <label class="m-0">Data limite do projeto:</label>
                        <input type="date" class="form-control" name="txtEtaDtLimit" id="txtEtaDtLimit" placeholder="Data limite para terminar o projeto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="clearForm();">Sair</button>
                    <button type="button" class="btn btn-success" id="btnDepartamentos">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>