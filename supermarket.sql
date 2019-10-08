-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2019 at 04:23 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `supermarket`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblbarang`
--

CREATE TABLE `tblbarang` (
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `kode_jenis` varchar(100) NOT NULL,
  `harga_net` varchar(100) NOT NULL,
  `harga_jual` varchar(100) NOT NULL,
  `stok` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbarang`
--

INSERT INTO `tblbarang` (`kode_barang`, `nama_barang`, `kode_jenis`, `harga_net`, `harga_jual`, `stok`) VALUES
('B001', 'Astor', 'J002', '500', '1000', '5'),
('B002', 'Buku Tulis', 'J003', '2000', '2500', '6'),
('B003', 'Baju Renang', 'J004', '50000', '60000', '5'),
('B004', 'Minyak Goreng', 'J001', '12000', '15000', '6'),
('B005', 'Toner', 'J005', '12500', '15000', '3');

-- --------------------------------------------------------

--
-- Table structure for table `tblbrgmasuk`
--

CREATE TABLE `tblbrgmasuk` (
  `no_nota` varchar(10) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `id_distributor` varchar(10) NOT NULL,
  `id_petugas` varchar(10) NOT NULL,
  `total` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbrgmasuk`
--

INSERT INTO `tblbrgmasuk` (`no_nota`, `tgl_masuk`, `id_distributor`, `id_petugas`, `total`) VALUES
('NOTA001', '2019-10-04', 'D003', 'P002', 114000),
('NOTA002', '2019-10-01', 'D002', 'P002', 10000);

--
-- Triggers `tblbrgmasuk`
--
DELIMITER $$
CREATE TRIGGER `delete_nota` AFTER DELETE ON `tblbrgmasuk` FOR EACH ROW BEGIN
	DELETE FROM tbldetailbrgmasuk WHERE no_nota=OLD.no_nota;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbldetailbrgmasuk`
--

CREATE TABLE `tbldetailbrgmasuk` (
  `no_nota` varchar(50) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `subtotal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldetailbrgmasuk`
--

INSERT INTO `tbldetailbrgmasuk` (`no_nota`, `kode_barang`, `jumlah`, `subtotal`) VALUES
('NOTA001', 'B002', '1', '2000'),
('NOTA001', 'B003', '2', '100000'),
('NOTA001', 'B004', '1', '12000'),
('NOTA002', 'B002', '5', '10000');

--
-- Triggers `tbldetailbrgmasuk`
--
DELIMITER $$
CREATE TRIGGER `hapus_items` BEFORE DELETE ON `tbldetailbrgmasuk` FOR EACH ROW BEGIN
	UPDATE tblbrgmasuk SET total = total - OLD.subtotal WHERE no_nota=no_nota;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kurangi_stok` AFTER DELETE ON `tbldetailbrgmasuk` FOR EACH ROW BEGIN
	UPDATE tblbarang set stok = stok - OLD.jumlah 
    where kode_barang = OLD.kode_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_stok` AFTER INSERT ON `tbldetailbrgmasuk` FOR EACH ROW BEGIN
	UPDATE tblbarang set stok = stok + NEW.jumlah 
    WHERE kode_barang = NEW.kode_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbldetailpenjualan`
--

CREATE TABLE `tbldetailpenjualan` (
  `no_faktur` varchar(100) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `subtotal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldetailpenjualan`
--

INSERT INTO `tbldetailpenjualan` (`no_faktur`, `kode_barang`, `jumlah`, `subtotal`) VALUES
('TRX001', 'B003', '3', '150000'),
('TRX002', 'B005', '2', '25000');

--
-- Triggers `tbldetailpenjualan`
--
DELIMITER $$
CREATE TRIGGER `hapus_item` BEFORE DELETE ON `tbldetailpenjualan` FOR EACH ROW BEGIN
	UPDATE tblpenjualan SET total = total - OLD.subtotal WHERE 			 no_faktur=no_faktur;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok_delete` AFTER DELETE ON `tbldetailpenjualan` FOR EACH ROW BEGIN
	UPDATE tblbarang set stok = stok + OLD.jumlah 
    where kode_barang = OLD.kode_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_stok_jual` AFTER INSERT ON `tbldetailpenjualan` FOR EACH ROW BEGIN
    UPDATE tblbarang set stok = stok - NEW.jumlah 
    where kode_barang = NEW.kode_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbldistributor`
--

CREATE TABLE `tbldistributor` (
  `id_distributor` varchar(10) NOT NULL,
  `nama_distributor` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kota_asal` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldistributor`
--

INSERT INTO `tbldistributor` (`id_distributor`, `nama_distributor`, `alamat`, `kota_asal`, `email`, `telepon`) VALUES
('D001', 'faidah aulia lating', 'jl.manunggal perum abm kav a 70', 'malang', 'faidalating2@gmail.com', '08817038497'),
('D002', 'rizka nur rahma', 'jl.sumpil ', 'banyuwangi', 'rizkaoke@gmail.com', '0882458979456'),
('D003', 'annisa artanti', 'jl.bulutangkis', 'surabaya', 'annisaartanti@gmail.com', '089766489574'),
('D004', 'aisyah', 'jl.papa biru', 'semarang', 'aisyah123@gmail.com', '08585634981'),
('D005', 'dinda kanya', 'jl.ahmad yani no 9', 'bandung', 'dindakanya@gmail.com', '0812334568865');

-- --------------------------------------------------------

--
-- Table structure for table `tbljenis`
--

CREATE TABLE `tbljenis` (
  `kode_jenis` varchar(10) NOT NULL,
  `jenis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbljenis`
--

INSERT INTO `tbljenis` (`kode_jenis`, `jenis`) VALUES
('J001', 'bahan pokok'),
('J002', 'snack'),
('J003', 'alat tulis'),
('J004', 'pakaian'),
('J005', 'make up');

-- --------------------------------------------------------

--
-- Table structure for table `tblpenjualan`
--

CREATE TABLE `tblpenjualan` (
  `no_faktur` varchar(10) NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `id_petugas` varchar(10) NOT NULL,
  `bayar` int(100) NOT NULL,
  `sisa` int(100) NOT NULL,
  `total` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpenjualan`
--

INSERT INTO `tblpenjualan` (`no_faktur`, `tgl_penjualan`, `id_petugas`, `bayar`, `sisa`, `total`) VALUES
('TRX001', '2019-10-06', 'P002', 158000, 2000, 148000),
('TRX002', '2019-10-08', 'P002', 28000, 3000, 25000);

--
-- Triggers `tblpenjualan`
--
DELIMITER $$
CREATE TRIGGER `delete_penjualan` AFTER DELETE ON `tblpenjualan` FOR EACH ROW BEGIN
	DELETE from tbldetailpenjualan where no_faktur=OLD.no_faktur;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tblpetugas`
--

CREATE TABLE `tblpetugas` (
  `id_petugas` varchar(10) NOT NULL,
  `nama_petugas` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpetugas`
--

INSERT INTO `tblpetugas` (`id_petugas`, `nama_petugas`, `alamat`, `email`, `telepon`, `password`) VALUES
('P001', 'Toni Bimantara', 'Jl.Raya Langsep', 'tonibimantara123@yahoo.coom', '08896745762', MD5(MD5('12345')),
('P002', 'bimantara', 'jl.langsep', 'bimantara123@yahoo.coom', '08892882762', MD5('12345')),
('P003', 'kirana citra', 'jl.kedawung no 6', 'kirana123@yahoo.com', '085455679234', MD5('12345')),
('P004', 'muhammad andi', 'jl.padepokan', 'mhmdandi@gmail.com', '08123356478', MD5('12345')),
('P005', 'silvi azzahra', 'jl.bumi palapa', 'silviazzahra@gmail.com', '08768332786', MD5('12345'));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblbarang`
--
ALTER TABLE `tblbarang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `tblbrgmasuk`
--
ALTER TABLE `tblbrgmasuk`
  ADD PRIMARY KEY (`no_nota`);

--
-- Indexes for table `tbldistributor`
--
ALTER TABLE `tbldistributor`
  ADD PRIMARY KEY (`id_distributor`);

--
-- Indexes for table `tbljenis`
--
ALTER TABLE `tbljenis`
  ADD PRIMARY KEY (`kode_jenis`);

--
-- Indexes for table `tblpenjualan`
--
ALTER TABLE `tblpenjualan`
  ADD PRIMARY KEY (`no_faktur`);

--
-- Indexes for table `tblpetugas`
--
ALTER TABLE `tblpetugas`
  ADD PRIMARY KEY (`id_petugas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
