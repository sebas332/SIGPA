-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-06-2026 a las 22:30:38
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_proyecto_final`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_validar_sesiones_competencia` (IN `p_id_competencia` INT)   BEGIN
    DECLARE v_total_sesiones INT;
    DECLARE v_suma_sesiones INT;

    SELECT total_sesiones
    INTO v_total_sesiones
    FROM Competencias
    WHERE id_competencia = p_id_competencia;

    SELECT COALESCE(SUM(sesiones_asignadas), 0)
    INTO v_suma_sesiones
    FROM Resultado_Aprendizaje
    WHERE id_competencia = p_id_competencia;

    IF v_suma_sesiones <> v_total_sesiones THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La suma final de sesiones asignadas debe ser igual al total de sesiones de la competencia.';
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambientes`
--

CREATE TABLE `ambientes` (
  `id_numero_ambiente` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `capacidad` int(11) DEFAULT NULL,
  `aire` tinyint(1) DEFAULT NULL,
  `ventilador` tinyint(1) DEFAULT NULL,
  `tablero` tinyint(1) DEFAULT NULL,
  `tv` tinyint(1) DEFAULT NULL,
  `computadores` int(11) DEFAULT NULL,
  `especialidad_ambiente` varchar(100) DEFAULT NULL,
  `disponibilidad` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ambientes`
--

