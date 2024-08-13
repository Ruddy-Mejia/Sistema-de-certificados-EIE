-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.0.30 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para sistema_educativo
CREATE DATABASE IF NOT EXISTS `sistema_educativo` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `sistema_educativo`;

-- Volcando estructura para tabla sistema_educativo.asignaciones
CREATE TABLE IF NOT EXISTS `asignaciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `curso_id` int NOT NULL,
  `sesion_id` int NOT NULL,
  `nombre_asignacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `archivo_asignacion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `Índice 1` (`id`),
  KEY `FK_asignaciones_usuario` (`usuario_id`),
  KEY `FK_asignaciones_curso` (`curso_id`),
  KEY `FK_asignaciones_sesion` (`sesion_id`),
  CONSTRAINT `FK_asignaciones_curso` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`),
  CONSTRAINT `FK_asignaciones_sesion` FOREIGN KEY (`sesion_id`) REFERENCES `sesion` (`id`),
  CONSTRAINT `FK_asignaciones_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sistema_educativo.asignaciones: ~0 rows (aproximadamente)

-- Volcando estructura para tabla sistema_educativo.certificado
CREATE TABLE IF NOT EXISTS `certificado` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `curso_id` int NOT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `codigo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `archivo` varchar(255) DEFAULT NULL,
  `boleto` varchar(255) DEFAULT NULL,
  `ci` varchar(255) DEFAULT NULL,
  `cert_nac` varchar(255) DEFAULT NULL,
  `retro` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `retro_direccion` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  `notas_subidas` tinyint(1) DEFAULT '0',
  `checklist` varchar(50) DEFAULT NULL,
  `fecha_emision` timestamp NULL DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `editor` int DEFAULT '4',
  UNIQUE KEY `Índice 4` (`codigo`),
  KEY `Índice 1` (`id`),
  KEY `FK_cetificado_usuario` (`usuario_id`),
  KEY `FK_certificado_curso` (`curso_id`),
  KEY `FK_certificado_usuario` (`editor`),
  CONSTRAINT `FK_certificado_curso` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`),
  CONSTRAINT `FK_certificado_usuario` FOREIGN KEY (`editor`) REFERENCES `usuario` (`id`),
  CONSTRAINT `FK_cetificado_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sistema_educativo.certificado: ~5 rows (aproximadamente)
INSERT INTO `certificado` (`id`, `usuario_id`, `curso_id`, `estado`, `codigo`, `created_at`, `updated_at`, `archivo`, `boleto`, `ci`, `cert_nac`, `retro`, `retro_direccion`, `notas_subidas`, `checklist`, `fecha_emision`, `foto`, `editor`) VALUES
	(66, 28, 1, 'finalizado', '31231414213123', '2024-08-11 20:03:09', '2024-08-12 20:49:58', 'certificado/TWFyY29z_SnVzdGluaWFubyBSaXZlcmE=NjY=.pdf', 'comprobantes/2024-08-12 16.03.09.pdf', 'carnet/2024-08-12 16.03.09.pdf', 'certificadoNacimiento/2024-08-12 16.03.09.pdf', NULL, NULL, 0, '1,1,1,1', '2024-08-12 20:49:52', 'foto/EnmHJV1xERzmBK5PUWNO4v9Wh6jB2XGWLwSE5DbR.jpg', 30);

-- Volcando estructura para tabla sistema_educativo.ciudades
CREATE TABLE IF NOT EXISTS `ciudades` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sistema_educativo.ciudades: ~9 rows (aproximadamente)
INSERT INTO `ciudades` (`id`, `nombre`) VALUES
	(1, 'Beni'),
	(2, 'Cochabamba'),
	(3, 'Chuquisaca'),
	(4, 'La Paz'),
	(5, 'Oruro'),
	(6, 'Pando'),
	(7, 'Potosí'),
	(8, 'Tarija'),
	(9, 'Santa Cruz');

