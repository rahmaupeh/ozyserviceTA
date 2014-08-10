-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 11, 2014 at 12:58 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ozyservice`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` text NOT NULL,
  `password` text NOT NULL,
  `bagian` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `password`, `bagian`) VALUES
(1, 'warehouse', 'warehouse', 'gudang'),
(2, 'sales', 'sales', 'penjualan');

-- --------------------------------------------------------

--
-- Table structure for table `data_barang`
--

CREATE TABLE IF NOT EXISTS `data_barang` (
  `kode_barang` varchar(20) NOT NULL,
  `no_parts` varchar(20) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `harga_beli` float NOT NULL,
  `harga_jual` float NOT NULL,
  `stock` int(10) NOT NULL,
  `stock toko` int(10) NOT NULL,
  `diskon` int(3) NOT NULL,
  PRIMARY KEY (`kode_barang`),
  UNIQUE KEY `no_parts` (`no_parts`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_barang`
--

INSERT INTO `data_barang` (`kode_barang`, `no_parts`, `nama_barang`, `kategori`, `harga_beli`, `harga_jual`, `stock`, `stock toko`, `diskon`) VALUES
('PB2014-0003', 'SPRS-001', 'Busi NGK C7HSA', 'sparkplugs', 9000, 11000, 17, 15, 0),
('PB2014-0004', 'ICH-IH-001', 'Rantai 420-120 (ich)', 'chain', 38000, 42000, 158, 94, 0),
('PB2014-0005', 'WN-1420-00', 'Beat Biru Muda', 'cover body', 187000, 145000, 200, 30, 23),
('PB2014-0006', '', 'Top 1 OIL 0.8', 'oli', 28000, 30000, 173, 67, 0),
('PB2014-0007', 'IH-001', 'Bearing 6205 (ichida', 'bearing', 9000, 13000, 100, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE IF NOT EXISTS `detail_penjualan` (
  `kode_transaksi` varchar(20) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `harga` int(20) NOT NULL,
  `diskon` int(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`kode_transaksi`, `kode_barang`, `jumlah`, `harga`, `diskon`) VALUES
('KTO2014-0001', 'PB2014-0003', 3, 11000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `input_coa`
--

CREATE TABLE IF NOT EXISTS `input_coa` (
  `kode_akun` int(10) NOT NULL AUTO_INCREMENT,
  `reff` varchar(6) NOT NULL,
  `type` varchar(20) NOT NULL,
  `nama_akun` varchar(25) NOT NULL,
  PRIMARY KEY (`kode_akun`),
  UNIQUE KEY `reff` (`reff`),
  UNIQUE KEY `reff_2` (`reff`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `input_coa`
--

INSERT INTO `input_coa` (`kode_akun`, `reff`, `type`, `nama_akun`) VALUES
(3, '101', 'asset', 'kas'),
(4, '102', 'asset', 'Kas Bank'),
(5, '501', 'beban', 'Pembelian'),
(6, '301', 'modal', 'Modal'),
(7, '402', 'pendapatan', 'penjualan kredit'),
(8, '403', 'pendapatan', 'Diskon Penjualan'),
(9, '502', 'beban', 'Hpp'),
(10, '601', 'pendapatan lain lain', 'Pendapatan lain - lain'),
(11, '401', 'pendapatan', 'penjualan'),
(12, '104', 'asset', 'piutang dagang'),
(13, '103', 'asset', 'piutang dagang lain-lain'),
(14, '404', 'pendapatan', 'retur penjualan');

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE IF NOT EXISTS `jurnal` (
  `tanggal` date NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `ref` varchar(50) NOT NULL,
  `debit` int(10) NOT NULL,
  `kredit` int(10) NOT NULL,
  `pelanggan` varchar(20) NOT NULL,
  `no` int(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`no`),
  UNIQUE KEY `no` (`no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`tanggal`, `keterangan`, `ref`, `debit`, `kredit`, `pelanggan`, `no`) VALUES
('2014-08-11', 'piutang dagang', '104', 196000, 0, 'COZ2014-0002', 1),
('2014-08-11', 'penjualan kredit', '402', 0, 196000, 'COZ2014-0002', 2),
('2014-08-11', 'piutang dagang', '104', 98000, 0, 'COZ2014-0004', 3),
('2014-08-11', 'penjualan kredit', '402', 0, 98000, 'COZ2014-0004', 4),
('2014-08-11', 'piutang dagang', '104', 33000, 0, 'COZ2014-0002', 5),
('2014-08-11', 'penjualan kredit', '402', 0, 33000, 'COZ2014-0002', 6);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_pelanggan` varchar(20) NOT NULL,
  `nama_pelanggan` text NOT NULL,
  `toko` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` text NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `toko`, `alamat`, `no_telepon`, `email`) VALUES
