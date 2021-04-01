<!DOCTYPE html>
<html lang="en">

  <head>
    <title>PKIP - Dashboard</title>
 <?php $this->load->view("_partials/header.php") ?>  </head>

  <body id="page-top">

       <?php $this->load->view("_partials/navbar.php", $this->data) ?>  </head>

    <div id="wrapper">

      <!-- Sidebar -->
      <?php $this->load->view("_partials/sidebar.php") ?>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- DataTables Example -->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Daftar Judul Tugas Akhir</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                

                <!-- <?php echo base_url('/pkip/print/'.$list_jadwalujian['id_jadwal']) ?> -->
                 <thead>
      <tr>
        <th>No</th>
        <th>Nim</th>
        <th>Nama</th>
        <th>Judul</th>
        <th>Topik</th>
        <th>Pembimbing 1</th>
        <th>Pembimbing 2</th>
        <th>Penguji 1</th>
        <th>Penguji 2</th>
        <th>Waktu Ujian</th>
        <th>Tempat Pengujian</th>
        <th>Aksi</th>
      </tr>
    </thead>
<tbody>
                    <?php
                    $no = 1;
                    foreach($list_jadwalujian as $row){ ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $row['nim'] ?></td>
                        <td><?= $row['nama_awal']; ?> <?= $row['nama_akhir']; ?></td>
                        <td><?= $row['judul'] ?></td>
                        <td><?= $row['topik'] ?></td>
                        <td><?= $row['pbb1'] ?></td>
                        <td><?= $row['pbb2'] ?></td>
                        <td><?= $row['pgj1'] ?></td>
                        <td><?= $row['pgj2'] ?></td>
                        <td><?= $row['waktuujian'] ?></td>
                        <td><?= $row['tempatujian'] ?></td>
                        <td>




                    <center>
                        <center><button data-link="<?php echo base_url('/pkip/acceptlulus/'.$row['id_judul']) ?>" type="button" id="do-confirm" class="btn btn-sm btn-success" ><i class="fas fa-check"></i> Lulus Seminar</button></center>
                          <center><button data-link="<?php echo base_url('/pkip/seminarReject/'.$row['id_judul']) ?>" type="button" id="do-reject" class="btn btn-sm btn-danger"><i class="fas fa-times-circle"></i> Seminar Ulang</button></center>
                    </center>
                        </td>
                      </tr>
                    <?php $no++; } ?>
      </tbody>






                </table>
                <!-- <button data-link="" type="button" class="btn btn-sm btn-success" name="btnlulusseminar"><i class="fa fa-print"></i> Print Jadwal</button> -->
              </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
          </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Your Website 2018</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="<?php echo base_url() ?>index.php/mahasiswa/logout"   >Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <?php $this->load->view("_partials/js.php") ?>
   <script>
      $(document).ready(function(){
        $(document).on('click', '#do-reject', function () {
          var href = $(this).attr('data-link');
          var form = `<textarea class="form-control" name="alasan_tolak" placeholder="Berikan Alasan"></textarea>`;
          $.confirm({
            title: 'Tolak Pengajuan?',
            content: form,
            type: 'red',
            buttons: {   
                ok: {
                  text: "Ya",
                  btnClass: 'btn-primary',
                  keys: ['enter'],
                  action: function(){
                      window.location.href = href; 
                  }
                },
                Tidak: function(){
                  console.log('the user clicked cancel');
                }
            }
          });
        })
      });
      
      $(document).ready(function(){
        $(document).on('click', '#do-confirm', function () {
          var href = $(this).attr('data-link');
          $.confirm({
            title: 'Seminar',
            content: 'Apakah anda yakin?',
            type: 'green',
            buttons: {   
                ok: {
                  text: "Ya",
                  btnClass: 'btn-primary',
                  keys: ['enter'],
                  action: function(){
                      window.location.href = href; 
                  }
                },
                Tidak: function(){
                  console.log('the user clicked cancel');
                }
            }
          });
        })
      });

      $(document).ready(function(){
        $(document).on('click', '#do-finish', function () {
          var href = $(this).attr('data-link');
          $.confirm({
            title: 'Nyatakan Selesai?',
            content: 'Yakin akan menyatakan pengabdian masyarakat selesai?',
            type: 'green',
            buttons: {   
                ok: {
                  text: "Ya",
                  btnClass: 'btn-primary',
                  keys: ['enter'],
                  action: function(){
                      window.location.href = href; 
                  }
                },
                Tidak: function(){
                  console.log('the user clicked cancel');
                }
            }
          });
        })
      });
    </script>

  </body>

</html>
