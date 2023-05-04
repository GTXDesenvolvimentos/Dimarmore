<div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex justify-content-center" href="<?= base_url() ?>">
            <div class="sidebar-brand-icon rotate-n-0">
                <div class="mx-2 .d-none .d-lg-block .d-xl-none"><span style="font-size: 10 !important;">Cmd</span></div>
            </div>
            <div class="sidebar-brand-icon rotate-n-0">
                <img src="<?= base_url('assets/img/x.png') ?>" alt="" width="35">
            </div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item active"><a class="nav-link" href="<?= base_url() ?>"><i class="fas fa-fw fa-tachometer-alt"></i><span>Home</span></a>
        </li>
        <hr class="sidebar-divider">

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Doaçoes</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">ND / RC:</h6>
                    <a class="collapse-item" href="buttons.html">Novas doações</a>
                    <a class="collapse-item" href="cards.html">Recompromissos</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading"></div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Meus acessos</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Usuários:</h6>
                    <a class="collapse-item" href="login.html">Meus convidados</a>
                    <a class="collapse-item" href="<?=base_url('account')?>">Minha conta</a>
                    <a class="collapse-item" href="register.html">Meus bonus</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider">
        <li class="nav-item"><a class="nav-link" href="charts.html"><i class="fas fa-fw fa-chart-area"></i><span>Filas</span></a></li>
        <hr class="sidebar-divider">
        <li class="nav-item"><a class="nav-link" href="charts.html"><i class="fas fa-fw fa-chart-area"></i><span>Minhas posições</span></a></li>
        <hr class="sidebar-divider">
        <li class="nav-item"><a class="nav-link" href="charts.html"> <i class="fas fa-fw fa-wrench"></i><span>Falar com suporte</span></a></li>
        <li class="nav-item"><a class="nav-link" href="<?=base_url('login/logout')?>"> <i class="fas fa-fw fa-exit"></i><span><strong style="font-size: 22 !important;">Sair</strong></span></a></li>
        <hr class="sidebar-divider d-none d-md-block">
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>