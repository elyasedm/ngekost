-- phpMyAdmin SQL Dump
-- version 2.11.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 13, 2015 at 05:43 PM
-- Server version: 5.0.45
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `movus_infokost`
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
  `aktif` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `email`, `batasan`, `password`, `alamat`, `jenis_kelamin`, `no_hp`, `aktif`) VALUES
('admin', 'Admin', 'admin@infokos.net', '', '21232f297a57a5a743894a0e4a801fc3', 'Bandung', 'L', '085727355168', 1),
('superadmin', 'Super Administrator', 'superadmin@infokos.net', 'super admin', '21232f297a57a5a743894a0e4a801fc3', 'Bandung', 'L', '085727355168', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(11) NOT NULL auto_increment,
  `nama` varchar(100) NOT NULL,
  `no_rekening` varchar(100) NOT NULL,
  `nama_nasabah` varchar(100) NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `nama`, `no_rekening`, `nama_nasabah`, `aktif`) VALUES
(1, 'BRI', '168001000300502', 'Ary Hidayatullah', 1),
(2, 'BNI', '0153654006', 'Ary Hidayatullah', 1),
(5, 'Mandiri', '3688890189', 'Ary Hidayatullah', 1),
(6, 'BCA', '22110987389', 'Ary Hidayatullah', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id` int(11) NOT NULL auto_increment,
  `nama` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

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
(7, 'internet', '<p>Rp. 50.000,-/bulan</p>'),
(8, 'bebas uang listrik', ''),
(9, 'bebas uang air', ''),
(10, 'laundry', ''),
(11, 'karpet', ''),
(12, 'ruang tamu', '<p>ruangan tamunya luas</p>'),
(13, 'tempat jemur pakaian', ''),
(14, 'taman', ''),
(15, 'air panas untuk mandi', ''),
(16, 'wifi', ''),
(18, 'dapur', ''),
(20, 'kulkas', ''),
(21, 'TV', ''),
(22, 'telepon', ''),
(23, 'kamar mandi di luar', ''),
(24, 'kolom renang', ''),
(25, 'parkir motor ', ''),
(26, 'parkir mobil', '');

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas_kost`
--

CREATE TABLE `fasilitas_kost` (
  `id` int(11) NOT NULL auto_increment,
  `kost_id` int(11) NOT NULL,
  `fasilitas_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=119 ;

--
-- Dumping data for table `fasilitas_kost`
--

INSERT INTO `fasilitas_kost` (`id`, `kost_id`, `fasilitas_id`) VALUES
(57, 1, 18),
(56, 1, 16),
(55, 1, 13),
(54, 1, 12),
(53, 1, 9),
(52, 1, 8),
(51, 1, 7),
(50, 1, 4),
(49, 1, 3),
(48, 1, 2),
(47, 1, 1),
(58, 17, 1),
(59, 17, 2),
(60, 17, 3),
(61, 17, 5),
(62, 17, 6),
(63, 17, 7),
(64, 17, 9),
(65, 17, 10),
(66, 17, 11),
(67, 17, 13),
(68, 17, 14),
(69, 17, 15),
(70, 17, 18),
(71, 17, 19),
(84, 18, 14),
(83, 18, 10),
(82, 18, 9),
(81, 18, 6),
(80, 18, 5),
(79, 18, 1),
(78, 19, 1),
(99, 5, 23),
(98, 5, 21),
(97, 5, 12),
(96, 5, 7),
(95, 5, 3),
(94, 5, 2),
(93, 5, 1),
(100, 20, 1),
(101, 20, 5),
(102, 20, 9),
(103, 21, 1),
(104, 21, 2),
(105, 21, 4),
(106, 21, 5),
(107, 21, 7),
(108, 21, 9),
(109, 21, 25),
(110, 22, 1),
(111, 22, 4),
(112, 22, 5),
(113, 22, 7),
(114, 22, 13),
(115, 22, 18),
(116, 22, 24),
(117, 22, 25),
(118, 22, 26);

-- --------------------------------------------------------

--
-- Table structure for table `gambar_kamar`
--

CREATE TABLE `gambar_kamar` (
  `id` int(11) NOT NULL auto_increment,
  `lokasi` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `type` enum('cover','gallery') NOT NULL,
  `kamar_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `gambar_kamar`
--

INSERT INTO `gambar_kamar` (`id`, `lokasi`, `keterangan`, `type`, `kamar_id`, `aktif`) VALUES
(1, '2012-11-19 20:45:52_801640_18.jpg', '', 'gallery', 1, 1),
(2, '2012-11-23++13-06-54_444061_IMAG0084.jpg', '<p>gambar pintu kamar</p>', 'gallery', 17, 1),
(3, '2012-11-23++13-07-24_645355_b12.jpg', '<p>gambar pintu kamar</p>', 'gallery', 16, 1),
(4, '2012-11-23++13-07-49_795043_b11.jpg', '<p>gambar pintu kamar</p>', 'gallery', 15, 1),
(5, '2012-11-23++13-10-40_173583_IMAG0081 - J.jpg', '<p>gambar pintu kamar</p>', 'gallery', 14, 1),
(6, '2012-11-23++13-11-26_422393_IMAG0081 - I.jpg', '<p>gambar pintu kamar</p>\r\n<p>&nbsp;</p>', 'gallery', 13, 1),
(7, '2012-11-23++13-11-49_777038_IMAG0081 - H.jpg', '<p>gambar pintu kamar</p>', 'gallery', 12, 1),
(8, '2012-11-23++13-12-33_474029_IMAG0083.jpg', '<p>gambar pintu kamar</p>', 'gallery', 11, 1),
(9, '2012-11-23++13-13-44_980194_IMAG0079.jpg', '<p>gambar pintu kamar</p>', 'gallery', 5, 1),
(10, '2012-11-23++13-14-07_467834_IMAG0078.jpg', '<p>gambar pintu kamar</p>', 'gallery', 6, 1),
(11, '2012-11-23++13-15-18_89447_IMAG0077.jpg', '<p>gambar pintu kamar</p>', 'gallery', 8, 1),
(12, '2012-11-23++13-15-45_204589_IMAG0076.jpg', '<p>gambar pintu kamar</p>', 'gallery', 9, 1),
(14, '2012-11-23++16-52-12_227935_alur ringkas PA.jpg', '<p>drggdfgdfgdf</p>', 'gallery', 42, 1),
(21, '2012-11-24++16-28-07_115600_07072010162.jpg', '<p>gambar pintu kamar&nbsp;</p>', 'gallery', 48, 1),
(19, '2012-11-24++16-24-48_750915_07072010162 - Copy.jpg', '<p>gambar pintu kamar&nbsp;</p>', 'gallery', 44, 1),
(20, '2012-11-24++16-27-08_507781_07072010162 - Copy (2).jpg', '<p>gambar pintu kamar&nbsp;</p>', 'gallery', 45, 1),
(22, '2012-11-24++16-28-32_289703_07072010163.jpg', '<p>gambar pintu kamar&nbsp;</p>', 'gallery', 49, 1),
(23, '2012-11-24++16-29-22_751281_07072010162 5 .jpg', '<p>gambar pintu kamar&nbsp;</p>', 'gallery', 50, 1),
(24, '2012-11-24++17-41-13_854736_CameraZOOM-20120527170042.jpg', '<p>Pintu kamar kosan</p>', 'gallery', 74, 1),
(25, '2012-11-24++17-43-52_48034_CameraZOOM-20120527170125.jpg', '<p>Pintu kamar&nbsp;</p>', 'gallery', 75, 1),
(26, '2012-11-25++16-07-17_762939_IMAG0067.jpg', '<p>pintu kamar</p>', 'gallery', 81, 1),
(27, '2012-11-25++16-08-12_912139_IMAG0067.jpg', '<p>pintu kamar kosan</p>', 'gallery', 82, 1),
(28, '2012-11-25++16-08-28_409362_IMAG0067.jpg', '', 'gallery', 82, 1),
(29, '2012-11-25++16-08-43_153533_IMAG0068.jpg', '<p>pintu kamar&nbsp;</p>', 'gallery', 83, 1),
(30, '2012-11-25++16-09-14_877563_IMAG0068.jpg', '<p>pintu kamar&nbsp;</p>', 'gallery', 83, 1),
(31, '2012-11-25++16-09-37_218658_IMAG0068.jpg', '<p>pintu kamar&nbsp;</p>', 'gallery', 84, 1),
(32, '2012-11-25++16-09-48_382385_IMAG0068.jpg', '<p>pintu kamar&nbsp;</p>', 'gallery', 84, 1),
(33, '2012-11-25++16-10-18_525482_IMAG0070.jpg', '<p>pintu kamar&nbsp;</p>', 'gallery', 85, 1),
(40, '2012-11-25++16-16-37_849609_IMAG0071.jpg', '<p>pintu depan kamar 2</p>', 'gallery', 87, 1),
(35, '2012-11-25++16-13-18_90270_IMAG0070.jpg', '<p>pintu depan kamar</p>', 'gallery', 86, 1),
(36, '2012-11-25++16-13-35_747528_IMAG0070.jpg', '<p>pintu depan kamar 2</p>', 'gallery', 86, 1),
(37, '2012-11-25++16-13-52_960723_IMAG0071.jpg', '<p>pintu depan kamar</p>', 'gallery', 87, 1),
(38, '2012-11-25++16-14-15_830017_IMAG0071.jpg', '<p>pintu depan kamar</p>', 'gallery', 88, 1),
(39, '2012-11-25++16-14-29_629852_IMAG0071.jpg', '<p>pintu depan kamar 2</p>', 'gallery', 88, 1),
(41, '2012-11-25++16-18-24_984161_IMAG0067.jpg', '<p>pintu depan kamar 2</p>', 'gallery', 81, 1),
(42, '2012-11-25++16-57-19_497924_IMAG0092.jpg', '<p>pintu kamar&nbsp;</p>', 'cover', 89, 1),
(43, '2012-11-25++17-01-32_102966_IMAG0099.jpg', '<p>dalam kamar&nbsp;</p>', 'gallery', 89, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gambar_kost`
--

CREATE TABLE `gambar_kost` (
  `id` int(11) NOT NULL auto_increment,
  `lokasi` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `type` enum('cover','gallery') NOT NULL,
  `kost_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `gambar_kost`
--

INSERT INTO `gambar_kost` (`id`, `lokasi`, `keterangan`, `type`, `kost_id`, `aktif`) VALUES
(6, '2012-11-23++12-48-22_9277_IMAG0072.jpg', '<p>Gambar kosan dari depan&nbsp;</p>', 'cover', 1, 1),
(7, '2012-11-23++12-48-50_637969_IMAG0073.jpg', '<p>Gambar kosan depan sebelah kanan</p>', 'gallery', 1, 1),
(8, '2012-11-23++12-49-22_52062_IMAG0074.jpg', '<p>Gambar kosan depan sebelah kiri</p>', 'gallery', 1, 1),
(9, '2012-11-23++12-49-58_899841_IMAG0080.jpg', '<p>Tangga menuju lantai atas.</p>', 'gallery', 1, 1),
(10, '2012-11-23++12-50-25_265380_IMAG0075.jpg', '<p>Ruang tamu</p>', 'gallery', 1, 1),
(11, '2012-11-23++12-50-52_988250_IMAG0085.jpg', '<p>tempat cuci tanggan</p>', 'gallery', 1, 1),
(13, '2012-11-23++13-32-16_428253_IMAG0041.jpg', '<p>Gambar kosan tampak dari depan</p>', 'cover', 3, 1),
(14, '2012-11-23++13-32-31_415710_IMAG0042.jpg', '<p>dapur kosan</p>', 'gallery', 3, 1),
(15, '2012-11-23++13-32-54_2807_IMAG0043.jpg', '<p>lantai dasar</p>', 'gallery', 3, 1),
(16, '2012-11-23++13-33-29_745269_IMAG0052.jpg', '<p>lantai 1</p>', 'gallery', 3, 1),
(17, '2012-11-23++13-33-59_486694_IMAG0061.jpg', '<p>teras lantai 1</p>', 'gallery', 3, 1),
(18, '2012-11-23++13-34-43_231231_IMAG0062.jpg', '<p>lantai 2 untuk jemur pakaian dan tempat galon air.</p>', 'gallery', 3, 1),
(19, '2012-11-24++16-56-57_560363_07072010150.jpg', '<p>teras depan kamar kosan&nbsp;</p>', 'cover', 4, 1),
(20, '2012-11-24++16-57-23_800140_07072010149.jpg', '<p>taman kosan&nbsp;</p>', 'gallery', 4, 1),
(21, '2012-11-24++16-57-50_795166_07072010153.jpg', '<p>tempat jemur pakaian</p>', 'gallery', 4, 1),
(22, '2012-11-24++16-59-15_707977_07072010157.jpg', '<p>tempat parkir motor dan teras kamar kosan</p>', 'gallery', 4, 1),
(23, '2012-11-24++17-00-01_860198_07072010152.jpg', '<p>filter air dan keran</p>', 'gallery', 4, 1),
(24, '2012-11-24++17-00-27_436889_07072010151.jpg', '<p>Tempat air kosan</p>', 'gallery', 4, 1),
(25, '2012-11-24++17-03-00_937927_IMAG0003.jpg', '<p>Pintu masuk kosan</p>', 'cover', 2, 1),
(26, '2012-11-24++17-03-28_142059_IMAG0001.jpg', '<p>Parkir mobil dan motor</p>', 'gallery', 2, 1),
(27, '2012-11-24++17-04-35_501831_IMAG0006.jpg', '<p>lantai dasar untuk kamar putri</p>', 'gallery', 2, 1),
(28, '2012-11-24++17-04-53_638824_IMAG0005.jpg', '<p>dapur kosan</p>', 'gallery', 2, 1),
(29, '2012-11-24++17-09-36_566741_IMAG0013.jpg', '<p>Lantai 3 untuk kamar kosan putra.</p>', 'gallery', 2, 1),
(30, '2012-11-24++17-12-25_895233_IMAG0019.jpg', '<p>Teras kosan lantai 2 langsung kelihat gedung SMA</p>', 'gallery', 2, 1),
(31, '2012-11-24++17-13-47_924835_IMAG0033.jpg', '<p>Lantai atas untuk jemur pakaian dan view sekeliling kosan</p>', 'gallery', 2, 1),
(32, '2012-11-24++17-42-17_917999_CameraZOOM-20120527170230.jpg', '<p>gambar depan kosan</p>', 'cover', 9, 1),
(33, '2012-11-24++17-46-03_471893_CameraZOOM-20120527172650.jpg', '<p>Pintu gerbang dan halaman kosan</p>', 'cover', 10, 1),
(34, '2012-11-24++17-46-28_578735_CameraZOOM-20120527173502.jpg', '<p>depan kosan</p>', 'gallery', 10, 1),
(35, '2012-11-24++17-46-53_768768_CameraZOOM-20120527173530.jpg', '<p>Dalam kosan</p>', 'gallery', 10, 1),
(36, '2012-11-24++17-47-12_810211_CameraZOOM-20120527173633.jpg', '<p>Dapur kosan</p>', 'gallery', 10, 1),
(37, '2012-11-24++17-47-31_938110_CameraZOOM-20120527173618.jpg', '<p>Kamar mandi kosan</p>', 'gallery', 10, 1),
(38, '2012-11-24++17-48-08_972778_IMAG0066.jpg', '<p>depan kosan</p>', 'cover', 8, 1),
(39, '2012-11-24++17-48-28_847076_IMAG0069.jpg', '<p>dalam kosan</p>', 'gallery', 8, 1),
(40, '2012-11-24++17-48-47_55480_IMAG0067.jpg', '<p>Dalam kosan 2</p>', 'gallery', 8, 1),
(41, '2012-11-24++17-49-19_267913_IMAG0070.jpg', '<p>Lantai atas kosan</p>', 'gallery', 8, 1),
(42, '2012-11-24++17-49-52_282470_CameraZOOM-20120527171930.jpg', '<p>Gerbang kosan</p>', 'cover', 7, 1),
(43, '2012-11-24++17-50-15_541046_CameraZOOM-20120527171127.jpg', '<p>Dalam kosan</p>', 'gallery', 7, 1),
(44, '2012-11-24++17-50-36_960144_CameraZOOM-20120527171203.jpg', '<p>Dalam kosan 2</p>', 'gallery', 7, 1),
(45, '2012-11-24++17-50-56_129943_CameraZOOM-20120527171215.jpg', '<p>Teras kosan lantai 1</p>', 'gallery', 7, 1),
(46, '2012-11-24++17-51-22_646392_CameraZOOM-20120527171518.jpg', '<p>Dapur kosan dilantai atas</p>', 'gallery', 7, 1),
(47, '2012-11-24++17-51-55_188690_CameraZOOM-20120527171456.jpg', '<p>tempat jemur pakaian dan view lantai atas</p>', 'gallery', 7, 1),
(48, '2012-11-24++17-52-55_259368_CameraZOOM-20120528153400.jpg', '<p>Tangga untuk ke kamar kosan</p>', 'cover', 6, 1),
(49, '2012-11-24++17-53-26_726074_CameraZOOM-20120528153101.jpg', '<p>Depan kamar kosan</p>', 'gallery', 6, 1),
(50, '2012-11-24++17-53-47_768829_CameraZOOM-20120528153122.jpg', '<p>Kamar mandi kosan ada 2</p>', 'gallery', 6, 1),
(51, '2012-11-24++17-54-04_986633_CameraZOOM-20120528153139.jpg', '<p>Kamar mandi</p>', 'gallery', 6, 1),
(52, '2012-11-24++17-54-31_163513_CameraZOOM-20120528153316.jpg', '<p>Pintu masuk lantai 2</p>', 'gallery', 6, 1),
(53, '2012-11-24++17-54-45_416351_CameraZOOM-20120528153252.jpg', '<p>Tempat jemuran</p>', 'gallery', 6, 1),
(54, '2012-11-24++17-55-39_230926_IMAG0088.jpg', '<p>Dalam kosan</p>', 'cover', 5, 1),
(55, '2012-11-24++17-55-52_688354_IMAG0090.jpg', '<p>Dapur kosan</p>', 'gallery', 5, 1),
(56, '2012-11-24++17-56-13_709594_IMAG0100.jpg', '<p>Pintu teras kosan lantai 1</p>', 'gallery', 5, 1),
(57, '2012-11-24++17-56-28_469879_IMAG0101.jpg', '<p>Teras kosan&nbsp;</p>', 'gallery', 5, 1),
(58, '2012-11-24++17-57-26_910064_IMAG0102.jpg', '<p>teras kosan 2</p>', 'gallery', 5, 1),
(59, '2012-11-24++17-57-37_739807_IMAG0103.jpg', '<p>lantai atas kosan</p>', 'gallery', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `gambar_tempat`
--

CREATE TABLE `gambar_tempat` (
  `id` int(11) NOT NULL auto_increment,
  `lokasi` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `type` enum('cover','gallery') NOT NULL,
  `tempat_id` int(11) NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `gambar_tempat`
--


-- --------------------------------------------------------

--
-- Table structure for table `harga_kamar`
--

CREATE TABLE `harga_kamar` (
  `id` int(11) NOT NULL auto_increment,
  `kamar_id` int(11) NOT NULL,
  `periode_id` int(11) NOT NULL,
  `jumlah_orang` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `type` enum('bulan','6 bulan','tahun') NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=144 ;

--
-- Dumping data for table `harga_kamar`
--

INSERT INTO `harga_kamar` (`id`, `kamar_id`, `periode_id`, `jumlah_orang`, `harga`, `type`) VALUES
(4, 1, 1, 1, 7000000, 'tahun'),
(6, 5, 1, 1, 7000000, 'tahun'),
(7, 6, 1, 1, 7000000, 'tahun'),
(8, 7, 1, 1, 7000000, 'tahun'),
(9, 8, 1, 1, 7000000, 'tahun'),
(10, 9, 1, 1, 7000000, 'tahun'),
(11, 10, 1, 1, 7000000, 'tahun'),
(12, 11, 1, 1, 7000000, 'tahun'),
(13, 12, 1, 1, 7000000, 'tahun'),
(14, 13, 1, 1, 7000000, 'tahun'),
(15, 14, 1, 1, 7000000, 'tahun'),
(16, 15, 1, 1, 7000000, 'tahun'),
(17, 16, 1, 1, 7000000, 'tahun'),
(18, 17, 1, 1, 7000000, 'tahun'),
(19, 30, 1, 1, 7000000, 'bulan'),
(20, 42, 9, 1, 7000000, 'bulan'),
(27, 31, 1, 1, 4000000, 'tahun'),
(23, 45, 1, 1, 4500000, 'tahun'),
(24, 48, 1, 1, 4500000, 'tahun'),
(25, 49, 1, 1, 4500000, 'tahun'),
(26, 50, 1, 1, 4500000, 'tahun'),
(28, 31, 1, 1, 2000000, '6 bulan'),
(29, 32, 1, 1, 4000000, 'tahun'),
(30, 32, 1, 1, 2000000, '6 bulan'),
(31, 33, 1, 1, 4000000, 'tahun'),
(32, 33, 1, 1, 2000000, '6 bulan'),
(33, 34, 1, 1, 2000000, '6 bulan'),
(34, 34, 1, 1, 4000000, 'tahun'),
(35, 35, 1, 1, 4000000, 'tahun'),
(36, 35, 1, 1, 2000000, '6 bulan'),
(37, 36, 1, 1, 4000000, 'tahun'),
(38, 36, 1, 1, 2000000, '6 bulan'),
(39, 37, 1, 1, 4000000, 'tahun'),
(40, 37, 1, 1, 2000000, '6 bulan'),
(41, 38, 1, 1, 4000000, 'tahun'),
(42, 38, 1, 1, 2000000, '6 bulan'),
(43, 40, 1, 1, 4000000, 'tahun'),
(44, 40, 1, 1, 2000000, '6 bulan'),
(45, 41, 1, 1, 4000000, 'tahun'),
(46, 41, 1, 1, 2000000, '6 bulan'),
(47, 65, 1, 1, 5500000, 'tahun'),
(48, 65, 1, 1, 600000, 'bulan'),
(49, 66, 1, 1, 5500000, 'tahun'),
(50, 66, 1, 1, 600000, 'bulan'),
(52, 67, 1, 1, 5500000, 'tahun'),
(53, 67, 1, 1, 600000, 'bulan'),
(54, 68, 1, 1, 5500000, 'tahun'),
(55, 68, 1, 1, 600000, 'bulan'),
(56, 69, 1, 1, 5500000, 'tahun'),
(57, 69, 1, 1, 600000, 'bulan'),
(58, 71, 1, 1, 5500000, 'tahun'),
(59, 71, 1, 1, 600000, 'bulan'),
(60, 72, 1, 1, 5500000, 'tahun'),
(61, 72, 1, 1, 600000, 'bulan'),
(62, 73, 1, 1, 5500000, 'tahun'),
(63, 73, 1, 1, 600000, 'bulan'),
(64, 52, 1, 1, 5500000, 'tahun'),
(65, 52, 1, 1, 600000, 'bulan'),
(66, 61, 1, 1, 5500000, 'tahun'),
(67, 61, 1, 1, 600000, 'bulan'),
(68, 62, 1, 1, 5500000, 'tahun'),
(69, 62, 1, 1, 600000, 'bulan'),
(70, 63, 1, 1, 5500000, 'tahun'),
(71, 63, 1, 1, 600000, 'bulan'),
(72, 64, 1, 1, 5500000, 'tahun'),
(73, 64, 1, 1, 600000, 'bulan'),
(74, 53, 1, 1, 5500000, 'tahun'),
(75, 53, 1, 1, 600000, 'bulan'),
(76, 54, 1, 1, 5500000, 'tahun'),
(77, 54, 1, 1, 600000, 'bulan'),
(78, 55, 1, 1, 5500000, 'tahun'),
(79, 55, 1, 1, 600000, 'bulan'),
(80, 56, 1, 1, 5500000, 'tahun'),
(81, 56, 1, 1, 600000, 'bulan'),
(82, 57, 1, 1, 5500000, 'tahun'),
(83, 57, 1, 1, 600000, 'bulan'),
(84, 58, 1, 1, 5500000, 'tahun'),
(85, 58, 1, 1, 600000, 'bulan'),
(86, 59, 1, 1, 5500000, 'tahun'),
(87, 59, 1, 1, 600000, 'bulan'),
(88, 60, 1, 1, 5500000, 'tahun'),
(89, 60, 1, 1, 600000, 'bulan'),
(90, 70, 1, 1, 5500000, 'tahun'),
(91, 70, 1, 1, 600000, 'bulan'),
(92, 74, 1, 1, 4500000, 'tahun'),
(93, 75, 1, 1, 4000000, 'tahun'),
(98, 77, 1, 1, 3000000, 'tahun'),
(99, 78, 1, 1, 3000000, 'tahun'),
(100, 79, 1, 1, 3000000, 'tahun'),
(97, 76, 1, 1, 3000000, 'tahun'),
(101, 80, 1, 1, 3000000, 'tahun'),
(102, 81, 1, 1, 5000000, 'tahun'),
(103, 82, 1, 1, 5000000, 'tahun'),
(104, 84, 1, 1, 5000000, 'tahun'),
(105, 83, 1, 1, 5000000, 'tahun'),
(106, 85, 1, 1, 5000000, 'tahun'),
(107, 86, 1, 1, 5000000, 'tahun'),
(108, 87, 1, 1, 5000000, 'tahun'),
(109, 88, 1, 1, 5000000, 'tahun'),
(110, 89, 1, 1, 4500000, 'tahun'),
(113, 91, 1, 1, 4500000, 'tahun'),
(112, 90, 1, 1, 4500000, 'tahun'),
(114, 92, 1, 1, 4500000, 'tahun'),
(115, 93, 1, 1, 45, 'tahun'),
(116, 95, 1, 1, 4500000, 'tahun'),
(117, 96, 1, 1, 4500000, 'tahun'),
(118, 97, 1, 1, 3500000, 'tahun'),
(119, 97, 1, 1, 300000, 'bulan'),
(120, 98, 1, 1, 3500000, 'tahun'),
(121, 98, 1, 1, 300000, 'bulan'),
(122, 99, 1, 1, 3500000, 'tahun'),
(123, 99, 1, 1, 300000, 'bulan'),
(124, 100, 1, 1, 3500000, 'tahun'),
(125, 100, 1, 1, 300000, 'bulan'),
(126, 101, 1, 1, 3500000, 'tahun'),
(127, 101, 1, 1, 300000, 'bulan'),
(128, 0, 0, 0, 0, ''),
(129, 102, 1, 1, 7000000, 'tahun'),
(130, 103, 1, 1, 7000000, 'tahun'),
(131, 104, 1, 1, 7000000, 'tahun'),
(132, 105, 1, 1, 7000000, 'tahun'),
(133, 106, 1, 1, 7000000, 'tahun'),
(134, 107, 1, 1, 7000000, 'tahun'),
(135, 108, 1, 1, 7000000, 'tahun'),
(136, 109, 1, 1, 7000000, 'tahun'),
(137, 110, 18, 2, 5000000, 'tahun'),
(138, 111, 18, 1, 6000000, 'bulan'),
(139, 112, 18, 2, 7000000, 'tahun'),
(140, 113, 18, 2, 8000000, 'tahun'),
(141, 114, 18, 2, 8000000, 'tahun'),
(142, 114, 18, 1, 7000000, 'tahun'),
(143, 114, 18, 2, 4000000, '6 bulan');

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id` int(11) NOT NULL auto_increment,
  `nama` varchar(100) NOT NULL,
  `jenis` enum('P','L') NOT NULL,
  `status` enum('kosong','isi') NOT NULL,
  `kost_id` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id`, `nama`, `jenis`, `status`, `kost_id`, `keterangan`) VALUES
(5, 'Baitul Ilmi Putri A', 'P', 'kosong', 1, '<ol>\r\n<li>Ukuran 4x3 meter.</li>\r\n<li>Kamar mandi dalam.</li>\r\n<li>Sirkulasi udara sejuk.</li>\r\n</ol>'),
(6, 'Baitul Ilmi Putri B', 'P', 'kosong', 1, '<ol>\r\n<li>Ukuran 4x3 meter.</li>\r\n<li>Kamar mandi dalam.</li>\r\n<li>Sirkulasi udara sejuk.</li>\r\n</ol>'),
(7, 'Baitul Ilmi Putri C', 'P', 'kosong', 1, '<ol>\r\n<li>Ukuran 4x3 meter.</li>\r\n<li>Kamar mandi dalam.</li>\r\n<li>Sirkulasi udara sejuk.</li>\r\n</ol>'),
(8, 'Baitul Ilmi Putri D', 'P', 'kosong', 1, '<ol>\r\n<li>Ukuran 4x3 meter.</li>\r\n<li>Kamar mandi dalam.</li>\r\n<li>Sirkulasi udara sejuk.</li>\r\n</ol>'),
(9, 'Baitul Ilmi Putri E', 'P', 'kosong', 1, '<ol>\r\n<li>Ukuran 4x3 meter.</li>\r\n<li>Kamar mandi dalam.</li>\r\n<li>Sirkulasi udara sejuk.</li>\r\n</ol>'),
(10, 'Baitul Ilmi Putri F', 'P', 'kosong', 1, '<ol>\r\n<li>Ukuran 4x3 meter.</li>\r\n<li>Kamar mandi dalam.</li>\r\n<li>Sirkulasi udara sejuk.</li>\r\n</ol>'),
(11, 'Baitul Ilmi Putri G', 'P', 'kosong', 1, '<ol>\r\n<li>Ukuran 4x3 meter.</li>\r\n<li>Kamar mandi dalam.</li>\r\n<li>Sirkulasi udara sejuk.</li>\r\n</ol>'),
(12, 'Baitul Ilmi Putri H', 'P', 'kosong', 1, '<ol>\r\n<li>Ukuran 4x3 meter.</li>\r\n<li>Kamar mandi dalam.</li>\r\n<li>Sirkulasi udara sejuk.</li>\r\n</ol>'),
(13, 'Baitul Ilmi Putri I', 'P', 'kosong', 1, '<ol>\r\n<li>Ukuran 4x3 meter.</li>\r\n<li>Kamar mandi dalam.</li>\r\n<li>Sirkulasi udara sejuk.</li>\r\n</ol>'),
(14, 'Baitul Ilmi Putri J', 'P', 'kosong', 1, '<ol>\r\n<li>Ukuran 4x3 meter.</li>\r\n<li>Kamar mandi dalam.</li>\r\n<li>Sirkulasi udara sejuk.</li>\r\n</ol>'),
(15, 'Baitul Ilmi Putri K', 'P', 'kosong', 1, '<ol>\r\n<li>Ukuran 4x3 meter.</li>\r\n<li>Kamar mandi dalam.</li>\r\n<li>Sirkulasi udara sejuk. uuuu sssssssssss</li>\r\n</ol>'),
(53, 'Piter Selly P2', 'P', '', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(31, 'Mutiara A', 'L', 'kosong', 3, '<ol>\r\n<li>Ukuran 3x4 meter</li>\r\n<li>Sirkulasi udara nyaman</li>\r\n<li>Kamar mandi dalam</li>\r\n</ol>'),
(52, 'Piter Selly P1', 'P', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(50, 'Baitul Ilmi Putra E', 'L', 'kosong', 4, '<ol>\r\n<li>Ukuran 4x3 meter</li>\r\n<li>Sirkulasi udara sejuk.</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(48, 'Baitul Ilmi Putra C', 'L', 'kosong', 4, '<ol>\r\n<li>Ukuran 4x3 meter</li>\r\n<li>Sirkulasi udara sejuk.</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(49, 'Baitul Ilmi Putra D', 'L', 'kosong', 4, '<ol>\r\n<li>Ukuran 4x3 meter</li>\r\n<li>Sirkulasi udara sejuk.</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(44, 'Baitul Ilmi Putra A', 'L', 'kosong', 4, '<ol>\r\n<li>Ukuran 4x3 meter</li>\r\n<li>Sirkulasi udara sejuk.</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(45, 'Baitul Ilmi Putra B', 'L', 'kosong', 4, '<ol>\r\n<li>Ukuran 4x3 meter</li>\r\n<li>Sirkulasi udara sejuk.</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(32, 'Mutiara B', 'L', 'kosong', 3, '<ol>\r\n<li>Ukuran 3x4 meter</li>\r\n<li>Sirkulasi udara nyaman</li>\r\n<li>Kamar mandi dalam</li>\r\n</ol>'),
(33, 'Mutiara C', 'L', 'kosong', 3, '<ol>\r\n<li>Ukuran 3x4 meter</li>\r\n<li>Sirkulasi udara nyaman</li>\r\n<li>Kamar mandi dalam</li>\r\n</ol>'),
(34, 'Mutiara D', 'L', 'kosong', 3, '<ol>\r\n<li>Ukuran 3x4 meter</li>\r\n<li>Sirkulasi udara nyaman</li>\r\n<li>Kamar mandi dalam</li>\r\n</ol><ol>\r\n<li>Ukuran 3x4 meter</li>\r\n<li>Sirkulasi udara nyaman</li>\r\n<li>Kamar mandi dalam</li>\r\n</ol>'),
(35, 'Mutiara E', 'L', 'kosong', 3, '<ol>\r\n<li>Ukuran 3x4 meter</li>\r\n<li>Sirkulasi udara nyaman</li>\r\n<li>Kamar mandi dalam</li>\r\n</ol>'),
(36, 'Mutiara F', 'L', 'kosong', 3, '<ol>\r\n<li>Ukuran 3x4 meter</li>\r\n<li>Sirkulasi udara nyaman</li>\r\n<li>Kamar mandi dalam</li>\r\n</ol>'),
(37, 'Mutiara G', 'L', 'kosong', 3, '<ol>\r\n<li>Ukuran 3x4 meter</li>\r\n<li>Sirkulasi udara nyaman</li>\r\n<li>Kamar mandi dalam</li>\r\n</ol>'),
(38, 'Mutiara H', 'L', 'kosong', 3, '<ol>\r\n<li>Ukuran 3x4 meter</li>\r\n<li>Sirkulasi udara nyaman</li>\r\n<li>Kamar mandi dalam</li>\r\n</ol>'),
(39, 'Mutiara I', 'L', 'kosong', 3, '<ol>\r\n<li>Ukuran 3x4 meter</li>\r\n<li>Sirkulasi udara nyaman</li>\r\n<li>Kamar mandi dalam</li>\r\n</ol>'),
(40, 'Mutiara J', 'L', 'kosong', 3, '<ol>\r\n<li>Ukuran 3x4 meter</li>\r\n<li>Sirkulasi udara nyaman</li>\r\n<li>Kamar mandi dalam</li>\r\n</ol>'),
(41, 'Mutiara K', 'L', 'kosong', 3, '<ol>\r\n<li>Ukuran 3x4 meter</li>\r\n<li>Sirkulasi udara nyaman</li>\r\n<li>Kamar mandi dalam</li>\r\n</ol>'),
(54, 'Piter Selly P3', 'P', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(55, 'Piter Selly P4', 'P', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(56, 'Piter Selly P5', 'P', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(57, 'Piter Selly P6', 'P', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(58, 'Piter Selly P7', 'P', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(59, 'Piter Selly P8', 'P', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(60, 'Piter Selly P9', 'L', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(61, 'Piter Selly P10', 'P', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(62, 'Piter Selly P11', 'P', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(63, 'Piter Selly P12', 'P', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(64, 'Piter Selly P13', 'P', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(65, 'Piter Selly L1', 'L', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(66, 'Piter Selly L2', 'L', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(67, 'Piter Selly L3', 'L', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(68, 'Piter Selly L4', 'L', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(69, 'Piter Selly L5', 'L', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(70, 'Piter Selly L6', 'L', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(71, 'Piter Selly L7', 'L', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(72, 'Piter Selly L8', 'L', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(73, 'Piter Selly L9', 'L', 'kosong', 2, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(74, 'Kamar 1', 'L', 'kosong', 9, '<ol>\r\n<li>ukuran kamar 4x4 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(75, 'Kamar 2 ', 'L', 'kosong', 9, '<ol>\r\n<li>kamar ukuran 3x3 meter&nbsp;</li>\r\n<li>lantai 2</li>\r\n</ol>'),
(76, 'Kamar Kosan Ayi 1', 'L', 'kosong', 10, '<p>ukuran 3x3 meter&nbsp;</p>\r\n<p>&nbsp;</p>'),
(77, 'Kamar Kosan Ayi 2', 'L', 'kosong', 10, '<p>ukuran 3x3 meter</p>'),
(78, 'Kamar Kosan Ayi 3', 'L', 'kosong', 10, '<p>ukuran 3x3 meter&nbsp;</p>\r\n<p>&nbsp;</p>'),
(79, 'Kamar Kosan Ayi 4', 'L', 'kosong', 10, '<p>ukuran 3x3 meter&nbsp;</p>\r\n<p>&nbsp;</p>'),
(80, 'Kamar Kosan Ayi 5', 'L', 'kosong', 10, '<p>ukuran 3x3 meter&nbsp;</p>\r\n<p>&nbsp;</p>'),
(81, 'Kamar Kosan Parto 1', 'L', 'kosong', 8, '<p>ukuran kamar 3x3 meter</p>'),
(82, 'Kamar Kosan Parto 2', 'L', 'kosong', 8, '<p>ukuran 3x3 meter</p>'),
(83, 'Kamar Kosan Parto 3', 'L', 'kosong', 8, '<p>ukuran 3x3 meter</p>'),
(84, 'Kamar Kosan Parto 4', 'L', 'kosong', 8, '<p>ukuran 3x3 meter</p>'),
(85, 'Kamar Kosan Parto 5', 'L', 'kosong', 8, '<p>ukuran 3x3 meter</p>'),
(86, 'Kamar Kosan Parto 6', 'L', 'kosong', 8, '<p>ukuran kamar 3x3 meter</p>'),
(87, 'Kamar Kosan Parto 7', 'L', 'kosong', 8, '<p>pintu kamar&nbsp;</p>'),
(88, 'Kamar Kosan Parto 8', 'L', 'kosong', 8, '<p>pintu kamar&nbsp;</p>'),
(89, 'Rina 1', 'L', 'kosong', 5, '<ol>\r\n<li>ukuran kamar 3x4 meter&nbsp;</li>\r\n<li>kamar mandi didalam&nbsp;</li>\r\n<li>sirkulasi udara nyaman</li>\r\n</ol>'),
(90, 'Rina 2', 'L', 'kosong', 5, '<ol>\r\n<li>ukuran kamar 3x4 meter&nbsp;</li>\r\n<li>kamar mandi didalam&nbsp;</li>\r\n<li>sirkulasi udara nyaman</li>\r\n</ol>'),
(91, 'Rina 3', 'L', 'kosong', 5, '<ol>\r\n<li>ukuran kamar 3x4 meter&nbsp;</li>\r\n<li>kamar mandi didalam&nbsp;</li>\r\n<li>sirkulasi udara nyaman</li>\r\n</ol>'),
(92, 'Rina 4', 'L', 'kosong', 5, '<ol>\r\n<li>ukuran kamar 3x4 meter&nbsp;</li>\r\n<li>kamar mandi didalam&nbsp;</li>\r\n<li>sirkulasi udara nyaman</li>\r\n</ol>'),
(93, 'Rina 5', 'L', 'kosong', 5, '<ol>\r\n<li>ukuran kamar 3x4 meter&nbsp;</li>\r\n<li>kamar mandi didalam&nbsp;</li>\r\n<li>sirkulasi udara nyaman</li>\r\n</ol>'),
(94, 'Rina 6', 'L', 'kosong', 5, '<ol>\r\n<li>ukuran kamar 3x4 meter&nbsp;</li>\r\n<li>kamar mandi didalam&nbsp;</li>\r\n<li>sirkulasi udara nyaman</li>\r\n</ol>'),
(95, 'Rina 7', 'L', 'kosong', 5, '<ol>\r\n<li>ukuran kamar 3x4 meter&nbsp;</li>\r\n<li>kamar mandi didalam&nbsp;</li>\r\n<li>sirkulasi udara nyaman</li>\r\n</ol>'),
(96, 'Rina 8', 'L', 'kosong', 5, '<ol>\r\n<li>ukuran kamar 3x4 meter&nbsp;</li>\r\n<li>kamar mandi didalam&nbsp;</li>\r\n<li>sirkulasi udara nyaman</li>\r\n</ol>'),
(97, 'kamar kosan edi A', 'L', 'kosong', 6, '<ol>\r\n<li>ukuran kamar 3x3 meter&nbsp;</li>\r\n<li>sirkulasi udara nyaman</li>\r\n</ol>'),
(98, 'kamar kosan edi B', 'L', 'kosong', 6, '<ol>\r\n<li>ukuran kamar 3x3 meter&nbsp;</li>\r\n<li>sirkulasi udara nyaman</li>\r\n</ol>'),
(99, 'kamar kosan edi C', 'L', 'kosong', 6, '<ol>\r\n<li>ukuran kamar 3x3 meter&nbsp;</li>\r\n<li>sirkulasi udara nyaman</li>\r\n</ol>'),
(100, 'Kamar kosan edi D', 'L', 'kosong', 6, '<ol>\r\n<li>ukuran kamar 3x3 meter&nbsp;</li>\r\n<li>sirkulasi udara nyaman</li>\r\n</ol>'),
(101, 'kamar kosan edi E', 'L', 'kosong', 6, '<ol>\r\n<li>ukuran kamar 3x3 meter&nbsp;</li>\r\n<li>sirkulasi udara nyaman</li>\r\n</ol>'),
(102, 'Sahira 1', 'P', 'kosong', 7, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(103, 'Sahira 2', 'P', 'kosong', 7, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(104, 'Sahira 3', 'P', 'kosong', 7, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(105, 'Sahira 4', 'P', 'kosong', 7, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(106, 'Sahira 5', 'P', 'kosong', 7, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(107, 'Sahira 6', 'P', 'kosong', 7, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(108, 'Sahira 7', 'P', 'kosong', 7, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(109, 'Sahira 8', 'P', 'kosong', 7, '<ol>\r\n<li>ukuran kamar 3x3 meter</li>\r\n<li>kamar mandi dalam</li>\r\n</ol>'),
(110, 'Nusa Indah 01', 'L', '', 20, ''),
(111, 'Nusa Indah 02', 'L', '', 20, ''),
(112, 'Nusa Indah 03', 'L', 'kosong', 20, ''),
(113, 'Pondok Biru 01', 'P', 'kosong', 21, ''),
(114, 'Pondok Biru 02', 'P', 'kosong', 21, '');

-- --------------------------------------------------------

--
-- Table structure for table `kost`
--

CREATE TABLE `kost` (
  `id` int(11) NOT NULL auto_increment,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `pemilik_id` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `aktif` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `kost`
--

INSERT INTO `kost` (`id`, `nama`, `alamat`, `pemilik_id`, `keterangan`, `aktif`) VALUES
(20, 'Kosan Iffan', 'Jln. Raya Rajadesa', 'iffan20', '', 1),
(21, 'Pondok Biru', 'Jl. Manisi atas 90', 'purbacep', '', 1),
(22, 'Pondok indah', 'Cipadung desa', 'mamz25', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL auto_increment,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `ktp` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` enum('P','L') NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `kampus` varchar(100) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `email`, `ktp`, `password`, `alamat`, `jenis_kelamin`, `no_hp`, `kampus`, `photo`, `aktif`) VALUES
(7, 'bayu dhika', 'bayu@gmail.com', '2356789', '83c92ae5561a58280edb18772649ecef', 'Subang', 'L', '085220667890', 'UIN Bandung', '', 1),
(4, 'iffan komarudin', 'sckomar@gmail.com', '123', '83c92ae5561a58280edb18772649ecef', 'rajadesa,ciamis', 'L', '089617239884', '', '', 1),
(5, 'dikri', 'dikri@gmail.com', '213', '21232f297a57a5a743894a0e4a801fc3', '', 'L', '081876890089', '', '', 1),
(6, 'ary', 'ryzl3od@gmail.com', '09876272839', '83c92ae5561a58280edb18772649ecef', 'ciamis', 'L', '085220669423', 'UIN Bandung', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL auto_increment,
  `pemesanan_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `kode_transfer` varchar(100) NOT NULL,
  `bank_id` int(11) NOT NULL,
  `type` enum('DP','lunas','cicilan') NOT NULL,
  `konfirmasi` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `pemesanan_id`, `jumlah`, `tanggal`, `tgl_transaksi`, `kode_transfer`, `bank_id`, `type`, `konfirmasi`) VALUES
(1, 1, 3500000, '2012-11-24', '2012-11-25 17:44:30', '41125r', 1, 'lunas', 1),
(2, 2, 500000, '2014-10-22', '2014-10-21 02:02:44', '123', 1, 'DP', 1),
(3, 0, 0, '0000-00-00', '2014-10-21 02:05:04', '', 0, 'lunas', 0),
(4, 3, 4000000, '2014-11-10', '2014-11-10 14:19:11', '12345', 1, 'lunas', 0),
(5, 4, 500000, '2014-11-28', '2014-11-20 02:26:13', 'UD16', 1, 'DP', 0),
(6, 7, 5000000, '2015-11-30', '2015-11-30 14:00:29', 'bayu', 1, 'lunas', 1),
(7, 8, 6000000, '2015-11-30', '2015-11-30 14:48:33', 'sdbkasjda', 1, 'lunas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL auto_increment,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date NOT NULL,
  `harga_kamar_id` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `batas_akhir` datetime NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `tgl_masuk`, `tgl_keluar`, `harga_kamar_id`, `tanggal`, `batas_akhir`, `aktif`, `pelanggan_id`) VALUES
(1, '2012-11-30', '2013-11-30', 118, '2012-11-25 17:43:52', '2012-11-27 17:43:52', 1, 2),
(2, '2014-10-21', '2015-10-21', 97, '2014-10-21 02:01:28', '2014-10-23 02:01:28', 0, 4),
(3, '2014-11-11', '2015-11-11', 27, '2014-11-10 14:17:54', '2014-11-12 14:17:54', 0, 4),
(4, '2014-11-25', '2015-11-25', 118, '2014-11-20 02:13:48', '2014-11-22 02:13:48', 0, 4),
(5, '2014-11-26', '2015-11-26', 129, '2014-11-21 17:33:24', '2014-11-23 17:33:24', 0, 4),
(6, '2014-11-21', '2015-11-21', 74, '2014-11-21 17:36:51', '2014-11-23 17:36:51', 1, 4),
(7, '2015-11-30', '2016-11-29', 137, '2015-11-30 13:59:12', '2015-12-02 13:59:12', 1, 7),
(8, '2015-11-30', '2015-12-30', 138, '2015-11-30 14:47:35', '2015-12-02 14:47:35', 1, 6);

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
  `aktif` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`id`, `nama`, `email`, `password`, `alamat`, `jenis_kelamin`, `no_hp`, `aktif`) VALUES
('iffan20', 'iffan komarudin', 'sckomar@gmail.com', '83c92ae5561a58280edb18772649ecef', 'jl. rajadesa', 'L', '089617239884', 1),
('purbacep', 'cecep', 'cecep@gmail.com', '473f670b5cf174273e7f092cd44e54f3', 'Jl manisi atas 90', 'L', '085220667890', 1),
('mamz25', 'imam ramadhan hamzah', 'imam@gmail.com', '4a20635f67a5ccce81f9d67f36a56f1f', 'Jl.Cipadung desa 50', 'L', '085667889789', 1);

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL auto_increment,
  `nama` varchar(100) NOT NULL,
  `aktif` tinyint(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `nama`, `aktif`) VALUES
(1, '2012-2013', 0),
(16, '2008-2009', 0),
(15, '2009-2010', 0),
(14, '2010-2011', 0),
(13, '2011-2012', 0),
(12, '2013-2014', 0),
(17, '2014-2015', 0),
(18, '2015-2016', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tempat`
--

CREATE TABLE `tempat` (
  `id` int(11) NOT NULL auto_increment,
  `nama` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `alamat` text NOT NULL,
  `lintang` varchar(50) NOT NULL,
  `bujur` varchar(50) NOT NULL,
  `type_tempat_id` int(11) NOT NULL,
  `kost_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `tempat`
--

INSERT INTO `tempat` (`id`, `nama`, `keterangan`, `alamat`, `lintang`, `bujur`, `type_tempat_id`, `kost_id`) VALUES
(1, 'Baitul Ilmi Putri', '<ul><li>Untuk booking Rp.300.000 - Rp.500.000</li><li>Kosan ke Universitas Telkom dapat di tempuh 10menit jalan kaki.</li></ul>', 'jln. Mangga Dua Gg. Masjid Rt 06 / Rw 02, Sukapura,Kec. Dayeuhkolot, Bandung', '107.6328957080841', '-6.970683064912783', 1, 1),
(49, 'Piter Selly', '- Ada 25 kamar, untuk Putri di lantai 1 ada 5 kamar dan di lantai 2 ada 8 kamar. Sedangkan untuk Putra di kamar 3 ada 9 kamar.- Dari Universitas telkom dapat di tempuh jalan kaki 15 menit.', '', '107.6340302824974', '-6.969000435745433', 1, 2),
(48, 'Kosan Bapak Ayi Setiawan', '- Dekat dengan masjid. - Kosan ke Universitas Telkom dapat ditempuh 10 menit jalan kaki. - Dekat dengan warung makan. - Lewat jam 10 gerbang kosan di kunci. ', '', '107.6332899928093', '-6.970571244807413', 1, 10),
(50, 'Kosan Mutiara', '-Tempat jemuran luas,-Kosan masuk gang yang sedikit sempit.-Kamar kondisi kosongan. Jika mau isi harganya Rp. 4.500.000,-', '', '107.63283133506775', '-6.970677740146464', 1, 3),
(51, 'Baitul Ilmi Putra', '- Tamannya asri- Tempat parkir motor luas- Kosan ke Universitas Telkom dapat ditempuh 10 menit jalan kaki.- Jika hujan lebat kadang air masuk ke kamar. ', '', '107.63306736946106', '-6.970664428230408', 1, 4),
(52, 'Bambang Hernawan / Rina', '<ol><li>Ruang tamu luas.</li><li>Kosan ke Universitas Telkom dapat di tempuh 10 menit jalan kaki.</li><li>Bapak dan Ibu kost ada di lantai dasar untuk Kamar kosannya ada di lantai atas.</li></ol>', '', '107.63294398784637', '-6.970651116313982', 1, 5),
(53, 'Kosan Pak Edi', '- Dekat lapangan bola - Lantai atas untuk jemur pakaian.- Banyak anak kecil di sekitar kosan. - Kosan ke Univertas telkom dapat ditempuh 10-15 menit jalan kaki. ', '', '107.63223320245743', '-6.970065391616407', 1, 6),
(54, 'Kosan Sahira', '- Dekat masjid - Kosan ke Universitas Telkom dapat ditempuh 10 menit jalan kaki.- Untuk Bapak dan ibu kosan bertempat tinggal di lantai dasar. Sedangkan untuk kosannya ada di lantai atas. ', '', '107.63333290815353', '-6.970723000658243', 1, 7),
(55, 'Kosan Pak Parto', '- Kosan ke Universitas Telkom dapat ditempuh 10 menit jalan kaki. - Uang listrik Rp. 50.000,-/bulan', '', '107.63287425041199', '-6.970459424675365', 1, 8),
(56, 'Kosan Bu Nia', '- Kosan ke Universitas Telkom dapat ditempuh 10 menit jalan kaki. - Ibu kosannya menyediakan rental motor dan mobil harian. ', '', '107.63317868113518', '-6.970517997128811', 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `type_tempat`
--

CREATE TABLE `type_tempat` (
  `id` int(11) NOT NULL auto_increment,
  `nama` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `type_tempat`
--

INSERT INTO `type_tempat` (`id`, `nama`, `gambar`) VALUES
(1, 'Kosan', 'home.png'),
(2, 'Universitas', 'university.png'),
(3, 'Tempat Makan', 'restaurant.png'),
(4, 'Potong Rambut', 'barber.png'),
(5, 'ATM', 'atm-2.png'),
(6, 'Bank', 'bank.png'),
(7, 'Sekolah', 'highschool.png'),
(8, 'Perpustakaan', 'library.png'),
(9, 'Lapangan Sepak Bola', 'soccer.png'),
(10, 'Lapangan Tenis', 'tennis.png'),
(11, 'Masjid', 'mosque.png'),
(12, 'Tempat Belanja', 'supermarket.png'),
(13, 'Rental Mobil', 'carrental.png'),
(14, 'Cafe', 'cafetaria.png'),
(15, 'Loundry', 'laundromat.png'),
(16, 'Printing (Percetakan)', 'printer-2.png'),
(17, 'Bakso', 'restaurant_chinese.png'),
(18, 'Apartemen', 'apartment-3.png'),
(19, 'Fast Food', 'fastfood.png'),
(20, 'Warnet & WIFI', 'wifi.png'),
(21, 'SPBU', 'gazstation.png'),
(22, 'Apotek', 'medicine.png'),
(23, 'Penjual Buah', 'fruits.png'),
(24, 'Rumah Sakit', 'hospital-building.png'),
(25, 'Kantor Polisi', 'police.png'),
(27, 'Pengiriman Barang', 'postal.png'),
(28, 'Lapangan Basket', '737121_basketball.png');
