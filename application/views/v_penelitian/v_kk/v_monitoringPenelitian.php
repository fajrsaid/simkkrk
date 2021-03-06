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
            <div class="mb-3">
            <h1>Monitoring Penelitian</h1><hr><br>
            <?php if ($this->session->flashdata('alert_setuju')) {?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('alert_setuju'); ?>
                </div>
            <?php } ?>
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-3">
                  <div class="card-header">
                    <i class="fas fa-chart-bar"></i>
                    Grafik Pelaksanaan Pengabdian Masyarakat</div>
                  <div class="card-body">
                    <canvas id="myBarChart" width="100%" height="20"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <form action="<?= base_url('Penelitian_kk/monitoring') ?>" method="post">
                <div class="form-row">
                    <div class="form-group col-md-5">
                        Cari berdasarkan
                    </div>
                    <div class="form-group col-md-2">
                        <select id="" name="skema" class="form-control">
                        <option value="">- Skema Penelitian -</option>
                        <?php 
                            foreach ($load_skema as $load_skema) { ?>
                            <option value="<?= $load_skema['id_skema'] ?>"><?= $load_skema['skema'] ?></option>
                            <?php
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <select id="" name="nip" class="form-control">
                        <option value="">- Kode Dosen -</option>
                        <?php 
                            foreach ($load_dosen as $load_dosen) { ?>
                            <option value="<?= $load_dosen['nip'] ?>"><?= $load_dosen['kode_dosen'] ?></option>
                            <?php
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <select id="" name="status" class="form-control">
                        <option value="">- Status -</option>
                        <?php 
                            foreach ($load_status as $load_status) { ?>
                            <option value="<?= $load_status['id_status'] ?>"><?= $load_status['status'] ?></option>
                            <?php
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group col-md-1">
                        <button class="btn btn-info btn-block">
                        <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Skema Penelitian</th>
                    <th>Judul Penelitian</th>
                    <th>Dosen Peneliti</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach($dataPenelitian as $row){ ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['skema'] ?></td>
                        <td><?= $row['judul_penelitian'] ?></td>
                        <td><?= $row['nama_awal']; ?> <?= $row['nama_akhir']; ?></td>
                        <td><?= $row['status'] ?></td>
                        <td>
                          <center>
                            <a href='<?= base_url('/Penelitian_kk/penelitianDetail/'.$row['id_penelitian']) ?>' class='btn btn-sm btn-primary'>Detail</i></a>
                          </center>
                        </td>
                      </tr>
                    <?php $no++; } ?>
                </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>
    <?php $this->load->view("_partials/footer.php") ?>
    <script>
      $(document).ready(function() {
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Bar Chart Example
        $.ajax({
          url : '<?= base_url('Penelitian_kk/countPenelitian') ?>',
          type : 'get',
          success : function (response) {
            var dataKode = []
            var dataCount = []
            $.each(response, function(key, value){
              dataKode.push(value.kode_dosen)
              dataCount.push(value.jmlPenelitian)
            })
            var ctx = document.getElementById("myBarChart");
            var myLineChart = new Chart(ctx, {
              type: 'bar',
              data: {
                labels: dataKode,
                datasets: [{
                  label: "Jumlah Penelitian",
                  backgroundColor: "rgba(2,117,216,1)",
                  borderColor: "rgba(2,117,216,1)",
                  data: dataCount,
                }],
              },
              options: {
                scales: {
                  xAxes: [{
                    time: {
                      unit: 'month'
                    },
                    gridLines: {
                      display: false
                    },
                    ticks: {
                      maxTicksLimit: 0
                    }
                  }],
                  yAxes: [{
                    ticks: {
                      min: 0,
                      max: 100,
                      maxTicksLimit: 0
                    },
                    gridLines: {
                      display: true
                    }
                  }],
                },
                legend: {
                  display: false
                }
              }
            });
          }
        })
      })
      // Set new default font family and font color to mimic Bootstrap's default styling
      
    </script>
  </body>
</html>