('COZ2014-0001', 'Hendra ', 'Hendra Motor 1', 'Jln Pasar 1 no:235', '085723365512', 'hendrabanget@yahoo.com'),
('COZ2014-0002', 'Akiet', 'Central', 'Jln Yos Sudarso no:56', '085723365512', 'Centralbengkel@yahoo.com'),
('COZ2014-0003', 'Ali', 'Setia Motor', 'Jln Setia Budi no:88', '061-7784566', 'Setia_motor@gmail.com'),
('COZ2014-0004', 'Jeffry', 'Wijaya Motor', 'Jn Iskandar Muda no 90', '061-6611059', 'WM@gmail.com'),
('COZ2014-0005', 'Andi Permana', 'Bengkel Andi', 'Jln Budi Katamso No: 12, Medan', '087822629900', 'Andipermana@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran_barang`
--

CREATE TABLE IF NOT EXISTS `pengeluaran_barang` (
  `kode_surat` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`kode_surat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran_barang`
--


-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran_barang_detail`
--

CREATE TABLE IF NOT EXISTS `pengeluaran_barang_detail` (
  `kode_surat` varchar(20) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran_barang_detail`
--

INSERT INTO `pengeluaran_barang_detail` (`kode_surat`, `kode_barang`, `jumlah`, `status`) VALUES
('SP2014-0001', 'PB2014-0004', 3, 'belum proses'),
('SP2014-0001', 'PB2014-0004', 3, 'belum proses');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE IF NOT EXISTS `penjualan` (
  `kode_faktur` varchar(20) NOT NULL,
  `kode_transaksi` varchar(20) NOT NULL,
  `tanggal_jatuh_tempo` date NOT NULL,
  PRIMARY KEY (`kode_faktur`),
  UNIQUE KEY `kode_transaksi` (`kode_transaksi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`kode_faktur`, `kode_transaksi`, `tanggal_jatuh_tempo`) VALUES
('FKO2014-0002', 'KTO2014-0002', '2014-09-20'),
('FKO2014-0001', 'KTO2014-0001', '2014-08-16');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_barang`
--

CREATE TABLE IF NOT EXISTS `permintaan_barang` (
  `kode_surat` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`kode_surat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_barang`
--


-- --------------------------------------------------------

--
-- Table structure for table `permintaan_barang_detail`
--

CREATE TABLE IF NOT EXISTS `permintaan_barang_detail` (
  `kode_surat` varchar(20) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_barang_detail`
--


-- --------------------------------------------------------

--
-- Table structure for table `retur`
--

CREATE TABLE IF NOT EXISTS `retur` (
  `kode_retur` varchar(20) NOT NULL,
  `kode_faktur` varchar(20) NOT NULL,
  `tanggal_retur` date NOT NULL,
  PRIMARY KEY (`kode_retur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retur`
--


-- --------------------------------------------------------

--
-- Table structure for table `retur_detail`
--

CREATE TABLE IF NOT EXISTS `retur_detail` (
  `kode_retur` varchar(20) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `jumlah` int(10) NOT NULL,
  `jumlah_retur` int(5) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `retur_detail`
--


-- --------------------------------------------------------

--
-- Table structure for table `surat_penagihan`
--

CREATE TABLE IF NOT EXISTS `surat_penagihan` (
  `no_surat_penagihan` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`no_surat_penagihan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_penagihan`
--

INSERT INTO `surat_penagihan` (`no_surat_penagihan`, `tanggal`) VALUES
('SPO2014-0001', '2014-08-20'),
('SPO2014-0002', '2014-09-21');

-- --------------------------------------------------------

--
-- Table structure for table `surat_penagihan_detail`
--

CREATE TABLE IF NOT EXISTS `surat_penagihan_detail` (
  `no_surat_penagihan` varchar(20) NOT NULL,
  `kode_faktur` varchar(20) NOT NULL,
  UNIQUE KEY `kode_faktur` (`kode_faktur`),
  UNIQUE KEY `kode_faktur_2` (`kode_faktur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `surat_penagihan_detail`
--


-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `kode_transaksi` varchar(20) NOT NULL,
  `id_pelanggan` varchar(20) NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `tanggal_lunas` date NOT NULL,
  `diskon` int(20) NOT NULL,
  `total_harga` int(20) NOT NULL,
  PRIMARY KEY (`kode_transaksi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`kode_transaksi`, `id_pelanggan`, `tanggal_pesan`, `tanggal_lunas`, `diskon`, `total_harga`) VALUES
('KTO2014-0001', 'COZ2014-0002', '2014-08-11', '0000-00-00', 0, 33000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
