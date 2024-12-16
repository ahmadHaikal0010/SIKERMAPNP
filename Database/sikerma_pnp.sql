-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 13, 2024 at 01:26 AM
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
  `kegiatan` varchar(50) DEFAULT NULL,
  `deskripsi` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `dokumentasi` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `tb_mou_moa_idMouMoa` int NOT NULL,
  `tb_mou_moa_mitra_idMitra` int NOT NULL,
  `tb_mou_moa_user_idAkun` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tb_kegiatan_kerjasama`
--

INSERT INTO `tb_kegiatan_kerjasama` (`idKegiatan`, `kegiatan`, `deskripsi`, `dokumentasi`, `tb_mou_moa_idMouMoa`, `tb_mou_moa_mitra_idMitra`, `tb_mou_moa_user_idAkun`) VALUES
(16, 'NGUWAWOR', 'ABCD', '67582824e511a.jpg,67582824e54e9.jpg,67582824e5954.jpg,67582824e5c40.jpg', 14, 4, 2),
(17, 'ASDF', 'JKL', '67584285c044e.jpg,67584285c07ff.jpg,67584285c0a5d.jpg', 18, 18, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_mitra`
--

CREATE TABLE `tb_mitra` (
  `idMitra` int NOT NULL,
  `namaInstansi` varchar(50) DEFAULT NULL,
  `namaPimpinan` varchar(30) DEFAULT NULL,
  `alamatMitra` varchar(50) DEFAULT NULL,
  `emailMitra` varchar(30) DEFAULT NULL,
  `teleponMitra` varchar(20) DEFAULT NULL,
  `bidangUsaha` varchar(40) DEFAULT NULL,
  `websiteMitra` varchar(50) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tb_mitra`
--

INSERT INTO `tb_mitra` (`idMitra`, `namaInstansi`, `namaPimpinan`, `alamatMitra`, `emailMitra`, `teleponMitra`, `bidangUsaha`, `websiteMitra`, `provinsi`, `kota`) VALUES
(1, 'semen padang', 'semen', 'padang', 'semen@gmail.com', '1234567890', 'infrastruktur', '', 'sumatera barat', 'padang'),
(4, 'AMD', 'amd', 'lubuk basung, agam', 'amd@gmail.com', '2554', 'Teknologi', '', 'jawa', 'bandung'),
(5, 'Instansi A', 'Pimpinan A', 'Alamat A', 'emaila@example.com', '081234567890', 'IT', 'www.instansia.com', 'Jawa Barat', 'Bandung'),
(6, 'Instansi B', 'Pimpinan B', 'Alamat B', 'emailb@example.com', '081234567891', 'Finance', 'www.instansib.com', 'DKI Jakarta', 'Jakarta'),
(7, 'Instansi C', 'Pimpinan C', 'Alamat C', 'emailc@example.com', '081234567892', 'Healthcare', 'www.instansic.com', 'Jawa Tengah', 'Semarang'),
(8, 'Instansi D', 'Pimpinan D', 'Alamat D', 'emaild@example.com', '081234567893', 'Education', 'www.instansid.com', 'Yogyakarta', 'Yogyakarta'),
(9, 'Instansi E', 'Pimpinan E', 'Alamat E', 'emaile@example.com', '081234567894', 'Retail', 'www.instansie.com', 'Jawa Timur', 'Surabaya'),
(10, 'Instansi F', 'Pimpinan F', 'Alamat F', 'emailf@example.com', '081234567895', 'Manufacturing', 'www.instansif.com', 'Sumatera Utara', 'Medan'),
(11, 'Instansi G', 'Pimpinan G', 'Alamat G', 'emailg@example.com', '081234567896', 'Logistics', 'www.instansig.com', 'Bali', 'Denpasar'),
(12, 'Instansi H', 'Pimpinan H', 'Alamat H', 'emailh@example.com', '081234567897', 'Tourism', 'www.instansih.com', 'Nusa Tenggara Barat', 'Mataram'),
(13, 'Instansi I', 'Pimpinan I', 'Alamat I', 'emaili@example.com', '081234567898', 'Real Estate', 'www.instansii.com', 'Kalimantan Timur', 'Balikpapan'),
(14, 'Instansi J', 'Pimpinan J', 'Alamat J', 'emailj@example.com', '081234567899', 'Energy', 'www.instansij.com', 'Papua', 'Jayapura'),
(15, 'Instansi K', 'Pimpinan K', 'Alamat K', 'emailk@example.com', '081234567800', 'Automotive', 'www.instansik.com', 'Sulawesi Selatan', 'Makassar'),
(16, 'Instansi L', 'Pimpinan L', 'Alamat L', 'emaill@example.com', '081234567801', 'Food & Beverage', 'www.instansil.com', 'Riau', 'Pekanbaru'),
(17, 'Instansi M', 'Pimpinan M', 'Alamat M', 'emailm@example.com', '081234567802', 'Telecommunications', 'www.instansim.com', 'Aceh', 'Banda Aceh'),
(18, 'Instansi N', 'Pimpinan N', 'Alamat N', 'emailn@example.com', '081234567803', 'Construction', 'www.instansin.com', 'Banten', 'Serang'),
(19, 'Instansi O', 'Pimpinan O', 'Alamat O', 'emailo@example.com', '081234567804', 'Agriculture', 'www.instansio.com', 'Lampung', 'Bandar Lampung'),
(20, 'Instansi P', 'Pimpinan P', 'Alamat P', 'emailp@example.com', '081234567805', 'Media', 'www.instansip.com', 'Jambi', 'Jambi'),
(21, 'Instansi Q', 'Pimpinan Q', 'Alamat Q', 'emailq@example.com', '081234567806', 'Pharmaceutical', 'www.instansiq.com', 'Sumatera Selatan', 'Palembang'),
(22, 'Instansi R', 'Pimpinan R', 'Alamat R', 'emailr@example.com', '081234567807', 'Legal', 'www.instansir.com', 'Maluku', 'Ambon'),
(23, 'Instansi S', 'Pimpinan S', 'Alamat S', 'emails@example.com', '081234567808', 'Consulting', 'www.instansis.com', 'Sulawesi Utara', 'Manado'),
(24, 'Instansi T', 'Pimpinan T', 'Alamat T', 'emailt@example.com', '081234567809', 'E-commerce', 'www.instansit.com', 'Kalimantan Barat', 'Pontianak');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mou_moa`
--

CREATE TABLE `tb_mou_moa` (
  `idMouMoa` int NOT NULL,
  `nomorMouMoa` varchar(30) DEFAULT NULL,
  `judul_kerjasama` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `jenisKerjasama` enum('mou','moa') DEFAULT NULL,
  `jangkaWaktu` varchar(20) DEFAULT NULL,
  `awalKerjasama` date DEFAULT NULL,
  `akhirKerjasama` date DEFAULT NULL,
  `tindakan` varchar(45) DEFAULT NULL,
  `jurusan` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `topik_kerjasama` varchar(50) DEFAULT NULL,
  `fileDokumen` varchar(255) DEFAULT NULL,
  `mitra_idMitra` int NOT NULL,
  `user_idAkun` int NOT NULL,
  `mailing` enum('belum','sudah') NOT NULL DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tb_mou_moa`
--

INSERT INTO `tb_mou_moa` (`idMouMoa`, `nomorMouMoa`, `judul_kerjasama`, `jenisKerjasama`, `jangkaWaktu`, `awalKerjasama`, `akhirKerjasama`, `tindakan`, `jurusan`, `topik_kerjasama`, `fileDokumen`, `mitra_idMitra`, `user_idAkun`, `mailing`) VALUES
(14, '8092376852746', 'PPT', 'moa', '16', '2024-12-09', '2040-12-31', '', 'General', 'ABCD', '6757083153c4c.docx', 4, 2, 'belum'),
(15, 'b 467bu23cv2W', 'GUS', 'mou', '4', '2024-12-10', '2028-12-16', '', 'Teknik Sipil,Teknik Elektro,Administrasi Niaga', 'EFGH', '6757c1517b569.xlsx', 5, 2, 'belum'),
(16, '3644v2', 'POP', 'mou', '0', '2024-12-10', '2024-12-13', '', 'General', 'HIJK', '6757c4dbbabd2.docx', 18, 2, 'sudah'),
(17, 'sdgsf', 'OOT', 'mou', '2', '2024-12-10', '2026-12-31', '', 'General', 'IJKL', '6757ce854f30c.jpg', 4, 2, 'belum'),
(18, 'uj89', 'SIGMA', 'mou', '1', '2023-01-10', '2024-12-10', '', 'Teknik Mesin,Teknik Elektro', 'GEAG', '6757dda154189.docx', 18, 2, 'belum'),
(19, '45tgf', 'LIGMA', 'mou', '1', '2023-02-10', '2024-12-10', '', 'General', 'GRWS', '6757dde65e81a.docx', 24, 2, 'belum'),
(20, '356y', 'ROW', 'mou', '2', '2022-01-10', '2024-12-10', '', 'General', 'NUIGES', '6757de2567393.png', 7, 2, 'belum'),
(21, 'enrthGB', 'CONS', 'mou', '0', '2024-12-10', '2024-12-10', '', 'General', 'NTSRT', '6757de520f771.txt', 5, 2, 'belum'),
(22, '6565sgf322', 'IO', 'mou', '4', '2024-12-10', '2028-12-10', '', 'Teknik Sipil,Administrasi Niaga', 'ABCD', '675824554b242.png', 13, 2, 'belum'),
(23, '534', 'QWERTY', 'moa', '2', '2022-01-10', '2024-12-10', '', 'Teknologi Informasi,Teknik Mesin', 'OYO', '67582fbde498b.jpg', 19, 1, 'belum'),
(24, 'n9', 'VUE', 'moa', '3', '2022-01-01', '2025-01-01', '', 'Teknik Mesin,Teknik Sipil', 'JLFD', '675830ee124d6.jpg', 9, 1, 'sudah'),
(25, '536h', 'WYT', 'moa', '4', '2023-01-10', '2027-12-10', '', 'General', 'GBUIRS', '6758312c8c66e.jpg', 10, 1, 'belum'),
(26, 'h65', 'KKK', 'mou', '1', '2024-12-12', '2026-06-25', '', 'General', 'JEKEL', '675adef1cc8bf.jpg', 13, 1, 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `idAkun` int NOT NULL,
  `namaUser` varchar(50) DEFAULT NULL,
  `emailUser` varchar(30) DEFAULT NULL,
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
  `namaInstansi` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `namaPenandaTangan` varchar(50) DEFAULT NULL,
  `namaJabatan` varchar(50) DEFAULT NULL,
  `namaKontakPerson` varchar(50) DEFAULT NULL,
  `noKontak` varchar(40) DEFAULT NULL,
  `emailUsulan` varchar(50) DEFAULT NULL,
  `dokumenUsulan` varchar(255) DEFAULT NULL,
  `waktu` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tb_usulan_kerjasama`
--

INSERT INTO `tb_usulan_kerjasama` (`idUsulan`, `namaInstansi`, `alamat`, `namaPenandaTangan`, `namaJabatan`, `namaKontakPerson`, `noKontak`, `emailUsulan`, `dokumenUsulan`, `waktu`) VALUES
(1, 'semen padang', 'padang', 'budi', 'president', '08123456', '0u20 t', 'jsg@gmail.com', NULL, '2024-12-10'),
(10, 'ABCD', 'Padang', 'Ahmad', 'Vice President', 'IJKL', 'EFGH', 'haikala0010@gmail.com', '67588402be778.jpg', '2024-12-11');

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
  MODIFY `idKegiatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_mitra`
--
ALTER TABLE `tb_mitra`
  MODIFY `idMitra` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_mou_moa`
--
ALTER TABLE `tb_mou_moa`
  MODIFY `idMouMoa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `idAkun` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_usulan_kerjasama`
--
ALTER TABLE `tb_usulan_kerjasama`
  MODIFY `idUsulan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
