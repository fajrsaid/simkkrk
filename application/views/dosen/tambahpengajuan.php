<!DOCTYPE html>
<html lang="en">

  <head>
    <title>Pengajuan Barang</title>
    <?php $this->load->view("_partials/header.php") ?>
  </head>

  <body id="page-top">

    <?php $this->load->view("_partials/navbar.php",$this->data) ?>

    <div id="wrapper">

      <!-- Sidebar -->
      <?php $this->load->view("_partials/sidebar.php") ?>

      <div id="content-wrapper">

        <div class="container-fluid">



          <!-- Breadcrumbs-->
         <html>
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success" role="alert">
          <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php endif; ?>

        <div class="card mb-3">
          <div class="card-header">
            <a href="<?php echo base_url('index.php/dosen/pengajuan/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
          </div>
          <div class="card-body">

            <?php echo form_open_multipart('pengajuan/aksi_upload');?>
              <!-- <form action="" method="post" enctype="multipart/form-data" > -->
            <div class="form-group">
            <label for="name">Nama Pengaju</label>
                <input class="form-control <?php echo form_error('nama_dosen') ? 'is-invalid':'' ?>"
                 type="hidden" name="nama_dosen" value="<?=$this->session->userdata("nama_awal").' '. $this->session->userdata("nama_akhir")?>  "/>
                 <input type="text" name="" value="<?=$this->session->userdata("nama_awal").' '. $this->session->userdata("nama_akhir")?>  " disabled="disabled">
                <div class="invalid-feedback">
                  <?php echo form_error('nama_pengaju')  ?>
                </div>
              </div>


              <div class="card-body">
            <div class="form-group">
            <label for="name">NIP</label>
                <input class="form-control <?php echo form_error('nip') ? 'is-invalid':'' ?>"
                 type="hidden" name="nip" value="<?=$this->session->userdata("nip")?> "/>
                 <input type="text" name=""  value="<?=$this->session->userdata("nip")?>" disabled="disabled" >
                <div class="disabled">
                  <?php echo form_error('nip') ?>
                </div>
              </div>

  Laboratorium
        <select name="id_laboratorium" id="" class="form-control"  required>
                            <option value="">- Pilih Lab -</option>
                            <?php
                                foreach($laboratorium as $row){
                                    $selected_cat = $row['id_laboratorium'] == $pengajuan_barang->id_laboratorium ? 'selected="selected"' : '';
                                    echo "<option value = '".$row['id_laboratorium']."' ".$selected_cat.">".$row['nama_laboratorium']."</option>";
                                }
                            ?>
                            
                        </select>
                    </td>
                </tr>


              <div class="form-group">
                <label for="name">Tanggal Pengajuan</label>
                <input class="form-control <?php echo form_error('tanggal_pengajuan') ? 'is-invalid':'' ?>"
                 type="date" name="tanggal_pengajuan" placeholder="Tanggal Pengajuan" />
                <div class="invalid-feedback">
                  <?php echo form_error('tanggal_pengajuan') ?>
                </div>
              </div>

                    
                      <tr>
                        <td class="td-width">Ungggah Form Pengajuan Sah</td>
                        <td class="td-padding1">
                          <input type="file" name="file" required>
                        </td>
                      </tr>
                    </div>
                <div id="">
                  <table class="table table-hover" id="tabel-pengajuan">
                    <tr>
                      <th></th>
                      <th>Nama Barang</th>
                      <th>Spesifikasi</th>
                      <th>Vol</th>
                    </tr>
                    <tr>
                      <td width="5%"></td>
                      <td width="28%">
                        <input class="form-control <?php echo form_error('nama_barang') ? 'is-invalid':'' ?>" type="text" name="nama_barang[]"  "/>
                      </td>
                      <td width="57%">
                        <input class="form-control <?php echo form_error('spek') ? 'is-invalid':'' ?>" type="text" name="spek[]"  "/>
                      </td>
                      <td width="10%">
                        <input class="form-control <?php echo form_error('vol') ? 'is-invalid':'' ?>" type="number" name="vol[]"  "/>
                      </td>
                    </tr>
                  </table>
                </div>
                <button class="btn btn-sm btn-primary" id="tambah-form" type="button"><i class="fas fa-plus"></i> Tambah Barang</button><br><br>

                <div class="form-group">
                <label for="name">Jumlah Barang Datang</label>
                <input class="form-control <?php echo form_error('vol_datang') ? 'is-invalid':'' ?>"
                 type="number" name="vol_datang" value="0" disabled="disabledx" />
                <div class="invalid-feedback">
                  <?php echo form_error('vol_datang') ?>
                </div>
              </div>
Status
              </label>
        <div class="col-sm-10">
          <input type="hidden" name="id_status" value="0">
              <?php
        echo "<select name='id_status' id='id_status' disabled='disabled'>";
        if (count($status_pengajuan)) {
           foreach ($status_pengajuan as $list)
            {
        echo "<option value='". $list['id_status'] . "'>" . $list['nama_status'] . "</option>"; 

        }
      }
    echo "</select><br/>";
      ?>

              Cek Barang
        </label>
        <div class="col-sm-10">
          <input type="hidden" name="id_cek" value="0">
              <?php
        echo "<select name='id_cek' id='id_cek' disabled='disabled'>";
        if (count($cek_barang)) {
           foreach ($cek_barang as $list)
            {
        echo "<option value='". $list['id_cek'] . "'>" . $list['nama_cek'] . "</option>"; 

        }
      }
    echo "</select><br/>";
      ?>


              <button name="" class="btn btn-primary">
             simpan
            </button>
            </form>

            </form>

          </div>

        </div>
</html>
  
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
            <a class="btn btn-primary" href="<?php echo base_url() ?>index.php/dosen/logout"   >Logout</a>
          </div>
        </div>
      </div>
    </div>
    <?php $this->load->view("_partials/js.php") ?>
    <!-- JS ++ -->
    <script>
    $(document).on('click', '#tambah-form', function() {
      var html_form = `
        <tr>
          <td width="5%"><button class="btn btn-sm btn-danger btn-block type="button" id="delete-form"><i class="fas fa-minus"></i></button></td>
          <td width="28%">
            <input class="form-control <?php echo form_error('nama_barang') ? 'is-invalid':'' ?>" type="text" name="nama_barang[]"  "/>
          </td>
          <td width="57%">
            <input class="form-control <?php echo form_error('spek') ? 'is-invalid':'' ?>" type="text" name="spek[]"  "/>
          </td>
          <td width="10%">
            <input class="form-control <?php echo form_error('vol') ? 'is-invalid':'' ?>" type="number" name="vol[]"  "/>
          </td>
        </tr>
      `
      $('#tabel-pengajuan').append(html_form)
    })

    $(document).on('click', '#delete-form', function() {
        $(this).parent().parent().remove()
      })
    </script>
  </body>

</html>
