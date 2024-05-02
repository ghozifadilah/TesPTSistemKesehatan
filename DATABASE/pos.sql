-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 02, 2024 at 06:01 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `ID` int(11) NOT NULL,
  `KODEBRG` char(10) DEFAULT NULL,
  `NAMABRG` char(100) DEFAULT NULL,
  `SATUAN` char(10) DEFAULT NULL,
  `HARGABELI` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barang`
--

INSERT INTO `tbl_barang` (`ID`, `KODEBRG`, `NAMABRG`, `SATUAN`, `HARGABELI`) VALUES
(1, 'Hario JP v', 'Hario Dripper', '12', 200000),
(3, 'PDR324', 'Paperf ilter  Hario', '20', 20),
(4, 'CT345', 'Hario Scale', '2', 500),
(5, 'CF214', 'Hario Filter Coffee 40Pcs', '20', 100),
(6, 'DRsdr', 'Drip Paper 100pcs', '20', 200);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dbeli`
--

CREATE TABLE `tbl_dbeli` (
  `ID` int(11) NOT NULL,
  `NOTRANSAKSI` char(10) DEFAULT NULL,
  `KODEBRG` char(10) DEFAULT NULL,
  `HARGABELI` int(11) DEFAULT NULL,
  `QTY` int(11) DEFAULT NULL,
  `DISKON` int(11) DEFAULT NULL,
  `DISKONRP` int(11) DEFAULT NULL,
  `TOTALRP` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_dbeli`
--

INSERT INTO `tbl_dbeli` (`ID`, `NOTRANSAKSI`, `KODEBRG`, `HARGABELI`, `QTY`, `DISKON`, `DISKONRP`, `TOTALRP`) VALUES
(1, 'B202405001', 'Hario JP v', 200000, 12, 12, 12, 12),
(3, 'B202405002', 'PDR324', 20, 20, 10, 360, 400),
(4, 'B202405003', 'CT345', 500, 2, 1, 990, 1000),
(5, 'B202405004', 'CF214', 100, 5, 10, 450, 500),
(6, 'B202405005', 'DRsdr', 200, 20, 50, 2000, 4000);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hbeli`
--

CREATE TABLE `tbl_hbeli` (
  `ID` int(11) NOT NULL,
  `NOTRANSAKSI` char(10) DEFAULT NULL,
  `KODESPL` char(10) DEFAULT NULL,
  `TGLBELI` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hbeli`
--

INSERT INTO `tbl_hbeli` (`ID`, `NOTRANSAKSI`, `KODESPL`, `TGLBELI`) VALUES
(3, 'B202405002', 'HR414', '2024-05-02 11:57:07'),
(4, 'B202405003', 'HR414', '2024-05-02 12:02:53'),
(5, 'B202405004', 'HR414', '2024-05-02 12:04:21'),
(6, 'B202405005', 'HR414', '2024-05-02 12:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hutang`
--

CREATE TABLE `tbl_hutang` (
  `ID` int(11) NOT NULL,
  `NOTRANSAKSI` char(10) DEFAULT NULL,
  `KODESPL` char(10) DEFAULT NULL,
  `TGLBELI` datetime DEFAULT NULL,
  `TOTALHUTANG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_hutang`
--

INSERT INTO `tbl_hutang` (`ID`, `NOTRANSAKSI`, `KODESPL`, `TGLBELI`, `TOTALHUTANG`) VALUES
(1, 'B202405003', 'HR414', '2024-05-02 12:02:53', 1172500);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `KODEBRG` char(10) NOT NULL,
  `QTYBELI` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`KODEBRG`, `QTYBELI`) VALUES
('CF214', 5),
('CT345', 4),
('DRsdr', 20),
('Hario JP v', 15),
('PDR324', 20);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suplier`
--

CREATE TABLE `tbl_suplier` (
  `ID` int(11) NOT NULL,
  `KODESPL` char(10) DEFAULT NULL,
  `NAMASPL` char(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_suplier`
--

INSERT INTO `tbl_suplier` (`ID`, `KODESPL`, `NAMASPL`) VALUES
(1, 'HR414', 'Hario');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(23) NOT NULL,
  `user_group_id` int(23) DEFAULT NULL,
  `user_username` varchar(23) DEFAULT NULL,
  `user_password` text,
  `user_nama` varchar(23) DEFAULT NULL,
  `kontak` varchar(16) NOT NULL,
  `user_email` varchar(90) DEFAULT NULL,
  `user_hak_akses` enum('admin','petugas','sup_admin') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_group_id`, `user_username`, `user_password`, `user_nama`, `kontak`, `user_email`, `user_hak_akses`) VALUES
(1, NULL, 'admin', 'mbiB9iFwmeZSb8INFrnFc69ehVoFmZMcJF6Gqn3GHJA=', 'admin', '081977309422', 'ghozifadilah97@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(23) NOT NULL,
  `company_id` int(23) DEFAULT NULL,
  `role_id` varchar(23) DEFAULT NULL,
  `username` varchar(23) DEFAULT NULL,
  `password` varchar(242) DEFAULT NULL,
  `email` varchar(243) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `company_id`, `role_id`, `username`, `password`, `email`) VALUES
(4, 1, '1', 'admin', 'RkdsMHFmWnduSVNoVmRSKH5zfkrsPKqubx32vIOlpA==', 'ghozifadilah97@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_dbeli`
--
ALTER TABLE `tbl_dbeli`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_hbeli`
--
ALTER TABLE `tbl_hbeli`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_hutang`
--
ALTER TABLE `tbl_hutang`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`KODEBRG`);

--
-- Indexes for table `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_dbeli`
--
ALTER TABLE `tbl_dbeli`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_hbeli`
--
ALTER TABLE `tbl_hbeli`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_hutang`
--
ALTER TABLE `tbl_hutang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_suplier`
--
ALTER TABLE `tbl_suplier`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(23) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
