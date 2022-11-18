/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.19-MariaDB : Database - db_raja_cctv
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_raja_cctv` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_raja_cctv`;

/*Table structure for table `tb_detail_pemesanan` */

DROP TABLE IF EXISTS `tb_detail_pemesanan`;

CREATE TABLE `tb_detail_pemesanan` (
  `detail_pemesanan_id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_pemesanan_faktur` char(20) DEFAULT NULL,
  `detail_pemesanan_produk` int(11) DEFAULT NULL,
  `detail_pemesanan_qty` int(11) DEFAULT NULL,
  `detail_pemesanan_jumlah` double DEFAULT NULL,
  PRIMARY KEY (`detail_pemesanan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_detail_pemesanan` */

insert  into `tb_detail_pemesanan`(`detail_pemesanan_id`,`detail_pemesanan_faktur`,`detail_pemesanan_produk`,`detail_pemesanan_qty`,`detail_pemesanan_jumlah`) values 
(1,'PS-20220816-444',1,1,1600),
(2,'PS-20220816-218',1,2,3200),
(5,'PS-20220816-218',2,1,10000),
(6,'PS-20220821-831',1,1,1600),
(7,'PS-20220821-722',1,1,1600),
(8,'PS-20221108-879',1,1,3500000),
(9,'PS-20221108-785',1,1,3500000),
(10,'PS-20221108-474',1,1,3500000),
(11,'PS-20221108-122',1,1,3500000);

/*Table structure for table `tb_jenis` */

DROP TABLE IF EXISTS `tb_jenis`;

CREATE TABLE `tb_jenis` (
  `jenis_id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`jenis_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_jenis` */

insert  into `tb_jenis`(`jenis_id`,`jenis_nama`) values 
(1,'Jenis Satu'),
(2,'Jenis Dua'),
(3,'Jenis Tiga');

/*Table structure for table `tb_pelanggan` */

DROP TABLE IF EXISTS `tb_pelanggan`;

CREATE TABLE `tb_pelanggan` (
  `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pelanggan_email` varchar(255) DEFAULT NULL,
  `pelanggan_nama` varchar(255) DEFAULT NULL,
  `pelanggan_password` varchar(255) DEFAULT NULL,
  `pelanggan_nohp` varchar(100) DEFAULT NULL,
  `pelanggan_alamat` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pelanggan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pelanggan` */

insert  into `tb_pelanggan`(`pelanggan_id`,`pelanggan_email`,`pelanggan_nama`,`pelanggan_password`,`pelanggan_nohp`,`pelanggan_alamat`) values 
(1,'hanif@gmail.com','Hanif','$2y$10$PW5n6MKvXoq.gFBxn7pMG.sYZMzR1R0soDU4rfX83kGIms5gaLHhO','0805830852','Jalan Raya No. 2'),
(3,'emailtesting@gmail.com','Email Testing','$2y$10$kY2MV2vu3Hgk5KbrF33z..JYpkMplZCohiCYVdPswTEm9WKlYsJIC','0875937583','Padang'),
(4,'pelanggan@gmail.com','Pelanggan','$2y$10$51fIbYfPy/qmbMGqf2UHZuG5XnVDVHxuxx8EiZRQ7S./dxNHIvB1.','0824242','Padang'),
(5,'hanif19@gmail.com','arif','$2y$10$eA6wK4CiScIC63kt7BMP5eAQPZGXTkuHm.WnG6Ai/mTo8wR5gRP1S','081276429158','ujung gading');

/*Table structure for table `tb_pembayaran` */

DROP TABLE IF EXISTS `tb_pembayaran`;

CREATE TABLE `tb_pembayaran` (
  `pembayaran_id` int(11) NOT NULL AUTO_INCREMENT,
  `pembayaran_faktur` char(20) DEFAULT NULL,
  `pembayaran_tanggal` date DEFAULT NULL,
  `pembayaran_bukti` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pembayaran_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pembayaran` */

insert  into `tb_pembayaran`(`pembayaran_id`,`pembayaran_faktur`,`pembayaran_tanggal`,`pembayaran_bukti`) values 
(2,'PS-20220816-218','2022-08-18','1660778409_281bbc2e58e6da2fe809.png'),
(3,'PS-20220821-722','2022-08-21','1661095507_a300ebe1c10a9596ff0f.pdf'),
(4,'PS-20220821-831','2022-09-01','1661095332_79853b413e99fe68aeb3.png');

/*Table structure for table `tb_pemesanan` */

DROP TABLE IF EXISTS `tb_pemesanan`;

CREATE TABLE `tb_pemesanan` (
  `pemesanan_faktur` char(20) NOT NULL,
  `pemesanan_tanggal` date DEFAULT NULL,
  `pemesanan_pelanggan` int(11) DEFAULT NULL,
  `pemesanan_total_item` int(11) DEFAULT NULL,
  `pemesanan_total_harga` double DEFAULT NULL,
  `pemesanan_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`pemesanan_faktur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_pemesanan` */

insert  into `tb_pemesanan`(`pemesanan_faktur`,`pemesanan_tanggal`,`pemesanan_pelanggan`,`pemesanan_total_item`,`pemesanan_total_harga`,`pemesanan_status`) values 
('PS-20220816-218','2022-08-16',1,2,13200,1),
('PS-20220821-722','2022-08-21',5,1,1600,1),
('PS-20220821-831','2022-09-01',4,1,1600,1),
('PS-20221108-122','2022-11-09',3,1,3500000,0),
('PS-20221108-474','2022-11-09',1,1,3500000,0),
('PS-20221108-785','2022-11-09',1,1,3500000,3);

/*Table structure for table `tb_produk` */

DROP TABLE IF EXISTS `tb_produk`;

CREATE TABLE `tb_produk` (
  `produk_id` int(11) NOT NULL AUTO_INCREMENT,
  `produk_nama` varchar(255) DEFAULT NULL,
  `produk_jenis` int(11) DEFAULT NULL,
  `produk_harga` double DEFAULT NULL,
  `produk_deskripsi` varchar(255) DEFAULT NULL,
  `produk_gambar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`produk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_produk` */

insert  into `tb_produk`(`produk_id`,`produk_nama`,`produk_jenis`,`produk_harga`,`produk_deskripsi`,`produk_gambar`) values 
(1,'CCTV HDTVI 4 CAM',1,3500000,'CCTV murah dan bagus untuk nangkap maling','1660547916_484865763b4eae7695fd.jpg'),
(2,'CCTV HDTVI 8 CAM',2,5500000,'CCTV agak mahal dan mantap','default.png');

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(255) DEFAULT NULL,
  `user_nama` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_level` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

insert  into `tb_user`(`user_id`,`user_email`,`user_nama`,`user_password`,`user_level`) values 
(1,'superadmin@gmail.com','Super Admin','$2a$12$3P33mYjKTJ7Nx.qL/Ydg8O/1tZSjOgJa0gAeoub6ZTCXNFIfeMTBq',0),
(3,'pimpinan@gmail.com','Pimpinan','$2y$10$e11CnVB4g6sENgbjTH4XvunE2HsVOhhEWwLU/0SKjh.YY7BbPRyha',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
