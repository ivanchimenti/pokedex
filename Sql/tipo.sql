START TRANSACTION;
-- Base de datos: `pokedexpw2`
-- Estructura de tabla para la tabla `tipo`
CREATE TABLE `tipo` (
  `Id` int(11) NOT NULL,
  `Nombre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `tipo`
INSERT INTO `tipo` (`Id`, `Nombre`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(11, 0),
(12, 0),
(13, 0),
(14, 0),
(15, 0),
(16, 0),
(17, 0),
(18, 0);

-- Indices de la tabla `tipo`
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`Id`);
COMMIT;