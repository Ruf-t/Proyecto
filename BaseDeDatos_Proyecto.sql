-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-08-2024 a las 00:21:00
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `ID` int(11) NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Contraseña` varchar(100) NOT NULL,
  `FK-Persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador_taximetrista`
--

CREATE TABLE `administrador_taximetrista` (
  `ID` int(11) NOT NULL,
  `Fk_Administrador` int(11) NOT NULL,
  `Fk_Taximetrista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_registrado`
--

CREATE TABLE `cliente_registrado` (
  `ID` int(11) NOT NULL,
  `Fk_Persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada`
--

CREATE TABLE `jornada` (
  `ID` int(11) NOT NULL,
  `Km_Inicio` varchar(20) NOT NULL,
  `Km_Final` varchar(20) NOT NULL,
  `FK-Taxi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(30) NOT NULL,
  `Telefono` int(10) NOT NULL,
  `Apellido` int(40) NOT NULL,
  `Direccion` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados_jornada`
--

CREATE TABLE `resultados_jornada` (
  `ID` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Ventas_Total_Fiado` varchar(50) NOT NULL,
  `Ventas_Total_Contado` varchar(50) NOT NULL,
  `Ventas_Total_Credito` varchar(50) NOT NULL,
  `Ventas_Total_Debito` varchar(50) NOT NULL,
  `Fk_Jornada` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taxi`
--

CREATE TABLE `taxi` (
  `ID` int(11) NOT NULL,
  `Matricula` varchar(20) NOT NULL,
  `Modelo` int(60) NOT NULL,
  `Año` int(25) NOT NULL,
  `Estado` binary(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taximetrista`
--

CREATE TABLE `taximetrista` (
  `ID` int(11) NOT NULL,
  `Licencia_De_Conducir` varchar(50) NOT NULL,
  `Fecha_Expiracion_Licencia` date NOT NULL,
  `Fecha_Nacimiento` date NOT NULL,
  `Usuario` varchar(100) NOT NULL,
  `Contraseña` varchar(100) NOT NULL,
  `FK-Persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `ID` int(11) NOT NULL,
  `Tipo_De_Turno` varchar(30) NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Final` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje`
--

CREATE TABLE `viaje` (
  `ID` int(11) NOT NULL,
  `Tarifa` varchar(100) NOT NULL,
  `Método de pago` varchar(60) NOT NULL,
  `Fk_Taximetrista` int(11) NOT NULL,
  `Fk_Cliente_Registrado` int(11) NOT NULL,
  `Fk_Taxi` int(11) NOT NULL,
  `Fk_Jornada` int(11) NOT NULL,
  `Fk_Turno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID-Persona` (`FK-Persona`);

--
-- Indices de la tabla `administrador_taximetrista`
--
ALTER TABLE `administrador_taximetrista`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Fk_Administrador` (`Fk_Administrador`),
  ADD KEY `Fk_Taximetrista` (`Fk_Taximetrista`);

--
-- Indices de la tabla `cliente_registrado`
--
ALTER TABLE `cliente_registrado`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Fk_Persona` (`Fk_Persona`);

--
-- Indices de la tabla `jornada`
--
ALTER TABLE `jornada`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK-Taxi` (`FK-Taxi`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `resultados_jornada`
--
ALTER TABLE `resultados_jornada`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Fk_Jornada` (`Fk_Jornada`);

--
-- Indices de la tabla `taxi`
--
ALTER TABLE `taxi`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `taximetrista`
--
ALTER TABLE `taximetrista`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID-Persona` (`FK-Persona`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Fk_Taximetrista` (`Fk_Taximetrista`),
  ADD KEY `Fk_Cliente_Registrado` (`Fk_Cliente_Registrado`),
  ADD KEY `Fk_Taxi` (`Fk_Taxi`),
  ADD KEY `Fk_Jornada` (`Fk_Jornada`),
  ADD KEY `Fk_Turno` (`Fk_Turno`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`FK-Persona`) REFERENCES `persona` (`ID`);

--
-- Filtros para la tabla `administrador_taximetrista`
--
ALTER TABLE `administrador_taximetrista`
  ADD CONSTRAINT `administrador_taximetrista_ibfk_1` FOREIGN KEY (`Fk_Administrador`) REFERENCES `administrador` (`ID`),
  ADD CONSTRAINT `administrador_taximetrista_ibfk_2` FOREIGN KEY (`Fk_Taximetrista`) REFERENCES `taximetrista` (`ID`);

--
-- Filtros para la tabla `cliente_registrado`
--
ALTER TABLE `cliente_registrado`
  ADD CONSTRAINT `cliente_registrado_ibfk_1` FOREIGN KEY (`Fk_Persona`) REFERENCES `persona` (`ID`);

--
-- Filtros para la tabla `jornada`
--
ALTER TABLE `jornada`
  ADD CONSTRAINT `jornada_ibfk_1` FOREIGN KEY (`FK-Taxi`) REFERENCES `taxi` (`ID`);

--
-- Filtros para la tabla `resultados_jornada`
--
ALTER TABLE `resultados_jornada`
  ADD CONSTRAINT `resultados_jornada_ibfk_1` FOREIGN KEY (`Fk_Jornada`) REFERENCES `jornada` (`ID`);

--
-- Filtros para la tabla `taximetrista`
--
ALTER TABLE `taximetrista`
  ADD CONSTRAINT `taximetrista_ibfk_1` FOREIGN KEY (`FK-Persona`) REFERENCES `persona` (`ID`);

--
-- Filtros para la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD CONSTRAINT `viaje_ibfk_1` FOREIGN KEY (`Fk_Taximetrista`) REFERENCES `taximetrista` (`ID`),
  ADD CONSTRAINT `viaje_ibfk_2` FOREIGN KEY (`Fk_Turno`) REFERENCES `turno` (`ID`),
  ADD CONSTRAINT `viaje_ibfk_3` FOREIGN KEY (`Fk_Taxi`) REFERENCES `taxi` (`ID`),
  ADD CONSTRAINT `viaje_ibfk_4` FOREIGN KEY (`Fk_Cliente_Registrado`) REFERENCES `cliente_registrado` (`ID`),
  ADD CONSTRAINT `viaje_ibfk_5` FOREIGN KEY (`Fk_Jornada`) REFERENCES `jornada` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
