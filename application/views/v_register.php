<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-4 col-lg-4 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="px-3 py-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Comunidade <img src="<?= base_url('assets/img/x.png') ?>" alt="" width="65"></h1>
                                </div>
                                <hr>

                                <?= isset($msg) && $msg !== '' ? $msg : ''; ?>

                                <?php echo form_open('login/registerUser'); ?>

                                <div class="form-group">
                                    <input type="number" class="form-control py-4 text-center" style="color: #4e73df;" value="<?=$patrocinador?>" name="patrocinador" id="patrocinador" readonly placeholder="Cód. Patrocinador">
                                </div>

                                <div class="form-group">
                                    <input type="name" class="form-control  py-4" name="name" placeholder="Primeiro nome">
                                </div>

                                <div class="form-group">
                                    <input type="name" class="form-control py-4" name="surname" id="surname" placeholder="Segundo nome">
                                </div>

                                <div class="form-group">
                                    <input  data-mask="(99)99999-9999" type="name" class="form-control py-4" name="contact" id="contact" placeholder="Contato de whatsapp">
                                </div>

                                <div class="form-group">
                                    <input  class="form-control py-4" type="text" name="cpf" id="cpf" placeholder="Informe seu CPF">
                                </div>

                                <div class="form-group">
                                    <input class="form-control py-4" type="text" name="email" id="email" placeholder="Informe seu email">
                                </div>

                                <div class="row">

                                    <div class="form-group col-6">
                                        <input class="form-control py-4" type="password" name="password" id="password" placeholder="Senha">
                                    </div>

                                    <div class="form-group col-6">
                                        <input class="form-control py-4" type="password" name="repassword" id="repassword" placeholder="Repete senha">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block py-4">Cadastrar</button>
                                <?php form_close(); ?>

                                <hr>
                                <div class="text-center">
                                    <a class="large" href="<?= base_url('login') ?>">Já sou cadastrado!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

