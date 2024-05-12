START TRANSACTION;
-- Base de datos: `pokedexpw2`
-- Estructura de tabla para la tabla `admin`
CREATE TABLE `admin` (
  `Id` int(11) NOT NULL,
  `User` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcado de datos para la tabla `admin`
INSERT INTO `admin` (`Id`, `User`, `Password`) VALUES
(1, 'admin', '1234');

-- Indices de la tabla `admin`
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

-- AUTO_INCREMENT de la tabla `admin`
ALTER TABLE `admin`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;