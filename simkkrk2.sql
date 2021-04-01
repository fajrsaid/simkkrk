/*
Navicat MySQL Data Transfer

Source Server         : connection
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : simkkrk

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-07-24 16:47:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for abdimas
-- ----------------------------
DROP TABLE IF EXISTS `abdimas`;
CREATE TABLE `abdimas` (
  `id_abdimas` int(11) NOT NULL AUTO_INCREMENT,
  `judul_abdimas` varchar(255) NOT NULL,
  `mitra_instansi` varchar(255) DEFAULT NULL,
  `mitra_sasar` varchar(255) NOT NULL,
  `mitra_nama` varchar(255) DEFAULT NULL,
  `mitra_jabatan` varchar(255) DEFAULT NULL,
  `id_skema` int(11) NOT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_selesai` date DEFAULT NULL,
  `dana_internal` decimal(19,2) DEFAULT NULL,
  `dana_luar` decimal(19,2) DEFAULT NULL,
  `tgl_mengajukan` date DEFAULT NULL,
  `id_status` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  `tgl_update` date DEFAULT NULL,
  `alasan_tolak` varchar(255) DEFAULT NULL,
  `thn_anggaran` varchar(5) DEFAULT NULL,
  `proposal` varchar(255) DEFAULT NULL,
  `laporan_antara` varchar(255) DEFAULT NULL,
  `laporan_akhir` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_abdimas`),
  KEY `relasi_nip_abdimas` (`nip`),
  KEY `relasi_status_abdimas` (`id_status`),
  KEY `relasi_skema_abdimas` (`id_skema`),
  CONSTRAINT `relasi_nip_abdimas` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `relasi_skema_abdimas` FOREIGN KEY (`id_skema`) REFERENCES `skema_abdimas` (`id_skema`) ON DELETE NO ACTION,
  CONSTRAINT `relasi_status_abdimas` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of abdimas
-- ----------------------------
INSERT INTO `abdimas` VALUES ('1', 'Community Service Green Organization in Legok Midar Ciparay', 'SDN 1 Legok Midar', 'Peserta paket C (120 peserta)', 'Bu Nenden', 'Ketua Yayasan', '2', '2019-07-25', '2019-07-31', '3400000.00', '1000000.00', '2019-07-23', '3', '14780013', '2019-07-23', null, '2019', '11_proposal.pdf', '11_laporan_antara.pdf', '11_laporan_akhir_fix.pdf');

-- ----------------------------
-- Table structure for anggota_peneliti
-- ----------------------------
DROP TABLE IF EXISTS `anggota_peneliti`;
CREATE TABLE `anggota_peneliti` (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `id_penelitian` int(11) DEFAULT NULL,
  `nip` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_anggota`),
  KEY `fk_nip_anggotapnt` (`nip`),
  KEY `fk_penelitian_anggotapnt` (`id_penelitian`),
  CONSTRAINT `fk_nip_anggotapnt` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`) ON DELETE SET NULL,
  CONSTRAINT `fk_penelitian_anggotapnt` FOREIGN KEY (`id_penelitian`) REFERENCES `penelitian` (`id_penelitian`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of anggota_peneliti
-- ----------------------------
INSERT INTO `anggota_peneliti` VALUES ('9', '9', '2770066');

-- ----------------------------
-- Table structure for angka_kredit
-- ----------------------------
DROP TABLE IF EXISTS `angka_kredit`;
CREATE TABLE `angka_kredit` (
  `id_pedoman_pak` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `kegiatan` varchar(255) DEFAULT NULL,
  `kode_pak` varchar(50) DEFAULT NULL,
  `angka_kredit` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_pedoman_pak`),
  KEY `relasi_id_kategori` (`id_kategori`),
  CONSTRAINT `relasi_id_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_pak` (`id_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of angka_kredit
-- ----------------------------
INSERT INTO `angka_kredit` VALUES ('1', '1', 'Mengikuti pendidikan formal doktor / sederajat', 'I.A.1.a', '200.00');
INSERT INTO `angka_kredit` VALUES ('2', '1', 'Mengikuti pendidikan formal magister / sederajat', 'I.A.1.b', '150.00');
INSERT INTO `angka_kredit` VALUES ('3', '1', 'Mengikuti diklat prajabatan golongan III', 'I.A.2', '3.00');
INSERT INTO `angka_kredit` VALUES ('4', '1', 'Asisten ahli dengan beban mengajar 10 sks pertama', 'II.A.1.a', '0.50');
INSERT INTO `angka_kredit` VALUES ('6', '1', 'Lektor / Lektor Kepala / Profesor dengan beban mengajar 10 sks pertama', 'II.A.2.a', '1.00');
INSERT INTO `angka_kredit` VALUES ('7', '1', 'Lektor / Lektor Kepala / Profesor dengan beban mengajar 2 sks berikutnya', 'II.A.2.b', '0.50');
INSERT INTO `angka_kredit` VALUES ('8', '1', 'Melakukan pengajaran untuk peserta pendidikan dokter melalui tindakan medik spesialistik', 'II.A.3.a', '4.00');
INSERT INTO `angka_kredit` VALUES ('9', '1', 'Melakukan pengajaran konsultasi spesialis kepada peserta pendidikan dokter', 'II.A.3.b', '2.00');
INSERT INTO `angka_kredit` VALUES ('10', '1', 'Melakukan pemeriksaan luar dengan pembimbingan terhadap peserta pendidikan dokter', 'II.A.3.c', '2.00');
INSERT INTO `angka_kredit` VALUES ('11', '1', 'Melakukan pemeriksaan dalam dengan pembimbingan terhadap peserta pendidikan dokter', 'II.A.3.d', '3.00');
INSERT INTO `angka_kredit` VALUES ('12', '1', 'Menjadi saksi ahli dengan pembimingan terhadap peserta pendidikan dokter', 'II.A.3.e', '1.00');
INSERT INTO `angka_kredit` VALUES ('13', '1', 'Membimbing seminar mahasiswa (setiap mahasiswa)', 'II.B', '1.00');
INSERT INTO `angka_kredit` VALUES ('14', '1', 'Membimbing KKN, Praktik Kerja Nyata, Praktik Kerja Lapangan (setiap semester)', 'II.C', '1.00');
INSERT INTO `angka_kredit` VALUES ('15', '1', 'Pembimbing utama Disertasi (setiap mahasiswa)', 'II.D.1.a', '8.00');
INSERT INTO `angka_kredit` VALUES ('16', '1', 'Pembimbing utama Tesis (setiap mahasiswa)', 'II.D.1.b', '3.00');
INSERT INTO `angka_kredit` VALUES ('17', '1', 'Pembimbing utama Skripsi (setiap mahasiswa)', 'II.D.1.c', '1.00');
INSERT INTO `angka_kredit` VALUES ('18', '1', 'Pembimbing utama Laporan Akhir Studi (setiap mahasiswa)', 'II.D.1.d', '1.00');
INSERT INTO `angka_kredit` VALUES ('19', '1', 'Pembimbing pendamping/pembantu Disertasi (setiap mahasiswa)', 'II.D.2.a', '6.00');
INSERT INTO `angka_kredit` VALUES ('20', '1', 'Pembimbing pendamping/pembantu Tesis (setiap mahasiswa)', 'II.D.2.b', '2.00');
INSERT INTO `angka_kredit` VALUES ('21', '1', 'Pembimbing pendamping/pembantu Skripsi (setiap mahasiswa)', 'II.D.2.c', '0.50');
INSERT INTO `angka_kredit` VALUES ('22', '1', 'Pembimbing pendamping/pembantu Laporan Akhir Studi (setiap mahasiswa)', 'II.D.2.d', '0.50');
INSERT INTO `angka_kredit` VALUES ('23', '1', 'Ketua penguji ujian akhir/profesi (setiap mahasiswa)', 'II.E.1', '1.00');
INSERT INTO `angka_kredit` VALUES ('24', '1', 'Anggota penguji ujian akhir/profesi (setiap mahasiswa)', 'II.E.2', '0.50');
INSERT INTO `angka_kredit` VALUES ('25', '1', 'Membina kegiatan mahasiswa di bidang akademik dan kemahasiswaan termasuk membimbing mahasiswa menghasilkan produk saintifik (setiap semester)', 'II.F', '2.00');
INSERT INTO `angka_kredit` VALUES ('26', '1', 'Mengembangkan program kuliah yang mempunyai nilai kebaharuan metode atau substansi (setiap produk)', 'II.G', '2.00');
INSERT INTO `angka_kredit` VALUES ('27', '1', 'Mengembangkan Buku Ajar yang mempunyai nilai kebaharuan (setiap produk)', 'II.H.1', '20.00');
INSERT INTO `angka_kredit` VALUES ('28', '1', 'Mengembangkan Diktat, Modul, Petunjuk Praktikum, Model, Alat bantu, Audio visual, Naskah Tutorial, Jom sheet praktikum terkait mata kuliah yang diampu', 'II.H.2', '5.00');
INSERT INTO `angka_kredit` VALUES ('29', '1', 'Menyampaikan orasi ilmiah di tingkat perguruan tinggi', 'II.I', '5.00');
INSERT INTO `angka_kredit` VALUES ('30', '1', 'Menduduki jabatan pimpinan perguruan tinggi (Rektor)', 'II.J.1', '6.00');
INSERT INTO `angka_kredit` VALUES ('31', '1', 'Menduduki jabatan pimpinan perguruan tinggi (Wakil rektor / dekan / direktur program pasca sarjana / ketua lembaga)', 'II.J.2', '5.00');
INSERT INTO `angka_kredit` VALUES ('32', '1', 'Menduduki jabatan pimpinan perguruan tinggi (Ketua sekolah tinggi / pembantu dekan / asisten direktur program pasca sarjana / direktur politeknik / koordinator kopertis)', 'II.J.3', '4.00');
INSERT INTO `angka_kredit` VALUES ('33', '1', 'Menduduki jabatan pimpinan perguruan tinggi (Pembantu ketua sekolah tinggi / pembantu direktur politeknik)', 'II.J.4', '4.00');
INSERT INTO `angka_kredit` VALUES ('34', '1', 'Menduduki jabatan pimpinan perguruan tinggi (Direktur akademi)', 'II.J.5', '4.00');
INSERT INTO `angka_kredit` VALUES ('35', '1', 'Menduduki jabatan pimpinan perguruan tinggi (Pembantu direktur politeknik, ketua jurusan / bagian pada universitas / institut / sekolah tinggi)', 'II.J.6', '3.00');
INSERT INTO `angka_kredit` VALUES ('36', '1', 'Menduduki jabatan pimpinan perguruan tinggi (Pembantu direktur akademi / ketua jurusan / ketua prodi, Sekretaris', 'II.J.7', '3.00');
INSERT INTO `angka_kredit` VALUES ('37', '1', 'Menduduki jabatan pimpinan perguruan tinggi (Sekretaris jurusan dan kepala laboratorium (bengkel)', 'II.J.8', '3.00');
INSERT INTO `angka_kredit` VALUES ('38', '1', 'Melaksanakan kegiatan datasering di luar institusi tempat bekerja setiap semester (bagi dosen Lektor kepala ke atas)', 'II.L.1', '5.00');
INSERT INTO `angka_kredit` VALUES ('39', '1', 'Melaksanakan kegiatan pencangkokan di luat institusi tempat bekerja setiap semester (bagi dosen Lektor kepala ke atas)', 'II.L.1', '4.00');
INSERT INTO `angka_kredit` VALUES ('40', '1', 'Melaksanakan pengembangan diri untuk meningkatkan kompetensi ( >960 jam)', 'II.M.1', '15.00');
INSERT INTO `angka_kredit` VALUES ('41', '1', 'Melaksanakan pengembangan diri untuk meningkatkan kompetensi (641-960 jam)', 'II.M.2', '9.00');
INSERT INTO `angka_kredit` VALUES ('42', '1', 'Melaksanakan pengembangan diri untuk meningkatkan kompetensi (481-640 jam)', 'II.M.3', '6.00');
INSERT INTO `angka_kredit` VALUES ('43', '1', 'Melaksanakan pengembangan diri untuk meningkatkan kompetensi (161-480 jam)', 'II.M.4', '3.00');
INSERT INTO `angka_kredit` VALUES ('44', '1', 'Melaksanakan pengembangan diri untuk meningkatkan kompetensi (81-160 jam)', 'II.M.5', '2.00');
INSERT INTO `angka_kredit` VALUES ('45', '1', 'Melaksanakan pengembangan diri untuk meningkatkan kompetensi (30-80 jam)', 'II.M.6', '1.00');
INSERT INTO `angka_kredit` VALUES ('46', '1', 'Melaksanakan pengembangan diri untuk meningkatkan kompetensi (10-30 jam)', 'II.M.7', '0.50');
INSERT INTO `angka_kredit` VALUES ('47', '2', 'Hasil penelitian atau hasil pemikiran yang dipublikasikan dalam bentuk buku referensi', 'II.A.1.a.2', '40.00');
INSERT INTO `angka_kredit` VALUES ('48', '2', 'Hasil penelitian atau hasil pemikiran yang dipublikasikan dalam bentuk monograf', 'II.A.1.a.1', '20.00');
INSERT INTO `angka_kredit` VALUES ('49', '2', 'Hasil penelitian atau hasil pemikiran dalam buku yang dipublikasikan dan berisi berbagai tuilsan dari berbagai penulis (Internasional)', 'II.A.1.a.2.1', '15.00');
INSERT INTO `angka_kredit` VALUES ('50', '2', 'Hasil penelitian atau hasil pemikiran dalam buku yang dipublikasikan dan berisi berbagai tulisan dari berbagai penulis (Nasional)', 'II.A.1.a.2.2', '10.00');
INSERT INTO `angka_kredit` VALUES ('51', '2', 'Jurnal internasional bereputasi (terindeks pada database internasional bereputasi dan berfaktor dampak)', 'II.A.1.b.1.1', '40.00');
INSERT INTO `angka_kredit` VALUES ('52', '2', 'Jurnal internasional terindeks pada database internasional bereputasi', 'II.A.1.b.1.2', '30.00');
INSERT INTO `angka_kredit` VALUES ('53', '2', 'Jurnal internasional terindeks pada database internasional di luar kategori 2', 'II.A.1.b.1.3', '20.00');
INSERT INTO `angka_kredit` VALUES ('54', '2', 'Jurnal Nasional terakreditasi', 'II.A.1.b.2', '25.00');
INSERT INTO `angka_kredit` VALUES ('55', '2', 'Jurnal Nasional berbahasa Indonesia terindeks pada DOAJ', 'II.A.1.b.2.1', '15.00');
INSERT INTO `angka_kredit` VALUES ('56', '2', 'Jurnal Nasional berbahasa Inggris atau bahasa resmi (PBB) terindeks pada DOAJ', 'II.A.1.b.2.1', '20.00');
INSERT INTO `angka_kredit` VALUES ('57', '2', 'Jurnal Nasional', 'II.A.1.b.3', '10.00');
INSERT INTO `angka_kredit` VALUES ('58', '2', 'Jurnal ilmiah yang ditulis dalam Bahasa Resmi PBB namun tidak memenuhi syarat-syarat sebagai jurnal ilmiah internasional', 'II.A.1.b.3.1', '10.00');
INSERT INTO `angka_kredit` VALUES ('59', '2', 'Hasil penelitian atau pemikiran dipresentasikan secara oral dan dimuat dalam prosiding yang dipublikasikan ber ISSN/ISBN (Internasional)', 'II.A.1.c.1.a.1', '15.00');
INSERT INTO `angka_kredit` VALUES ('60', '2', 'Hasil penelitian atau pemikiran dipresentasikan secara oral dan dimuat dalam prosiding yang dipublikasikan ber ISSN/ISBN (Nasional)', 'II.A.1.c.1.b.1', '10.00');
INSERT INTO `angka_kredit` VALUES ('61', '2', 'Hasil penelitian atau pemikiran disajikan dalam bentuk poster dan dimuat dalam prosiding yang dipublikasikan (Internasional)', 'II.A.1.c.2.a', '10.00');
INSERT INTO `angka_kredit` VALUES ('62', '2', 'Hasil penelitian atau pemikiran disajikan dalam bentuk poster dan dimuat dalam prosiding yang dipublikasikan (Nasional)', 'II.A.1.c.2.b', '5.00');
INSERT INTO `angka_kredit` VALUES ('63', '2', 'Hasil penelitian atau pemikiran disajikan dalam seminar / simposium / lokakarya, tetapi tidak dimuat dalam prosiding yang dipublikasikan (Internasional)', 'II.A.1.c.1.a', '5.00');
INSERT INTO `angka_kredit` VALUES ('64', '2', 'Hasil penelitian atau pemikiran disajikan dalam seminar / simposium / lokakarya, tetapi tidak dimuar dalam prosiding yang dipublikasikan (Nasional)', 'II.A.1.c.1.b', '3.00');
INSERT INTO `angka_kredit` VALUES ('65', '2', 'Hasil penelitian/pemikiran yang tidak disajikan dalam seminar / simposium / lokakarya, tetapi dimuat dalam prosiding (Internasional)', 'II.A.1.c.3.a', '10.00');
INSERT INTO `angka_kredit` VALUES ('66', '2', 'Hasil penelitian/pemikiran yang tidak disajikan dalam seminat / simposium / lokakarya, tetapi dimuat dalam prosiding (Nasional)', 'II.A.1.c.3.b', '5.00');
INSERT INTO `angka_kredit` VALUES ('67', '2', 'Hasil penelitian/pemikitan yang disajikan dalam koran/majalah populer/umum', 'II.A.1.d', '1.00');
INSERT INTO `angka_kredit` VALUES ('68', '2', 'Hasil penelitian atau pemikiran atau kerjasama industri yang tidak dipublikasikan (tersimpan dalam perpustakaan)', 'II.A.2', '2.00');
INSERT INTO `angka_kredit` VALUES ('69', '2', 'Menerjemahkan/menyadur buku ilmiah yang diterbitkan (ber ISBN)', 'II.B', '15.00');
INSERT INTO `angka_kredit` VALUES ('70', '2', 'Mengedit/menyunting karya ilmiah dalam bentuk buku yang diterbitkan (ber ISBN)', 'II.C', '10.00');
INSERT INTO `angka_kredit` VALUES ('71', '2', 'Membuat rancangan dan karya teknologi/seni yang dipatenkan secara Internasional (paling sedikit diakui oleh 4 negara)', 'II.D.1', '60.00');
INSERT INTO `angka_kredit` VALUES ('72', '2', 'Membuat rancangan dan karya teknologi/seni yang dipatenkan secara Nasional', 'II.D.2', '40.00');
INSERT INTO `angka_kredit` VALUES ('73', '2', 'Membuat rancangan dan karya teknologi yang tidak dipatenkan; rancangan dan karya seni monumetal/sei pertunjukan; karya sastra (Tingkat Internasional)', 'II.E.1', '20.00');
INSERT INTO `angka_kredit` VALUES ('74', '2', 'Membuat rancangan dan karya teknologi yang tidak dipatenkan; rancangan dan karya seni monumetal/sei pertunjukan; karya sastra (Tingkat Nasional)', 'II.E.2', '15.00');
INSERT INTO `angka_kredit` VALUES ('75', '2', 'Membuat rancangan dan karya teknologi yang tidak dipatenkan; rancangan dan karya seni monumetal/sei pertunjukan; karya sastra (Tingkat Lokal)', 'II.E.3', '10.00');
INSERT INTO `angka_kredit` VALUES ('76', '3', 'Menduduki jabatan pimpinan pada lembaga pemerintahan/pejabat negara yang harus dibebaskan dari jabatan organiknya tiap semester', 'III.A', '5.50');
INSERT INTO `angka_kredit` VALUES ('77', '3', 'Melaksanakan pengembangan hasil pendidikan, dan penelitian yang dapat dimanfaatkan oleh masyarakat / industri setiap program', 'III.B', '3.00');
INSERT INTO `angka_kredit` VALUES ('78', '3', 'Memberikan latihan / penyuluhan / penataran / ceramah pada masyarakat dalam satu semester atau lebih (Tingkat internasional tiap program)', 'III.C', '4.00');
INSERT INTO `angka_kredit` VALUES ('79', '3', 'Memberikan latihan / penyuluhan / penataran / ceramah pada masyarakat dalam satu semester atau lebih (Tingkat Nasional tiap program)', 'III.D', '3.00');
INSERT INTO `angka_kredit` VALUES ('80', '3', 'Memberikan latihan / penyuluhan / penataran / ceramah pada masyarakat dalam satu semester atau lebih (Tingkat Lokal tiap program)', 'III.E', '2.00');
INSERT INTO `angka_kredit` VALUES ('81', '3', 'Memberikan latihan / penyuluhan / penataran / ceramah pada masyarakat kurang dari satu semester dan minimal 1 bulan (Tingkat Nasional tiap program)', 'III.F', '3.00');
INSERT INTO `angka_kredit` VALUES ('82', '3', 'Memberikan latihan / penyuluhan / penataran / ceramah pada masyarakat kurang dari satu semester dan minimal 1 bulan (Tingkat Nasional tiap program)', 'III.G', '2.00');
INSERT INTO `angka_kredit` VALUES ('83', '3', 'Memberikan latihan / penyuluhan / penataran / ceramah pada masyarakat kurang dari satu semester dan minimal 1 bulan (Tingkat Lokal tiap program)', 'III.H', '1.00');
INSERT INTO `angka_kredit` VALUES ('84', '3', 'Memberikan latihan / penyuluhan / penataran / ceramah pada masyarakat kurang dari satu semester dan minimal 1 bulan (Insidental, tiap kegiatan/program)', 'III.I', '1.00');
INSERT INTO `angka_kredit` VALUES ('85', '3', 'Memberi pelayanan kepada masyarakat atau kegiatan lain yang menunjang pelaksanaan tugas pemerintahan dan pembangunan (berdasarkan bidang keahlian)', 'III.J', '1.50');
INSERT INTO `angka_kredit` VALUES ('86', '3', 'Memberi pelayanan kepada masyarakat atau kegiatan lain yang menunjang pelaksanaan tugas pemerintahan dan pembangunan (berdasarkan penugasan lembaga perguruan tinggi)', 'III.K', '1.00');
INSERT INTO `angka_kredit` VALUES ('87', '3', 'Memberi pelayanan kepada masyarakat atau kegiatan lain yang menunjang pelaksanaan tugas pemerintahan dan pembangunan (berdasarkan fungsi / jabatan)', 'III.L', '0.50');
INSERT INTO `angka_kredit` VALUES ('88', '3', 'Membuat / menulis karya pengabdian pada masyarakat yang tidak dipublikasikan', 'III.M', '3.00');
INSERT INTO `angka_kredit` VALUES ('89', '4', 'Menjadi anggota dalam suatu Panitia/Badan pada Perguruan Tinggi (Sebagai Ketua / Wakil Ketua merangkap anggota)', null, '3.00');
INSERT INTO `angka_kredit` VALUES ('90', '4', 'Menjadi anggota dalam suatu Panitia/Badan pada Perguruan Tinggi (Sebagai Anggota)', null, '2.00');
INSERT INTO `angka_kredit` VALUES ('91', '4', 'Menjadi anggota panitia/badan pada lembaga pemerintah pusat (Ketua / Wakil)', null, '3.00');
INSERT INTO `angka_kredit` VALUES ('92', '4', 'Menjadi anggota panitia/badan pada lembaga pemerintah pusat (anggota)', null, '2.00');
INSERT INTO `angka_kredit` VALUES ('93', '4', 'Menjadi anggota panitia/badan pada lembaga pemerintah daerah (Ketua/Wakil)', null, '2.00');
INSERT INTO `angka_kredit` VALUES ('94', '4', 'Menjadi anggota panitia/badan pada lembaga pemerintah daerah (anggota)', null, '1.00');
INSERT INTO `angka_kredit` VALUES ('95', '4', 'Menjadi anggota organisasi profesi tingkat internasional (Pengurus)', null, '2.00');
INSERT INTO `angka_kredit` VALUES ('96', '4', 'Menjadi anggota organisasi profesi tingkat internasional (Anggota atas permintaan)', null, '1.00');
INSERT INTO `angka_kredit` VALUES ('97', '4', 'Menjadi anggota organisasi profesi tingkat internasional (Anggota)', null, '0.50');
INSERT INTO `angka_kredit` VALUES ('98', '4', 'Menjadi anggota organisasi profesi tingkat nasional (Pengurus)', null, '1.50');
INSERT INTO `angka_kredit` VALUES ('99', '4', 'Menjadi anggota organisasi profesi tingkat nasional (Anggota atas permintaan)', null, '1.00');
INSERT INTO `angka_kredit` VALUES ('100', '4', 'Menjadi anggota organisasi profesi tingkat nasional (Anggota)', null, '0.50');
INSERT INTO `angka_kredit` VALUES ('101', '4', 'Mewakili Perguruan Tinggi/Lebaga Pemerintah duduk dalam Panitia antar Lembaga, tiap kepanitiaan', null, '1.00');
INSERT INTO `angka_kredit` VALUES ('102', '4', 'Menjadi anggota delegasi Nasional ke pertemuan Internasional (Sebagai ketua delegasi)', null, '3.00');
INSERT INTO `angka_kredit` VALUES ('103', '4', 'Menjadi anggota delegasi Nasional ke pertemuan Internasional (Sebagai anggota)', null, '2.00');
INSERT INTO `angka_kredit` VALUES ('104', '4', 'Berperan serta aktif dalam pengelolaan jurnal ilmiah sebagai Editor / dewan penyunting / dewan redaksi jurnal ilmiah internasional', null, '4.00');
INSERT INTO `angka_kredit` VALUES ('105', '4', 'Berperan serta aktif dalam pengelolaan jurnal ilmiah sebagai Editor / dewan penyunting / dewan redaksi jurnal ilmiah nasional', null, '2.00');
INSERT INTO `angka_kredit` VALUES ('106', '4', 'Berperan serta aktif dalam pertemuan ilmiah tingkat Internasional / Nasional / Regional (Sebagai Ketua)', null, '3.00');
INSERT INTO `angka_kredit` VALUES ('107', '4', 'Berperan serta aktif dalam pertemuan ilmiah tingkat Internasional / Nasional / Regional (Sebagai anggota)', null, '2.00');
INSERT INTO `angka_kredit` VALUES ('108', '4', 'Berperan serta aktif dalam pertemuan ilmiah di lingkungan perguruan tinggi (Sebagai Ketua)', null, '2.00');
INSERT INTO `angka_kredit` VALUES ('109', '4', 'Berperan serta aktif dalam pertemuan ilmiah di lingkungan perguruan tinggi (Sebagai Anggota)', null, '1.00');
INSERT INTO `angka_kredit` VALUES ('110', '4', 'Mendapat tanda jasa / penghargaan Satya Lencana 30 tahun', null, '3.00');
INSERT INTO `angka_kredit` VALUES ('111', '4', 'Mendapat tanda jasa / penghargaan Satya Lencana 20 tahun', null, '2.00');
INSERT INTO `angka_kredit` VALUES ('112', '4', 'Mendapat tanda jasa / penghargaan Satya Lencana 10 tahun', null, '1.00');
INSERT INTO `angka_kredit` VALUES ('113', '4', 'Mendapat tanda jasa / penghargaan tingkat internasional', null, '5.00');
INSERT INTO `angka_kredit` VALUES ('114', '4', 'Mendapat tanda jasa / penghargaan tingkat nasional', null, '3.00');
INSERT INTO `angka_kredit` VALUES ('115', '4', 'Mendapat tanda jasa / penghargaan tingkat daerah/lokal', null, '1.00');
INSERT INTO `angka_kredit` VALUES ('116', '4', 'Menulis buku pelajaran SLTA ke bawah yang diterbitkan dan diedarkan secara nasional (Buku SMTA atau setingkat)', null, '5.00');
INSERT INTO `angka_kredit` VALUES ('117', '4', 'Menulis buku pelajaran SLTA ke bawah yang diterbitkan dan diedarkan secara nasional (Buku SMTP atau setingkat)', null, '5.00');
INSERT INTO `angka_kredit` VALUES ('118', '4', 'Menulis buku pelajaran SLTA ke bawah yang diterbitkan dan diedarkan secara nasional (Buku SD atau setingkat)', null, '5.00');
INSERT INTO `angka_kredit` VALUES ('119', '4', 'Mempunyai prestasi di bidang olahraga / humaniora (Tingkat Internasional)', null, '5.00');
INSERT INTO `angka_kredit` VALUES ('120', '4', 'Mempunyai prestasi di bidang olahraga / humaniora (Tingkat Nasional)', null, '3.00');
INSERT INTO `angka_kredit` VALUES ('121', '4', 'Mempunyai prestasi di bidang olahraga / humaniora (Tingkat Daerah)', null, '1.00');
INSERT INTO `angka_kredit` VALUES ('122', '4', 'Keanggotaan dalam tim penilaian jabatan akademik dosen', null, '1.00');
INSERT INTO `angka_kredit` VALUES ('128', '1', 'Belajar di PAUD', '2A', '10.00');

-- ----------------------------
-- Table structure for barang
-- ----------------------------
DROP TABLE IF EXISTS `barang`;
CREATE TABLE `barang` (
  `id_inventaris` int(255) NOT NULL AUTO_INCREMENT,
  `nomor_inventaris` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `seri` varchar(100) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `jumlah_barang` bigint(25) NOT NULL,
  `id_laboratorium` int(25) NOT NULL,
  `id_kondisi` int(25) NOT NULL,
  `id_status` int(25) NOT NULL,
  PRIMARY KEY (`id_inventaris`),
  KEY `relasi_lab_barang` (`id_laboratorium`),
  KEY `relasi_kondisi_barang` (`id_kondisi`),
  KEY `relasi_status_barang` (`id_status`),
  CONSTRAINT `relasi_kondisi_barang` FOREIGN KEY (`id_kondisi`) REFERENCES `kondisi_barang` (`id_kondisi`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `relasi_lab_barang` FOREIGN KEY (`id_laboratorium`) REFERENCES `laboratorium` (`id_laboratorium`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `relasi_status_barang` FOREIGN KEY (`id_status`) REFERENCES `status_barang` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of barang
-- ----------------------------
INSERT INTO `barang` VALUES ('3', '1103154118', 'Laptop', 'Lenovo', 'GX-8989', '2019-07-02', '2', '2', '6', '1');

-- ----------------------------
-- Table structure for bidang
-- ----------------------------
DROP TABLE IF EXISTS `bidang`;
CREATE TABLE `bidang` (
  `id_bidang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bidang` varchar(100) NOT NULL,
  PRIMARY KEY (`id_bidang`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bidang
-- ----------------------------
INSERT INTO `bidang` VALUES ('1', 'Software Engineering');
INSERT INTO `bidang` VALUES ('2', 'Kecerdasan Buatan');
INSERT INTO `bidang` VALUES ('4', 'Embeded System');

-- ----------------------------
-- Table structure for bimbingan
-- ----------------------------
DROP TABLE IF EXISTS `bimbingan`;
CREATE TABLE `bimbingan` (
  `id_bimbingan` int(11) NOT NULL AUTO_INCREMENT,
  `nim` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `catatan` varchar(200) NOT NULL,
  `idta` int(11) NOT NULL,
  `nip` int(11) NOT NULL,
  PRIMARY KEY (`id_bimbingan`),
  KEY `relasi_nim_bimbingan` (`nim`),
  KEY `relasi_ta_bimbingan` (`idta`),
  KEY `relasi_nip_bimbingan` (`nip`),
  CONSTRAINT `relasi_nim_bimbingan` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `relasi_nip_bimbingan` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `relasi_ta_bimbingan` FOREIGN KEY (`idta`) REFERENCES `t_topik` (`idta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bimbingan
-- ----------------------------
INSERT INTO `bimbingan` VALUES ('1', '1103150004', '2019-07-09', 'Pertemuan Pertama Target Bikin Halaman Awal Disertai CSV Upload', '2', '14780013');

-- ----------------------------
-- Table structure for dosen
-- ----------------------------
DROP TABLE IF EXISTS `dosen`;
CREATE TABLE `dosen` (
  `nip` int(11) NOT NULL,
  `nidn` int(11) DEFAULT NULL,
  `nama_awal` varchar(100) NOT NULL,
  `nama_akhir` varchar(100) NOT NULL,
  `kode_dosen` varchar(4) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `jenis_kelamin` varchar(15) DEFAULT NULL,
  `telp` varchar(15) NOT NULL,
  `blog` varchar(255) DEFAULT NULL,
  `id_bidang` int(1) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pembimbing` int(11) DEFAULT NULL,
  `kuota` double(19,0) DEFAULT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `jab_struktural` varchar(255) DEFAULT NULL,
  `jab_pangkat` varchar(100) DEFAULT NULL,
  `jab_golongan` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`nip`),
  KEY `relasi_id_bidang` (`id_bidang`),
  KEY `fk_jabatan` (`id_jabatan`),
  CONSTRAINT `fk_bidang` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id_bidang`) ON DELETE SET NULL ON UPDATE NO ACTION,
  CONSTRAINT `fk_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE SET NULL ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dosen
-- ----------------------------
INSERT INTO `dosen` VALUES ('1', null, '', 'Administrator', null, null, null, '', null, null, 'admin', '21232f297a57a5a743894a0e4a801fc3', '', null, null, null, null, null, null);
INSERT INTO `dosen` VALUES ('123', '123', 'teh', 'ayu', null, 'telkom', 'perempuan', '08122222', null, null, 'ayu', '29c65f781a1068a41f735e1b092546de', '', null, null, null, null, null, null);
INSERT INTO `dosen` VALUES ('2770066', '409127701', 'Yudha', 'Purwanto', 'YDP', 'Bandung', 'Laki-laki', '', null, '2', 'yudhapw', 'cb3b2c4f90138485521e4d9349d84c66', 'yudhapurwanto@telkomuniversity.ac.id', '1', '19', '1', '', null, null);
INSERT INTO `dosen` VALUES ('7740390', null, 'Angga Rusdinar, S.t., M.T., Ph.D.', '', null, null, null, '', null, null, '', '', '', null, null, null, null, null, null);
INSERT INTO `dosen` VALUES ('7740391', null, 'Dr. Bambang Setia N., S.T., M.T', '', null, null, null, '', null, null, '', '', '', null, null, null, null, null, null);
INSERT INTO `dosen` VALUES ('14780013', '19027809', 'Roswan', 'Latuconsina', 'RLC', '                            Bandung                        ', 'Laki-laki', '0813205056', 'https://roswan.staff.telkomuniversity.ac.id/', '1', 'roswanlc', '684A8E4C1B12654304940AA79B660613', 'roswan@telkomuniversity.ac.id', '2', '19', '1', '', 'Pembina', 'Pembina');
INSERT INTO `dosen` VALUES ('14860078', '411108604', 'Andrew', 'Brian Osmond', 'ABO', 'Bandung', 'Laki-laki', '081802769072', 'https://abosmond.staff.telkomuniversity.ac.id/', '2', 'andrew', 'D914E3ECF6CC481114A3F534A5FAF90B', 'andrew@telkomuniversity.ac.id', '1', '20', '2', 'Bendahara Kelompok Keahlian', 'Penata Muda', 'III/a');

-- ----------------------------
-- Table structure for jabatan
-- ----------------------------
DROP TABLE IF EXISTS `jabatan`;
CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of jabatan
-- ----------------------------
INSERT INTO `jabatan` VALUES ('1', 'Asisten Ahli');
INSERT INTO `jabatan` VALUES ('2', 'Lektor');
INSERT INTO `jabatan` VALUES ('3', 'Lektor Kepala');
INSERT INTO `jabatan` VALUES ('4', 'Profesor');

-- ----------------------------
-- Table structure for kategori_pak
-- ----------------------------
DROP TABLE IF EXISTS `kategori_pak`;
CREATE TABLE `kategori_pak` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kategori_pak
-- ----------------------------
INSERT INTO `kategori_pak` VALUES ('1', 'Pelaksanaan Pendidikan');
INSERT INTO `kategori_pak` VALUES ('2', 'Pelaksanaan Penelitian');
INSERT INTO `kategori_pak` VALUES ('3', 'Pelaksanaan Pengabdian Masyarakat');
INSERT INTO `kategori_pak` VALUES ('4', 'Penunjang');

-- ----------------------------
-- Table structure for kondisi_barang
-- ----------------------------
DROP TABLE IF EXISTS `kondisi_barang`;
CREATE TABLE `kondisi_barang` (
  `id_kondisi` int(25) NOT NULL AUTO_INCREMENT,
  `nama_kondisi` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kondisi`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of kondisi_barang
-- ----------------------------
INSERT INTO `kondisi_barang` VALUES ('4', 'baru');
INSERT INTO `kondisi_barang` VALUES ('6', 'memadai');
INSERT INTO `kondisi_barang` VALUES ('7', 'buruk');

-- ----------------------------
-- Table structure for laboran
-- ----------------------------
DROP TABLE IF EXISTS `laboran`;
CREATE TABLE `laboran` (
  `nip` int(11) NOT NULL,
  `nidn` int(11) NOT NULL,
  `nama_awal` varchar(100) NOT NULL,
  `nama_akhir` varchar(100) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role_id` int(1) NOT NULL,
  PRIMARY KEY (`nip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of laboran
-- ----------------------------
INSERT INTO `laboran` VALUES ('123', '123', 'teh', 'ayu', 'telkom', 'perempuan', '08122222', 'ayu', '29c65f781a1068a41f735e1b092546de', '7');

-- ----------------------------
-- Table structure for laboratorium
-- ----------------------------
DROP TABLE IF EXISTS `laboratorium`;
CREATE TABLE `laboratorium` (
  `id_laboratorium` int(11) NOT NULL,
  `nama_laboratorium` varchar(100) NOT NULL,
  `nama_kordas` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  PRIMARY KEY (`id_laboratorium`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of laboratorium
-- ----------------------------
INSERT INTO `laboratorium` VALUES ('1', 'EvConn', 'Yusuf', 'evconn', '00ab5a99d9a40930d50caa9cfb406cf4', '8');
INSERT INTO `laboratorium` VALUES ('2', 'RnEST', 'Lili', 'rnest', 'c8e285fe2fac819017c0d9b958af6b19', '8');

-- ----------------------------
-- Table structure for luaran_penelitian
-- ----------------------------
DROP TABLE IF EXISTS `luaran_penelitian`;
CREATE TABLE `luaran_penelitian` (
  `id_luaran` int(11) NOT NULL AUTO_INCREMENT,
  `luaran` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_luaran`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of luaran_penelitian
-- ----------------------------
INSERT INTO `luaran_penelitian` VALUES ('1', 'Jurnal Internasional');
INSERT INTO `luaran_penelitian` VALUES ('2', 'Prosiding Internasional');
INSERT INTO `luaran_penelitian` VALUES ('3', 'Buku');
INSERT INTO `luaran_penelitian` VALUES ('4', 'Teknologi Tepat Guna');
INSERT INTO `luaran_penelitian` VALUES ('5', 'Rekayasa Sosial');
INSERT INTO `luaran_penelitian` VALUES ('6', 'HKI - Paten');
INSERT INTO `luaran_penelitian` VALUES ('7', 'Prototipe');
INSERT INTO `luaran_penelitian` VALUES ('8', 'Makalah Ilmiah');
INSERT INTO `luaran_penelitian` VALUES ('9', 'Jurnal');

-- ----------------------------
-- Table structure for mahasiswa
-- ----------------------------
DROP TABLE IF EXISTS `mahasiswa`;
CREATE TABLE `mahasiswa` (
  `nim` int(11) NOT NULL,
  `nama_awal` varchar(255) DEFAULT NULL,
  `nama_akhir` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `tak` int(11) DEFAULT NULL,
  `id_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of mahasiswa
-- ----------------------------
INSERT INTO `mahasiswa` VALUES ('1103150003', 'Aina Rosyda', 'Syamila', 'ainars@gmail.com', 'ainars', 'CC8EC603AD7AEE226EE0425FBD9031C8', '60', '6');
INSERT INTO `mahasiswa` VALUES ('1103150004', 'Fajri', 'Rahmat Said', 'fajri@gmai.com', 'fajri', '437EB04136C59D226F14527F52726341', '80', '8');

-- ----------------------------
-- Table structure for notification
-- ----------------------------
DROP TABLE IF EXISTS `notification`;
CREATE TABLE `notification` (
  `id_notification` int(11) NOT NULL AUTO_INCREMENT,
  `nip` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '0' COMMENT '0 = belum dibaca, 1 sudah dibaca',
  `created_date` datetime DEFAULT NULL,
  `id_abdimas` int(11) DEFAULT NULL,
  `id_penelitian` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_notification`),
  KEY `fk_nip_notif` (`nip`),
  KEY `fk_abdimas_notif` (`id_abdimas`),
  KEY `fk_penelitian_notif` (`id_penelitian`),
  CONSTRAINT `fk_abdimas_notif` FOREIGN KEY (`id_abdimas`) REFERENCES `abdimas` (`id_abdimas`) ON DELETE CASCADE,
  CONSTRAINT `fk_nip_notif` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`) ON DELETE NO ACTION,
  CONSTRAINT `fk_penelitian_notif` FOREIGN KEY (`id_penelitian`) REFERENCES `penelitian` (`id_penelitian`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of notification
-- ----------------------------
INSERT INTO `notification` VALUES ('38', '14780013', '1', '2019-07-23 18:30:00', null, '9');
INSERT INTO `notification` VALUES ('39', '14780013', '1', '2019-07-23 19:53:21', '1', null);

-- ----------------------------
-- Table structure for pak
-- ----------------------------
DROP TABLE IF EXISTS `pak`;
CREATE TABLE `pak` (
  `id_pak` int(11) NOT NULL AUTO_INCREMENT,
  `nip` int(11) NOT NULL,
  `id_pedoman_pak` int(11) NOT NULL,
  `id_abdimas` int(11) DEFAULT NULL,
  `id_penelitian` int(11) DEFAULT NULL,
  `nama_kegiatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_pak`),
  KEY `relasi_pedoman_pak` (`id_pedoman_pak`),
  KEY `relasi_nip` (`nip`),
  KEY `relasi_abdimas` (`id_abdimas`),
  KEY `relasi_penelitian` (`id_penelitian`),
  CONSTRAINT `relasi_abdimas` FOREIGN KEY (`id_abdimas`) REFERENCES `abdimas` (`id_abdimas`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `relasi_nip` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `relasi_pedoman_pak` FOREIGN KEY (`id_pedoman_pak`) REFERENCES `angka_kredit` (`id_pedoman_pak`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `relasi_penelitian` FOREIGN KEY (`id_penelitian`) REFERENCES `penelitian` (`id_penelitian`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pak
-- ----------------------------
INSERT INTO `pak` VALUES ('2', '14780013', '47', null, '9', null);
INSERT INTO `pak` VALUES ('4', '14780013', '77', '1', null, null);

-- ----------------------------
-- Table structure for peminjaman
-- ----------------------------
DROP TABLE IF EXISTS `peminjaman`;
CREATE TABLE `peminjaman` (
  `pinjam_id` int(10) NOT NULL AUTO_INCREMENT,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nim` int(11) NOT NULL,
  `id_laboratorium` int(10) NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `file_peminjaman` varchar(255) NOT NULL,
  `id_status` int(11) NOT NULL,
  PRIMARY KEY (`pinjam_id`),
  KEY `relasi_lab_peminjaman` (`id_laboratorium`),
  KEY `realasi_status_peminjaman` (`id_status`),
  CONSTRAINT `realasi_status_peminjaman` FOREIGN KEY (`id_status`) REFERENCES `status_pengajuan` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `relasi_lab_peminjaman` FOREIGN KEY (`id_laboratorium`) REFERENCES `laboratorium` (`id_laboratorium`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of peminjaman
-- ----------------------------
INSERT INTO `peminjaman` VALUES ('1', 'Fajri Rahmat Said  ', '1103150004', '1', '2019-07-20', '2019-07-08', 'Permohonan_Sidang_(Daftar_Persyaratan_Sidang)7.pdf', '0');

-- ----------------------------
-- Table structure for penelitian
-- ----------------------------
DROP TABLE IF EXISTS `penelitian`;
CREATE TABLE `penelitian` (
  `id_penelitian` int(11) NOT NULL AUTO_INCREMENT,
  `judul_penelitian` varchar(255) DEFAULT NULL,
  `id_skema` int(11) DEFAULT NULL,
  `mitra_ketua` varchar(255) DEFAULT NULL,
  `mitra_institusi` varchar(255) DEFAULT NULL,
  `jadwal_awal` date DEFAULT NULL,
  `jadwal_akhir` date DEFAULT NULL,
  `dana_internal` decimal(19,2) DEFAULT NULL,
  `dana_luar` decimal(19,2) DEFAULT NULL,
  `id_status` int(11) DEFAULT NULL,
  `nip` int(11) DEFAULT NULL,
  `kode_pak` varchar(50) DEFAULT NULL,
  `tgl_mengajukan` date DEFAULT NULL,
  `tgl_update` date DEFAULT NULL,
  `alasan_tolak` varchar(255) DEFAULT NULL,
  `proposal` varchar(255) DEFAULT NULL,
  `laporan_antara` varchar(255) DEFAULT NULL,
  `laporan_akhir` varchar(255) DEFAULT NULL,
  `thn_anggaran` varchar(5) DEFAULT NULL,
  `bidang_unggulan` varchar(255) DEFAULT NULL,
  `topik_unggulan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_penelitian`),
  KEY `relasi_nip_penelitian` (`nip`),
  KEY `relasi_status_penelitian` (`id_status`),
  KEY `fk_skema` (`id_skema`),
  CONSTRAINT `fk_nip_penelitian` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`) ON DELETE SET NULL,
  CONSTRAINT `fk_skema` FOREIGN KEY (`id_skema`) REFERENCES `skema_penelitian` (`id_skema`) ON DELETE SET NULL,
  CONSTRAINT `fk_status` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of penelitian
-- ----------------------------
INSERT INTO `penelitian` VALUES ('9', 'Penerapan Teknologi Iron Man di Nusakambangan', '2', 'Howard Stark', 'Stark Industries', '2019-07-25', '2019-07-31', '3400000.00', '1000000.00', '3', '14780013', null, '2019-07-23', '2019-07-23', null, '11_proposal.pdf', '11_laporan_antara.pdf', '11_laporan_akhir_fix.pdf', '2019', '', '');
INSERT INTO `penelitian` VALUES ('10', 'Penerapan Metode Support Vector Machine pada pendeteksian Leukoplakia ', '2', 'Howard Stark', 'Stark Industries', '2019-07-25', '2019-07-31', '3400000.00', '1000000.00', '1', '14780013', null, '2019-07-24', '0000-00-00', null, null, null, null, '2020', '', '');

-- ----------------------------
-- Table structure for pengajuan_barang
-- ----------------------------
DROP TABLE IF EXISTS `pengajuan_barang`;
CREATE TABLE `pengajuan_barang` (
  `id_pengajuan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_dosen` varchar(255) NOT NULL,
  `nip` int(11) NOT NULL,
  `id_laboratorium` int(11) NOT NULL,
  `tanggal_pengajuan` date NOT NULL,
  `file` varchar(255) NOT NULL,
  `id_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_pengajuan`),
  KEY `relasi_nip_pengbar` (`nip`),
  KEY `relasi_lab_pengbar` (`id_laboratorium`),
  KEY `relasi_status_pengbar` (`id_status`),
  CONSTRAINT `relasi_lab_pengbar` FOREIGN KEY (`id_laboratorium`) REFERENCES `laboratorium` (`id_laboratorium`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `relasi_nip_pengbar` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `relasi_status_pengbar` FOREIGN KEY (`id_status`) REFERENCES `status_pengajuan` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pengajuan_barang
-- ----------------------------

-- ----------------------------
-- Table structure for pengumuman
-- ----------------------------
DROP TABLE IF EXISTS `pengumuman`;
CREATE TABLE `pengumuman` (
  `id_pengumuman` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(255) DEFAULT NULL,
  `pengumuman` varchar(255) DEFAULT NULL,
  `tgl_dibuat` datetime DEFAULT NULL,
  `nip` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pengumuman`),
  KEY `relasi_nip_pengumuman` (`nip`),
  CONSTRAINT `relasi_nip_pengumuman` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pengumuman
-- ----------------------------
INSERT INTO `pengumuman` VALUES ('5', 'Hasil Putusan Sidang MK Sengketa Pilpres 2019', 'Jika kau lewatkan solat, Allah akan lewatkan kau dari<br>\r\n•Kejayaan<br>\r\n•Rezeki<br>\r\n•Jodoh<br>\r\n•Doa<br>\r\n<br>\r\n<b>Segeralah menunaikan solat dan solatlah di awal waktu.</b>', '2019-06-27 17:56:56', '2770066');
INSERT INTO `pengumuman` VALUES ('9', 'Jumat Berkah', '#JumatBerkah<br>\r\n-Prejenganmu-<br>\r\nGaji meningkat<br>\r\nTeman berganti<br>\r\nLingkungan berubah<br>\r\nGaya hidup mengikuti<br>\r\nTak sanggup berhemat<br>\r\nMenabung apalagi<br>\r\nMall dan butik jadi makanan sehari hari<br>\r\nPengemis hanya dilewati<br>\r\nPengga', '2019-06-28 01:25:28', '2770066');

-- ----------------------------
-- Table structure for publikasi
-- ----------------------------
DROP TABLE IF EXISTS `publikasi`;
CREATE TABLE `publikasi` (
  `id_publikasi` int(11) NOT NULL AUTO_INCREMENT,
  `nip` int(11) DEFAULT NULL,
  `affiliation` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `document_title` varchar(255) DEFAULT NULL,
  `authors` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_publikasi`),
  KEY `fk_nip_publikasi` (`nip`),
  CONSTRAINT `fk_nip_publikasi` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of publikasi
-- ----------------------------
INSERT INTO `publikasi` VALUES ('23', '14780013', 'Telkom University', 'Bandung West Java', 'Design and implementation of smart village mapping geographic information system based web in the cinunuk village ', 'Marlintha, A.B., Irawan, B., Latuconsina, R.', '2018', 'APWiMob 2017 - IEEE Asia Pacific Conference on Wireless and Mobile, Proceedings');
INSERT INTO `publikasi` VALUES ('24', '14780013', 'Telkom University', 'Bandung West Java', 'A review of several algorithms for data mining', 'Aprilia, Y.D., Latuconsina, R., Purboyo, T.W.', '2018', 'Journal of Engineering and Applied Sciences');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `nip` int(11) DEFAULT NULL,
  `nim` int(11) DEFAULT NULL,
  `id_laboratorium` int(11) DEFAULT NULL,
  `user_role_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_role`),
  KEY `fk_user_role_id` (`user_role_id`),
  KEY `fk_nim` (`nim`),
  KEY `fk_nip` (`nip`),
  CONSTRAINT `fk_nim` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE CASCADE,
  CONSTRAINT `fk_nip` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`) ON DELETE CASCADE,
  CONSTRAINT `fk_user_role_id` FOREIGN KEY (`user_role_id`) REFERENCES `user_roles` (`user_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('51', '1', null, null, '4');
INSERT INTO `roles` VALUES ('52', '2770066', null, null, '2');
INSERT INTO `roles` VALUES ('53', '2770066', null, null, '1');
INSERT INTO `roles` VALUES ('54', '14780013', null, null, '2');
INSERT INTO `roles` VALUES ('55', '14860078', null, null, '2');
INSERT INTO `roles` VALUES ('56', null, '1103150003', null, '3');
INSERT INTO `roles` VALUES ('57', null, '1103150004', null, '3');
INSERT INTO `roles` VALUES ('58', '123', null, null, '7');
INSERT INTO `roles` VALUES ('59', '2770066', null, null, '51');
INSERT INTO `roles` VALUES ('60', '14860078', null, null, '80');

-- ----------------------------
-- Table structure for skema_abdimas
-- ----------------------------
DROP TABLE IF EXISTS `skema_abdimas`;
CREATE TABLE `skema_abdimas` (
  `id_skema` int(11) NOT NULL AUTO_INCREMENT,
  `skema` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_skema`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of skema_abdimas
-- ----------------------------
INSERT INTO `skema_abdimas` VALUES ('1', 'Pengabdian Masyarakat Reguler', null);
INSERT INTO `skema_abdimas` VALUES ('2', 'Pengabdian Masyarakat Kolaborasi Internal', null);
INSERT INTO `skema_abdimas` VALUES ('3', 'Pengabdian Masyarakat Kolaborasi Internasional', null);
INSERT INTO `skema_abdimas` VALUES ('4', 'Pengabdian Masyarakat Mandiri', null);
INSERT INTO `skema_abdimas` VALUES ('5', 'Penyuluhan / Pelatihan', null);
INSERT INTO `skema_abdimas` VALUES ('6', 'Layanan Industri, Pemerintahan & Komunitas', null);

-- ----------------------------
-- Table structure for skema_penelitian
-- ----------------------------
DROP TABLE IF EXISTS `skema_penelitian`;
CREATE TABLE `skema_penelitian` (
  `id_skema` int(11) NOT NULL AUTO_INCREMENT,
  `skema` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_skema`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of skema_penelitian
-- ----------------------------
INSERT INTO `skema_penelitian` VALUES ('1', 'Penelitian Kerjasama Internasional', 'Penelitian/inputKerjasamaInter');
INSERT INTO `skema_penelitian` VALUES ('2', 'Penelitian Kemitraan Institusi', 'Penelitian/InputKemitraanInstitusi');
INSERT INTO `skema_penelitian` VALUES ('3', 'Penelitian Pekerti-YPT', 'Penelitian/inputPekertiYPT');
INSERT INTO `skema_penelitian` VALUES ('4', 'Penelitian Dasar Terapan', 'Penelitian/inputDasarTerapan');
INSERT INTO `skema_penelitian` VALUES ('5', 'Penelitian Dana Mandiri', 'Penelitian/inputDanaMandiri');
INSERT INTO `skema_penelitian` VALUES ('6', 'Hilirisasi Penelitian', 'Penelitian/inputHilirisasiPenelitian');
INSERT INTO `skema_penelitian` VALUES ('7', 'Penelitian Unggulan Universitas', 'Penelitian/inputUnggulanUniversitas');

-- ----------------------------
-- Table structure for status
-- ----------------------------
DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(25) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of status
-- ----------------------------
INSERT INTO `status` VALUES ('1', 'Propose (Belum disetujui)');
INSERT INTO `status` VALUES ('2', 'Berjalan');
INSERT INTO `status` VALUES ('3', 'Selesai');
INSERT INTO `status` VALUES ('4', 'Disetujui oleh ketua KK');
INSERT INTO `status` VALUES ('5', 'Ditolak');
INSERT INTO `status` VALUES ('6', 'Pengajuan Topik');
INSERT INTO `status` VALUES ('7', 'Topik Disetujui');
INSERT INTO `status` VALUES ('8', 'Permohonan Pembimbing');
INSERT INTO `status` VALUES ('9', 'Seminar');
INSERT INTO `status` VALUES ('50', 'Proposal');
INSERT INTO `status` VALUES ('51', 'Lulus Seminar');
INSERT INTO `status` VALUES ('52', 'Pengerjaan Judul');
INSERT INTO `status` VALUES ('53', 'Menunggu Persetujuan');
INSERT INTO `status` VALUES ('54', 'Diseminarkan');

-- ----------------------------
-- Table structure for status_barang
-- ----------------------------
DROP TABLE IF EXISTS `status_barang`;
CREATE TABLE `status_barang` (
  `id_status` int(25) NOT NULL,
  `nama_status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of status_barang
-- ----------------------------
INSERT INTO `status_barang` VALUES ('1', 'ada');
INSERT INTO `status_barang` VALUES ('2', 'dipinjam');

-- ----------------------------
-- Table structure for status_pengajuan
-- ----------------------------
DROP TABLE IF EXISTS `status_pengajuan`;
CREATE TABLE `status_pengajuan` (
  `id_status` int(11) NOT NULL,
  `nama_status` varchar(100) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of status_pengajuan
-- ----------------------------
INSERT INTO `status_pengajuan` VALUES ('0', 'propose');
INSERT INTO `status_pengajuan` VALUES ('1', 'setuju');

-- ----------------------------
-- Table structure for t_jadwal
-- ----------------------------
DROP TABLE IF EXISTS `t_jadwal`;
CREATE TABLE `t_jadwal` (
  `idjadwal` int(11) NOT NULL AUTO_INCREMENT,
  `id_judul` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `nama_awal` varchar(200) NOT NULL,
  `nama_akhir` varchar(111) NOT NULL,
  `nim` int(11) NOT NULL,
  `pbb1` varchar(10) NOT NULL,
  `pbb2` varchar(10) NOT NULL,
  `pgj1` varchar(10) NOT NULL,
  `pgj2` varchar(10) NOT NULL,
  `waktuujian` datetime NOT NULL,
  `tempatujian` varchar(20) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `topik` varchar(240) NOT NULL,
  PRIMARY KEY (`idjadwal`),
  KEY `fk_judul_jadwal` (`id_judul`),
  KEY `fk_status_jadwal` (`id_status`),
  KEY `fk_nim_jadwal` (`nim`),
  CONSTRAINT `fk_judul_jadwal` FOREIGN KEY (`id_judul`) REFERENCES `t_judul` (`id_judul`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nim_jadwal` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_status_jadwal` FOREIGN KEY (`id_status`) REFERENCES `status` (`id_status`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_jadwal
-- ----------------------------
INSERT INTO `t_jadwal` VALUES ('10', '60', '51', 'Fajri', 'Rahmat Said', '1103150004', '2770066', '14780013', '14780013', '14860078', '2019-09-09 09:30:00', 'N210', 'METODE X', 'OPTIMASI PADA SISTEM DISTRIBUSI AIR BERSIH DI WILAYAH II UNIVERSITAS TELKOM');

-- ----------------------------
-- Table structure for t_judul
-- ----------------------------
DROP TABLE IF EXISTS `t_judul`;
CREATE TABLE `t_judul` (
  `id_judul` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(50) DEFAULT NULL,
  `nama_awal` varchar(50) DEFAULT NULL,
  `nama_akhir` varchar(100) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `topik` varchar(255) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `pbb1` int(11) DEFAULT NULL,
  `nip` int(11) NOT NULL,
  `pbb2` int(11) DEFAULT NULL,
  `proposal` varchar(100) DEFAULT NULL,
  `id_bidang` int(50) NOT NULL,
  `id_status` varchar(25) NOT NULL,
  `idta` int(11) NOT NULL,
  PRIMARY KEY (`id_judul`),
  KEY `relasi_topik_judul` (`idta`),
  CONSTRAINT `relasi_topik_judul` FOREIGN KEY (`idta`) REFERENCES `t_topik` (`idta`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_judul
-- ----------------------------
INSERT INTO `t_judul` VALUES ('60', '1103150004', 'Fajri', 'Rahmat Said', 'fajrirs@gmail.com', 'PENDETEKSI HOAKS PADA MEDIA SOSIAL TWITTER', 'Metode A', null, '14780013', '14780013', null, '4', '8', '2');
INSERT INTO `t_judul` VALUES ('61', '1103150004', 'Fajri', 'Rahmat Said', 'fajri@gmai.com', 'SUBTITUSI TEPUNG KACANG HIJAU SEBAGAI PENGGANTI TEPUNG TERIGU DALAM PEMBUATAN SPONGE CAKE', 'METODE X', '2770066', '14780013', '14780013', null, '1', '50', '9');

-- ----------------------------
-- Table structure for t_topik
-- ----------------------------
DROP TABLE IF EXISTS `t_topik`;
CREATE TABLE `t_topik` (
  `idta` int(11) NOT NULL AUTO_INCREMENT,
  `topik` varchar(200) NOT NULL,
  `id_bidang` int(50) NOT NULL,
  `requirement` varchar(50) NOT NULL,
  `nip` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `kuotatopik` int(10) NOT NULL,
  `pbb1` int(11) DEFAULT NULL,
  `pbb2` int(11) DEFAULT NULL,
  PRIMARY KEY (`idta`),
  KEY `fk_bidang_topik` (`id_bidang`),
  KEY `fk_nip_topik` (`nip`),
  CONSTRAINT `fk_bidang_topik` FOREIGN KEY (`id_bidang`) REFERENCES `bidang` (`id_bidang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_nip_topik` FOREIGN KEY (`nip`) REFERENCES `dosen` (`nip`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of t_topik
-- ----------------------------
INSERT INTO `t_topik` VALUES ('2', 'PENDETEKSI HOAKS PADA MEDIA SOSIAL TWITTER', '4', 'Java, Html, Css', '14780013', 'Memiliki 5 Metode yang dapat digunakan', '5', null, '14780013');
INSERT INTO `t_topik` VALUES ('3', 'ANALISIS DAN PERANCANGAN ENTERPRISE ARCHITECTURE BIDANG TATA KELOLA LINGKUNGAN MENGGUNAKAN TOGAF ADM PADA DINAS LINGKUNGAN HIDUP PROVINSI JAWA BARAT', '2', 'Java, Python', '14780013', 'Lorem Ipsum', '5', null, '14860078');
INSERT INTO `t_topik` VALUES ('4', 'PENERAPAN METODE EARNED VALUE MANAGEMENT PADA PROSES PENGENDALIAN PROYEK PT XYZ', '1', 'Java', '14780013', 'Lorem Ipsum', '5', null, '14860078');
INSERT INTO `t_topik` VALUES ('6', 'RANCANGAN PERBAIKAN KUALITAS PRODUK THAI TEA DARI ROFFEE\'S MELTY PUDDING', '1', 'Java, Python', '14780013', 'Lorem Ipsum', '5', null, '14780013');
INSERT INTO `t_topik` VALUES ('7', 'RANCANG BANGUN SISTEM PENANGGULANGAN BENCANA ALAM', '1', 'C++', '14780013', 'Lorem Ipsum', '5', null, '14860078');
INSERT INTO `t_topik` VALUES ('8', 'RANCANG BANGUN SISTEM PENGECEKAN ERROR', '1', 'Java', '14780013', 'Lorem Ipsum', '5', null, '14780013');
INSERT INTO `t_topik` VALUES ('9', 'SUBTITUSI TEPUNG KACANG HIJAU SEBAGAI PENGGANTI TEPUNG TERIGU DALAM PEMBUATAN SPONGE CAKE', '1', 'Java', '14780013', 'Lorem Ipsum', '5', null, '14860078');
INSERT INTO `t_topik` VALUES ('10', 'ANALISIS KINERJA PROYEK DENGAN METODE EARNED VALUE MANAGEMENT PADA PROYEK SHUTDOWN STO', '1', 'Java', '14780013', 'Lorem Ipsum', '5', null, '14780013');
INSERT INTO `t_topik` VALUES ('11', 'OPTIMASI PADA SISTEM DISTRIBUSI AIR BERSIH DI WILAYAH II UNIVERSITAS TELKOM', '1', 'Java', '14780013', 'Lorem Ipsum', '5', null, '14860078');
INSERT INTO `t_topik` VALUES ('16', 'PENDETEKSI HOAKS PADA MEDIA SOSIAL FACEBOOK', '1', 'Python', '14780013', 'Dirancang Dan Dibangun dalam', '5', null, '14780013');
INSERT INTO `t_topik` VALUES ('20', 'DESAIN DAN PURWARUPA KEAMANAN PADA MESIN ATM', '4', 'Java, Python', '2770066', 'Nantinya dikerjakan 3 orang', '5', '2770066', null);
INSERT INTO `t_topik` VALUES ('27', '	PERANCANGAN DAN ANALISIS CS PADA WATERMARK AUDIO STEREO BERBASIS QIM DENGAN TEKNIK GABUNGAN DCT-QR-CPT', '4', 'Java', '14860078', 'Lorem Ipsum', '5', null, '14860078');
INSERT INTO `t_topik` VALUES ('28', 'ANALISIS PERFORMANSI DENOISING SINYAL EEG MENGGUNAKAN METODE DISCRETE WAVELET TRANSFORM DAN ADAPTIVE FILTER', '4', 'Java, Python', '14860078', 'Lorem Ipsum', '5', '2770066', null);
INSERT INTO `t_topik` VALUES ('31', 'RANCANG BANGUN SISTEM KEAMANAN MENGGUNAKAN ONE TIME PASSCODE', '1', 'Java, Python', '2770066', 'Lorem Ipsum', '5', '2770066', null);
INSERT INTO `t_topik` VALUES ('32', 'RANCANG BANGUN SISTEM INFORMASI', '1', 'JS', '14780013', 'topik dikerjakan dengan', '5', null, '14780013');

-- ----------------------------
-- Table structure for user_roles
-- ----------------------------
DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `user_role_id` int(1) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`user_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_roles
-- ----------------------------
INSERT INTO `user_roles` VALUES ('1', 'Ketua KK');
INSERT INTO `user_roles` VALUES ('2', 'Dosen');
INSERT INTO `user_roles` VALUES ('3', 'Mahasiswa');
INSERT INTO `user_roles` VALUES ('4', 'Admin');
INSERT INTO `user_roles` VALUES ('5', 'Dekan Fakultas');
INSERT INTO `user_roles` VALUES ('6', 'Direktur PPM');
INSERT INTO `user_roles` VALUES ('7', 'Laboran');
INSERT INTO `user_roles` VALUES ('8', 'Laboratorium');
INSERT INTO `user_roles` VALUES ('51', 'Dosen Pembina');
INSERT INTO `user_roles` VALUES ('80', 'Dosen PKIP');
