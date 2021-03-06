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
            <h1>Detail Penelitian</h1><hr><br>
            <?php if ($this->session->flashdata('alert_success')) {?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('alert_success'); ?>
                </div>
            <?php } ?>
            <table class="table-detail">
              <?php 
                  if ($detailPenelitian['id_status'] == 2 ) { 
                    if (empty($detailPenelitian['laporan_antara'])) {
                      echo form_open_multipart('Penelitian/aksi_upload_lapantara/'.$detailPenelitian['id_penelitian']); ?>
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
                      echo form_open_multipart('Penelitian/aksi_upload/'.$detailPenelitian['id_penelitian']);?>
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
                                  <option value='<?= $list_kreditpak['id_pedoman_pak'] ?>' data-toggle="tooltip" data-placement="bottom" title="<?= $list_kreditpak['kegiatan'] ?>"><?= $list_kreditpak['kode_pak'] ?></option>
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
                  } elseif ($detailPenelitian['id_status'] == 4) { 
                    if (empty($detailPenelitian['proposal'])) { 
                      echo form_open_multipart('Penelitian/aksi_upload_proposal/'.$detailPenelitian['id_penelitian']); ?>
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
                  <td class="td-width">Skema Pengabdian Masyarakat</td>
                  <td class="td-padding1"><?= $detailPenelitian['skema'] ?></td>
              </tr>
              <tr>
                  <td class="td-width">Judul Penelitian</td>
                  <td class="td-padding1"><?= $detailPenelitian['judul_penelitian'] ?></td>
              </tr>
              <tr>
                  <td class="td-width">Ketua Peneliti</td>
                  <td class="td-padding1"><?= $detailPenelitian['nama_awal'] ?> <?= $detailPenelitian['nama_akhir'] ?></td>
              </tr>
              
              <?php 
                if ($detailPenelitian['id_skema'] == 1 || $detailPenelitian['id_skema'] == 2 || $detailPenelitian['id_skema'] == 3) { ?>
                  <tr>
                    <td class="td-width">Ketua Tim Mitra</td>
                    <td class="td-padding1"><?= $detailPenelitian['mitra_ketua'] ?></td>
                  </tr>
                  <tr>
                    <td class="td-width">Institusi Mitra</td>
                    <td class="td-padding1"><?= $detailPenelitian['mitra_institusi'] ?></td>
                  </tr>
              <?php } elseif ($detailPenelitian['id_skema'] == 7) { ?>
                <tr>
                    <td class="td-width">Bidang Unggulan</td>
                    <td class="td-padding1"><?= $detailPenelitian['bidang_unggulan'] ?></td>
                  </tr>
                  <tr>
                    <td class="td-width">Topik Unggulan</td>
                    <td class="td-padding1"><?= $detailPenelitian['topik_unggulan'] ?></td>
                  </tr>
                  <?php
                }
              ?>
              <tr>
                  <td class="td-width">Anggota Peneliti (Bd. Keahalian)</td>
                  <td class="td-padding1">
                    <?php 
                      $no = 1;
                      foreach ($dataAnggotaDsn as $data) { ?>
                        <form action="<?= base_url('/Penelitian/hapusAnggotaPnt/'.$data['id_anggota']) ?>" method="post">
                        <?php
                        echo $no.'. '.$data['nama_awal'].' '.$data['nama_akhir'].' ('.$data['nama_bidang'].') '; 
                          if ($detailPenelitian['id_status'] == 1 || $detailPenelitian['id_status'] == 5) { ?>
                              <button type="submit" class="btn btn-sm btn-light"><i class="fas fa-minus-square"></i></button>
                              <input type="hidden" name="id_penelitian" value="<?= $detailPenelitian['id_penelitian'] ?>">
                          <?php }
                        echo '<br>';
                        $no++; ?>
                        </form>
                        <?php
                      }
                    ?>
                  </td>
              </tr>
              <?php 
                if ($detailPenelitian['id_skema'] == 6) {?>
                  <tr>
                      <td class="td-width">Anggota Peneliti Mahasiswa</td>
                      <td class="td-padding1">
                        <?php 
                          $no = 1;
                          foreach ($dataAnggotaMhs as $data_mhs) {
                            echo $no.'. '.$data_mhs['nama_awal'].' '.$data_mhs['nama_akhir']; 
                              if ($detailPenelitian['id_status'] == 1 || $detailPenelitian['id_status'] == 5) { ?>
                                <a href="<?= base_url('/Penelitian/hapusAnggotaMhs/'.$data_mhs['id_anggota_mhs']) ?>" class="btn btn-sm btn-light">
                                  <i class="fas fa-minus-square"></i>
                                </a>
                              <?php }
                            echo '<br>';
                            $no++;
                          }
                        ?>
                      </td>
                  </tr>
                  <?php
                }
              ?>
              <tr>
                  <td class="td-width">Jadwal Pelaksanaan</td>
                  <td class="td-padding1"><?= tgl_indo($detailPenelitian['jadwal_awal']) ?> - <?= tgl_indo($detailPenelitian['jadwal_akhir']) ?></td>
              </tr>
              <?php 
                if ($detailPenelitian['id_skema'] == '1' || $detailPenelitian['id_skema'] == '2' || $detailPenelitian['id_skema'] == '3') { ?>
                  <tr>
                    <td class="td-width">Sumber Pembiayaan (Universitas Telkom)</td>
                    <td class="td-padding1">Rp. <?= number_format($detailPenelitian['dana_internal']) ?>,-</td>
                  </tr>
                  <tr>
                    <td class="td-width">Sumber Pembiayaan (Mitra)</td>
                    <td class="td-padding1">Rp. <?= number_format($detailPenelitian['dana_luar']) ?>,-</td>
                  </tr>
                <?php }else{ ?>
                  <tr>
                    <td class="td-width">Pembiayaan</td>
                    <td class="td-padding1">Rp. <?= number_format($detailPenelitian['dana_luar']) ?>,-</td>
                  </tr>
                <?php }
              ?>
              <tr>
                  <td class="td-width">Tanggal Mengajukan</td>
                  <td class="td-padding1"><?= tgl_indo($detailPenelitian['tgl_mengajukan']) ?></td>
              </tr>
              <tr>
                  <td class="td-width">Tahun Anggaran</td>
                  <td class="td-padding1"><?= $detailPenelitian['thn_anggaran'] ?></td>
              </tr>
              <?php 
                if (!empty($detailPenelitian['proposal'])) { ?>
                  <tr>
                    <td class="td-width">Proposal Pengajuan</td>
                    <td class="td-padding1">
                      <a href="<?php print site_url('/assets/documents/penelitian/proposal/'.$detailPenelitian['proposal']) ?>" target="blank">
                        <?= $detailPenelitian['proposal'] ?>
                      </a>
                    </td>
                  </tr>
                  <?php
                }
              ?>
              <?php 
                if (!empty($detailPenelitian['laporan_antara'])) { ?>
                  <tr>
                    <td class="td-width">Laporan Antara</td>
                    <td class="td-padding1">
                      <a href="<?php print site_url('/assets/documents/penelitian/proposal/'.$detailPenelitian['laporan_antara']) ?>" target="blank">
                        <?= $detailPenelitian['laporan_antara'] ?>
                      </a>
                    </td>
                  </tr>
                  <?php
                }
              ?>
              <?php 
                if (!empty($detailPenelitian['laporan_akhir'])) { ?>
                  <tr>
                    <td class="td-width">Laporan Akhir</td>
                    <td class="td-padding1">
                      <a href="<?php print site_url('/assets/documents/penelitian/laporan_akhir/'.$detailPenelitian['laporan_akhir']) ?>" target="blank">
                        <?= $detailPenelitian['laporan_akhir'] ?>
                      </a>
                    </td>
                  </tr>
                  <?php
                }
              ?>
              <tr>
                  <td class="td-width">Status</td>
                  <td class="td-padding1"><?= $detailPenelitian['status'] ?></td>
              </tr>
              <?php 
                  if (!empty($detailPenelitian['alasan_tolak'])) { ?>
                  <tr>
                      <td class="td-width">Alasan Ditolak</td>
                      <td class="td-padding1"><?= $detailPenelitian['alasan_tolak'] ?></td>
                  </tr>
              <?php } ?>
                <tr>
                  <td class="td-width"></td>
                  <td class="td-padding1">
                    <?php 
                      if ($detailPenelitian['id_status'] == 3 || $detailPenelitian['id_status'] == 20) { ?>
                        <?php
                      }else { ?>
                        <a href="<?= base_url('/Penelitian/sPernyataanKetua/'.$detailPenelitian['id_penelitian']) ?>" class="btn btn-sm btn-dark btn-skema" target="blank"><i class="fas fa-print"></i> Surat Pernyataan Ketua/Koordinator Tim</a><br>
                        <?php
                        if ($detailPenelitian['id_skema'] == 1 || $detailPenelitian['id_skema'] == 2 || $detailPenelitian['id_skema'] == 3) { ?>
                          <a href="<?= base_url('/Penelitian/sKesediaanMitra/'.$detailPenelitian['id_penelitian']) ?>" class="btn btn-sm btn-dark btn-skema" target="blank"><i class="fas fa-print"></i> Surat Kesediaan Mitra</a><br>
                          <?php
                        }
                        if ($detailPenelitian['id_status'] == 1 || $detailPenelitian['id_status'] == 5) { ?>
                          <a href="" target="blank" class="btn btn-sm btn-dark disabled"><i class="fas fa-print"></i> Lembar Pengesahan Proposal</a>
                          <button data-link="<?= base_url('/Penelitian/hapusPengajuan/'.$detailPenelitian['id_penelitian']) ?>" type="button" id="do-confirm"class="btn btn-sm btn-danger"><i class="fas fa-times-circle"></i> Batalkan Pengajuan</button>
                          <?php
                        }elseif ($detailPenelitian['id_status'] == 2 || $detailPenelitian['id_status'] == 4) { ?>
                          <a href="<?= base_url('/Penelitian/sLembarPengesahan/'.$detailPenelitian['id_penelitian']) ?>" target="blank" class="btn btn-sm btn-dark"><i class="fas fa-print"></i> Lembar Pengesahan Proposal</a>
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
