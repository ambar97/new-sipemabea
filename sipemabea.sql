-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2023 at 04:25 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipemabea`
--

-- --------------------------------------------------------

--
-- Table structure for table `pendaftar`
--

CREATE TABLE `pendaftar` (
  `id_daftar` int(11) NOT NULL,
  `kd_daftar` varchar(20) NOT NULL,
  `type` enum('umum','mahasiswa/i','siswa/i') NOT NULL,
  `nama_instansi` varchar(100) NOT NULL,
  `tujuan_magang` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `proposal` text NOT NULL,
  `status_pendaftar` enum('pengajuan','sedang di tinjau','di tolak','di terima','draft') NOT NULL DEFAULT 'pengajuan',
  `note` text DEFAULT NULL,
  `berkas_toter` text DEFAULT NULL,
  `email` text NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `insert_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `jurusan` varchar(999) DEFAULT NULL,
  `no_surat` varchar(999) DEFAULT NULL,
  `cv_pendaftar` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pendaftar`
--

INSERT INTO `pendaftar` (`id_daftar`, `kd_daftar`, `type`, `nama_instansi`, `tujuan_magang`, `start_date`, `end_date`, `proposal`, `status_pendaftar`, `note`, `berkas_toter`, `email`, `notelp`, `insert_time`, `jurusan`, `no_surat`, `cv_pendaftar`) VALUES
(157, 'MAGANG-120923034350', 'siswa/i', 'SMA Bhayangkari', 'Tugas Akhir', '2023-09-12', '2023-09-30', '1694533430_TES PROPOSAL.pdf', 'sedang di tinjau', 'Harap kirim Balasan ke..', '1694537877_Tes Surat.pdf', 'waduhke03@gmail.com', '089688329976', '2023-09-12 15:43:50', 'TKJ', '651/UNIV/05/2025', '1694533430_TES CV.pdf'),
(156, 'MAGANG-120923083056', 'umum', 'ITN Malang', 'voli', '2023-09-04', '2023-10-28', '1694507456_TES PROPOSAL.pdf', 'di terima', 'Berkas anda diterima', '1694529652_Tes Surat.pdf', '1rizkyfirdaus@gmail.com', '089529311822', '2023-09-12 08:30:56', 'Teknik Informatika', '651/UNIV/05/2023', '1694507456_TES CV.pdf'),
(155, 'MAGANG-120923071947', 'mahasiswa/i', 'ITN Malang', 'Magang Mandiri', '2023-09-12', '2023-10-12', '1694503187_TES PROPOSAL.pdf', 'di terima', 'Selamat Yeye', '1694529692_Tes Surat.pdf', 'socengatt141@gmail.com', '0812345678922', '2023-09-12 07:19:47', 'Teknik Informatika', '651/UNIV/05/202x', '1694503187_TES CV.pdf'),
(158, 'MAGANG-130923012741', 'mahasiswa/i', 'UNEJ', 'Magang', '2023-09-13', '2023-09-13', '1694568461_TES PROPOSAL.pdf', 'di tolak', 'BOLEHH', '1694658168_Tes Surat.pdf', 'nguest1231@gmail.com', '082734182342', '2023-09-13 01:27:41', 'Ekonomi', '651/UNIV/05/2021', '1694568461_TES CV.pdf'),
(159, 'MAGANG-130923125859', 'mahasiswa/i', 'SMA KiwKiw', 'Kukgruuu', '2023-09-13', '2023-09-30', '1694609939_TES PROPOSAL.pdf', 'di tolak', 'Gak layak', '1694610117_Tes Surat.pdf', 'waduhke03@gmail.com', '089736547892', '2023-09-13 12:58:59', 'Cukurukuk', '751/UNIV/05/202x', '1694609939_TES CV.pdf'),
(160, 'MAGANG-140923021733', 'mahasiswa/i', 'Jetak', 'Gada Tujuan', '2023-09-14', '2023-09-27', '1694657853_TES PROPOSAL.pdf', 'draft', 'nanti dikabari', NULL, 'waduhke03@gmail.com', '08976754321', '2023-09-14 02:17:33', 'Kuli', '651/UNIV/08/202x', '1694657853_TES CV.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` int(11) NOT NULL,
  `nama_peserta` text NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `id_daftar` int(11) NOT NULL,
  `status` enum('magang','tidak') NOT NULL DEFAULT 'tidak',
  `times_temp` timestamp NOT NULL DEFAULT current_timestamp(),
  `kd_daftar` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id_peserta`, `nama_peserta`, `start`, `end`, `id_daftar`, `status`, `times_temp`, `kd_daftar`) VALUES
(312, 'rizky', '2023-09-04', '2023-10-28', 156, 'magang', '2023-09-12 08:30:56', 'MAGANG-120923083056'),
(311, 'Kape', '2023-09-04', '2023-10-28', 156, 'magang', '2023-09-12 08:30:56', 'MAGANG-120923083056'),
(310, 'Cat', '2023-09-12', '2023-10-12', 155, 'magang', '2023-09-12 07:19:47', 'MAGANG-120923071947'),
(309, 'Cukik', '2023-09-12', '2023-10-12', 155, 'magang', '2023-09-12 07:19:47', 'MAGANG-120923071947'),
(308, 'Kape', '2023-09-12', '2023-10-12', 155, 'magang', '2023-09-12 07:19:47', 'MAGANG-120923071947'),
(313, 'Sentot', '2023-09-12', '2023-09-30', 157, 'magang', '2023-09-12 15:43:50', 'MAGANG-120923034350'),
(314, 'Yoa', '2023-09-12', '2023-09-30', 157, 'magang', '2023-09-12 15:43:50', 'MAGANG-120923034350'),
(315, 'Suroyo', '2023-09-12', '2023-09-30', 157, 'magang', '2023-09-12 15:43:50', 'MAGANG-120923034350'),
(316, 'Samid', '2023-09-13', '2023-09-13', 158, 'tidak', '2023-09-13 01:27:41', 'MAGANG-130923012741'),
(317, 'Heru', '2023-09-13', '2023-09-13', 158, 'tidak', '2023-09-13 01:27:41', 'MAGANG-130923012741'),
(318, 'Yani', '2023-09-13', '2023-09-13', 158, 'tidak', '2023-09-13 01:27:41', 'MAGANG-130923012741'),
(319, 'Hotman', '2023-09-13', '2023-09-13', 158, 'tidak', '2023-09-13 01:27:41', 'MAGANG-130923012741'),
(320, 'Manto', '2023-09-13', '2023-09-30', 159, 'tidak', '2023-09-13 12:58:59', 'MAGANG-130923125859'),
(321, 'Toyip', '2023-09-13', '2023-09-30', 159, 'tidak', '2023-09-13 12:58:59', 'MAGANG-130923125859'),
(322, 'Naruto', '2023-09-13', '2023-09-30', 159, 'tidak', '2023-09-13 12:58:59', 'MAGANG-130923125859'),
(323, 'Avatar', '2023-09-13', '2023-09-30', 159, 'tidak', '2023-09-13 12:58:59', 'MAGANG-130923125859'),
(324, 'G', '2023-09-14', '2023-09-27', 160, 'tidak', '2023-09-14 02:17:33', 'MAGANG-140923021733'),
(325, 'a', '2023-09-14', '2023-09-27', 160, 'tidak', '2023-09-14 02:17:33', 'MAGANG-140923021733'),
(326, 'b', '2023-09-14', '2023-09-27', 160, 'tidak', '2023-09-14 02:17:33', 'MAGANG-140923021733'),
(327, 'r', '2023-09-14', '2023-09-27', 160, 'tidak', '2023-09-14 02:17:33', 'MAGANG-140923021733'),
(328, 'i', '2023-09-14', '2023-09-27', 160, 'tidak', '2023-09-14 02:17:33', 'MAGANG-140923021733'),
(329, 'l', '2023-09-14', '2023-09-27', 160, 'tidak', '2023-09-14 02:17:33', 'MAGANG-140923021733');

-- --------------------------------------------------------

--
-- Table structure for table `sahabat_bc`
--

CREATE TABLE `sahabat_bc` (
  `id` int(11) NOT NULL,
  `nama` text NOT NULL,
  `asal` text NOT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sahabat_bc`
