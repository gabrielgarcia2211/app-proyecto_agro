-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para agroindustrial
CREATE DATABASE IF NOT EXISTS `agroindustrial` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci */;
USE `agroindustrial`;

-- Volcando estructura para tabla agroindustrial.empresas
CREATE TABLE IF NOT EXISTS `empresas` (
  `nit` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ciudad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `convenio` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`nit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agroindustrial.empresas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;

-- Volcando estructura para tabla agroindustrial.empresa__estudiantes
CREATE TABLE IF NOT EXISTS `empresa__estudiantes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nitemprea` int(11) NOT NULL,
  `codigoestudiante` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `empresa__estudiantes_nitemprea_unique` (`nitemprea`),
  UNIQUE KEY `empresa__estudiantes_codigoestudiante_unique` (`codigoestudiante`),
  CONSTRAINT `empresa__estudiantes_codigoestudiante_foreign` FOREIGN KEY (`codigoestudiante`) REFERENCES `users` (`codigo`),
  CONSTRAINT `empresa__estudiantes_nitemprea_foreign` FOREIGN KEY (`nitemprea`) REFERENCES `empresas` (`nit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agroindustrial.empresa__estudiantes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `empresa__estudiantes` DISABLE KEYS */;
/*!40000 ALTER TABLE `empresa__estudiantes` ENABLE KEYS */;

-- Volcando estructura para tabla agroindustrial.estudiantes
CREATE TABLE IF NOT EXISTS `estudiantes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `documento` bigint(20) NOT NULL,
  `egresado` tinyint(4) DEFAULT NULL,
  `semestreCursado` int(11) NOT NULL,
  `materiasAprobadas` int(11) NOT NULL,
  `promedio` double NOT NULL,
  `fechaingreso` date NOT NULL,
  `fechaegreso` date DEFAULT NULL,
  `id_historial` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `estudiantes_documento_unique` (`documento`),
  CONSTRAINT `estudiantes_documento_foreign` FOREIGN KEY (`documento`) REFERENCES `users` (`documento`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agroindustrial.estudiantes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `estudiantes` DISABLE KEYS */;
/*!40000 ALTER TABLE `estudiantes` ENABLE KEYS */;

-- Volcando estructura para tabla agroindustrial.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agroindustrial.failed_jobs: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Volcando estructura para tabla agroindustrial.historials
CREATE TABLE IF NOT EXISTS `historials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idsaberpro` int(11) NOT NULL,
  `idsaber11` int(11) NOT NULL,
  `documento` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `historials_documento_foreign` (`documento`),
  KEY `historials_idsaber11_foreign` (`idsaber11`),
  KEY `historials_idsaberpro_foreign` (`idsaberpro`),
  CONSTRAINT `historials_documento_foreign` FOREIGN KEY (`documento`) REFERENCES `estudiantes` (`documento`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `historials_idsaber11_foreign` FOREIGN KEY (`idsaber11`) REFERENCES `saber11s` (`idsaber11`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `historials_idsaberpro_foreign` FOREIGN KEY (`idsaberpro`) REFERENCES `saber_pros` (`idsaberpro`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agroindustrial.historials: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `historials` DISABLE KEYS */;
/*!40000 ALTER TABLE `historials` ENABLE KEYS */;

-- Volcando estructura para tabla agroindustrial.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agroindustrial.jobs: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;

-- Volcando estructura para tabla agroindustrial.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agroindustrial.migrations: ~15 rows (aproximadamente)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2020_09_17_010723_create_rols_table', 1),
	(2, '2020_09_18_014940_create_personas_table', 1),
	(3, '2020_09_19_010723_create_users_table', 1),
	(4, '2020_09_20_000000_create_failed_jobs_table', 1),
	(5, '2020_09_20_013526_create_estudiantes_table', 1),
	(6, '2020_09_21_142622_create_saber11s_table', 1),
	(7, '2020_09_21_142750_create_saber_pros_table', 1),
	(8, '2020_09_22_015954_create_historials_table', 1),
	(9, '2020_09_25_171612_create_teses_table', 1),
	(10, '2020_09_25_173934_create_tesis__estudiantes_table', 1),
	(11, '2020_10_12_100000_create_password_resets_table', 1),
	(12, '2020_10_28_182350_create_jobs_table', 1),
	(13, '2020_10_30_115238_create_empresas_table', 1),
	(14, '2020_10_30_115848_create_empresa__estudiantes_table', 1),
	(15, '2020_10_30_120019_create_ofertas_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Volcando estructura para tabla agroindustrial.ofertas
CREATE TABLE IF NOT EXISTS `ofertas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `empleo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `jornada` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `salario` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `requerimientos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nitemprea` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ofertas_nitemprea_foreign` (`nitemprea`),
  CONSTRAINT `ofertas_nitemprea_foreign` FOREIGN KEY (`nitemprea`) REFERENCES `empresas` (`nit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agroindustrial.ofertas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `ofertas` DISABLE KEYS */;
/*!40000 ALTER TABLE `ofertas` ENABLE KEYS */;

-- Volcando estructura para tabla agroindustrial.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agroindustrial.password_resets: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Volcando estructura para tabla agroindustrial.personas
CREATE TABLE IF NOT EXISTS `personas` (
  `documento` bigint(20) NOT NULL,
  `nombres` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_documento` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`documento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agroindustrial.personas: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` (`documento`, `nombres`, `apellidos`, `celular`, `correo`, `telefono`, `tipo_documento`, `direccion`, `created_at`, `updated_at`) VALUES
	(1004804515, 'gabriel', 'garcia', '413145', 'garcia@garcia.com', '5644', 'CC', 'calle', '2020-10-31 16:44:18', '2020-10-31 16:44:19');
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;

-- Volcando estructura para tabla agroindustrial.rols
CREATE TABLE IF NOT EXISTS `rols` (
  `id` int(11) NOT NULL,
  `nombre_rol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agroindustrial.rols: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `rols` DISABLE KEYS */;
INSERT INTO `rols` (`id`, `nombre_rol`, `created_at`, `updated_at`) VALUES
	(1, 'a', '2020-10-31 16:43:35', '2020-10-31 16:43:35'),
	(2, 'es', '2020-10-31 16:43:41', '2020-10-31 16:43:42'),
	(3, 'em', '2020-10-31 16:43:47', '2020-10-31 16:43:48');
/*!40000 ALTER TABLE `rols` ENABLE KEYS */;

-- Volcando estructura para tabla agroindustrial.saber11s
CREATE TABLE IF NOT EXISTS `saber11s` (
  `idsaber11` int(11) NOT NULL,
  `lectura_critica` int(11) NOT NULL,
  `matematicas` int(11) NOT NULL,
  `sociales_ciudadanas` int(11) NOT NULL,
  `naturales` int(11) NOT NULL,
  `ingles` int(11) NOT NULL,
  PRIMARY KEY (`idsaber11`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agroindustrial.saber11s: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `saber11s` DISABLE KEYS */;
/*!40000 ALTER TABLE `saber11s` ENABLE KEYS */;

-- Volcando estructura para tabla agroindustrial.saber_pros
CREATE TABLE IF NOT EXISTS `saber_pros` (
  `idsaberpro` int(11) NOT NULL,
  `lectura_critica` int(11) NOT NULL,
  `razonamiento_cuantitativo` int(11) NOT NULL,
  `competencias_ciudadana` int(11) NOT NULL,
  `comunicacion_escrita` int(11) NOT NULL,
  `ingles` int(11) NOT NULL,
  PRIMARY KEY (`idsaberpro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agroindustrial.saber_pros: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `saber_pros` DISABLE KEYS */;
/*!40000 ALTER TABLE `saber_pros` ENABLE KEYS */;

-- Volcando estructura para tabla agroindustrial.teses
CREATE TABLE IF NOT EXISTS `teses` (
  `codigo` int(11) NOT NULL,
  `archivo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agroindustrial.teses: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `teses` DISABLE KEYS */;
/*!40000 ALTER TABLE `teses` ENABLE KEYS */;

-- Volcando estructura para tabla agroindustrial.tesis__estudiantes
CREATE TABLE IF NOT EXISTS `tesis__estudiantes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_tesis` int(11) NOT NULL,
  `codigoestudiante` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tesis__estudiantes_codigoestudiante_unique` (`codigoestudiante`),
  KEY `tesis__estudiantes_id_tesis_foreign` (`id_tesis`),
  CONSTRAINT `tesis__estudiantes_codigoestudiante_foreign` FOREIGN KEY (`codigoestudiante`) REFERENCES `users` (`codigo`),
  CONSTRAINT `tesis__estudiantes_id_tesis_foreign` FOREIGN KEY (`id_tesis`) REFERENCES `teses` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agroindustrial.tesis__estudiantes: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `tesis__estudiantes` DISABLE KEYS */;
/*!40000 ALTER TABLE `tesis__estudiantes` ENABLE KEYS */;

-- Volcando estructura para tabla agroindustrial.users
CREATE TABLE IF NOT EXISTS `users` (
  `codigo` int(11) NOT NULL,
  `documento` bigint(20) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_rol_foreign` (`rol`),
  KEY `users_documento_foreign` (`documento`),
  CONSTRAINT `users_documento_foreign` FOREIGN KEY (`documento`) REFERENCES `personas` (`documento`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_rol_foreign` FOREIGN KEY (`rol`) REFERENCES `rols` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla agroindustrial.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`codigo`, `documento`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `rol`) VALUES
	(1151654, 1004804515, 'gabrielarturogq@ufps.edu.co', '2020-10-31 16:44:38', '25d55ad283aa400af464c76d713c07ad ', NULL, '2020-10-31 16:44:43', '2020-10-31 16:44:44', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
