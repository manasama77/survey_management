/*
 Navicat Premium Data Transfer

 Source Server         : maria 7.3
 Source Server Type    : MariaDB
 Source Server Version : 100410
 Source Host           : localhost:3306
 Source Schema         : inventoribaikdb

 Target Server Type    : MariaDB
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 16/07/2020 15:39:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `nik` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_cabang` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`nik`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('518.1111.1111', '$2y$10$Z/eas7I4BfwTqQIKeYXv1OD892vy.ZFzWiBHLR3ihLPkVWVe9MJ16', 'Super Admin', '7d19e099-4d71-11ea-a704-d85de2d0ff30');

-- ----------------------------
-- Table structure for aplikasi
-- ----------------------------
DROP TABLE IF EXISTS `aplikasi`;
CREATE TABLE `aplikasi`  (
  `nama_aplikasi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `nama_perusahaan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `alamat_perusahaan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NULL DEFAULT NULL,
  `tanggal_berdiri` date NULL DEFAULT NULL,
  `telepon_perusahaan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NULL DEFAULT NULL,
  `email_perusahaan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NULL DEFAULT NULL,
  `logo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`nama_aplikasi`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of aplikasi
-- ----------------------------
INSERT INTO `aplikasi` VALUES ('BAIK Inventory', 'KSPPS Baytul Ikhtiar', 'test', '2020-02-11', '0123456789', 'baik@gmail.com', 'logo_sm2.png');

-- ----------------------------
-- Table structure for bahan_dasar
-- ----------------------------
DROP TABLE IF EXISTS `bahan_dasar`;
CREATE TABLE `bahan_dasar`  (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bahan_dasar
-- ----------------------------
INSERT INTO `bahan_dasar` VALUES ('4f794cb1-4d70-11ea-a704-d85de2d0ff30', 'Elektro');

-- ----------------------------
-- Table structure for cabang
-- ----------------------------
DROP TABLE IF EXISTS `cabang`;
CREATE TABLE `cabang`  (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `alamat` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cabang
-- ----------------------------
INSERT INTO `cabang` VALUES ('7d19e099-4d71-11ea-a704-d85de2d0ff30', 'Pusat', NULL);

-- ----------------------------
-- Table structure for item
-- ----------------------------
DROP TABLE IF EXISTS `item`;
CREATE TABLE `item`  (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `regdate` datetime(0) NULL DEFAULT NULL,
  `kode` varchar(23) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_cabang` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_kategori` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_tipe` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_merk` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_warna` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_bahan_dasar` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_satuan_unit` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_perolehan` date NULL DEFAULT NULL,
  `tgl_akhir` date NULL DEFAULT NULL,
  `kondisi` enum('baik','rusak ringan','rusak berat','hilang') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `status` enum('aktif','dihapuskan','dijual','tidak aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga` decimal(15, 2) NULL DEFAULT NULL,
  `catatan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_hilang` date NULL DEFAULT NULL,
  `catatan_hilang` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_jual` date NULL DEFAULT NULL,
  `catatan_jual` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `tgl_dihapuskan` date NULL DEFAULT NULL,
  `catatan_dihapuskan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nilai_penyusutan` decimal(15, 2) NULL DEFAULT NULL,
  `seq` int(4) NULL DEFAULT NULL,
  `session_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of item
-- ----------------------------
INSERT INTO `item` VALUES ('0e3f1574-c281-11ea-be15-d85de2d0ff30', '2020-07-10 14:43:33', 'A.3.05/VII/2020.0001', '7d19e099-4d71-11ea-a704-d85de2d0ff30', 'a6f20bdd-4c9b-11ea-a704-d85de2d0ff30', 'adb61a24-c280-11ea-be15-d85de2d0ff30', NULL, 'a228939e-4d6c-11ea-a704-d85de2d0ff30', '4f794cb1-4d70-11ea-a704-d85de2d0ff30', 'fd70663e-4d70-11ea-a704-d85de2d0ff30', '2020-07-05', '2024-06-10', 'baik', 'tidak aktif', 2000000.00, '', NULL, NULL, NULL, NULL, NULL, NULL, 41667.00, 1, '8mthduue3545ap72e3fehumbhdp6hmuo');
INSERT INTO `item` VALUES ('0e4a433d-c281-11ea-be15-d85de2d0ff30', '2020-07-10 14:43:33', 'A.3.05/VII/2020.0002', '7d19e099-4d71-11ea-a704-d85de2d0ff30', 'a6f20bdd-4c9b-11ea-a704-d85de2d0ff30', 'adb61a24-c280-11ea-be15-d85de2d0ff30', NULL, 'a228939e-4d6c-11ea-a704-d85de2d0ff30', '4f794cb1-4d70-11ea-a704-d85de2d0ff30', 'fd70663e-4d70-11ea-a704-d85de2d0ff30', '2020-07-05', '2024-06-10', 'baik', 'tidak aktif', 2000000.00, '', NULL, NULL, NULL, NULL, NULL, NULL, 41667.00, 2, '8mthduue3545ap72e3fehumbhdp6hmuo');
INSERT INTO `item` VALUES ('2ef73950-bf52-11ea-921f-d85de2d0ff30', '2020-07-06 13:30:28', 'A.1.06/VII/2020.0001', '7d19e099-4d71-11ea-a704-d85de2d0ff30', 'a6f20bdd-4c9b-11ea-a704-d85de2d0ff30', 'a7d4645d-4ca4-11ea-a704-d85de2d0ff30', NULL, 'a228939e-4d6c-11ea-a704-d85de2d0ff30', '4f794cb1-4d70-11ea-a704-d85de2d0ff30', 'fd70663e-4d70-11ea-a704-d85de2d0ff30', '2020-07-06', '2024-06-06', 'baik', 'tidak aktif', 12222.00, '', NULL, NULL, NULL, NULL, NULL, NULL, 255.00, 1, 'j698vm597c9q647kjha50vn57qlumt9k');
INSERT INTO `item` VALUES ('78ea0e4d-53ad-11ea-989f-d85de2d0ff30', '2020-02-20 13:51:51', 'B.1.20/II/2020.0001', '7d19e099-4d71-11ea-a704-d85de2d0ff30', 'ac6c7432-4c9b-11ea-a704-d85de2d0ff30', '2aec6355-4ca7-11ea-a704-d85de2d0ff30', NULL, 'a228939e-4d6c-11ea-a704-d85de2d0ff30', '4f794cb1-4d70-11ea-a704-d85de2d0ff30', 'fd70663e-4d70-11ea-a704-d85de2d0ff30', '2020-02-20', '2024-01-20', 'baik', 'tidak aktif', 1000000.00, '', NULL, NULL, NULL, NULL, NULL, NULL, 20833.00, 1, '62jn19ikeo1ve5lnojtkbbne0bpamb9i');
INSERT INTO `item` VALUES ('78f2803e-53ad-11ea-989f-d85de2d0ff30', '2020-02-20 13:51:51', 'B.1.20/II/2020.0002', '7d19e099-4d71-11ea-a704-d85de2d0ff30', 'ac6c7432-4c9b-11ea-a704-d85de2d0ff30', '2aec6355-4ca7-11ea-a704-d85de2d0ff30', NULL, 'a228939e-4d6c-11ea-a704-d85de2d0ff30', '4f794cb1-4d70-11ea-a704-d85de2d0ff30', 'fd70663e-4d70-11ea-a704-d85de2d0ff30', '2020-02-20', '2024-01-20', 'baik', 'tidak aktif', 1000000.00, '', NULL, NULL, NULL, NULL, NULL, NULL, 20833.00, 2, '62jn19ikeo1ve5lnojtkbbne0bpamb9i');

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `kode` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES ('a6f20bdd-4c9b-11ea-a704-d85de2d0ff30', 'A', 'KOMPUTER & LAPTOP');
INSERT INTO `kategori` VALUES ('ac6c7432-4c9b-11ea-a704-d85de2d0ff30', 'B', 'FURNITURE');

-- ----------------------------
-- Table structure for merk
-- ----------------------------
DROP TABLE IF EXISTS `merk`;
CREATE TABLE `merk`  (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `id_tipe` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of merk
-- ----------------------------
INSERT INTO `merk` VALUES ('d58d2758-4d62-11ea-a704-d85de2d0ff30', 'test hp', '371117fc-4cae-11ea-a704-d85de2d0ff30');

-- ----------------------------
-- Table structure for satuan_unit
-- ----------------------------
DROP TABLE IF EXISTS `satuan_unit`;
CREATE TABLE `satuan_unit`  (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of satuan_unit
-- ----------------------------
INSERT INTO `satuan_unit` VALUES ('e235251e-4d70-11ea-a704-d85de2d0ff30', 'Set');
INSERT INTO `satuan_unit` VALUES ('fd70663e-4d70-11ea-a704-d85de2d0ff30', 'Pcs');

-- ----------------------------
-- Table structure for tipe
-- ----------------------------
DROP TABLE IF EXISTS `tipe`;
CREATE TABLE `tipe`  (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_kategori` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `seq` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tipe.id`(`id`) USING BTREE,
  INDEX `tipe.id_kategori`(`id_kategori`) USING BTREE,
  CONSTRAINT `tipe.id_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tipe
-- ----------------------------
INSERT INTO `tipe` VALUES ('2aec6355-4ca7-11ea-a704-d85de2d0ff30', 'ac6c7432-4c9b-11ea-a704-d85de2d0ff30', 'TEST', 1);
INSERT INTO `tipe` VALUES ('371117fc-4cae-11ea-a704-d85de2d0ff30', 'a6f20bdd-4c9b-11ea-a704-d85de2d0ff30', 'HP', 2);
INSERT INTO `tipe` VALUES ('a7d4645d-4ca4-11ea-a704-d85de2d0ff30', 'a6f20bdd-4c9b-11ea-a704-d85de2d0ff30', 'Dell', 1);
INSERT INTO `tipe` VALUES ('adb61a24-c280-11ea-be15-d85de2d0ff30', 'a6f20bdd-4c9b-11ea-a704-d85de2d0ff30', 'ACER', 3);

-- ----------------------------
-- Table structure for warna
-- ----------------------------
DROP TABLE IF EXISTS `warna`;
CREATE TABLE `warna`  (
  `id` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `hex` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of warna
-- ----------------------------
INSERT INTO `warna` VALUES ('a228939e-4d6c-11ea-a704-d85de2d0ff30', 'Merah', '#ff0000');

SET FOREIGN_KEY_CHECKS = 1;
