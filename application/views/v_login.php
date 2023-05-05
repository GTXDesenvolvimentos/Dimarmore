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

                                <?= isset($msg) && $msg !== '' ? $msg : ''; ?>

                                <div class="row">
                                    <div class="col-12 P-2">
                                        <div class="alert alert-danger d-none" id="alert" role="alert">
                                            <h4 class="alert-heading">Atenção!</h4>
                                            <hr>
                                            <div id="msg" class="mb-0 pb-0 text-dark"></div>
                                            <hr>
                                            <p class="alert-heading mb-0 text-dark">Corrija os campos acima.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control  p-4" name="email" id="email" placeholder="Informe seu email...">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control p-4" name="password" id="senha" placeholder="Informe sua senha...">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Relembrar senha</label>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-block p-4" onclick="logar()">Entrar</button>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Esqueceu sua senha?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('login/register') ?>">Encontre um patrocinador!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function logar() {
        var dadosajax = {
            email: $('#email').val(),
            senha: $('#senha').val()
        };
        $.ajax({
            url: "http://localhost/dimarmore/login/logar",
            data: dadosajax,
            type: 'POST', //MÉTODO DE ENVIO TIPO POST//
            dataType: "json",
            cache: false,
            error: function() {
                swal.fire("Atenção!", "Ocorreu um erro ao buscar dados!", "error");
            },
            beforeSend: function() {

                swal.fire({
                    title: "Aguarde!",
                    text: "Buscando dados...",
                    imageUrl: "http://localhost/dimarmore/assets/img/gifs/loader.gif",
                    showConfirmButton: false
                });
            },
            success: function(result) {
                if (result.cod == 2) {
                    swal.fire({
                        timer: 1000,
                        title: "Aguarde!",
                        text: "Buscando dados...",
                        imageUrl: "http://localhost/dimarmore/assets/img/gifs/loader.gif",
                        showConfirmButton: false
                    });
                    $('#msg').html(result.mensagens);
                    $('#alert').removeClass('d-none');
                } else {
                    swal.fire("Atenção!", "Logado!", "info");
                }
            }
        });
    }
</script>