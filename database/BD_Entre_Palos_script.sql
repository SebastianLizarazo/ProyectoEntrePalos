-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-06-2021 a las 13:45:52
-- Versión del servidor: 5.7.24
-- Versión de PHP: 8.0.3

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdentrepalos`
--
CREATE DATABASE bdentrepalos;
use bdentrepalos;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumotrabajador`
--

CREATE TABLE `consumotrabajador` (
                                     `id` int(11) NOT NULL,
                                     `Pago_id` smallint(5) UNSIGNED DEFAULT NULL,
                                     `Producto_id` int(10) UNSIGNED DEFAULT NULL,
                                     `CantidadProducto` tinyint(3) UNSIGNED DEFAULT NULL,
                                     `Descripcion` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `consumotrabajador`
--

INSERT INTO `consumotrabajador` (`id`, `Pago_id`, `Producto_id`, `CantidadProducto`, `Descripcion`) VALUES
(1, 1, 1, 22, 'djdjjdskskskwmwmmww rfr r'),
(2, 1, 5, 12, 'efefefefe vfgdrg seirgsidfhgpsrhg suidfg'),
(3, 6, 5, 33, '2fvvvvvv');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
                                `id` bigint(20) UNSIGNED NOT NULL,
                                `nombre` varchar(90) NOT NULL,
                                `region` enum('Caribe','Centro Oriente','Centro Sur','Eje Cafetero - Antioquia','Llano','Pacífico') NOT NULL,
                                `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo',
                                `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                                `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                                `deleted_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id`, `nombre`, `region`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'ANTIOQUIA', 'Eje Cafetero - Antioquia', 'Activo', NULL, NULL, NULL),
(8, 'ATLÁNTICO', 'Caribe', 'Activo', NULL, NULL, NULL),
(11, 'BOGOTÁ. D.C', 'Centro Oriente', 'Activo', NULL, NULL, NULL),
(13, 'BOLÍVAR', 'Caribe', 'Activo', NULL, NULL, NULL),
(15, 'BOYACÁ', 'Centro Oriente', 'Activo', NULL, NULL, NULL),
(17, 'CALDAS', 'Eje Cafetero - Antioquia', 'Activo', NULL, NULL, NULL),
(18, 'CAQUETÁ', 'Centro Sur', 'Activo', NULL, NULL, NULL),
(19, 'CAUCA', 'Pacífico', 'Activo', NULL, NULL, NULL),
(20, 'CESAR', 'Caribe', 'Activo', NULL, NULL, NULL),
(23, 'CÓRDOBA', 'Caribe', 'Activo', NULL, NULL, NULL),
(25, 'CUNDINAMARCA', 'Centro Oriente', 'Activo', NULL, NULL, NULL),
(27, 'CHOCÓ', 'Pacífico', 'Activo', NULL, NULL, NULL),
(41, 'HUILA', 'Centro Sur', 'Activo', NULL, NULL, NULL),
(44, 'LA GUAJIRA', 'Caribe', 'Activo', NULL, NULL, NULL),
(47, 'MAGDALENA', 'Caribe', 'Activo', NULL, NULL, NULL),
(50, 'META', 'Llano', 'Activo', NULL, NULL, NULL),
(52, 'NARIÑO', 'Pacífico', 'Activo', NULL, NULL, NULL),
(54, 'NORTE DE SANTANDER', 'Centro Oriente', 'Activo', NULL, NULL, NULL),
(63, 'QUINDIO', 'Eje Cafetero - Antioquia', 'Activo', NULL, NULL, NULL),
(66, 'RISARALDA', 'Eje Cafetero - Antioquia', 'Activo', NULL, NULL, NULL),
(68, 'SANTANDER', 'Centro Oriente', 'Activo', NULL, NULL, NULL),
(70, 'SUCRE', 'Caribe', 'Activo', NULL, NULL, NULL),
(73, 'TOLIMA', 'Centro Sur', 'Activo', NULL, NULL, NULL),
(76, 'VALLE DEL CAUCA', 'Pacífico', 'Activo', NULL, NULL, NULL),
(81, 'ARAUCA', 'Llano', 'Activo', NULL, NULL, NULL),
(85, 'CASANARE', 'Llano', 'Activo', NULL, NULL, NULL),
(86, 'PUTUMAYO', 'Centro Sur', 'Activo', NULL, NULL, NULL),
(88, 'ARCHIPIÉLAGO DE SAN ANDRÉS, PROVIDENCIA Y SANTA CATALINA', 'Caribe', 'Activo', NULL, NULL, NULL),
(91, 'AMAZONAS', 'Centro Sur', 'Activo', NULL, NULL, NULL),
(94, 'GUAINÁ', 'Llano', 'Activo', NULL, NULL, NULL),
(95, 'GUAVIARE', 'Llano', 'Activo', NULL, NULL, NULL),
(97, 'VAUPÉS', 'Llano', 'Activo', NULL, NULL, NULL),
(99, 'VICHADA', 'Llano', 'Activo', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleoferta`
--

CREATE TABLE `detalleoferta` (
                                 `id` int(11) NOT NULL,
                                 `Producto_id` int(10) UNSIGNED NOT NULL,
                                 `Oferta_id` int(11) NOT NULL,
                                 `CantidadProducto` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalleoferta`
--

INSERT INTO `detalleoferta` (`id`, `Producto_id`, `Oferta_id`, `CantidadProducto`) VALUES
(1, 1, 2, 24),
(2, 3, 1, 33),
(3, 2, 3, 2),
(4, 1, 2, 12),
(5, 5, 2, 32),
(6, 5, 3, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallepedido`
--

CREATE TABLE `detallepedido` (
                                 `id` mediumint(9) NOT NULL,
                                 `Factura_id` int(10) UNSIGNED NOT NULL,
                                 `Producto_id` int(10) UNSIGNED DEFAULT NULL,
                                 `Ofertas_id` int(11) DEFAULT NULL,
                                 `CantidadProducto` smallint(6) DEFAULT NULL,
                                 `CantidadOferta` smallint(6) DEFAULT NULL,
                                 `Mesa_id` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detallepedido`
--

INSERT INTO `detallepedido` (`id`, `Factura_id`, `Producto_id`, `Ofertas_id`, `CantidadProducto`, `CantidadOferta`, `Mesa_id`) VALUES
(1, 1, 1, NULL, 3, NULL, 1),
(2, 2, NULL, 1, NULL, 3, 3),
(3, 1, 1, NULL, 3, NULL, 1),
(4, 1, 2, NULL, 1, NULL, 1),
(5, 3, 2, NULL, 1, NULL, 4),
(6, 1, 2, NULL, 7, NULL, 5),
(7, 3, 6, NULL, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
                           `id` smallint(6) NOT NULL,
                           `Nombre` varchar(40) NOT NULL,
                           `NIT` varchar(20) DEFAULT '00000-00',
                           `Telefono` bigint(20) UNSIGNED NOT NULL,
                           `Direccion` varchar(50) NOT NULL,
                           `Estado` enum('Activo','Inactivo') NOT NULL,
                           `Municipio_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `Nombre`, `NIT`, `Telefono`, `Direccion`, `Estado`, `Municipio_id`) VALUES
(1, 'rrrrrrrrtsassgfs', 'ff fvfvsasv a a', 2343434342, 'vbrrgrgr', 'Activo', 17388),
(2, 'adidas', 'mm87659579', 2399288345, 'Av el dorado sssss89-333', 'Activo', 5031),
(3, 'HepicGeims', 'mm8765957', 3207654894, 'Av el Jhony 89-33', 'Activo', 41298),
(4, 'Argos', '32ed32d', 1213456457, 'dssasss2ygftf', 'Activo', 15001),
(5, 'Holcim 3.0', '23', 1234356789, 'ww3sd', 'Activo', 15047),
(6, 'Terpel', '23j2h2j3hjh', 3323232323, 'edudud333r4', 'Activo', 15114),
(7, 'Naik', '22-qwqw', 3333232525, 'edududssss', 'Activo', 13030),
(8, 'Manolin corporation', '332992jkke4e', 3213261141, 'Av el dorado 89-333', 'Activo', 15051),
(13, 'Manolin corp', '1234ititi', 3213251123, 'Av el dorado 89-333', 'Activo', 15212),
(14, 'Entiti', '454453fgfffff', 3423423411, 'Av-fofof-dldldss', 'Activo', 15226),
(15, 'Reele', '333djfsdjhdhd ddj', 3214567749, 'Av el dorado 89-333', 'Activo', 15131),
(16, 'Nike', '44k55-55', 1234567890, 'erhweifhqwaef3332', 'Activo', 17513),
(17, 'dididi', 'sdjssjjssj', 1111111111, 'ieeieiieei', 'Activo', 54344),
(18, 'rgegegssfvsrs s ', 'hhhhhhhh', 3452342534, 'gssssssssssssss', 'Activo', 15047),
(19, 'popopiopiklj', 'ik89k8k', 9999999989, 't4t45t45t45t5', 'Activo', 13030),
(20, '5t45t45t45', '54t45t4t54t', 5555555555, '55t5t5t5t', 'Activo', 17042),
(21, 'Starbucks', '3e3e333e', 3324256775, 'ddvcsdfasdfasdfadfas', 'Activo', 15051),
(22, 'IBM', '1234-55', 3029430291, ' apapapapapapas dwdwdwkskq dqdq wdq', 'Activo', 15232),
(24, 'amazon', '443r43rrrrreress', 3411112112, 'tptptptptptptptptptpt', 'Activo', 97889),
(25, 'juaj', '32ed4234342342', 3243245672, 'rkrkrkrkrfofovo fvkdrfovsodvdf', 'Activo', 15087);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
                           `id` int(10) UNSIGNED NOT NULL,
                           `Numero` smallint(5) UNSIGNED NOT NULL,
                           `Fecha` date NOT NULL,
                           `IVA` decimal(10,2) DEFAULT '0.00',
                           `MedioPago` enum('Datafono','Efectivo','Nequi','Ahorro a la mano','Daviplata') NOT NULL,
                           `Mesero_id` tinyint(3) UNSIGNED NOT NULL,
                           `Estado` enum('Pendiente','Paga','Cancelada') NOT NULL,
                           `TipoPedido` enum('Mesa','Domicilio') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id`, `Numero`, `Fecha`, `IVA`, `MedioPago`, `Mesero_id`, `Estado`, `TipoPedido`) VALUES
(1, 1, '2021-06-04', '0.19', 'Datafono', 3, 'Paga', 'Mesa'),
(2, 2, '2021-06-05', '0.19', 'Datafono', 3, 'Cancelada', 'Mesa'),
(3, 3, '2021-06-14', '0.19', 'Efectivo', 8, 'Pendiente', 'Mesa'),
(4, 4, '2018-01-15', '0.19', 'Ahorro a la mano', 4, 'Pendiente', 'Domicilio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
                          `id` int(11) NOT NULL,
                          `Nombre` varchar(45) NOT NULL,
                          `Descripcion` text NOT NULL,
                          `Ruta` varchar(150) NOT NULL,
                          `Estado` enum('Activo','Inactivo') NOT NULL,
                          `Producto_id` int(10) UNSIGNED DEFAULT NULL,
                          `Oferta_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `Nombre`, `Descripcion`, `Ruta`, `Estado`, `Producto_id`, `Oferta_id`) VALUES
(1, 'Imagen producto cerveza', 'erwerqewrq', '13-Jun-32-batman-4k-1.jpg', 'Activo', 1, NULL),
(2, 'Imagen oferta Six pack 2x1', 'dasdasdasddsadas', '13-Jun-49-VansStyle.jpg', 'Activo', NULL, 2),
(3, 'Imagen producto Hamburguesa', 'efwfdff dvbfgerger gerg e', '14-Jun-15-nike-air-jordan-1-shoes-near-chain-link-fence.jpg', 'Activo', 2, NULL),
(4, 'Imagen oferta Combo entre palos', 'dfsdfdffeefefefefefe', '14-Jun-18-HypeBeast.jpeg', 'Activo', NULL, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
                         `id` int(10) UNSIGNED NOT NULL,
                         `Nombre` varchar(45) NOT NULL,
                         `Descripcion` text NOT NULL,
                         `Proveedor_id` tinyint(3) UNSIGNED NOT NULL,
                         `Estado` enum('Activa','Inactiva') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`id`, `Nombre`, `Descripcion`, `Proveedor_id`, `Estado`) VALUES
(1, 'uuuuu', 'yyyyy', 2, 'Activa'),
(2, 'Campollo', 'Pollo', 1, 'Activa'),
(3, 'Campollo', 'Alitas', 1, 'Inactiva'),
(4, 'Alpina', 'Leche entera y deslactozada', 2, 'Activa'),
(5, 'Zenu', 'Jamon', 2, 'Inactiva'),
(6, 'Aguila', 'Cerveza', 2, 'Activa'),
(7, 'Pepsi', 'Marca de gaseosa super famosa sdhjfjhs', 2, 'Activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa`
--

CREATE TABLE `mesa` (
                        `id` tinyint(3) UNSIGNED NOT NULL,
                        `Numero` tinyint(3) UNSIGNED NOT NULL,
                        `Ubicacion` varchar(30) NOT NULL,
                        `Capacidad` tinyint(4) NOT NULL,
                        `Ocupacion` enum('disponible','ocupada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mesa`
--

INSERT INTO `mesa` (`id`, `Numero`, `Ubicacion`, `Capacidad`, `Ocupacion`) VALUES
(1, 1, 'Pasillo', 54, 'disponible'),
(2, 2, 'casa 2', 5, 'ocupada'),
(3, 3, 'Centro', 3, 'disponible'),
(4, 4, 'Balcon 3', 5, 'disponible'),
(5, 5, 'Terrasa', 12, 'disponible'),
(6, 6, 'Segundo piso', 122, 'disponible'),
(7, 7, 'Terrasa', 7, 'ocupada'),
(8, 8, 'euerudfheuidhaoe', 6, 'disponible'),
(9, 9, 'Casa 2', 20, 'disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
                             `id` bigint(20) UNSIGNED NOT NULL,
                             `nombre` varchar(90) COLLATE utf8_bin NOT NULL,
                             `departamento_id` bigint(20) UNSIGNED NOT NULL,
                             `acortado` varchar(40) COLLATE utf8_bin DEFAULT NULL,
                             `estado` enum('Activo','Inactivo') COLLATE utf8_bin NOT NULL DEFAULT 'Activo',
                             `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                             `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                             `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id`, `nombre`, `departamento_id`, `acortado`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5001, 'Medellín', 5, NULL, 'Activo', NULL, NULL, NULL),
(5002, 'Abejorral', 5, NULL, 'Activo', NULL, NULL, NULL),
(5004, 'Abriaquí', 5, NULL, 'Activo', NULL, NULL, NULL),
(5021, 'Alejandría', 5, NULL, 'Activo', NULL, NULL, NULL),
(5030, 'Amagá', 5, NULL, 'Activo', NULL, NULL, NULL),
(5031, 'Amalfi', 5, NULL, 'Activo', NULL, NULL, NULL),
(5034, 'Andes', 5, NULL, 'Activo', NULL, NULL, NULL),
(5036, 'Angelópolis', 5, NULL, 'Activo', NULL, NULL, NULL),
(5038, 'Angostura', 5, NULL, 'Activo', NULL, NULL, NULL),
(5040, 'Anorí', 5, NULL, 'Activo', NULL, NULL, NULL),
(5042, 'Santafé de Antioquia', 5, NULL, 'Activo', NULL, NULL, NULL),
(5044, 'Anza', 5, NULL, 'Activo', NULL, NULL, NULL),
(5045, 'Apartadó', 5, NULL, 'Activo', NULL, NULL, NULL),
(5051, 'Arboletes', 5, NULL, 'Activo', NULL, NULL, NULL),
(5055, 'Argelia', 5, NULL, 'Activo', NULL, NULL, NULL),
(5059, 'Armenia', 5, NULL, 'Activo', NULL, NULL, NULL),
(5079, 'Barbosa', 5, NULL, 'Activo', NULL, NULL, NULL),
(5086, 'Belmira', 5, NULL, 'Activo', NULL, NULL, NULL),
(5088, 'Bello', 5, NULL, 'Activo', NULL, NULL, NULL),
(5091, 'Betania', 5, NULL, 'Activo', NULL, NULL, NULL),
(5093, 'Betulia', 5, NULL, 'Activo', NULL, NULL, NULL),
(5101, 'Ciudad Bolívar', 5, NULL, 'Activo', NULL, NULL, NULL),
(5107, 'Briceño', 5, NULL, 'Activo', NULL, NULL, NULL),
(5113, 'Buriticá', 5, NULL, 'Activo', NULL, NULL, NULL),
(5120, 'Cáceres', 5, NULL, 'Activo', NULL, NULL, NULL),
(5125, 'Caicedo', 5, NULL, 'Activo', NULL, NULL, NULL),
(5129, 'Caldas', 5, NULL, 'Activo', NULL, NULL, NULL),
(5134, 'Campamento', 5, NULL, 'Activo', NULL, NULL, NULL),
(5138, 'Cañasgordas', 5, NULL, 'Activo', NULL, NULL, NULL),
(5142, 'Caracolí', 5, NULL, 'Activo', NULL, NULL, NULL),
(5145, 'Caramanta', 5, NULL, 'Activo', NULL, NULL, NULL),
(5147, 'Carepa', 5, NULL, 'Activo', NULL, NULL, NULL),
(5148, 'El Carmen de Viboral', 5, NULL, 'Activo', NULL, NULL, NULL),
(5150, 'Carolina', 5, NULL, 'Activo', NULL, NULL, NULL),
(5154, 'Caucasia', 5, NULL, 'Activo', NULL, NULL, NULL),
(5172, 'Chigorodó', 5, NULL, 'Activo', NULL, NULL, NULL),
(5190, 'Cisneros', 5, NULL, 'Activo', NULL, NULL, NULL),
(5197, 'Cocorná', 5, NULL, 'Activo', NULL, NULL, NULL),
(5206, 'Concepción', 5, NULL, 'Activo', NULL, NULL, NULL),
(5209, 'Concordia', 5, NULL, 'Activo', NULL, NULL, NULL),
(5212, 'Copacabana', 5, NULL, 'Activo', NULL, NULL, NULL),
(5234, 'Dabeiba', 5, NULL, 'Activo', NULL, NULL, NULL),
(5237, 'Don Matías', 5, NULL, 'Activo', NULL, NULL, NULL),
(5240, 'Ebéjico', 5, NULL, 'Activo', NULL, NULL, NULL),
(5250, 'El Bagre', 5, NULL, 'Activo', NULL, NULL, NULL),
(5264, 'Entrerrios', 5, NULL, 'Activo', NULL, NULL, NULL),
(5266, 'Envigado', 5, NULL, 'Activo', NULL, NULL, NULL),
(5282, 'Fredonia', 5, NULL, 'Activo', NULL, NULL, NULL),
(5284, 'Frontino', 5, NULL, 'Activo', NULL, NULL, NULL),
(5306, 'Giraldo', 5, NULL, 'Activo', NULL, NULL, NULL),
(5308, 'Girardota', 5, NULL, 'Activo', NULL, NULL, NULL),
(5310, 'Gómez Plata', 5, NULL, 'Activo', NULL, NULL, NULL),
(5313, 'Granada', 5, NULL, 'Activo', NULL, NULL, NULL),
(5315, 'Guadalupe', 5, NULL, 'Activo', NULL, NULL, NULL),
(5318, 'Guarne', 5, NULL, 'Activo', NULL, NULL, NULL),
(5321, 'Guatapé', 5, NULL, 'Activo', NULL, NULL, NULL),
(5347, 'Heliconia', 5, NULL, 'Activo', NULL, NULL, NULL),
(5353, 'Hispania', 5, NULL, 'Activo', NULL, NULL, NULL),
(5360, 'Itagui', 5, NULL, 'Activo', NULL, NULL, NULL),
(5361, 'Ituango', 5, NULL, 'Activo', NULL, NULL, NULL),
(5364, 'Jardín', 5, NULL, 'Activo', NULL, NULL, NULL),
(5368, 'Jericó', 5, NULL, 'Activo', NULL, NULL, NULL),
(5376, 'La Ceja', 5, NULL, 'Activo', NULL, NULL, NULL),
(5380, 'La Estrella', 5, NULL, 'Activo', NULL, NULL, NULL),
(5390, 'La Pintada', 5, NULL, 'Activo', NULL, NULL, NULL),
(5400, 'La Unión', 5, NULL, 'Activo', NULL, NULL, NULL),
(5411, 'Liborina', 5, NULL, 'Activo', NULL, NULL, NULL),
(5425, 'Maceo', 5, NULL, 'Activo', NULL, NULL, NULL),
(5440, 'Marinilla', 5, NULL, 'Activo', NULL, NULL, NULL),
(5467, 'Montebello', 5, NULL, 'Activo', NULL, NULL, NULL),
(5475, 'Murindó', 5, NULL, 'Activo', NULL, NULL, NULL),
(5480, 'Mutatá', 5, NULL, 'Activo', NULL, NULL, NULL),
(5483, 'Nariño', 5, NULL, 'Activo', NULL, NULL, NULL),
(5490, 'Necoclí', 5, NULL, 'Activo', NULL, NULL, NULL),
(5495, 'Nechí', 5, NULL, 'Activo', NULL, NULL, NULL),
(5501, 'Olaya', 5, NULL, 'Activo', NULL, NULL, NULL),
(5541, 'Peñol', 5, NULL, 'Activo', NULL, NULL, NULL),
(5543, 'Peque', 5, NULL, 'Activo', NULL, NULL, NULL),
(5576, 'Pueblorrico', 5, NULL, 'Activo', NULL, NULL, NULL),
(5579, 'Puerto Berrío', 5, NULL, 'Activo', NULL, NULL, NULL),
(5585, 'Puerto Nare', 5, NULL, 'Activo', NULL, NULL, NULL),
(5591, 'Puerto Triunfo', 5, NULL, 'Activo', NULL, NULL, NULL),
(5604, 'Remedios', 5, NULL, 'Activo', NULL, NULL, NULL),
(5607, 'Retiro', 5, NULL, 'Activo', NULL, NULL, NULL),
(5615, 'Rionegro', 5, NULL, 'Activo', NULL, NULL, NULL),
(5628, 'Sabanalarga', 5, NULL, 'Activo', NULL, NULL, NULL),
(5631, 'Sabaneta', 5, NULL, 'Activo', NULL, NULL, NULL),
(5642, 'Salgar', 5, NULL, 'Activo', NULL, NULL, NULL),
(5647, 'San Andrés de Cuerquía', 5, NULL, 'Activo', NULL, NULL, NULL),
(5649, 'San Carlos', 5, NULL, 'Activo', NULL, NULL, NULL),
(5652, 'San Francisco', 5, NULL, 'Activo', NULL, NULL, NULL),
(5656, 'San Jerónimo', 5, NULL, 'Activo', NULL, NULL, NULL),
(5658, 'San José de La Montaña', 5, NULL, 'Activo', NULL, NULL, NULL),
(5659, 'San Juan de Urabá', 5, NULL, 'Activo', NULL, NULL, NULL),
(5660, 'San Luis', 5, NULL, 'Activo', NULL, NULL, NULL),
(5664, 'San Pedro', 5, NULL, 'Activo', NULL, NULL, NULL),
(5665, 'San Pedro de Uraba', 5, NULL, 'Activo', NULL, NULL, NULL),
(5667, 'San Rafael', 5, NULL, 'Activo', NULL, NULL, NULL),
(5670, 'San Roque', 5, NULL, 'Activo', NULL, NULL, NULL),
(5674, 'San Vicente', 5, NULL, 'Activo', NULL, NULL, NULL),
(5679, 'Santa Bárbara', 5, NULL, 'Activo', NULL, NULL, NULL),
(5686, 'Santa Rosa de Osos', 5, NULL, 'Activo', NULL, NULL, NULL),
(5690, 'Santo Domingo', 5, NULL, 'Activo', NULL, NULL, NULL),
(5697, 'El Santuario', 5, NULL, 'Activo', NULL, NULL, NULL),
(5736, 'Segovia', 5, NULL, 'Activo', NULL, NULL, NULL),
(5756, 'Sonsón', 5, NULL, 'Activo', NULL, NULL, NULL),
(5761, 'Sopetrán', 5, NULL, 'Activo', NULL, NULL, NULL),
(5789, 'Támesis', 5, NULL, 'Activo', NULL, NULL, NULL),
(5790, 'Tarazá', 5, NULL, 'Activo', NULL, NULL, NULL),
(5792, 'Tarso', 5, NULL, 'Activo', NULL, NULL, NULL),
(5809, 'Titiribí', 5, NULL, 'Activo', NULL, NULL, NULL),
(5819, 'Toledo', 5, NULL, 'Activo', NULL, NULL, NULL),
(5837, 'Turbo', 5, NULL, 'Activo', NULL, NULL, NULL),
(5842, 'Uramita', 5, NULL, 'Activo', NULL, NULL, NULL),
(5847, 'Urrao', 5, NULL, 'Activo', NULL, NULL, NULL),
(5854, 'Valdivia', 5, NULL, 'Activo', NULL, NULL, NULL),
(5856, 'Valparaíso', 5, NULL, 'Activo', NULL, NULL, NULL),
(5858, 'Vegachí', 5, NULL, 'Activo', NULL, NULL, NULL),
(5861, 'Venecia', 5, NULL, 'Activo', NULL, NULL, NULL),
(5873, 'Vigía del Fuerte', 5, NULL, 'Activo', NULL, NULL, NULL),
(5885, 'Yalí', 5, NULL, 'Activo', NULL, NULL, NULL),
(5887, 'Yarumal', 5, NULL, 'Activo', NULL, NULL, NULL),
(5890, 'Yolombó', 5, NULL, 'Activo', NULL, NULL, NULL),
(5893, 'Yondó', 5, NULL, 'Activo', NULL, NULL, NULL),
(5895, 'Zaragoza', 5, NULL, 'Activo', NULL, NULL, NULL),
(8001, 'Barranquilla', 8, NULL, 'Activo', NULL, NULL, NULL),
(8078, 'Baranoa', 8, NULL, 'Activo', NULL, NULL, NULL),
(8137, 'Campo de La Cruz', 8, NULL, 'Activo', NULL, NULL, NULL),
(8141, 'Candelaria', 8, NULL, 'Activo', NULL, NULL, NULL),
(8296, 'Galapa', 8, NULL, 'Activo', NULL, NULL, NULL),
(8372, 'Juan de Acosta', 8, NULL, 'Activo', NULL, NULL, NULL),
(8421, 'Luruaco', 8, NULL, 'Activo', NULL, NULL, NULL),
(8433, 'Malambo', 8, NULL, 'Activo', NULL, NULL, NULL),
(8436, 'Manatí', 8, NULL, 'Activo', NULL, NULL, NULL),
(8520, 'Palmar de Varela', 8, NULL, 'Activo', NULL, NULL, NULL),
(8549, 'Piojó', 8, NULL, 'Activo', NULL, NULL, NULL),
(8558, 'Polonuevo', 8, NULL, 'Activo', NULL, NULL, NULL),
(8560, 'Ponedera', 8, NULL, 'Activo', NULL, NULL, NULL),
(8573, 'Puerto Colombia', 8, NULL, 'Activo', NULL, NULL, NULL),
(8606, 'Repelón', 8, NULL, 'Activo', NULL, NULL, NULL),
(8634, 'Sabanagrande', 8, NULL, 'Activo', NULL, NULL, NULL),
(8638, 'Sabanalarga', 8, NULL, 'Activo', NULL, NULL, NULL),
(8675, 'Santa Lucía', 8, NULL, 'Activo', NULL, NULL, NULL),
(8685, 'Santo Tomás', 8, NULL, 'Activo', NULL, NULL, NULL),
(8758, 'Soledad', 8, NULL, 'Activo', NULL, NULL, NULL),
(8770, 'Suan', 8, NULL, 'Activo', NULL, NULL, NULL),
(8832, 'Tubará', 8, NULL, 'Activo', NULL, NULL, NULL),
(8849, 'Usiacurí', 8, NULL, 'Activo', NULL, NULL, NULL),
(11001, 'Bogotá D.C', 11, NULL, 'Activo', NULL, NULL, NULL),
(13001, 'Cartagena', 13, NULL, 'Activo', NULL, NULL, NULL),
(13006, 'Achí', 13, NULL, 'Activo', NULL, NULL, NULL),
(13030, 'Altos del Rosario', 13, NULL, 'Activo', NULL, NULL, NULL),
(13042, 'Arenal', 13, NULL, 'Activo', NULL, NULL, NULL),
(13052, 'Arjona', 13, NULL, 'Activo', NULL, NULL, NULL),
(13062, 'Arroyohondo', 13, NULL, 'Activo', NULL, NULL, NULL),
(13074, 'Barranco de Loba', 13, NULL, 'Activo', NULL, NULL, NULL),
(13140, 'Calamar', 13, NULL, 'Activo', NULL, NULL, NULL),
(13160, 'Cantagallo', 13, NULL, 'Activo', NULL, NULL, NULL),
(13188, 'Cicuco', 13, NULL, 'Activo', NULL, NULL, NULL),
(13212, 'Córdoba', 13, NULL, 'Activo', NULL, NULL, NULL),
(13222, 'Clemencia', 13, NULL, 'Activo', NULL, NULL, NULL),
(13244, 'El Carmen de Bolívar', 13, NULL, 'Activo', NULL, NULL, NULL),
(13248, 'El Guamo', 13, NULL, 'Activo', NULL, NULL, NULL),
(13268, 'El Peñón', 13, NULL, 'Activo', NULL, NULL, NULL),
(13300, 'Hatillo de Loba', 13, NULL, 'Activo', NULL, NULL, NULL),
(13430, 'Magangué', 13, NULL, 'Activo', NULL, NULL, NULL),
(13433, 'Mahates', 13, NULL, 'Activo', NULL, NULL, NULL),
(13440, 'Margarita', 13, NULL, 'Activo', NULL, NULL, NULL),
(13442, 'María la Baja', 13, NULL, 'Activo', NULL, NULL, NULL),
(13458, 'Montecristo', 13, NULL, 'Activo', NULL, NULL, NULL),
(13468, 'Mompós', 13, NULL, 'Activo', NULL, NULL, NULL),
(13473, 'Morales', 13, NULL, 'Activo', NULL, NULL, NULL),
(13490, 'Norosí', 13, NULL, 'Activo', NULL, NULL, NULL),
(13549, 'Pinillos', 13, NULL, 'Activo', NULL, NULL, NULL),
(13580, 'Regidor', 13, NULL, 'Activo', NULL, NULL, NULL),
(13600, 'Río Viejo', 13, NULL, 'Activo', NULL, NULL, NULL),
(13620, 'San Cristóbal', 13, NULL, 'Activo', NULL, NULL, NULL),
(13647, 'San Estanislao', 13, NULL, 'Activo', NULL, NULL, NULL),
(13650, 'San Fernando', 13, NULL, 'Activo', NULL, NULL, NULL),
(13654, 'San Jacinto', 13, NULL, 'Activo', NULL, NULL, NULL),
(13655, 'San Jacinto del Cauca', 13, NULL, 'Activo', NULL, NULL, NULL),
(13657, 'San Juan Nepomuceno', 13, NULL, 'Activo', NULL, NULL, NULL),
(13667, 'San Martín de Loba', 13, NULL, 'Activo', NULL, NULL, NULL),
(13670, 'San Pablo de Borbur', 13, NULL, 'Activo', NULL, NULL, NULL),
(13673, 'Santa Catalina', 13, NULL, 'Activo', NULL, NULL, NULL),
(13683, 'Santa Rosa', 13, NULL, 'Activo', NULL, NULL, NULL),
(13688, 'Santa Rosa del Sur', 13, NULL, 'Activo', NULL, NULL, NULL),
(13744, 'Simití', 13, NULL, 'Activo', NULL, NULL, NULL),
(13760, 'Soplaviento', 13, NULL, 'Activo', NULL, NULL, NULL),
(13780, 'Talaigua Nuevo', 13, NULL, 'Activo', NULL, NULL, NULL),
(13810, 'Tiquisio', 13, NULL, 'Activo', NULL, NULL, NULL),
(13836, 'Turbaco', 13, NULL, 'Activo', NULL, NULL, NULL),
(13838, 'Turbaná', 13, NULL, 'Activo', NULL, NULL, NULL),
(13873, 'Villanueva', 13, NULL, 'Activo', NULL, NULL, NULL),
(13894, 'Zambrano', 13, NULL, 'Activo', NULL, NULL, NULL),
(15001, 'Tunja', 15, NULL, 'Activo', NULL, NULL, NULL),
(15022, 'Almeida', 15, NULL, 'Activo', NULL, NULL, NULL),
(15047, 'Aquitania', 15, NULL, 'Activo', NULL, NULL, NULL),
(15051, 'Arcabuco', 15, NULL, 'Activo', NULL, NULL, NULL),
(15087, 'Belén', 15, NULL, 'Activo', NULL, NULL, NULL),
(15090, 'Berbeo', 15, NULL, 'Activo', NULL, NULL, NULL),
(15092, 'Betéitiva', 15, NULL, 'Activo', NULL, NULL, NULL),
(15097, 'Boavita', 15, NULL, 'Activo', NULL, NULL, NULL),
(15104, 'Boyacá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15106, 'Briceño', 15, NULL, 'Activo', NULL, NULL, NULL),
(15109, 'Buena Vista', 15, NULL, 'Activo', NULL, NULL, NULL),
(15114, 'Busbanzá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15131, 'Caldas', 15, NULL, 'Activo', NULL, NULL, NULL),
(15135, 'Campohermoso', 15, NULL, 'Activo', NULL, NULL, NULL),
(15162, 'Cerinza', 15, NULL, 'Activo', NULL, NULL, NULL),
(15172, 'Chinavita', 15, NULL, 'Activo', NULL, NULL, NULL),
(15176, 'Chiquinquirá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15180, 'Chiscas', 15, NULL, 'Activo', NULL, NULL, NULL),
(15183, 'Chita', 15, NULL, 'Activo', NULL, NULL, NULL),
(15185, 'Chitaraque', 15, NULL, 'Activo', NULL, NULL, NULL),
(15187, 'Chivatá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15189, 'Ciénega', 15, NULL, 'Activo', NULL, NULL, NULL),
(15204, 'Cómbita', 15, NULL, 'Activo', NULL, NULL, NULL),
(15212, 'Coper', 15, NULL, 'Activo', NULL, NULL, NULL),
(15215, 'Corrales', 15, NULL, 'Activo', NULL, NULL, NULL),
(15218, 'Covarachía', 15, NULL, 'Activo', NULL, NULL, NULL),
(15223, 'Cubará', 15, NULL, 'Activo', NULL, NULL, NULL),
(15224, 'Cucaita', 15, NULL, 'Activo', NULL, NULL, NULL),
(15226, 'Cuítiva', 15, NULL, 'Activo', NULL, NULL, NULL),
(15232, 'Chíquiza', 15, NULL, 'Activo', NULL, NULL, NULL),
(15236, 'Chivor', 15, NULL, 'Activo', NULL, NULL, NULL),
(15238, 'Duitama', 15, NULL, 'Activo', NULL, NULL, NULL),
(15244, 'El Cocuy', 15, NULL, 'Activo', NULL, NULL, NULL),
(15248, 'El Espino', 15, NULL, 'Activo', NULL, NULL, NULL),
(15272, 'Firavitoba', 15, NULL, 'Activo', NULL, NULL, NULL),
(15276, 'Floresta', 15, NULL, 'Activo', NULL, NULL, NULL),
(15293, 'Gachantivá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15296, 'Gameza', 15, NULL, 'Activo', NULL, NULL, NULL),
(15299, 'Garagoa', 15, NULL, 'Activo', NULL, NULL, NULL),
(15317, 'Guacamayas', 15, NULL, 'Activo', NULL, NULL, NULL),
(15322, 'Guateque', 15, NULL, 'Activo', NULL, NULL, NULL),
(15325, 'Guayatá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15332, 'Güicán', 15, NULL, 'Activo', NULL, NULL, NULL),
(15362, 'Iza', 15, NULL, 'Activo', NULL, NULL, NULL),
(15367, 'Jenesano', 15, NULL, 'Activo', NULL, NULL, NULL),
(15368, 'Jericó', 15, NULL, 'Activo', NULL, NULL, NULL),
(15377, 'Labranzagrande', 15, NULL, 'Activo', NULL, NULL, NULL),
(15380, 'La Capilla', 15, NULL, 'Activo', NULL, NULL, NULL),
(15401, 'La Victoria', 15, NULL, 'Activo', NULL, NULL, NULL),
(15403, 'La Uvita', 15, NULL, 'Activo', NULL, NULL, NULL),
(15407, 'Villa De Leyva', 15, NULL, 'Activo', NULL, NULL, NULL),
(15425, 'Macanal', 15, NULL, 'Activo', NULL, NULL, NULL),
(15442, 'Maripí', 15, NULL, 'Activo', NULL, NULL, NULL),
(15455, 'Miraflores', 15, NULL, 'Activo', NULL, NULL, NULL),
(15464, 'Mongua', 15, NULL, 'Activo', NULL, NULL, NULL),
(15466, 'Monguí', 15, NULL, 'Activo', NULL, NULL, NULL),
(15469, 'Moniquirá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15476, 'Motavita', 15, NULL, 'Activo', NULL, NULL, NULL),
(15480, 'Muzo', 15, NULL, 'Activo', NULL, NULL, NULL),
(15491, 'Nobsa', 15, NULL, 'Activo', NULL, NULL, NULL),
(15494, 'Nuevo Colón', 15, NULL, 'Activo', NULL, NULL, NULL),
(15500, 'Oicatá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15507, 'Otanche', 15, NULL, 'Activo', NULL, NULL, NULL),
(15511, 'Pachavita', 15, NULL, 'Activo', NULL, NULL, NULL),
(15514, 'Páez', 15, NULL, 'Activo', NULL, NULL, NULL),
(15516, 'Paipa', 15, NULL, 'Activo', NULL, NULL, NULL),
(15518, 'Pajarito', 15, NULL, 'Activo', NULL, NULL, NULL),
(15522, 'Panqueba', 15, NULL, 'Activo', NULL, NULL, NULL),
(15531, 'Pauna', 15, NULL, 'Activo', NULL, NULL, NULL),
(15533, 'Paya', 15, NULL, 'Activo', NULL, NULL, NULL),
(15537, 'Paz De Río', 15, NULL, 'Activo', NULL, NULL, NULL),
(15542, 'Pesca', 15, NULL, 'Activo', NULL, NULL, NULL),
(15550, 'Pisba', 15, NULL, 'Activo', NULL, NULL, NULL),
(15572, 'Puerto Boyacá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15580, 'Quípama', 15, NULL, 'Activo', NULL, NULL, NULL),
(15599, 'Ramiriquí', 15, NULL, 'Activo', NULL, NULL, NULL),
(15600, 'Ráquira', 15, NULL, 'Activo', NULL, NULL, NULL),
(15621, 'Rondón', 15, NULL, 'Activo', NULL, NULL, NULL),
(15632, 'Saboyá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15638, 'Sáchica', 15, NULL, 'Activo', NULL, NULL, NULL),
(15646, 'Samacá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15660, 'San Eduardo', 15, NULL, 'Activo', NULL, NULL, NULL),
(15664, 'San José De Pare', 15, NULL, 'Activo', NULL, NULL, NULL),
(15667, 'San Luis De Gaceno', 15, NULL, 'Activo', NULL, NULL, NULL),
(15673, 'San Mateo', 15, NULL, 'Activo', NULL, NULL, NULL),
(15676, 'San Miguel De Sema', 15, NULL, 'Activo', NULL, NULL, NULL),
(15681, 'San Pablo De Borbur', 15, NULL, 'Activo', NULL, NULL, NULL),
(15686, 'Santana', 15, NULL, 'Activo', NULL, NULL, NULL),
(15690, 'Santa María', 15, NULL, 'Activo', NULL, NULL, NULL),
(15693, 'Santa Rosa De Viterbo', 15, NULL, 'Activo', NULL, NULL, NULL),
(15696, 'Santa Sofía', 15, NULL, 'Activo', NULL, NULL, NULL),
(15720, 'Sativanorte', 15, NULL, 'Activo', NULL, NULL, NULL),
(15723, 'Sativasur', 15, NULL, 'Activo', NULL, NULL, NULL),
(15740, 'Siachoque', 15, NULL, 'Activo', NULL, NULL, NULL),
(15753, 'Soatá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15755, 'Socotá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15757, 'Socha', 15, NULL, 'Activo', NULL, NULL, NULL),
(15759, 'Sogamoso', 15, NULL, 'Activo', NULL, NULL, NULL),
(15761, 'Somondoco', 15, NULL, 'Activo', NULL, NULL, NULL),
(15762, 'Sora', 15, NULL, 'Activo', NULL, NULL, NULL),
(15763, 'Sotaquirá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15764, 'Soracá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15774, 'Susacón', 15, NULL, 'Activo', NULL, NULL, NULL),
(15776, 'Sutamarchán', 15, NULL, 'Activo', NULL, NULL, NULL),
(15778, 'Sutatenza', 15, NULL, 'Activo', NULL, NULL, NULL),
(15790, 'Tasco', 15, NULL, 'Activo', NULL, NULL, NULL),
(15798, 'Tenza', 15, NULL, 'Activo', NULL, NULL, NULL),
(15804, 'Tibaná', 15, NULL, 'Activo', NULL, NULL, NULL),
(15806, 'Tibasosa', 15, NULL, 'Activo', NULL, NULL, NULL),
(15808, 'Tinjacá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15810, 'Tipacoque', 15, NULL, 'Activo', NULL, NULL, NULL),
(15814, 'Toca', 15, NULL, 'Activo', NULL, NULL, NULL),
(15816, 'Togüí', 15, NULL, 'Activo', NULL, NULL, NULL),
(15820, 'Tópaga', 15, NULL, 'Activo', NULL, NULL, NULL),
(15822, 'Tota', 15, NULL, 'Activo', NULL, NULL, NULL),
(15832, 'Tununguá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15835, 'Turmequé', 15, NULL, 'Activo', NULL, NULL, NULL),
(15837, 'Tuta', 15, NULL, 'Activo', NULL, NULL, NULL),
(15839, 'Tutazá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15842, 'Umbita', 15, NULL, 'Activo', NULL, NULL, NULL),
(15861, 'Ventaquemada', 15, NULL, 'Activo', NULL, NULL, NULL),
(15879, 'Viracachá', 15, NULL, 'Activo', NULL, NULL, NULL),
(15897, 'Zetaquira', 15, NULL, 'Activo', NULL, NULL, NULL),
(17001, 'Manizales', 17, NULL, 'Activo', NULL, NULL, NULL),
(17013, 'Aguadas', 17, NULL, 'Activo', NULL, NULL, NULL),
(17042, 'Anserma', 17, NULL, 'Activo', NULL, NULL, NULL),
(17050, 'Aranzazu', 17, NULL, 'Activo', NULL, NULL, NULL),
(17088, 'Belalcázar', 17, NULL, 'Activo', NULL, NULL, NULL),
(17174, 'Chinchiná', 17, NULL, 'Activo', NULL, NULL, NULL),
(17272, 'Filadelfia', 17, NULL, 'Activo', NULL, NULL, NULL),
(17380, 'La Dorada', 17, NULL, 'Activo', NULL, NULL, NULL),
(17388, 'La Merced', 17, NULL, 'Activo', NULL, NULL, NULL),
(17433, 'Manzanares', 17, NULL, 'Activo', NULL, NULL, NULL),
(17442, 'Marmato', 17, NULL, 'Activo', NULL, NULL, NULL),
(17444, 'Marquetalia', 17, NULL, 'Activo', NULL, NULL, NULL),
(17446, 'Marulanda', 17, NULL, 'Activo', NULL, NULL, NULL),
(17486, 'Neira', 17, NULL, 'Activo', NULL, NULL, NULL),
(17495, 'Norcasia', 17, NULL, 'Activo', NULL, NULL, NULL),
(17513, 'Pácora', 17, NULL, 'Activo', NULL, NULL, NULL),
(17524, 'Palestina', 17, NULL, 'Activo', NULL, NULL, NULL),
(17541, 'Pensilvania', 17, NULL, 'Activo', NULL, NULL, NULL),
(17614, 'Riosucio', 17, NULL, 'Activo', NULL, NULL, NULL),
(17616, 'Risaralda', 17, NULL, 'Activo', NULL, NULL, NULL),
(17653, 'Salamina', 17, NULL, 'Activo', NULL, NULL, NULL),
(17662, 'Samaná', 17, NULL, 'Activo', NULL, NULL, NULL),
(17665, 'San José', 17, NULL, 'Activo', NULL, NULL, NULL),
(17777, 'Supía', 17, NULL, 'Activo', NULL, NULL, NULL),
(17867, 'Victoria', 17, NULL, 'Activo', NULL, NULL, NULL),
(17873, 'Villamaría', 17, NULL, 'Activo', NULL, NULL, NULL),
(17877, 'Viterbo', 17, NULL, 'Activo', NULL, NULL, NULL),
(18001, 'Florencia', 18, NULL, 'Activo', NULL, NULL, NULL),
(18029, 'Albania', 18, NULL, 'Activo', NULL, NULL, NULL),
(18094, 'Belén de Los Andaquies', 18, NULL, 'Activo', NULL, NULL, NULL),
(18150, 'Cartagena del Chairá', 18, NULL, 'Activo', NULL, NULL, NULL),
(18205, 'Curillo', 18, NULL, 'Activo', NULL, NULL, NULL),
(18247, 'El Doncello', 18, NULL, 'Activo', NULL, NULL, NULL),
(18256, 'El Paujil', 18, NULL, 'Activo', NULL, NULL, NULL),
(18410, 'La Montañita', 18, NULL, 'Activo', NULL, NULL, NULL),
(18460, 'Milán', 18, NULL, 'Activo', NULL, NULL, NULL),
(18479, 'Morelia', 18, NULL, 'Activo', NULL, NULL, NULL),
(18592, 'Puerto Rico', 18, NULL, 'Activo', NULL, NULL, NULL),
(18610, 'San José del Fragua', 18, NULL, 'Activo', NULL, NULL, NULL),
(18753, 'San Vicente del Caguán', 18, NULL, 'Activo', NULL, NULL, NULL),
(18756, 'Solano', 18, NULL, 'Activo', NULL, NULL, NULL),
(18785, 'Solita', 18, NULL, 'Activo', NULL, NULL, NULL),
(18860, 'Valparaíso', 18, NULL, 'Activo', NULL, NULL, NULL),
(19001, 'Popayán', 19, NULL, 'Activo', NULL, NULL, NULL),
(19022, 'Almaguer', 19, NULL, 'Activo', NULL, NULL, NULL),
(19050, 'Argelia', 19, NULL, 'Activo', NULL, NULL, NULL),
(19075, 'Balboa', 19, NULL, 'Activo', NULL, NULL, NULL),
(19100, 'Bolívar', 19, NULL, 'Activo', NULL, NULL, NULL),
(19110, 'Buenos Aires', 19, NULL, 'Activo', NULL, NULL, NULL),
(19130, 'Cajibío', 19, NULL, 'Activo', NULL, NULL, NULL),
(19137, 'Caldono', 19, NULL, 'Activo', NULL, NULL, NULL),
(19142, 'Caloto', 19, NULL, 'Activo', NULL, NULL, NULL),
(19212, 'Corinto', 19, NULL, 'Activo', NULL, NULL, NULL),
(19256, 'El Tambo', 19, NULL, 'Activo', NULL, NULL, NULL),
(19290, 'Florencia', 19, NULL, 'Activo', NULL, NULL, NULL),
(19300, 'Guachené', 19, NULL, 'Activo', NULL, NULL, NULL),
(19318, 'Guapi', 19, NULL, 'Activo', NULL, NULL, NULL),
(19355, 'Inzá', 19, NULL, 'Activo', NULL, NULL, NULL),
(19364, 'Jambaló', 19, NULL, 'Activo', NULL, NULL, NULL),
(19392, 'La Sierra', 19, NULL, 'Activo', NULL, NULL, NULL),
(19397, 'La Vega', 19, NULL, 'Activo', NULL, NULL, NULL),
(19418, 'López de Micay', 19, NULL, 'Activo', NULL, NULL, NULL),
(19450, 'Mercaderes', 19, NULL, 'Activo', NULL, NULL, NULL),
(19455, 'Miranda', 19, NULL, 'Activo', NULL, NULL, NULL),
(19473, 'Morales', 19, NULL, 'Activo', NULL, NULL, NULL),
(19513, 'Padilla', 19, NULL, 'Activo', NULL, NULL, NULL),
(19517, 'Páez', 19, NULL, 'Activo', NULL, NULL, NULL),
(19532, 'Patía', 19, NULL, 'Activo', NULL, NULL, NULL),
(19533, 'Piamonte', 19, NULL, 'Activo', NULL, NULL, NULL),
(19548, 'Piendamó', 19, NULL, 'Activo', NULL, NULL, NULL),
(19573, 'Puerto Tejada', 19, NULL, 'Activo', NULL, NULL, NULL),
(19585, 'Puracé', 19, NULL, 'Activo', NULL, NULL, NULL),
(19622, 'Rosas', 19, NULL, 'Activo', NULL, NULL, NULL),
(19693, 'San Sebastián', 19, NULL, 'Activo', NULL, NULL, NULL),
(19698, 'Santander de Quilichao', 19, NULL, 'Activo', NULL, NULL, NULL),
(19701, 'Santa Rosa', 19, NULL, 'Activo', NULL, NULL, NULL),
(19743, 'Silvia', 19, NULL, 'Activo', NULL, NULL, NULL),
(19760, 'Sotara', 19, NULL, 'Activo', NULL, NULL, NULL),
(19780, 'Suárez', 19, NULL, 'Activo', NULL, NULL, NULL),
(19785, 'Sucre', 19, NULL, 'Activo', NULL, NULL, NULL),
(19807, 'Timbío', 19, NULL, 'Activo', NULL, NULL, NULL),
(19809, 'Timbiquí', 19, NULL, 'Activo', NULL, NULL, NULL),
(19821, 'Toribio', 19, NULL, 'Activo', NULL, NULL, NULL),
(19824, 'Totoró', 19, NULL, 'Activo', NULL, NULL, NULL),
(19845, 'Villa Rica', 19, NULL, 'Activo', NULL, NULL, NULL),
(20001, 'Valledupar', 20, NULL, 'Activo', NULL, NULL, NULL),
(20011, 'Aguachica', 20, NULL, 'Activo', NULL, NULL, NULL),
(20013, 'Agustín Codazzi', 20, NULL, 'Activo', NULL, NULL, NULL),
(20032, 'Astrea', 20, NULL, 'Activo', NULL, NULL, NULL),
(20045, 'Becerril', 20, NULL, 'Activo', NULL, NULL, NULL),
(20060, 'Bosconia', 20, NULL, 'Activo', NULL, NULL, NULL),
(20175, 'Chimichagua', 20, NULL, 'Activo', NULL, NULL, NULL),
(20178, 'Chiriguaná', 20, NULL, 'Activo', NULL, NULL, NULL),
(20228, 'Curumaní', 20, NULL, 'Activo', NULL, NULL, NULL),
(20238, 'El Copey', 20, NULL, 'Activo', NULL, NULL, NULL),
(20250, 'El Paso', 20, NULL, 'Activo', NULL, NULL, NULL),
(20295, 'Gamarra', 20, NULL, 'Activo', NULL, NULL, NULL),
(20310, 'González', 20, NULL, 'Activo', NULL, NULL, NULL),
(20383, 'La Gloria', 20, NULL, 'Activo', NULL, NULL, NULL),
(20400, 'La Jagua de Ibirico', 20, NULL, 'Activo', NULL, NULL, NULL),
(20443, 'Manaure', 20, NULL, 'Activo', NULL, NULL, NULL),
(20517, 'Pailitas', 20, NULL, 'Activo', NULL, NULL, NULL),
(20550, 'Pelaya', 20, NULL, 'Activo', NULL, NULL, NULL),
(20570, 'Pueblo Bello', 20, NULL, 'Activo', NULL, NULL, NULL),
(20614, 'Río de Oro', 20, NULL, 'Activo', NULL, NULL, NULL),
(20621, 'La Paz', 20, NULL, 'Activo', NULL, NULL, NULL),
(20710, 'San Alberto', 20, NULL, 'Activo', NULL, NULL, NULL),
(20750, 'San Diego', 20, NULL, 'Activo', NULL, NULL, NULL),
(20770, 'San Martín', 20, NULL, 'Activo', NULL, NULL, NULL),
(20787, 'Tamalameque', 20, NULL, 'Activo', NULL, NULL, NULL),
(23001, 'Montería', 23, NULL, 'Activo', NULL, NULL, NULL),
(23068, 'Ayapel', 23, NULL, 'Activo', NULL, NULL, NULL),
(23079, 'Buenavista', 23, NULL, 'Activo', NULL, NULL, NULL),
(23090, 'Canalete', 23, NULL, 'Activo', NULL, NULL, NULL),
(23162, 'Cereté', 23, NULL, 'Activo', NULL, NULL, NULL),
(23168, 'Chimá', 23, NULL, 'Activo', NULL, NULL, NULL),
(23182, 'Chinú', 23, NULL, 'Activo', NULL, NULL, NULL),
(23189, 'Ciénaga de Oro', 23, NULL, 'Activo', NULL, NULL, NULL),
(23300, 'Cotorra', 23, NULL, 'Activo', NULL, NULL, NULL),
(23350, 'La Apartada', 23, NULL, 'Activo', NULL, NULL, NULL),
(23417, 'Lorica', 23, NULL, 'Activo', NULL, NULL, NULL),
(23419, 'Los Córdobas', 23, NULL, 'Activo', NULL, NULL, NULL),
(23464, 'Momil', 23, NULL, 'Activo', NULL, NULL, NULL),
(23466, 'Montelíbano', 23, NULL, 'Activo', NULL, NULL, NULL),
(23500, 'Moñitos', 23, NULL, 'Activo', NULL, NULL, NULL),
(23555, 'Planeta Rica', 23, NULL, 'Activo', NULL, NULL, NULL),
(23570, 'Pueblo Nuevo', 23, NULL, 'Activo', NULL, NULL, NULL),
(23574, 'Puerto Escondido', 23, NULL, 'Activo', NULL, NULL, NULL),
(23580, 'Puerto Libertador', 23, NULL, 'Activo', NULL, NULL, NULL),
(23586, 'Purísima', 23, NULL, 'Activo', NULL, NULL, NULL),
(23660, 'Sahagún', 23, NULL, 'Activo', NULL, NULL, NULL),
(23670, 'San Andrés Sotavento', 23, NULL, 'Activo', NULL, NULL, NULL),
(23672, 'San Antero', 23, NULL, 'Activo', NULL, NULL, NULL),
(23675, 'San Bernardo del Viento', 23, NULL, 'Activo', NULL, NULL, NULL),
(23678, 'San Carlos', 23, NULL, 'Activo', NULL, NULL, NULL),
(23682, 'San José de Uré', 23, NULL, 'Activo', NULL, NULL, NULL),
(23686, 'San Pelayo', 23, NULL, 'Activo', NULL, NULL, NULL),
(23807, 'Tierralta', 23, NULL, 'Activo', NULL, NULL, NULL),
(23815, 'Tuchín', 23, NULL, 'Activo', NULL, NULL, NULL),
(23855, 'Valencia', 23, NULL, 'Activo', NULL, NULL, NULL),
(25001, 'Agua de Dios', 25, NULL, 'Activo', NULL, NULL, NULL),
(25019, 'Albán', 25, NULL, 'Activo', NULL, NULL, NULL),
(25035, 'Anapoima', 25, NULL, 'Activo', NULL, NULL, NULL),
(25040, 'Anolaima', 25, NULL, 'Activo', NULL, NULL, NULL),
(25053, 'Arbeláez', 25, NULL, 'Activo', NULL, NULL, NULL),
(25086, 'Beltrán', 25, NULL, 'Activo', NULL, NULL, NULL),
(25095, 'Bituima', 25, NULL, 'Activo', NULL, NULL, NULL),
(25099, 'Bojacá', 25, NULL, 'Activo', NULL, NULL, NULL),
(25120, 'Cabrera', 25, NULL, 'Activo', NULL, NULL, NULL),
(25123, 'Cachipay', 25, NULL, 'Activo', NULL, NULL, NULL),
(25126, 'Cajicá', 25, NULL, 'Activo', NULL, NULL, NULL),
(25148, 'Caparrapí', 25, NULL, 'Activo', NULL, NULL, NULL),
(25151, 'Caqueza', 25, NULL, 'Activo', NULL, NULL, NULL),
(25154, 'Carmen de Carupa', 25, NULL, 'Activo', NULL, NULL, NULL),
(25168, 'Chaguaní', 25, NULL, 'Activo', NULL, NULL, NULL),
(25175, 'Chía', 25, NULL, 'Activo', NULL, NULL, NULL),
(25178, 'Chipaque', 25, NULL, 'Activo', NULL, NULL, NULL),
(25181, 'Choachí', 25, NULL, 'Activo', NULL, NULL, NULL),
(25183, 'Chocontá', 25, NULL, 'Activo', NULL, NULL, NULL),
(25200, 'Cogua', 25, NULL, 'Activo', NULL, NULL, NULL),
(25214, 'Cota', 25, NULL, 'Activo', NULL, NULL, NULL),
(25224, 'Cucunubá', 25, NULL, 'Activo', NULL, NULL, NULL),
(25245, 'El Colegio', 25, NULL, 'Activo', NULL, NULL, NULL),
(25258, 'El Peñón', 25, NULL, 'Activo', NULL, NULL, NULL),
(25260, 'El Rosal', 25, NULL, 'Activo', NULL, NULL, NULL),
(25269, 'Facatativá', 25, NULL, 'Activo', NULL, NULL, NULL),
(25279, 'Fomeque', 25, NULL, 'Activo', NULL, NULL, NULL),
(25281, 'Fosca', 25, NULL, 'Activo', NULL, NULL, NULL),
(25286, 'Funza', 25, NULL, 'Activo', NULL, NULL, NULL),
(25288, 'Fúquene', 25, NULL, 'Activo', NULL, NULL, NULL),
(25290, 'Fusagasugá', 25, NULL, 'Activo', NULL, NULL, NULL),
(25293, 'Gachala', 25, NULL, 'Activo', NULL, NULL, NULL),
(25295, 'Gachancipá', 25, NULL, 'Activo', NULL, NULL, NULL),
(25297, 'Gachetá', 25, NULL, 'Activo', NULL, NULL, NULL),
(25299, 'Gama', 25, NULL, 'Activo', NULL, NULL, NULL),
(25307, 'Girardot', 25, NULL, 'Activo', NULL, NULL, NULL),
(25312, 'Granada', 25, NULL, 'Activo', NULL, NULL, NULL),
(25317, 'Guachetá', 25, NULL, 'Activo', NULL, NULL, NULL),
(25320, 'Guaduas', 25, NULL, 'Activo', NULL, NULL, NULL),
(25322, 'Guasca', 25, NULL, 'Activo', NULL, NULL, NULL),
(25324, 'Guataquí', 25, NULL, 'Activo', NULL, NULL, NULL),
(25326, 'Guatavita', 25, NULL, 'Activo', NULL, NULL, NULL),
(25328, 'Guayabal de Siquima', 25, NULL, 'Activo', NULL, NULL, NULL),
(25335, 'Guayabetal', 25, NULL, 'Activo', NULL, NULL, NULL),
(25339, 'Gutiérrez', 25, NULL, 'Activo', NULL, NULL, NULL),
(25368, 'Jerusalén', 25, NULL, 'Activo', NULL, NULL, NULL),
(25372, 'Junín', 25, NULL, 'Activo', NULL, NULL, NULL),
(25377, 'La Calera', 25, NULL, 'Activo', NULL, NULL, NULL),
(25386, 'La Mesa', 25, NULL, 'Activo', NULL, NULL, NULL),
(25394, 'La Palma', 25, NULL, 'Activo', NULL, NULL, NULL),
(25398, 'La Peña', 25, NULL, 'Activo', NULL, NULL, NULL),
(25402, 'La Vega', 25, NULL, 'Activo', NULL, NULL, NULL),
(25407, 'Lenguazaque', 25, NULL, 'Activo', NULL, NULL, NULL),
(25426, 'Macheta', 25, NULL, 'Activo', NULL, NULL, NULL),
(25430, 'Madrid', 25, NULL, 'Activo', NULL, NULL, NULL),
(25436, 'Manta', 25, NULL, 'Activo', NULL, NULL, NULL),
(25438, 'Medina', 25, NULL, 'Activo', NULL, NULL, NULL),
(25473, 'Mosquera', 25, NULL, 'Activo', NULL, NULL, NULL),
(25483, 'Nariño', 25, NULL, 'Activo', NULL, NULL, NULL),
(25486, 'Nemocón', 25, NULL, 'Activo', NULL, NULL, NULL),
(25488, 'Nilo', 25, NULL, 'Activo', NULL, NULL, NULL),
(25489, 'Nimaima', 25, NULL, 'Activo', NULL, NULL, NULL),
(25491, 'Nocaima', 25, NULL, 'Activo', NULL, NULL, NULL),
(25506, 'Venecia', 25, NULL, 'Activo', NULL, NULL, NULL),
(25513, 'Pacho', 25, NULL, 'Activo', NULL, NULL, NULL),
(25518, 'Paime', 25, NULL, 'Activo', NULL, NULL, NULL),
(25524, 'Pandi', 25, NULL, 'Activo', NULL, NULL, NULL),
(25530, 'Paratebueno', 25, NULL, 'Activo', NULL, NULL, NULL),
(25535, 'Pasca', 25, NULL, 'Activo', NULL, NULL, NULL),
(25572, 'Puerto Salgar', 25, NULL, 'Activo', NULL, NULL, NULL),
(25580, 'Pulí', 25, NULL, 'Activo', NULL, NULL, NULL),
(25592, 'Quebradanegra', 25, NULL, 'Activo', NULL, NULL, NULL),
(25594, 'Quetame', 25, NULL, 'Activo', NULL, NULL, NULL),
(25596, 'Quipile', 25, NULL, 'Activo', NULL, NULL, NULL),
(25599, 'Apulo', 25, NULL, 'Activo', NULL, NULL, NULL),
(25612, 'Ricaurte', 25, NULL, 'Activo', NULL, NULL, NULL),
(25645, 'San Antonio del Tequendama', 25, NULL, 'Activo', NULL, NULL, NULL),
(25649, 'San Bernardo', 25, NULL, 'Activo', NULL, NULL, NULL),
(25653, 'San Cayetano', 25, NULL, 'Activo', NULL, NULL, NULL),
(25658, 'San Francisco', 25, NULL, 'Activo', NULL, NULL, NULL),
(25662, 'San Juan de Río Seco', 25, NULL, 'Activo', NULL, NULL, NULL),
(25718, 'Sasaima', 25, NULL, 'Activo', NULL, NULL, NULL),
(25736, 'Sesquilé', 25, NULL, 'Activo', NULL, NULL, NULL),
(25740, 'Sibaté', 25, NULL, 'Activo', NULL, NULL, NULL),
(25743, 'Silvania', 25, NULL, 'Activo', NULL, NULL, NULL),
(25745, 'Simijaca', 25, NULL, 'Activo', NULL, NULL, NULL),
(25754, 'Soacha', 25, NULL, 'Activo', NULL, NULL, NULL),
(25758, 'Sopó', 25, NULL, 'Activo', NULL, NULL, NULL),
(25769, 'Subachoque', 25, NULL, 'Activo', NULL, NULL, NULL),
(25772, 'Suesca', 25, NULL, 'Activo', NULL, NULL, NULL),
(25777, 'Supatá', 25, NULL, 'Activo', NULL, NULL, NULL),
(25779, 'Susa', 25, NULL, 'Activo', NULL, NULL, NULL),
(25781, 'Sutatausa', 25, NULL, 'Activo', NULL, NULL, NULL),
(25785, 'Tabio', 25, NULL, 'Activo', NULL, NULL, NULL),
(25793, 'Tausa', 25, NULL, 'Activo', NULL, NULL, NULL),
(25797, 'Tena', 25, NULL, 'Activo', NULL, NULL, NULL),
(25799, 'Tenjo', 25, NULL, 'Activo', NULL, NULL, NULL),
(25805, 'Tibacuy', 25, NULL, 'Activo', NULL, NULL, NULL),
(25807, 'Tibirita', 25, NULL, 'Activo', NULL, NULL, NULL),
(25815, 'Tocaima', 25, NULL, 'Activo', NULL, NULL, NULL),
(25817, 'Tocancipá', 25, NULL, 'Activo', NULL, NULL, NULL),
(25823, 'Topaipí', 25, NULL, 'Activo', NULL, NULL, NULL),
(25839, 'Ubalá', 25, NULL, 'Activo', NULL, NULL, NULL),
(25841, 'Ubaque', 25, NULL, 'Activo', NULL, NULL, NULL),
(25843, 'Villa De San Diego De Ubate', 25, NULL, 'Activo', NULL, NULL, NULL),
(25845, 'Une', 25, NULL, 'Activo', NULL, NULL, NULL),
(25851, 'Útica', 25, NULL, 'Activo', NULL, NULL, NULL),
(25862, 'Vergara', 25, NULL, 'Activo', NULL, NULL, NULL),
(25867, 'Vianí', 25, NULL, 'Activo', NULL, NULL, NULL),
(25871, 'Villagómez', 25, NULL, 'Activo', NULL, NULL, NULL),
(25873, 'Villapinzón', 25, NULL, 'Activo', NULL, NULL, NULL),
(25875, 'Villeta', 25, NULL, 'Activo', NULL, NULL, NULL),
(25878, 'Viotá', 25, NULL, 'Activo', NULL, NULL, NULL),
(25885, 'Yacopí', 25, NULL, 'Activo', NULL, NULL, NULL),
(25898, 'Zipacón', 25, NULL, 'Activo', NULL, NULL, NULL),
(25899, 'Zipaquirá', 25, NULL, 'Activo', NULL, NULL, NULL),
(27001, 'Quibdó', 27, NULL, 'Activo', NULL, NULL, NULL),
(27006, 'Acandí', 27, NULL, 'Activo', NULL, NULL, NULL),
(27025, 'Alto Baudo', 27, NULL, 'Activo', NULL, NULL, NULL),
(27050, 'Atrato', 27, NULL, 'Activo', NULL, NULL, NULL),
(27073, 'Bagadó', 27, NULL, 'Activo', NULL, NULL, NULL),
(27075, 'Bahía Solano', 27, NULL, 'Activo', NULL, NULL, NULL),
(27077, 'Bajo Baudó', 27, NULL, 'Activo', NULL, NULL, NULL),
(27086, 'Belén de Bajira', 27, NULL, 'Activo', NULL, NULL, NULL),
(27099, 'Bojaya', 27, NULL, 'Activo', NULL, NULL, NULL),
(27135, 'El Cantón del San Pablo', 27, NULL, 'Activo', NULL, NULL, NULL),
(27150, 'Carmen del Darien', 27, NULL, 'Activo', NULL, NULL, NULL),
(27160, 'Cértegui', 27, NULL, 'Activo', NULL, NULL, NULL),
(27205, 'Condoto', 27, NULL, 'Activo', NULL, NULL, NULL),
(27245, 'El Carmen de Atrato', 27, NULL, 'Activo', NULL, NULL, NULL),
(27250, 'El Litoral del San Juan', 27, NULL, 'Activo', NULL, NULL, NULL),
(27361, 'Istmina', 27, NULL, 'Activo', NULL, NULL, NULL),
(27372, 'Juradó', 27, NULL, 'Activo', NULL, NULL, NULL),
(27413, 'Lloró', 27, NULL, 'Activo', NULL, NULL, NULL),
(27425, 'Medio Atrato', 27, NULL, 'Activo', NULL, NULL, NULL),
(27430, 'Medio Baudó', 27, NULL, 'Activo', NULL, NULL, NULL),
(27450, 'Medio San Juan', 27, NULL, 'Activo', NULL, NULL, NULL),
(27491, 'Nóvita', 27, NULL, 'Activo', NULL, NULL, NULL),
(27495, 'Nuquí', 27, NULL, 'Activo', NULL, NULL, NULL),
(27580, 'Río Iro', 27, NULL, 'Activo', NULL, NULL, NULL),
(27600, 'Río Quito', 27, NULL, 'Activo', NULL, NULL, NULL),
(27615, 'Riosucio', 27, NULL, 'Activo', NULL, NULL, NULL),
(27660, 'San José del Palmar', 27, NULL, 'Activo', NULL, NULL, NULL),
(27745, 'Sipí', 27, NULL, 'Activo', NULL, NULL, NULL),
(27787, 'Tadó', 27, NULL, 'Activo', NULL, NULL, NULL),
(27800, 'Unguía', 27, NULL, 'Activo', NULL, NULL, NULL),
(27810, 'Unión Panamericana', 27, NULL, 'Activo', NULL, NULL, NULL),
(41001, 'Neiva', 41, NULL, 'Activo', NULL, NULL, NULL),
(41006, 'Acevedo', 41, NULL, 'Activo', NULL, NULL, NULL),
(41013, 'Agrado', 41, NULL, 'Activo', NULL, NULL, NULL),
(41016, 'Aipe', 41, NULL, 'Activo', NULL, NULL, NULL),
(41020, 'Algeciras', 41, NULL, 'Activo', NULL, NULL, NULL),
(41026, 'Altamira', 41, NULL, 'Activo', NULL, NULL, NULL),
(41078, 'Baraya', 41, NULL, 'Activo', NULL, NULL, NULL),
(41132, 'Campoalegre', 41, NULL, 'Activo', NULL, NULL, NULL),
(41206, 'Colombia', 41, NULL, 'Activo', NULL, NULL, NULL),
(41244, 'Elías', 41, NULL, 'Activo', NULL, NULL, NULL),
(41298, 'Garzón', 41, NULL, 'Activo', NULL, NULL, NULL),
(41306, 'Gigante', 41, NULL, 'Activo', NULL, NULL, NULL),
(41319, 'Guadalupe', 41, NULL, 'Activo', NULL, NULL, NULL),
(41349, 'Hobo', 41, NULL, 'Activo', NULL, NULL, NULL),
(41357, 'Iquira', 41, NULL, 'Activo', NULL, NULL, NULL),
(41359, 'Isnos', 41, NULL, 'Activo', NULL, NULL, NULL),
(41378, 'La Argentina', 41, NULL, 'Activo', NULL, NULL, NULL),
(41396, 'La Plata', 41, NULL, 'Activo', NULL, NULL, NULL),
(41483, 'Nátaga', 41, NULL, 'Activo', NULL, NULL, NULL),
(41503, 'Oporapa', 41, NULL, 'Activo', NULL, NULL, NULL),
(41518, 'Paicol', 41, NULL, 'Activo', NULL, NULL, NULL),
(41524, 'Palermo', 41, NULL, 'Activo', NULL, NULL, NULL),
(41530, 'Palestina', 41, NULL, 'Activo', NULL, NULL, NULL),
(41548, 'Pital', 41, NULL, 'Activo', NULL, NULL, NULL),
(41551, 'Pitalito', 41, NULL, 'Activo', NULL, NULL, NULL),
(41615, 'Rivera', 41, NULL, 'Activo', NULL, NULL, NULL),
(41660, 'Saladoblanco', 41, NULL, 'Activo', NULL, NULL, NULL),
(41668, 'San Agustín', 41, NULL, 'Activo', NULL, NULL, NULL),
(41676, 'Santa María', 41, NULL, 'Activo', NULL, NULL, NULL),
(41770, 'Suaza', 41, NULL, 'Activo', NULL, NULL, NULL),
(41791, 'Tarqui', 41, NULL, 'Activo', NULL, NULL, NULL),
(41797, 'Tesalia', 41, NULL, 'Activo', NULL, NULL, NULL),
(41799, 'Tello', 41, NULL, 'Activo', NULL, NULL, NULL),
(41801, 'Teruel', 41, NULL, 'Activo', NULL, NULL, NULL),
(41807, 'Timaná', 41, NULL, 'Activo', NULL, NULL, NULL),
(41872, 'Villavieja', 41, NULL, 'Activo', NULL, NULL, NULL),
(41885, 'Yaguará', 41, NULL, 'Activo', NULL, NULL, NULL),
(44001, 'Riohacha', 44, NULL, 'Activo', NULL, NULL, NULL),
(44035, 'Albania', 44, NULL, 'Activo', NULL, NULL, NULL),
(44078, 'Barrancas', 44, NULL, 'Activo', NULL, NULL, NULL),
(44090, 'Dibula', 44, NULL, 'Activo', NULL, NULL, NULL),
(44098, 'Distracción', 44, NULL, 'Activo', NULL, NULL, NULL),
(44110, 'El Molino', 44, NULL, 'Activo', NULL, NULL, NULL),
(44279, 'Fonseca', 44, NULL, 'Activo', NULL, NULL, NULL),
(44378, 'Hatonuevo', 44, NULL, 'Activo', NULL, NULL, NULL),
(44420, 'La Jagua del Pilar', 44, NULL, 'Activo', NULL, NULL, NULL),
(44430, 'Maicao', 44, NULL, 'Activo', NULL, NULL, NULL),
(44560, 'Manaure', 44, NULL, 'Activo', NULL, NULL, NULL),
(44650, 'San Juan del Cesar', 44, NULL, 'Activo', NULL, NULL, NULL),
(44847, 'Uribia', 44, NULL, 'Activo', NULL, NULL, NULL),
(44855, 'Urumita', 44, NULL, 'Activo', NULL, NULL, NULL),
(44874, 'Villanueva', 44, NULL, 'Activo', NULL, NULL, NULL),
(47001, 'Santa Marta', 47, NULL, 'Activo', NULL, NULL, NULL),
(47030, 'Algarrobo', 47, NULL, 'Activo', NULL, NULL, NULL),
(47053, 'Aracataca', 47, NULL, 'Activo', NULL, NULL, NULL),
(47058, 'Ariguaní', 47, NULL, 'Activo', NULL, NULL, NULL),
(47161, 'Cerro San Antonio', 47, NULL, 'Activo', NULL, NULL, NULL),
(47170, 'Chivolo', 47, NULL, 'Activo', NULL, NULL, NULL),
(47189, 'Ciénaga', 47, NULL, 'Activo', NULL, NULL, NULL),
(47205, 'Concordia', 47, NULL, 'Activo', NULL, NULL, NULL),
(47245, 'El Banco', 47, NULL, 'Activo', NULL, NULL, NULL),
(47258, 'El Piñon', 47, NULL, 'Activo', NULL, NULL, NULL),
(47268, 'El Retén', 47, NULL, 'Activo', NULL, NULL, NULL),
(47288, 'Fundación', 47, NULL, 'Activo', NULL, NULL, NULL),
(47318, 'Guamal', 47, NULL, 'Activo', NULL, NULL, NULL),
(47460, 'Nueva Granada', 47, NULL, 'Activo', NULL, NULL, NULL),
(47541, 'Pedraza', 47, NULL, 'Activo', NULL, NULL, NULL),
(47545, 'Pijiño del Carmen', 47, NULL, 'Activo', NULL, NULL, NULL),
(47551, 'Pivijay', 47, NULL, 'Activo', NULL, NULL, NULL),
(47555, 'Plato', 47, NULL, 'Activo', NULL, NULL, NULL),
(47570, 'Pueblo Viejo', 47, NULL, 'Activo', NULL, NULL, NULL),
(47605, 'Remolino', 47, NULL, 'Activo', NULL, NULL, NULL),
(47660, 'Sabanas de San Angel', 47, NULL, 'Activo', NULL, NULL, NULL),
(47675, 'Salamina', 47, NULL, 'Activo', NULL, NULL, NULL),
(47692, 'San Sebastián de Buenavista', 47, NULL, 'Activo', NULL, NULL, NULL),
(47703, 'San Zenón', 47, NULL, 'Activo', NULL, NULL, NULL),
(47707, 'Santa Ana', 47, NULL, 'Activo', NULL, NULL, NULL),
(47720, 'Santa Bárbara de Pinto', 47, NULL, 'Activo', NULL, NULL, NULL),
(47745, 'Sitionuevo', 47, NULL, 'Activo', NULL, NULL, NULL),
(47798, 'Tenerife', 47, NULL, 'Activo', NULL, NULL, NULL),
(47960, 'Zapayán', 47, NULL, 'Activo', NULL, NULL, NULL),
(47980, 'Zona Bananera', 47, NULL, 'Activo', NULL, NULL, NULL),
(50001, 'Villavicencio', 50, NULL, 'Activo', NULL, NULL, NULL),
(50006, 'Acacias', 50, NULL, 'Activo', NULL, NULL, NULL),
(50110, 'Barranca de Upía', 50, NULL, 'Activo', NULL, NULL, NULL),
(50124, 'Cabuyaro', 50, NULL, 'Activo', NULL, NULL, NULL),
(50150, 'Castilla la Nueva', 50, NULL, 'Activo', NULL, NULL, NULL),
(50223, 'Cubarral', 50, NULL, 'Activo', NULL, NULL, NULL),
(50226, 'Cumaral', 50, NULL, 'Activo', NULL, NULL, NULL),
(50245, 'El Calvario', 50, NULL, 'Activo', NULL, NULL, NULL),
(50251, 'El Castillo', 50, NULL, 'Activo', NULL, NULL, NULL),
(50270, 'El Dorado', 50, NULL, 'Activo', NULL, NULL, NULL),
(50287, 'Fuente de Oro', 50, NULL, 'Activo', NULL, NULL, NULL),
(50313, 'Granada', 50, NULL, 'Activo', NULL, NULL, NULL),
(50318, 'Guamal', 50, NULL, 'Activo', NULL, NULL, NULL),
(50325, 'Mapiripán', 50, NULL, 'Activo', NULL, NULL, NULL),
(50330, 'Mesetas', 50, NULL, 'Activo', NULL, NULL, NULL),
(50350, 'La Macarena', 50, NULL, 'Activo', NULL, NULL, NULL),
(50370, 'Uribe', 50, NULL, 'Activo', NULL, NULL, NULL),
(50400, 'Lejanías', 50, NULL, 'Activo', NULL, NULL, NULL),
(50450, 'Puerto Concordia', 50, NULL, 'Activo', NULL, NULL, NULL),
(50568, 'Puerto Gaitán', 50, NULL, 'Activo', NULL, NULL, NULL),
(50573, 'Puerto López', 50, NULL, 'Activo', NULL, NULL, NULL),
(50577, 'Puerto Lleras', 50, NULL, 'Activo', NULL, NULL, NULL),
(50590, 'Puerto Rico', 50, NULL, 'Activo', NULL, NULL, NULL),
(50606, 'Restrepo', 50, NULL, 'Activo', NULL, NULL, NULL),
(50680, 'San Carlos de Guaroa', 50, NULL, 'Activo', NULL, NULL, NULL),
(50683, 'San Juan de Arama', 50, NULL, 'Activo', NULL, NULL, NULL),
(50686, 'San Juanito', 50, NULL, 'Activo', NULL, NULL, NULL),
(50689, 'San Martín', 50, NULL, 'Activo', NULL, NULL, NULL),
(50711, 'Vista Hermosa', 50, NULL, 'Activo', NULL, NULL, NULL),
(52001, 'Pasto', 52, NULL, 'Activo', NULL, NULL, NULL),
(52019, 'Albán', 52, NULL, 'Activo', NULL, NULL, NULL),
(52022, 'Aldana', 52, NULL, 'Activo', NULL, NULL, NULL),
(52036, 'Ancuyá', 52, NULL, 'Activo', NULL, NULL, NULL),
(52051, 'Arboleda', 52, NULL, 'Activo', NULL, NULL, NULL),
(52079, 'Barbacoas', 52, NULL, 'Activo', NULL, NULL, NULL),
(52083, 'Belén', 52, NULL, 'Activo', NULL, NULL, NULL),
(52110, 'Buesaco', 52, NULL, 'Activo', NULL, NULL, NULL),
(52203, 'Colón', 52, NULL, 'Activo', NULL, NULL, NULL),
(52207, 'Consaca', 52, NULL, 'Activo', NULL, NULL, NULL),
(52210, 'Contadero', 52, NULL, 'Activo', NULL, NULL, NULL),
(52215, 'Córdoba', 52, NULL, 'Activo', NULL, NULL, NULL),
(52224, 'Cuaspud', 52, NULL, 'Activo', NULL, NULL, NULL),
(52227, 'Cumbal', 52, NULL, 'Activo', NULL, NULL, NULL),
(52233, 'Cumbitara', 52, NULL, 'Activo', NULL, NULL, NULL),
(52240, 'Chachagüí', 52, NULL, 'Activo', NULL, NULL, NULL),
(52250, 'El Charco', 52, NULL, 'Activo', NULL, NULL, NULL),
(52254, 'El Peñol', 52, NULL, 'Activo', NULL, NULL, NULL),
(52256, 'El Rosario', 52, NULL, 'Activo', NULL, NULL, NULL),
(52258, 'El Tablón de Gómez', 52, NULL, 'Activo', NULL, NULL, NULL),
(52260, 'El Tambo', 52, NULL, 'Activo', NULL, NULL, NULL),
(52287, 'Funes', 52, NULL, 'Activo', NULL, NULL, NULL),
(52317, 'Guachucal', 52, NULL, 'Activo', NULL, NULL, NULL),
(52320, 'Guaitarilla', 52, NULL, 'Activo', NULL, NULL, NULL),
(52323, 'Gualmatán', 52, NULL, 'Activo', NULL, NULL, NULL),
(52352, 'Iles', 52, NULL, 'Activo', NULL, NULL, NULL),
(52354, 'Imués', 52, NULL, 'Activo', NULL, NULL, NULL),
(52356, 'Ipiales', 52, NULL, 'Activo', NULL, NULL, NULL),
(52378, 'La Cruz', 52, NULL, 'Activo', NULL, NULL, NULL),
(52381, 'La Florida', 52, NULL, 'Activo', NULL, NULL, NULL),
(52385, 'La Llanada', 52, NULL, 'Activo', NULL, NULL, NULL),
(52390, 'La Tola', 52, NULL, 'Activo', NULL, NULL, NULL),
(52399, 'La Unión', 52, NULL, 'Activo', NULL, NULL, NULL),
(52405, 'Leiva', 52, NULL, 'Activo', NULL, NULL, NULL),
(52411, 'Linares', 52, NULL, 'Activo', NULL, NULL, NULL),
(52418, 'Los Andes', 52, NULL, 'Activo', NULL, NULL, NULL),
(52427, 'Magüí', 52, NULL, 'Activo', NULL, NULL, NULL),
(52435, 'Mallama', 52, NULL, 'Activo', NULL, NULL, NULL),
(52473, 'Mosquera', 52, NULL, 'Activo', NULL, NULL, NULL),
(52480, 'Nariño', 52, NULL, 'Activo', NULL, NULL, NULL),
(52490, 'Olaya Herrera', 52, NULL, 'Activo', NULL, NULL, NULL),
(52506, 'Ospina', 52, NULL, 'Activo', NULL, NULL, NULL),
(52520, 'Francisco Pizarro', 52, NULL, 'Activo', NULL, NULL, NULL),
(52540, 'Policarpa', 52, NULL, 'Activo', NULL, NULL, NULL),
(52560, 'Potosí', 52, NULL, 'Activo', NULL, NULL, NULL),
(52565, 'Providencia', 52, NULL, 'Activo', NULL, NULL, NULL),
(52573, 'Puerres', 52, NULL, 'Activo', NULL, NULL, NULL),
(52585, 'Pupiales', 52, NULL, 'Activo', NULL, NULL, NULL),
(52612, 'Ricaurte', 52, NULL, 'Activo', NULL, NULL, NULL),
(52621, 'Roberto Payán', 52, NULL, 'Activo', NULL, NULL, NULL),
(52678, 'Samaniego', 52, NULL, 'Activo', NULL, NULL, NULL),
(52683, 'Sandoná', 52, NULL, 'Activo', NULL, NULL, NULL),
(52685, 'San Bernardo', 52, NULL, 'Activo', NULL, NULL, NULL),
(52687, 'San Lorenzo', 52, NULL, 'Activo', NULL, NULL, NULL),
(52693, 'San Pablo', 52, NULL, 'Activo', NULL, NULL, NULL),
(52694, 'San Pedro de Cartago', 52, NULL, 'Activo', NULL, NULL, NULL),
(52696, 'Santa Bárbara', 52, NULL, 'Activo', NULL, NULL, NULL),
(52699, 'Santacruz', 52, NULL, 'Activo', NULL, NULL, NULL),
(52720, 'Sapuyes', 52, NULL, 'Activo', NULL, NULL, NULL),
(52786, 'Taminango', 52, NULL, 'Activo', NULL, NULL, NULL),
(52788, 'Tangua', 52, NULL, 'Activo', NULL, NULL, NULL),
(52835, 'San Andrés de Tumaco', 52, NULL, 'Activo', NULL, NULL, NULL),
(52838, 'Túquerres', 52, NULL, 'Activo', NULL, NULL, NULL),
(52885, 'Yacuanquer', 52, NULL, 'Activo', NULL, NULL, NULL),
(54001, 'Cúcuta', 54, NULL, 'Activo', NULL, NULL, NULL),
(54003, 'Abrego', 54, NULL, 'Activo', NULL, NULL, NULL),
(54051, 'Arboledas', 54, NULL, 'Activo', NULL, NULL, NULL),
(54099, 'Bochalema', 54, NULL, 'Activo', NULL, NULL, NULL),
(54109, 'Bucarasica', 54, NULL, 'Activo', NULL, NULL, NULL),
(54125, 'Cácota', 54, NULL, 'Activo', NULL, NULL, NULL),
(54128, 'Cachirá', 54, NULL, 'Activo', NULL, NULL, NULL),
(54172, 'Chinácota', 54, NULL, 'Activo', NULL, NULL, NULL),
(54174, 'Chitagá', 54, NULL, 'Activo', NULL, NULL, NULL),
(54206, 'Convención', 54, NULL, 'Activo', NULL, NULL, NULL),
(54223, 'Cucutilla', 54, NULL, 'Activo', NULL, NULL, NULL),
(54239, 'Durania', 54, NULL, 'Activo', NULL, NULL, NULL),
(54245, 'El Carmen', 54, NULL, 'Activo', NULL, NULL, NULL),
(54250, 'El Tarra', 54, NULL, 'Activo', NULL, NULL, NULL),
(54261, 'El Zulia', 54, NULL, 'Activo', NULL, NULL, NULL),
(54313, 'Gramalote', 54, NULL, 'Activo', NULL, NULL, NULL),
(54344, 'Hacarí', 54, NULL, 'Activo', NULL, NULL, NULL),
(54347, 'Herrán', 54, NULL, 'Activo', NULL, NULL, NULL),
(54377, 'Labateca', 54, NULL, 'Activo', NULL, NULL, NULL),
(54385, 'La Esperanza', 54, NULL, 'Activo', NULL, NULL, NULL),
(54398, 'La Playa', 54, NULL, 'Activo', NULL, NULL, NULL),
(54405, 'Los Patios', 54, NULL, 'Activo', NULL, NULL, NULL),
(54418, 'Lourdes', 54, NULL, 'Activo', NULL, NULL, NULL),
(54480, 'Mutiscua', 54, NULL, 'Activo', NULL, NULL, NULL),
(54498, 'Ocaña', 54, NULL, 'Activo', NULL, NULL, NULL),
(54518, 'Pamplona', 54, NULL, 'Activo', NULL, NULL, NULL),
(54520, 'Pamplonita', 54, NULL, 'Activo', NULL, NULL, NULL),
(54553, 'Puerto Santander', 54, NULL, 'Activo', NULL, NULL, NULL),
(54599, 'Ragonvalia', 54, NULL, 'Activo', NULL, NULL, NULL),
(54660, 'Salazar', 54, NULL, 'Activo', NULL, NULL, NULL),
(54670, 'San Calixto', 54, NULL, 'Activo', NULL, NULL, NULL),
(54673, 'San Cayetano', 54, NULL, 'Activo', NULL, NULL, NULL),
(54680, 'Santiago', 54, NULL, 'Activo', NULL, NULL, NULL),
(54720, 'Sardinata', 54, NULL, 'Activo', NULL, NULL, NULL),
(54743, 'Silos', 54, NULL, 'Activo', NULL, NULL, NULL),
(54800, 'Teorama', 54, NULL, 'Activo', NULL, NULL, NULL),
(54810, 'Tibú', 54, NULL, 'Activo', NULL, NULL, NULL),
(54820, 'Toledo', 54, NULL, 'Activo', NULL, NULL, NULL),
(54871, 'Villa Caro', 54, NULL, 'Activo', NULL, NULL, NULL),
(54874, 'Villa del Rosario', 54, NULL, 'Activo', NULL, NULL, NULL),
(63001, 'Armenia', 63, NULL, 'Activo', NULL, NULL, NULL),
(63111, 'Buenavista', 63, NULL, 'Activo', NULL, NULL, NULL),
(63130, 'Calarcá', 63, NULL, 'Activo', NULL, NULL, NULL),
(63190, 'Circasia', 63, NULL, 'Activo', NULL, NULL, NULL),
(63212, 'Córdoba', 63, NULL, 'Activo', NULL, NULL, NULL),
(63272, 'Filandia', 63, NULL, 'Activo', NULL, NULL, NULL),
(63302, 'Génova', 63, NULL, 'Activo', NULL, NULL, NULL),
(63401, 'La Tebaida', 63, NULL, 'Activo', NULL, NULL, NULL),
(63470, 'Montenegro', 63, NULL, 'Activo', NULL, NULL, NULL),
(63548, 'Pijao', 63, NULL, 'Activo', NULL, NULL, NULL),
(63594, 'Quimbaya', 63, NULL, 'Activo', NULL, NULL, NULL),
(63690, 'Salento', 63, NULL, 'Activo', NULL, NULL, NULL),
(66001, 'Pereira', 66, NULL, 'Activo', NULL, NULL, NULL),
(66045, 'Apía', 66, NULL, 'Activo', NULL, NULL, NULL),
(66075, 'Balboa', 66, NULL, 'Activo', NULL, NULL, NULL),
(66088, 'Belén de Umbría', 66, NULL, 'Activo', NULL, NULL, NULL),
(66170, 'Dosquebradas', 66, NULL, 'Activo', NULL, NULL, NULL),
(66318, 'Guática', 66, NULL, 'Activo', NULL, NULL, NULL),
(66383, 'La Celia', 66, NULL, 'Activo', NULL, NULL, NULL),
(66400, 'La Virginia', 66, NULL, 'Activo', NULL, NULL, NULL),
(66440, 'Marsella', 66, NULL, 'Activo', NULL, NULL, NULL),
(66456, 'Mistrató', 66, NULL, 'Activo', NULL, NULL, NULL),
(66572, 'Pueblo Rico', 66, NULL, 'Activo', NULL, NULL, NULL),
(66594, 'Quinchía', 66, NULL, 'Activo', NULL, NULL, NULL),
(66682, 'Santa Rosa de Cabal', 66, NULL, 'Activo', NULL, NULL, NULL),
(66687, 'Santuario', 66, NULL, 'Activo', NULL, NULL, NULL),
(68001, 'Bucaramanga', 68, NULL, 'Activo', NULL, NULL, NULL),
(68013, 'Aguada', 68, NULL, 'Activo', NULL, NULL, NULL),
(68020, 'Albania', 68, NULL, 'Activo', NULL, NULL, NULL),
(68051, 'Aratoca', 68, NULL, 'Activo', NULL, NULL, NULL),
(68077, 'Barbosa', 68, NULL, 'Activo', NULL, NULL, NULL),
(68079, 'Barichara', 68, NULL, 'Activo', NULL, NULL, NULL),
(68081, 'Barrancabermeja', 68, NULL, 'Activo', NULL, NULL, NULL),
(68092, 'Betulia', 68, NULL, 'Activo', NULL, NULL, NULL),
(68101, 'Bolívar', 68, NULL, 'Activo', NULL, NULL, NULL),
(68121, 'Cabrera', 68, NULL, 'Activo', NULL, NULL, NULL),
(68132, 'California', 68, NULL, 'Activo', NULL, NULL, NULL),
(68147, 'Capitanejo', 68, NULL, 'Activo', NULL, NULL, NULL),
(68152, 'Carcasí', 68, NULL, 'Activo', NULL, NULL, NULL),
(68160, 'Cepitá', 68, NULL, 'Activo', NULL, NULL, NULL),
(68162, 'Cerrito', 68, NULL, 'Activo', NULL, NULL, NULL),
(68167, 'Charalá', 68, NULL, 'Activo', NULL, NULL, NULL),
(68169, 'Charta', 68, NULL, 'Activo', NULL, NULL, NULL),
(68176, 'Chimá', 68, NULL, 'Activo', NULL, NULL, NULL),
(68179, 'Chipatá', 68, NULL, 'Activo', NULL, NULL, NULL),
(68190, 'Cimitarra', 68, NULL, 'Activo', NULL, NULL, NULL),
(68207, 'Concepción', 68, NULL, 'Activo', NULL, NULL, NULL),
(68209, 'Confines', 68, NULL, 'Activo', NULL, NULL, NULL);
INSERT INTO `municipio` (`id`, `nombre`, `departamento_id`, `acortado`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(68211, 'Contratación', 68, NULL, 'Activo', NULL, NULL, NULL),
(68217, 'Coromoro', 68, NULL, 'Activo', NULL, NULL, NULL),
(68229, 'Curití', 68, NULL, 'Activo', NULL, NULL, NULL),
(68235, 'El Carmen de Chucurí', 68, NULL, 'Activo', NULL, NULL, NULL),
(68245, 'El Guacamayo', 68, NULL, 'Activo', NULL, NULL, NULL),
(68250, 'El Peñón', 68, NULL, 'Activo', NULL, NULL, NULL),
(68255, 'El Playón', 68, NULL, 'Activo', NULL, NULL, NULL),
(68264, 'Encino', 68, NULL, 'Activo', NULL, NULL, NULL),
(68266, 'Enciso', 68, NULL, 'Activo', NULL, NULL, NULL),
(68271, 'Florián', 68, NULL, 'Activo', NULL, NULL, NULL),
(68276, 'Floridablanca', 68, NULL, 'Activo', NULL, NULL, NULL),
(68296, 'Galán', 68, NULL, 'Activo', NULL, NULL, NULL),
(68298, 'Gambita', 68, NULL, 'Activo', NULL, NULL, NULL),
(68307, 'Girón', 68, NULL, 'Activo', NULL, NULL, NULL),
(68318, 'Guaca', 68, NULL, 'Activo', NULL, NULL, NULL),
(68320, 'Guadalupe', 68, NULL, 'Activo', NULL, NULL, NULL),
(68322, 'Guapotá', 68, NULL, 'Activo', NULL, NULL, NULL),
(68324, 'Guavatá', 68, NULL, 'Activo', NULL, NULL, NULL),
(68327, 'Güepsa', 68, NULL, 'Activo', NULL, NULL, NULL),
(68344, 'Hato', 68, NULL, 'Activo', NULL, NULL, NULL),
(68368, 'Jesús María', 68, NULL, 'Activo', NULL, NULL, NULL),
(68370, 'Jordán', 68, NULL, 'Activo', NULL, NULL, NULL),
(68377, 'La Belleza', 68, NULL, 'Activo', NULL, NULL, NULL),
(68385, 'Landázuri', 68, NULL, 'Activo', NULL, NULL, NULL),
(68397, 'La Paz', 68, NULL, 'Activo', NULL, NULL, NULL),
(68406, 'Lebríja', 68, NULL, 'Activo', NULL, NULL, NULL),
(68418, 'Los Santos', 68, NULL, 'Activo', NULL, NULL, NULL),
(68425, 'Macaravita', 68, NULL, 'Activo', NULL, NULL, NULL),
(68432, 'Málaga', 68, NULL, 'Activo', NULL, NULL, NULL),
(68444, 'Matanza', 68, NULL, 'Activo', NULL, NULL, NULL),
(68464, 'Mogotes', 68, NULL, 'Activo', NULL, NULL, NULL),
(68468, 'Molagavita', 68, NULL, 'Activo', NULL, NULL, NULL),
(68498, 'Ocamonte', 68, NULL, 'Activo', NULL, NULL, NULL),
(68500, 'Oiba', 68, NULL, 'Activo', NULL, NULL, NULL),
(68502, 'Onzaga', 68, NULL, 'Activo', NULL, NULL, NULL),
(68522, 'Palmar', 68, NULL, 'Activo', NULL, NULL, NULL),
(68524, 'Palmas del Socorro', 68, NULL, 'Activo', NULL, NULL, NULL),
(68533, 'Páramo', 68, NULL, 'Activo', NULL, NULL, NULL),
(68547, 'Piedecuesta', 68, NULL, 'Activo', NULL, NULL, NULL),
(68549, 'Pinchote', 68, NULL, 'Activo', NULL, NULL, NULL),
(68572, 'Puente Nacional', 68, NULL, 'Activo', NULL, NULL, NULL),
(68573, 'Puerto Parra', 68, NULL, 'Activo', NULL, NULL, NULL),
(68575, 'Puerto Wilches', 68, NULL, 'Activo', NULL, NULL, NULL),
(68615, 'Rionegro', 68, NULL, 'Activo', NULL, NULL, NULL),
(68655, 'Sabana de Torres', 68, NULL, 'Activo', NULL, NULL, NULL),
(68669, 'San Andrés', 68, NULL, 'Activo', NULL, NULL, NULL),
(68673, 'San Benito', 68, NULL, 'Activo', NULL, NULL, NULL),
(68679, 'San Gil', 68, NULL, 'Activo', NULL, NULL, NULL),
(68682, 'San Joaquín', 68, NULL, 'Activo', NULL, NULL, NULL),
(68684, 'San José de Miranda', 68, NULL, 'Activo', NULL, NULL, NULL),
(68686, 'San Miguel', 68, NULL, 'Activo', NULL, NULL, NULL),
(68689, 'San Vicente de Chucurí', 68, NULL, 'Activo', NULL, NULL, NULL),
(68705, 'Santa Bárbara', 68, NULL, 'Activo', NULL, NULL, NULL),
(68720, 'Santa Helena del Opón', 68, NULL, 'Activo', NULL, NULL, NULL),
(68745, 'Simacota', 68, NULL, 'Activo', NULL, NULL, NULL),
(68755, 'Socorro', 68, NULL, 'Activo', NULL, NULL, NULL),
(68770, 'Suaita', 68, NULL, 'Activo', NULL, NULL, NULL),
(68773, 'Sucre', 68, NULL, 'Activo', NULL, NULL, NULL),
(68780, 'Suratá', 68, NULL, 'Activo', NULL, NULL, NULL),
(68820, 'Tona', 68, NULL, 'Activo', NULL, NULL, NULL),
(68855, 'Valle de San José', 68, NULL, 'Activo', NULL, NULL, NULL),
(68861, 'Vélez', 68, NULL, 'Activo', NULL, NULL, NULL),
(68867, 'Vetas', 68, NULL, 'Activo', NULL, NULL, NULL),
(68872, 'Villanueva', 68, NULL, 'Activo', NULL, NULL, NULL),
(68895, 'Zapatoca', 68, NULL, 'Activo', NULL, NULL, NULL),
(70001, 'Sincelejo', 70, NULL, 'Activo', NULL, NULL, NULL),
(70110, 'Buenavista', 70, NULL, 'Activo', NULL, NULL, NULL),
(70124, 'Caimito', 70, NULL, 'Activo', NULL, NULL, NULL),
(70204, 'Coloso', 70, NULL, 'Activo', NULL, NULL, NULL),
(70215, 'Corozal', 70, NULL, 'Activo', NULL, NULL, NULL),
(70221, 'Coveñas', 70, NULL, 'Activo', NULL, NULL, NULL),
(70230, 'Chalán', 70, NULL, 'Activo', NULL, NULL, NULL),
(70233, 'El Roble', 70, NULL, 'Activo', NULL, NULL, NULL),
(70235, 'Galeras', 70, NULL, 'Activo', NULL, NULL, NULL),
(70265, 'Guaranda', 70, NULL, 'Activo', NULL, NULL, NULL),
(70400, 'La Unión', 70, NULL, 'Activo', NULL, NULL, NULL),
(70418, 'Los Palmitos', 70, NULL, 'Activo', NULL, NULL, NULL),
(70429, 'Majagual', 70, NULL, 'Activo', NULL, NULL, NULL),
(70473, 'Morroa', 70, NULL, 'Activo', NULL, NULL, NULL),
(70508, 'Ovejas', 70, NULL, 'Activo', NULL, NULL, NULL),
(70523, 'Palmito', 70, NULL, 'Activo', NULL, NULL, NULL),
(70670, 'Sampués', 70, NULL, 'Activo', NULL, NULL, NULL),
(70678, 'San Benito Abad', 70, NULL, 'Activo', NULL, NULL, NULL),
(70702, 'San Juan de Betulia', 70, NULL, 'Activo', NULL, NULL, NULL),
(70708, 'San Marcos', 70, NULL, 'Activo', NULL, NULL, NULL),
(70713, 'San Onofre', 70, NULL, 'Activo', NULL, NULL, NULL),
(70717, 'San Pedro', 70, NULL, 'Activo', NULL, NULL, NULL),
(70742, 'San Luis de Sincé', 70, NULL, 'Activo', NULL, NULL, NULL),
(70771, 'Sucre', 70, NULL, 'Activo', NULL, NULL, NULL),
(70820, 'Santiago de Tolú', 70, NULL, 'Activo', NULL, NULL, NULL),
(70823, 'Tolú Viejo', 70, NULL, 'Activo', NULL, NULL, NULL),
(73001, 'Ibagué', 73, NULL, 'Activo', NULL, NULL, NULL),
(73024, 'Alpujarra', 73, NULL, 'Activo', NULL, NULL, NULL),
(73026, 'Alvarado', 73, NULL, 'Activo', NULL, NULL, NULL),
(73030, 'Ambalema', 73, NULL, 'Activo', NULL, NULL, NULL),
(73043, 'Anzoátegui', 73, NULL, 'Activo', NULL, NULL, NULL),
(73055, 'Armero', 73, NULL, 'Activo', NULL, NULL, NULL),
(73067, 'Ataco', 73, NULL, 'Activo', NULL, NULL, NULL),
(73124, 'Cajamarca', 73, NULL, 'Activo', NULL, NULL, NULL),
(73148, 'Carmen de Apicala', 73, NULL, 'Activo', NULL, NULL, NULL),
(73152, 'Casabianca', 73, NULL, 'Activo', NULL, NULL, NULL),
(73168, 'Chaparral', 73, NULL, 'Activo', NULL, NULL, NULL),
(73200, 'Coello', 73, NULL, 'Activo', NULL, NULL, NULL),
(73217, 'Coyaima', 73, NULL, 'Activo', NULL, NULL, NULL),
(73226, 'Cunday', 73, NULL, 'Activo', NULL, NULL, NULL),
(73236, 'Dolores', 73, NULL, 'Activo', NULL, NULL, NULL),
(73268, 'Espinal', 73, NULL, 'Activo', NULL, NULL, NULL),
(73270, 'Falan', 73, NULL, 'Activo', NULL, NULL, NULL),
(73275, 'Flandes', 73, NULL, 'Activo', NULL, NULL, NULL),
(73283, 'Fresno', 73, NULL, 'Activo', NULL, NULL, NULL),
(73319, 'Guamo', 73, NULL, 'Activo', NULL, NULL, NULL),
(73347, 'Herveo', 73, NULL, 'Activo', NULL, NULL, NULL),
(73349, 'Honda', 73, NULL, 'Activo', NULL, NULL, NULL),
(73352, 'Icononzo', 73, NULL, 'Activo', NULL, NULL, NULL),
(73408, 'Lérida', 73, NULL, 'Activo', NULL, NULL, NULL),
(73411, 'Líbano', 73, NULL, 'Activo', NULL, NULL, NULL),
(73443, 'Mariquita', 73, NULL, 'Activo', NULL, NULL, NULL),
(73449, 'Melgar', 73, NULL, 'Activo', NULL, NULL, NULL),
(73461, 'Murillo', 73, NULL, 'Activo', NULL, NULL, NULL),
(73483, 'Natagaima', 73, NULL, 'Activo', NULL, NULL, NULL),
(73504, 'Ortega', 73, NULL, 'Activo', NULL, NULL, NULL),
(73520, 'Palocabildo', 73, NULL, 'Activo', NULL, NULL, NULL),
(73547, 'Piedras', 73, NULL, 'Activo', NULL, NULL, NULL),
(73555, 'Planadas', 73, NULL, 'Activo', NULL, NULL, NULL),
(73563, 'Prado', 73, NULL, 'Activo', NULL, NULL, NULL),
(73585, 'Purificación', 73, NULL, 'Activo', NULL, NULL, NULL),
(73616, 'Rio Blanco', 73, NULL, 'Activo', NULL, NULL, NULL),
(73622, 'Roncesvalles', 73, NULL, 'Activo', NULL, NULL, NULL),
(73624, 'Rovira', 73, NULL, 'Activo', NULL, NULL, NULL),
(73671, 'Saldaña', 73, NULL, 'Activo', NULL, NULL, NULL),
(73675, 'San Antonio', 73, NULL, 'Activo', NULL, NULL, NULL),
(73678, 'San Luis', 73, NULL, 'Activo', NULL, NULL, NULL),
(73686, 'Santa Isabel', 73, NULL, 'Activo', NULL, NULL, NULL),
(73770, 'Suárez', 73, NULL, 'Activo', NULL, NULL, NULL),
(73854, 'Valle de San Juan', 73, NULL, 'Activo', NULL, NULL, NULL),
(73861, 'Venadillo', 73, NULL, 'Activo', NULL, NULL, NULL),
(73870, 'Villahermosa', 73, NULL, 'Activo', NULL, NULL, NULL),
(73873, 'Villarrica', 73, NULL, 'Activo', NULL, NULL, NULL),
(76001, 'Cali', 76, NULL, 'Activo', NULL, NULL, NULL),
(76020, 'Alcalá', 76, NULL, 'Activo', NULL, NULL, NULL),
(76036, 'Andalucía', 76, NULL, 'Activo', NULL, NULL, NULL),
(76041, 'Ansermanuevo', 76, NULL, 'Activo', NULL, NULL, NULL),
(76054, 'Argelia', 76, NULL, 'Activo', NULL, NULL, NULL),
(76100, 'Bolívar', 76, NULL, 'Activo', NULL, NULL, NULL),
(76109, 'Buenaventura', 76, NULL, 'Activo', NULL, NULL, NULL),
(76111, 'Buga', 76, NULL, 'Activo', NULL, NULL, NULL),
(76113, 'Bugalagrande', 76, NULL, 'Activo', NULL, NULL, NULL),
(76122, 'Caicedonia', 76, NULL, 'Activo', NULL, NULL, NULL),
(76126, 'Calima', 76, NULL, 'Activo', NULL, NULL, NULL),
(76130, 'Candelaria', 76, NULL, 'Activo', NULL, NULL, NULL),
(76147, 'Cartago', 76, NULL, 'Activo', NULL, NULL, NULL),
(76233, 'Dagua', 76, NULL, 'Activo', NULL, NULL, NULL),
(76243, 'El Águila', 76, NULL, 'Activo', NULL, NULL, NULL),
(76246, 'El Cairo', 76, NULL, 'Activo', NULL, NULL, NULL),
(76248, 'El Cerrito', 76, NULL, 'Activo', NULL, NULL, NULL),
(76250, 'El Dovio', 76, NULL, 'Activo', NULL, NULL, NULL),
(76275, 'Florida', 76, NULL, 'Activo', NULL, NULL, NULL),
(76306, 'Ginebra', 76, NULL, 'Activo', NULL, NULL, NULL),
(76318, 'Guacarí', 76, NULL, 'Activo', NULL, NULL, NULL),
(76364, 'Jamundí', 76, NULL, 'Activo', NULL, NULL, NULL),
(76377, 'La Cumbre', 76, NULL, 'Activo', NULL, NULL, NULL),
(76400, 'La Unión', 76, NULL, 'Activo', NULL, NULL, NULL),
(76403, 'La Victoria', 76, NULL, 'Activo', NULL, NULL, NULL),
(76497, 'Obando', 76, NULL, 'Activo', NULL, NULL, NULL),
(76520, 'Palmira', 76, NULL, 'Activo', NULL, NULL, NULL),
(76563, 'Pradera', 76, NULL, 'Activo', NULL, NULL, NULL),
(76606, 'Restrepo', 76, NULL, 'Activo', NULL, NULL, NULL),
(76616, 'Riofrío', 76, NULL, 'Activo', NULL, NULL, NULL),
(76622, 'Roldanillo', 76, NULL, 'Activo', NULL, NULL, NULL),
(76670, 'San Pedro', 76, NULL, 'Activo', NULL, NULL, NULL),
(76736, 'Sevilla', 76, NULL, 'Activo', NULL, NULL, NULL),
(76823, 'Toro', 76, NULL, 'Activo', NULL, NULL, NULL),
(76828, 'Trujillo', 76, NULL, 'Activo', NULL, NULL, NULL),
(76834, 'Tuluá', 76, NULL, 'Activo', NULL, NULL, NULL),
(76845, 'Ulloa', 76, NULL, 'Activo', NULL, NULL, NULL),
(76863, 'Versalles', 76, NULL, 'Activo', NULL, NULL, NULL),
(76869, 'Vijes', 76, NULL, 'Activo', NULL, NULL, NULL),
(76890, 'Yotoco', 76, NULL, 'Activo', NULL, NULL, NULL),
(76892, 'Yumbo', 76, NULL, 'Activo', NULL, NULL, NULL),
(76895, 'Zarzal', 76, NULL, 'Activo', NULL, NULL, NULL),
(81001, 'Arauca', 81, NULL, 'Activo', NULL, NULL, NULL),
(81065, 'Arauquita', 81, NULL, 'Activo', NULL, NULL, NULL),
(81220, 'Cravo Norte', 81, NULL, 'Activo', NULL, NULL, NULL),
(81300, 'Fortul', 81, NULL, 'Activo', NULL, NULL, NULL),
(81591, 'Puerto Rondón', 81, NULL, 'Activo', NULL, NULL, NULL),
(81736, 'Saravena', 81, NULL, 'Activo', NULL, NULL, NULL),
(81794, 'Tame', 81, NULL, 'Activo', NULL, NULL, NULL),
(85001, 'Yopal', 85, NULL, 'Activo', NULL, NULL, NULL),
(85010, 'Aguazul', 85, NULL, 'Activo', NULL, NULL, NULL),
(85015, 'Chámeza', 85, NULL, 'Activo', NULL, NULL, NULL),
(85125, 'Hato Corozal', 85, NULL, 'Activo', NULL, NULL, NULL),
(85136, 'La Salina', 85, NULL, 'Activo', NULL, NULL, NULL),
(85139, 'Maní', 85, NULL, 'Activo', NULL, NULL, NULL),
(85162, 'Monterrey', 85, NULL, 'Activo', NULL, NULL, NULL),
(85225, 'Nunchía', 85, NULL, 'Activo', NULL, NULL, NULL),
(85230, 'Orocué', 85, NULL, 'Activo', NULL, NULL, NULL),
(85250, 'Paz de Ariporo', 85, NULL, 'Activo', NULL, NULL, NULL),
(85263, 'Pore', 85, NULL, 'Activo', NULL, NULL, NULL),
(85279, 'Recetor', 85, NULL, 'Activo', NULL, NULL, NULL),
(85300, 'Sabanalarga', 85, NULL, 'Activo', NULL, NULL, NULL),
(85315, 'Sácama', 85, NULL, 'Activo', NULL, NULL, NULL),
(85325, 'San Luis de Gaceno', 85, NULL, 'Activo', NULL, NULL, NULL),
(85400, 'Támara', 85, NULL, 'Activo', NULL, NULL, NULL),
(85410, 'Tauramena', 85, NULL, 'Activo', NULL, NULL, NULL),
(85430, 'Trinidad', 85, NULL, 'Activo', NULL, NULL, NULL),
(85440, 'Villanueva', 85, NULL, 'Activo', NULL, NULL, NULL),
(86001, 'Mocoa', 86, NULL, 'Activo', NULL, NULL, NULL),
(86219, 'Colón', 86, NULL, 'Activo', NULL, NULL, NULL),
(86320, 'Orito', 86, NULL, 'Activo', NULL, NULL, NULL),
(86568, 'Puerto Asís', 86, NULL, 'Activo', NULL, NULL, NULL),
(86569, 'Puerto Caicedo', 86, NULL, 'Activo', NULL, NULL, NULL),
(86571, 'Puerto Guzmán', 86, NULL, 'Activo', NULL, NULL, NULL),
(86573, 'Leguízamo', 86, NULL, 'Activo', NULL, NULL, NULL),
(86749, 'Sibundoy', 86, NULL, 'Activo', NULL, NULL, NULL),
(86755, 'San Francisco', 86, NULL, 'Activo', NULL, NULL, NULL),
(86757, 'San Miguel', 86, NULL, 'Activo', NULL, NULL, NULL),
(86760, 'Santiago', 86, NULL, 'Activo', NULL, NULL, NULL),
(86865, 'Valle de Guamez', 86, NULL, 'Activo', NULL, NULL, NULL),
(86885, 'Villagarzón', 86, NULL, 'Activo', NULL, NULL, NULL),
(88001, 'San Andrés', 88, NULL, 'Activo', NULL, NULL, NULL),
(88564, 'Providencia', 88, NULL, 'Activo', NULL, NULL, NULL),
(91001, 'Leticia', 91, NULL, 'Activo', NULL, NULL, NULL),
(91263, 'El Encanto', 91, NULL, 'Activo', NULL, NULL, NULL),
(91405, 'La Chorrera', 91, NULL, 'Activo', NULL, NULL, NULL),
(91407, 'La Pedrera', 91, NULL, 'Activo', NULL, NULL, NULL),
(91430, 'La Victoria', 91, NULL, 'Activo', NULL, NULL, NULL),
(91460, 'Miriti Paraná', 91, NULL, 'Activo', NULL, NULL, NULL),
(91530, 'Puerto Alegría', 91, NULL, 'Activo', NULL, NULL, NULL),
(91536, 'Puerto Arica', 91, NULL, 'Activo', NULL, NULL, NULL),
(91540, 'Puerto Nariño', 91, NULL, 'Activo', NULL, NULL, NULL),
(91669, 'Puerto Santander', 91, NULL, 'Activo', NULL, NULL, NULL),
(91798, 'Tarapacá', 91, NULL, 'Activo', NULL, NULL, NULL),
(94001, 'Inírida', 94, NULL, 'Activo', NULL, NULL, NULL),
(94343, 'Barranco Minas', 94, NULL, 'Activo', NULL, NULL, NULL),
(94663, 'Mapiripana', 94, NULL, 'Activo', NULL, NULL, NULL),
(94883, 'San Felipe', 94, NULL, 'Activo', NULL, NULL, NULL),
(94884, 'Puerto Colombia', 94, NULL, 'Activo', NULL, NULL, NULL),
(94885, 'La Guadalupe', 94, NULL, 'Activo', NULL, NULL, NULL),
(94886, 'Cacahual', 94, NULL, 'Activo', NULL, NULL, NULL),
(94887, 'Pana Pana', 94, NULL, 'Activo', NULL, NULL, NULL),
(94888, 'Morichal', 94, NULL, 'Activo', NULL, NULL, NULL),
(95001, 'San José del Guaviare', 95, NULL, 'Activo', NULL, NULL, NULL),
(95015, 'Calamar', 95, NULL, 'Activo', NULL, NULL, NULL),
(95025, 'El Retorno', 95, NULL, 'Activo', NULL, NULL, NULL),
(95200, 'Miraflores', 95, NULL, 'Activo', NULL, NULL, NULL),
(97001, 'Mitú', 97, NULL, 'Activo', NULL, NULL, NULL),
(97161, 'Caruru', 97, NULL, 'Activo', NULL, NULL, NULL),
(97511, 'Pacoa', 97, NULL, 'Activo', NULL, NULL, NULL),
(97666, 'Taraira', 97, NULL, 'Activo', NULL, NULL, NULL),
(97777, 'Papunaua', 97, NULL, 'Activo', NULL, NULL, NULL),
(97889, 'Yavaraté', 97, NULL, 'Activo', NULL, NULL, NULL),
(99001, 'Puerto Carreño', 99, NULL, 'Activo', NULL, NULL, NULL),
(99524, 'La Primavera', 99, NULL, 'Activo', NULL, NULL, NULL),
(99624, 'Santa Rosalía', 99, NULL, 'Activo', NULL, NULL, NULL),
(99773, 'Cumaribo', 99, NULL, 'Activo', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta`
--

CREATE TABLE `oferta` (
                          `id` int(11) NOT NULL,
                          `Nombre` varchar(30) NOT NULL,
                          `Descripcion` text NOT NULL,
                          `PrecioUnidadVentaOferta` mediumint(9) NOT NULL,
                          `Estado` enum('Disponible','No disponible') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `oferta`
--

INSERT INTO `oferta` (`id`, `Nombre`, `Descripcion`, `PrecioUnidadVentaOferta`, `Estado`) VALUES
(1, 'Alitas xtreme', 'Un combo de dos porciones de alitas', 35000, 'Disponible'),
(2, 'Six pack 2x1', 'Dos six pack de cualquier cerveza por el precio de uno', 12000, 'Disponible'),
(3, 'Combo Entre Palos', 'Dos hamburguesas con papas y gaseosa', 30000, 'Disponible'),
(4, 'Combo taparterias', 'Combo de dos hamburguesas dobles', 45000, 'Disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
                        `id` smallint(5) UNSIGNED NOT NULL,
                        `Trabajador_id` tinyint(3) UNSIGNED NOT NULL,
                        `Fecha` date NOT NULL,
                        `ValorPago` int(11) NOT NULL,
                        `Estado` enum('Pendiente','Saldado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id`, `Trabajador_id`, `Fecha`, `ValorPago`, `Estado`) VALUES
(1, 3, '2002-03-22', 0, 'Pendiente'),
(2, 2, '2021-01-01', 0, 'Pendiente'),
(3, 3, '2021-12-05', 0, 'Saldado'),
(4, 3, '2017-05-23', 0, 'Pendiente'),
(5, 2, '2017-03-23', 0, 'Pendiente'),
(6, 2, '2021-06-04', 0, 'Pendiente'),
(7, 2, '2021-06-03', 0, 'Pendiente'),
(8, 2, '2021-06-05', 0, 'Saldado'),
(9, 2, '2018-05-14', 0, 'Saldado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
                            `id` int(10) UNSIGNED NOT NULL,
                            `Nombre` varchar(80) NOT NULL,
                            `Tamano` smallint(5) UNSIGNED NOT NULL,
                            `ReferenciaTamano` enum('ml','Lt','Kg','gr','Oz','Lb') NOT NULL,
                            `Referencia` varchar(25) NOT NULL,
                            `PrecioBase` mediumint(8) UNSIGNED NOT NULL,
                            `PrecioUnidadTrabajador` mediumint(8) UNSIGNED NOT NULL,
                            `PrecioUnidadVenta` mediumint(8) UNSIGNED NOT NULL,
                            `PresentacionProducto` enum('Lata','Botella vidrio','Botella plastico','Tetrapack','Predeterminado','Icopor','Vaso vidrio','Vaso plastico','Tasa') NOT NULL,
                            `Marca_id` int(10) UNSIGNED DEFAULT NULL,
                            `CantidadProducto` smallint(5) UNSIGNED NOT NULL,
                            `Subcategoria_id` tinyint(4) NOT NULL,
                            `Estado` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `Nombre`, `Tamano`, `ReferenciaTamano`, `Referencia`, `PrecioBase`, `PrecioUnidadTrabajador`, `PrecioUnidadVenta`, `PresentacionProducto`, `Marca_id`, `CantidadProducto`, `Subcategoria_id`, `Estado`) VALUES
(1, 'Cerveza ligth cerodsdasda', 300, 'ml', '34-efe', 1000, 1500, 2000, 'Lata', 6, 12, 5, 'Activo'),
(2, 'Hamburguesa', 400, 'gr', '43-232', 15000, 16000, 17000, 'Predeterminado', 2, 7, 2, 'Activo'),
(3, 'Alitas BBQ', 200, 'gr', 'eoeoeo-2020220', 20000, 21000, 22000, 'Predeterminado', 2, 77, 2, 'Activo'),
(4, 'Coca cola cero', 750, 'ml', '001-Dk', 1700, 1900, 2200, 'Botella vidrio', 4, 88, 2, 'Activo'),
(5, 'Hamburguesa doble', 400, 'gr', '023-DN', 13000, 15000, 17000, 'Predeterminado', 2, 13, 1, 'Activo'),
(6, 'Hamburguesa triple', 900, 'gr', '033-DN', 19000, 21000, 23000, 'Predeterminado', 1, 32, 1, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
                                `id` tinyint(4) NOT NULL,
                                `Nombre` varchar(40) NOT NULL,
                                `CategoriaProducto` enum('Comida','Bebida','Postre') NOT NULL,
                                `Estado` enum('Activo','Inactivo') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id`, `Nombre`, `CategoriaProducto`, `Estado`) VALUES
(1, 'Platos a la carta', 'Comida', 'Inactivo'),
(2, 'Comida rapida', 'Comida', 'Activo'),
(3, 'Helado', 'Postre', 'Activo'),
(4, 'Bebida caliente', 'Bebida', 'Activo'),
(5, 'Bebida alcoholica', 'Bebida', 'Activo'),
(6, 'Bebida natural', 'Bebida', 'Activo'),
(7, 'Dulce de limon', 'Postre', 'Activo'),
(8, 'Desayunos', 'Comida', 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
                           `id` tinyint(3) UNSIGNED NOT NULL,
                           `Cedula` bigint(20) UNSIGNED DEFAULT NULL,
                           `Nombres` varchar(45) NOT NULL,
                           `Apellidos` varchar(45) DEFAULT NULL,
                           `Telefono` bigint(20) UNSIGNED NOT NULL,
                           `Direccion` varchar(60) DEFAULT NULL,
                           `Email` varchar(60) DEFAULT NULL,
                           `Contrasena` varchar(150) DEFAULT NULL,
                           `Rol` enum('Administrador','Proveedor','Cliente','Mesero','Cocinero','Domiciliario') NOT NULL,
                           `Estado` enum('Activo','Inactivo') NOT NULL,
                           `Empresa_id` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `Cedula`, `Nombres`, `Apellidos`, `Telefono`, `Direccion`, `Email`, `Contrasena`, `Rol`, `Estado`, `Empresa_id`) VALUES
(1, 1193088983, 'David Felipe', 'Diaz Vargas', 3132307498, 'Av coyote 12-56', 'entrepalospoderoso@gmail.com', '$2y$10$npLFEI57XqW6VNakCjb92.zSt1fAjAyrcMFanmPkW4UY33MWXaJHO', 'Administrador', 'Activo', 1),
(2, 1198648983, 'Sebastian Eduardo', 'Molano Diaz', 3136307498, 'Av currucui 12-56', 'entrepalosproso@gmail.com', '$2y$10$Ssn7zxdVvsDK/7YK9nwxYubpSRTjQlCMGuvHwloZIoEmwqYbb3jA6', 'Proveedor', 'Activo', 1),
(3, 1193094783, 'Bladimir Alejandro', 'Rojas Pinilla', 3197807498, 'calle 72-56', 'listopalospoderoso@gmail.com', '$2y$10$0/XRlq/uBDI8DDINfRDInOAwwxJu18WzNzUE3mGWIRI6/xtWv6Dbm', 'Mesero', 'Activo', 1),
(4, 1122212221, 'Isidro', 'Ramirez', 1212112221, '22d2dd2d2d', 'sdasdas@sjsjjs.com', '$2y$10$6MRCCjxTtSBO4u58YVo8JelHGkk5yCWEDDfc6zUcniJAyy/FJOzAy', 'Mesero', 'Activo', 13),
(5, 9842342343, 'Feney', 'Estu', 8656789078, 'gsgsgsgeceecec', 'corr@dsjdjd.co', '$2y$10$iEUp9rs8eAWE6GsVPjJtAetNwRlAjE9MEV8ClHi.Cv5jjbd49OUN2', 'Cliente', 'Activo', 5),
(6, 3333333, 'Estebanrrrr', 'Ericzenrrrr', 3434343433, 'abcdfdfdfdf', 'cccc@gmail.com', '$2y$10$cLRy1SOn71qDLZ9rI3YRUeIiEw24L5GMXmX4H2r3fcDBRoMizKKzu', 'Cliente', 'Activo', 4),
(7, 3234234324, 'ggregergrerg', 'rgergerg', 4242342343, 'rgergre', 'rgerg@fdsfd.co', '$2y$10$jdihXpA/XdkY3TBnENzJ/O82vxsy1qOcORto8mDkFVl0KmM/1Kniq', 'Administrador', 'Activo', 3),
(8, 112345646, 'Carlos', 'Azaustre', 2314567389, 'rtgr gtrhbntyntyjr', 'grgttttttt@dfjkdkfjerk', '$2y$10$1EDsm2bVuCBM/ZSE9jaOFOYa/uy5qUV6zegPjhdT/RgCY7bb6fK8O', 'Mesero', 'Activo', 4),
(9, 34367689, 'Arnol', 'Duque', 3424567894, 'grgrrghthththteffefefrgefgr', 'dddfsss@ffee.nom', '$2y$10$JpQ0tVnA1U6IA5DBMj4it.UOla/VcFHI/xi2z/hKiva8xsGNLcm9.', 'Cliente', 'Activo', 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consumotrabajador`
--
ALTER TABLE `consumotrabajador`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `id_UNIQUE` (`id`),
    ADD KEY `fk_Pago_has_Producto_Pago1_idx` (`Pago_id`),
    ADD KEY `fk_Pago_has_Producto_Producto1_idx` (`Producto_id`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `Departamento_nombre_unique` (`nombre`);

--
-- Indices de la tabla `detalleoferta`
--
ALTER TABLE `detalleoferta`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `id_UNIQUE` (`id`),
    ADD KEY `fk_Producto_has_Ofertas_Ofertas1_idx` (`Oferta_id`),
    ADD KEY `fk_Producto_has_Ofertas_Producto1_idx` (`Producto_id`);

--
-- Indices de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `id_UNIQUE` (`id`),
    ADD KEY `fk_DetallePedido_Producto1_idx` (`Producto_id`),
    ADD KEY `fk_DetallePedido_Mesa1_idx` (`Mesa_id`),
    ADD KEY `fk_DetallePedido_Ofertas1_idx` (`Ofertas_id`),
    ADD KEY `fk_DetallePedido_Factura1_idx` (`Factura_id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `id_UNIQUE` (`id`),
    ADD UNIQUE KEY `Nombre_UNIQUE` (`Nombre`),
    ADD UNIQUE KEY `Telefono_UNIQUE` (`Telefono`),
    ADD KEY `fk_Empresa_Municipio1_idx` (`Municipio_id`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `idTblFactura_UNIQUE` (`id`),
    ADD UNIQUE KEY `Numero_UNIQUE` (`Numero`),
    ADD KEY `fk_Factura_Usuario1_idx` (`Mesero_id`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `id_UNIQUE` (`id`),
    ADD UNIQUE KEY `Ruta_UNIQUE` (`Ruta`),
    ADD KEY `fk_Imagen_Producto1_idx` (`Producto_id`),
    ADD KEY `fk_Imagen_Oferta1_idx` (`Oferta_id`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `id_UNIQUE` (`id`),
    ADD KEY `fk_Marca_Usuario1_idx` (`Proveedor_id`);

--
-- Indices de la tabla `mesa`
--
ALTER TABLE `mesa`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `idTblMesa_UNIQUE` (`id`),
    ADD UNIQUE KEY `TblMesaNumero_UNIQUE` (`Numero`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
    ADD PRIMARY KEY (`id`),
    ADD KEY `Municipio_nombre_index` (`nombre`),
    ADD KEY `Municipio_departamento_id_index` (`departamento_id`);

--
-- Indices de la tabla `oferta`
--
ALTER TABLE `oferta`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `idTblPago_UNIQUE` (`id`),
    ADD KEY `fk_Pago_Usuario1_idx` (`Trabajador_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `idTblProducto_UNIQUE` (`id`),
    ADD UNIQUE KEY `TblProductoReferencia_UNIQUE` (`Referencia`),
    ADD KEY `fk_Producto_Subcategoria1_idx` (`Subcategoria_id`),
    ADD KEY `fk_Producto_Marca1_idx` (`Marca_id`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `idTblCategoriaProducto_UNIQUE` (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `idTblAdministrador_UNIQUE` (`id`),
    ADD UNIQUE KEY `TblAdministradorTelefono_UNIQUE` (`Telefono`),
    ADD UNIQUE KEY `TblAdministradorCedula_UNIQUE` (`Cedula`),
    ADD UNIQUE KEY `TblAdministradorEmail_UNIQUE` (`Email`),
    ADD UNIQUE KEY `TblAdministradorContrasena_UNIQUE` (`Contrasena`),
    ADD KEY `fk_Usuario_Empresa1_idx` (`Empresa_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consumotrabajador`
--
ALTER TABLE `consumotrabajador`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `detalleoferta`
--
ALTER TABLE `detalleoferta`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
    MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
    MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `mesa`
--
ALTER TABLE `mesa`
    MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99774;

--
-- AUTO_INCREMENT de la tabla `oferta`
--
ALTER TABLE `oferta`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
    MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
    MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
    MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `consumotrabajador`
--
ALTER TABLE `consumotrabajador`
    ADD CONSTRAINT `fk_Pago_has_Producto_Pago1` FOREIGN KEY (`Pago_id`) REFERENCES `pago` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_Pago_has_Producto_Producto1` FOREIGN KEY (`Producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalleoferta`
--
ALTER TABLE `detalleoferta`
    ADD CONSTRAINT `fk_Producto_has_Ofertas_Ofertas1` FOREIGN KEY (`Oferta_id`) REFERENCES `oferta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_Producto_has_Ofertas_Producto1` FOREIGN KEY (`Producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detallepedido`
--
ALTER TABLE `detallepedido`
    ADD CONSTRAINT `fk_DetallePedido_Factura1` FOREIGN KEY (`Factura_id`) REFERENCES `factura` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_DetallePedido_Mesa1` FOREIGN KEY (`Mesa_id`) REFERENCES `mesa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_DetallePedido_Ofertas1` FOREIGN KEY (`Ofertas_id`) REFERENCES `oferta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_DetallePedido_Producto1` FOREIGN KEY (`Producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `empresa`
--
ALTER TABLE `empresa`
    ADD CONSTRAINT `fk_Empresa_Municipio1` FOREIGN KEY (`Municipio_id`) REFERENCES `municipio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
    ADD CONSTRAINT `fk_Factura_Usuario1` FOREIGN KEY (`Mesero_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
    ADD CONSTRAINT `fk_Imagen_Oferta1` FOREIGN KEY (`Oferta_id`) REFERENCES `oferta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_Imagen_Producto1` FOREIGN KEY (`Producto_id`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `marca`
--
ALTER TABLE `marca`
    ADD CONSTRAINT `fk_Marca_Usuario1` FOREIGN KEY (`Proveedor_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
    ADD CONSTRAINT `Municipio_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamento` (`id`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
    ADD CONSTRAINT `fk_Pago_Usuario1` FOREIGN KEY (`Trabajador_id`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
    ADD CONSTRAINT `fk_Producto_Marca1` FOREIGN KEY (`Marca_id`) REFERENCES `marca` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_Producto_Subcategoria1` FOREIGN KEY (`Subcategoria_id`) REFERENCES `subcategoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
    ADD CONSTRAINT `fk_Usuario_Empresa1` FOREIGN KEY (`Empresa_id`) REFERENCES `empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
