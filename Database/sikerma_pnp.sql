-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 06, 2025 at 12:35 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sikerma_pnp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_kegiatan_kerjasama`
--

CREATE TABLE `tb_kegiatan_kerjasama` (
  `idKegiatan` int NOT NULL,
  `kegiatan` varchar(100) DEFAULT NULL,
  `deskripsi` varchar(200) DEFAULT NULL,
  `dokumentasi` text,
  `tb_mou_moa_idMouMoa` int NOT NULL,
  `tb_mou_moa_mitra_idMitra` int NOT NULL,
  `tb_mou_moa_user_idAkun` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `tb_mitra`
--

CREATE TABLE `tb_mitra` (
  `idMitra` int NOT NULL,
  `namaInstansi` varchar(70) DEFAULT NULL,
  `namaPimpinan` varchar(30) DEFAULT NULL,
  `alamatMitra` varchar(200) DEFAULT NULL,
  `emailMitra` varchar(90) DEFAULT NULL,
  `teleponMitra` varchar(90) DEFAULT NULL,
  `bidangUsaha` varchar(50) DEFAULT NULL,
  `websiteMitra` varchar(140) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tb_mitra`
--

INSERT INTO `tb_mitra` (`idMitra`, `namaInstansi`, `namaPimpinan`, `alamatMitra`, `emailMitra`, `teleponMitra`, `bidangUsaha`, `websiteMitra`, `provinsi`, `kota`) VALUES
(1, 'PEMERINTAH NAGARI TANJUNG BONAI AUR', NULL, '', '', '', 'PEMERINTAHAN', '', 'SUMATERA BARAT', 'SIJUNJUNG'),
(2, 'PEMERINTAH NAGARI BATU TABA', NULL, '', '', '', 'PEMERINTAH NAGARI', '', 'SUMATERA BARAT', 'AGAM'),
(3, 'PEMERINTAH NAGARI PANAMPUANG', NULL, 'Jln. Raya Biaro-Koto Baru Km.2 Pakan Kaluang Jorong Surau Lauik, Nagari Panampuang., Kec. Ampek Angkek, Kab. Agam\r\n', 'Nagaripanampuang@gmail.com', '(0752)426767', 'PEMERINTAH NAGARI', 'https://panampuang.id/', 'SUMATERA BARAT', 'AGAM'),
(4, 'AKADEMI PARIWISATA BUNDA', NULL, 'Jl. Arif Rahman Hakim No.57 Padang - Sumatera Barat.', 'info@akparbundapadang.ac.id', '(0751)34212', 'PENDIDIKAN', 'https://www.akparbundapadang.ac.id/', 'SUMATERA BARAT', 'PADANG'),
(5, 'PEMERINTAH KOTA PADANG', NULL, '\"Jl. Bagindo Azis Chan No. 1, Aie Pacah - Kota Padang, Sumatera Barat', 'diskominfo@padang.go.id', '0751 4640800', 'PEMERINTAH', 'https://padang.go.id/', 'SUMATERA BARAT', 'PADANG'),
(6, 'BALAI PENERAPAN TEKNOLOGI KONSTRUKSI KEMENTERIAN PU', NULL, '', 'portaldjbk@pu.go.id', '', 'KONSTRUKSI', '', 'SUMATERA BARAT', 'JAKARTA'),
(8, 'SMA NEGERI 5 BUKITTINGGI', NULL, 'Jl. Nj Dt Mangkuto Ameh Kec. Mandiangin Koto Selayan, Kota Bukittinggi - Sumatera Barat', 'sman5bukittinggi@gmail.com', '(0752) 34099', 'PENDIDIKAN', 'https://www.sman5bukittinggi.sch.id/', 'SUMATERA BARAT', 'BUKITTINGGI'),
(9, 'KOMINFO', NULL, 'Jl. Medan Merdeka Barat no. 9, Jakarta 10110', 'humas@mail.kominfo.go.id', '(021) 345284', 'Pemerintah (Informasi)', 'https://www.kominfo.go.id/', 'Jakarta Pusat', 'Jakarta'),
(10, 'DINAS KOPERASI DAN UMKM SUMATERA BARAT', NULL, 'Jl. Khatib Sulaiman No. 11 Padang, Sumatera Barat 27113', 'diskop@sumbarprov.go.id', '0751 - 7055292 - 7055298 - 443200', 'USAHA KOPERASI', 'https://diskopukm.sumbarprov.go.id/', 'SUMATERA BARAT', 'PADANG'),
(11, 'POLITEKNIK NEGERI PONTIANAK', NULL, 'Jl. Jenderal Ahmad Yani, Bansir Laut, Pontianak Tenggara, Kota Pontianak, Kalimantan Barat, 78124', 'kampus@polnep.ac.id', '561736180 or whatsapp:+6281256074059', 'PENDIDIKAN', 'https://polnep.ac.id/page/polnep-s-profile', 'KALIMANTAN BARAT', 'PONTIANAK'),
(12, 'STMIK HANG TUAH PEKANBARU', NULL, 'Jl. Mustafa Sari No. 5, Tangkerang Selatan, Pekanbaru, Riau-28288', 'universitas@htp.ac.id', '(0761) 571524', 'PENDIDIKAN', 'https://htp.ac.id/', 'RIAU', 'PEKANBARU'),
(13, 'STMIK JAYANUSA PADANG', NULL, 'Jl. Damar No.69 E Padang, Sumatera Barat', 'jayanusa@jayanusa.ac.id', '0751-28984, 08116650635', 'PENDIDIKAN', 'https://jayanusa.ac.id/', 'SUMATERA BARAT', 'PADANG'),
(14, 'AMIK JAYANUSA PADANG', NULL, 'Jl. Damar No.69 E Padang, Sumatera Barat', 'jayanusa@jayanusa.ac.id', '0751-28984, 08116650635', 'PENDIDIKAN', 'https://jayanusa.ac.id/', 'SUMATERA BARAT', 'PADANG'),
(15, 'SEKOLAH TINGGI ILMU EKONOMI HAJI AGUS SALIM', NULL, 'Jalan Bahder Johan 26136 Bukittinggi Sumatera Barat · ~69,6 km', ' itbhasbkt@gmail.com', '(0752)34201 / +62 812 1234 0990 / itbhasbkt@gmail.com', 'PENDIDIKAN', 'http://www.itbhas.ac.id/', 'SUMATERA BARAT', 'BUKITTINGGI'),
(16, 'SEKOLAH TINGGI TEKNOLOGI INDUSTRI', NULL, NULL, NULL, NULL, 'PENDIDIKAN', 'https://sttind.ac.id/', 'SUMATERA BARAT', 'PADANG'),
(17, 'FAKULTAS TEKNIK UNIVERSITAS PAMULANG', NULL, 'Kampus Pusat : Jl. Surya Kencana No.1, Pamulang Bar., Kec. Pamulang, Kota Tangerang Selatan, Banten 15417', 'humas@unpam.ac.id', '(021) 7412566 / 74709855', 'PENDIDIKAN', 'https://unpam.ac.id/fakultas-teknik/', 'BANTEN', 'TANGERANG'),
(18, 'PT PLN (PERSERO) UPK TELUK SIRIH', NULL, 'Desa Teluk Sirih, RT001/RW004, Kel.. Teluk Kabung Tengah, Kec. Bungus Teluk Kabung, Kota Padang, Prov. Sumatera Barat.', '\"pln123@pln.co.id\r\n 	pln123_official\"', '(0751) 4650089', 'LISTRIK NEGARA', 'https://web.pln.co.id/', 'SUMATERA BARAT', 'PADANG'),
(19, 'GRAND ZURI HOTEL', NULL, '\"Jalan M. Thamrin No.27, Padang 25211\r\nSumatera Barat, Indonesia\"', 'reserservation@premierehotelpadang.com', '+62 751 894 888', 'PERHOTELAN', 'http://www.zhmhotels.com/hotel/the-zhm-premiere-padang/', 'SUMATERA BARAT', 'PADANG'),
(20, 'KAWANA HOTEL', NULL, '\"Jl. MH. Thamrin No. 71 Kelurahan Ranah Parak Rumbio, Padang Selatan, Kota Padang - Sumatera Barat 25212\r\nIndonesia.\"\r\n', 'nfo@kawanahotel.co.id', '+62 (751) 890777 or WhatsaApp : +62 811 666 0117', 'PERHOTELAN', 'https://www.kawanahotel.co.id/', 'SUMATERA BARAT', 'PADANG'),
(21, 'ASTRA DAIHATSU SUMBAR', NULL, 'Jl. Khatib Sulaiman No.101, Ulakkarang Utara, Padang Utara, Padang, Sumatera Barat, 25133', 'cs@dso.astra.co.id', ' (0751)7052222', 'PERDAGANGAN MOBIL', 'https://www.astra-daihatsu.id/', 'SUMATERA BARAT', 'PADANG'),
(22, 'PT MEDIA INDOTAMA EXPO', NULL, 'Indonesia Stock Exchange Tower 1 Level 3-04, SCBD\r\nJakarta Selatan 12190', 'hello@kolegal.id', '0817-325-600 or Whatsapp: 0817-325-600', 'PENDIDIKAN DAN PELATIHAN', 'https://kolegal.id/media-indotama-expo', 'SUMATERA BARAT', 'PADANG'),
(23, 'INNER DRIVE', NULL, 'United Kingdom', 'info@innerdrive.co.uk', '+44 208 693 3191', 'PENDIDIKAN, BISNIS AND SPORT', 'https://www.innerdrive.co.uk/contact/', 'SUMATERA BARAT', 'PADANG'),
(24, 'SMK NEGERI 5 PAYAKUMBUH', NULL, 'PJJ3+PC4 Tangah Padang Indah, Situjuah Banda Dalam, Kec. Situjuah Limo Nagari, Kota Payakumbuh, Sumatera Barat 26225', NULL, '\r\n\r\n', 'PENDIDIKAN', 'https://ppid.sma5pyk.sch.id/profil-sekolah//', 'SUMATERA BARAT', 'PAYAKUMBUH'),
(25, 'HIMPUNAN AHLI TEKNIK HIDRAULIK INDONESIA', NULL, 'Gedung Dit.Jend. SDA, Lt. 8, Kementerian PUPR Jl Pattimura No. 20, Jakarta', 'hathi.pusat@gmail.com', '+62-21-72792263', 'HIMPUNAN PROFESI', 'https://hathi.id/', 'JAKARTA SELATAN', 'JAKARTA'),
(26, 'PT. PUTRA BAJA DELI', NULL, 'Wisma ADR Lt 5 Jl Pluit Raya 1 no 1, Jakarta Utara, DKI Jakarta 14440', NULL, NULL, 'PRODUK BAJA', 'www.putrabajadeli.com', 'SUMATERA UTARA', 'MEDAN'),
(27, 'IKATAN AHLI INFORMATIKA INDONESIA', NULL, 'Jalan Jati Padang Raya No. 41 Jati Padang Pasar Minggu Jakarta Selatan Kode Pos 12540', 'siswantodppiaii@gmail.com', '+62 87767275025 (WA Only)', 'PROFESI', 'https://iaii.or.id/', 'JAKARTA SELATAN', 'JAKARTA'),
(28, 'PEMERINTAH NAGARI KAMANG HILIA', NULL, NULL, NULL, NULL, 'PEMERINTAHAN', NULL, 'SUMATERA BARAT', 'AGAM'),
(29, 'PT KURNIA ABADI PADANG', NULL, NULL, NULL, NULL, 'AKSESORIS LISTRIK', NULL, 'SUMATERA BARAT', 'PADANG'),
(30, 'NATIONAL YUNLIN UNIVERSITY OF SCIENCE AND TECHNOLOGY', NULL, '123 University Road, Section 3,Douliou, Yunlin 64002, Taiwan, R.O.C.', NULL, '886-5-534-2601 ', 'PENDIDIKAN', 'https://eng.yuntech.edu.tw/', 'TAIWAN', 'TAIWAN'),
(31, 'POLITEKNIK SULTAN MIZAN ZAINAL ABIDIN', NULL, 'Politeknik Sultan Mizan Zainal Abidin (PSMZA), KM 08 Jalan Paka, 23000 Dungun, Terengganu Darul Iman', 'webmaster@psmza.edu.my', '09-8400800', 'PENDIDIKAN', 'https://psmza.mypolycc.edu.my/', 'MALAYSIA', 'TERENGGANU'),
(32, 'PT HALUAN CYBER MEDIA', NULL, 'KOMPLEK BANDARA TABING LANUD- KOTA PADANG', NULL, '987790 or 0813 7283 8945', 'MEDIA ONLINE', 'https://use.infobelpro.com/indonesia/en/businessdetails/ID/0742135390', 'SUMATERA BARAT', 'PADANG'),
(33, 'CHANGZHOU INSTITUTE OF INDUSTRIAL TECHNOLOGY (CHILI)', NULL, 'C1604 Xinyinzuo Building, Luohu, Shenzhen', 'contact@isac.org.cn', '+86-180-4242-4161', 'PENDIDIKAN', 'https://www.isacteach.com/university/changzhou-institute-of-industry-technology/', 'CHINA', 'JIANGSU SHENG'),
(34, 'CHANGZHOU VOCATIONAL INSTITUTE OF ENGINEERING TECHNOLOGY', NULL, 'C1604 Xinyinzuo Building, Luohu, Shenzhen', 'contact@isac.org.cn', '+86-180-4242-4161', 'PENDIDIKAN', 'https://www.isacteach.com/university/changzhou-institute-of-industry-technology/', 'CHINA', 'JIANGSU SHENG'),
(35, 'CHANGZHOU VOCATIONAL INSTITUTE OF MECHATRONIC TECHNOLOGY', NULL, 'No. 26 Mingxin Middle Road, Wujin District, Changzhou City, Jiangsu Province, China', NULL, '+8613632437050 (Whatsapp/Wechat/Viber/IMO)', 'PENDIDIKAN', 'https://www.digiedupro.com/changzhou-institute-of-mechatronic-technology/', 'CHINA', 'JIANGSU SHENG'),
(36, 'POLITEKNIK MUADZAM SHAH (PMS)', NULL, 'Politeknik Muadzam Shah, Lebuhraya Tun Abdul Razak, 26700 Muadzam Shah, Pahang Darul Makmur.', 'webmasterpms@pms.edu.my', '09 450 2005/ 2006 /2007', 'PENDIDIKAN', 'https://pms.mypolycc.edu.my/', 'MALAYSIA', 'PAHANG'),
(37, 'NATIONAL KAOHSIUNG UNIVERSITY OF SCIENCE AND TECHNOLOGY.', NULL, 'No.1, University Rd., Yanchao Dist., Kaohsiung City 824005, Taiwan', 'qaoffice01@nkust.edu.tw', NULL, 'PENDIDIKAN', 'https://eng.nkust.edu.tw/', 'TAIWAN', 'KAOHSIUNG CITY'),
(39, 'MANAGEMENT AND SCIENCE UNIVERSITY (MSU)', '', 'Management and Science University DU019(B)\r\nUniversity Drive, Off Persiaran Olahraga,\r\nSection 13, 40100 Shah Alam,\r\nSelangor Darul Ehsan, Malaysia', '', '(603) 55216868', 'PENDIDIKAN', 'https://www.msu.edu.my/', 'MALAYSIA', 'MALAYSIA');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mou_moa`
--

CREATE TABLE `tb_mou_moa` (
  `idMouMoa` int NOT NULL,
  `nomorMouMoa` varchar(30) DEFAULT NULL,
  `judul_kerjasama` varchar(50) NOT NULL,
  `jenisKerjasama` enum('mou','moa') DEFAULT NULL,
  `jangkaWaktu` varchar(20) DEFAULT NULL,
  `awalKerjasama` date DEFAULT NULL,
  `akhirKerjasama` date DEFAULT NULL,
  `tindakan` varchar(45) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `topik_kerjasama` varchar(90) DEFAULT NULL,
  `fileDokumen` varchar(255) DEFAULT NULL,
  `mitra_idMitra` int NOT NULL,
  `user_idAkun` int NOT NULL,
  `mailing` enum('belum','sudah') NOT NULL DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tb_mou_moa`
