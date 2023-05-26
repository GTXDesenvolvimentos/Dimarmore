<!-- MODAL DEPARTAMENTO -->
<div class="modal" id="ModalDepto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="formDepartamentos">
                <div class="modal-header">
                    <h4 class="modal-title">Departamentos</h4>
                    <button type="button" class="close" data-dismiss="modal" onclick="clearForm();">&times;</button>
                </div>
                <input class="d-none" type="number" name="txtIdDepto" id="txtIdDepto">
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
<div class="modal" id="ModalProjeto" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="formProjetos" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Projetos</h4>
                    <button type="button" class="close" data-dismiss="modal" onclick="clearForm();">&times;</button>
                </div>
                <input class="d-none" type="number" name="txtIdProjeto" id="txtIdProjeto">
                <div class="modal-body p-2">
                    <div class="form-group col-12">
                        <label class="m-0">Projetos:</label>
                        <input type="text" class="form-control" name="txtNomeProjeto" id="txtNomeProjeto" placeholder="Nome do projeto">
                    </div>

                    <div class="form-group col-12">
                        <label class="m-0">Descrição:</label>
                        <textarea type="text" class="form-control" name="txtDescProjeto" id="txtDescProjeto" placeholder="Descrição do projeto"></textarea>
                    </div>
                    <div class="form-group col-12">
                        <select id="slRespProjeto" name="slRespProjeto" class="selectpicker form-control" data-style="btn-success">
                            <option value="">Responsável</option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <select id="slDepProjeto" name="slDepProjeto" class="selectpicker form-control" data-style="btn-success">
                            <option value="">Departamento'</option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label class="m-0">Data limite do projeto:</label>
                        <input type="date" class="form-control" name="txtDataFimProjeto" id="txtDataFimProjeto" placeholder="Data limite para o projeto">
                    </div>

                    <div class="form-group col-12">
                        <label class="form-label">Anexo</label>
                        <input class="form-control form-control-lg btn" id="anexoProjeto" name="anexoProjeto" name="anexoProjeto" type="file" />
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="clearForm();">Sair</button>
                    <button type="submit" class="btn btn-success" id="btnCadProjeto">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL ETAPAS -->
<div class="modal" id="ModalEtapas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="formEtapas" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Etapas</h4>
                    <button type="button" class="close" data-dismiss="modal" onclick="clearForm();">&times;</button>
                </div>
                <input type="number" name="txtIdEtapa" id="txtIdEtapa" class="d-none">
                <div class="modal-body p-2">
                    <div class="form-group col-12">
                        <label class="m-0">Nome da etapa:</label>
                        <input type="text" class="form-control" name="txtNomeEtapa" id="txtNomeEtapa" placeholder="Nome da etapa">
                    </div>

                    <div class="form-group col-12">
                        <label class="m-0">Descrição:</label>
                        <textarea type="text" class="form-control" name="txtDescEtapa" id="txtDescEtapa" placeholder="Descrição da etapa"></textarea>
                    </div>
                    <div class="form-group col-12">
                        <label class="m-0">Data limite do projeto:</label>
                        <input type="date" class="form-control" name="txtEtaDtLimit" id="txtEtaDtLimit" placeholder="Data limite para finalização">
                    </div>
                    <div class="form-group col-12">
                        <!-- <label class="m-0">Prioridade:</label> -->
                        <select id="SlEtaPrioridade" name="SlEtaPrioridade" class="selectpicker form-control" data-style="btn-success">
                            <option value="">Prioridade</option>
                            <option value="A">Aguardando</option>
                            <option value="P">Pendente</option>
                            <option value="E">Executando</option>
                            <option value="C">Concluido</option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <select id="slEtapProjeto" name="slEtapProjeto" class="form-control" data-style="btn-success">
                            <option value="">Projeto</option>
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <select id="slEtapResponsavel" name="slEtapResponsavel" class="form-control" data-style="btn-success">
                            <option value="">Responsável</option>
                        </select>
                    </div>
                    <div class="form-group col-12" id="dvAnexo">
                        <!-- <label class="m-0">Anexar:</label> -->
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="anexoEtapa" id="anexoEtapa" value="Anexar">
                            <label class="custom-file-label" for="anexoEtapa" id="lbEtapa">ANEXAR ARQUIVOS</label>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="clearForm();">Sair</button>
                    <button type="submit" class="btn btn-success" id="btnCadEtapas">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL INFORMATIVO -->
