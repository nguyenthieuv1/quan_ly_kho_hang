-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for quan_ly_kho_hang_2
CREATE DATABASE IF NOT EXISTS `quan_ly_kho_hang_2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `quan_ly_kho_hang_2`;

-- Dumping structure for table quan_ly_kho_hang_2.tblkho
CREATE TABLE IF NOT EXISTS `tblkho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(50) DEFAULT NULL,
  `vitri` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_kho_hang_2.tblkho: ~2 rows (approximately)
REPLACE INTO `tblkho` (`id`, `ten`, `vitri`) VALUES
	(1, 'khohang1', 'hadong'),
	(2, 'khohang2', 'hoangmai'),
	(3, 'khohang3', 'caugiay');

-- Dumping structure for table quan_ly_kho_hang_2.tblloaisanpham
CREATE TABLE IF NOT EXISTS `tblloaisanpham` (
  `id` int(11) NOT NULL,
  `tenloai` varchar(50) DEFAULT NULL,
  `tblkhoid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__tblkho` (`tblkhoid`),
  CONSTRAINT `FK__tblkho` FOREIGN KEY (`tblkhoid`) REFERENCES `tblkho` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_kho_hang_2.tblloaisanpham: ~5 rows (approximately)
REPLACE INTO `tblloaisanpham` (`id`, `tenloai`, `tblkhoid`) VALUES
	(1, 'điều hòa', 1),
	(2, 'tủ lạnh', 1),
	(3, 'máy giặt', 1),
	(4, 'ti vi', 1),
	(5, 'quạt ', 1);

-- Dumping structure for table quan_ly_kho_hang_2.tblphieunhap
CREATE TABLE IF NOT EXISTS `tblphieunhap` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ngaynhap` datetime DEFAULT NULL,
  `soluongnhap` int(11) DEFAULT NULL,
  `tblsanphamid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tblphhieunhap_tblsanpham` (`tblsanphamid`),
  CONSTRAINT `FK_tblphhieunhap_tblsanpham` FOREIGN KEY (`tblsanphamid`) REFERENCES `tblsanpham` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_kho_hang_2.tblphieunhap: ~9 rows (approximately)
REPLACE INTO `tblphieunhap` (`id`, `ngaynhap`, `soluongnhap`, `tblsanphamid`) VALUES
	(4, '2024-05-14 00:00:00', 12, 23),
	(5, '2024-05-14 00:00:00', 100, 24),
	(6, '2024-05-14 00:00:00', 8, 25),
	(7, '2024-05-14 16:38:29', 46, 26),
	(8, '2024-05-14 16:46:53', 100, 24),
	(9, '2024-05-14 17:03:54', 10, 1),
	(10, '2024-05-14 17:05:21', 2, 1),
	(11, '2024-05-14 17:05:54', 2, 1),
	(12, '2024-05-14 17:08:05', 4, 1),
	(13, '2024-05-14 22:16:32', 40, 1),
	(14, '2024-05-15 18:36:15', 10, 3);

-- Dumping structure for table quan_ly_kho_hang_2.tblphieuxuat
CREATE TABLE IF NOT EXISTS `tblphieuxuat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ngayxuat` datetime DEFAULT NULL,
  `soluongxuat` int(11) DEFAULT NULL,
  `tblsanphamid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_tblphieuxuat_tblsanpham` (`tblsanphamid`),
  CONSTRAINT `FK_tblphieuxuat_tblsanpham` FOREIGN KEY (`tblsanphamid`) REFERENCES `tblsanpham` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_kho_hang_2.tblphieuxuat: ~8 rows (approximately)
REPLACE INTO `tblphieuxuat` (`id`, `ngayxuat`, `soluongxuat`, `tblsanphamid`) VALUES
	(1, '2024-05-14 00:00:00', 2, 1),
	(2, '2024-05-14 00:00:00', 2, 1),
	(3, '2024-05-14 17:12:58', 1, 1),
	(4, '2024-05-14 22:14:22', 1, 1),
	(5, '2024-05-15 08:48:08', 23, 1),
	(6, '2024-05-15 08:50:56', 5, 26),
	(7, '2024-05-15 08:51:21', 12, 22),
	(8, '2024-05-15 18:36:47', 15, 1);

-- Dumping structure for table quan_ly_kho_hang_2.tblsanpham
CREATE TABLE IF NOT EXISTS `tblsanpham` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten` varchar(50) DEFAULT NULL,
  `gia` float DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `tblloaisanphamid` int(11) DEFAULT NULL,
  `donvi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__tblloaisanpham` (`tblloaisanphamid`) USING BTREE,
  CONSTRAINT `FK__tblloaisanpham` FOREIGN KEY (`tblloaisanphamid`) REFERENCES `tblloaisanpham` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_kho_hang_2.tblsanpham: ~18 rows (approximately)
REPLACE INTO `tblsanpham` (`id`, `ten`, `gia`, `soluong`, `tblloaisanphamid`, `donvi`) VALUES
	(1, 'daikin-9000btu', 12000000, 26, 1, 'cái'),
	(2, 'lg-tl1', 14000000, 15, 2, 'cái'),
	(3, 'daikin-12000btu', 15000000, 26, 1, 'cái'),
	(4, 'lg-9000btu', 10000000, 15, 1, 'cái'),
	(5, 'lg-mg1', 9000000, 14, 3, 'cái'),
	(6, 'lg-mg2', 12000000, 12, 3, 'cái'),
	(10, 'quạt trần panasonic', 3800000, 29, 5, 'cái'),
	(11, 'quạt panasonic dk-123', 2000000, 30, 5, 'cái'),
	(12, 'tủ 2 cánh funiki m13', 6000000, 25, 1, 'chiếc'),
	(18, 'daikin 24000btu', 22500000, 12, 1, 'cái'),
	(19, 'funiki-18000btu', 15000000, 16, 1, 'cái'),
	(20, 'ti vi samsung 55 inch oled', 38000000, 16, 4, 'cái'),
	(21, 'máy gặt aqua 12kg cửa trên', 6000000, 12, 3, 'cái'),
	(22, 'máy giặt aqua cửa trên 8kg', 5000000, 22, 3, 'cái'),
	(23, 'tủ lạnh hitachi side by side', 29000000, 12, 2, 'cái'),
	(24, 'abc', 12321300, 200, 1, 'cái'),
	(25, 'quạt hơi nước funiki 2024', 4000000, 8, 5, 'cái'),
	(26, 'quạt tích điện nakagawa', 800000, 41, 5, 'cái');

-- Dumping structure for table quan_ly_kho_hang_2.tbluser
CREATE TABLE IF NOT EXISTS `tbluser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `ten` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table quan_ly_kho_hang_2.tbluser: ~0 rows (approximately)
REPLACE INTO `tbluser` (`id`, `username`, `password`, `ten`) VALUES
	(1, 'admin', '1', 'nguyen nhu thieu');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