--

INSERT INTO `tb_mou_moa` (`idMouMoa`, `nomorMouMoa`, `judul_kerjasama`, `jenisKerjasama`, `jangkaWaktu`, `awalKerjasama`, `akhirKerjasama`, `tindakan`, `jurusan`, `topik_kerjasama`, `fileDokumen`, `mitra_idMitra`, `user_idAkun`, `mailing`) VALUES
(9, '890/13/TB-A/2019', 'PENGABDIAN MASYARAKAT', 'mou', '2', '2019-04-05', '2021-04-05', '', 'General', 'PENGABDIAN MASYARAKAT', '6764de4b10716.pdf', 1, 2, 'belum'),
(10, '1107/PL9/KS/2019', 'PENGABDIAN MASYARAKAT', 'moa', '3', '2019-01-25', '2022-01-25', '', 'General', 'PENGABDIAN MASYARAKAT', '676511e02a245.pdf', 2, 2, 'belum'),
(11, '1632/PL9/KS/2019', 'PENGABDIAN MASYARAKAT', 'moa', '2', '2019-02-18', '2021-02-18', '', 'General', 'PENGABDIAN MASYARAKAT', '676512b09fb18.pdf', 3, 2, 'belum'),
(12, '1825/PL9/KS/2019', 'PENDIDIKAN DAN PENELITIAN', 'mou', '5', '2019-02-27', '2024-02-27', '', 'General', 'PENDIDIKAN DAN PENELITIAN', '6765133b8616a.pdf', 4, 2, 'belum'),
(13, '2071/PL9/KS/2019', 'TRIDHARMA PERGURUAN TINGGI', 'mou', '1', '2019-03-14', '2020-03-14', '', 'General', 'TRIDHARMA PERGURUAN TINGGI', '676513a8a6e83.pdf', 5, 2, 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `idAkun` int NOT NULL,
  `namaUser` varchar(50) DEFAULT NULL,
  `emailUser` varchar(90) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('super admin','admin','jurusan','mitra') CHARACTER SET big5 COLLATE big5_chinese_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`idAkun`, `namaUser`, `emailUser`, `username`, `password`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin', '$2y$10$DKeerL8LDnqgdioKKzmyaOz6BSWSgnBePuXS3kVZzefCjdkYdycc2', 'admin'),
(2, 'superadmin', 'superadmin@gmail.com', 'superadmin', '$2y$10$j2.EETmP7Ey1/ywKVspfZuuKU4FSK.TO1Bq5F9gD6JCjIN43vLSyq', 'super admin'),
(7, 'jurusan', 'jurusan@gmail.com', 'jurusan', '$2y$10$T.bXAX.sXP7O76QmyzI0Z.jQq.QRrwI89FJxLm7awp1Gp9Ill7CeC', 'jurusan');

-- --------------------------------------------------------

--
-- Table structure for table `tb_usulan_kerjasama`
--

CREATE TABLE `tb_usulan_kerjasama` (
  `idUsulan` int NOT NULL,
  `namaInstansi` varchar(70) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `namaPenandaTangan` varchar(50) DEFAULT NULL,
  `namaJabatan` varchar(50) DEFAULT NULL,
  `namaKontakPerson` varchar(70) DEFAULT NULL,
  `noKontak` varchar(90) DEFAULT NULL,
  `emailUsulan` varchar(90) DEFAULT NULL,
  `dokumenUsulan` varchar(255) DEFAULT NULL,
  `waktu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tb_usulan_kerjasama`
--

INSERT INTO `tb_usulan_kerjasama` (`idUsulan`, `namaInstansi`, `alamat`, `namaPenandaTangan`, `namaJabatan`, `namaKontakPerson`, `noKontak`, `emailUsulan`, `dokumenUsulan`, `waktu`) VALUES
(2, 'genomia', 'padang', 'genomia', 'mahasiswa', '938483984', '082828822', 'genommia@gmail.com', '677b520e913ee.docx', '2025-01-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kegiatan_kerjasama`
--
ALTER TABLE `tb_kegiatan_kerjasama`
  ADD PRIMARY KEY (`idKegiatan`,`tb_mou_moa_idMouMoa`,`tb_mou_moa_mitra_idMitra`,`tb_mou_moa_user_idAkun`),
  ADD KEY `fk_tb_kegiatan_kerjasama_tb_mou_moa1_idx` (`tb_mou_moa_idMouMoa`,`tb_mou_moa_mitra_idMitra`,`tb_mou_moa_user_idAkun`);

--
-- Indexes for table `tb_mitra`
--
ALTER TABLE `tb_mitra`
  ADD PRIMARY KEY (`idMitra`);

--
-- Indexes for table `tb_mou_moa`
--
ALTER TABLE `tb_mou_moa`
  ADD PRIMARY KEY (`idMouMoa`,`mitra_idMitra`,`user_idAkun`),
  ADD KEY `fk_mou_moa_mitra_idx` (`mitra_idMitra`),
  ADD KEY `fk_mou_moa_user1_idx` (`user_idAkun`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`idAkun`);

--
-- Indexes for table `tb_usulan_kerjasama`
--
ALTER TABLE `tb_usulan_kerjasama`
  ADD PRIMARY KEY (`idUsulan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kegiatan_kerjasama`
--
ALTER TABLE `tb_kegiatan_kerjasama`
  MODIFY `idKegiatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_mitra`
--
ALTER TABLE `tb_mitra`
  MODIFY `idMitra` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tb_mou_moa`
--
ALTER TABLE `tb_mou_moa`
  MODIFY `idMouMoa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `idAkun` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_usulan_kerjasama`
--
ALTER TABLE `tb_usulan_kerjasama`
  MODIFY `idUsulan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_kegiatan_kerjasama`
--
ALTER TABLE `tb_kegiatan_kerjasama`
  ADD CONSTRAINT `fk_tb_kegiatan_kerjasama_tb_mou_moa1` FOREIGN KEY (`tb_mou_moa_idMouMoa`,`tb_mou_moa_mitra_idMitra`,`tb_mou_moa_user_idAkun`) REFERENCES `tb_mou_moa` (`idMouMoa`, `mitra_idMitra`, `user_idAkun`);

--
-- Constraints for table `tb_mou_moa`
--
ALTER TABLE `tb_mou_moa`
  ADD CONSTRAINT `fk_mou_moa_mitra` FOREIGN KEY (`mitra_idMitra`) REFERENCES `tb_mitra` (`idMitra`),
  ADD CONSTRAINT `fk_mou_moa_user1` FOREIGN KEY (`user_idAkun`) REFERENCES `tb_user` (`idAkun`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
