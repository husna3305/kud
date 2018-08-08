-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2018 at 04:10 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project-kud-bahar12`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_preferences`
--

CREATE TABLE IF NOT EXISTS `admin_preferences` (
`id` tinyint(1) NOT NULL,
  `user_panel` tinyint(1) NOT NULL DEFAULT '0',
  `sidebar_form` tinyint(1) NOT NULL DEFAULT '0',
  `messages_menu` tinyint(1) NOT NULL DEFAULT '0',
  `notifications_menu` tinyint(1) NOT NULL DEFAULT '0',
  `tasks_menu` tinyint(1) NOT NULL DEFAULT '0',
  `user_menu` tinyint(1) NOT NULL DEFAULT '1',
  `ctrl_sidebar` tinyint(1) NOT NULL DEFAULT '0',
  `transition_page` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_preferences`
--

INSERT INTO `admin_preferences` (`id`, `user_panel`, `sidebar_form`, `messages_menu`, `notifications_menu`, `tasks_menu`, `user_menu`, `ctrl_sidebar`, `transition_page`) VALUES
(1, 1, 0, 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE IF NOT EXISTS `barang` (
`id_barang` int(11) NOT NULL,
  `kd_barang` char(10) NOT NULL,
  `nama_barang` varchar(70) NOT NULL,
  `id_kategori` int(3) NOT NULL,
  `id_satuan` tinyint(2) NOT NULL,
  `order` int(11) NOT NULL,
  `user_id-add` int(11) unsigned NOT NULL,
  `user_id-upd` int(11) unsigned NOT NULL,
  `user_id-del` int(11) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_status` tinyint(1) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kd_barang`, `nama_barang`, `id_kategori`, `id_satuan`, `order`, `user_id-add`, `user_id-upd`, `user_id-del`, `date_created`, `last_updated`, `last_deleted`, `delete_status`, `aktif`) VALUES
(9, '', 'Pupuk Kcl', 1, 0, 0, 1, 8, 1, '2018-07-18 22:55:06', '2018-07-18 22:59:41', '2018-07-18 23:36:49', 0, 1),
(10, '', 'coba barang 2', 20, 0, 0, 1, 0, 0, '2018-07-21 00:38:17', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(11, '', 'barang 3', 4, 0, 0, 1, 0, 0, '2018-07-21 04:48:31', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(12, '', 'barang 4', 1, 0, 0, 1, 0, 0, '2018-07-21 04:48:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(13, '', 'barang 4', 16, 0, 0, 1, 0, 0, '2018-07-21 04:48:57', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(14, '', 'barang 5', 1, 0, 0, 1, 0, 0, '2018-07-21 04:49:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(15, '', 'barang 6', 1, 0, 0, 1, 0, 0, '2018-07-21 04:49:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(16, '', 'barang 7', 4, 0, 0, 1, 0, 0, '2018-07-21 04:49:58', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(17, '', 'barang 8', 4, 0, 0, 1, 0, 0, '2018-07-21 04:50:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(18, '', 'barang 9', 4, 0, 0, 1, 0, 0, '2018-07-21 04:50:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(19, '', 'barang 10', 16, 0, 0, 1, 0, 0, '2018-07-21 04:50:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(20, '', 'barang 11', 1, 0, 0, 1, 0, 0, '2018-07-21 04:50:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(21, '', 'Pupuk ABCD', 21, 0, 0, 1, 0, 0, '2018-07-25 03:33:29', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(22, '', 'abababaababababaab ababaabab ababaabab abaababababababababab', 21, 0, 0, 1, 0, 0, '2018-07-26 10:51:59', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `data_kud`
--

CREATE TABLE IF NOT EXISTS `data_kud` (
`id` int(5) NOT NULL,
  `nama_kud` varchar(50) NOT NULL,
  `alamat` tinytext NOT NULL,
  `keterangan` tinytext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_kud`
--

INSERT INTO `data_kud` (`id`, `nama_kud`, `alamat`, `keterangan`) VALUES
(1, 'KUD Karya Bersama', 'Desa Sumber Mulya Kec. Bahar Utara Kab. Muaro Jambi', '');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `is_super_admin` tinyint(1) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `bgcolor` char(7) NOT NULL DEFAULT '#607D8B'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`, `is_super_admin`, `is_admin`, `bgcolor`) VALUES
(1, 'super-admin', '', 1, 0, '#9c27b0'),
(2, 'Karyawan', 'Karyawan KUD', 0, 1, '#ff5722'),
(3, 'Sekretaris', 'Sekretaris KUD', 0, 1, '#3f51b5');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE IF NOT EXISTS `kategori_barang` (
`id_kategori` int(3) NOT NULL,
  `nama_kategori` varchar(40) NOT NULL,
  `kode_kategori` varchar(20) NOT NULL,
  `parent_id` int(2) NOT NULL,
  `order` int(3) NOT NULL,
  `user_id-add` int(11) unsigned NOT NULL,
  `user_id-upd` int(11) unsigned NOT NULL,
  `user_id-del` int(11) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_status` tinyint(1) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_barang`
--

INSERT INTO `kategori_barang` (`id_kategori`, `nama_kategori`, `kode_kategori`, `parent_id`, `order`, `user_id-add`, `user_id-upd`, `user_id-del`, `date_created`, `last_updated`, `last_deleted`, `delete_status`, `aktif`) VALUES
(1, 'Alat Tani', 'P', 0, 1, 1, 1, 1, '0000-00-00 00:00:00', '2018-07-18 07:17:03', '2018-07-17 23:24:45', 0, 1),
(2, 'Pupuk A', 'P', 1, 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2018-07-18 10:27:37', 1, 1),
(3, 'Pupuk AA', 'P', 2, 1, 1, 1, 0, '0000-00-00 00:00:00', '2018-07-17 01:56:54', '0000-00-00 00:00:00', 0, 1),
(4, 'Coba 1', '', 0, 0, 1, 1, 1, '2018-07-16 15:31:32', '2018-07-18 10:36:48', '2018-07-18 02:04:35', 0, 1),
(16, 's', '', 0, 0, 1, 1, 0, '2018-07-17 17:28:23', '2018-07-18 14:21:04', '0000-00-00 00:00:00', 0, 1),
(19, 'fw', '', 16, 0, 1, 1, 0, '2018-07-17 23:11:51', '2018-07-17 23:15:20', '0000-00-00 00:00:00', 0, 1),
(20, 'cb', '', 4, 0, 1, 0, 0, '2018-07-18 07:18:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(21, 'Pupuk', '', 0, 0, 1, 0, 0, '2018-07-25 03:32:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kelompok_tani`
--

CREATE TABLE IF NOT EXISTS `kelompok_tani` (
`id_kelompok_tani` int(11) NOT NULL,
  `kd_kelompok_tani` char(10) NOT NULL,
  `nama_kelompok_tani` varchar(60) NOT NULL,
  `alamat` tinytext,
  `no_telp` varchar(15) DEFAULT NULL,
  `user_id-add` int(11) unsigned NOT NULL,
  `user_id-upd` int(11) unsigned NOT NULL,
  `user_id-del` int(11) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_status` tinyint(1) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kelompok_tani`
--

INSERT INTO `kelompok_tani` (`id_kelompok_tani`, `kd_kelompok_tani`, `nama_kelompok_tani`, `alamat`, `no_telp`, `user_id-add`, `user_id-upd`, `user_id-del`, `date_created`, `last_updated`, `last_deleted`, `deleted_status`, `aktif`) VALUES
(5, '', 'Kelompok Tani Coba', '1', '88', 1, 1, 0, '2018-07-19 04:01:38', '2018-07-19 04:01:50', '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `konsumen_pribadi`
--

CREATE TABLE IF NOT EXISTS `konsumen_pribadi` (
`id_konsumenpribadi` int(11) NOT NULL,
  `kd_konsumenpribadi` char(10) NOT NULL,
  `nama_konsumenpribadi` varchar(60) NOT NULL,
  `alamat` tinytext,
  `no_telp` varchar(15) DEFAULT NULL,
  `user_id-add` int(11) unsigned NOT NULL,
  `user_id-upd` int(11) unsigned NOT NULL,
  `user_id-del` int(11) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_status` tinyint(1) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
`menu_id` tinyint(3) NOT NULL,
  `name` varchar(30) NOT NULL,
  `link` varchar(100) NOT NULL,
  `is_parent` enum('0','1') NOT NULL,
  `parent_id` tinyint(3) NOT NULL,
  `is_dropdown` enum('0','1') NOT NULL,
  `is_menu_header` enum('0','1') NOT NULL,
  `menu_header_id` tinyint(3) NOT NULL,
  `fa_icon` varchar(20) NOT NULL,
  `order` tinyint(3) NOT NULL,
  `active` enum('0','1','','') NOT NULL,
  `deleted` mediumint(3) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `name`, `link`, `is_parent`, `parent_id`, `is_dropdown`, `is_menu_header`, `menu_header_id`, `fa_icon`, `order`, `active`, `deleted`, `date_created`, `last_updated`, `last_deleted`) VALUES
(1, 'Halaman Utama', 'admin', '1', 0, '0', '0', 2, 'fa-tachometer-alt', 1, '1', 0, '2018-03-26 10:16:36', '2018-07-30 03:27:10', '0000-00-00 00:00:00'),
(2, 'NAVIGASI UTAMA', '', '0', 0, '0', '1', 0, '', 1, '1', 0, '2018-03-26 10:08:37', '2018-03-26 15:06:19', '0000-00-00 00:00:00'),
(3, 'PENGATURAN', '', '0', 0, '0', '1', 0, '', 99, '1', 0, '2018-03-26 10:08:37', '2018-07-15 06:51:38', '0000-00-00 00:00:00'),
(4, 'Pengguna', 'nm', '1', 0, '1', '0', 3, 'fa-user', 1, '1', 0, '2018-03-26 10:08:37', '2018-04-13 13:28:39', '0000-00-00 00:00:00'),
(7, 'Daftar Pengguna', 'admin/users', '0', 4, '0', '0', 0, 'fa-user', 1, '1', 0, '2018-03-26 10:17:06', '2018-03-26 10:17:06', '0000-00-00 00:00:00'),
(8, 'Grup Pengguna', 'admin/groups', '0', 4, '0', '0', 0, '', 2, '1', 0, '2018-03-26 10:08:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Hak Akses', '', '1', 0, '1', '0', 3, 'fa-shield-alt', 2, '1', 0, '2018-03-26 10:08:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'Menu', 'admin/menus', '0', 9, '0', '0', 0, '', 1, '1', 0, '2018-03-26 10:08:37', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'Data Kelompok Tani', 'admin/kelompoktani', '0', 12, '0', '0', 0, '', 3, '1', 0, '2018-03-26 10:08:37', '2018-07-19 00:55:12', '0000-00-00 00:00:00'),
(12, 'Data Master', '#', '1', 0, '1', '0', 2, 'fa-boxes', 2, '1', 0, '2018-03-26 10:08:37', '2018-07-15 06:45:49', '0000-00-00 00:00:00'),
(20, 'Kategori Barang', 'admin/kategori', '0', 12, '0', '0', 0, 'fa-list', 1, '1', 0, '2018-03-26 10:08:37', '2018-07-15 10:17:38', '0000-00-00 00:00:00'),
(22, 'Brand', 'admin/brand', '0', 26, '0', '0', 0, 'fa-trademark', 3, '1', 0, '2018-03-26 13:53:24', '2018-06-21 21:32:20', '0000-00-00 00:00:00'),
(23, 'Variasi', 'admin/variation', '0', 26, '0', '0', 0, 'fa-th', 4, '1', 0, '2018-03-30 22:36:00', '2018-06-21 21:32:38', '0000-00-00 00:00:00'),
(24, 'Kondisi Produk', 'admin/condition', '0', 26, '0', '0', 0, 'fa-thumbs-up', 5, '1', 0, '2018-04-01 01:19:35', '2018-06-21 21:32:50', '0000-00-00 00:00:00'),
(25, 'Data Suplier', 'admin/suplier', '0', 12, '0', '0', 0, 'fa-star', 2, '1', 0, '2018-04-10 00:40:03', '2018-07-15 06:46:15', '0000-00-00 00:00:00'),
(27, 'Transaksi Belanja Barang', '#', '1', 0, '1', '0', 31, 'fa-sign-in-alt', 1, '1', 0, '2018-06-22 14:55:32', '2018-07-25 11:07:22', '0000-00-00 00:00:00'),
(28, 'Data Barang', 'admin/barang', '0', 12, '0', '0', 0, 'fa-home', 2, '1', 0, '2018-06-22 23:44:57', '2018-07-15 09:30:18', '0000-00-00 00:00:00'),
(29, 'Tambah Transaksi', 'admin/transaksijual', '0', 32, '0', '0', 0, 'fa-cat', 2, '1', 0, '2018-07-15 06:49:59', '2018-07-25 10:55:24', '0000-00-00 00:00:00'),
(30, 'Tambah Transaksi', 'admin/belanjabarang', '0', 27, '0', '0', 0, 'fa-brand', 1, '1', 0, '2018-07-15 06:55:46', '2018-07-25 10:54:50', '0000-00-00 00:00:00'),
(31, 'Transaksi', '', '0', 0, '0', '1', 0, '', 2, '1', 0, '2018-07-15 08:30:43', '2018-07-15 09:19:18', '0000-00-00 00:00:00'),
(32, 'Transaksi Penjualan', '#', '1', 0, '1', '0', 31, 'fa-sign-out-alt', 2, '1', 0, '2018-07-25 10:52:45', '2018-07-25 11:07:55', '0000-00-00 00:00:00'),
(33, 'Daftar Transaksi', 'admin/belanjabarang/daftartransaksi', '0', 27, '0', '0', 0, 'fa-cat', 3, '1', 0, '2018-07-27 09:52:25', '2018-07-27 10:01:02', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `menus_preferences`
--

CREATE TABLE IF NOT EXISTS `menus_preferences` (
`id` mediumint(6) NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  `menu_id` tinyint(3) NOT NULL,
  `show` enum('0','1') NOT NULL,
  `inserted` tinyint(1) NOT NULL,
  `edited` tinyint(1) NOT NULL,
  `deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=151 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus_preferences`
--

INSERT INTO `menus_preferences` (`id`, `group_id`, `menu_id`, `show`, `inserted`, `edited`, `deleted`) VALUES
(57, 1, 2, '1', 1, 0, 0),
(59, 1, 1, '1', 1, 1, 1),
(60, 1, 3, '1', 1, 0, 0),
(61, 1, 4, '1', 1, 1, 1),
(62, 1, 7, '1', 1, 1, 1),
(63, 1, 8, '1', 1, 1, 1),
(64, 1, 9, '1', 1, 1, 1),
(65, 1, 10, '1', 1, 1, 1),
(66, 1, 11, '1', 1, 1, 1),
(67, 1, 12, '1', 1, 1, 1),
(70, 2, 2, '1', 0, 0, 0),
(71, 3, 2, '1', 0, 0, 0),
(72, 3, 7, '1', 1, 1, 1),
(73, 3, 12, '1', 1, 1, 1),
(74, 2, 1, '1', 0, 0, 0),
(75, 3, 1, '1', 0, 0, 0),
(84, 3, 8, '0', 0, 0, 0),
(85, 3, 3, '1', 0, 0, 0),
(86, 3, 4, '1', 1, 1, 1),
(87, 3, 9, '0', 0, 0, 0),
(88, 3, 10, '0', 0, 0, 0),
(89, 3, 11, '1', 1, 1, 1),
(90, 6, 2, '1', 0, 0, 0),
(91, 6, 1, '1', 1, 1, 1),
(92, 6, 3, '0', 0, 0, 0),
(93, 6, 11, '1', 0, 0, 0),
(94, 6, 12, '1', 0, 0, 1),
(95, 2, 10, '0', 0, 0, 0),
(96, 2, 11, '1', 1, 1, 1),
(97, 2, 12, '1', 0, 0, 0),
(98, 2, 9, '0', 0, 0, 0),
(99, 6, 10, '0', 0, 0, 0),
(100, 6, 8, '0', 0, 0, 0),
(101, 2, 3, '0', 0, 0, 0),
(102, 2, 4, '0', 0, 0, 0),
(103, 6, 4, '0', 0, 0, 0),
(104, 2, 7, '0', 0, 0, 0),
(105, 2, 8, '0', 0, 0, 0),
(106, 6, 9, '0', 0, 0, 0),
(107, 6, 7, '0', 0, 0, 0),
(108, 1, 20, '1', 1, 1, 1),
(109, 2, 20, '1', 1, 1, 1),
(110, 1, 22, '1', 1, 1, 1),
(111, 1, 23, '1', 1, 1, 1),
(112, 1, 24, '1', 1, 1, 1),
(113, 3, 24, '1', 0, 0, 0),
(114, 3, 20, '1', 1, 1, 1),
(115, 3, 22, '1', 0, 0, 0),
(116, 3, 23, '1', 0, 0, 0),
(117, 1, 25, '1', 1, 1, 1),
(118, 3, 25, '1', 1, 1, 1),
(119, 6, 25, '0', 0, 0, 0),
(120, 1, 26, '1', 1, 1, 1),
(121, 3, 26, '1', 1, 1, 1),
(122, 7, 2, '0', 0, 0, 0),
(123, 6, 26, '1', 1, 1, 1),
(124, 6, 20, '1', 0, 0, 0),
(125, 6, 23, '1', 0, 0, 0),
(126, 6, 22, '1', 0, 0, 0),
(127, 6, 24, '1', 0, 0, 0),
(128, 1, 27, '1', 0, 0, 0),
(129, 3, 27, '1', 1, 1, 1),
(130, 1, 28, '1', 1, 1, 1),
(131, 3, 28, '1', 1, 1, 1),
(132, 2, 25, '1', 1, 1, 1),
(133, 7, 28, '1', 0, 0, 0),
(134, 1, 29, '1', 1, 1, 1),
(135, 1, 30, '1', 1, 1, 1),
(136, 1, 31, '1', 0, 0, 0),
(137, 1, 32, '1', 1, 1, 1),
(138, 1, 33, '1', 1, 1, 1),
(139, 3, 31, '1', 0, 0, 0),
(140, 3, 30, '1', 1, 1, 1),
(141, 3, 33, '1', 1, 1, 1),
(142, 3, 32, '1', 1, 1, 1),
(143, 3, 29, '1', 1, 1, 1),
(144, 2, 28, '1', 1, 1, 1),
(145, 2, 31, '1', 0, 0, 0),
(146, 2, 27, '1', 1, 1, 1),
(147, 2, 30, '1', 1, 1, 1),
(148, 2, 33, '1', 1, 1, 1),
(149, 2, 32, '1', 1, 1, 1),
(150, 2, 29, '1', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `penyandang_dana`
--

CREATE TABLE IF NOT EXISTS `penyandang_dana` (
`id_penyandangdana` int(11) NOT NULL,
  `nama_penyandangdana` varchar(60) NOT NULL,
  `alamat` tinytext,
  `no_telp` varchar(15) DEFAULT NULL,
  `user_id-add` int(11) unsigned NOT NULL,
  `user_id-upd` int(11) unsigned NOT NULL,
  `user_id-del` int(11) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_status` tinyint(1) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `penyandang_dana`
--

INSERT INTO `penyandang_dana` (`id_penyandangdana`, `nama_penyandangdana`, `alamat`, `no_telp`, `user_id-add`, `user_id-upd`, `user_id-del`, `date_created`, `last_updated`, `last_deleted`, `deleted_status`, `aktif`) VALUES
(1, 'Penyandang Dana 1', NULL, NULL, 1, 0, 0, '2018-07-25 17:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1),
(2, 'Penyandang Dana 2', NULL, NULL, 1, 0, 0, '2018-07-25 17:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `satuan_barang`
--

CREATE TABLE IF NOT EXISTS `satuan_barang` (
`id_satuan` tinyint(2) NOT NULL,
  `kd_satuan` char(5) NOT NULL,
  `nama_satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stok_barang`
--

CREATE TABLE IF NOT EXISTS `stok_barang` (
`id_stok` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `keterangan` tinytext NOT NULL,
  `keterangan_transaksi` char(25) NOT NULL,
  `masuk` int(5) NOT NULL,
  `keluar` int(5) NOT NULL,
  `id_stok_dikeluarkan` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `user_id-add` int(11) unsigned NOT NULL,
  `user_id-upd` int(11) unsigned NOT NULL,
  `user_id-del` int(11) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `delete_status` tinyint(1) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_barang`
--

INSERT INTO `stok_barang` (`id_stok`, `id_barang`, `keterangan`, `keterangan_transaksi`, `masuk`, `keluar`, `id_stok_dikeluarkan`, `tanggal`, `waktu`, `user_id-add`, `user_id-upd`, `user_id-del`, `date_created`, `last_updated`, `last_deleted`, `delete_status`, `aktif`) VALUES
(20, 9, 'Transaksi Penjualan Barang, Dibeli Oleh Kelompok Tani Coba', 'TR-JL-20180727-000001', 0, 10, 19, '2018-07-27', '19:29:42', 1, 0, 0, '2018-07-27 12:29:42', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(23, 9, 'Transaksi Belanja Barang', 'TR-BL-20180727-000001', 120, 0, 0, '2018-07-27', '08:47:36', 1, 0, 1, '2018-07-28 01:47:36', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0, 0),
(24, 14, 'Transaksi Belanja Barang', 'TR-BL-20180728-000001', 100, 0, 0, '2018-07-28', '09:59:10', 8, 0, 1, '2018-07-28 02:59:10', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0, 0),
(25, 9, 'Transaksi Belanja Barang', 'TR-BL-20180728-000002', 120, 0, 0, '2018-07-28', '16:53:49', 1, 0, 1, '2018-07-28 09:53:49', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0, 0),
(26, 12, 'Transaksi Belanja Barang', 'TR-BL-20180728-000003', 100, 0, 0, '2018-07-28', '17:02:49', 1, 0, 1, '2018-07-28 10:02:49', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0, 0),
(27, 20, 'Transaksi Belanja Barang', 'TR-BL-20180728-000003', 80, 0, 0, '2018-07-28', '17:02:49', 1, 0, 1, '2018-07-28 10:02:49', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0, 0),
(28, 9, 'Transaksi Belanja Barang', 'TR-BL-20180728-000004', 1000, 0, 0, '2018-07-28', '22:35:00', 1, 0, 1, '2018-07-28 15:35:00', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0, 0),
(29, 17, 'Transaksi Belanja Barang', 'TR-BL-20180728-000004', 200, 0, 0, '2018-07-28', '22:35:00', 1, 0, 1, '2018-07-28 15:35:00', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0, 0),
(30, 12, 'Transaksi Belanja Barang', 'TR-BL-20180728-000004', 1000, 0, 0, '2018-07-28', '22:35:00', 1, 0, 1, '2018-07-28 15:35:00', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0, 0),
(31, 18, 'Transaksi Belanja Barang', 'TR-BL-20180728-000004', 100, 0, 0, '2018-07-28', '22:35:00', 1, 0, 1, '2018-07-28 15:35:00', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0, 0),
(32, 9, 'Transaksi Belanja Barang', 'TR-BL-20180728-000005', 10, 0, 0, '2018-07-28', '23:08:23', 1, 0, 0, '2018-07-28 16:08:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(33, 12, 'Transaksi Belanja Barang', 'TR-BL-20180728-000005', 100, 0, 0, '2018-07-28', '23:08:23', 1, 0, 0, '2018-07-28 16:08:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(34, 14, 'Transaksi Belanja Barang', 'TR-BL-20180728-000005', 10, 0, 0, '2018-07-28', '23:08:23', 1, 0, 0, '2018-07-28 16:08:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(35, 15, 'Transaksi Belanja Barang', 'TR-BL-20180728-000005', 100, 0, 0, '2018-07-28', '23:08:23', 1, 0, 0, '2018-07-28 16:08:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(36, 20, 'Transaksi Belanja Barang', 'TR-BL-20180728-000005', 40, 0, 0, '2018-07-28', '23:08:23', 1, 0, 0, '2018-07-28 16:08:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(37, 17, 'Transaksi Belanja Barang', 'TR-BL-20180728-000005', 100, 0, 0, '2018-07-28', '23:08:23', 1, 0, 0, '2018-07-28 16:08:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(38, 9, 'Transaksi Belanja Barang', 'TR-BL-20180728-000006', 10, 0, 0, '2018-07-28', '23:12:25', 1, 0, 0, '2018-07-28 16:12:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(39, 17, 'Transaksi Belanja Barang', 'TR-BL-20180728-000006', 12, 0, 0, '2018-07-28', '23:12:25', 1, 0, 0, '2018-07-28 16:12:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(40, 14, 'Transaksi Belanja Barang', 'TR-BL-20180728-000006', 120, 0, 0, '2018-07-28', '23:12:25', 1, 0, 0, '2018-07-28 16:12:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(41, 18, 'Transaksi Belanja Barang', 'TR-BL-20180728-000006', 100, 0, 0, '2018-07-28', '23:12:25', 1, 0, 0, '2018-07-28 16:12:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(42, 9, 'Transaksi Belanja Barang', 'TR-BL-20180729-000001', 10, 0, 0, '2018-07-29', '10:38:01', 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(43, 12, 'Transaksi Belanja Barang', 'TR-BL-20180729-000001', 1, 0, 0, '2018-07-29', '10:38:01', 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(44, 14, 'Transaksi Belanja Barang', 'TR-BL-20180729-000001', 1, 0, 0, '2018-07-29', '10:38:01', 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(45, 15, 'Transaksi Belanja Barang', 'TR-BL-20180729-000001', 9, 0, 0, '2018-07-29', '10:38:01', 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(46, 20, 'Transaksi Belanja Barang', 'TR-BL-20180729-000001', 24, 0, 0, '2018-07-29', '10:38:01', 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(47, 11, 'Transaksi Belanja Barang', 'TR-BL-20180729-000001', 8, 0, 0, '2018-07-29', '10:38:01', 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(48, 16, 'Transaksi Belanja Barang', 'TR-BL-20180729-000001', 8, 0, 0, '2018-07-29', '10:38:01', 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(49, 17, 'Transaksi Belanja Barang', 'TR-BL-20180729-000001', 7, 0, 0, '2018-07-29', '10:38:01', 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(50, 18, 'Transaksi Belanja Barang', 'TR-BL-20180729-000001', 9, 0, 0, '2018-07-29', '10:38:01', 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(51, 13, 'Transaksi Belanja Barang', 'TR-BL-20180729-000001', 8, 0, 0, '2018-07-29', '10:38:01', 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(52, 19, 'Transaksi Belanja Barang', 'TR-BL-20180729-000001', 8, 0, 0, '2018-07-29', '10:38:01', 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(53, 10, 'Transaksi Belanja Barang', 'TR-BL-20180729-000001', 9, 0, 0, '2018-07-29', '10:38:01', 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(54, 21, 'Transaksi Belanja Barang', 'TR-BL-20180729-000001', 9, 0, 0, '2018-07-29', '10:38:01', 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(55, 22, 'Transaksi Belanja Barang', 'TR-BL-20180729-000001', 8, 0, 0, '2018-07-29', '10:38:01', 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(56, 9, 'Transaksi Belanja Barang', 'TR-BL-20180729-000002', 9, 0, 0, '2018-07-29', '10:39:36', 1, 0, 0, '2018-07-30 03:39:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(57, 16, 'Transaksi Belanja Barang', 'TR-BL-20180729-000002', 2, 0, 0, '2018-07-29', '10:39:36', 1, 0, 0, '2018-07-30 03:39:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(58, 14, 'Transaksi Belanja Barang', 'TR-BL-20180729-000002', 9, 0, 0, '2018-07-29', '10:39:36', 1, 0, 0, '2018-07-30 03:39:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(59, 9, 'Transaksi Belanja Barang', 'TR-BL-20180731-000001', 11, 0, 0, '2018-07-31', '17:33:20', 1, 0, 0, '2018-07-31 10:33:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(60, 12, 'Transaksi Belanja Barang', 'TR-BL-20180731-000001', 11, 0, 0, '2018-07-31', '17:33:20', 1, 0, 0, '2018-07-31 10:33:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(61, 14, 'Transaksi Belanja Barang', 'TR-BL-20180731-000001', 8, 0, 0, '2018-07-31', '17:33:20', 1, 0, 0, '2018-07-31 10:33:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(62, 15, 'Transaksi Belanja Barang', 'TR-BL-20180731-000001', 7, 0, 0, '2018-07-31', '17:33:20', 1, 0, 0, '2018-07-31 10:33:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(63, 20, 'Transaksi Belanja Barang', 'TR-BL-20180731-000001', 8, 0, 0, '2018-07-31', '17:33:20', 1, 0, 0, '2018-07-31 10:33:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(64, 9, 'Transaksi Belanja Barang', 'TR-BL-20180731-000002', 8, 0, 0, '2018-07-31', '17:34:46', 1, 0, 0, '2018-07-31 10:34:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(65, 12, 'Transaksi Belanja Barang', 'TR-BL-20180731-000002', 7, 0, 0, '2018-07-31', '17:34:46', 1, 0, 0, '2018-07-31 10:34:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(66, 21, 'Transaksi Belanja Barang', 'TR-BL-20180731-000002', 22, 0, 0, '2018-07-31', '17:34:46', 1, 0, 0, '2018-07-31 10:34:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(67, 22, 'Transaksi Belanja Barang', 'TR-BL-20180731-000002', 8, 0, 0, '2018-07-31', '17:34:46', 1, 0, 0, '2018-07-31 10:34:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(68, 10, 'Transaksi Belanja Barang', 'TR-BL-20180731-000002', 88, 0, 0, '2018-07-31', '17:34:46', 1, 0, 0, '2018-07-31 10:34:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(69, 12, 'Transaksi Belanja Barang', 'TR-BL-20180731-000003', 9, 0, 0, '2018-07-31', '17:36:28', 1, 0, 0, '2018-07-31 10:36:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(70, 16, 'Transaksi Belanja Barang', 'TR-BL-20180731-000003', 88, 0, 0, '2018-07-31', '17:36:28', 1, 0, 0, '2018-07-31 10:36:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(71, 14, 'Transaksi Belanja Barang', 'TR-BL-20180731-000003', 89, 0, 0, '2018-07-31', '17:36:28', 1, 0, 0, '2018-07-31 10:36:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(72, 17, 'Transaksi Belanja Barang', 'TR-BL-20180731-000003', 99, 0, 0, '2018-07-31', '17:36:28', 1, 0, 0, '2018-07-31 10:36:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(73, 13, 'Transaksi Belanja Barang', 'TR-BL-20180731-000003', 77, 0, 0, '2018-07-31', '17:36:28', 1, 0, 0, '2018-07-31 10:36:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(74, 19, 'Transaksi Belanja Barang', 'TR-BL-20180731-000003', 9898, 0, 0, '2018-07-31', '17:36:28', 1, 0, 0, '2018-07-31 10:36:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0),
(75, 21, 'Transaksi Belanja Barang', 'TR-BL-20180731-000003', 98, 0, 0, '2018-07-31', '17:36:28', 1, 0, 0, '2018-07-31 10:36:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE IF NOT EXISTS `suplier` (
`id_suplier` int(11) NOT NULL,
  `kd_suplier` char(10) NOT NULL,
  `nama_suplier` varchar(60) NOT NULL,
  `alamat` tinytext,
  `no_telp` varchar(15) DEFAULT NULL,
  `user_id-add` int(11) unsigned NOT NULL,
  `user_id-upd` int(11) unsigned NOT NULL,
  `user_id-del` int(11) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_status` tinyint(1) NOT NULL,
  `aktif` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`id_suplier`, `kd_suplier`, `nama_suplier`, `alamat`, `no_telp`, `user_id-add`, `user_id-upd`, `user_id-del`, `date_created`, `last_updated`, `last_deleted`, `deleted_status`, `aktif`) VALUES
(4, '', 'Coba suplier ', 'JL. haha', '0853', 1, 1, 0, '2018-07-19 00:16:49', '2018-07-19 00:43:52', '0000-00-00 00:00:00', 0, 1),
(5, '', 'Coba suplier 3', 'jambi', '88', 1, 1, 0, '2018-07-19 00:43:39', '2018-07-21 05:58:41', '0000-00-00 00:00:00', 0, 1),
(6, '', 'New Suplier', 'Bahar 12', '0888', 1, 0, 0, '2018-07-28 02:34:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_belanja_detail`
--

CREATE TABLE IF NOT EXISTS `transaksi_belanja_detail` (
`id_detail` int(11) NOT NULL,
  `id_transaksi_belanja` char(25) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(5) NOT NULL,
  `harga_beli` int(20) NOT NULL,
  `harga_jual_angsur` int(20) NOT NULL,
  `harga_jual_tunai` int(20) NOT NULL,
  `user_id-add` int(11) unsigned NOT NULL,
  `user_id-upd` int(11) unsigned NOT NULL,
  `user_id-del` int(11) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_belanja_detail`
--

INSERT INTO `transaksi_belanja_detail` (`id_detail`, `id_transaksi_belanja`, `id_barang`, `qty`, `harga_beli`, `harga_jual_angsur`, `harga_jual_tunai`, `user_id-add`, `user_id-upd`, `user_id-del`, `date_created`, `last_updated`, `last_deleted`, `deleted_status`) VALUES
(54, 'TR-BL-20180727-000001', 9, 120, 120000, 135000, 130000, 1, 0, 1, '2018-07-28 01:47:36', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0),
(55, 'TR-BL-20180728-000001', 14, 100, 130000, 140000, 135000, 8, 0, 1, '2018-07-28 02:59:10', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0),
(56, 'TR-BL-20180728-000002', 9, 120, 120000, 130000, 125000, 1, 0, 1, '2018-07-28 09:53:49', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0),
(57, 'TR-BL-20180728-000003', 12, 100, 120000, 140000, 130000, 1, 0, 1, '2018-07-28 10:02:49', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0),
(58, 'TR-BL-20180728-000003', 20, 80, 100000, 120000, 110000, 1, 0, 1, '2018-07-28 10:02:49', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0),
(59, 'TR-BL-20180728-000004', 9, 1000, 100000, 120000, 110000, 1, 0, 1, '2018-07-28 15:35:00', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0),
(60, 'TR-BL-20180728-000004', 17, 200, 280000, 300000, 290000, 1, 0, 1, '2018-07-28 15:35:00', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0),
(61, 'TR-BL-20180728-000004', 12, 1000, 120000, 130000, 125000, 1, 0, 1, '2018-07-28 15:35:00', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0),
(62, 'TR-BL-20180728-000004', 18, 100, 200000, 22000, 210000, 1, 0, 1, '2018-07-28 15:35:00', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0),
(63, 'TR-BL-20180728-000005', 9, 10, 110000, 130000, 120000, 1, 0, 0, '2018-07-28 16:08:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(64, 'TR-BL-20180728-000005', 12, 100, 20000, 30000, 25000, 1, 0, 0, '2018-07-28 16:08:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(65, 'TR-BL-20180728-000005', 14, 10, 100000, 120000, 110000, 1, 0, 0, '2018-07-28 16:08:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(66, 'TR-BL-20180728-000005', 15, 100, 1000, 3000, 2000, 1, 0, 0, '2018-07-28 16:08:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(67, 'TR-BL-20180728-000005', 20, 40, 120000, 140000, 130000, 1, 0, 0, '2018-07-28 16:08:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(68, 'TR-BL-20180728-000005', 17, 100, 5000, 7000, 6000, 1, 0, 0, '2018-07-28 16:08:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(69, 'TR-BL-20180728-000006', 9, 10, 120000, 140000, 130000, 1, 0, 0, '2018-07-28 16:12:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(70, 'TR-BL-20180728-000006', 17, 12, 110000, 130000, 120000, 1, 0, 0, '2018-07-28 16:12:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(71, 'TR-BL-20180728-000006', 14, 120, 120000, 140000, 130000, 1, 0, 0, '2018-07-28 16:12:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(72, 'TR-BL-20180728-000006', 18, 100, 130000, 150000, 140000, 1, 0, 0, '2018-07-28 16:12:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(73, 'TR-BL-20180729-000001', 9, 10, 10, 100, 10, 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(74, 'TR-BL-20180729-000001', 12, 1, 120, 120, 120, 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(75, 'TR-BL-20180729-000001', 14, 1, 130, 121, 1201, 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(76, 'TR-BL-20180729-000001', 15, 9, 99, 9, 9, 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(77, 'TR-BL-20180729-000001', 20, 24, 8, 8, 8, 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(78, 'TR-BL-20180729-000001', 11, 8, 8, 8, 8, 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(79, 'TR-BL-20180729-000001', 16, 8, 8, 8, 8, 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(80, 'TR-BL-20180729-000001', 17, 7, 7, 7, 7, 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(81, 'TR-BL-20180729-000001', 18, 9, 9, 9, 9, 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(82, 'TR-BL-20180729-000001', 13, 8, 8, 8, 8, 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(83, 'TR-BL-20180729-000001', 19, 8, 8, 8, 8, 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(84, 'TR-BL-20180729-000001', 10, 9, 8, 88, 8, 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(85, 'TR-BL-20180729-000001', 21, 9, 9999, 999, 9999, 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(86, 'TR-BL-20180729-000001', 22, 8, 8, 8, 8, 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(87, 'TR-BL-20180729-000002', 9, 9, 9, 9, 9, 1, 0, 0, '2018-07-30 03:39:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(88, 'TR-BL-20180729-000002', 16, 2, 90, 9, 9, 1, 0, 0, '2018-07-30 03:39:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(89, 'TR-BL-20180729-000002', 14, 9, 89, 8, 89, 1, 0, 0, '2018-07-30 03:39:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(90, 'TR-BL-20180731-000001', 9, 11, 20, 20, 20, 1, 0, 0, '2018-07-31 10:33:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(91, 'TR-BL-20180731-000001', 12, 11, 3000, 1111, 2000, 1, 0, 0, '2018-07-31 10:33:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(92, 'TR-BL-20180731-000001', 14, 8, 88, 8, 8, 1, 0, 0, '2018-07-31 10:33:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(93, 'TR-BL-20180731-000001', 15, 7, 8, 7, 7, 1, 0, 0, '2018-07-31 10:33:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(94, 'TR-BL-20180731-000001', 20, 8, 8, 8, 8, 1, 0, 0, '2018-07-31 10:33:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(95, 'TR-BL-20180731-000002', 9, 8, 8, 8, 8, 1, 0, 0, '2018-07-31 10:34:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(96, 'TR-BL-20180731-000002', 12, 7, 7, 7, 7, 1, 0, 0, '2018-07-31 10:34:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(97, 'TR-BL-20180731-000002', 21, 22, 9, 9, 9, 1, 0, 0, '2018-07-31 10:34:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(98, 'TR-BL-20180731-000002', 22, 8, 8, 88, 8, 1, 0, 0, '2018-07-31 10:34:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(99, 'TR-BL-20180731-000002', 10, 88, 88, 88, 88, 1, 0, 0, '2018-07-31 10:34:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(100, 'TR-BL-20180731-000003', 12, 9, 89, 89, 89, 1, 0, 0, '2018-07-31 10:36:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(101, 'TR-BL-20180731-000003', 16, 88, 88, 88, 88, 1, 0, 0, '2018-07-31 10:36:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(102, 'TR-BL-20180731-000003', 14, 89, 89, 89, 89, 1, 0, 0, '2018-07-31 10:36:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(103, 'TR-BL-20180731-000003', 17, 99, 99, 99, 99, 1, 0, 0, '2018-07-31 10:36:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(104, 'TR-BL-20180731-000003', 13, 77, 77, 77, 77, 1, 0, 0, '2018-07-31 10:36:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(105, 'TR-BL-20180731-000003', 19, 9898, 898, 9898, 9898, 1, 0, 0, '2018-07-31 10:36:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(106, 'TR-BL-20180731-000003', 21, 98, 89, 98, 89, 1, 0, 0, '2018-07-31 10:36:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_belanja_header`
--

CREATE TABLE IF NOT EXISTS `transaksi_belanja_header` (
`id` int(11) NOT NULL,
  `id_transaksi_belanja` char(25) NOT NULL,
  `id_suplier` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `total_pembayaran` int(20) NOT NULL,
  `user_id-add` int(11) NOT NULL,
  `user_id-upd` int(11) NOT NULL,
  `user_id-del` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_belanja_header`
--

INSERT INTO `transaksi_belanja_header` (`id`, `id_transaksi_belanja`, `id_suplier`, `tanggal`, `waktu`, `total_pembayaran`, `user_id-add`, `user_id-upd`, `user_id-del`, `date_created`, `last_updated`, `last_deleted`, `deleted_status`) VALUES
(38, 'TR-BL-20180727-000001', 4, '2018-07-27', '08:47:36', 14400000, 1, 0, 1, '2018-07-28 01:47:36', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0),
(39, 'TR-BL-20180728-000001', 6, '2018-07-28', '09:59:10', 13000000, 8, 0, 1, '2018-07-28 02:59:10', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0),
(40, 'TR-BL-20180728-000002', 4, '2018-07-28', '16:53:49', 14400000, 1, 0, 1, '2018-07-28 09:53:49', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0),
(41, 'TR-BL-20180728-000003', 4, '2018-07-28', '17:02:49', 20000000, 1, 0, 1, '2018-07-28 10:02:49', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0),
(42, 'TR-BL-20180728-000004', 4, '2018-07-28', '22:35:00', 296000000, 1, 0, 1, '2018-07-28 15:35:00', '0000-00-00 00:00:00', '2018-07-28 16:03:28', 0),
(43, 'TR-BL-20180728-000005', 4, '2018-07-28', '23:08:23', 9500000, 1, 0, 0, '2018-07-28 16:08:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(44, 'TR-BL-20180728-000006', 4, '2018-07-28', '23:12:25', 29920000, 1, 0, 0, '2018-07-28 16:12:25', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(45, 'TR-BL-20180729-000001', 4, '2018-07-29', '10:38:01', 91946, 1, 0, 0, '2018-07-30 03:38:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(46, 'TR-BL-20180729-000002', 4, '2018-07-29', '10:39:36', 1062, 1, 0, 0, '2018-07-30 03:39:36', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(47, 'TR-BL-20180731-000001', 4, '2018-07-31', '17:33:20', 34044, 1, 0, 0, '2018-07-31 10:33:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(48, 'TR-BL-20180731-000002', 4, '2018-07-31', '17:34:46', 8119, 1, 0, 0, '2018-07-31 10:34:46', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0),
(49, 'TR-BL-20180731-000003', 4, '2018-07-31', '17:36:28', 8929322, 1, 0, 0, '2018-07-31 10:36:28', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_penjualan_detail`
--

CREATE TABLE IF NOT EXISTS `transaksi_penjualan_detail` (
`id_detail` int(11) NOT NULL,
  `id_transaksi_penjualan` char(25) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(5) NOT NULL,
  `harga_jual_angsur` int(20) NOT NULL,
  `harga_jual_tunai` int(20) NOT NULL,
  `user_id-add` int(11) unsigned NOT NULL,
  `user_id-upd` int(11) unsigned NOT NULL,
  `user_id-del` int(11) unsigned NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_penjualan_header`
--

CREATE TABLE IF NOT EXISTS `transaksi_penjualan_header` (
`id` int(11) NOT NULL,
  `id_transaksi_penjualan` char(25) NOT NULL,
  `jenis_pembeli` enum('kelompoktani','pribadi') NOT NULL,
  `kelompoktani` int(11) NOT NULL,
  `konsumen_pribadi` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `jenis_pembayaran` enum('tunai','angsur') NOT NULL,
  `jenis_angsuran` enum('per_barang','per_pembayaran','') NOT NULL,
  `penambahan_biaya_angsuran_perpembayaran` int(20) NOT NULL,
  `total_pembayaran_tunai` int(20) NOT NULL,
  `total_pembayaran_angsur` int(20) NOT NULL,
  `id_penyandangdana` int(11) NOT NULL,
  `user_id-add` int(11) NOT NULL,
  `user_id-upd` int(11) NOT NULL,
  `user_id-del` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_updated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_deleted` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) unsigned NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `picture_name` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `picture_name`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', NULL, NULL, NULL, NULL, 1268889823, 1533159858, 1, 'Super', 'Admin', 'KUD', '088888888', 'images.png'),
(8, '::1', 'karyawan kud', '$2y$08$6VAVqqh0a/qsL/tn2Xp9iuq5/FOQ.iGE77IxP4E8YptLqvkxncRuO', NULL, 'aan@gmail.com', NULL, NULL, NULL, NULL, 1531626912, 1532746699, 1, 'Aan', 'M', 'KUD', '0823828282', '');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
`id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(47, 1, 1),
(29, 2, 3),
(41, 3, 3),
(27, 4, 2),
(45, 5, 2),
(38, 6, 2),
(39, 6, 3),
(40, 6, 6),
(44, 7, 2),
(49, 8, 2),
(50, 8, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_preferences`
--
ALTER TABLE `admin_preferences`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
 ADD PRIMARY KEY (`id_barang`), ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `data_kud`
--
ALTER TABLE `data_kud`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
 ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kelompok_tani`
--
ALTER TABLE `kelompok_tani`
 ADD PRIMARY KEY (`id_kelompok_tani`);

--
-- Indexes for table `konsumen_pribadi`
--
ALTER TABLE `konsumen_pribadi`
 ADD PRIMARY KEY (`id_konsumenpribadi`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
 ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `menus_preferences`
--
ALTER TABLE `menus_preferences`
 ADD PRIMARY KEY (`id`), ADD KEY `group_id` (`menu_id`), ADD KEY `menu_id` (`menu_id`), ADD KEY `group_id_2` (`group_id`);

--
-- Indexes for table `penyandang_dana`
--
ALTER TABLE `penyandang_dana`
 ADD PRIMARY KEY (`id_penyandangdana`);

--
-- Indexes for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
 ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `stok_barang`
--
ALTER TABLE `stok_barang`
 ADD PRIMARY KEY (`id_stok`), ADD KEY `id_kategori` (`masuk`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
 ADD PRIMARY KEY (`id_suplier`);

--
-- Indexes for table `transaksi_belanja_detail`
--
ALTER TABLE `transaksi_belanja_detail`
 ADD PRIMARY KEY (`id_detail`), ADD KEY `id_transaksi_belanja` (`id_transaksi_belanja`), ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `transaksi_belanja_header`
--
ALTER TABLE `transaksi_belanja_header`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_transaksi_belanja` (`id_transaksi_belanja`);

--
-- Indexes for table `transaksi_penjualan_detail`
--
ALTER TABLE `transaksi_penjualan_detail`
 ADD PRIMARY KEY (`id_detail`), ADD KEY `id_transaksi_belanja` (`id_transaksi_penjualan`), ADD KEY `id_barang` (`id_barang`), ADD KEY `id_transaksi_penjualan` (`id_transaksi_penjualan`);

--
-- Indexes for table `transaksi_penjualan_header`
--
ALTER TABLE `transaksi_penjualan_header`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id_transaksi_penjualan` (`id_transaksi_penjualan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`), ADD KEY `fk_users_groups_users1_idx` (`user_id`), ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_preferences`
--
ALTER TABLE `admin_preferences`
MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `data_kud`
--
ALTER TABLE `data_kud`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
MODIFY `id_kategori` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `kelompok_tani`
--
ALTER TABLE `kelompok_tani`
MODIFY `id_kelompok_tani` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `konsumen_pribadi`
--
ALTER TABLE `konsumen_pribadi`
MODIFY `id_konsumenpribadi` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
MODIFY `menu_id` tinyint(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `menus_preferences`
--
ALTER TABLE `menus_preferences`
MODIFY `id` mediumint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=151;
--
-- AUTO_INCREMENT for table `penyandang_dana`
--
ALTER TABLE `penyandang_dana`
MODIFY `id_penyandangdana` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
MODIFY `id_satuan` tinyint(2) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stok_barang`
--
ALTER TABLE `stok_barang`
MODIFY `id_stok` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `suplier`
--
ALTER TABLE `suplier`
MODIFY `id_suplier` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `transaksi_belanja_detail`
--
ALTER TABLE `transaksi_belanja_detail`
MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `transaksi_belanja_header`
--
ALTER TABLE `transaksi_belanja_header`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `transaksi_penjualan_detail`
--
ALTER TABLE `transaksi_penjualan_detail`
MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transaksi_penjualan_header`
--
ALTER TABLE `transaksi_penjualan_header`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_barang` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_belanja_detail`
--
ALTER TABLE `transaksi_belanja_detail`
ADD CONSTRAINT `transaksi_belanja_detail_ibfk_1` FOREIGN KEY (`id_transaksi_belanja`) REFERENCES `transaksi_belanja_header` (`id_transaksi_belanja`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `transaksi_belanja_detail_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_penjualan_detail`
--
ALTER TABLE `transaksi_penjualan_detail`
ADD CONSTRAINT `transaksi_penjualan_detail_ibfk_1` FOREIGN KEY (`id_transaksi_penjualan`) REFERENCES `transaksi_penjualan_header` (`id_transaksi_penjualan`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
