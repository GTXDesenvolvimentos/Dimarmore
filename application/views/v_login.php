<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-4 col-lg-4 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="px-3 py-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4"> <img src="<?= base_url('assets/img/LogoPqn.jpg') ?>" alt="" width="205"></h1>
                                </div>
                                <hr>
                                <form method="POST" action="" id="formLogin">
                                    <div class="form-group">
                                        <input type="email" class="form-control  p-4" name="txtEmail" id="txtEmail" placeholder="Informe seu email...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control p-4" name="txtPassword" id="txtPassword" placeholder="Informe sua senha...">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Relembrar senha</label>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success btn-block p-4" id="btnLogin">Entrar</button>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="forgot-password.html">Esqueceu sua senha?</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>