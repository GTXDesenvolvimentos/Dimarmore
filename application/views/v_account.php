<div class="container-fluid p-2">
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Meus dados</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body p-1">
                    <div class="col-12 p-1">
                        <label class="form-label mb-0">Nome:</label>
                        <input type="text" class="form-control" disabled value="Márcio Batista da Silva">
                    </div>
                    <div class="col-12 p-1">
                        <label class="form-label mb-0">E-mail:</label>
                        <input type="text" class="form-control" disabled value="marciosilva.mx@gmail.com">
                    </div>
                    <div class="col-12 p-1">
                        <label class="form-label mb-0">CPF:</label>
                        <input type="text" class="form-control" disabled value="309.117.938-95">
                    </div>
                    <div class="col-12 p-1">
                        <label class="form-label mb-0">Data de nascimento:</label>
                        <input type="text" class="form-control" disabled value="21/01/1982">
                    </div>
                    <div class="col-12 p-1">
                        <label class="form-label mb-0">Whatsapp:</label>
                        <input type="text" class="form-control" value="(11)98985-9400">
                    </div>
                    <div class="col-12 p-1">
                        <label class="form-label mb-0">Link de indicação:</label>
                        <input type="text" class="form-control" value="<?=base_url('login/register/').$this->session->userdata('codigo');?>">
                    </div>

                    
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Status</h6>
                    <div class="dropdown no-arrow">
                        <a class="btn btn-outline-danger btn-sm" role="button" data-toggle="modal" data-target="#image">Alterar minha foto</a>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="text-center">
                        <img src="http://localhost/comunidadex/assets/img/x.png" width="150">
                    </div>
                    <div class="mt-4 text-center ">
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Conta ativa</span>
                    </div>

                    <div class="mt-4 text-center ">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Diamante</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Minhas contas</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Server Migration <span class="float-right">20%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Sales Tracking <span class="float-right">40%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Customer Database <span class="float-right">60%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Payout Details <span class="float-right">80%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Account Setup <span class="float-right">Complete!</span></h4>
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>


        </div>
    </div>


    <div class="modal fade" id="image" tabindex="-1" role="dialog" aria-labelledby="image" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?= base_url('account/uploadimg') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Alterar minha foto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="file">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                        <button type="submit" class="btn btn-primary">Alterar</button>
                    </div>
            </div>
            </form>
        </div>
    </div>