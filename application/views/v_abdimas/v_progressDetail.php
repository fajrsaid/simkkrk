<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view("_partials/header.php"); ?>
  </head>
  <body id="page-top">
    <?php $this->load->view("_partials/navbar.php", $this->data); ?>

    <div id="wrapper">
      <?php $this->load->view("_partials/sidebar.php"); ?>
      <div id="content-wrapper">
       <div class="container-fluid">
          <div class="mb-3">
            <h1>Detail Pengabdian Masyarakat</h1><hr><br>
            <?php if ($this->session->flashdata('alert_success')) {?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('alert_success'); ?>
                </div>
            <?php } ?>
            <table class="table-detail">
                <?php 
                  if ($detail_abdimas['id_status'] == 2 ) { 
                    if (empty($detail_abdimas['laporan_antara'])) {
                      echo form_open_multipart('Abdimas/aksi_upload_lapantara/'.$detail_abdimas['id_abdimas']); ?>
                      <tr>
                        <td class="td-width">Ungggah Laporan Antara</td>
                        <td class="td-padding1">
                          <input type="file" name="laporan_antara" required>
                        </td>
                      </tr>
                      <tr>
                          <td class="td-width"></td>
                          <td class="td-padding1">
                            <button type="submit" name="" class="btn btn-sm btn-primary">
                              Upload
                            </button>
                          </td>
                      </tr>
                      <?php
                    }else {
                      echo form_open_multipart('Abdimas/aksi_upload/'.$detail_abdimas['id_abdimas']);?>
                      <tr>
                        <td class="td-width">Ungggah Laporan Akhir</td>
                        <td class="td-padding1">
                          <input type="file" name="laporan_akhir" required>
                        </td>
                      </tr>
                      <tr>
                        <td class="td-width">Kegiatan untuk Simulasi PAK</td>
                        <td class="td-padding1">
                          <select name="kode_pak" id="" class="form-control" required>
                            <option value="">- Pilih Kegiatan -</option>
                            <?php
                                foreach($list_kreditpak as $list_kreditpak){ ?>
                                  <option value='<?= $list_kreditpak['id_pedoman_pak'] ?>'><?= $list_kreditpak['kegiatan'] ?></option>
                                  <?php
                                }
                            ?>
                          </select>
                        </td>
                      </tr>
                      <tr>
                          <td class="td-width"></td>
                          <td class="td-padding1">
                            <button type="submit" name="" class="btn btn-sm btn-primary">
                              Upload
                            </button>
                          </td>
                      </tr>
                      <?php
                    }
                  } elseif ($detail_abdimas['id_status'] == 4) { 
                    if (empty($detail_abdimas['proposal'])) { 
                      echo form_open_multipart('Abdimas/aksi_upload_proposal/'.$detail_abdimas['id_abdimas']); ?>
                        <tr>
                          <td class="td-width">Ungggah Proposal</td>
                          <td class="td-padding1">
                            <input type="file" name="proposal" required>
                          </td>
                        </tr>
                        <tr>
                            <td class="td-width"></td>
                            <td class="td-padding1">
                              <button type="submit" name="" class="btn btn-sm btn-primary">
                                Upload
                              </button>
                            </td>
                        </tr>
                      <?php
                    }
                  }
                ?>
                <tr>
                    <td class="td-width">Judul</td>
                    <td class="td-padding1"><?= $detail_abdimas['judul_abdimas'] ?></td>
                </tr>
                <tr>
                    <td class="td-width">Mitra (Instansi/Badan/Komunitas/(nama mitra))</td>
                    <td class="td-padding1"><?= $detail_abdimas['mitra_instansi'] ?></td>
                </tr>
                <tr>
                    <td class="td-width">Masyarakat Sasar</td>
                    <td class="td-padding1"><?= $detail_abdimas['mitra_sasar'] ?></td>
                </tr>
                <tr>
                    <td class="td-width">Skema Pengabdian Masyarakat</td>
                    <td class="td-padding1"><?= $detail_abdimas['skema'] ?></td>
                </tr>
                <tr>
                    <td class="td-width">Periode Kegiatan</td>
                    <td class="td-padding1"><?= tgl_indo($detail_abdimas['tgl_mulai']) ?> - <?= tgl_indo($detail_abdimas['tgl_selesai']) ?></td>
                </tr>
                <tr>
                    <td class="td-width">Usulan/Realisasi Anggaran (Dana Internal)</td>
                    <td class="td-padding1">Rp. <?= number_format($detail_abdimas['dana_internal']) ?>,-</td>
                </tr>
                <tr>
                    <td class="td-width">Usulan/Realisasi Anggaran (Sumber dana lain institusi)</td>
                    <td class="td-padding1">Rp. <?= number_format($detail_abdimas['dana_luar']) ?>,-</td>
                </tr>
                <tr>
                    <td class="td-width">Tanggal Mengajukan</td>
                    <td class="td-padding1"><?= tgl_indo($detail_abdimas['tgl_mengajukan']) ?></td>
                </tr>
                <tr>
                    <td class="td-width">Tanggal Mengajukan</td>
                    <td class="td-padding1">
                      <?php 
                        $no = 1;
                        foreach ($getAnggotaAbdimas as $getAnggotaAbdimas) {
                          echo $no.'. '.$getAnggotaAbdimas['nama_awal'].' '.$getAnggotaAbdimas['nama_akhir'].'<br>';
                          $no++;
                        }
                      ?>
                    </td>
                </tr>
                <tr>
                    <td class="td-width">Tahun Anggaran</td>
                    <td class="td-padding1"><?= $detail_abdimas['thn_anggaran'] ?></td>
                </tr>
                <?php 
                  if (!empty($detail_abdimas['proposal'])) { ?>
                    <tr>
                      <td class="td-width">Proposal Pengajuan</td>
                      <td class="td-padding1">
                        <a href="<?php print site_url('/assets/documents/abdimas/proposal/'.$detail_abdimas['proposal']) ?>" target="blank">
                          <?= $detail_abdimas['proposal'] ?>
                        </a>
                      </td>
                    </tr>
                    <?php
                  }
                ?>
                <?php 
                  if (!empty($detail_abdimas['laporan_antara'])) { ?>
                    <tr>
                      <td class="td-width">Proposal Pengajuan</td>
                      <td class="td-padding1">
                        <a href="<?php print site_url('/assets/documents/abdimas/laporan_antara/'.$detail_abdimas['laporan_antara']) ?>" target="blank">
                          <?= $detail_abdimas['laporan_antara'] ?>
                        </a>
                      </td>
                    </tr>
                    <?php
                  }
                ?>
                <?php 
                  if ($detail_abdimas['id_status'] == 2 || $detail_abdimas['id_status'] == 3 || $detail_abdimas['id_status'] == 20 ) { ?>
                    
                      <tr>
                        <td class="td-width">Laporan Akhir</td>
                        <td class="td-padding1">
                          <?php 
                            if (!empty($detail_abdimas['laporan_akhir'])) { ?>
                              <a href="<?php print site_url('/assets/documents/laporan_abdimas/'.$detail_abdimas['laporan_akhir']) ?>" target="blank  ">
                                <?= $detail_abdimas['laporan_akhir'] ?>
                              </a>
                            <?php } else {
                              echo "Belum upload laporan akhir";
                            }
                          ?>
                        </td>
                      </tr>
                    
                <?php } ?>
                <tr>
                    <td class="td-width">Status</td>
                    <td class="td-padding1"><?= $detail_abdimas['status'] ?></td>
                </tr>
                <?php 
                  if ($detail_abdimas['id_status'] == '5') { ?>
                    <tr>
                      <td class="td-width">Alasan Ditolak</td>
                      <td class="td-padding1"><?= $detail_abdimas['alasan_tolak'] ?></td>
                    </tr>
                <?php }
                ?>
                <tr>
                    <td class="td-width"></td>
                    <td class="td-padding1">
                      <?php 
                        if ($detail_abdimas['id_status'] == 3 || $detail_abdimas['id_status'] == 6) {
                          echo "";
                        }else { ?>
                          <a href="<?= base_url('/Abdimas/cetakPernyataanKetua/'.$detail_abdimas['id_abdimas']) ?>" class="btn btn-sm btn-dark btn-skema" target="blank"><i class="fas fa-download"></i> Cetak Surat Pernyataan Ketua/Koordinator Tim</a><br> 
                          <?php
                          if ($detail_abdimas['id_status'] == 1 || $detail_abdimas['id_status'] == 5) { 
                            if (empty($detail_abdimas['mitra_nama'])) { ?>
                              <button type="button" class="btn btn-sm btn-warning btn-skema" data-toggle="modal" data-target="#modalDataMitra">
                                <i class="fas fa-pen"></i> Lengapi Data Mitra
                              </button>
                              <a href="" class="btn btn-sm btn-dark btn-skema disabled" target="blank"><i class="fas fa-download"></i> Cetak Surat Konfirmasi Masyarakat Sasar</a><br>
                              <?php
                            }else { ?>
                              <button type="button" class="btn btn-sm btn-warning btn-skema" data-toggle="modal" data-target="#modalDataMitra">
                                <i class="fas fa-pen"></i> Data Mitra
                              </button>
                              <a href="<?= base_url('/Abdimas/cetakKonfirmasiMasyarakat/'.$detail_abdimas['id_abdimas']) ?>" class="btn btn-sm btn-dark btn-skema" target="blank"><i class="fas fa-download"></i> Cetak Surat Konfirmasi Masyarakat Sasar</a><br>
                              <?php
                            } ?> 
                            <button data-link="<?php echo base_url('/Abdimas/hapusPengajuan/'.$detail_abdimas['id_abdimas']) ?>" type="button" id="do-confirm" class="btn btn-sm btn-danger btn-skema"><i class="fas fa-times-circle"></i> Batalkan Pengajuan</button><br>
                            <a href="" class="btn btn-sm btn-dark btn-skema disabled" target="blank"><i class="fas fa-download"></i> Cetak Lembar Pengesahan Proposal</a><br>
                            <?php
                          } elseif ($detail_abdimas['id_status'] == 2 || $detail_abdimas['id_status'] == 4) { ?>
                            <a href="<?php echo base_url('/Abdimas/cetakPengesahan/'.$detail_abdimas['id_abdimas']) ?>" target="blank" class="btn btn-sm btn-dark"><i class="fas fa-download"></i> Cetak Lembar Pengesahan Proposal</a>
                            <?php
                          } 
                        }
                      ?>
                    </td>
                </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php $this->load->view("v_abdimas/modal_dataMitra.php"); ?>
    <?php $this->load->view("_partials/footer.php"); ?>
    <?php $this->load->view("_partials/js.php"); ?>
    <script>
      $(document).ready(function(){
        $(document).on('click', '#do-confirm', function () {
          var href = $(this).attr('data-link');
          $.confirm({
            title: 'Batalkan Pengajuan?',
            content: 'Yakin akan membatalkan pengajuan?',
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
      
    </script>
  </body>
</html>
