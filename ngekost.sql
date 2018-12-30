-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2018 at 03:24 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngekost`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `batasan` varchar(100) NOT NULL,
  `password` char(32) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('P','L') NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `batasan`, `password`, `alamat`, `jenis_kelamin`, `no_hp`, `aktif`) VALUES
('admin', 'Elyas Dwi Maryanto', 'elyasdwimaryanto27@gmail.com', '', '21232f297a57a5a743894a0e4a801fc3', 'Tulang Bawang Barat, Lampung.', 'L', '085368499312', 1),
('superadmin', 'Super Administrator', 'superadmin@infokos.net', 'super admin', '21232f297a57a5a743894a0e4a801fc3', 'Bandung', 'L', '085727355168', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_rekening` varchar(100) NOT NULL,
  `nama_nasabah` varchar(100) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `nama`, `no_rekening`, `nama_nasabah`, `aktif`) VALUES
(8, 'BRI', '1615061005', 'Elyas Dwi M', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `nama`, `keterangan`) VALUES
(1, 'kasur', ''),
(2, 'lemari pakaian', ''),
(3, 'meja', ''),
(4, 'kamar mandi dalam', ''),
(5, 'AC', ''),
(6, 'kipas angin', ''),
(12, 'ruang tamu', '<p>ruangan tamunya luas</p>'),
(16, 'wifi', ''),
(18, 'dapur', ''),
(20, 'kulkas', ''),
(21, 'TV', ''),
(25, 'parkir motor ', ''),
(26, 'parkir mobil', '');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_kost`
--

CREATE TABLE `fasilitas_kost` (
  `id` int(11) NOT NULL,
  `kost_id` int(11) NOT NULL,
  `fasilitas_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fasilitas_kost`
--

INSERT INTO `fasilitas_kost` (`id`, `kost_id`, `fasilitas_id`) VALUES
(156, 25, 18),
(155, 25, 16),
(154, 25, 6),
(153, 25, 3),
(152, 25, 1),
(151, 23, 25),
(150, 23, 18),
(149, 23, 5),
(148, 23, 4),
(147, 23, 3),
(146, 23, 2),
(145, 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gambar_kamar`
--

