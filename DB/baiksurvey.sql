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

 Date: 16/06/2020 13:43:54
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
INSERT INTO `admin` VALUES ('38fa5aa0-1f2b-43bc-bca9-4b0ac6d967a6', 'adam', '47f79d5db015824348c105533f890d875bd47b6d', '2020-06-11 13:32:32', '2020-06-11 13:32:32', '2020-06-11 19:24:50', NULL, '0');
INSERT INTO `admin` VALUES ('59fb30c3-2032-45c8-9247-8d21808f5d6a', 'adam', '47f79d5db015824348c105533f890d875bd47b6d', '2020-06-11 19:25:06', '2020-06-11 19:25:06', NULL, NULL, '0');
INSERT INTO `admin` VALUES ('891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 'admin', '7aa92564f23e684600a14fe169254d6c5a80c48a', '2020-05-15 14:02:27', '2020-05-15 14:02:27', NULL, 'Vr1x0YXVwaTDtd8XH8DyBRd6i9KEWpgaxZM2lsIOCknNTbq4wFWhL91PfN7SKUoL', '1');

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
  `no_urut` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of answer
-- ----------------------------
INSERT INTO `answer` VALUES ('0e193dce-7161-4c74-a7ca-ace41764117a', '0ec4144a-c3c9-41ee-ab17-5e94d1cfc06f', 'd107da55-3be9-42c5-b4c1-47688c2262aa', '2', 'B', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 2);
INSERT INTO `answer` VALUES ('0e2baa24-92fb-4d64-a0fa-1c100720c888', '8402631d-9727-4b86-b583-b80b0454c74f', 'be103e3f-509f-4a3f-8d8c-774540aa1fa6', '3', '10', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('0f7a51da-2cb9-4570-961b-c13d9f055b06', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '32c34e22-e803-4ec4-bdb9-0ff5bc58a354', '4', NULL, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('17f0114f-93a3-422b-9438-04e1d864dc54', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', '601782b8-0af4-43f3-ba62-efff5f9e9af7', '2', 'D', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 4);
INSERT INTO `answer` VALUES ('19aaca8a-69d8-46b3-a5bb-499a8748c994', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', '601782b8-0af4-43f3-ba62-efff5f9e9af7', '2', 'A', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 1);
INSERT INTO `answer` VALUES ('1a3d4cc0-dc15-46ad-8dea-afd4884d0729', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'c804fb56-f2f9-4a9b-90a1-71773c7241bf', '2', 'C', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 3);
INSERT INTO `answer` VALUES ('1f88e9f9-b7da-46c7-bec0-914e7c08295d', '8402631d-9727-4b86-b583-b80b0454c74f', '48cae088-d648-42bd-83ce-dd36d3853042', '1', 'Tidak', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 2);
INSERT INTO `answer` VALUES ('21bb87aa-f3d7-4b63-9f5c-a3792e953f74', '8402631d-9727-4b86-b583-b80b0454c74f', 'a9ea1024-8cc6-47e9-af03-770407a356c3', '2', 'sdgsdgdsgds', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 2);
INSERT INTO `answer` VALUES ('292220e7-1340-4138-bbc7-3a3df6bd4e51', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', '74fb4fc3-b029-45d1-b36b-769f83b2f3e6', '3', '10', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('2afe36bf-1124-47c7-bffc-e756275e1acd', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'c804fb56-f2f9-4a9b-90a1-71773c7241bf', '2', 'B', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 2);
INSERT INTO `answer` VALUES ('2bda1e9f-fd15-4691-a0e4-7c334a13f6f7', '5bb1e46e-7ca3-4e64-9a86-6ebb790974ae', '5eb0d958-2ca7-47ca-ae28-59cd5ad6433e', '3', '1', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('32f44bcf-3fec-4cbd-904f-63116638b8eb', '8402631d-9727-4b86-b583-b80b0454c74f', '48cae088-d648-42bd-83ce-dd36d3853042', '1', 'Ya', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 1);
INSERT INTO `answer` VALUES ('33293ebc-7da8-4215-9ea6-0db23ac7fc83', '5bb1e46e-7ca3-4e64-9a86-6ebb790974ae', '92ec1356-6913-420d-a947-7c4d2233a0f8', '2', 'wfggdfjhg', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 1);
INSERT INTO `answer` VALUES ('340e17ef-0674-4c11-a39e-ceface99a0ab', '8402631d-9727-4b86-b583-b80b0454c74f', 'a9ea1024-8cc6-47e9-af03-770407a356c3', '2', 'sfsf', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 1);
INSERT INTO `answer` VALUES ('385f502b-3230-4cbf-95ee-f38713078a27', '8402631d-9727-4b86-b583-b80b0454c74f', 'a9ea1024-8cc6-47e9-af03-770407a356c3', '2', 'asagagdasgdsgsdgs', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 3);
INSERT INTO `answer` VALUES ('453c57e5-5fcf-4fd8-8a4a-29f86ba93f26', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '42226e2d-b69d-4da6-8d41-4cfa5ffcc15e', '2', 'CC', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 3);
INSERT INTO `answer` VALUES ('4b7922dc-1246-4b0f-a344-fa62d5d71552', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '884356a0-9c33-4c63-8ad8-6cd7d5362e67', '1', 'Setuju', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 1);
INSERT INTO `answer` VALUES ('4dd1518e-f81d-4715-8adc-d3d9e26283af', '5bb1e46e-7ca3-4e64-9a86-6ebb790974ae', '92ec1356-6913-420d-a947-7c4d2233a0f8', '2', '3rdukhbjnrtfghb', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 3);
INSERT INTO `answer` VALUES ('554d3ce4-1933-4ca4-8e55-39e7857d3374', '5bb1e46e-7ca3-4e64-9a86-6ebb790974ae', '92ec1356-6913-420d-a947-7c4d2233a0f8', '2', '4rtjgedfgvh', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 2);
INSERT INTO `answer` VALUES ('586a2097-f132-460d-bebd-927e9385bb6f', '0ec4144a-c3c9-41ee-ab17-5e94d1cfc06f', '2e57b5a8-a418-4e8f-8d5b-6f238bb3d5f2', '4', NULL, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('663fafae-66f1-453f-8260-263068e1cfe8', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', '601782b8-0af4-43f3-ba62-efff5f9e9af7', '2', 'C', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 3);
INSERT INTO `answer` VALUES ('6ac64d01-13b9-46b6-a333-2ac2839e7944', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '9e65acf0-522e-4ebc-a304-572de2ba237d', '3', '5', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('6be72758-209c-4ff7-b3c9-f8d493076b74', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'dab0fff0-7774-4ec4-8e5d-907b9d5e36ef', '3', '6', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('6e958f38-1533-4db7-87e5-52b467e42d68', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', '601782b8-0af4-43f3-ba62-efff5f9e9af7', '2', 'B', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 2);
INSERT INTO `answer` VALUES ('753d409c-480d-4e0f-9150-61fcc265abd3', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '884356a0-9c33-4c63-8ad8-6cd7d5362e67', '1', 'Tidak Setuju', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 2);
INSERT INTO `answer` VALUES ('850357bd-6d78-475b-947f-e3a086b05b2b', '5bb1e46e-7ca3-4e64-9a86-6ebb790974ae', '8c3a2159-da22-41ad-87af-55a76dc5b69c', '1', 'Tidak', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 2);
INSERT INTO `answer` VALUES ('8cadb12b-7dbd-43d6-9ce1-c83a631a3d63', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '42226e2d-b69d-4da6-8d41-4cfa5ffcc15e', '2', 'AA', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 1);
INSERT INTO `answer` VALUES ('91332080-25ca-4013-b687-86fce947d0a4', '8402631d-9727-4b86-b583-b80b0454c74f', '788efaa2-cc99-4753-b866-2850244a62be', '4', NULL, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('921afc28-6de9-43fc-bdcc-8c4bd5fb9293', '5bb1e46e-7ca3-4e64-9a86-6ebb790974ae', '5eb0d958-2ca7-47ca-ae28-59cd5ad6433e', '3', '10', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('9634b114-0bc0-4102-827c-8f334868f37c', '8402631d-9727-4b86-b583-b80b0454c74f', 'be103e3f-509f-4a3f-8d8c-774540aa1fa6', '3', '1', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('98f9582e-7610-46a3-b00a-b7cb4d031beb', '0ec4144a-c3c9-41ee-ab17-5e94d1cfc06f', 'd77d4d6d-d790-4be5-9918-1b13b8c68178', '1', 'Tidak', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 2);
INSERT INTO `answer` VALUES ('9f2b98b2-3c83-4560-aacd-d5a3280e755c', '0ec4144a-c3c9-41ee-ab17-5e94d1cfc06f', 'd107da55-3be9-42c5-b4c1-47688c2262aa', '2', 'C', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 3);
INSERT INTO `answer` VALUES ('a1e66b4b-deb1-45ad-b381-fda3093ab507', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', '780b99be-897b-4326-a189-0e712c4a0414', '1', 'Setuju', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 1);
INSERT INTO `answer` VALUES ('a345aa29-cd98-46a1-8efb-78d804d91f1c', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', '74fb4fc3-b029-45d1-b36b-769f83b2f3e6', '3', '1', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('a38503d5-35a1-459b-9eaf-5795505d931a', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'f492756e-9060-4dec-9016-79de1e8442e8', '1', 'Tidak', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 2);
INSERT INTO `answer` VALUES ('a5e45552-7bc2-41d2-a672-def7dbb4985c', '0ec4144a-c3c9-41ee-ab17-5e94d1cfc06f', '303d66af-09f3-4f4e-9241-d476f6dd987c', '3', '10', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('b0ddc0b8-7b3f-4f9e-8b54-0b86e06efe1b', '5bb1e46e-7ca3-4e64-9a86-6ebb790974ae', '28c74134-0e51-4d59-abb8-bf36105962b2', '1', 'Tidak', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 2);
INSERT INTO `answer` VALUES ('b5b1f10a-bec6-4002-80aa-78d80298fbb0', '0ec4144a-c3c9-41ee-ab17-5e94d1cfc06f', 'd107da55-3be9-42c5-b4c1-47688c2262aa', '2', 'A', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 1);
INSERT INTO `answer` VALUES ('baa933b1-bf99-4352-a8f9-145352314319', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '9e65acf0-522e-4ebc-a304-572de2ba237d', '3', '1', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('c156966d-8e30-4d52-bc52-89612e9387f3', '5bb1e46e-7ca3-4e64-9a86-6ebb790974ae', '2a310cbb-ceb8-4efe-b62e-5437a5993c42', '4', NULL, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('d1ab2f55-18e8-4f12-bf1b-6ef394d6c602', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', '56b7f5c1-daa0-42a5-9562-5c1b330967ae', '4', NULL, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('dde52aa2-23a3-4b20-baad-7fa7b6524247', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', 'bb2ea243-3cd7-4551-8fec-01d59d96cad5', '4', NULL, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('e16d45c7-ac02-47dd-8618-c377097c48d2', '0ec4144a-c3c9-41ee-ab17-5e94d1cfc06f', 'd77d4d6d-d790-4be5-9918-1b13b8c68178', '1', 'Ya', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 1);
INSERT INTO `answer` VALUES ('e5664752-6386-41e5-ab3d-bdccf74d65a4', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'f492756e-9060-4dec-9016-79de1e8442e8', '1', 'Ya', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 1);
INSERT INTO `answer` VALUES ('e86304fd-396f-42e9-92cc-3fbe9456fd54', '5bb1e46e-7ca3-4e64-9a86-6ebb790974ae', '28c74134-0e51-4d59-abb8-bf36105962b2', '1', 'Ya', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 1);
INSERT INTO `answer` VALUES ('eb703262-0ec8-4d9a-aaa1-23b5c6c5ff5e', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', '780b99be-897b-4326-a189-0e712c4a0414', '1', 'Tidak Setuju', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 2);
INSERT INTO `answer` VALUES ('f171b9ab-d5c0-4cb1-8a16-fafc15873d5c', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '42226e2d-b69d-4da6-8d41-4cfa5ffcc15e', '2', 'BB', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 2);
INSERT INTO `answer` VALUES ('f615d9a1-83ce-46a0-9062-75440fc2ed8e', '0ec4144a-c3c9-41ee-ab17-5e94d1cfc06f', '303d66af-09f3-4f4e-9241-d476f6dd987c', '3', '1', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('f80f4580-18c2-4df0-9a38-29ed21ac7fab', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'dab0fff0-7774-4ec4-8e5d-907b9d5e36ef', '3', '10', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', NULL);
INSERT INTO `answer` VALUES ('f8d8b3ff-5a0e-4055-99ce-7e6d296995c0', '5bb1e46e-7ca3-4e64-9a86-6ebb790974ae', '8c3a2159-da22-41ad-87af-55a76dc5b69c', '1', 'Ya', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 1);
INSERT INTO `answer` VALUES ('fcd34adc-5de9-48fd-bd77-5d143c7a6e3b', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'c804fb56-f2f9-4a9b-90a1-71773c7241bf', '2', 'A', '891b5c44-4d19-4d10-94bb-1312fcf2f4a4', 1);

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
INSERT INTO `master_survey` VALUES ('0ec4144a-c3c9-41ee-ab17-5e94d1cfc06f', 'aknklanfkan', 'ksnkflnasklfnslk', '2020-01-01', '2021-01-01', '1', 'umum', 'jTmLmqXh');
INSERT INTO `master_survey` VALUES ('5bb1e46e-7ca3-4e64-9a86-6ebb790974ae', 'sbkgnasiugbudgd', 'ksngkjbsjkgnd', '2020-01-01', '2021-01-01', '1', 'anggota', 'RvmCrusG');
INSERT INTO `master_survey` VALUES ('8402631d-9727-4b86-b583-b80b0454c74f', 'dggds', 'sd', '2020-06-04', '2021-01-03', '1', 'umum', '2G7XnykK');
INSERT INTO `master_survey` VALUES ('d70fa8e3-4881-48bd-8cac-88fdae7ceca7', 'Survey Test Karyawan', 'Ini survey test khusus karyawan', '2020-01-01', '2021-01-01', '2', 'karyawan', 'WTgI2s3M');
INSERT INTO `master_survey` VALUES ('dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'Test', 'Test', '2020-01-01', '2020-06-30', '2', 'umum', 'DqT26tcb');

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
  `no_urut` int(10) NULL DEFAULT NULL,
  `id_created` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of question
-- ----------------------------
INSERT INTO `question` VALUES ('28c74134-0e51-4d59-abb8-bf36105962b2', '5bb1e46e-7ca3-4e64-9a86-6ebb790974ae', 'defghjk', '1', 'dfghj', 5, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('2a310cbb-ceb8-4efe-b62e-5437a5993c42', '5bb1e46e-7ca3-4e64-9a86-6ebb790974ae', 'sdxfghjk', '4', 'szdxfcgh', 4, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('2e57b5a8-a418-4e8f-8d5b-6f238bb3d5f2', '0ec4144a-c3c9-41ee-ab17-5e94d1cfc06f', 'srgrr', '4', 'dsg', 4, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('303d66af-09f3-4f4e-9241-d476f6dd987c', '0ec4144a-c3c9-41ee-ab17-5e94d1cfc06f', 'fjcg', '3', 'xnfdnnd', 3, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('32c34e22-e803-4ec4-bdb9-0ff5bc58a354', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'Pertanyaan Tujuh', '4', NULL, 7, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('42226e2d-b69d-4da6-8d41-4cfa5ffcc15e', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'Pertanyaan Empat', '2', NULL, 4, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('48cae088-d648-42bd-83ce-dd36d3853042', '8402631d-9727-4b86-b583-b80b0454c74f', 'dgdsgsgdsgds', '1', 'dsgsgs', 1, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('56b7f5c1-daa0-42a5-9562-5c1b330967ae', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', 'Pertanyaan tambahan', '4', 'Ini hanya tambahan', 5, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('5eb0d958-2ca7-47ca-ae28-59cd5ad6433e', '5bb1e46e-7ca3-4e64-9a86-6ebb790974ae', 'rfgvhbj', '3', 'esdfghbjn', 3, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('601782b8-0af4-43f3-ba62-efff5f9e9af7', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', 'bjgndknhjk', '2', 'dgndingkdno', 2, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('74fb4fc3-b029-45d1-b36b-769f83b2f3e6', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', 'dhifniondi', '3', '0d9jg0dgjopd', 3, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('780b99be-897b-4326-a189-0e712c4a0414', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', 'Pertanyaan satu', '1', 'Deskripsi satu', 1, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('788efaa2-cc99-4753-b866-2850244a62be', '8402631d-9727-4b86-b583-b80b0454c74f', 'sgfdsfds', '4', NULL, 4, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('884356a0-9c33-4c63-8ad8-6cd7d5362e67', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'Pertanyaan Dua', '1', NULL, 2, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('8c3a2159-da22-41ad-87af-55a76dc5b69c', '5bb1e46e-7ca3-4e64-9a86-6ebb790974ae', 'fsbfsklnb', '1', 'fnsknfskl', 1, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('92ec1356-6913-420d-a947-7c4d2233a0f8', '5bb1e46e-7ca3-4e64-9a86-6ebb790974ae', 'slfhgsy8fusn', '2', NULL, 2, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('9e65acf0-522e-4ebc-a304-572de2ba237d', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'Pertanyaan Lima', '3', NULL, 5, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('a9ea1024-8cc6-47e9-af03-770407a356c3', '8402631d-9727-4b86-b583-b80b0454c74f', 'sagsg', '2', NULL, 2, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('bb2ea243-3cd7-4551-8fec-01d59d96cad5', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', 'j8h9gindol', '4', '0s9fjposl', 4, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('be103e3f-509f-4a3f-8d8c-774540aa1fa6', '8402631d-9727-4b86-b583-b80b0454c74f', 'asgdsgds', '3', NULL, 3, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('c804fb56-f2f9-4a9b-90a1-71773c7241bf', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'Pertanyaan Tiga', '2', NULL, 3, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('d107da55-3be9-42c5-b4c1-47688c2262aa', '0ec4144a-c3c9-41ee-ab17-5e94d1cfc06f', 'ahdagadgds', '2', 'asfsafafsa', 2, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('d77d4d6d-d790-4be5-9918-1b13b8c68178', '0ec4144a-c3c9-41ee-ab17-5e94d1cfc06f', 'nsmakgs', '1', 'nsgklsngksln', 1, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('dab0fff0-7774-4ec4-8e5d-907b9d5e36ef', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'Pertanyaan Enam', '3', NULL, 6, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');
INSERT INTO `question` VALUES ('f492756e-9060-4dec-9016-79de1e8442e8', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'Pertanyaan Satu', '1', NULL, 1, '891b5c44-4d19-4d10-94bb-1312fcf2f4a4');

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
  `id_survey` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of responden
-- ----------------------------
INSERT INTO `responden` VALUES ('1837fe32-4c8b-4efb-9875-315585b85ddc', 'karyawan', '3271040509900006', 'Adam Prasetya Malik', 'l', 29, 'SMK Informatika Bina Generasi Bogor', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7');
INSERT INTO `responden` VALUES ('1cf62a74-850e-496d-8017-5a4578a3eea4', 'umum', NULL, 'Test 3', 'l', 19, 'Test 3', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f');
INSERT INTO `responden` VALUES ('9271bb52-3492-4c01-9491-491ff7b84a99', 'umum', NULL, 'Test 4', 'p', 20, 'Test 4', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f');
INSERT INTO `responden` VALUES ('d7fc60d6-4985-4f39-944e-61c736122fd2', 'umum', NULL, 'Test 2', 'p', 18, 'Test 2', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f');
INSERT INTO `responden` VALUES ('dd3f689d-e4b7-4d27-b65e-007458aecb24', 'umum', NULL, 'Test', 'l', 17, 'Test', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f');

-- ----------------------------
-- Table structure for result
-- ----------------------------
DROP TABLE IF EXISTS `result`;
CREATE TABLE `result`  (
  `id` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id_survey` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_question` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `id_responden` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `answer` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of result
-- ----------------------------
INSERT INTO `result` VALUES ('0d8e8408-a820-43ff-9925-a8c8288679c0', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'f492756e-9060-4dec-9016-79de1e8442e8', 'd7fc60d6-4985-4f39-944e-61c736122fd2', 'Tidak');
INSERT INTO `result` VALUES ('106f693e-f000-4ee1-8641-90926c041583', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', '601782b8-0af4-43f3-ba62-efff5f9e9af7', '1837fe32-4c8b-4efb-9875-315585b85ddc', 'A');
INSERT INTO `result` VALUES ('26cb929c-7d26-4d76-8f01-af6efb54b5a7', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '32c34e22-e803-4ec4-bdb9-0ff5bc58a354', '9271bb52-3492-4c01-9491-491ff7b84a99', 'Test 4');
INSERT INTO `result` VALUES ('2d7ef8f5-d487-4c0c-8abb-86707f3928cb', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'f492756e-9060-4dec-9016-79de1e8442e8', '9271bb52-3492-4c01-9491-491ff7b84a99', 'Tidak');
INSERT INTO `result` VALUES ('2dc037d5-5ac4-4732-a06f-3c43421eb45e', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '42226e2d-b69d-4da6-8d41-4cfa5ffcc15e', 'dd3f689d-e4b7-4d27-b65e-007458aecb24', 'AA');
INSERT INTO `result` VALUES ('38f2d89d-0bf5-4b91-b228-fd21d3dd9c98', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'dab0fff0-7774-4ec4-8e5d-907b9d5e36ef', '1cf62a74-850e-496d-8017-5a4578a3eea4', '8');
INSERT INTO `result` VALUES ('3d4db89f-7654-49df-9a3b-b8dc034e4057', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '9e65acf0-522e-4ebc-a304-572de2ba237d', '9271bb52-3492-4c01-9491-491ff7b84a99', '4');
INSERT INTO `result` VALUES ('3db75264-7eb5-42c2-8efa-bda927e83e20', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', '780b99be-897b-4326-a189-0e712c4a0414', '1837fe32-4c8b-4efb-9875-315585b85ddc', 'Setuju');
INSERT INTO `result` VALUES ('4759b6bb-45c8-4121-9dd2-64ac77372d12', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '884356a0-9c33-4c63-8ad8-6cd7d5362e67', '9271bb52-3492-4c01-9491-491ff7b84a99', 'Tidak Setuju');
INSERT INTO `result` VALUES ('4958ce5d-5fa3-40b8-a5a1-7fee5d783c51', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'dab0fff0-7774-4ec4-8e5d-907b9d5e36ef', '9271bb52-3492-4c01-9491-491ff7b84a99', '6');
INSERT INTO `result` VALUES ('5d6fc9f2-58fb-4021-b1e2-587173d61b94', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'dab0fff0-7774-4ec4-8e5d-907b9d5e36ef', 'dd3f689d-e4b7-4d27-b65e-007458aecb24', '6');
INSERT INTO `result` VALUES ('60d3f853-43b1-49ef-a346-ddd7dd46e146', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '42226e2d-b69d-4da6-8d41-4cfa5ffcc15e', '9271bb52-3492-4c01-9491-491ff7b84a99', 'CC');
INSERT INTO `result` VALUES ('6b597ffa-e7cd-484d-9cbf-d9c7e3af81c0', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '884356a0-9c33-4c63-8ad8-6cd7d5362e67', 'd7fc60d6-4985-4f39-944e-61c736122fd2', 'Tidak Setuju');
INSERT INTO `result` VALUES ('6bfde284-de9a-4ed5-bac1-0977fa60857a', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '9e65acf0-522e-4ebc-a304-572de2ba237d', 'd7fc60d6-4985-4f39-944e-61c736122fd2', '5');
INSERT INTO `result` VALUES ('6d642ffe-97e2-41b0-9f1e-bed695b334ac', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'f492756e-9060-4dec-9016-79de1e8442e8', 'dd3f689d-e4b7-4d27-b65e-007458aecb24', 'Ya');
INSERT INTO `result` VALUES ('7f0d6f59-e2ad-4f27-b73d-6d1d676664f2', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'c804fb56-f2f9-4a9b-90a1-71773c7241bf', 'dd3f689d-e4b7-4d27-b65e-007458aecb24', 'A');
INSERT INTO `result` VALUES ('7fa6323c-2af9-45e5-92a8-f112894f6ded', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '32c34e22-e803-4ec4-bdb9-0ff5bc58a354', 'dd3f689d-e4b7-4d27-b65e-007458aecb24', 'Test');
INSERT INTO `result` VALUES ('86f4eedc-58b9-4353-98ed-ac97245fd4f9', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', '74fb4fc3-b029-45d1-b36b-769f83b2f3e6', '1837fe32-4c8b-4efb-9875-315585b85ddc', '1');
INSERT INTO `result` VALUES ('8ce905b6-833e-490f-a5d9-7752ab8dc7fa', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', '56b7f5c1-daa0-42a5-9562-5c1b330967ae', '1837fe32-4c8b-4efb-9875-315585b85ddc', 'test');
INSERT INTO `result` VALUES ('94d5c805-1837-4f77-b003-d0098bf21b65', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'c804fb56-f2f9-4a9b-90a1-71773c7241bf', 'd7fc60d6-4985-4f39-944e-61c736122fd2', 'B');
INSERT INTO `result` VALUES ('a4dd5a0a-da79-4f28-9278-fa7851851bf9', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'f492756e-9060-4dec-9016-79de1e8442e8', '1cf62a74-850e-496d-8017-5a4578a3eea4', 'Ya');
INSERT INTO `result` VALUES ('ad2e299f-c4d8-4b88-83c1-fc51042c2e9f', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '9e65acf0-522e-4ebc-a304-572de2ba237d', 'dd3f689d-e4b7-4d27-b65e-007458aecb24', '1');
INSERT INTO `result` VALUES ('b1921573-8f8e-4473-b9c4-9084cf9a496d', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '42226e2d-b69d-4da6-8d41-4cfa5ffcc15e', '1cf62a74-850e-496d-8017-5a4578a3eea4', 'CC');
INSERT INTO `result` VALUES ('b1d2b3a3-f959-4bcb-904f-4d750329f14b', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'c804fb56-f2f9-4a9b-90a1-71773c7241bf', '1cf62a74-850e-496d-8017-5a4578a3eea4', 'C');
INSERT INTO `result` VALUES ('b5cfe206-3a6a-42f3-ae42-06750894e928', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '884356a0-9c33-4c63-8ad8-6cd7d5362e67', 'dd3f689d-e4b7-4d27-b65e-007458aecb24', 'Setuju');
INSERT INTO `result` VALUES ('ceac80de-d6c4-40b5-95dd-b3e13f5f2b20', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '32c34e22-e803-4ec4-bdb9-0ff5bc58a354', '1cf62a74-850e-496d-8017-5a4578a3eea4', 'Test 3');
INSERT INTO `result` VALUES ('d5185b53-c570-4cdb-9d19-fc7fa85e858f', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'dab0fff0-7774-4ec4-8e5d-907b9d5e36ef', 'd7fc60d6-4985-4f39-944e-61c736122fd2', '10');
INSERT INTO `result` VALUES ('e1e455d4-cd15-478c-95ad-1de25efc562a', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '884356a0-9c33-4c63-8ad8-6cd7d5362e67', '1cf62a74-850e-496d-8017-5a4578a3eea4', 'Tidak Setuju');
INSERT INTO `result` VALUES ('e2351280-0838-4264-ba69-5a4ac2a87338', 'd70fa8e3-4881-48bd-8cac-88fdae7ceca7', 'bb2ea243-3cd7-4551-8fec-01d59d96cad5', '1837fe32-4c8b-4efb-9875-315585b85ddc', 'testtes');
INSERT INTO `result` VALUES ('e68a44ae-1e9a-4c8f-817f-810c317c44da', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', 'c804fb56-f2f9-4a9b-90a1-71773c7241bf', '9271bb52-3492-4c01-9491-491ff7b84a99', 'C');
INSERT INTO `result` VALUES ('ed2b6480-82ab-4b3d-a1f9-5226f9b4b22b', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '32c34e22-e803-4ec4-bdb9-0ff5bc58a354', 'd7fc60d6-4985-4f39-944e-61c736122fd2', 'Test 2');
INSERT INTO `result` VALUES ('eea94472-907c-480f-882f-5da8595f4209', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '42226e2d-b69d-4da6-8d41-4cfa5ffcc15e', 'd7fc60d6-4985-4f39-944e-61c736122fd2', 'BB');
INSERT INTO `result` VALUES ('f3f2d90d-76fc-4d78-8aee-55020aafeba8', 'dfa779fd-13a4-4eed-909f-ebc89e544f7f', '9e65acf0-522e-4ebc-a304-572de2ba237d', '1cf62a74-850e-496d-8017-5a4578a3eea4', '3');

SET FOREIGN_KEY_CHECKS = 1;