-- Volcando estructura para tabla sistema_educativo.claves
CREATE TABLE IF NOT EXISTS `claves` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `clave` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_claves_usuario` (`usuario_id`),
  CONSTRAINT `FK_claves_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sistema_educativo.claves: ~4 rows (aproximadamente)
INSERT INTO `claves` (`id`, `usuario_id`, `clave`, `created_at`, `updated_at`) VALUES
	(1, 30, '$2y$10$6s8IMB71LLYJk8DwLE0F/.CwFMgZin2DVHIYSiZKbBpZiJ0gGJbnq', '2023-11-04 01:12:36', '2023-11-04 01:42:11'),
	(2, 25, '$2y$10$EC0EjiXDQgPOghQw18t/8uFKxMJ8oT9xlX3uK4pfA7rQGUyYheBgG', '2023-11-04 03:11:06', '2023-11-04 03:29:07'),
	(3, 26, '$2y$10$SDuLzGlEQ58iITFVsNIVmO0fatUjHiAKtVjc9FWqT2uncWcXkJCQu', '2023-11-04 03:35:30', '2023-11-04 03:35:51'),
	(4, 27, '$2y$10$gnvXW9gduuW7ukEOCudiSuwn3OKBzSwEQ0HeUnm3GTD/0qAPWU04C', '2023-11-04 03:37:02', '2023-11-04 03:37:39');

-- Volcando estructura para tabla sistema_educativo.curso
CREATE TABLE IF NOT EXISTS `curso` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_curso` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `metodo_estudio` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carga_horaria` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tipo_curso` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sesion_id` int NOT NULL,
  KEY `Índice 1` (`id`),
  KEY `FK_curso_sesion` (`sesion_id`),
  CONSTRAINT `FK_curso_sesion` FOREIGN KEY (`sesion_id`) REFERENCES `sesion` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sistema_educativo.curso: ~4 rows (aproximadamente)
INSERT INTO `curso` (`id`, `nombre_curso`, `metodo_estudio`, `carga_horaria`, `created_at`, `updated_at`, `tipo_curso`, `sesion_id`) VALUES
	(1, 'CURSO AVANZADO DEL IDIOMA INGLÉS', 'American Language Course (ALC)', '600', '2023-04-20 20:04:38', '2023-08-03 04:26:03', 'General', 1),
	(2, 'CURSO AVANZADO DEL IDIOMA CHINO', 'American Language Course (ALC)', '180', '2023-04-20 20:04:38', '2023-04-20 20:04:38', 'General', 1),
	(4, 'CURSO AVANZADO DEL IDIOMA FRANCÉS', 'American Language Course (ALC)', '180', '2023-08-02 19:13:27', '2023-08-02 19:13:27', 'General', 1),
	(5, 'CURSO AVANZADO DEL IDIOMA AYMARA', 'American Language Course (ALC)', '180', '2023-08-25 06:06:36', '2023-08-25 06:06:36', NULL, 1);

-- Volcando estructura para tabla sistema_educativo.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sistema_educativo.failed_jobs: ~0 rows (aproximadamente)

