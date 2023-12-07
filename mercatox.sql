-- Adminer 4.8.1 MySQL 8.0.33 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `mercatox`;
CREATE DATABASE `mercatox` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mercatox`;

DROP TABLE IF EXISTS `advertisement`;
CREATE TABLE `advertisement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(75) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `redireccion` varchar(55) NOT NULL,
  `fecha_habilitacion` date NOT NULL,
  `fecha_deshabilitacion` date NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tipo` varchar(55) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `advertisement_type_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_advertisement_advertisement_type1_idx` (`advertisement_type_id`),
  CONSTRAINT `fk_advertisement_advertisement_type1` FOREIGN KEY (`advertisement_type_id`) REFERENCES `advertisement_site` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `advertisement` (`id`, `nombre`, `descripcion`, `imagen`, `redireccion`, `fecha_habilitacion`, `fecha_deshabilitacion`, `timestamp`, `tipo`, `advertisement_type_id`) VALUES
(1,	'Hallowen',	'Hallowend add',	'storage/ads/1_29_10_2023_12_00_58.webp',	'#',	'2023-10-01',	'2023-11-30',	'2023-10-29 00:00:58',	'DESCUENTOS',	1),
(2,	'Pago',	'MCD',	'storage/ads/2_29_10_2023_12_02_32.webp',	'#',	'2023-10-01',	'2023-11-30',	'2023-10-29 00:02:32',	'DESCUENTOS',	1),
(3,	'OFFERTA',	'OFFERTA',	'storage/ads/3_29_10_2023_12_02_52.webp',	'#',	'2023-10-01',	'2023-11-30',	'2023-10-29 00:02:52',	'DESCUENTOS',	1),
(4,	'OFFERTA',	'OFFERTA',	'storage/ads/4_29_10_2023_12_02_58.webp',	'#',	'2023-10-01',	'2023-11-30',	'2023-10-29 00:02:58',	'DESCUENTOS',	1),
(5,	'OFFERTA',	'OFFERTA',	'storage/ads/5_29_10_2023_12_03_03.webp',	'#',	'2023-10-01',	'2023-11-30',	'2023-10-29 00:03:03',	'DESCUENTOS',	1),
(6,	'OFFERTA',	'OFFERTA',	'storage/ads/6_29_10_2023_12_03_08.webp',	'#',	'2023-10-01',	'2023-11-30',	'2023-10-29 00:03:08',	'DESCUENTOS',	1),
(7,	'OFFERTA',	'OFFERTA',	'storage/ads/7_29_10_2023_12_03_12.webp',	'#',	'2023-10-01',	'2023-11-30',	'2023-10-29 00:03:12',	'DESCUENTOS',	1),
(8,	'OFFERTA',	'OFFERTA',	'storage/ads/8_29_10_2023_12_03_16.webp',	'#',	'2023-10-01',	'2023-11-06',	'2023-10-29 00:03:16',	'DESCUENTOS',	1),
(10,	'asd',	'asd',	'storage/ads/3_29_10_2023_12_02_52_08_11_2023_05_11_07.webp',	'asd',	'2023-11-06',	'2023-11-08',	'2023-11-08 05:00:50',	'12',	1);

DROP TABLE IF EXISTS `advertisement_site`;
CREATE TABLE `advertisement_site` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sitio` varchar(85) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `advertisement_site` (`id`, `sitio`) VALUES
(1,	'HOME_PAGE');

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int NOT NULL,
  `created_at` int DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_assignment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Admin',	1,	1698489519),
