<ul class="sidebar navbar-nav">
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('home') ?>">
        <i class="fas fa-fw fa-home"></i>
        <span>Beranda</span>
        </a>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Penelitian</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?= base_url('/Penelitian_kk/Progress') ?>">Progress Penelitian</a>
            <a class="dropdown-item" href="<?= base_url('/Penelitian_kk/Riwayat') ?>">Riwayat Penelitian</a>
            <a class="dropdown-item" href="<?= base_url('/Penelitian/Skema') ?>">Skema Penelitian</a>
            <a class="dropdown-item" href="<?= base_url('/publikasi') ?>">Publikasi</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Abdimas</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?= base_url('Abdimas_kk') ?>">Progres Abdimas</a>
            <a class="dropdown-item" href="<?= base_url('Abdimas_kk/riwayatAbdimas') ?>">Riwayat Abdimas</a>
            <a class="dropdown-item" href="<?= base_url('Abdimas_kk/skema') ?>">Skema Abdimas</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>PAK</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?= base_url('pak') ?>">Kredit PAK</a>
            <a class="dropdown-item" href="<?= base_url('pak/kategori') ?>">Kategori PAK</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-bullhorn"></i>
            <span>Pengumuman</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?= base_url('/Pengumuman/inputPengumuman') ?>">Input Pengumuman</a>
            <a class="dropdown-item" href="<?php echo site_url('pengumuman') ?>">List Pengumuman</a>
        </div>
    </li>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Pengaturan</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="<?= base_url('/Pengaturan/settingKK') ?>">User Role</a>
            <a class="dropdown-item" href="<?= base_url('/Pengaturan/penggunaDosen') ?>">Pengguna</a>
            <a class="dropdown-item" href="<?= base_url('/Pengaturan/bidang') ?>">Bidang Keilmuan</a>
        </div>
    </li>
</ul>