-- Volcando estructura para tabla sistema_educativo.firmas
CREATE TABLE IF NOT EXISTS `firmas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `archivo` varchar(255) DEFAULT NULL,
  `usuario_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `certificado_id` int NOT NULL,
  `hash` varchar(255) NOT NULL,
  KEY `Índice 1` (`id`),
  KEY `FK_firmas_usuario` (`usuario_id`),
  KEY `FK_firmas_certificado` (`certificado_id`),
  CONSTRAINT `FK_firmas_certificado` FOREIGN KEY (`certificado_id`) REFERENCES `certificado` (`id`),
  CONSTRAINT `FK_firmas_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sistema_educativo.firmas: ~6 rows (aproximadamente)
INSERT INTO `firmas` (`id`, `archivo`, `usuario_id`, `created_at`, `updated_at`, `certificado_id`, `hash`) VALUES
	(54, 'firmas/yv2u55XWzCW781LNUfd0k4NRBaVwJic1w205FUZN.png', 25, '2024-08-12 20:14:34', '2024-08-12 20:14:34', 66, '5d6c2deb6f7decce20f5d54ee4f17bca'),
	(55, 'firmas/FHA6KUM5iMsqMt4jVfooi9Vmtvri90gKAFOjC6fP.png', 27, '2024-08-12 20:14:58', '2024-08-12 20:14:58', 66, '3cc4077e2a6e39f8ad8470306f618d0b'),
	(56, 'firmas/0DXEbCBABwQpRU9Cg1kXnTlSVyPogtnsItYNisbg.png', 26, '2024-08-12 20:15:57', '2024-08-12 20:15:57', 66, '02999a50e879beb92e76350c71428030');

-- Volcando estructura para tabla sistema_educativo.historial_procesos
CREATE TABLE IF NOT EXISTS `historial_procesos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `certificado_id` int DEFAULT NULL,
  `descripcion` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_historial_procesos_certificado` (`certificado_id`),
  CONSTRAINT `FK_historial_procesos_certificado` FOREIGN KEY (`certificado_id`) REFERENCES `certificado` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sistema_educativo.historial_procesos: ~24 rows (aproximadamente)
INSERT INTO `historial_procesos` (`id`, `certificado_id`, `descripcion`, `created_at`, `updated_at`) VALUES
	(58, 66, 'Cambio de estado a direccion', '2024-08-12 20:05:41', '2024-08-12 20:05:41');

-- Volcando estructura para tabla sistema_educativo.inscripcion
CREATE TABLE IF NOT EXISTS `inscripcion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `curso_id` int NOT NULL,
  `usuario_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `boleta` varchar(255) DEFAULT NULL,
  `archivo` varchar(255) DEFAULT NULL,
  KEY `Índice 1` (`id`),
  KEY `FK_inscripcion_curso` (`curso_id`),
  KEY `FK_inscripcion_usuario` (`usuario_id`),
  CONSTRAINT `FK_inscripcion_curso` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`),
  CONSTRAINT `FK_inscripcion_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sistema_educativo.inscripcion: ~0 rows (aproximadamente)

-- Volcando estructura para tabla sistema_educativo.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sistema_educativo.migrations: ~26 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2021_08_14_063609_create_permission_tables', 1),
	(5, '2021_08_29_082638_create_school_sessions_table', 1),
	(6, '2021_08_29_082900_create_semesters_table', 1),
	(7, '2021_08_29_082956_create_school_classes_table', 1),
	(8, '2021_08_29_083021_create_sections_table', 1),
	(9, '2021_08_29_083216_create_courses_table', 1),
	(10, '2021_08_29_083346_create_academic_settings_table', 1),
	(11, '2021_08_29_083429_create_promotions_table', 1),
	(12, '2021_08_29_083504_create_exam_rules_table', 1),
	(13, '2021_08_29_083523_create_grade_rules_table', 1),
	(14, '2021_08_29_083603_create_marks_table', 1),
	(15, '2021_08_29_083628_create_exams_table', 1),
	(16, '2021_08_29_083730_create_student_parent_infos_table', 1),
	(17, '2021_08_29_083742_create_student_academic_infos_table', 1),
	(18, '2021_08_29_083934_create_attendances_table', 1),
	(19, '2021_08_29_084019_create_notices_table', 1),
	(20, '2021_08_29_084030_create_events_table', 1),
	(21, '2021_08_29_084041_create_syllabi_table', 1),
	(22, '2021_08_29_084056_create_routines_table', 1),
	(23, '2021_10_07_134023_create_assigned_teachers_table', 1),
	(24, '2021_10_09_061039_create_grading_systems_table', 1),
	(25, '2021_10_16_123559_create_final_marks_table', 1),
	(26, '2021_11_26_040801_create_assignments_table', 1);

-- Volcando estructura para tabla sistema_educativo.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sistema_educativo.model_has_permissions: ~15 rows (aproximadamente)
INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
	(63, 'App\\Models\\User', 1),
	(63, 'App\\Models\\User', 2),
	(63, 'App\\Models\\User', 3),
	(1, 'App\\Models\\User', 4),
	(2, 'App\\Models\\User', 4),
	(3, 'App\\Models\\User', 4),
	(51, 'App\\Models\\User', 4),
	(52, 'App\\Models\\User', 4),
	(53, 'App\\Models\\User', 4),
	(63, 'App\\Models\\User', 4),
	(64, 'App\\Models\\User', 4),
	(65, 'App\\Models\\User', 4),
	(66, 'App\\Models\\User', 4),
	(67, 'App\\Models\\User', 4),
	(68, 'App\\Models\\User', 4);

-- Volcando estructura para tabla sistema_educativo.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sistema_educativo.model_has_roles: ~43 rows (aproximadamente)
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(6, 'App\\Models\\User', 1),
	(6, 'App\\Models\\User', 2),
	(6, 'App\\Models\\User', 3),
	(1, 'App\\Models\\User', 4),
	(2, 'App\\Models\\User', 5),
	(2, 'App\\Models\\User', 6),
	(2, 'App\\Models\\User', 7),
	(2, 'App\\Models\\User', 8),
	(3, 'App\\Models\\User', 14),
	(7, 'App\\Models\\User', 15),
	(1, 'App\\Models\\User', 16),
	(3, 'App\\Models\\User', 17),
	(6, 'App\\Models\\User', 19),
	(6, 'App\\Models\\User', 20),
	(2, 'App\\Models\\User', 21),
	(2, 'App\\Models\\User', 22),
	(1, 'App\\Models\\User', 23),
	(1, 'App\\Models\\User', 24),
	(6, 'App\\Models\\User', 25),
	(6, 'App\\Models\\User', 26),
	(6, 'App\\Models\\User', 27),
	(2, 'App\\Models\\User', 28),
	(2, 'App\\Models\\User', 29),
	(3, 'App\\Models\\User', 30),
	(2, 'App\\Models\\User', 31),
	(2, 'App\\Models\\User', 32),
	(9, 'App\\Models\\User', 33),
	(12, 'App\\Models\\User', 34),
	(2, 'App\\Models\\User', 35),
	(2, 'App\\Models\\User', 36),
	(1, 'App\\Models\\User', 37),
	(2, 'App\\Models\\User', 38),
	(1, 'App\\Models\\User', 39),
	(2, 'App\\Models\\User', 40),
	(2, 'App\\Models\\User', 41),
	(3, 'App\\Models\\User', 42),
	(1, 'App\\Models\\User', 43),
	(1, 'App\\Models\\User', 46),
	(1, 'App\\Models\\User', 47),
	(1, 'App\\Models\\User', 48),
	(1, 'App\\Models\\User', 49),
	(1, 'App\\Models\\User', 50),
	(2, 'App\\Models\\User', 51);

-- Volcando estructura para tabla sistema_educativo.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sistema_educativo.password_resets: ~0 rows (aproximadamente)

-- Volcando estructura para tabla sistema_educativo.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sistema_educativo.permissions: ~13 rows (aproximadamente)
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'crear usuario', 'web', '2023-02-20 00:18:59', '2023-02-20 00:18:59'),
	(2, 'ver usuario', 'web', '2023-02-20 00:18:59', '2023-02-20 00:18:59'),
	(3, 'editar usuario', 'web', '2023-02-20 00:18:59', '2023-02-20 00:18:59'),
	(51, 'crear curso', 'web', '2023-02-20 00:19:02', '2023-02-20 00:19:02'),
	(52, 'ver curso', 'web', '2023-02-20 00:19:02', '2023-02-20 00:19:02'),
	(53, 'editar curso', 'web', '2023-02-20 00:19:02', '2023-02-20 00:19:02'),
	(63, 'crear firma', 'web', '2023-08-24 18:27:18', '2023-08-24 18:27:18'),
	(64, 'ver informe y reportes', 'web', '2023-08-25 00:07:31', '2023-08-25 00:07:31'),
	(65, 'ver tramites', 'web', '2023-08-25 01:49:23', '2023-08-25 01:49:24'),
	(66, 'ver certificados', 'web', '2023-09-05 16:48:38', '2023-09-05 16:48:42'),
	(67, 'ver inscripciones', 'web', '2023-09-05 16:48:38', '2023-09-05 16:48:42'),
	(68, 'ver roles', 'web', '2023-09-05 16:48:38', '2023-09-05 16:48:42'),
	(70, 'ver pre inscripciones', 'web', '2023-09-05 16:48:38', '2023-09-05 16:48:42');

-- Volcando estructura para tabla sistema_educativo.persona
CREATE TABLE IF NOT EXISTS `persona` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `telefono` int DEFAULT NULL,
  `estado` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ciudad` int DEFAULT NULL,
  KEY `Índice 1` (`id`),
  KEY `FK_persona_ciudades` (`ciudad`),
  CONSTRAINT `FK_persona_ciudades` FOREIGN KEY (`ciudad`) REFERENCES `ciudades` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sistema_educativo.persona: ~13 rows (aproximadamente)
