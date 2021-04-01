<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view("_partials/header.php") ?>
  </head>
  <body id="page-top">
    <?php $this->load->view("_partials/js.php") ?>
    <?php $this->load->view("_partials/navbar.php", $this->data) ?>


    <div id="wrapper">
      <?php $this->load->view("_partials/sidebar.php") ?>
      <div id="content-wrapper">
        <div class="container-fluid">
          <?php
            foreach($list_pengumuman as $row){ ?>
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-3">
                  <div class="card-header">
                    <i class="fas fa-bullhorn"></i>
                    <?= $row['judul'] ?>
                  </div>
                  <div class="card-body">
                    <?= $row['pengumuman'] ?>
                    <?php 
                      if (!empty($row['file'])) { ?>
                        <hr>
                        <a href="<?php print site_url('/assets/documents/pengumuman/'.$row['file']) ?>" target="blank  ">
                          <i class="fas fa-file-download"></i>
                          <?= $row['file'] ?>
                        </a>
                        <?php
                      }
                    ?>
                  </div>
                  <div class="card-footer small text-muted">Updated <?= $row['tgl_dibuat'] ?></div>
                </div>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php $this->load->view("_partials/footer.php") ?>
  </body>
</html>