INSERT INTO `ambientes` (`id_numero_ambiente`, `nombre`, `tipo`, `capacidad`, `aire`, `ventilador`, `tablero`, `tv`, `computadores`, `especialidad_ambiente`, `disponibilidad`) VALUES
(1, 'Laboratorio de Software 1', 'Presencial', 35, 1, 0, 1, 1, 35, 'Desarrollo de Software', 1),
(2, 'Auditorio SST', 'Presencial', 50, 1, 1, 1, 1, 0, 'Salud Ocupacional', 1),
(3, 'Sala de Redes y Mantenimiento', 'Presencial', 25, 0, 1, 1, 0, 25, 'Hardware', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id_asistencia` int(11) NOT NULL,
  `id_programacion` int(11) NOT NULL,
  `id_usuario_aprendiz` int(11) NOT NULL,
  `fecha_asistencia` date DEFAULT NULL,
  `asistio` tinyint(1) DEFAULT NULL,
  `observacion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id_asistencia`, `id_programacion`, `id_usuario_aprendiz`, `fecha_asistencia`, `asistio`, `observacion`) VALUES
(1, 1, 2, '2026-06-22', 1, 'Asistió puntualmente a la clase de Java'),
(2, 1, 3, '2026-06-22', 1, 'Llegó 10 min tarde pero asistió'),
(3, 1, 4, '2026-06-22', 0, 'Excusa médica enviada al correo del instructor');

--
-- Disparadores `asistencia`
--
DELIMITER $$
CREATE TRIGGER `trg_asistencia_ai` AFTER INSERT ON `asistencia` FOR EACH ROW BEGIN
    DECLARE v_cantidad_fecha INT;

    SELECT COUNT(*)
    INTO v_cantidad_fecha
    FROM Asistencia
    WHERE id_programacion = NEW.id_programacion
      AND fecha_asistencia = NEW.fecha_asistencia;

    IF v_cantidad_fecha = 1 THEN
        UPDATE Programacion_Academica
        SET sesiones_realizadas = sesiones_realizadas + 1
        WHERE id_programacion = NEW.id_programacion
          AND sesiones_realizadas < total_sesiones;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_asistencia_bi` BEFORE INSERT ON `asistencia` FOR EACH ROW BEGIN
    DECLARE v_total_sesiones INT;
    DECLARE v_sesiones_realizadas INT;
    DECLARE v_ya_existe_fecha INT;

    IF NEW.fecha_asistencia IS NULL THEN
        SET NEW.fecha_asistencia = CURRENT_DATE();
    END IF;

    SELECT total_sesiones, sesiones_realizadas
    INTO v_total_sesiones, v_sesiones_realizadas
    FROM Programacion_Academica
    WHERE id_programacion = NEW.id_programacion
    FOR UPDATE;

    SELECT COUNT(*)
    INTO v_ya_existe_fecha
    FROM Asistencia
    WHERE id_programacion = NEW.id_programacion
      AND fecha_asistencia = NEW.fecha_asistencia;

    IF v_ya_existe_fecha = 0 AND v_sesiones_realizadas >= v_total_sesiones THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Ya se completaron todas las sesiones de esta programación.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencias`
--

CREATE TABLE `competencias` (
  `id_competencia` int(11) NOT NULL,
  `id_programa` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `horas_totales` int(11) DEFAULT NULL,
  `resultados_totales` int(11) DEFAULT NULL,
  `porcentaje` decimal(5,2) DEFAULT NULL,
  `horas_a_ejecutar` int(11) DEFAULT NULL,
  `total_sesiones` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `competencias`
--

INSERT INTO `competencias` (`id_competencia`, `id_programa`, `nombre`, `codigo`, `horas_totales`, `resultados_totales`, `porcentaje`, `horas_a_ejecutar`, `total_sesiones`) VALUES
(1, 1, 'Construir el sistema que cumpla los requisitos (PHP, Java, MySQL)', '220501096', 180, 3, 100.00, 180, 30),
(2, 2, 'Controlar los riesgos biológicos y laborales', '230101507', 120, 2, 100.00, 120, 20),
(3, 1, 'Estructurar el modelo de base de datos', '220501095', 60, 1, 100.00, 60, 10);

--
-- Disparadores `competencias`
--
DELIMITER $$
CREATE TRIGGER `trg_competencias_bi` BEFORE INSERT ON `competencias` FOR EACH ROW BEGIN
    IF NEW.horas_totales IS NULL OR NEW.horas_totales <= 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Las horas totales deben ser mayores a 0.';
    END IF;

    IF NEW.porcentaje IS NULL OR NEW.porcentaje <= 0 OR NEW.porcentaje > 100 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El porcentaje debe estar entre 1 y 100.';
    END IF;

    IF NEW.resultados_totales IS NULL OR NEW.resultados_totales <= 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Los resultados totales deben ser mayores a 0.';
    END IF;

    SET NEW.horas_a_ejecutar = CEIL((NEW.horas_totales * NEW.porcentaje) / 100);
    SET NEW.total_sesiones = CEIL(NEW.horas_a_ejecutar / 6);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_competencias_bu` BEFORE UPDATE ON `competencias` FOR EACH ROW BEGIN
    DECLARE v_resultados_creados INT;

    IF NEW.horas_totales IS NULL OR NEW.horas_totales <= 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Las horas totales deben ser mayores a 0.';
    END IF;

    IF NEW.porcentaje IS NULL OR NEW.porcentaje <= 0 OR NEW.porcentaje > 100 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El porcentaje debe estar entre 1 y 100.';
    END IF;

    IF NEW.resultados_totales IS NULL OR NEW.resultados_totales <= 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Los resultados totales deben ser mayores a 0.';
    END IF;

    SELECT COUNT(*)
    INTO v_resultados_creados
    FROM Resultado_Aprendizaje
    WHERE id_competencia = NEW.id_competencia;

    IF NEW.resultados_totales < v_resultados_creados THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No puede reducir resultados_totales por debajo de los resultados ya creados.';
    END IF;

    SET NEW.horas_a_ejecutar = CEIL((NEW.horas_totales * NEW.porcentaje) / 100);
    SET NEW.total_sesiones = CEIL(NEW.horas_a_ejecutar / 6);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dias`
--

CREATE TABLE `dias` (
  `id_dias` int(11) NOT NULL,
  `nombre_dia` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dias`
--

INSERT INTO `dias` (`id_dias`, `nombre_dia`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miércoles'),
(4, 'Jueves'),
(5, 'Viernes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichas`
--

CREATE TABLE `fichas` (
  `numero_ficha` int(11) NOT NULL,
  `cantidad_estudiantes` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_practicas` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `id_usuario_instructor_lider` int(11) NOT NULL,
  `id_programa` int(11) NOT NULL,
  `id_jornada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fichas`
--

INSERT INTO `fichas` (`numero_ficha`, `cantidad_estudiantes`, `fecha_inicio`, `fecha_practicas`, `fecha_fin`, `id_usuario_instructor_lider`, `id_programa`, `id_jornada`) VALUES
(2670000, 30, '2025-02-15', '2026-08-01', '2027-02-15', 1, 1, 1),
(2670001, 25, '2025-03-01', '2026-09-01', '2027-03-15', 6, 2, 2),
(2670002, 35, '2025-04-01', '2026-10-01', '2027-04-15', 1, 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha_aprendiz`
--

CREATE TABLE `ficha_aprendiz` (
  `id_ficha_aprendiz` int(11) NOT NULL,
  `id_usuario_aprendiz` int(11) NOT NULL,
  `numero_ficha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ficha_aprendiz`
--

INSERT INTO `ficha_aprendiz` (`id_ficha_aprendiz`, `id_usuario_aprendiz`, `numero_ficha`) VALUES
(1, 2, 2670000),
(2, 3, 2670000),
(3, 4, 2670000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `foto_ambiente`
--

CREATE TABLE `foto_ambiente` (
  `id_foto_ambiente` int(11) NOT NULL,
  `id_numero_ambiente` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `fecha_recarga` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `foto_ambiente`
--

INSERT INTO `foto_ambiente` (`id_foto_ambiente`, `id_numero_ambiente`, `url`, `fecha_recarga`) VALUES
(1, 1, 'https://storage.sena.edu.co/ambientes/lab_soft1.jpg', '2026-01-15'),
(2, 2, 'https://storage.sena.edu.co/ambientes/auditorio_sst.jpg', '2026-01-20'),
(3, 3, 'https://storage.sena.edu.co/ambientes/sala_redes.jpg', '2026-02-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada`
--

CREATE TABLE `jornada` (
  `id_jornada` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `jornada`
--

INSERT INTO `jornada` (`id_jornada`, `nombre`, `hora_inicio`, `hora_fin`) VALUES
(1, 'Mañana', '06:00:00', '12:00:00'),
(2, 'Tarde', '12:00:00', '18:00:00'),
(3, 'Nocturna', '18:00:00', '22:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedad_ambiente`
--

CREATE TABLE `novedad_ambiente` (
  `id_novedad` int(11) NOT NULL,
  `id_numero_ambiente` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_reporte` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `novedad_ambiente`
--

INSERT INTO `novedad_ambiente` (`id_novedad`, `id_numero_ambiente`, `id_usuario`, `descripcion`, `fecha_reporte`) VALUES
(1, 1, 1, 'Fallo en el equipo 12, no arranca el entorno de MySQL.', '2026-05-15'),
(2, 2, 6, 'Aire acondicionado emitiendo ruido extraño durante la exposición.', '2026-06-10'),
(3, 3, 1, 'Falta cableado de red en las mesas del fondo.', '2026-06-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `id_programa` int(11) NOT NULL,
  `nombre` varchar(150) DEFAULT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `version` varchar(50) DEFAULT NULL,
  `vigencia` varchar(50) DEFAULT NULL,
  `duracion_lectiva` int(11) DEFAULT NULL,
  `duracion_practica` int(11) DEFAULT NULL,
  `id_tipo_programa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`id_programa`, `nombre`, `codigo`, `version`, `vigencia`, `duracion_lectiva`, `duracion_practica`, `id_tipo_programa`) VALUES
(1, 'Análisis y Desarrollo de Software', '228118', 'V1', '2026', 3120, 864, 1),
(2, 'Seguridad y Salud en el Trabajo', '122112', 'V2', '2026', 2200, 864, 1),
(3, 'Programación de Software', '228185', 'V1', '2026', 1200, 432, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programacion_academica`
--

CREATE TABLE `programacion_academica` (
  `id_programacion` int(11) NOT NULL,
  `numero_ficha` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_numero_ambiente` int(11) NOT NULL,
  `id_dias` int(11) NOT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `id_resultado_aprendizaje` int(11) NOT NULL,
  `total_sesiones` int(11) DEFAULT NULL,
  `sesiones_realizadas` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programacion_academica`
--

INSERT INTO `programacion_academica` (`id_programacion`, `numero_ficha`, `id_usuario`, `id_numero_ambiente`, `id_dias`, `hora_inicio`, `hora_fin`, `id_resultado_aprendizaje`, `total_sesiones`, `sesiones_realizadas`, `fecha_inicio`) VALUES
(1, 2670000, 1, 1, 1, '06:00:00', '12:00:00', 1, 10, 1, '2026-06-22'),
(2, 2670000, 1, 1, 3, '06:00:00', '12:00:00', 2, 10, 0, '2026-06-24'),
(3, 2670001, 6, 2, 2, '12:00:00', '18:00:00', 4, 20, 0, '2026-06-23');

--
-- Disparadores `programacion_academica`
--
DELIMITER $$
CREATE TRIGGER `trg_programacion_bi` BEFORE INSERT ON `programacion_academica` FOR EACH ROW BEGIN
    DECLARE v_sesiones_asignadas INT;

    SELECT sesiones_asignadas
    INTO v_sesiones_asignadas
    FROM Resultado_Aprendizaje
    WHERE id_resultado = NEW.id_resultado_aprendizaje;

    IF v_sesiones_asignadas IS NULL OR v_sesiones_asignadas <= 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El resultado de aprendizaje no tiene sesiones asignadas válidas.';
    END IF;

    SET NEW.total_sesiones = v_sesiones_asignadas;
    SET NEW.sesiones_realizadas = 0;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_programacion_bu` BEFORE UPDATE ON `programacion_academica` FOR EACH ROW BEGIN
    IF NEW.sesiones_realizadas < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Las sesiones realizadas no pueden ser negativas.';
    END IF;

    IF NEW.total_sesiones IS NULL OR NEW.total_sesiones <= 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El total de sesiones debe ser mayor a 0.';
    END IF;

    IF NEW.sesiones_realizadas > NEW.total_sesiones THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Las sesiones realizadas no pueden superar el total de sesiones.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultado_aprendizaje`
--

CREATE TABLE `resultado_aprendizaje` (
  `id_resultado` int(11) NOT NULL,
  `id_competencia` int(11) NOT NULL,
  `codigo` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `sesiones_asignadas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resultado_aprendizaje`
--

INSERT INTO `resultado_aprendizaje` (`id_resultado`, `id_competencia`, `codigo`, `descripcion`, `sesiones_asignadas`) VALUES
(1, 1, 'RA-01', 'Desarrollar vistas seguras con Java Swing y JPasswordField', 10),
(2, 1, 'RA-02', 'Implementar controladores de login en PHP', 10),
(3, 1, 'RA-03', 'Gestionar llaves foráneas en MariaDB', 10),
(4, 2, 'RA-04', 'Identificar exposición a hongos y rickettsias (GTC 45)', 20);

--
-- Disparadores `resultado_aprendizaje`
--
DELIMITER $$
CREATE TRIGGER `trg_resultado_bi` BEFORE INSERT ON `resultado_aprendizaje` FOR EACH ROW BEGIN
    DECLARE v_resultados_totales INT;
    DECLARE v_total_sesiones INT;
    DECLARE v_resultados_actuales INT;
    DECLARE v_suma_actual INT;
    DECLARE v_sesiones_calculadas INT;

    SELECT resultados_totales, total_sesiones
    INTO v_resultados_totales, v_total_sesiones
    FROM Competencias
    WHERE id_competencia = NEW.id_competencia
    FOR UPDATE;

    SELECT COUNT(*)
    INTO v_resultados_actuales
    FROM Resultado_Aprendizaje
    WHERE id_competencia = NEW.id_competencia;

    IF v_resultados_actuales >= v_resultados_totales THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'No se pueden registrar más resultados de aprendizaje para esta competencia.';
    END IF;

    SET v_sesiones_calculadas = FLOOR(v_total_sesiones / v_resultados_totales);

    IF NEW.sesiones_asignadas IS NULL THEN
        SET NEW.sesiones_asignadas = v_sesiones_calculadas;
    END IF;

    IF NEW.sesiones_asignadas < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Las sesiones asignadas no pueden ser negativas.';
    END IF;

    SELECT COALESCE(SUM(sesiones_asignadas), 0)
    INTO v_suma_actual
    FROM Resultado_Aprendizaje
    WHERE id_competencia = NEW.id_competencia;

    IF (v_suma_actual + NEW.sesiones_asignadas) > v_total_sesiones THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La suma de sesiones asignadas no puede superar el total de sesiones de la competencia.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_resultado_bu` BEFORE UPDATE ON `resultado_aprendizaje` FOR EACH ROW BEGIN
    DECLARE v_total_sesiones INT;
    DECLARE v_suma_actual INT;

    IF NEW.sesiones_asignadas IS NULL OR NEW.sesiones_asignadas < 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Las sesiones asignadas deben ser mayores o iguales a 0.';
    END IF;

    SELECT total_sesiones
    INTO v_total_sesiones
    FROM Competencias
    WHERE id_competencia = NEW.id_competencia
    FOR UPDATE;

    SELECT COALESCE(SUM(sesiones_asignadas), 0)
    INTO v_suma_actual
    FROM Resultado_Aprendizaje
    WHERE id_competencia = NEW.id_competencia
      AND id_resultado <> OLD.id_resultado;

    IF (v_suma_actual + NEW.sesiones_asignadas) > v_total_sesiones THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'La suma de sesiones asignadas no puede superar el total de sesiones de la competencia.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'Coordinador'),
(2, 'Instructor'),
(3, 'Aprendiz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_programa`
--

CREATE TABLE `tipo_programa` (
  `id_tipo_programa` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_programa`
--

INSERT INTO `tipo_programa` (`id_tipo_programa`, `nombre`) VALUES
(1, 'Tecnólogo'),
(2, 'Técnico'),
(3, 'Operario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellido` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `titulacion` varchar(100) DEFAULT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `contraseña` varchar(100) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expira` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `telefono`, `correo`, `titulacion`, `usuario`, `contraseña`) VALUES
(1, 'Darwin', 'Cordero', '3001234567', 'dcordero@sena.edu.co', 'Ingeniero de Sistemas', 'dcordero', 'hashed_pass_123'),
(2, 'Hasler', 'Gómez', '3019876543', 'hasler@soy.sena.edu.co', 'Bachiller', 'hasler_g', 'hashed_pass_456'),
(3, 'Sebastian', 'Roldan', '3123456789', 'sroldan@soy.sena.edu.co', 'Bachiller', 'sebas_r', 'hashed_pass_789'),
(4, 'Mateo', 'López', '3109871234', 'mlopez@soy.sena.edu.co', 'Bachiller', 'mateo_l', 'hashed_pass_321'),
(5, 'Ana', 'Restrepo', '3201112233', 'arestrepo@sena.edu.co', 'Administradora Educativa', 'ana_coord', 'hashed_pass_coord'),
(6, 'Carlos', 'Ramírez', '3155556677', 'cramirez@sena.edu.co', 'Especialista SST', 'cramirez', 'hashed_pass_sst');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `id_usuario_rol` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`id_usuario_rol`, `id_usuario`, `id_rol`) VALUES
(1, 1, 2),
(2, 2, 3),
(3, 3, 3),
(4, 4, 3),
(5, 5, 1),
(6, 6, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ambientes`
--
ALTER TABLE `ambientes`
  ADD PRIMARY KEY (`id_numero_ambiente`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id_asistencia`),
  ADD UNIQUE KEY `uq_asistencia_aprendiz_fecha` (`id_programacion`,`id_usuario_aprendiz`,`fecha_asistencia`),
  ADD KEY `fk_asistencia_aprendiz` (`id_usuario_aprendiz`),
  ADD KEY `idx_asistencia_programacion_fecha` (`id_programacion`,`fecha_asistencia`);

--
-- Indices de la tabla `competencias`
--
ALTER TABLE `competencias`
  ADD PRIMARY KEY (`id_competencia`),
  ADD KEY `fk_competencias_programa` (`id_programa`);

--
-- Indices de la tabla `dias`
--
ALTER TABLE `dias`
  ADD PRIMARY KEY (`id_dias`);

--
-- Indices de la tabla `fichas`
--
ALTER TABLE `fichas`
  ADD PRIMARY KEY (`numero_ficha`),
  ADD KEY `fk_fichas_programa` (`id_programa`),
  ADD KEY `fk_fichas_instructor_lider` (`id_usuario_instructor_lider`),
  ADD KEY `fk_fichas_jornada` (`id_jornada`);

--
-- Indices de la tabla `ficha_aprendiz`
--
ALTER TABLE `ficha_aprendiz`
  ADD PRIMARY KEY (`id_ficha_aprendiz`),
  ADD KEY `fk_ficha_aprendiz_usuario` (`id_usuario_aprendiz`),
  ADD KEY `fk_ficha_aprendiz_ficha` (`numero_ficha`);

--
-- Indices de la tabla `foto_ambiente`
--
ALTER TABLE `foto_ambiente`
  ADD PRIMARY KEY (`id_foto_ambiente`),
  ADD KEY `fk_foto_ambiente` (`id_numero_ambiente`);

--
-- Indices de la tabla `jornada`
--
ALTER TABLE `jornada`
  ADD PRIMARY KEY (`id_jornada`);

--
-- Indices de la tabla `novedad_ambiente`
--
ALTER TABLE `novedad_ambiente`
  ADD PRIMARY KEY (`id_novedad`),
  ADD KEY `fk_novedad_ambiente` (`id_numero_ambiente`),
  ADD KEY `fk_novedad_usuario` (`id_usuario`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`id_programa`),
  ADD KEY `fk_programa_tipo` (`id_tipo_programa`);

--
-- Indices de la tabla `programacion_academica`
--
ALTER TABLE `programacion_academica`
  ADD PRIMARY KEY (`id_programacion`),
  ADD KEY `fk_programacion_ficha` (`numero_ficha`),
  ADD KEY `fk_programacion_usuario` (`id_usuario`),
  ADD KEY `fk_programacion_ambiente` (`id_numero_ambiente`),
  ADD KEY `fk_programacion_dia` (`id_dias`),
  ADD KEY `idx_programacion_resultado` (`id_resultado_aprendizaje`);

--
-- Indices de la tabla `resultado_aprendizaje`
--
ALTER TABLE `resultado_aprendizaje`
  ADD PRIMARY KEY (`id_resultado`),
  ADD KEY `idx_resultado_competencia` (`id_competencia`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tipo_programa`
--
ALTER TABLE `tipo_programa`
  ADD PRIMARY KEY (`id_tipo_programa`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`id_usuario_rol`),
  ADD KEY `fk_usuario_rol_usuario` (`id_usuario`),
  ADD KEY `fk_usuario_rol_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ambientes`
--
ALTER TABLE `ambientes`
  MODIFY `id_numero_ambiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id_asistencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `competencias`
--
ALTER TABLE `competencias`
  MODIFY `id_competencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `dias`
--
ALTER TABLE `dias`
  MODIFY `id_dias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ficha_aprendiz`
--
ALTER TABLE `ficha_aprendiz`
  MODIFY `id_ficha_aprendiz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `foto_ambiente`
--
ALTER TABLE `foto_ambiente`
  MODIFY `id_foto_ambiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `jornada`
--
ALTER TABLE `jornada`
  MODIFY `id_jornada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `novedad_ambiente`
--
ALTER TABLE `novedad_ambiente`
  MODIFY `id_novedad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `id_programa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `programacion_academica`
--
ALTER TABLE `programacion_academica`
  MODIFY `id_programacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `resultado_aprendizaje`
--
ALTER TABLE `resultado_aprendizaje`
  MODIFY `id_resultado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_programa`
--
ALTER TABLE `tipo_programa`
  MODIFY `id_tipo_programa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  MODIFY `id_usuario_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk_asistencia_aprendiz` FOREIGN KEY (`id_usuario_aprendiz`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `fk_asistencia_programacion` FOREIGN KEY (`id_programacion`) REFERENCES `programacion_academica` (`id_programacion`);

--
-- Filtros para la tabla `competencias`
--
ALTER TABLE `competencias`
  ADD CONSTRAINT `fk_competencias_programa` FOREIGN KEY (`id_programa`) REFERENCES `programa` (`id_programa`);

--
-- Filtros para la tabla `fichas`
--
ALTER TABLE `fichas`
  ADD CONSTRAINT `fk_fichas_instructor_lider` FOREIGN KEY (`id_usuario_instructor_lider`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `fk_fichas_jornada` FOREIGN KEY (`id_jornada`) REFERENCES `jornada` (`id_jornada`),
  ADD CONSTRAINT `fk_fichas_programa` FOREIGN KEY (`id_programa`) REFERENCES `programa` (`id_programa`);

--
-- Filtros para la tabla `ficha_aprendiz`
--
ALTER TABLE `ficha_aprendiz`
  ADD CONSTRAINT `fk_ficha_aprendiz_ficha` FOREIGN KEY (`numero_ficha`) REFERENCES `fichas` (`numero_ficha`),
  ADD CONSTRAINT `fk_ficha_aprendiz_usuario` FOREIGN KEY (`id_usuario_aprendiz`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `foto_ambiente`
--
ALTER TABLE `foto_ambiente`
  ADD CONSTRAINT `fk_foto_ambiente` FOREIGN KEY (`id_numero_ambiente`) REFERENCES `ambientes` (`id_numero_ambiente`);

--
-- Filtros para la tabla `novedad_ambiente`
--
ALTER TABLE `novedad_ambiente`
  ADD CONSTRAINT `fk_novedad_ambiente` FOREIGN KEY (`id_numero_ambiente`) REFERENCES `ambientes` (`id_numero_ambiente`),
  ADD CONSTRAINT `fk_novedad_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `programa`
--
ALTER TABLE `programa`
  ADD CONSTRAINT `fk_programa_tipo` FOREIGN KEY (`id_tipo_programa`) REFERENCES `tipo_programa` (`id_tipo_programa`);

--
-- Filtros para la tabla `programacion_academica`

ALTER TABLE `programacion_academica`
  ADD CONSTRAINT `fk_programacion_ambiente` FOREIGN KEY (`id_numero_ambiente`) REFERENCES `ambientes` (`id_numero_ambiente`),
  ADD CONSTRAINT `fk_programacion_dia` FOREIGN KEY (`id_dias`) REFERENCES `dias` (`id_dias`),
  ADD CONSTRAINT `fk_programacion_ficha` FOREIGN KEY (`numero_ficha`) REFERENCES `fichas` (`numero_ficha`),
  ADD CONSTRAINT `fk_programacion_resultado` FOREIGN KEY (`id_resultado_aprendizaje`) REFERENCES `resultado_aprendizaje` (`id_resultado`),
  ADD CONSTRAINT `fk_programacion_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `resultado_aprendizaje`
--
ALTER TABLE `resultado_aprendizaje`
  ADD CONSTRAINT `fk_resultado_competencia` FOREIGN KEY (`id_competencia`) REFERENCES `competencias` (`id_competencia`);

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `fk_usuario_rol_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`),
  ADD CONSTRAINT `fk_usuario_rol_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