INSERT INTO `persona` (`id`, `nombre`, `apellidos`, `direccion`, `genero`, `telefono`, `estado`, `created_at`, `updated_at`, `ciudad`) VALUES
	(7, 'Super', 'admin', 'esmeralda sud', 'masculino', 67470820, 1, '2023-08-24 13:43:11', '2023-08-24 13:43:11', 9),
	(29, 'Cnl. Roger', 'Huanca Perez', 'Av. Saavedra', 'masculino', 72342367, NULL, '2023-09-21 02:39:54', '2023-09-21 02:39:54', 2),
	(30, 'Cnl. Carlos', 'Medrano Rojas', 'Av. Saavedra', 'masculino', 723425, NULL, '2023-09-21 02:47:59', '2023-09-21 02:47:59', 1),
	(31, 'Cnl. Luis', 'Perez Figueroa', 'Av. Saavedra', 'masculino', 72344523, NULL, '2023-09-21 02:49:38', '2023-09-21 02:49:38', 3),
	(32, 'Marcos', 'Justiniano Rivera', 'Av. Saavedra', 'masculino', 73452346, 0, '2023-09-21 02:52:34', '2023-09-22 21:52:40', 4),
	(33, 'Diana', 'Ledezma Sanchez', 'Av. Saavedra', 'femenino', 742353456, NULL, '2023-09-21 02:53:46', '2023-09-21 02:53:46', 4),
	(34, 'Carmen', 'Gutierrez Peredo', 'Av. Saavedra', 'femenino', 7345345, NULL, '2023-09-21 02:54:47', '2023-09-21 02:54:47', 5),
	(35, 'Samuel', 'Lozano', 'Av. Saavedra', 'masculino', 74324532, NULL, '2023-10-10 03:05:55', '2023-10-10 03:05:55', 6),
	(36, 'Lisbeth', 'Jurado Lozano', 'Av. Saavedra', 'femenino', 7234234, NULL, '2023-10-10 03:24:05', '2023-10-10 03:24:05', 7),
	(39, 'Jorge', 'Perez', 'Av. Saavedra', 'masculino', 7612227, NULL, '2023-10-20 20:30:34', '2023-10-20 20:30:34', 9),
	(40, 'Edwin', 'Mier Cornejo', 'Mi casa', 'masculino', 67197816, NULL, '2023-10-21 03:22:01', '2023-10-21 03:22:01', 6),
	(57, 'Ruddy', 'Mejia', 'Av. 6 de Marzo #123', 'masculino', 77842170, NULL, '2023-11-07 03:15:17', '2023-11-07 03:15:17', 4),
	(58, 'Ruddy', 'Mejia Mamani', 'Av. Santa Fe #123', 'masculino', 783454376, NULL, '2023-11-07 03:24:38', '2023-11-07 03:24:38', 1);

