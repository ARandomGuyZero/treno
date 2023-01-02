-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-01-2023 a las 22:51:36
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `treno`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `tema` varchar(30) NOT NULL,
  `texto` varchar(200) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `nombre`, `email`, `tema`, `texto`, `status`) VALUES
(1, 'Alan', 'alan26012002@gmail.com', 'Uwu', 'Amogus', 2),
(2, 'Alan', 'alan26012002@gmail.com', 'Uwu', 'Amogus', 0),
(3, 'Alan', 'alan26012002@gmail.com', 'Uwu', 'Amogus', 2),
(4, 'Alan', 'alan26012002@gmail.com', 'Uwu', 'Amogus', 0),
(5, 'Alan', 'alan26012002@gmail.com', 'Uwu', 'Amogus', 0),
(6, 'Alan', 'alan26012002@gmail.com', 'Uwu', 'Amogus', 0),
(7, 'Alan', 'alan26012002@gmail.com', 'Uwu', 'Amogus', 2),
(8, 'Prueba', 'usuario@gmail.com', 'Uwu', '121', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destino`
--

CREATE TABLE `destino` (
  `id` int(11) NOT NULL,
  `destino` varchar(255) DEFAULT NULL,
  `pais` varchar(40) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `imagen` varchar(200) NOT NULL,
  `total` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `destino`
--

INSERT INTO `destino` (`id`, `destino`, `pais`, `descripcion`, `status`, `imagen`, `total`) VALUES
(71, 'Jalisco', 'México', 'Disfruta de una ruta muy a la mexicana con mucho sabor a Tequila.', 1, 'tren1.jpg', 2),
(72, 'Ontario', 'Canadá', 'Si quieres un hermoso paisaje vintage en invierno, esta ruta es para ti.', 1, 'tren3.jpg', 0),
(73, 'Madrid', 'España', 'Una ruta por todo el centro de Madrid, con vistas muy victorianas.', 1, 'tren5.jpg', 3),
(74, 'Oslo', 'Noruega', 'No hay nada mejor que disfrutar de la naturaleza de Noruega.', 1, 'tren7.jpg', 0),
(75, 'Rajasthan', 'India', 'Más que una ruta, es un ritual hermoso por la India.', 2, 'trenaaa.jpg', 1),
(76, 'Nipón', 'Japón', 'Tren Hello Kitty, es increíble revivir la infancia.', 1, 'foto2.jpg', 2),
(122, '121', 'Islas Gland', '11', 2, 'foto1.jpg', 0),
(123, 'Rajasthan', 'India', 'Más que una ruta, es un ritual hermoso por la India.', 1, 'trenaaa.jpg', 1),
(124, 'Chiapas', 'México', 'Lo más hermoso de México desde la ruta del Tren Maya.', 1, 'mayaa.jpg', 0),
(125, 'Bilbao', 'España', 'La compañía de trenes más grande España, te invita a Bilbao.', 1, 'tren4.jpg', 0),
(126, 'Hampi', 'India', 'Lo más rústico del oriente en este linda y agradable ruta.', 1, 'e.jpg', 0),
(127, 'Nuevo', 'Afganistán', '1', 2, 'foto3.jpg', 3),
(128, 'Nuevo', 'Afganistán', '121212', 2, 'Captura.PNG', 2),
(129, 'Nuevo', 'Afganistán', '12121', 2, 'Captura.PNG', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `iso` char(2) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `totalDestinos` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `iso`, `nombre`, `totalDestinos`) VALUES
(1, 'AF', 'Afganistán', 0),
(2, 'AX', 'Islas Gland', 0),
(3, 'AL', 'Albania', 0),
(4, 'DE', 'Alemania', 0),
(5, 'AD', 'Andorra', 0),
(6, 'AO', 'Angola', 0),
(7, 'AI', 'Anguilla', 0),
(8, 'AQ', 'Antártida', 0),
(9, 'AG', 'Antigua y Barbuda', 0),
(10, 'AN', 'Antillas Holandesas', 0),
(11, 'SA', 'Arabia Saudí', 0),
(12, 'DZ', 'Argelia', 0),
(13, 'AR', 'Argentina', 0),
(14, 'AM', 'Armenia', 0),
(15, 'AW', 'Aruba', 0),
(16, 'AU', 'Australia', 0),
(17, 'AT', 'Austria', 0),
(18, 'AZ', 'Azerbaiyán', 0),
(19, 'BS', 'Bahamas', 0),
(20, 'BH', 'Bahréin', 0),
(21, 'BD', 'Bangladesh', 0),
(22, 'BB', 'Barbados', 0),
(23, 'BY', 'Bielorrusia', 0),
(24, 'BE', 'Bélgica', 0),
(25, 'BZ', 'Belice', 0),
(26, 'BJ', 'Benin', 0),
(27, 'BM', 'Bermudas', 0),
(28, 'BT', 'Bhután', 0),
(29, 'BO', 'Bolivia', 0),
(30, 'BA', 'Bosnia y Herzegovina', 0),
(31, 'BW', 'Botsuana', 0),
(32, 'BV', 'Isla Bouvet', 0),
(33, 'BR', 'Brasil', 0),
(34, 'BN', 'Brunéi', 0),
(35, 'BG', 'Bulgaria', 0),
(36, 'BF', 'Burkina Faso', 0),
(37, 'BI', 'Burundi', 0),
(38, 'CV', 'Cabo Verde', 0),
(39, 'KY', 'Islas Caimán', 0),
(40, 'KH', 'Camboya', 0),
(41, 'CM', 'Camerún', 0),
(42, 'CA', 'Canadá', 1),
(43, 'CF', 'República Centroafricana', 0),
(44, 'TD', 'Chad', 0),
(45, 'CZ', 'República Checa', 0),
(46, 'CL', 'Chile', 0),
(47, 'CN', 'China', 0),
(48, 'CY', 'Chipre', 0),
(49, 'CX', 'Isla de Navidad', 0),
(50, 'VA', 'Ciudad del Vaticano', 0),
(51, 'CC', 'Islas Cocos', 0),
(52, 'CO', 'Colombia', 0),
(53, 'KM', 'Comoras', 0),
(54, 'CD', 'República Democrática del Congo', 0),
(55, 'CG', 'Congo', 0),
(56, 'CK', 'Islas Cook', 0),
(57, 'KP', 'Corea del Norte', 0),
(58, 'KR', 'Corea del Sur', 0),
(59, 'CI', 'Costa de Marfil', 0),
(60, 'CR', 'Costa Rica', 0),
(61, 'HR', 'Croacia', 0),
(62, 'CU', 'Cuba', 0),
(63, 'DK', 'Dinamarca', 0),
(64, 'DM', 'Dominica', 0),
(65, 'DO', 'República Dominicana', 0),
(66, 'EC', 'Ecuador', 0),
(67, 'EG', 'Egipto', 0),
(68, 'SV', 'El Salvador', 0),
(69, 'AE', 'Emiratos Árabes Unidos', 0),
(70, 'ER', 'Eritrea', 0),
(71, 'SK', 'Eslovaquia', 0),
(72, 'SI', 'Eslovenia', 0),
(73, 'ES', 'España', 2),
(74, 'UM', 'Islas ultramarinas de Estados Unidos', 0),
(75, 'US', 'Estados Unidos', 0),
(76, 'EE', 'Estonia', 0),
(77, 'ET', 'Etiopía', 0),
(78, 'FO', 'Islas Feroe', 0),
(79, 'PH', 'Filipinas', 0),
(80, 'FI', 'Finlandia', 0),
(81, 'FJ', 'Fiyi', 0),
(82, 'FR', 'Francia', 0),
(83, 'GA', 'Gabón', 0),
(84, 'GM', 'Gambia', 0),
(85, 'GE', 'Georgia', 0),
(86, 'GS', 'Islas Georgias del Sur y Sandwich del Sur', 0),
(87, 'GH', 'Ghana', 0),
(88, 'GI', 'Gibraltar', 0),
(89, 'GD', 'Granada', 0),
(90, 'GR', 'Grecia', 0),
(91, 'GL', 'Groenlandia', 0),
(92, 'GP', 'Guadalupe', 0),
(93, 'GU', 'Guam', 0),
(94, 'GT', 'Guatemala', 0),
(95, 'GF', 'Guayana Francesa', 0),
(96, 'GN', 'Guinea', 0),
(97, 'GQ', 'Guinea Ecuatorial', 0),
(98, 'GW', 'Guinea-Bissau', 0),
(99, 'GY', 'Guyana', 0),
(100, 'HT', 'Haití', 0),
(101, 'HM', 'Islas Heard y McDonald', 0),
(102, 'HN', 'Honduras', 0),
(103, 'HK', 'Hong Kong', 0),
(104, 'HU', 'Hungría', 0),
(105, 'IN', 'India', 2),
(106, 'ID', 'Indonesia', 0),
(107, 'IR', 'Irán', 0),
(108, 'IQ', 'Iraq', 0),
(109, 'IE', 'Irlanda', 0),
(110, 'IS', 'Islandia', 0),
(111, 'IL', 'Israel', 0),
(112, 'IT', 'Italia', 0),
(113, 'JM', 'Jamaica', 0),
(114, 'JP', 'Japón', 1),
(115, 'JO', 'Jordania', 0),
(116, 'KZ', 'Kazajstán', 0),
(117, 'KE', 'Kenia', 0),
(118, 'KG', 'Kirguistán', 0),
(119, 'KI', 'Kiribati', 0),
(120, 'KW', 'Kuwait', 0),
(121, 'LA', 'Laos', 0),
(122, 'LS', 'Lesotho', 0),
(123, 'LV', 'Letonia', 0),
(124, 'LB', 'Líbano', 0),
(125, 'LR', 'Liberia', 0),
(126, 'LY', 'Libia', 0),
(127, 'LI', 'Liechtenstein', 0),
(128, 'LT', 'Lituania', 0),
(129, 'LU', 'Luxemburgo', 0),
(130, 'MO', 'Macao', 0),
(131, 'MK', 'ARY Macedonia', 0),
(132, 'MG', 'Madagascar', 0),
(133, 'MY', 'Malasia', 0),
(134, 'MW', 'Malawi', 0),
(135, 'MV', 'Maldivas', 0),
(136, 'ML', 'Malí', 0),
(137, 'MT', 'Malta', 0),
(138, 'FK', 'Islas Malvinas', 0),
(139, 'MP', 'Islas Marianas del Norte', 0),
(140, 'MA', 'Marruecos', 0),
(141, 'MH', 'Islas Marshall', 0),
(142, 'MQ', 'Martinica', 0),
(143, 'MU', 'Mauricio', 0),
(144, 'MR', 'Mauritania', 0),
(145, 'YT', 'Mayotte', 0),
(146, 'MX', 'México', 2),
(147, 'FM', 'Micronesia', 0),
(148, 'MD', 'Moldavia', 0),
(149, 'MC', 'Mónaco', 0),
(150, 'MN', 'Mongolia', 0),
(151, 'MS', 'Montserrat', 0),
(152, 'MZ', 'Mozambique', 0),
(153, 'MM', 'Myanmar', 0),
(154, 'NA', 'Namibia', 0),
(155, 'NR', 'Nauru', 0),
(156, 'NP', 'Nepal', 0),
(157, 'NI', 'Nicaragua', 0),
(158, 'NE', 'Níger', 0),
(159, 'NG', 'Nigeria', 0),
(160, 'NU', 'Niue', 0),
(161, 'NF', 'Isla Norfolk', 0),
(162, 'NO', 'Noruega', 1),
(163, 'NC', 'Nueva Caledonia', 0),
(164, 'NZ', 'Nueva Zelanda', 0),
(165, 'OM', 'Omán', 0),
(166, 'NL', 'Países Bajos', 0),
(167, 'PK', 'Pakistán', 0),
(168, 'PW', 'Palau', 0),
(169, 'PS', 'Palestina', 0),
(170, 'PA', 'Panamá', 0),
(171, 'PG', 'Papúa Nueva Guinea', 0),
(172, 'PY', 'Paraguay', 0),
(173, 'PE', 'Perú', 0),
(174, 'PN', 'Islas Pitcairn', 0),
(175, 'PF', 'Polinesia Francesa', 0),
(176, 'PL', 'Polonia', 0),
(177, 'PT', 'Portugal', 0),
(178, 'PR', 'Puerto Rico', 0),
(179, 'QA', 'Qatar', 0),
(180, 'GB', 'Reino Unido', 0),
(181, 'RE', 'Reunión', 0),
(182, 'RW', 'Ruanda', 0),
(183, 'RO', 'Rumania', 0),
(184, 'RU', 'Rusia', 0),
(185, 'EH', 'Sahara Occidental', 0),
(186, 'SB', 'Islas Salomón', 0),
(187, 'WS', 'Samoa', 0),
(188, 'AS', 'Samoa Americana', 0),
(189, 'KN', 'San Cristóbal y Nevis', 0),
(190, 'SM', 'San Marino', 0),
(191, 'PM', 'San Pedro y Miquelón', 0),
(192, 'VC', 'San Vicente y las Granadinas', 0),
(193, 'SH', 'Santa Helena', 0),
(194, 'LC', 'Santa Lucía', 0),
(195, 'ST', 'Santo Tomé y Príncipe', 0),
(196, 'SN', 'Senegal', 0),
(197, 'CS', 'Serbia y Montenegro', 0),
(198, 'SC', 'Seychelles', 0),
(199, 'SL', 'Sierra Leona', 0),
(200, 'SG', 'Singapur', 0),
(201, 'SY', 'Siria', 0),
(202, 'SO', 'Somalia', 0),
(203, 'LK', 'Sri Lanka', 0),
(204, 'SZ', 'Suazilandia', 0),
(205, 'ZA', 'Sudáfrica', 0),
(206, 'SD', 'Sudán', 0),
(207, 'SE', 'Suecia', 0),
(208, 'CH', 'Suiza', 0),
(209, 'SR', 'Surinam', 0),
(210, 'SJ', 'Svalbard y Jan Mayen', 0),
(211, 'TH', 'Tailandia', 0),
(212, 'TW', 'Taiwán', 0),
(213, 'TZ', 'Tanzania', 0),
(214, 'TJ', 'Tayikistán', 0),
(215, 'IO', 'Territorio Británico del Océano Índico', 0),
(216, 'TF', 'Territorios Australes Franceses', 0),
(217, 'TL', 'Timor Oriental', 0),
(218, 'TG', 'Togo', 0),
(219, 'TK', 'Tokelau', 0),
(220, 'TO', 'Tonga', 0),
(221, 'TT', 'Trinidad y Tobago', 0),
(222, 'TN', 'Túnez', 0),
(223, 'TC', 'Islas Turcas y Caicos', 0),
(224, 'TM', 'Turkmenistán', 0),
(225, 'TR', 'Turquía', 0),
(226, 'TV', 'Tuvalu', 0),
(227, 'UA', 'Ucrania', 0),
(228, 'UG', 'Uganda', 0),
(229, 'UY', 'Uruguay', 0),
(230, 'UZ', 'Uzbekistán', 0),
(231, 'VU', 'Vanuatu', 0),
(232, 'VE', 'Venezuela', 0),
(233, 'VN', 'Vietnam', 0),
(234, 'VG', 'Islas Vírgenes Británicas', 0),
(235, 'VI', 'Islas Vírgenes de los Estados Unidos', 0),
(236, 'WF', 'Wallis y Futuna', 0),
(237, 'YE', 'Yemen', 0),
(238, 'DJ', 'Yibuti', 0),
(239, 'ZM', 'Zambia', 0),
(240, 'ZW', 'Zimbabue', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `precios`
--

CREATE TABLE `precios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `precio` int(20) NOT NULL,
  `publico` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `exclusivo` tinyint(1) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `precios`
--

INSERT INTO `precios` (`id`, `nombre`, `precio`, `publico`, `descripcion`, `exclusivo`, `status`) VALUES
(1, 'Individual', 2000, 'Paquete Individual', 'Viaje redondo, perfecto para una persona en una área básica. Incluye un tour.', 0, 1),
(2, 'DÚO', 3500, 'Paquete para parejas', 'Viaje redondo, perfecto para dos personas en una área básica. Incluye un tour y comida.', 0, 1),
(3, 'PREMIUM', 5000, 'Paquete en primera clase', 'Viaje redondo, perfecto para una persona, en una área de primera clase. Incluye comida, tour y guías.', 1, 1),
(4, '12', 112, '', '11', 1, 0),
(5, '121', 121, '', '12', 1, 0),
(6, 'Amogus', 2222, '222', '2221', 1, 2),
(7, '1', 1, '1', '1', 0, 2),
(8, '1', 1, '1', '1', 0, 2),
(9, 'Amogus', 121, '1212', '121', 0, 2),
(10, 'Prueba', 0, '', '', 0, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(20) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `tarjeta` varchar(16) NOT NULL,
  `exp` varchar(4) NOT NULL,
  `cvv` varchar(3) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellidos`, `email`, `password`, `rol`, `tarjeta`, `exp`, `cvv`, `status`) VALUES
(1, 'Alan', 'Ramos López', 'alan26012002@gmail.com', '123', 'admin', '0', '0', '1', 1),
(2, '', '', 'usuario12@gmail.com', '', 'usuario', '1111111111111111', '222', '112', 2),
(3, 'Alan', 'Ramos López', 'yoshi2002@gmail.com', '#Tintan12', 'usuario', '1111111111111111', '1111', '111', 1),
(4, 'amogus', 'sus', 'sus@gmail.co', '123', 'usuario', '0', '0', '0', 1),
(5, 'Alan', '111', 'alan2@gmail.com', '11223', 'usuario', '0', '0', '0', 1),
(6, '1', '22', 'sus@gl.co', '1221', 'usuario', '0', '0', '0', 1),
(7, 'Alan', 'amogus', 'yoshi22@gmail.com', '123', 'usuario', '0', '0', '0', 1),
(8, 'Alan', 'Ramos López', '1212@gma.cm', '12', 'usuario', '0', '0', '0', 1),
(9, 'amogus', '12', '121@gmail.com', '12', 'usuario', '0', '0', '0', 1),
(10, '212', 'Ramos López', 'aa@g.co', '123', 'usuario', '0', '0', '0', 1),
(11, '12', '121', 'alan26012002@gmail.com', '#Tintan12', 'usuario', '0', '0', '0', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viaje`
--

CREATE TABLE `viaje` (
  `id` int(11) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `destino` varchar(40) NOT NULL,
  `pais` varchar(40) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `paquete` varchar(200) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `status` int(1) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viaje`
--

INSERT INTO `viaje` (`id`, `usuario`, `destino`, `pais`, `descripcion`, `paquete`, `imagen`, `status`, `fecha`) VALUES
(27, 'yoshi2002@gmail.com', 'Madrid', 'España', 'Una ruta por todo el centro de Madrid, con vistas muy victorianas.', 'DÚO', 'tren5.jpg', 1, '2023-02-01'),
(28, 'yoshi2002@gmail.com', 'Nuevo', 'Afganistán', '1', 'DÚO', 'foto3.jpg', 2, '2023-02-02'),
(29, 'yoshi2002@gmail.com', 'Nuevo', 'Afganistán', '121212', 'PREMIUM', 'Captura.PNG', 2, '2023-02-02'),
(30, 'yoshi2002@gmail.com', 'Nuevo', 'Afganistán', '12121', 'DÚO', 'Captura.PNG', 2, '2023-02-02');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `destino`
--
ALTER TABLE `destino`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `precios`
--
ALTER TABLE `precios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viaje`
--
ALTER TABLE `viaje`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `destino`
--
ALTER TABLE `destino`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT de la tabla `precios`
--
ALTER TABLE `precios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `viaje`
--
ALTER TABLE `viaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
