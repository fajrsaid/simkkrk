<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
    <a class="navbar-brand mr-1" href="<?php echo site_url('home') ?>"><?php echo SITE_NAME ?></a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
    <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
    <div class="input-group">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Grup Pengguna
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <?php
                $user_role = $this->session->userdata("user_role"); 
                foreach ($getUserRole as $getUserRole) { 
                    if ($user_role == $getUserRole['user_role_id']) { ?>
                        <a class="dropdown-item active"><?= $getUserRole['role_name'] ?></a>
                        <?php
                    }else { ?>
                        <a href="<?= base_url('Account/setUserRole/'.$getUserRole['user_role_id']) ?>" class="dropdown-item"><?= $getUserRole['role_name'] ?></a>
                        <?php
                    }
                }
            ?>
            </div>
        </div>
    </div>
    </form>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
    <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <span class="badge badge-danger" id="sumary-notif"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown" id="notification">
            
        </div>
    </li>
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <center>
            <img src="<?= base_url('assets/img/user-icon.png') ?>" alt="" style="border-radius:100px; height:100px; margin:20px;">
            <b><?= $this->session->userdata('username') ?></b>
            <div class="dropdown-divider"></div>
            <?php 
                if ($this->session->userdata('user_role') == 4 ) {

                }else { ?>
                    <a class="dropdown-item" href="<?= base_url('/Pengaturan') ?>">Pengaturan</a>
                    <?php
                }
            ?>
            <a class="dropdown-item" href="<?= base_url('login/logout') ?>">Keluar</a>
            </center>
        </div>
    </li>
    </ul>
</nav>

