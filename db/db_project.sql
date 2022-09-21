/*
MySQL Data Transfer
Source Host: localhost
Source Database: db_project
Target Host: localhost
Target Database: db_project
Date: 21/09/2022 10:02:06
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for tbl_artikel
-- ----------------------------
CREATE TABLE `tbl_artikel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_artikel` varchar(100) DEFAULT '',
  `tipe_id` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `flag_freemember` varchar(10) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `sumber` varchar(255) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `nama_file` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `profil_id` varchar(10) DEFAULT NULL,
  `logdate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for tbl_log_activity
-- ----------------------------
CREATE TABLE `tbl_log_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(50) DEFAULT NULL,
  `interfaces` varchar(50) DEFAULT '',
  `keterangan` varchar(50) DEFAULT NULL,
  `log_date` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tbl_mst_kategori
-- ----------------------------
CREATE TABLE `tbl_mst_kategori` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tipe` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `flag_active` tinyint(4) DEFAULT 1,
  `logdate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for tbl_mst_profil
-- ----------------------------
CREATE TABLE `tbl_mst_profil` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `alamat` text COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `telepon` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `user_id` bigint(20) DEFAULT 0,
  `flag_active` tinyint(4) DEFAULT 0,
  `logdate` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for tbl_mst_role
-- ----------------------------
CREATE TABLE `tbl_mst_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) COLLATE utf8_bin NOT NULL,
  `posisi` varchar(50) COLLATE utf8_bin NOT NULL,
  `logdate` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for tbl_mst_user
-- ----------------------------
CREATE TABLE `tbl_mst_user` (
  `id` bigint(20) NOT NULL,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `encrypted` varchar(200) COLLATE utf8_bin NOT NULL,
  `pin` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `status` varchar(10) COLLATE utf8_bin NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_create` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `tgl_create` timestamp NULL DEFAULT NULL,
  `user_update` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `tgl_update` timestamp NULL DEFAULT NULL,
  `logdate` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `tbl_artikel` VALUES ('1', 'TEKN-543D9302', '8', 'Dasar-dasar pembuatan website dengan Codeigneter', 'true', '0', 'dasar-dasar yang sobat butuhkan dalam membuat website dengan menggunakan framework Codeigneter. Pada bagian penduhuluan buku ini berisi tentang penjelasan, kelebihan dan fitur-fitur dari codeigneter dan dilanjutkan dengan melakukan instalasi server Xampp dan melakukan konfigurasi Codeigneter, pada tahap instalasi yang dilakukan tersedia gambar pada setiap langkahnya agar sobat dapat memahami dan juga bisa mengikutinya secara langsung', '2022-09-14', 'https://artinfo.my.id/baca/MTUyNE1LNA==/buku-pdf-pemrograman-3a-dasar-dasar-pembuatan-website-dengan-codeigneter', 'TEKN-543D9302_3.jpg', null, null, null, '10908131', '2022-09-14 14:23:43');
INSERT INTO `tbl_artikel` VALUES ('2', 'TEKN-574CB9B7', '8', 'Pengertian Dan Fungsi HTML (HyperText Markup Language)', 'true', '0', 'HTML adalah singkatan dari HyperText Markup Language yaitu bahasa pemrograman standar yang digunakan untuk membuat sebuah halaman web, yang kemudian dapat diakses untuk menampilkan berbagai informasi di dalam sebuah penjelajah web Internet (Browser). HTML dapat juga digunakan sebagai link link antara file-file dalam situs atau dalam komputer dengan menggunakan localhost, atau link yang menghubungkan antar situs dalam dunia internet.', '2022-02-02', 'https://wesclic.com/pengertian-dan-fungsi-html-hypertext-markup-language/', 'TEKN-574CB9B7_html-wesclic.png', null, null, null, '10908131', '2022-09-16 10:14:59');
INSERT INTO `tbl_log_activity` VALUES ('1', '10908131', 'Web', 'Login User', '2022-09-14 10:35:04');
INSERT INTO `tbl_log_activity` VALUES ('2', '10908131', 'Web', 'Login User', '2022-09-15 10:40:31');
INSERT INTO `tbl_log_activity` VALUES ('3', '10908131', 'Web', 'Login User', '2022-09-15 11:03:04');
INSERT INTO `tbl_log_activity` VALUES ('4', '10908131', 'Web', 'Login User', '2022-09-16 10:11:35');
INSERT INTO `tbl_log_activity` VALUES ('5', '10908131', 'Web', 'Login User', '2022-09-19 14:37:49');
INSERT INTO `tbl_log_activity` VALUES ('6', '10908131', 'Web', 'Login User', '2022-09-20 11:44:37');
INSERT INTO `tbl_log_activity` VALUES ('7', '10908131', 'website', 'Upload Artikel By Excel', '2022-09-20 16:13:34');
INSERT INTO `tbl_log_activity` VALUES ('8', '10908131', 'website', 'Upload Artikel By Excel', '2022-09-20 16:15:23');
INSERT INTO `tbl_log_activity` VALUES ('9', '10908131', 'website', 'Upload Artikel By Excel', '2022-09-20 16:17:18');
INSERT INTO `tbl_log_activity` VALUES ('10', '10908131', 'website', 'Upload Artikel By Excel', '2022-09-20 16:22:28');
INSERT INTO `tbl_log_activity` VALUES ('11', '10908131', 'website', 'Upload Artikel By Excel', '2022-09-20 16:22:53');
INSERT INTO `tbl_log_activity` VALUES ('12', '10908131', 'website', 'Upload Artikel By Excel', '2022-09-20 16:23:11');
INSERT INTO `tbl_log_activity` VALUES ('13', '10908131', 'website', 'Upload Artikel By Excel', '2022-09-20 16:23:40');
INSERT INTO `tbl_log_activity` VALUES ('14', '10908131', 'website', 'Upload Artikel By Excel', '2022-09-20 16:23:57');
INSERT INTO `tbl_log_activity` VALUES ('15', '10908131', 'website', 'Upload Artikel By Excel', '2022-09-20 16:39:43');
INSERT INTO `tbl_log_activity` VALUES ('16', '10908131', 'website', 'Upload Artikel By Excel', '2022-09-20 16:54:42');
INSERT INTO `tbl_log_activity` VALUES ('17', null, 'website', 'Upload Artikel By Excel', '2022-09-20 17:06:28');
INSERT INTO `tbl_mst_kategori` VALUES ('8', 'Teknologi', '2', '2022-09-16 10:25:56');
INSERT INTO `tbl_mst_role` VALUES ('1', 'Super', 'Owner', '2019-09-27 16:37:25');
INSERT INTO `tbl_mst_role` VALUES ('2', 'User', 'User', '2019-09-27 16:37:41');
INSERT INTO `tbl_mst_role` VALUES ('3', 'Member', 'Member', '2022-08-23 16:38:40');
INSERT INTO `tbl_mst_role` VALUES ('4', 'Programmer', 'Programmer', '2022-08-23 16:39:57');
INSERT INTO `tbl_mst_user` VALUES ('10908131', 'superadmin', '$2y$13$wgmxHp0nadJpu.5qZdhVIOkgIana80D2ycyWM1vFwZiUcPLqmqtPq', '1b41ccbb', '2', '1', null, null, null, null, null);