('Comprador',	32,	1698531261),
('Comprador',	33,	1698531425),
('Comprador',	35,	1698556111),
('Vendedor',	34,	1698539981),
('Vendedor',	36,	1698556244);

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  `group_code` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  KEY `fk_auth_item_group_code` (`group_code`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_auth_item_group_code` FOREIGN KEY (`group_code`) REFERENCES `auth_item_group` (`code`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`, `group_code`) VALUES
('/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/carrito/*',	3,	NULL,	NULL,	NULL,	1698811505,	1698811505,	NULL),
('/carrito/historial',	3,	NULL,	NULL,	NULL,	1698980207,	1698980207,	NULL),
('/carrito/procesar-carrito',	3,	NULL,	NULL,	NULL,	1698980207,	1698980207,	NULL),
('/carrito/remove-producto',	3,	NULL,	NULL,	NULL,	1698811505,	1698811505,	NULL),
('/carrito/view',	3,	NULL,	NULL,	NULL,	1698811505,	1698811505,	NULL),
('/debug/*',	3,	NULL,	NULL,	NULL,	1698489203,	1698489203,	NULL),
('/debug/default/*',	3,	NULL,	NULL,	NULL,	1698489203,	1698489203,	NULL),
('/debug/default/db-explain',	3,	NULL,	NULL,	NULL,	1698489203,	1698489203,	NULL),
('/debug/default/download-mail',	3,	NULL,	NULL,	NULL,	1698489203,	1698489203,	NULL),
('/debug/default/index',	3,	NULL,	NULL,	NULL,	1698489203,	1698489203,	NULL),
('/debug/default/toolbar',	3,	NULL,	NULL,	NULL,	1698489203,	1698489203,	NULL),
('/debug/default/view',	3,	NULL,	NULL,	NULL,	1698489203,	1698489203,	NULL),
('/debug/user/*',	3,	NULL,	NULL,	NULL,	1698489203,	1698489203,	NULL),
('/debug/user/reset-identity',	3,	NULL,	NULL,	NULL,	1698489203,	1698489203,	NULL),
('/debug/user/set-identity',	3,	NULL,	NULL,	NULL,	1698489203,	1698489203,	NULL),
('/gii/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/gii/default/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/gii/default/action',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/gii/default/diff',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/gii/default/index',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/gii/default/preview',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/gii/default/view',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/producto/*',	3,	NULL,	NULL,	NULL,	1698811505,	1698811505,	NULL),
('/producto/categoria',	3,	NULL,	NULL,	NULL,	1698811505,	1698811505,	NULL),
('/producto/view',	3,	NULL,	NULL,	NULL,	1698811505,	1698811505,	NULL),
('/sistema/*',	3,	NULL,	NULL,	NULL,	1698541110,	1698541110,	NULL),
('/sistema/advertisement',	3,	NULL,	NULL,	NULL,	1698541110,	1698541110,	NULL),
('/sistema/advertisement-create',	3,	NULL,	NULL,	NULL,	1698541110,	1698541110,	NULL),
('/sistema/order',	3,	NULL,	NULL,	NULL,	1698541110,	1698541110,	NULL),
('/sistema/product',	3,	NULL,	NULL,	NULL,	1698541110,	1698541110,	NULL),
('/sistema/publication',	3,	NULL,	NULL,	NULL,	1698541110,	1698541110,	NULL),
('/site/*',	3,	NULL,	NULL,	NULL,	1698489203,	1698489203,	NULL),
('/site/error',	3,	NULL,	NULL,	NULL,	1698489203,	1698489203,	NULL),
('/site/index',	3,	NULL,	NULL,	NULL,	1698489203,	1698489203,	NULL),
('/site/login',	3,	NULL,	NULL,	NULL,	1698489203,	1698489203,	NULL),
('/site/logout',	3,	NULL,	NULL,	NULL,	1698489203,	1698489203,	NULL),
('/site/register',	3,	NULL,	NULL,	NULL,	1698489203,	1698489203,	NULL),
('/site/register-vendedor',	3,	NULL,	NULL,	NULL,	1698489203,	1698489203,	NULL),
('/user-management/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/bulk-activate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/bulk-deactivate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/bulk-delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/create',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/grid-page-size',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/grid-sort',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/index',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/toggle-attribute',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/update',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth-item-group/view',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/captcha',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/change-own-password',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/confirm-email',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/confirm-email-receive',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/confirm-registration-email',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/login',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/password-recovery',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/password-recovery-receive',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/auth/registration',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/bulk-activate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/bulk-deactivate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/bulk-delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/create',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/grid-page-size',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/grid-sort',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/index',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/refresh-routes',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/set-child-permissions',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/set-child-routes',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/toggle-attribute',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/update',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/permission/view',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/bulk-activate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/bulk-deactivate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/bulk-delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/create',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/grid-page-size',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/grid-sort',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/index',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/set-child-permissions',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/set-child-roles',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/toggle-attribute',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/update',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/role/view',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-permission/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-permission/set',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-permission/set-roles',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/bulk-activate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/bulk-deactivate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/bulk-delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/create',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/grid-page-size',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/grid-sort',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/index',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/toggle-attribute',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/update',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user-visit-log/view',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/*',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/bulk-activate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/bulk-deactivate',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/bulk-delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/change-password',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/create',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/delete',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/grid-page-size',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/grid-sort',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/index',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/toggle-attribute',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/update',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/user-management/user/view',	3,	NULL,	NULL,	NULL,	1426062189,	1426062189,	NULL),
('/vendedor/*',	3,	NULL,	NULL,	NULL,	1698541110,	1698541110,	NULL),
('/vendedor/producto-create',	3,	NULL,	NULL,	NULL,	1698541110,	1698541110,	NULL),
('/vendedor/productos',	3,	NULL,	NULL,	NULL,	1698541110,	1698541110,	NULL),
('Admin',	1,	'Admin',	NULL,	NULL,	1426062189,	1426062189,	NULL),
('assignRolesToUsers',	2,	'Assign roles to users',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('bindUserToIp',	2,	'Bind user to IP',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('changeOwnPassword',	2,	'Change own password',	NULL,	NULL,	1426062189,	1426062189,	'userCommonPermissions'),
('changeUserPassword',	2,	'Change user password',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('commonPermission',	2,	'Common permission',	NULL,	NULL,	1426062188,	1426062188,	NULL),
('Comprador',	1,	'Comprador',	NULL,	NULL,	1698489103,	1698489103,	NULL),
('Compradores',	2,	'Compradores',	NULL,	NULL,	1698489185,	1698489185,	NULL),
('createUsers',	2,	'Create users',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('deleteUsers',	2,	'Delete users',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('editUserEmail',	2,	'Edit user email',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('editUsers',	2,	'Edit users',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('Vendedor',	1,	'Vendedor',	NULL,	NULL,	1698496362,	1698496362,	NULL),
('Vendedores',	2,	'Vendedores',	NULL,	NULL,	1698496434,	1698496434,	NULL),
('viewRegistrationIp',	2,	'View registration IP',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('viewUserEmail',	2,	'View user email',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('viewUserRoles',	2,	'View user roles',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('viewUsers',	2,	'View users',	NULL,	NULL,	1426062189,	1426062189,	'userManagement'),
('viewVisitLog',	2,	'View visit log',	NULL,	NULL,	1426062189,	1426062189,	'userManagement');

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('Compradores',	'/carrito/*'),
('Vendedores',	'/carrito/historial'),
('Vendedores',	'/carrito/view'),
('Compradores',	'/producto/*'),
('Vendedores',	'/producto/*'),
('commonPermission',	'/site/*'),
('Compradores',	'/site/*'),
('Vendedores',	'/site/*'),
('changeOwnPassword',	'/user-management/auth/change-own-password'),
('assignRolesToUsers',	'/user-management/user-permission/set'),
('assignRolesToUsers',	'/user-management/user-permission/set-roles'),
('viewVisitLog',	'/user-management/user-visit-log/grid-page-size'),
('viewVisitLog',	'/user-management/user-visit-log/index'),
('viewVisitLog',	'/user-management/user-visit-log/view'),
('editUsers',	'/user-management/user/bulk-activate'),
('editUsers',	'/user-management/user/bulk-deactivate'),
('deleteUsers',	'/user-management/user/bulk-delete'),
('changeUserPassword',	'/user-management/user/change-password'),
('createUsers',	'/user-management/user/create'),
('deleteUsers',	'/user-management/user/delete'),
('viewUsers',	'/user-management/user/grid-page-size'),
('viewUsers',	'/user-management/user/index'),
('editUsers',	'/user-management/user/update'),
('viewUsers',	'/user-management/user/view'),
('Vendedores',	'/vendedor/*'),
('Admin',	'assignRolesToUsers'),
('Admin',	'bindUserToIp'),
('Admin',	'changeOwnPassword'),
('Admin',	'changeUserPassword'),
('Comprador',	'Compradores'),
('Admin',	'createUsers'),
('Admin',	'deleteUsers'),
('Admin',	'editUserEmail'),
('Admin',	'editUsers'),
('Vendedor',	'Vendedores'),
('Admin',	'viewRegistrationIp'),
('Admin',	'viewUserEmail'),
('editUserEmail',	'viewUserEmail'),
('assignRolesToUsers',	'viewUserRoles'),
('Admin',	'viewUsers'),
('assignRolesToUsers',	'viewUsers'),
('changeUserPassword',	'viewUsers'),
('createUsers',	'viewUsers'),
('deleteUsers',	'viewUsers'),
('editUsers',	'viewUsers'),
('Admin',	'viewVisitLog');

DROP TABLE IF EXISTS `auth_item_group`;
CREATE TABLE `auth_item_group` (
  `code` varchar(64) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `auth_item_group` (`code`, `name`, `created_at`, `updated_at`) VALUES
('userCommonPermissions',	'User common permission',	1426062189,	1426062189),
('userManagement',	'User management',	1426062189,	1426062189);

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `carrito`;
CREATE TABLE `carrito` (
  `id` int NOT NULL AUTO_INCREMENT,
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `estado` enum('ACTIVO','COMPRADO','CANCELADO','FINALIZADO') NOT NULL,
  `comprador_id` int NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_carrito_comprador1_idx` (`comprador_id`),
  CONSTRAINT `fk_carrito_comprador1` FOREIGN KEY (`comprador_id`) REFERENCES `comprador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `carrito` (`id`, `total`, `estado`, `comprador_id`, `updated_at`, `created_at`) VALUES
(33,	126132.00,	'ACTIVO',	6,	'2023-11-21 16:52:46',	'2023-11-21 16:52:46');

DROP TABLE IF EXISTS `carrito_item`;
CREATE TABLE `carrito_item` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cantidad` int NOT NULL,
  `precio_cantidad` decimal(10,2) NOT NULL,
  `producto_id` int NOT NULL,
  `carrito_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_carrito_item_producto1_idx` (`producto_id`),
  KEY `fk_carrito_item_carrito1_idx` (`carrito_id`),
  CONSTRAINT `fk_carrito_item_carrito1` FOREIGN KEY (`carrito_id`) REFERENCES `carrito` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_carrito_item_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `carrito_item` (`id`, `cantidad`, `precio_cantidad`, `producto_id`, `carrito_id`) VALUES
(47,	1,	4920.00,	1,	33),
(48,	1,	121212.00,	18,	33);

DROP TABLE IF EXISTS `categoria`;
CREATE TABLE `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(85) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categoria_UNIQUE` (`categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `categoria` (`id`, `categoria`) VALUES
(11,	'Alimentos y bebidas - Alimentos procesador'),
(12,	'Alimentos y bebidas - Bebidas alcohólicas'),
(13,	'Alimentos y bebidas - Bebidas no alcohólicas'),
(15,	'Alimentos y bebidas - Dulces y aperitivos'),
(14,	'Alimentos y bebidas - Productos frescos'),
(5,	'Electrónica - Accesorios electrónicos'),
(4,	'Electrónica - Cámaras'),
(2,	'Electrónica - Computadoras y laptops'),
(1,	'Electrónica - Teléfonos móviles'),
(3,	'Electrónica - Televisores'),
(18,	'Hogar y jardín - Decoración del hogar'),
(17,	'Hogar y jardín - Electrodomésticos'),
(20,	'Hogar y jardín - Herramientas'),
(19,	'Hogar y jardín - Jardinería'),
(16,	'Hogar y jardín - Muebles'),
(10,	'Ropa y moda - Accesorios de moda'),
(9,	'Ropa y moda - Calzado'),
(6,	'Ropa y moda - Ropa de Hombre'),
(7,	'Ropa y moda - Ropa de mujer'),
(8,	'Ropa y moda - Ropa de niños'),
(21,	'Salud y belleza - Cuidado de la piel'),
(24,	'Salud y belleza - Equipo médico'),
(22,	'Salud y belleza - Maquillaje'),
(25,	'Salud y belleza - Productos para el cuidado del cabello'),
(23,	'Salud y belleza - Suplementos nutricionales');

DROP TABLE IF EXISTS `comprador`;
CREATE TABLE `comprador` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(85) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `RFC` varchar(13) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `CURP` varchar(18) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `direccion_entrega_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comprador_direccion_entrega1_idx` (`direccion_entrega_id`),
  KEY `fk_comprador_user1_idx` (`user_id`),
  CONSTRAINT `fk_comprador_direccion_entrega1` FOREIGN KEY (`direccion_entrega_id`) REFERENCES `direccion_entrega` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_comprador_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `comprador` (`id`, `nombre`, `telefono`, `RFC`, `CURP`, `direccion_entrega_id`, `user_id`) VALUES
(4,	'Juanito',	'9988776654',	'PECA12ASD2',	'PCADA12ASDASD8',	13,	32),
(5,	'mercatox',	'1234543232',	'PECA12ASD2',	'PCADA12ASDASD8',	14,	33),
(6,	'meca',	'1234567890',	'PAASDQWE12A',	'ASD23DAS21ASD',	15,	35);

DROP TABLE IF EXISTS `direccion_entrega`;
CREATE TABLE `direccion_entrega` (
  `id` int NOT NULL AUTO_INCREMENT,
  `calle` varchar(125) NOT NULL,
  `codigo_postal` char(8) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `n_exterior` char(5) NOT NULL,
  `tipo_ubicacion` enum('CASA','OFICINA') NOT NULL,
  `telefono_contacto` varchar(15) NOT NULL,
  `indicaciones` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `direccion_entrega` (`id`, `calle`, `codigo_postal`, `direccion`, `n_exterior`, `tipo_ubicacion`, `telefono_contacto`, `indicaciones`) VALUES
(10,	'Calle',	'89099',	'Dirección',	'11',	'CASA',	'1212121212',	'Información extra'),
(11,	'Vendemax',	'123',	'Vendemax',	'123',	'OFICINA',	'123',	'Vendemax'),
(12,	'Vendemax',	'1212',	'Vendemax',	'1212',	'CASA',	'1212121212',	'Vendemax'),
(13,	'Calle calle',	'77890',	'Calle estado pais',	'11',	'CASA',	'1122348',	'Indicaciónes de localización'),
(14,	'Calle calle',	'77890',	'Calle estado pais',	'11',	'CASA',	'1122348',	'Información exta'),
(15,	'Calle calle calle',	'123123',	'Direccion direccion',	'123',	'OFICINA',	'1234567890',	'A123AD 23ASD ASD23');

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE `pedido` (
  `id` int NOT NULL,
  `estatus` int NOT NULL DEFAULT '1',
  `producto_id` int NOT NULL,
  `comprador_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pedido_producto1_idx` (`producto_id`),
  KEY `fk_pedido_comprador1_idx` (`comprador_id`),
  CONSTRAINT `fk_pedido_comprador1` FOREIGN KEY (`comprador_id`) REFERENCES `comprador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pedido_producto1` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `producto`;
CREATE TABLE `producto` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(85) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `estado` enum('NUEVO','USADO','RE ACONDICIONADO','SEMI NUEVO') NOT NULL DEFAULT 'NUEVO',
  `fotografia` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `estatus` enum('ACTIVO','PAUSADO','FINALIZADO','EN REVISION') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL DEFAULT 'PAUSADO',
  `producto_oferta` enum('SI','NO') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'NO',
  `producto_valor_oferta` decimal(10,2) DEFAULT '0.00',
  `precio_con_oferta` decimal(10,2) DEFAULT '0.00',
  `categoria_id` int NOT NULL,
  `vendedor_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_categoria1_idx` (`categoria_id`),
  KEY `fk_producto_vendedor1_idx` (`vendedor_id`),
  CONSTRAINT `fk_producto_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_producto_vendedor1` FOREIGN KEY (`vendedor_id`) REFERENCES `vendedor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `producto` (`id`, `nombre`, `descripcion`, `precio`, `stock`, `estado`, `fotografia`, `fecha_publicacion`, `estatus`, `producto_oferta`, `producto_valor_oferta`, `precio_con_oferta`, `categoria_id`, `vendedor_id`) VALUES
(1,	'Laptop Levono',	'Experimenta una nueva visión con la Laptop Huawei Matebook D15. Su pantalla IPS FullView de 15.6\" y relación de aspecto 16:9 amplían tus límites visuales, mientras que la resolución Full-HD 1920 x 1080 hace que cada imagen sea nítida y detallada.\r\n<br>\r\nDiseñada para cuidar tus ojos, la Matebook D15 cuenta con certificación libre de parpadeo y baja emisión de luz azul de TÜV Rheinland. Mantén tus ojos frescos y ligeros en todo momento.\r\n<br>\r\nCon un diseño ultra delgado de 16.9mm y un peso de solo 1.6 kg, esta laptop es fácil de llevar a cualquier lugar. Además, su procesador Intel Core i3-1115G4 de 11va generación hace que todo sea más rápido, para que puedas pasar menos tiempo esperando y más tiempo haciendo.\r\n<br>\r\nEl ventilador de aleta de tiburón ultra delgado de 0.2 mm mejora la disipación de calor, manteniendo las cosas más frescas y silenciosas.\r\n<br>\r\nÚnete a la revolución Wi-Fi 6 y disfruta de velocidades de red hasta 2.7 veces más rápidas que la generación anterior. ¡Carga y descarga archivos a una velocidad increíble de 2.4 Gbps! Muévete hacia un futuro de Internet más rápido ahora.\r\n<br>\r\nEl cargador USB-C de 65 W es ligero y compacto, perfecto para llevarlo contigo. Además, proporciona 2 horas de uso con una carga rápida de 15 minutos.\r\n<br>\r\nCon la función de colaboración con teléfono, puedes recibir llamadas en tu laptop a través de Huawei Share. Ideal para trabajar durante llamadas de negocios y videollamadas con amigos y familiares.\r\n',	8200.00,	4,	'NUEVO',	'storage/articles/1_29_10_2023_04_30_22.webp',	'2023-10-01',	'ACTIVO',	'SI',	40.00,	4920.00,	2,	14),
(2,	'Laptop Huawei',	'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.',	10000.00,	12,	'NUEVO',	'storage/articles/1_2_29_10_2023_05_06_31.webp',	'2023-10-01',	'ACTIVO',	'NO',	0.00,	NULL,	2,	14),
(10,	'Teclado',	'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.',	10000.00,	6,	'NUEVO',	'storage/articles/5_1_29_10_2023_05_14_37.webp',	'2023-10-02',	'ACTIVO',	'NO',	0.00,	NULL,	5,	15),
(11,	'Teclado',	'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.',	1000.00,	10,	'NUEVO',	'storage/articles/5_2_29_10_2023_05_14_49.webp',	'2023-10-01',	'ACTIVO',	'NO',	0.00,	NULL,	5,	15),
(12,	'Relog',	'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.',	1000.00,	19,	'NUEVO',	'storage/articles/3_1_29_10_2023_05_13_31_08_11_2023_05_53_32.webp',	'2023-10-22',	'ACTIVO',	'NO',	0.00,	NULL,	10,	15),
(15,	'PRUEBA',	'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.',	12.00,	12,	'NUEVO',	'storage/articles/1_2_29_10_2023_05_06_31_07_11_2023_03_27_43.webp',	'2023-11-12',	'ACTIVO',	'NO',	0.00,	NULL,	11,	14),
(16,	'PRUEBA',	'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.',	12.00,	12,	'USADO',	'storage/articles/Imagen de WhatsApp 2023-11-06 a las 21.29.13_486a5319_07_11_2023_03_29_49.jpg',	'2023-11-05',	'ACTIVO',	'NO',	0.00,	NULL,	11,	14),
(17,	'PRUEBA',	'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.',	12.00,	12,	'USADO',	'storage/articles/Imagen de WhatsApp 2023-11-06 a las 21.29.13_486a5319_07_11_2023_03_30_36.jpg',	'2023-11-05',	'ACTIVO',	'NO',	0.00,	NULL,	11,	14),
(18,	'Relog',	'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.',	121212.00,	15,	'NUEVO',	'storage/articles/3_2_29_10_2023_05_13_38_12_11_2023_11_10_47.webp',	'2023-11-12',	'ACTIVO',	'NO',	0.00,	NULL,	10,	15);

DROP TABLE IF EXISTS `producto_imagen`;
CREATE TABLE `producto_imagen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ruta_imagen` varchar(255) NOT NULL,
  `producto_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `'fk_producto_imagen_to_producto_id'_idx` (`producto_id`),
  CONSTRAINT `'fk_producto_imagen_to_producto_id'` FOREIGN KEY (`producto_id`) REFERENCES `producto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


DROP TABLE IF EXISTS `servicio`;
CREATE TABLE `servicio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `servicio` varchar(75) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `servicio_UNIQUE` (`servicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `servicio` (`id`, `servicio`) VALUES
(1,	'Belleza y cuidado personal'),
(2,	'Hogar'),
(3,	'Imprenta'),
(4,	'Mantenimiento vehiculos'),
(5,	'Recreación y turismo'),
(6,	'Reparación'),
(8,	'Tecnologia'),
(7,	'Transporte');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fotografia` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT 'null',
  `auth_key` varchar(32) NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `status` int DEFAULT '1',
  `email_confirmed` smallint DEFAULT '0',
  `superadmin` smallint DEFAULT '0',
  `bind_to_ip` varchar(255) DEFAULT NULL,
  `registration_ip` varchar(15) DEFAULT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `user` (`id`, `username`, `email`, `password`, `fotografia`, `auth_key`, `created_at`, `updated_at`, `status`, `email_confirmed`, `superadmin`, `bind_to_ip`, `registration_ip`, `confirmation_token`) VALUES
(1,	'superadmin',	'superadmin@gmail.com',	'$2y$13$MhlYe12xkGFnSeK0sO2up.Y9kAD9Ct6JS1i9VLP7YAqd1dFsSylz2',	'storage/profile/a_28_10_2023_10_11_59.png	',	'kz2px152FAWlkHbkZoCiXgBAd-S8SSjF',	1426062188,	1426062188,	1,	0,	1,	NULL,	NULL,	NULL),
(32,	'Juanito',	'comprador@gmail.com',	'$2y$13$ULeeICDSEY42D84he6VQD.iJw2ZJUVoMfXNaqm1P7Zs7QvYgxWmEK',	'storage/profile/a_28_10_2023_10_11_59_28_10_2023_10_14_20.png',	'5slrC2iMWzSt7DvhHUyyb88dHGa5oy2b',	1698531261,	1698531452,	1,	0,	0,	'',	'127.0.0.1',	NULL),
(33,	'mercatox',	'comprador2@gmail.com',	'$2y$13$xgLNmWaeRnSyQjsL0YWtretM2FdC7GkQ.Bqp0OugmtN9HKVgef.wG',	'storage/profile/a_28_10_2023_10_11_59_28_10_2023_10_17_05.png',	'ZZW3mRajl2vgV_uKd_ez_OlX-Kxpu-ej',	1698531425,	1698531425,	1,	0,	0,	'',	'127.0.0.1',	NULL),
(34,	'vendedor',	'vendedor@gmail.com',	'$2y$13$FYOVxqQgrA/4h.T6XP4JkOdzaUaA.57GL5HEhuEvVQODAKd4Fw/5i',	'storage/profile/a_28_10_2023_10_11_59_29_10_2023_12_39_40.png',	'xjhiN7_PR3Bj-SBrlCDFVFbW-kksrrsq',	1698539981,	1698539981,	1,	0,	0,	'',	'127.0.0.1',	NULL),
(35,	'meca',	'comprador3@gmail.com',	'$2y$13$JdR1e3akqDUpXbrJXYJs3.tgv8nc.tlqGUhhsomtc/yPFyBTfgjEO',	'storage/profile/a_28_10_2023_10_11_59_29_10_2023_05_08_31.png',	'N_ZNVy7qzUmVB1TQhDDtIqndAtLJuCj2',	1698556111,	1698556111,	1,	0,	0,	'',	'127.0.0.1',	NULL),
(36,	'ventas_mx',	'vendedor2@gmail.com',	'$2y$13$HCVVlRq9F0pbNGZRvIXifeFX3dhZE4UBlPxq8zcfw16ibTp.LfsYi',	'storage/profile/a_28_10_2023_10_11_59_29_10_2023_05_10_44.png',	'UwLlaLhV2q_hKC8EH8_lu_47_uXwVvnb',	1698556244,	1698556244,	1,	0,	0,	'',	'127.0.0.1',	NULL);

DROP TABLE IF EXISTS `user_visit_log`;
CREATE TABLE `user_visit_log` (
  `id` int NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `language` char(2) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `user_id` int DEFAULT NULL,
  `visit_time` int NOT NULL,
  `browser` varchar(30) DEFAULT NULL,
  `os` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_visit_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `user_visit_log` (`id`, `token`, `ip`, `language`, `user_agent`, `user_id`, `visit_time`, `browser`, `os`) VALUES
(5,	'653c9f20d0f5a',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	1,	1698471712,	'Chrome',	'Windows'),
(6,	'653c9f4cda401',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	1,	1698471756,	'Chrome',	'Windows'),
(7,	'653c9f6bed38b',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	1,	1698471787,	'Chrome',	'Windows'),
(8,	'653cc20e11c60',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	NULL,	1698480654,	'Chrome',	'Windows'),
(9,	'653cc22dc4cb9',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	1,	1698480685,	'Chrome',	'Windows'),
(10,	'653ce0f0f1edc',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	1,	1698488560,	'Chrome',	'Windows'),
(11,	'653ce1949c0ab',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.69',	NULL,	1698488724,	'Chrome',	'Windows'),
(12,	'653ce1f4ee69f',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.69',	NULL,	1698488820,	'Chrome',	'Windows'),
(13,	'653ce20e8e4e4',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.69',	NULL,	1698488846,	'Chrome',	'Windows'),
(14,	'653ce5e13e976',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	NULL,	1698489825,	'Chrome',	'Windows'),
(15,	'653ceb180026b',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	NULL,	1698491160,	'Chrome',	'Windows'),
(16,	'653ceb274852b',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	1,	1698491175,	'Chrome',	'Windows'),
(17,	'653cf5ef6a873',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.69',	NULL,	1698493935,	'Chrome',	'Windows'),
(18,	'653cffdfdc870',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.69',	NULL,	1698496479,	'Chrome',	'Windows'),
(19,	'653cffefd4a0f',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.69',	NULL,	1698496495,	'Chrome',	'Windows'),
(20,	'653d68dc61416',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	1,	1698523356,	'Chrome',	'Windows'),
(21,	'653d6e741634d',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.69',	NULL,	1698524788,	'Chrome',	'Windows'),
(22,	'653d7ef21cfd4',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	1,	1698529010,	'Chrome',	'Windows'),
(23,	'653d7fac3d7b9',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.69',	NULL,	1698529196,	'Chrome',	'Windows'),
(24,	'653d82f00a934',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.69',	NULL,	1698530032,	'Chrome',	'Windows'),
(25,	'653d83ca8d053',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	NULL,	1698530250,	'Chrome',	'Windows'),
(26,	'653d84db1e988',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	1,	1698530523,	'Chrome',	'Windows'),
(27,	'653d886f686b9',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.69',	33,	1698531439,	'Chrome',	'Windows'),
(28,	'653d9c9bd6b5a',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.69',	33,	1698536603,	'Chrome',	'Windows'),
(29,	'653d9caaa0675',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.69',	1,	1698536618,	'Chrome',	'Windows'),
(30,	'653da7dfda6ed',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	32,	1698539487,	'Chrome',	'Windows'),
(31,	'653da9d4c2228',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	34,	1698539988,	'Chrome',	'Windows'),
(32,	'653dadc141a4e',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.69',	1,	1698540993,	'Chrome',	'Windows'),
(33,	'653dae1c5db5a',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.69',	1,	1698541084,	'Chrome',	'Windows'),
(34,	'653dae898c474',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.69',	1,	1698541193,	'Chrome',	'Windows'),
(35,	'653dc49f9f2d1',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	1,	1698546847,	'Chrome',	'Windows'),
(36,	'653dc536df66f',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	34,	1698546998,	'Chrome',	'Windows'),
(37,	'653de8db1face',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	35,	1698556123,	'Chrome',	'Windows'),
(38,	'653de962d29a4',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	36,	1698556258,	'Chrome',	'Windows'),
(39,	'653dfa62c4264',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	34,	1698560610,	'Chrome',	'Windows'),
(40,	'654161a74fcf8',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	1,	1698783655,	'Chrome',	'Windows'),
(41,	'65419b45177ab',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	32,	1698798405,	'Chrome',	'Windows'),
(42,	'6541be66a887f',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.76',	35,	1698807398,	'Chrome',	'Windows'),
(43,	'6541bf0f78841',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.76',	35,	1698807567,	'Chrome',	'Windows'),
(44,	'6541c794eeca6',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.76',	33,	1698809748,	'Chrome',	'Windows'),
(45,	'6541ce5ed520f',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.76',	1,	1698811486,	'Chrome',	'Windows'),
(46,	'6541d47a1cf81',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.76',	35,	1698813050,	'Chrome',	'Windows'),
(47,	'6544510a84cc3',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	32,	1698976010,	'Chrome',	'Windows'),
(48,	'65445298d3abd',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36',	1,	1698976408,	'Chrome',	'Windows'),
(49,	'654460422cb9c',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.76',	35,	1698979906,	'Chrome',	'Windows'),
(50,	'65446057d457b',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.76',	34,	1698979927,	'Chrome',	'Windows'),
(51,	'65446158b7ac5',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36 Edg/118.0.2088.76',	34,	1698980184,	'Chrome',	'Windows'),
(52,	'65453363271ec',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	1,	1699033955,	'Chrome',	'Windows'),
(53,	'6549ae3237980',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	34,	1699327538,	'Chrome',	'Windows'),
(54,	'6549b6618b4ef',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	33,	1699329633,	'Chrome',	'Windows'),
(55,	'6549b66c835a3',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	33,	1699329644,	'Chrome',	'Windows'),
(56,	'6549b6775c499',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	33,	1699329655,	'Chrome',	'Windows'),
(57,	'6549b6868e94a',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	36,	1699329670,	'Chrome',	'Windows'),
(58,	'654b0aef4fe42',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	1,	1699416815,	'Chrome',	'Windows'),
(59,	'654b193d73679',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	36,	1699420477,	'Chrome',	'Windows'),
(60,	'654b278580a68',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	1,	1699424133,	'Chrome',	'Windows'),
(61,	'65511a0e74095',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	1,	1699813902,	'Chrome',	'Windows'),
(62,	'65511ba8abe87',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0',	1,	1699814312,	'Chrome',	'Windows'),
(63,	'65511bc699981',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	36,	1699814342,	'Chrome',	'Windows'),
(64,	'655170ee431e0',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0',	1,	1699836142,	'Chrome',	'Windows'),
(65,	'65517221a551d',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0',	32,	1699836449,	'Chrome',	'Windows'),
(66,	'6551725228edf',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0',	32,	1699836498,	'Chrome',	'Windows'),
(67,	'6551858a87ac6',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0',	32,	1699841418,	'Chrome',	'Windows'),
(68,	'65518a550979d',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0',	34,	1699842645,	'Chrome',	'Windows'),
(69,	'65518b4c89056',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	34,	1699842892,	'Chrome',	'Windows'),
(70,	'6551a90ceb976',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	32,	1699850508,	'Chrome',	'Windows'),
(71,	'6551aa9e4ecd6',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	34,	1699850910,	'Chrome',	'Windows'),
(72,	'655cdfd3b39b1',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36',	35,	1700585427,	'Chrome',	'Windows'),
(73,	'655eff606fd96',	'127.0.0.1',	'es',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36 Edg/119.0.0.0',	34,	1700724576,	'Chrome',	'Windows');

DROP TABLE IF EXISTS `vendedor`;
CREATE TABLE `vendedor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `RFC` varchar(13) NOT NULL,
  `direccion_envio` varchar(75) NOT NULL,
  `direccion_negocio` varchar(75) NOT NULL,
  `nombre_negocio` varchar(85) NOT NULL,
  `biografia_negocio` text NOT NULL,
  `telefono_negocio` varchar(15) NOT NULL,
  `correo_negocio` varchar(75) NOT NULL,
  `user_id` int NOT NULL,
  `servicio_id` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `correo_negocio_UNIQUE` (`correo_negocio`),
  KEY `fk_Vendedor_user1_idx` (`user_id`),
  KEY `fk_Vendedor_Servicios1_idx` (`servicio_id`),
  CONSTRAINT `fk_Vendedor_Servicios1` FOREIGN KEY (`servicio_id`) REFERENCES `servicio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_Vendedor_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `vendedor` (`id`, `RFC`, `direccion_envio`, `direccion_negocio`, `nombre_negocio`, `biografia_negocio`, `telefono_negocio`, `correo_negocio`, `user_id`, `servicio_id`) VALUES
(14,	'RFCAAAAA',	'Enviar a direccion',	'Enviar a negocio',	'Mercatox',	'Mercatox biografia',	'1234567890',	'mercatox@gmail.com',	34,	1),
(15,	'QW67T77SDF',	'7ASADWDJ8AWD',	'AD89H9823HDASDH',	'Ventas Mexico',	'5TGHIUAHSUDHAS',	'12312312307',	'ventas_mex@gmail.com',	36,	8);

-- 2023-12-07 07:27:11