-- Volcando estructura para tabla sistema_educativo.pre_inscripciones
CREATE TABLE IF NOT EXISTS `pre_inscripciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha_nacimiento` date DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellidos` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `estado_civil` varchar(50) DEFAULT NULL,
  `curso_id` int DEFAULT NULL,
  `ci` int DEFAULT NULL,
  `ciudad` varchar(50) DEFAULT NULL,
  `telefono` int(8) unsigned zerofill DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `Índice 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla sistema_educativo.pre_inscripciones: ~0 rows (aproximadamente)
INSERT INTO `pre_inscripciones` (`id`, `fecha_nacimiento`, `nombre`, `apellidos`, `email`, `direccion`, `estado_civil`, `curso_id`, `ci`, `ciudad`, `telefono`, `created_at`, `updated_at`) VALUES
	(3, '1982-11-09', 'Jorge', 'Mercado Perez', 'jorge@gmail.com', 'Av. Saavedra', 'casado', 1, 12462346, 'La Paz', 72344523, '2023-09-21 19:56:39', '2023-09-21 19:56:39');

-- Volcando estructura para tabla sistema_educativo.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sistema_educativo.roles: ~7 rows (aproximadamente)
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', 'administrador', '2023-08-23 19:52:04', '2023-08-23 19:52:05'),
	(2, 'Estudiante', 'estudiante', '2023-08-23 19:52:26', '2023-08-23 19:52:26'),
	(3, 'Secretaria', 'secretaria', '2023-08-23 19:52:41', '2023-08-23 19:52:42'),
	(6, 'Firmador', 'firmador', '2023-09-06 18:16:15', '2023-09-06 18:16:15'),
	(7, 'administrador de usuarios', 'adm', '2023-09-10 00:45:45', '2023-09-10 00:45:45'),
	(9, 'editor de usuarios', 'web', '2023-10-10 03:40:35', '2023-10-10 03:40:35'),
	(12, 'Administrador de usuarios', 'web', '2023-10-20 20:29:41', '2023-10-20 20:29:41');

