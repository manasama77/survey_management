/*
 Navicat Premium Data Transfer

 Source Server         : mysql php 5.4.16
 Source Server Type    : MySQL
 Source Server Version : 50539
 Source Host           : localhost:3306
 Source Schema         : baiksurvey

 Target Server Type    : MySQL
 Target Server Version : 50539
 File Encoding         : 65001

 Date: 26/05/2020 04:33:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` char(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `updated_at` datetime NULL DEFAULT NULL,
  `deleted_at` datetime NULL DEFAULT NULL,
  `cookies` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `remember` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 'admin', '7aa92564f23e684600a14fe169254d6c5a80c48a', '2020-05-15 14:02:27', '2020-05-15 14:02:27', NULL, 'qubYWa3T6ZdFSgrm9BLk8SzyRmNyC8QVfjrWTKafv470Qn1Ex7Xqjw1LvUwOMhFg', '1');

-- ----------------------------
-- Table structure for answer
-- ----------------------------
DROP TABLE IF EXISTS `answer`;
CREATE TABLE `answer`  (
  `id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_survey` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_question` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `type_respon` enum('1','2','3','4') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `desc_respon` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `id_created` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of answer
-- ----------------------------
INSERT INTO `answer` VALUES ('428bc739-4d9f-4b9e-a420-4eba5c9aa92d', '9935a646-e3e7-46fa-973c-9fe1508ee5ff', 'd7517171-b934-43b4-b58c-35a238d3e840', '1', 'Setuju', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `answer` VALUES ('92abfce5-3ecb-4090-bfb6-9892197305b6', '9935a646-e3e7-46fa-973c-9fe1508ee5ff', 'c016f5f7-5c62-4df6-83cb-642ddef52d35', '2', 'qwe', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `answer` VALUES ('b98caf06-83f2-4fa5-8f20-e7b313ef5ba3', '9935a646-e3e7-46fa-973c-9fe1508ee5ff', 'd7517171-b934-43b4-b58c-35a238d3e840', '1', 'Tidak Setuju', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `answer` VALUES ('fd2e54f3-f35a-4dd9-b4f4-34f48ab459c9', '9935a646-e3e7-46fa-973c-9fe1508ee5ff', 'a6f744ae-8123-4f60-a5ba-a559084ae65b', '2', 'a', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');

-- ----------------------------
-- Table structure for master_survey
-- ----------------------------
DROP TABLE IF EXISTS `master_survey`;
CREATE TABLE `master_survey`  (
  `id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `nama_survey` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `desc_survey` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `periode_survey_1` date NULL DEFAULT NULL,
  `periode_survey_2` date NULL DEFAULT NULL,
  `status_survey` enum('0','1','2') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '0=createing|1=aktif|2=close',
  `jenis_responden` enum('anggota','karyawan','umum') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `url` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of master_survey
-- ----------------------------
INSERT INTO `master_survey` VALUES ('9935a646-e3e7-46fa-973c-9fe1508ee5ff', 'test', 'test', '2020-01-01', '2020-01-01', '0', 'umum', 'OeW6wE5u');

-- ----------------------------
-- Table structure for question
-- ----------------------------
DROP TABLE IF EXISTS `question`;
CREATE TABLE `question`  (
  `id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_survey` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `desc` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `type_respon` enum('1','2','3','4') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '1=y/n | 2=pg | 3=rating | 4=entry',
  `desc_respon` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `id_created` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of question
-- ----------------------------
INSERT INTO `question` VALUES ('a6f744ae-8123-4f60-a5ba-a559084ae65b', '9935a646-e3e7-46fa-973c-9fe1508ee5ff', '33', '2', '44', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('c016f5f7-5c62-4df6-83cb-642ddef52d35', '9935a646-e3e7-46fa-973c-9fe1508ee5ff', '11', '2', '22', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('d7517171-b934-43b4-b58c-35a238d3e840', '9935a646-e3e7-46fa-973c-9fe1508ee5ff', 'a', '1', 'a', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');

-- ----------------------------
-- Table structure for responden
-- ----------------------------
DROP TABLE IF EXISTS `responden`;
CREATE TABLE `responden`  (
  `id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jenis` enum('anggota','karyawan','umum') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `responden_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jenis_kelamin` enum('l','p') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `umur` int(255) NULL DEFAULT NULL,
  `pendidikan` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for result
-- ----------------------------
DROP TABLE IF EXISTS `result`;
CREATE TABLE `result`  (
  `id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_survey` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_question` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_answer` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_responden` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