<div id="ModalInfor" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form method="post" id="formInfor" enctype="multipart/form-data">

                <div class="modal-header">
                    <h4 class="modal-title" id="txtInfor"></h4>
                    <button type="button" class="close" data-dismiss="modal" onclick="clearForm();">&times;</button>
                </div>
                <input type="number" name="txtIdInfor" id="txtIdInfor" class="d-none">
                <div class="modal-body p-2">
                    <div class="form-group col-12">
                        <div class="text-center">
                            <img id="imgInfor" class="img-fluid mx-auto d-block" width="75%">
                        </div>

<!-- MODAL ATIVIDADES -->
<div class="modal fade" id="ModalAtividades" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="formAtividade" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Atividade</h4>
                    <button type="button" class="close" data-dismiss="modal" onclick="clearForm();">&times;</button>
                </div>

                <input  type="number" name="txtIdProjeto" id="txtIdProjeto">

                <div class="modal-body p-2">

                    <div class="form-group col-12">
                        <input type="number" name="txtIdAtividade" id="txtIdAtividade" class="form-control" placeholder="ID atividade">
                    </div>

                    <div class="form-group col-12">
                        <select id="slEtapa" name="slEtapa" class="selectpicker form-control" data-style="btn-success" onchange="retAllProjects(this.value)">
                            <option value="">Etapa</option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <select id="slProjeto" name="slProjeto" class="selectpicker form-control" data-style="btn-success">
                            <option value="">Projeto</option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label class="m-0">Atividade:</label>
                        <input type="text" class="form-control" name="txtNomeAtividade" id="txtNomeAtividade" placeholder="Nome da atividade">
                    </div>

                    <div class="form-group col-12">
                        <label class="m-0">Descrição:</label>
                        <textarea type="text" class="form-control" name="txtDescAtividade" id="txtDescAtividade" placeholder="Descrição da atividade"></textarea>
                    </div>
                    <div class="form-group col-12">
                        <select id="slRespAtividade" name="slRespAtividade" class="selectpicker form-control" data-style="btn-success">
                            <option value="">Responsável</option>
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label class="m-0">Data limite da atividade:</label>
                        <input type="date" class="form-control" name="txtDataFimProjeto" id="txtDataFimAtividade" placeholder="Data limite para a ativivdade">
                    </div>

                    <div class="form-group col-12">
                        <label for="formFileLg" class="form-label">Anexo</label>
                        <input class="form-control form-control-lg btn" id="anexoProjeto" name="anexoAtividade" type="file" />

                        <label class="form-label">Anexo</label>
                        <input class="form-control form-control-lg btn" id="anexoProjeto" name="anexoProjeto" name="anexoProjeto" type="file" />

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="clearForm();">Sair</button>
                    <button type="submit" class="btn btn-success" id="btnCadAtividade">Salvar</button>
                    <button type="submit" class="btn btn-success" id="btnCadProjeto">Salvar</button>
                </div>
            </form>
        </div>
    </div>

</div>


<!-- MODAL VIEW ANEXO -->
<div class="modal fade" id="modalAnexo" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Atividade</h4>
                <button type="button" class="close" data-dismiss="modal" onclick="clearForm();">&times;</button>
            </div>
            <div class="modal-body p-2">
               <embed id="docAnexoView" src="<?= base_url('assets/uploads/1.pdf') ?>" frameborder="0" width="100%" height="400px">
               <div id="docAnexoView"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="clearForm();">Sair</button>
            </div>
        </div>
    </div>
</div>