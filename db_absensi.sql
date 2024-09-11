-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2024 at 05:24 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensi`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `id_absensi` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `tgl_absen` date NOT NULL,
  `absen_masuk` varchar(10) NOT NULL,
  `absen_pulang` varchar(10) NOT NULL,
  `terlambat` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `selesai` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nik_admin` varchar(20) NOT NULL,
  `nuptk` varchar(20) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `induk` varchar(5) NOT NULL,
  `tmt` date NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nik_admin`, `nuptk`, `nama_admin`, `jk`, `id_jabatan`, `id_jurusan`, `induk`, `tmt`, `img`) VALUES
(11, '3216091711870010', '-', 'Salman Yudistira', 'L', 16, 12, 'Ya', '2008-07-17', 'profile-admin.png');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id_guru` int(11) NOT NULL,
  `nik_guru` varchar(20) NOT NULL,
  `nuptk` varchar(20) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `mata_pelajaran` varchar(100) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `induk` varchar(5) NOT NULL,
  `tmt` varchar(5) NOT NULL,
  `img` varchar(255) NOT NULL,
  `tlp_guru` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id_guru`, `nik_guru`, `nuptk`, `nama_guru`, `jk`, `id_jabatan`, `mata_pelajaran`, `id_jurusan`, `induk`, `tmt`, `img`, `tlp_guru`) VALUES
(30, '3576014403910003', '-', 'Maulidya Hanifah', 'P', 4, 'Bahasa Indonesia, Bahasa Inggris ', 17, 'Ya', '2020', 'my_prof.jpeg', '082125664280');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Guru'),
(4, 'Kepala Sekolah'),
(5, 'Wk. Kurikulum'),
(6, 'Guru / Wali Kelas 7-2'),
(7, 'Guru / Wali Kelas 8-1'),
(8, 'Guru / Wali Kelas 9-3'),
(9, 'Guru / Wali Kelas 7-1'),
(10, 'Guru / Wali Kelas 9-1'),
(11, 'Guru / Wali Kelas 8-3'),
(12, 'Guru / Wali Kelas 7-3'),
(13, 'Guru / Wali Kelas 8-2'),
(14, 'Guru / Wali Kelas 9-2'),
(15, 'Piket'),
(16, 'Ka. Tata Usaha'),
(17, 'Staff Tata Usaha'),
(18, 'Bendahara'),
(23, 'Guru Pramuka'),
(24, 'Guru Piket');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(11) NOT NULL,
  `hari` varchar(20) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_istirahat` time NOT NULL,
  `jam_pulang` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `hari`, `jam_masuk`, `jam_istirahat`, `jam_pulang`) VALUES
(5, 'Senin', '07:30:00', '12:00:00', '15:00:00'),
(6, 'Selasa', '07:30:00', '12:00:00', '15:00:00'),
(7, 'Rabu', '07:30:00', '12:00:00', '13:00:00'),
(8, 'Kamis', '07:30:00', '12:00:00', '15:00:00'),
(9, 'Jumat', '07:30:00', '11:30:00', '15:00:00'),
(12, 'Sabtu', '00:00:00', '00:00:00', '00:00:00'),
(13, 'Minggu', '00:00:00', '00:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'IPA Fisika'),
(3, 'Aqidah Filsafat Islam'),
(4, 'Bimbingan Konseling'),
(5, 'Matematika'),
(6, 'Sosiologi'),
(7, 'Sastra Arab'),
(8, 'PAI'),
(12, 'Sistem Informasi'),
(13, 'Ekonomi'),
(14, 'Psikologi'),
(15, 'Bina Pendidikan & Konseling'),
(16, 'Bahasa Indonesia'),
(17, 'Bahasa Inggris'),
(18, 'Komputer'),
(19, 'Penjas'),
(20, 'IPA Bilogi'),
(21, 'Sastra Inggris'),
(22, 'Administrasi Perkantoran'),
(23, 'Administrasi Penjualan'),
(24, 'Pendidikan Ekonomi');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(11) NOT NULL,
  `nik_karyawan` varchar(20) NOT NULL,
  `nuptk` varchar(20) NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `mata_pelajaran` varchar(100) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `induk` varchar(5) NOT NULL,
  `tmt` date NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `id_kegiatan` int(11) NOT NULL,
  `kegiatan` varchar(100) NOT NULL,
  `date_add` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`id_kegiatan`, `kegiatan`, `date_add`) VALUES
(10, 'HUT RI ke-79', '2024-08-17');

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran`
--

CREATE TABLE `pelajaran` (
  `id_mata_pelajaran` int(11) NOT NULL,
  `nama_pelajaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pelajaran`
--

INSERT INTO `pelajaran` (`id_mata_pelajaran`, `nama_pelajaran`) VALUES
(19, 'PPKn'),
(20, 'IPA Fisika'),
(21, 'BK'),
(22, 'Matematika'),
(23, 'IPS'),
(24, 'Libat K3.2'),
(25, 'Bahasa Indonesia'),
(26, 'Libat K1'),
(27, 'Matematika OSN'),
(28, 'Seni Budaya'),
(29, 'Bahasa Inggris '),
(30, 'IPA Biologi'),
(31, 'Prakarya'),
(32, 'PAI'),
(33, 'Libat K3.2/K3.1/K3.2'),
(34, 'Tikom'),
(35, 'PJOK'),
(36, 'English Conversation'),
(37, 'IPA OSN'),
(38, 'BK/BP Kelas 9'),
(39, 'BK/BP Kelas 7'),
(40, 'Pramuka'),
(41, 'Informatika'),
(42, 'Staff TU');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `id_user` int(11) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL,
  `status_active` int(11) NOT NULL,
  `status_aktivasi` int(11) NOT NULL,
  `log_datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`id_user`, `nik`, `password`, `role`, `status_active`, `status_aktivasi`, `log_datetime`) VALUES
(34, '3216091711870010', 'YWRtaW4=', 'ROL001', 0, 1, '2024-08-26 10:03:00'),
(45, '3576014403910003', 'QXVsbDEyMw==', 'ROL002', 1, 1, '2024-08-26 10:03:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`id_absensi`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id_guru`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`);

--
-- Indexes for table `pelajaran`
--
ALTER TABLE `pelajaran`
  ADD PRIMARY KEY (`id_mata_pelajaran`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `id_absensi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id_guru` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `id_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pelajaran`
--
ALTER TABLE `pelajaran`
  MODIFY `id_mata_pelajaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
