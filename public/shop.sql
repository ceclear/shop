/*
 Navicat Premium Data Transfer

 Source Server         : 127
 Source Server Type    : MySQL
 Source Server Version : 80012
 Source Host           : localhost:3306
 Source Schema         : shop

 Target Server Type    : MySQL
 Target Server Version : 80012
 File Encoding         : 65001

 Date: 29/01/2021 17:55:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_menu`;
CREATE TABLE `admin_menu`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `order` int(11) NOT NULL DEFAULT 0,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `permission` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_menu
-- ----------------------------
INSERT INTO `admin_menu` VALUES (1, 0, 1, '首页', 'fa-bar-chart', '/', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (2, 0, 2, '系统管理', 'fa-tasks', '', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (3, 2, 3, '用户', 'fa-users', 'auth/users', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (4, 2, 4, '角色', 'fa-user', 'auth/roles', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (5, 2, 5, '权限', 'fa-ban', 'auth/permissions', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (6, 2, 6, '菜单', 'fa-bars', 'auth/menu', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (7, 2, 7, '操作日志', 'fa-history', 'auth/logs', NULL, NULL, NULL);
INSERT INTO `admin_menu` VALUES (8, 0, 0, '作业管理', 'fa-bars', NULL, NULL, '2021-01-29 09:33:45', '2021-01-29 09:33:45');
INSERT INTO `admin_menu` VALUES (9, 8, 0, '作业统计', 'fa-bars', 'school', NULL, '2021-01-29 09:33:59', '2021-01-29 09:33:59');

-- ----------------------------
-- Table structure for admin_operation_log
-- ----------------------------
DROP TABLE IF EXISTS `admin_operation_log`;
CREATE TABLE `admin_operation_log`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_operation_log_user_id_index`(`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_operation_log
-- ----------------------------
INSERT INTO `admin_operation_log` VALUES (1, 1, 'admin', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\"}', '2021-01-08 07:46:22', '2021-01-08 07:46:22');
INSERT INTO `admin_operation_log` VALUES (2, 1, 'admin/auth/login', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/auth\\/login\"}', '2021-01-08 07:46:44', '2021-01-08 07:46:44');
INSERT INTO `admin_operation_log` VALUES (3, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/auth\\/logout\",\"_pjax\":\"#pjax-container\"}', '2021-01-08 07:46:50', '2021-01-08 07:46:50');
INSERT INTO `admin_operation_log` VALUES (4, 1, 'admin', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\"}', '2021-01-26 13:19:11', '2021-01-26 13:19:11');
INSERT INTO `admin_operation_log` VALUES (5, 1, 'admin', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\"}', '2021-01-29 06:41:31', '2021-01-29 06:41:31');
INSERT INTO `admin_operation_log` VALUES (6, 1, 'admin', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\"}', '2021-01-29 09:28:32', '2021-01-29 09:28:32');
INSERT INTO `admin_operation_log` VALUES (7, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/auth\\/menu\",\"_pjax\":\"#pjax-container\"}', '2021-01-29 09:28:44', '2021-01-29 09:28:44');
INSERT INTO `admin_operation_log` VALUES (8, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"0\",\"title\":\"\\u4f5c\\u4e1a\\u7ba1\\u7406\",\"icon\":\"fa-bars\",\"uri\":null,\"roles\":[null],\"permission\":null,\"_token\":\"r3dgbsxtpOmfyBdptnmCNbOSgk0Lfav0pulmVAc1\",\"s\":\"\\/\\/admin\\/auth\\/menu\"}', '2021-01-29 09:33:45', '2021-01-29 09:33:45');
INSERT INTO `admin_operation_log` VALUES (9, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/auth\\/menu\"}', '2021-01-29 09:33:45', '2021-01-29 09:33:45');
INSERT INTO `admin_operation_log` VALUES (10, 1, 'admin/auth/menu', 'POST', '127.0.0.1', '{\"parent_id\":\"8\",\"title\":\"\\u4f5c\\u4e1a\\u7edf\\u8ba1\",\"icon\":\"fa-bars\",\"uri\":\"school\",\"roles\":[null],\"permission\":null,\"_token\":\"r3dgbsxtpOmfyBdptnmCNbOSgk0Lfav0pulmVAc1\",\"s\":\"\\/\\/admin\\/auth\\/menu\"}', '2021-01-29 09:33:59', '2021-01-29 09:33:59');
INSERT INTO `admin_operation_log` VALUES (11, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/auth\\/menu\"}', '2021-01-29 09:34:00', '2021-01-29 09:34:00');
INSERT INTO `admin_operation_log` VALUES (12, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/auth\\/menu\"}', '2021-01-29 09:34:01', '2021-01-29 09:34:01');
INSERT INTO `admin_operation_log` VALUES (13, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/auth\\/menu\"}', '2021-01-29 09:34:32', '2021-01-29 09:34:32');
INSERT INTO `admin_operation_log` VALUES (14, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/auth\\/menu\"}', '2021-01-29 09:35:04', '2021-01-29 09:35:04');
INSERT INTO `admin_operation_log` VALUES (15, 1, 'admin/auth/menu', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/auth\\/menu\",\"_pjax\":\"#pjax-container\"}', '2021-01-29 09:35:07', '2021-01-29 09:35:07');
INSERT INTO `admin_operation_log` VALUES (16, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/auth\\/logout\",\"_pjax\":\"#pjax-container\"}', '2021-01-29 09:35:09', '2021-01-29 09:35:09');
INSERT INTO `admin_operation_log` VALUES (17, 1, 'admin', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\"}', '2021-01-29 09:35:13', '2021-01-29 09:35:13');
INSERT INTO `admin_operation_log` VALUES (18, 1, 'admin', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\"}', '2021-01-29 09:35:25', '2021-01-29 09:35:25');
INSERT INTO `admin_operation_log` VALUES (19, 1, 'admin', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\"}', '2021-01-29 09:38:13', '2021-01-29 09:38:13');
INSERT INTO `admin_operation_log` VALUES (20, 1, 'admin', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\"}', '2021-01-29 09:38:16', '2021-01-29 09:38:16');
INSERT INTO `admin_operation_log` VALUES (21, 1, 'admin/auth/logout', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/auth\\/logout\",\"_pjax\":\"#pjax-container\"}', '2021-01-29 09:38:24', '2021-01-29 09:38:24');
INSERT INTO `admin_operation_log` VALUES (22, 1, 'admin', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\"}', '2021-01-29 09:38:28', '2021-01-29 09:38:28');
INSERT INTO `admin_operation_log` VALUES (23, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\",\"_pjax\":\"#pjax-container\"}', '2021-01-29 09:40:38', '2021-01-29 09:40:38');
INSERT INTO `admin_operation_log` VALUES (24, 1, 'admin', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\",\"_pjax\":\"#pjax-container\"}', '2021-01-29 09:42:19', '2021-01-29 09:42:19');
INSERT INTO `admin_operation_log` VALUES (25, 1, 'admin', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\"}', '2021-01-29 09:42:29', '2021-01-29 09:42:29');
INSERT INTO `admin_operation_log` VALUES (26, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\",\"_pjax\":\"#pjax-container\"}', '2021-01-29 09:42:46', '2021-01-29 09:42:46');
INSERT INTO `admin_operation_log` VALUES (27, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\"}', '2021-01-29 09:44:14', '2021-01-29 09:44:14');
INSERT INTO `admin_operation_log` VALUES (28, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\"}', '2021-01-29 09:44:36', '2021-01-29 09:44:36');
INSERT INTO `admin_operation_log` VALUES (29, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\"}', '2021-01-29 09:47:05', '2021-01-29 09:47:05');
INSERT INTO `admin_operation_log` VALUES (30, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\"}', '2021-01-29 09:47:40', '2021-01-29 09:47:40');
INSERT INTO `admin_operation_log` VALUES (31, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\"}', '2021-01-29 09:50:40', '2021-01-29 09:50:40');
INSERT INTO `admin_operation_log` VALUES (32, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\"}', '2021-01-29 09:50:44', '2021-01-29 09:50:44');
INSERT INTO `admin_operation_log` VALUES (33, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\"}', '2021-01-29 09:50:46', '2021-01-29 09:50:46');
INSERT INTO `admin_operation_log` VALUES (34, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\"}', '2021-01-29 09:50:54', '2021-01-29 09:50:54');
INSERT INTO `admin_operation_log` VALUES (35, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\"}', '2021-01-29 09:51:21', '2021-01-29 09:51:21');
INSERT INTO `admin_operation_log` VALUES (36, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\"}', '2021-01-29 09:51:39', '2021-01-29 09:51:39');
INSERT INTO `admin_operation_log` VALUES (37, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\"}', '2021-01-29 09:51:51', '2021-01-29 09:51:51');
INSERT INTO `admin_operation_log` VALUES (38, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\"}', '2021-01-29 09:52:04', '2021-01-29 09:52:04');
INSERT INTO `admin_operation_log` VALUES (39, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\"}', '2021-01-29 09:52:20', '2021-01-29 09:52:20');
INSERT INTO `admin_operation_log` VALUES (40, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\"}', '2021-01-29 09:53:58', '2021-01-29 09:53:58');
INSERT INTO `admin_operation_log` VALUES (41, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\"}', '2021-01-29 09:54:00', '2021-01-29 09:54:00');
INSERT INTO `admin_operation_log` VALUES (42, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\"}', '2021-01-29 09:54:24', '2021-01-29 09:54:24');
INSERT INTO `admin_operation_log` VALUES (43, 1, 'admin/school', 'GET', '127.0.0.1', '{\"s\":\"\\/\\/admin\\/school\"}', '2021-01-29 09:54:35', '2021-01-29 09:54:35');

-- ----------------------------
-- Table structure for admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `http_path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_permissions_name_unique`(`name`) USING BTREE,
  UNIQUE INDEX `admin_permissions_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_permissions
-- ----------------------------
INSERT INTO `admin_permissions` VALUES (1, 'All permission', '*', '', '*', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (2, 'Dashboard', 'dashboard', 'GET', '/', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (3, 'Login', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (4, 'User setting', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, NULL);
INSERT INTO `admin_permissions` VALUES (5, 'Auth management', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, NULL);

-- ----------------------------
-- Table structure for admin_role_menu
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_menu`;
CREATE TABLE `admin_role_menu`  (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `admin_role_menu_role_id_menu_id_index`(`role_id`, `menu_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_menu
-- ----------------------------
INSERT INTO `admin_role_menu` VALUES (1, 2, NULL, NULL);

-- ----------------------------
-- Table structure for admin_role_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_permissions`;
CREATE TABLE `admin_role_permissions`  (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `admin_role_permissions_role_id_permission_id_index`(`role_id`, `permission_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_permissions
-- ----------------------------
INSERT INTO `admin_role_permissions` VALUES (1, 1, NULL, NULL);

-- ----------------------------
-- Table structure for admin_role_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_users`;
CREATE TABLE `admin_role_users`  (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `admin_role_users_role_id_user_id_index`(`role_id`, `user_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_role_users
-- ----------------------------
INSERT INTO `admin_role_users` VALUES (1, 1, NULL, NULL);

-- ----------------------------
-- Table structure for admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `admin_roles`;
CREATE TABLE `admin_roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_roles_name_unique`(`name`) USING BTREE,
  UNIQUE INDEX `admin_roles_slug_unique`(`slug`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_roles
-- ----------------------------
INSERT INTO `admin_roles` VALUES (1, 'Administrator', 'administrator', '2021-01-08 07:46:02', '2021-01-08 07:46:02');

-- ----------------------------
-- Table structure for admin_user_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_user_permissions`;
CREATE TABLE `admin_user_permissions`  (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `admin_user_permissions_user_id_permission_id_index`(`user_id`, `permission_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(190) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `admin_users_username_unique`(`username`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin_users
-- ----------------------------
INSERT INTO `admin_users` VALUES (1, 'admin', '$2y$10$WZ2Y8R9999zsXKuMqM2v/u8u5nrv9t8JEPR24q5xaDu1gqEJZlhWO', 'Administrator', NULL, 'm95tLE7iXnHcbc3MR7BJiiE1AjNzVYBYh6m3SNpMlAxMzUq9sbPhDiJQsFKq', '2021-01-08 07:46:02', '2021-01-08 07:46:02');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NULL DEFAULT 0,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT '',
  `level` tinyint(1) NULL DEFAULT 1,
  `status` tinyint(1) NULL DEFAULT 1,
  `created_at` int(10) NULL DEFAULT NULL,
  `updated_at` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = '分类' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 0, '数码', 1, 1, 1611911214, 1611911214);
INSERT INTO `categories` VALUES (2, 1, '摄影摄像', 2, 1, 1611911214, 1611911214);
INSERT INTO `categories` VALUES (3, 2, '数码相机', 3, 1, 1611911214, 1611911214);
INSERT INTO `categories` VALUES (4, 2, '镜头', 3, 1, 1611911214, 1611911214);
INSERT INTO `categories` VALUES (5, 2, '单反相机', 3, 1, 1611911214, 1611911214);
INSERT INTO `categories` VALUES (6, 2, '摄像机', 3, 1, 1611911214, 1611911214);
INSERT INTO `categories` VALUES (7, 2, '数码相框', 3, 1, 1611911214, 1611911214);
INSERT INTO `categories` VALUES (8, 2, '微单相机', 3, 1, 1611911214, 1611911214);
INSERT INTO `categories` VALUES (9, 2, '拍立得', 3, 1, 1611911214, 1611911214);
INSERT INTO `categories` VALUES (10, 2, '运动相机', 3, 1, 1611911214, 1611911214);
INSERT INTO `categories` VALUES (11, 2, '户外器材', 3, 1, 1611911214, 1611911214);
INSERT INTO `categories` VALUES (12, 2, '影棚器材', 3, 1, 1611911214, 1611911214);
INSERT INTO `categories` VALUES (13, 2, '冲印服务', 3, 1, 1611911214, 1611911214);
INSERT INTO `categories` VALUES (14, 1, '数码配件', 2, 1, 1611911214, 1611911214);
INSERT INTO `categories` VALUES (15, 14, '相机清洁/贴膜', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (16, 14, '三脚架/云台', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (17, 14, '电池/充电器', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (18, 14, '滤镜', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (19, 14, '闪光灯/手柄', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (20, 14, '读卡器', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (21, 14, '相机包', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (22, 14, '存储卡', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (23, 14, '机身附件', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (24, 14, '镜头附件', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (25, 14, '数码支架', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (26, 1, '影音娱乐', 2, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (27, 26, '麦克风', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (28, 26, 'MP3/MP4', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (29, 26, '耳机/耳麦', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (30, 26, '音箱/音响', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (31, 26, '专业音频', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (32, 26, '苹果配件', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (33, 26, '收音机', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (34, 1, '虚拟商品', 2, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (35, 34, '延保服务', 3, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (36, 1, '智能设备', 2, 1, 1611911216, 1611911216);
INSERT INTO `categories` VALUES (37, 36, '其他配件', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (38, 36, '体感车', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (39, 36, '智能家居', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (40, 36, '智能配饰', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (41, 36, '智能手环', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (42, 36, '智能手表', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (43, 36, 'VR眼镜', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (44, 36, '运动跟踪器', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (45, 36, '健康监测', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (46, 36, '无人机', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (47, 36, '智能机器人', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (48, 1, '电子教育', 2, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (49, 48, '电子词典', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (50, 48, '录音笔', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (51, 48, '电纸书', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (52, 48, '早教益智', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (53, 48, '学生平板', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (54, 48, '点读机/笔', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (55, 48, '复读机', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (56, 48, '翻译机', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (57, 1, '数码维修', 2, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (58, 57, '其他数码产品维修', 3, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (59, 0, '电脑、办公', 1, 1, 1611911217, 1611911217);
INSERT INTO `categories` VALUES (60, 59, '外设产品', 2, 1, 1611911220, 1611911220);
INSERT INTO `categories` VALUES (61, 60, '手写板', 3, 1, 1611911220, 1611911220);
INSERT INTO `categories` VALUES (62, 60, 'U盘', 3, 1, 1611911220, 1611911220);
INSERT INTO `categories` VALUES (63, 60, '硬盘盒', 3, 1, 1611911220, 1611911220);
INSERT INTO `categories` VALUES (64, 60, '摄像头', 3, 1, 1611911220, 1611911220);
INSERT INTO `categories` VALUES (65, 60, '移动机械硬盘', 3, 1, 1611911220, 1611911220);
INSERT INTO `categories` VALUES (66, 60, '鼠标', 3, 1, 1611911220, 1611911220);
INSERT INTO `categories` VALUES (67, 60, '键盘', 3, 1, 1611911220, 1611911220);
INSERT INTO `categories` VALUES (68, 60, '鼠标垫', 3, 1, 1611911220, 1611911220);
INSERT INTO `categories` VALUES (69, 60, '线缆', 3, 1, 1611911220, 1611911220);
INSERT INTO `categories` VALUES (70, 60, 'UPS电源', 3, 1, 1611911220, 1611911220);
INSERT INTO `categories` VALUES (71, 60, '电脑清洁', 3, 1, 1611911220, 1611911220);
INSERT INTO `categories` VALUES (72, 59, '电脑组件', 2, 1, 1611911220, 1611911220);
INSERT INTO `categories` VALUES (73, 72, '机箱', 3, 1, 1611911221, 1611911221);
INSERT INTO `categories` VALUES (74, 72, '刻录机/光驱', 3, 1, 1611911221, 1611911221);
INSERT INTO `categories` VALUES (75, 72, '硬盘', 3, 1, 1611911221, 1611911221);
INSERT INTO `categories` VALUES (76, 72, '散热器', 3, 1, 1611911221, 1611911221);
INSERT INTO `categories` VALUES (77, 72, '主板', 3, 1, 1611911221, 1611911221);
INSERT INTO `categories` VALUES (78, 72, '内存', 3, 1, 1611911221, 1611911221);
INSERT INTO `categories` VALUES (79, 72, '显卡', 3, 1, 1611911221, 1611911221);
INSERT INTO `categories` VALUES (80, 72, 'CPU', 3, 1, 1611911221, 1611911221);
INSERT INTO `categories` VALUES (81, 72, '电源', 3, 1, 1611911221, 1611911221);
INSERT INTO `categories` VALUES (82, 72, '显示器', 3, 1, 1611911221, 1611911221);
INSERT INTO `categories` VALUES (83, 72, '装机配件', 3, 1, 1611911221, 1611911221);
INSERT INTO `categories` VALUES (84, 59, '服务产品', 2, 1, 1611911221, 1611911221);
INSERT INTO `categories` VALUES (85, 84, '京东服务', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (86, 84, '电脑软件', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (87, 84, '延保服务', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (88, 84, '电脑办公设备保养', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (89, 59, '网络产品', 2, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (90, 89, '交换机', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (91, 89, '路由器', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (92, 89, '网卡', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (93, 89, '网络存储', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (94, 89, '5G/4G上网', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (95, 89, '网络盒子', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (96, 89, '网络配件', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (97, 59, '电脑整机', 2, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (98, 97, '笔记本配件', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (99, 97, '服务器/工作站', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (100, 97, '台式机', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (101, 97, '笔记本', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (102, 97, '游戏本', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (103, 97, '平板电脑', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (104, 97, '平板电脑配件', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (105, 97, '一体机', 3, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (106, 59, '办公设备', 2, 1, 1611911222, 1611911222);
INSERT INTO `categories` VALUES (107, 106, '打印机', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (108, 106, '复合机', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (109, 106, '传真设备', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (110, 106, '扫描仪', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (111, 106, '投影机', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (112, 106, '碎纸机', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (113, 106, '考勤机', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (114, 106, '验钞/点钞机', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (115, 106, '白板', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (116, 106, '保险柜/箱', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (117, 106, '投影配件', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (118, 59, '文具', 2, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (119, 118, '计算器', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (120, 118, '学生文具', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (121, 118, '笔类', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (122, 118, '文件管理', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (123, 118, '办公文具', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (124, 118, '财会用品', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (125, 118, '本册/便签', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (126, 118, '画具画材', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (127, 118, '文房四宝', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (128, 59, '赠品', 2, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (129, 128, '赠品', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (130, 59, '游戏设备', 2, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (131, 130, '游戏周边', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (132, 130, '游戏软件', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (133, 130, '手柄/方向盘', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (134, 130, '游戏耳机', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (135, 130, '游戏机', 3, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (136, 59, '电脑办公安装', 2, 1, 1611911223, 1611911223);
INSERT INTO `categories` VALUES (137, 136, '办公设备安装', 3, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (138, 136, '电脑安装', 3, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (139, 59, '电脑办公维修', 2, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (140, 139, '平板维修', 3, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (141, 139, '笔记本维修', 3, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (142, 0, '家用电器', 1, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (143, 142, '生活电器', 2, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (144, 143, '取暖器', 3, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (145, 143, '吸尘器', 3, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (146, 143, '电风扇', 3, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (147, 143, '饮水机', 3, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (148, 143, '空气净化器', 3, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (149, 143, '加湿器', 3, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (150, 143, '潮流生活电器', 3, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (151, 143, '电话机', 3, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (152, 143, '净水器', 3, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (153, 143, '蒸汽/电动拖把', 3, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (154, 143, '冷风扇', 3, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (155, 142, '厨房小电', 2, 1, 1611911224, 1611911224);
INSERT INTO `categories` VALUES (156, 155, '酸奶机', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (157, 155, '电水壶/热水瓶', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (158, 155, '咖啡机', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (159, 155, '多用途锅', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (160, 155, '料理机', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (161, 155, '电饭煲', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (162, 155, '微波炉', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (163, 155, '电烤箱', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (164, 155, '豆浆机', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (165, 155, '电磁炉', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (166, 155, '潮流厨电', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (167, 142, '大 家 电', 2, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (168, 167, '平板电视', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (169, 167, '洗衣机', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (170, 167, '空调', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (171, 167, '冰箱', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (172, 167, '冷柜/冰吧', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (173, 167, '酒柜', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (174, 167, '中央空调', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (175, 167, '烘干机', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (176, 167, '移动空调', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (177, 167, '洗烘套装', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (178, 142, '个护健康', 2, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (179, 178, '剃须刀', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (180, 178, '剃/脱毛器', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (181, 178, '电动牙刷', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (182, 178, '电吹风', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (183, 178, '美容器', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (184, 178, '潮流护理电器', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (185, 178, '足浴盆', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (186, 178, '按摩器', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (187, 178, '其它健康电器', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (188, 178, '按摩椅', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (189, 178, '电子秤', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (190, 142, '厨卫大电', 2, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (191, 190, '消毒柜', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (192, 190, '油烟机', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (193, 190, '洗碗机', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (194, 190, '燃气灶', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (195, 190, '电热水器', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (196, 190, '燃气热水器', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (197, 190, '集成烹饪中心', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (198, 190, '空气能热水器', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (199, 190, '太阳能热水器', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (200, 190, '嵌入式微蒸烤', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (201, 190, '集成净洗中心', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (202, 142, '商用电器', 2, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (203, 202, '香肠/热狗机', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (204, 202, '电动餐车', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (205, 202, '商用开水器', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (206, 202, '果糖机', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (207, 202, '棉花糖机', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (208, 202, '章鱼丸机', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (209, 202, '肠粉机', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (210, 202, '保温售饭台', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (211, 202, '商用绞肉机/切肉机', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (212, 202, '商用电饼铛', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (213, 202, '商用压面机', 3, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (214, 142, '家电服务', 2, 1, 1611911225, 1611911225);
INSERT INTO `categories` VALUES (215, 214, '家电清洗', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (216, 214, '家电维修', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (217, 214, '家电安装', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (218, 142, '视听影音', 2, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (219, 218, '功放', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (220, 218, '回音壁/Soundbar', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (221, 218, 'KTV音响', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (222, 218, '麦克风', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (223, 218, '播放器/DVD', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (224, 218, 'HIFI专区', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (225, 218, '家庭影院', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (226, 218, '迷你音响', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (227, 142, '家电配件', 2, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (228, 227, '个护健康配件', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (229, 227, '厨房小电配件', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (230, 227, '烟机灶具配件', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (231, 227, '洗衣机配件', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (232, 227, '冰箱配件', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (233, 227, '生活电器配件', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (234, 227, '空调配件', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (235, 227, '电视配件', 3, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (236, 0, '食品饮料', 1, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (237, 236, '休闲食品', 2, 1, 1611911226, 1611911226);
INSERT INTO `categories` VALUES (238, 237, '饼干蛋糕', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (239, 237, '糖果/巧克力', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (240, 237, '蜜饯果干', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (241, 237, '肉干肉脯', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (242, 237, '坚果炒货', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (243, 237, '休闲零食', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (244, 237, '熟食腊味', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (245, 236, '地方特产', 2, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (246, 245, '新疆', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (247, 245, '湖南', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (248, 245, '云南', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (249, 245, '四川', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (250, 245, '北京', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (251, 245, '山西', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (252, 245, '内蒙古', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (253, 245, '福建', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (254, 245, '东北', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (255, 245, '其他特产', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (256, 236, '饮料冲调', 2, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (257, 256, '冲饮谷物', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (258, 256, '饮料', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (259, 256, '咖啡/奶茶', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (260, 256, '牛奶乳品', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (261, 256, '饮用水', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (262, 256, '成人奶粉', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (263, 256, '蜂蜜/柚子茶', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (264, 236, '粮油调味', 2, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (265, 264, '米', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (266, 264, '方便食品', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (267, 264, '南北干货', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (268, 264, '调味品', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (269, 264, '食用油', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (270, 264, '有机食品', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (271, 264, '烘焙原料', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (272, 264, '面', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (273, 264, '杂粮', 3, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (274, 236, '节庆食品/礼券', 2, 1, 1611911227, 1611911227);
INSERT INTO `categories` VALUES (275, 274, '月饼', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (276, 274, '粽子', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (277, 274, '卡券', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (278, 236, '进口食品', 2, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (279, 278, '冲调品', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (280, 278, '休闲零食', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (281, 278, '糖果/巧克力', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (282, 278, '饼干蛋糕', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (283, 278, '米面调味', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (284, 278, '牛奶乳品', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (285, 278, '水', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (286, 278, '油', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (287, 278, '方便食品', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (288, 278, '饮料', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (289, 278, '咖啡', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (290, 236, '茗茶', 2, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (291, 290, '红茶', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (292, 290, '绿茶', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (293, 290, '龙井', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (294, 290, '普洱', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (295, 290, '铁观音', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (296, 290, '其它茶', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (297, 290, '黑茶', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (298, 290, '白茶', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (299, 290, '花果茶', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (300, 290, '养生茶', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (301, 290, '乌龙茶', 3, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (302, 0, '服饰内衣', 1, 1, 1611911228, 1611911228);
INSERT INTO `categories` VALUES (303, 302, '服饰配件', 2, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (304, 303, '围巾/手套/帽子套装', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (305, 303, '袖扣', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (306, 303, '光学镜架/镜片', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (307, 303, '太阳镜', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (308, 303, '遮阳帽', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (309, 303, '棒球帽', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (310, 303, '毛线帽', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (311, 303, '老花镜', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (312, 303, '装饰眼镜', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (313, 303, '防辐射眼镜', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (314, 303, '游泳镜', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (315, 302, '内衣', 2, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (316, 315, '睡衣/家居服', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (317, 315, '保暖内衣', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (318, 315, '吊带/背心', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (319, 315, '文胸', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (320, 315, '女式内裤', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (321, 315, '泳衣', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (322, 315, '抹胸', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (323, 315, '美腿袜', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (324, 315, '连裤袜/丝袜', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (325, 315, '塑身美体', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (326, 315, '商务男袜', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (327, 302, '女装', 2, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (328, 327, '针织衫', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (329, 327, '衬衫', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (330, 327, 'T恤', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (331, 327, '羽绒服', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (332, 327, '正装裤', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (333, 327, '连衣裙', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (334, 327, '打底裤', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (335, 327, '休闲裤', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (336, 327, '马甲', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (337, 327, '牛仔裤', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (338, 327, '短外套', 3, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (339, 302, '男装', 2, 1, 1611911229, 1611911229);
INSERT INTO `categories` VALUES (340, 339, '针织衫', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (341, 339, '衬衫', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (342, 339, 'T恤', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (343, 339, '羽绒服', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (344, 339, '工装', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (345, 339, '中老年男装', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (346, 339, '唐装/汉服', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (347, 339, '西服套装', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (348, 339, '大码男装', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (349, 339, '休闲裤', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (350, 339, '西裤', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (351, 302, '洗衣服务', 2, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (352, 351, '服装洗护', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (353, 0, '美妆护肤', 1, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (354, 353, '香水彩妆', 2, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (355, 354, '彩妆套装', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (356, 354, '睫毛膏/增长液', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (357, 354, '口红', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (358, 354, '美甲产品', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (359, 354, '眉笔/眉粉', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (360, 354, '眼影', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (361, 354, '腮红/胭脂', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (362, 354, '粉底液/膏', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (363, 354, '香水', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (364, 354, '眼线笔/眼线液', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (365, 354, '唇笔/唇线笔', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (366, 353, '面部护肤', 2, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (367, 366, '套装/礼盒', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (368, 366, '面膜', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (369, 366, '洁面', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (370, 366, '爽肤水/化妆水', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (371, 366, '乳液/面霜', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (372, 366, '防晒', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (373, 366, '卸妆', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (374, 366, '面部精华', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (375, 366, '眼霜/眼部精华', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (376, 366, 'T区护理', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (377, 366, '唇膜/唇部精华', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (378, 353, '男士面部护肤', 2, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (379, 378, '套装/礼盒', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (380, 378, '男士润唇膏', 3, 1, 1611911230, 1611911230);
INSERT INTO `categories` VALUES (381, 378, '其它男士面部护肤', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (382, 378, '男士爽肤水/化妆水', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (383, 378, '男士面部精华', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (384, 378, '男士眼霜/眼部精华', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (385, 378, '男士洁面', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (386, 378, '男士T区护理', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (387, 378, '男士面膜', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (388, 378, '男士防晒', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (389, 378, '男士乳液/面霜', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (390, 353, '美妆工具', 2, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (391, 390, '假睫毛', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (392, 390, '双眼皮贴', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (393, 390, '化妆棉', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (394, 390, '粉扑/洗脸扑', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (395, 390, '化妆刷', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (396, 390, '修眉刀', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (397, 390, '睫毛夹', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (398, 390, '美妆工具套装', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (399, 390, '美甲工具', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (400, 390, '其他美妆工具', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (401, 0, '运动户外', 1, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (402, 401, '户外装备', 2, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (403, 402, '户外工具', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (404, 402, '野餐用品', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (405, 402, '户外照明', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (406, 402, '登山攀岩', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (407, 402, '睡袋/吊床', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (408, 402, '帐篷/垫子', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (409, 402, '背包', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (410, 402, '望远镜', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (411, 402, '旅行装备', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (412, 402, '户外配饰', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (413, 402, '户外仪表', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (414, 401, '健身训练', 2, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (415, 414, '跑步机', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (416, 414, '动感单车', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (417, 414, '综合训练器', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (418, 414, '椭圆机', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (419, 414, '哑铃', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (420, 414, '其他器械', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (421, 414, '甩脂机', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (422, 414, '踏步机', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (423, 414, '健腹轮', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (424, 414, '拉力器/臂力器', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (425, 414, '跳绳', 3, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (426, 401, '体育用品', 2, 1, 1611911231, 1611911231);
INSERT INTO `categories` VALUES (427, 426, '台球桌', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (428, 426, '高尔夫球杆套杆', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (429, 426, '排球', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (430, 426, '篮球', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (431, 426, '足球', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (432, 426, '网球拍', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (433, 426, '乒乓球拍', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (434, 426, '羽毛球拍', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (435, 426, '棒球', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (436, 426, '其他田径用品', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (437, 426, '篮球框', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (438, 401, '户外鞋服', 2, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (439, 438, '休闲鞋', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (440, 438, '工装鞋', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (441, 438, '徒步鞋', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (442, 438, '越野跑鞋', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (443, 438, '户外袜', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (444, 438, '溯溪鞋', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (445, 438, '沙滩/凉拖', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (446, 438, 'T恤', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (447, 438, '户外风衣', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (448, 438, '抓绒衣裤', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (449, 438, '软壳衣裤', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (450, 401, '运动鞋包', 2, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (451, 450, '运动包', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (452, 450, '拖鞋', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (453, 450, '训练鞋', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (454, 450, '足球鞋', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (455, 450, '篮球鞋', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (456, 450, '跑步鞋', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (457, 450, '帆布鞋', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (458, 450, '休闲鞋', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (459, 450, '板鞋', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (460, 450, '专项运动鞋', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (461, 450, '球鞋定制', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (462, 401, '运动服饰', 2, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (463, 462, '卫衣/套头衫', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (464, 462, 'T恤', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (465, 462, '运动裤', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (466, 462, '套装', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (467, 462, '棉服', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (468, 462, '夹克/风衣', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (469, 462, '羽绒服', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (470, 462, '毛衫/线衫', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (471, 462, '健身服', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (472, 462, '运动背心', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (473, 462, '运动配饰', 3, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (474, 401, '骑行运动', 2, 1, 1611911232, 1611911232);
INSERT INTO `categories` VALUES (475, 474, '山地车', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (476, 474, '折叠车', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (477, 474, '电动车', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (478, 474, '穿戴装备', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (479, 474, '骑行服', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (480, 474, '城市自行车', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (481, 474, '平衡车', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (482, 474, '公路车', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (483, 474, '自行车配件', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (484, 474, '电动滑板车', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (485, 474, '老年代步车', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (486, 401, '游泳用品', 2, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (487, 486, '游泳配件', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (488, 486, '比基尼', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (489, 486, '泳镜', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (490, 486, '男士泳衣', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (491, 486, '女士泳衣', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (492, 486, '游泳包防水包', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (493, 486, '泳帽', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (494, 486, '游泳圈', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (495, 401, '垂钓用品', 2, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (496, 495, '辅助装备', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (497, 495, '渔具包', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (498, 495, '钓鱼配件', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (499, 495, '钓箱钓椅', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (500, 495, '浮漂', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (501, 495, '钓竿', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (502, 495, '鱼线', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (503, 495, '钓鱼灯', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (504, 495, '鱼饵', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (505, 495, '鱼线轮', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (506, 495, '钓鱼服饰', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (507, 401, '体育服务', 2, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (508, 507, '团体培训', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (509, 507, '私教培训', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (510, 507, '赛事报名', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (511, 507, '其他', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (512, 401, '运动护具', 2, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (513, 512, '护齿', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (514, 512, '运动护肩', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (515, 512, '健身手套', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (516, 512, '护指', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (517, 512, '护腕', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (518, 512, '运动护踝', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (519, 512, '运动护腿', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (520, 512, '运动护臀', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (521, 512, '运动护膝', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (522, 512, '运动护肘', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (523, 512, '运动护腰', 3, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (524, 0, '母婴', 1, 1, 1611911233, 1611911233);
INSERT INTO `categories` VALUES (525, 524, '营养辅食', 2, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (526, 525, '米粉/菜粉', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (527, 525, '果泥/果汁', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (528, 525, '益生菌/初乳', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (529, 525, '钙铁锌/维生素', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (530, 525, '清火/开胃', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (531, 525, 'DHA', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (532, 525, '面条/粥', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (533, 525, '宝宝零食', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (534, 524, '尿裤湿巾', 2, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (535, 534, '婴儿湿巾', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (536, 534, '拉拉裤', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (537, 534, '成人尿裤', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (538, 534, '婴儿尿裤', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (539, 534, '婴儿纸尿片', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (540, 524, '喂养用品', 2, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (541, 540, '吸奶器', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (542, 540, '暖奶消毒', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (543, 540, '牙胶安抚', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (544, 540, '儿童餐具', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (545, 540, '水壶/水杯', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (546, 540, '奶瓶奶嘴', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (547, 540, '辅食料理机', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (548, 540, '围兜/防溅衣', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (549, 540, '食物存储', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (550, 524, '洗护用品', 2, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (551, 550, '驱蚊防晒', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (552, 550, '座便器', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (553, 550, '洗衣液/皂', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (554, 550, '宝宝护肤', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (555, 550, '日常护理', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (556, 550, '奶瓶清洗', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (557, 550, '洗发沐浴', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (558, 550, '婴儿理发器', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (559, 550, '洗澡用具', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (560, 550, '婴儿口腔清洁', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (561, 550, '棉柔巾', 3, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (562, 524, '奶粉', 2, 1, 1611911234, 1611911234);
INSERT INTO `categories` VALUES (563, 562, '孕妈奶粉', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (564, 562, '婴幼儿奶粉', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (565, 524, '童车童床', 2, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (566, 565, '学步车', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (567, 565, '三轮车', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (568, 565, '婴幼儿餐椅', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (569, 565, '婴儿床', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (570, 565, '电动车', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (571, 565, '自行车', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (572, 565, '婴儿推车', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (573, 565, '扭扭车', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (574, 565, '滑板车', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (575, 565, '婴儿床垫', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (576, 565, '儿童摇椅', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (577, 524, '赠品', 2, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (578, 524, '妈妈专区', 2, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (579, 578, '出行用品', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (580, 578, '孕产妇洗护', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (581, 578, '产后塑身', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (582, 578, '孕妇装', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (583, 578, '防辐射服', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (584, 578, '孕期营养', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (585, 578, '文胸/内裤', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (586, 578, '孕产妇家居服/哺乳装', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (587, 578, '待产护理', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (588, 578, '哺乳用品', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (589, 578, '孕产妇鞋帽袜', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (590, 524, '婴童寝居', 2, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (591, 590, '婴儿鞋帽袜', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (592, 590, '婴童床品套件', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (593, 590, '防护栏', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (594, 590, '婴童睡袋/抱被', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (595, 590, '爬行垫', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (596, 590, '婴童床围', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (597, 590, '婴童床单/床褥', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (598, 590, '婴童凉席/蚊帐', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (599, 590, '吸汗巾/垫背巾', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (600, 590, '婴童被子/被套', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (601, 590, '婴童枕芯/枕套', 3, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (602, 524, '童装', 2, 1, 1611911235, 1611911235);
INSERT INTO `categories` VALUES (603, 602, '儿童配饰', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (604, 602, '亲子装', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (605, 602, '裤子', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (606, 602, '裙子', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (607, 602, '羽绒服', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (608, 602, '内衣裤', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (609, 602, '礼服/演出服', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (610, 602, '套装', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (611, 602, 'T恤', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (612, 602, '户外/运动服', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (613, 602, '连体衣/爬服', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (614, 524, '安全座椅', 2, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (615, 614, '增高垫', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (616, 614, '安全座椅', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (617, 614, '提篮式', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (618, 0, '家居日用', 1, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (619, 618, '生活日用', 2, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (620, 619, '缝纫机', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (621, 619, '浴室用品', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (622, 619, '雨伞雨具', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (623, 619, '净化除味', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (624, 619, '洗晒/熨烫', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (625, 619, '保暖防护', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (626, 619, '上门除醛', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (627, 619, '缝纫/针织材料', 3, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (628, 618, '家装软饰', 2, 1, 1611911236, 1611911236);
INSERT INTO `categories` VALUES (629, 628, '节庆饰品', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (630, 628, '手工/十字绣', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (631, 628, '装饰摆件', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (632, 628, '相框/照片墙', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (633, 628, '装饰字画', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (634, 628, '帘艺隔断', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (635, 628, '墙贴/装饰贴', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (636, 628, '钟饰', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (637, 628, '花瓶花艺', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (638, 628, '创意家居', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (639, 628, '香薰蜡烛', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (640, 618, '收纳用品', 2, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (641, 640, '收纳袋/包', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (642, 640, '收纳箱', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (643, 640, '收纳柜', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (644, 640, '收纳架/篮', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (645, 640, '防尘罩', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (646, 640, '分隔收纳', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (647, 640, '收纳盒', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (648, 0, '图书', 1, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (649, 648, '建筑', 2, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (650, 649, '法律法规', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (651, 649, '标准和规范', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (652, 649, '执业资格考试用书', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (653, 649, '房屋建筑设备', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (654, 649, '物业管理', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (655, 649, '房地产开发管理', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (656, 649, '建筑设计', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (657, 649, '建筑艺术', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (658, 649, '建筑经济', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (659, 649, '室内设计、装饰装修', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (660, 649, '建筑工具书', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (661, 648, '医学', 2, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (662, 661, '医疗器械及使用', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (663, 661, '耳鼻咽喉科学', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (664, 661, '眼科学', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (665, 661, '神经病学与精神病学', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (666, 661, '皮肤病学与性病学', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (667, 661, '儿科学', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (668, 661, '肿瘤学', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (669, 661, '外科学', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (670, 661, '妇产科学', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (671, 661, '医学文献', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (672, 661, '医学/药学类考试', 3, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (673, 648, '科学与自然', 2, 1, 1611911237, 1611911237);
INSERT INTO `categories` VALUES (674, 673, '地理学', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (675, 673, '生物科学', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (676, 673, '环境科学', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (677, 673, '自然科学总论', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (678, 673, '自然科学文献检索', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (679, 673, '自然科学丛书、文集、连续性出版物', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (680, 673, '数学', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (681, 673, '非线性科学', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (682, 673, '物理学', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (683, 673, '力学', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (684, 673, '晶体学', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (685, 648, '计算机与互联网', 2, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (686, 685, '硬件与维护', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (687, 685, '游戏开发', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (688, 685, '移动开发', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (689, 685, '考试认证', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (690, 685, '专用软件', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (691, 685, '办公软件', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (692, 685, '计算机理论、基础知识', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (693, 685, '信息系统', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (694, 685, '大数据与云计算', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (695, 685, '新手学电脑', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (696, 685, '电子商务', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (697, 648, '文化', 2, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (698, 697, '世界各国文化', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (699, 697, '文化刊物', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (700, 697, '文化研究', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (701, 697, '文化评述', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (702, 697, '文化专题研究', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (703, 697, '文化交流/文化产业', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (704, 697, '传统文化', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (705, 697, '地域文化', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (706, 697, '民族文化', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (707, 697, '民俗文化', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (708, 697, '文化理论', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (709, 648, '社会科学', 2, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (710, 709, '统计学', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (711, 709, '公共关系', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (712, 709, '社区', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (713, 709, '社会保障', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (714, 709, '社会学', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (715, 709, '社会生活与社会问题', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (716, 709, '社会调查', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (717, 709, '社会科学理论', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (718, 709, '社会科学丛书、文集、连续出版物', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (719, 709, '社会科学文献检索', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (720, 709, '人口学', 3, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (721, 648, '工业技术', 2, 1, 1611911238, 1611911238);
INSERT INTO `categories` VALUES (722, 721, '石油、天然气工业', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (723, 721, '武器工业', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (724, 721, '食品安全', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (725, 721, '机构、团体、会议', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (726, 721, '金属学与金属工艺', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (727, 721, '轻工业、手工业', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (728, 721, '自动化技术', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (729, 721, '工业技术理论', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (730, 721, '参考工具书', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (731, 721, '原子能技术', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (732, 721, '化学工业', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (733, 648, '字典词典/工具书', 2, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (734, 733, '汉语词典', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (735, 733, '汉语字典', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (736, 733, '英汉/汉英词典', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (737, 733, '其他语种词典', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (738, 733, '法语词典', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (739, 733, '德语词典', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (740, 733, '韩语词典', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (741, 733, '日语词典', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (742, 733, '中小学工具书', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (743, 733, '成语词典', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (744, 648, '运动/健身', 2, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (745, 744, '棋牌运动', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (746, 744, '球类运动', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (747, 744, '运动会', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (748, 744, '田径运动', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (749, 744, '水上运动', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (750, 744, '休闲运动', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (751, 744, '太极/武术/气功', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (752, 744, '跆拳道/拳击', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (753, 744, '其他运动', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (754, 744, '极限运动', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (755, 744, '电子竞技', 3, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (756, 648, '中小学教辅', 2, 1, 1611911239, 1611911239);
INSERT INTO `categories` VALUES (757, 756, '中小学工具书', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (758, 756, '课外读物', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (759, 756, '小学通用', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (760, 756, '作文', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (761, 756, '奥数/竞赛', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (762, 756, '高中通用', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (763, 756, '初中通用', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (764, 756, '学习方法/报考指南', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (765, 756, '小学二年级', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (766, 756, '小学一年级', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (767, 756, '高考', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (768, 648, '考试', 2, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (769, 768, '注册会计师考试', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (770, 768, '其他资格/职称考试', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (771, 768, '计算机考试', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (772, 768, '汉语/小语种考试', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (773, 768, '成人高考/自考', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (774, 768, '同等学力考试', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (775, 768, 'MBA/MPA/MPACC', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (776, 768, '考研专业课', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (777, 768, '考研英语', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (778, 768, '考研数学', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (779, 768, '事业单位考试', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (780, 0, '礼品', 1, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (781, 780, '奢侈品', 2, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (782, 781, '钱包', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (783, 781, '箱包', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (784, 781, '配件', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (785, 781, '太阳镜/眼镜框', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (786, 781, '腰带', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (787, 781, '服饰', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (788, 781, '高档化妆品', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (789, 781, '名品腕表', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (790, 781, '鞋靴', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (791, 781, '饰品', 3, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (792, 780, '礼品', 2, 1, 1611911240, 1611911240);
INSERT INTO `categories` VALUES (793, 792, '军刀军具', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (794, 792, '礼品文具', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (795, 792, '工艺礼品', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (796, 792, '收藏品', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (797, 792, '礼盒礼券', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (798, 792, '婚庆节庆', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (799, 792, '创意礼品', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (800, 792, '京东卡', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (801, 792, '美妆礼品', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (802, 792, '礼品定制', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (803, 792, '古董文玩', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (804, 780, '婚庆', 2, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (805, 804, '婚宴', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (806, 804, '婚庆礼品/用品', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (807, 804, '婚庆服务', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (808, 804, '婚纱礼服', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (809, 804, '婚嫁首饰', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (810, 780, '鲜花', 2, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (811, 810, '卡通花束', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (812, 810, '香皂花', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (813, 810, '干花', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (814, 810, '永生花', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (815, 810, '鲜花', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (816, 810, '花材配件', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (817, 810, '开业花篮', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (818, 810, '婚庆鲜花', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (819, 780, '火机烟具', 2, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (820, 819, '烟油', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (821, 819, '电子烟', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (822, 819, '烟嘴', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (823, 819, '打火机', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (824, 819, '烟盒', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (825, 819, '烟斗', 3, 1, 1611911241, 1611911241);
INSERT INTO `categories` VALUES (826, 819, '替烟产品', 3, 1, 1611911241, 1611911241);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for members
-- ----------------------------
DROP TABLE IF EXISTS `members`;
CREATE TABLE `members`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `salt` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `password` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nickname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `sex` tinyint(1) NULL DEFAULT 0 COMMENT '1男2女0未知',
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `created_at` int(10) NULL DEFAULT NULL,
  `updated_at` int(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of members
-- ----------------------------
INSERT INTO `members` VALUES (9, 'happyceclear@163.com', 'happyceclear@163.com', 'c4ca4', '$2y$10$t0zFhcDkFQE5nCEqTKv3KOA.KAycioS.EShXkcqbEcLp10c.jX2Q.', NULL, NULL, 0, 'z', 't', 1610418855, 1610418855);
INSERT INTO `members` VALUES (10, '594652523@qq.com', '594652523@qq.com', 'c4ca4', '$2y$10$YVizUrobupidJtpViRXsq.RZP3sh5bPGgW0HtF17rKgJvrlaGg2em', NULL, NULL, 0, 'z', 'z', 1610418891, 1610418891);
INSERT INTO `members` VALUES (11, 'liangniangcanyin@163.com', 'liangniangcanyin@163.com', 'c4ca4', '$2y$10$aqUS00dM9QxJvOyoIotm.OH.cA.k.4g3Qz9eEkRd3ciOC7ouUrxBq', NULL, NULL, 0, 's', '11', 1610437040, 1610437040);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2016_01_04_173148_create_admin_tables', 1);
INSERT INTO `migrations` VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for rates
-- ----------------------------
DROP TABLE IF EXISTS `rates`;
CREATE TABLE `rates`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `symbol` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `rate` int(11) NULL DEFAULT 100,
  `created_at` int(11) NULL DEFAULT NULL,
  `updated_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of rates
-- ----------------------------
INSERT INTO `rates` VALUES (1, '￥', 'RMB', 100, NULL, NULL);
INSERT INTO `rates` VALUES (2, '$', 'USD', 698, NULL, NULL);
INSERT INTO `rates` VALUES (3, '€', 'EUR', 1100, NULL, NULL);

-- ----------------------------
-- Table structure for subtract_details
-- ----------------------------
DROP TABLE IF EXISTS `subtract_details`;
CREATE TABLE `subtract_details`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_id` int(11) NOT NULL,
  `key_str` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `enter_val` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL COMMENT '填入的值',
  `val` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL COMMENT '答案',
  `created_at` int(11) NULL DEFAULT NULL,
  `updated_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 61 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = '作业详情' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of subtract_details
-- ----------------------------
INSERT INTO `subtract_details` VALUES (61, 1, '7+2-8', '1', '1', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (62, 1, '5+8-12', '1', '1', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (63, 1, '8-4+14', '1', '18', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (64, 1, '12+5-15', '1', '2', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (65, 1, '11-10+15', '1', '16', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (66, 1, '15+2-9', '1', '8', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (67, 1, '15-10+15', '1', '20', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (68, 1, '11-8+15', '1', '18', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (69, 1, '8+2-5', '1', '5', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (70, 1, '1+17-17', '1', '1', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (71, 1, '11-9+15', '1', '17', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (72, 1, '9-7+17', '1', '19', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (73, 1, '10-8+14', '1', '16', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (74, 1, '13+1-8', '1', '6', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (75, 1, '14+4-4', '1', '14', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (76, 1, '1+19-19', '1', '1', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (77, 1, '12+3-7', '1', '8', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (78, 1, '13-7+13', '1', '19', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (79, 1, '10+6-6', '1', '10', 1611889391, NULL);
INSERT INTO `subtract_details` VALUES (80, 1, '13+3-13', '1', '3', 1611889391, NULL);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
