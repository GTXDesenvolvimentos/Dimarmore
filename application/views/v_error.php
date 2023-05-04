<div class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 d-flex flex-column align-items-center justify-content-center">
                    <div class="card mb-1">
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="<?= base_url("assets/images/error.png") ?>" alt="logoX" width="100">
                                </a>
                            </div>
                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Atenção<img src="assets/images/x.png" alt="" width="35"></h5>
                            </div>
                            <hr>
                            <div class="p-2">
                               <?= validation_errors()?>
                            </div>

                            <a href="<?= base_url(); ?>" class="btn btn-primary w-100 p-3">Tente novamente!</a>
                        </div>
                    </div>
                    <div class="credits">
                        Desenvolvido por: <a href="<?= base_url() ?>">comunidade X</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