-- Volcando estructura para tabla sistema_educativo.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sistema_educativo.role_has_permissions: ~27 rows (aproximadamente)
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(3, 1),
	(51, 1),
	(52, 1),
	(53, 1),
	(64, 1),
	(65, 1),
	(66, 1),
	(67, 1),
	(68, 1),
	(70, 1),
	(1, 3),
	(2, 3),
	(52, 3),
	(64, 3),
	(65, 3),
	(66, 3),
	(70, 3),
	(63, 6),
	(65, 6),
	(1, 7),
	(2, 7),
	(3, 7),
	(3, 9),
	(1, 12),
	(2, 12),
	(3, 12);

-- Volcando estructura para tabla sistema_educativo.sesion
CREATE TABLE IF NOT EXISTS `sesion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_sesion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `Índice 1` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sistema_educativo.sesion: ~0 rows (aproximadamente)
INSERT INTO `sesion` (`id`, `nombre_sesion`, `created_at`, `updated_at`) VALUES
	(1, '2023', '2023-04-20 19:54:25', '2023-04-20 19:54:25');

-- Volcando estructura para tabla sistema_educativo.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `persona_id` int NOT NULL,
  `rol` bigint unsigned NOT NULL DEFAULT '0',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` tinyint NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `Índice 2` (`id`),
  KEY `FK_usuario_roles` (`rol`),
  KEY `FK_usuario_persona` (`persona_id`),
  CONSTRAINT `FK_usuario_persona` FOREIGN KEY (`persona_id`) REFERENCES `persona` (`id`),
  CONSTRAINT `FK_usuario_roles` FOREIGN KEY (`rol`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Volcando datos para la tabla sistema_educativo.usuario: ~13 rows (aproximadamente)
INSERT INTO `usuario` (`id`, `mail`, `email`, `persona_id`, `rol`, `password`, `created_at`, `updated_at`, `estado`, `email_verified_at`, `remember_token`) VALUES
	(4, NULL, '1010', 7, 1, '$2y$10$0NjeD/L1p2JT7cQ2CTnRHOuNOXyBYpiAKaozOSVHxyvyO1vr3lh0q', '2023-04-20 20:09:54', '2024-08-12 19:58:45', 1, NULL, 'ZuAPKq1WHY14sIH6QrFxbAmLgrvdeAolN1chhOM7BcnXeLW0ZsLG9VHKRRfV'),
	(31, NULL, '102030', 35, 2, '$2y$10$K9V7xuiATybODW/bvOpAb.jGUK5pRwxtadzYyI6tkXFphAJvmLqze', '2023-10-10 03:05:55', '2023-10-10 03:05:55', 0, NULL, NULL),
	(32, NULL, '10203040', 36, 2, '$2y$10$KG2w2inGt62z.ujRCATLO.JhfHGTEAg3LTKimBDy2hHx7bZVEYiue', '2023-10-10 03:24:05', '2023-10-10 03:24:05', 0, NULL, NULL),
	(25, 'ruddymejiamamani73@gmail.com', '1234', 29, 6, '$2y$10$VIsN4MBaLalmKBntRQqYkedgvsRvSLkMDqNkuFxv4TNF35/RLBQcy', '2023-09-21 02:39:54', '2023-09-21 02:39:54', 0, NULL, NULL),
	(29, NULL, '12348', 33, 2, '$2y$10$.ZngERYvIpFv.szL/rbVSOftpMtOJOItWUOI2uR9s0zc5Z/2Y5NOW', '2023-09-21 02:53:46', '2023-09-21 02:53:46', 0, NULL, NULL),
	(34, NULL, '1234845', 39, 12, '$2y$10$ruXjXb3sqU8iMU6L1el7buqzYyRuwY1BfTlueqxnrCN5Z0XBwspz2', '2023-10-20 20:30:34', '2023-10-20 20:30:34', 0, NULL, NULL),
	(30, NULL, '12349', 34, 3, '$2y$10$O/yn4h/b4/VNKTYy9TCe1ecZJbM.cTYNsqZ8gEpOw/1PnQ40s.O.K', '2023-09-21 02:54:47', '2023-09-21 02:54:47', 0, NULL, NULL),
	(26, 'jokergameplay666@gmail.com', '1235', 30, 6, '$2y$10$aI0ovQJGkUST7pj0Tf6BEe36whlcc2lirfWgDy.b1AIByKpt6bTnm', '2023-09-21 02:47:59', '2023-09-21 02:47:59', 0, NULL, NULL),
	(27, 'norussian.st6@gmail.com', '1236', 31, 6, '$2y$10$KmkuFgmK2STseIDak7rNm.WykdptO8sljbpLdiQEOvzDWjiL9lUqu', '2023-09-21 02:49:38', '2023-09-21 02:49:38', 0, NULL, NULL),
	(51, 'ruddymejiamamani73@gmail.com', '12545123', 58, 2, '$2y$10$a2MGuDZzrrbqjbJ8PRAx6u5t.VsO8i9F2qjAta26yoMFB8MFLkAAm', '2023-11-07 03:24:39', '2023-11-07 03:24:39', 0, NULL, NULL),
	(50, 'ruddymejiamamani73@gmail.com', '12592228', 57, 1, '$2y$10$HH/xFOaqy.Jovgmp/9DNPOgQP/2qWSoY99B4dDJNyZbbSeELEy8xu', '2023-11-07 03:15:17', '2023-11-07 03:15:17', 0, NULL, NULL),
	(35, NULL, '3326347', 40, 2, '$2y$10$tSoYaEcfLi/UjiHICOiQNu5zIixGfZVJzO.NZG6P9kNtGv9SdVFb2', '2023-10-21 03:22:01', '2023-10-21 03:22:01', 0, NULL, NULL),
	(28, NULL, '87654', 32, 2, '$2y$10$FKsKGvit8xY9miVt/NJHXeGWM7HrgjR3dUHN.MFCHmdWsBIrVzJ3u', '2023-09-21 02:52:34', '2023-09-22 21:52:40', 0, NULL, NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