CREATE TABLE `gambar_kamar` (
  `id` int(11) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `type` enum('cover','gallery') NOT NULL,
  `kamar_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gambar_kamar`
--

INSERT INTO `gambar_kamar` (`id`, `lokasi`, `keterangan`, `type`, `kamar_id`, `aktif`) VALUES
(48, '2018-12-12++18-49-53_773864_1.png', '', 'cover', 119, 1),
(47, '2018-12-12++18-48-28_164337_2.png', '', 'cover', 118, 1),
(46, '2018-12-12++18-47-21_422363_2.png', '', 'cover', 117, 1),
(45, '2018-12-12++18-41-53_692413_1.png', '', 'cover', 116, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gambar_kost`
--

CREATE TABLE `gambar_kost` (
  `id` int(11) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `type` enum('cover','gallery') NOT NULL,
  `kost_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gambar_kost`
--

INSERT INTO `gambar_kost` (`id`, `lokasi`, `keterangan`, `type`, `kost_id`, `aktif`) VALUES
(63, '2018-12-12++18-44-11_474670_2.png', '', 'cover', 24, 1),
(64, '2018-12-12++18-46-56_334564_2.png', '', 'cover', 25, 1),
(62, '2018-12-12++18-34-27_634155_1.png', '', 'cover', 23, 1);

-- --------------------------------------------------------

--
-- Table structure for table `harga_kamar`
--

CREATE TABLE `harga_kamar` (
  `id` int(11) NOT NULL,
  `kamar_id` int(11) NOT NULL,
  `periode_id` int(11) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `type` enum('bulan','6 bulan','tahun') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harga_kamar`
--

INSERT INTO `harga_kamar` (`id`, `kamar_id`, `periode_id`, `jumlah_orang`, `harga`, `type`) VALUES
(148, 119, 18, 1, 5000000, 'bulan'),
(147, 118, 18, 1, 5500000, 'bulan'),
(146, 117, 18, 1, 5500000, 'bulan'),
(145, 116, 18, 1, 5000000, 'tahun');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis` enum('P','L') NOT NULL,
  `status` enum('kosong','isi') NOT NULL,
  `kost_id` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id`, `nama`, `jenis`, `status`, `kost_id`, `keterangan`) VALUES
(119, 'Dahlia 2', 'L', 'isi', 23, ''),
(118, 'Telaga 2', 'P', 'kosong', 25, ''),
(117, 'Telaga 1', 'P', 'kosong', 25, ''),
(116, 'Dahlia 1', 'L', 'kosong', 23, '');

-- --------------------------------------------------------

--
-- Table structure for table `kost`
--

CREATE TABLE `kost` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `pemilik_id` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kost`
--

INSERT INTO `kost` (`id`, `nama`, `alamat`, `pemilik_id`, `keterangan`, `aktif`) VALUES
(23, 'Dahlia', 'Jalan Bumi Manti 1', 'elyasdwimaryanto', '', 1),
(25, 'Telaga', 'Jalan Bumi Manti 4', 'Indah', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ktp` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('P','L') NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `kampus` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `email`, `ktp`, `password`, `alamat`, `jenis_kelamin`, `no_hp`, `kampus`, `photo`, `aktif`) VALUES
(9, 'Elyas Dwi Maryanto', 'elyasdwimaryanto27@gmail.com', '1615061005', '3735daaf130435a8bf77dcf01ff79e37', 'eeee', 'L', '085368499312', 'unila', '675262_Elyas Dwi Maryanto.JPG', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `pemesanan_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `kode_transfer` varchar(100) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `type` enum('DP','lunas','cicilan') NOT NULL,
  `konfirmasi` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `pemesanan_id`, `jumlah`, `tanggal`, `tgl_transaksi`, `kode_transfer`, `bank_id`, `type`, `konfirmasi`) VALUES
(8, 10, 5000000, '2018-12-23', '2018-12-12 18:57:19', '111111111', 8, 'lunas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `harga_kamar_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `batas_akhir` datetime NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  `pelanggan_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `tgl_masuk`, `tgl_keluar`, `harga_kamar_id`, `tanggal`, `batas_akhir`, `aktif`, `pelanggan_id`) VALUES
(10, '2018-12-22', '2019-01-21', 148, '2018-12-12 18:55:11', '2018-12-14 18:55:11', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE `pemilik` (
  `id` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` char(32) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('P','L') NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`id`, `nama`, `email`, `password`, `alamat`, `jenis_kelamin`, `no_hp`, `aktif`) VALUES
('Indah', 'Indah Amalia', 'indahamalia@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'Serang Banten', 'P', '085841489157', 1),
('elyasdwimaryanto', 'Elyas Dwi Maryanto', 'elyasdwimaryanto27@gmail.com', '3735daaf130435a8bf77dcf01ff79e37', '', 'L', '085368499312', 1);

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `nama`, `aktif`) VALUES
(20, '201702018', 0),
(19, '2016-2017', 0),
(18, '2015-2016', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fasilitas_kost`
--
ALTER TABLE `fasilitas_kost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gambar_kamar`
--
ALTER TABLE `gambar_kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gambar_kost`
--
ALTER TABLE `gambar_kost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `harga_kamar`
--
ALTER TABLE `harga_kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kost`
--
ALTER TABLE `kost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fasilitas`
--
ALTER TABLE `fasilitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `fasilitas_kost`
--
ALTER TABLE `fasilitas_kost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `gambar_kamar`
--
ALTER TABLE `gambar_kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `gambar_kost`
--
ALTER TABLE `gambar_kost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `harga_kamar`
--
ALTER TABLE `harga_kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `kost`
--
ALTER TABLE `kost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