--

INSERT INTO `sahabat_bc` (`id`, `nama`, `asal`, `foto`) VALUES
(46, 'Abdu Rahman Widyanto', 'D3 Manajemen Perusahaan Universitas Jember', 'abdu.png'),
(47, 'Alfina Damayanti', 'D3 Akuntansi PKN STAN', 'alfina_d.png'),
(48, 'Bobby Rizky Priyono', 'D3 Akuntansi PKN STAN', 'bobby_r.png'),
(49, 'Cindy Nursita Pramesti', 'D3 Administrasi Keuangan Universitas Jember', 'cindy_n.png'),
(50, 'Deffa Reyhandika Hermawan', 'S1 Manajemen Universitas Jember', 'deffa_r.png'),
(51, 'Dewa Maulana Malik Ibrahim', 'D3 Manajemen Perusahaan Universitas Jember', 'dewa_m.png'),
(52, 'Gilang Ramadhan Adi Pratama', 'D3 Manajemen Perusahaan Universitas Jember', 'gilang_r.png'),
(53, 'Dewa Maulana Malik Ibrahim', 'D3 Manajemen Perusahaan Universitas Jember', 'dewa_m.png'),
(54, 'Gladin Eka Anggraini', 'S1 IESP Universitas Jember', 'gladin_e.png'),
(55, 'Luthfi Baidlowi', 'D3 Perbendaharaan PKN STAN', 'luthfi_b.png'),
(56, 'Muhammad Dicqi Alfan Habibi', 'S1 Teknologi Informasi Universitas Jember', 'm_dicqi.png'),
(57, 'Mohammad Dito Pratama', 'S1 Manajemen Universitas Jember', 'm_dito.png'),
(58, 'Mochammad Jafar', 'D3 Akuntansi PKN STAN', 'm_jafar.png'),
(59, 'Marchella Yustin Wardany', 'D3 Akuntansi Universitas Jember', 'marchella_y.png'),
(61, 'Nisa Aqilah Aushaf', 'D3 Akuntansi PKN STAN', 'nisa_a.png'),
(62, 'Nafisah Kholifatul Jannah', 'S1 Teknologi Informasi Universitas Jember', 'nafisah_k.png'),
(63, 'Sarifah Ambami Diah P', 'S1 Administrasi Negara Universitas Jember', 'sarifah_a.png'),
(64, 'Septia Dwi Wulandari', 'D3 Administrasi Keuangan Universitas Jember', 'septia_d.png'),
(65, 'Shafa Prasetyaning Putri', 'D3 Akuntansi Universitas Jember', 'shafa_f.png'),
(66, 'Sofa Rinda Eka Mei Nisa', 'D3 Akuntansi PKN STAN', 'sofa_r.png'),
(67, 'Tasya Anggita Febriyanti', 'D3 Akuntansi PKN STAN', 'tasya_a.png'),
(68, 'Wima Agung Kurniawan', 'S1 IESP Universitas Jember', 'wima_a.png'),
(69, 'Zenitha Soraya Tri Yastynda', 'S1 IESP Universitas Jember', 'zenitha_s.png');

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(128) NOT NULL,
  `person_in_charge` varchar(64) NOT NULL,
  `members` varchar(2048) NOT NULL,
  `phone_number` varchar(32) NOT NULL,
  `agency` varchar(128) NOT NULL,
  `goal` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `proposal_link` varchar(256) NOT NULL,
  `cover_letter_link` varchar(256) NOT NULL,
  `task` varchar(255) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `attachment_link` varchar(256) DEFAULT NULL,
  `status` enum('processed','accepted','rejected') DEFAULT NULL,
  `email_sent` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('operator','panitia') NOT NULL DEFAULT 'operator',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mas Operator', 'operator@gmail.com', NULL, '$2y$10$MoroIFSQ5phVJZ5jb3mqnuukAERmda/VpJeXIVllmn6.3tvuUuU.i', 'operator', NULL, '2023-09-03 18:51:26', '2023-09-03 18:51:26'),
(2, 'Mas Panitia', 'panitia@gmail.com', NULL, '$2y$10$I6/kLPPajnro0zju0O.a8u5k9Ifc1cTtHyoWZ7dlJegqnakxu6RjW', 'panitia', NULL, '2023-09-03 18:51:26', '2023-09-03 18:51:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD PRIMARY KEY (`id_daftar`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indexes for table `sahabat_bc`
--
ALTER TABLE `sahabat_bc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pendaftar`
--
ALTER TABLE `pendaftar`
  MODIFY `id_daftar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id_peserta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=330;

--
-- AUTO_INCREMENT for table `sahabat_bc`
--
ALTER TABLE `sahabat_bc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
