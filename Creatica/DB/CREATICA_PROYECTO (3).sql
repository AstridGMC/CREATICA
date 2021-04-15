-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 02-11-2020 a las 07:57:45
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `CREATICA_PROYECTO`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AsignarCursoRegistrar` (IN `cui` VARCHAR(13), IN `nombres` VARCHAR(30), IN `apellidos` VARCHAR(30), IN `correo` VARCHAR(60), IN `contrasena` VARCHAR(25), IN `telefono` VARCHAR(12), IN `paisOrigen` VARCHAR(30), IN `fechaNacimiento` VARCHAR(12), IN `idCurso` BIGINT(200), IN `fechaIns` DATE)  NO SQL
BEGIN
	start transaction;
    
	INSERT INTO  ESTUDIANTE (`DPI`, `nombres`, `apellidos`, `correo`, `password`, `telefono`, `paisOrigen`, `fechaNacimiento`)  VALUES( cui, nombres, apellidos, correo, 
		contrasena, telefono, paisOrigen, fechaNacimiento);
        
	INSERT INTO  INSCRIPCION ( DPIEstudiante, idCurso, estadoCurso,
        fechaInscripcion) VALUES( cui , idCurso,'Sin finalizar', fechaIns );
    commit;    
END$$

CREATE DEFINER=`labmia`@`localhost` PROCEDURE `BuscarCursosPor` (IN `ID` INT)  BEGIN
	SELECT * FROM CURSO JOIN DETALLE_CURSO ON CURSO.idCurso= DETALLE_CURSO.idCurso WHERE CURSO.idCurso = ID;
END$$

CREATE DEFINER=`labmia`@`localhost` PROCEDURE `editarCurso` (IN `nombre` VARCHAR(30), IN `idArea` INT, IN `duracion` INT, IN `MONTO` FLOAT, IN `DESCRIPCION` VARCHAR(500), IN `IDCURSO` INT, IN `FECHAIN` DATE, IN `FECHAFIN` DATE, IN `DPIPROFE` CHAR(13))  BEGIN
	UPDATE CURSO INNER JOIN DETALLE_CURSO ON CURSO.idCurso =  DETALLE_CURSO.idCurso SET 
    CURSO.`Nombre` = nombre ,  CURSO.`idArea` = idarea , CURSO.`duracion` = duracion ,
    CURSO.`monto` = MONTO , CURSO.`descripcion` = DESCRIPCION,
	DETALLE_CURSO.`fechaInicio`  = FECHAIN ,  DETALLE_CURSO.`fechaFinal` = FECHAFIN ,
	DETALLE_CURSO.`DPIProfesor` = DPIPROFE
	WHERE  CURSO.`idCurso` = IDCURSO && DETALLE_CURSO.idCurso = IDCURSO;
      
END$$

CREATE DEFINER=`labmia`@`localhost` PROCEDURE `inscritosPorCurso` ()  NO SQL
BEGIN
	   SELECT CURSO.idCurso, CURSO.Nombre, count(*) as 'total inscritos' 
	   FROM INSCRIPCION LEFT JOIN CURSO ON INSCRIPCION.idCurso = CURSO.idCurso 
       GROUP BY INSCRIPCION.idCurso;
 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ADMINISTRADOR`
--

CREATE TABLE `ADMINISTRADOR` (
  `DPI` varchar(13) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ADMINISTRADOR`
--

INSERT INTO `ADMINISTRADOR` (`DPI`, `correo`, `nombres`, `apellidos`, `password`) VALUES
('3456871234121', 'marcos_alvarado@creatica.com', 'Marcos Adrian', 'Alvarado Francisco', 'FDSA'),
('5647643428476', 'carola_Fernandez@creatica.com', 'Marta Carola', 'Fernandez Mazariegos', 'PAS78'),
('6754543234564', 'aceli_marroquin@creatica.com', 'Aceli ', 'Marroquin', '123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AREA`
--

CREATE TABLE `AREA` (
  `idArea` int NOT NULL,
  `Nombre` varchar(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `AREA`
--

INSERT INTO `AREA` (`idArea`, `Nombre`) VALUES
(1, 'Tecnologia'),
(2, 'Gastronomia'),
(3, 'Idiomas'),
(4, 'Lenguaje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CURSO`
--

CREATE TABLE `CURSO` (
  `idCurso` int NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `idArea` int NOT NULL,
  `duracion` int NOT NULL,
  `monto` float NOT NULL,
  `descripcion` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `CURSO`
--

INSERT INTO `CURSO` (`idCurso`, `Nombre`, `idArea`, `duracion`, `monto`, `descripcion`) VALUES
(10, 'Edición de imagenes', 1, 90, 200, ' En este curso lograrás trabajar perfectamente con imágenes en capas, crear composiciones publicitarias,  descubrir cientos de filtros y efectos para obtener resultados de máximo impacto y de alta calidad.\" '),
(12, 'Desarrollo Web ', 1, 120, 550, '   Una introducción a todos los conocimientos que los desarrolladores web deben poseer para comenzar en el mundo de la creación de sitios web.\" \" \" '),
(15, 'Inglés Avanzado', 3, 30, 280, ' El curso para usuarios avanzados, para los que quieren perfeccionar su inglés. Al finalizar este curso, el usuario será capaz de comunicarse efectivamente en inglés.'),
(20, 'Oratoria y Lenguaje físico', 4, 60, 200, 'Este curso es de nivel introductorio, aprenderás a comunicarte de manera efectiva y persuadir con técnicas de oralidad y expresión corporal'),
(21, 'Cocina Internacional', 2, 30, 200, 'Aprende a cocinar decenas de increíbles platillos, nacionales e internacionales, en un diplomado 100% práctico, con ingredientes incluidos y un amplio menú. Ideal para todo público.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `DETALLE_CURSO`
--

CREATE TABLE `DETALLE_CURSO` (
  `idCurso` int NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `DPIProfesor` char(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `DETALLE_CURSO`
--

INSERT INTO `DETALLE_CURSO` (`idCurso`, `fechaInicio`, `fechaFinal`, `DPIProfesor`) VALUES
(10, '2020-06-01', '2020-06-03', '8789052781495'),
(12, '2020-08-06', '2020-11-04', '8789052781495'),
(20, '2020-06-01', '2020-06-01', '8789052781495'),
(21, '2020-06-01', '2020-06-01', '8789052781495'),
(15, '2020-06-01', '2020-06-01', '8789052781495');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESTUDIANTE`
--

CREATE TABLE `ESTUDIANTE` (
  `DPI` char(13) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `password` varchar(25) DEFAULT NULL,
  `telefono` varchar(12) NOT NULL,
  `paisOrigen` varchar(30) NOT NULL,
  `fechaNacimiento` varchar(30) NOT NULL,
  `claveEstudiante` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ESTUDIANTE`
--

INSERT INTO `ESTUDIANTE` (`DPI`, `nombres`, `apellidos`, `correo`, `password`, `telefono`, `paisOrigen`, `fechaNacimiento`, `claveEstudiante`) VALUES
('1094444029478', 'Georgina Esperanza', 'Roa Yanac', 'roa_georgina@creatica.com', '4Ri6Pz', '67457137', 'India', '11/04/1905', NULL),
('1111112111111', 'Maria Daniela', 'Montero Mazariegos', 'maria-mazar@creatica.com', 'ASDPO', '34342312', 'Venezuela', '10/12/2005', NULL),
('1245142205268', 'Roberto Julian', 'Llaja Tafur', 'llaja_roberto@creatica.com', '6Zu8Ks', '18631436', 'El Salvador', '3/09/2007', NULL),
('1612164249924', 'Miriam', 'García Peralta', 'garcia_miriam@creatica.com', '6Gm8Hq', '16275113', 'China', '10/02/1967', NULL),
('1634793851838', 'Jacquelin', 'Trujillo Parodi', 'trujillo_jacquelin@creatica.com', '0Cx0Fu', '52332274', 'Kiribati', '30/03/1920', NULL),
('1782502339663', 'Marlene Victoria', 'Gonzales Huilca', 'gonzales_marlene@creatica.com', '2Vk8Gl', '77351578', 'Ciudad del Vaticano', '24/08/1908', NULL),
('1896249867175', 'Christian Nelson', 'Alcalá Negrón', 'alcala_christian@creatica.com', '9Oc5Lv', '34253565', 'Alemania', '30/12/1923', NULL),
('2183239792732', 'Angel', 'Solano Vargas', 'solano_angel@creatica.com', '8In8Ao', '86636433', 'Jordania', '11/05/1935', NULL),
('2424663776274', 'Javier', 'Arevalo Lopez', 'arevalo_javier@creatica.com', '9Xv2Yx', '73356484', 'Arabia Saudita', '27/05/1920', NULL),
('2481797768231', 'Walter David', 'Huaytan Sauñe', 'huaytan_walter@creatica.com', '2Hf5Lw', '47271366', 'Dominica', '3/06/1915', NULL),
('2673178712142', 'Marco Tulio', 'Alocen Barrera', 'alocen_marco@creatica.com', '3Jh2Uw', '58111834', 'Armenia', '6/01/1966', NULL),
('2791319988362', 'Guillermo Jonathan', 'Velasquez Ramos', 'velasquez_guillermo@creatica.com', '5Kx5Ar', '87363141', 'Laos', '19/06/2003', NULL),
('2794293466135', 'Doris', 'Cores Moreno', 'cores_doris@creatica.com', '9Dj4Dm', '42275241', 'Brasil', '7/01/1906', NULL),
('3124416569842', 'Olga', 'Ferro Salas', 'ferro_olga@creatica.com', '5No9Lz', '45826251', 'Canadá', '24/09/2006', NULL),
('3166847164968', 'Jorge Augusto', 'Carrión Neira', 'carrion_jorge@creatica.com', '7Vp9Fc', '67335638', 'Birmania', '29/09/1950', NULL),
('3173889023845', 'Magda Janeth', 'Maravi Navarro', 'maravi_magda@creatica.com', '6Px8Iu', '16661736', 'Etiopía', '13/07/1932', NULL),
('3362249215113', 'Isela Flor', 'Baylón Rojas', 'baylon_isela@creatica.com', '8Jw1Ya', '75333222', 'Austria', '18/07/1979', NULL),
('3406981042422', 'Jose Alberto', 'Tejedo Luna', 'tejedo_jose@creatica.com', '1Kv6Yz', '63748177', 'Kazajistán', '8/04/1947', NULL),
('3482468796238', 'Olga', 'Ore Reyes', 'ore_olga@creatica.com', '0Bf4Zj', '23312426', 'Georgia', '11/12/1914', NULL),
('3519985971756', 'Nelson', 'Boza Solis', 'boza_nelson@creatica.com', '5Je5Yr', '73583154', 'Baréin', '31/05/1904', NULL),
('3716125171883', 'Clara', 'Guzman Quispe', 'guzman_clara@creatica.com', '2Cj8Mx', '44273521', 'Corea del Sur', '12/01/1926', NULL),
('3749962798716', 'Rosa Maria', 'Romero Gomez Sanchez', 'romero_rosa@creatica.com', '9Nc3Dk', '58337267', 'Irlanda', '31/10/2015', NULL),
('3753834438624', 'Elsa Patricia', 'Gonzales Medina', 'gonzales_elsa@creatica.com', '9Te1Ta', '27475272', 'Colombia', '27/06/1980', NULL),
('3765822016389', 'Carlos Enrique', 'Fernandez Guzman', 'fernandez_carlos@creatica.com', '4Nz9Ye', '76265246', 'Camboya', '29/05/1967', NULL),
('3785606711595', 'Zarita', 'Chancos Mendoza', 'chancos_zarita@creatica.com', '5Nr4Dg', '25531356', 'Bosnia y Herzegovina', '1/06/2019', NULL),
('3936123466855', 'Gissela', 'Maguiña San Yen Man', 'maguinia_gissela@creatica.com', '9Uc0Wb', '67637677', 'Eslovaquia', '4/02/2012', NULL),
('4027531222546', 'Javier', 'Gutierrez Velez', 'gutierrez_javier@creatica.com', '5Km8Ny', '13577178', 'Comoras', '3/06/1971', NULL),
('4171244858185', 'Rosa Josefa', 'Rodriguez Farias', 'rodriguez_rosa@creatica.com', '0Lq4Zr', '73875323', 'Irak', '27/10/2001', NULL),
('4222666404678', 'Edwin', 'Flores Romero', 'flores_edwin@creatica.com', '1Ds9Ex', '87774126', 'Catar', '23/12/1948', NULL),
('4286454125131', 'Antonio', 'De Loayza Conterno', 'de_antonio@creatica.com', '8Qk8Gw', '67673682', 'Burkina Faso', '14/04/1992', NULL),
('4312197233281', 'Juan Elvis', 'Riquelme Miranda', 'riquelme_juan@creatica.com', '4Ai4Qo', '56512537', 'Hungría', '8/07/1920', NULL),
('4336415935114', 'Elizabeth', 'Miguel Holgado', 'miguel_elizabeth@creatica.com', '0Jg3Rz', '71841415', 'Francia', '6/01/2006', NULL),
('4438874842227', 'Roberto', 'Gamarra Astete', 'gamarra_roberto@creatica.com', '1Oa2Jf', '77831122', 'Chad', '6/04/1910', NULL),
('4656494847231', 'Daniel', 'Acevedo Jhong', 'acevedo_daniel@creatica.com', '8Eo2It', '17354418', 'Afganistán', '29/04/1992', NULL),
('4783141174172', 'Santiago Victor', 'Paredes Jaramillo', 'paredes_santiago@creatica.com', '6Fl9Yv', '24741336', 'Guatemala', '2/10/1984', NULL),
('4863431337833', 'Gerardo David', 'Riega Calle', 'riega_gerardo@creatica.com', '5Sg0Nj', '26254487', 'Guinea-Bisáu', '25/06/1985', NULL),
('4874727879562', 'Guillermo', 'Casapia Valdivia', 'casapia_guillermo@creatica.com', '8Zu7Io', '52785554', 'Bolivia', '23/08/1979', NULL),
('4956992981976', 'Carmen Rosa', 'Pardave Camacho', 'pardave_carmen@creatica.com', '6Op1Zc', '31345518', 'Grecia', '8/12/1903', NULL),
('4978274531379', 'Leoncia', 'Bedoya Castillo', 'bedoya_leoncia@creatica.com', '3Cp7Ej', '28438568', 'Azerbaiyán', '10/12/2005', NULL),
('5161815689159', 'Esther Aurora', 'Fernandez Matta', 'fernandez_esther@creatica.com', '9Wq8Zb', '88112416', 'Camerún', '23/07/1917', NULL),
('5251898795196', 'Jorge', 'Alosilla Velazco Vera', 'alosilla_jorge@creatica.com', '3Tn9Az', '71473672', 'Angola', '11/07/1933', NULL),
('5324821702584', 'Cielito Mercedes', 'Calle Betancourt', 'calle_cielito@creatica.com', '5Vc8Kn', '28484873', 'Bélgica', '6/06/1989', NULL),
('5417786901685', 'Blanca Katty', 'Vilca Lucero', 'vilca_blanca@creatica.com', '3Dp4Fg', '13843136', 'Letonia', '18/04/1930', NULL),
('5635525352854', 'Enrique', 'Pinedo Nuñez', 'pinedo_enrique@creatica.com', '3Mu5Nz', '73848132', 'Guinea', '2/06/1901', NULL),
('5656462744969', 'Josué Victor', 'Orrillo Ortiz', 'orrillo_josue@creatica.com', '8Ie9Qv', '23314681', 'Granada', '1/10/1947', NULL),
('5836513518265', 'Angel', 'Tenorio Davila', 'tenorio_angel@creatica.com', '0Ek1Mh', '78143455', 'Kenia', '30/01/2004', NULL),
('5873195343149', 'Maribel Corina', 'Cortez Lozano', 'cortez_maribel@creatica.com', '2Nx0Yl', '52248388', 'Brunéi', '27/02/1966', NULL),
('5881997513429', 'Guillermo', 'Horruitiner Martinez', 'horruitiner_guillermo@creatica.com', '6Tp5Lx', '63216455', 'Costa Rica', '1/05/2014', NULL),
('6029073589375', 'Angel', 'Crispin Quispe', 'crispin_angel@creatica.com', '5Vh0Ti', '36536483', 'Bulgaria', '18/02/1993', NULL),
('6121145471117', 'Aida Cristina', 'Ruiz De Castilla Britto', 'ruiz_aida@creatica.com', '4Uw3Ev', '38474388', 'Islas Salomón', '10/01/1968', NULL),
('6239264731714', 'Carlos P', 'Melgarejo Vibes', 'melgarejo_carlos@creatica.com', '3Le2Oa', '27716331', 'Fiyi', '28/09/1975', NULL),
('6267212025821', 'Elba Mercedes', 'La Rosa Fabian', 'larosa_elba@creatica.com', '1Mj4Qb', '34856144', 'Ecuador', '17/02/1968', NULL),
('6421015204948', 'Manuel Antonio', 'Mori Ramirez', 'mori_manuel@creatica.com', '8Jc6Vv', '36883428', 'Gabón', '22/06/1911', NULL),
('6438738614741', 'Hector', 'Lujan Venegas', 'lujan_hector@creatica.com', '3Ly2Ay', '36361162', 'Eritrea', '9/05/1945', NULL),
('6503708633545', 'Orfelina', 'Llenpen Nuñez', 'llenpen_orfelina@creatica.com', '1Dt3Oa', '46664768', 'Emiratos Árabes Unidos', '21/11/1919', NULL),
('6547095719627', 'Violeta Marilu', 'Salinas Puccio', 'salinas_violeta@creatica.com', '9Wf2Sj', '68768437', 'Italia', '10/06/1926', NULL),
('6599622212522', 'Teresa', 'Rios Lima', 'rios_teresa@creatica.com', '5Oq7Ls', '55452258', 'Honduras', '4/12/1915', NULL),
('6621473859294', 'Ramiro Alberto', 'Bejar Torres', 'bejar_ramiro@creatica.com', '3Wo8Uj', '88851134', 'Bangladés', '7/02/1952', NULL),
('6678315852275', 'Elena Rosavelt', 'Guzman Chinag', 'guzman_elena@creatica.com', '4Av0Yh', '56362231', 'Corea del Norte', '7/01/1936', NULL),
('6864916904472', 'Rosa Liliana', 'Robles Valverde', 'robles_rosa@creatica.com', '2Qx1Zy', '87655141', 'Indonesia', '23/12/1934', NULL),
('6952827964613', 'Carlos Alberto', 'Nuñez Huayanay', 'nuniez_carlos@creatica.com', '3Vw3Ai', '75543522', 'Gambia', '2/10/1971', NULL),
('7055223514855', 'Ana Maria', 'Diaz Salinas', 'diaz_ana@creatica.com', '4Gl6Xs', '72618523', 'Burundi', '13/05/1984', NULL),
('7099277915696', 'Milagros Susan', 'Herrera Carbajal', 'herrera_milagros@creatica.com', '4Dz0Ck', '64357143', 'Costa de Marfil', '9/09/1910', NULL),
('7194562786283', 'Lourdes', 'Huamani Flores', 'huamani_lourdes@creatica.com', '2Xn0Hj', '68323287', 'Croacia', '26/12/1982', NULL),
('7201521865755', 'Rosario', 'Arias Hernandez', 'arias_rosario@creatica.com', '6Uo7Rt', '57752554', 'Argelia', '22/06/1979', NULL),
('7227378379449', 'Augusto', 'Sanchez Arone', 'sanchez_augusto@creatica.com', '0Eb1Dj', '81646255', 'Jamaica', '28/01/1995', NULL),
('7324725432528', 'Arturo', 'Gonzales Del Valle Maguiño', 'gonzales_arturo@creatica.com', '5Um3Uo', '36485112', 'Chipre', '12/10/1970', NULL),
('7411491686688', 'Antonio', 'Dueñas Aristisabal', 'duenias_antonio@creatica.com', '5Ju2Bq', '16434883', 'Bután', '11/01/1968', NULL),
('7533516494879', 'Pedro Guillermo', 'Landa Ginocchio', 'landa_pedro@creatica.com', '5Mj9Lp', '83754257', 'Egipto', '23/10/1938', NULL),
('7666181043141', 'Luis Armando', 'Huapaya Raygada', 'huapaya_luis@creatica.com', '1Ld4Un', '11372334', 'Cuba', '23/09/1972', NULL),
('7743745233321', 'Miguel Vicente', 'Agurto Rondoy', 'agurto_miguel@creatica.com', '3Kl2Xb', '72266316', 'Albania', '23/05/1957', NULL),
('7764111691624', 'Carina Magnolia', 'Rosales Flores', 'rosales_carina@creatica.com', '4Wz3Kw', '32855734', 'Islandia', '3/12/1908', NULL),
('7869188725423', 'Yuliana', 'Espinoza Arana', 'espinoza_yuliana@creatica.com', '9Ov6Op', '66812134', 'Cabo Verde', '21/03/2005', NULL),
('7915156396923', 'Pedro Manuel', 'Santa Cruz Benssa', 'santa_pedro@creatica.com', '0Tq0Wx', '78781615', 'Japón', '9/11/1973', NULL),
('7916067422954', 'Carlos', 'Chirinos Lacotera', 'chirinos_carlos@creatica.com', '4Dd3Qy', '31746237', 'Botsuana', '19/02/1969', NULL),
('8012504195721', 'Javier', 'Benavides Espejo', 'benavides_javier@creatica.com', '7Wf8Wx', '16374635', 'Barbados', '9/09/1905', NULL),
('8112458659379', 'Efraín', 'Arroyo Ramírez', 'arroyo_efrain@creatica.com', '8Zt9Sx', '72244573', 'Argentina', '18/10/1999', NULL),
('8189398836714', 'Oscar Enrique', 'Medina Zuta', 'medina_oscar@creatica.com', '5Jf4Zs', '13852878', 'Finlandia', '21/08/1975', NULL),
('8278595896198', 'Jenny Maria', 'Mallqui Celestino', 'mallqui_jenny@creatica.com', '2Mi3Uy', '57175534', 'Estados Unidos', '3/06/2020', NULL),
('8285387785399', 'Freddy', 'Rios Lima', 'rios_freddy@creatica.com', '8Nt7Rs', '54176762', 'Haití', '2/07/2005', NULL),
('8412682708922', 'Estalins', 'Carrillo Segura', 'carrillo_estalins@creatica.com', '7Xd6Bp', '37612244', 'Bielorrusia', '11/07/1983', NULL),
('8479631904862', 'Sonia', 'Prada Vilchez', 'prada_sonia@creatica.com', '0Ul9Bl', '32857326', 'Guinea ecuatorial', '26/05/2010', NULL),
('8505332448329', 'Gizella', 'Carrera Abanto', 'carrera_gizella@creatica.com', '2Xa3Iu', '61444613', 'Benín', '28/05/1970', NULL),
('8517336186884', 'Cosme Adolfo', 'Maldonado Quispe', 'maldonado_cosme@creatica.com', '8Df2Pj', '16762463', 'Eslovenia', '31/05/1954', NULL),
('8518106685845', 'Isabel Florisa', 'Caraza Villegas', 'caraza_isabel@creatica.com', '5Oz4Kt', '62478558', 'Belice', '2/10/1937', NULL),
('8673817033762', 'Gloria', 'Gamio Lozano', 'gamio_gloria@creatica.com', '7Jl9Lf', '87788865', 'Chile', '24/07/2017', NULL),
('8688308288682', 'Cesar', 'Baiocchi Ureta', 'baiocchi_cesar@creatica.com', '9Mw0Mb', '58668583', 'Australia', '7/09/1909', NULL),
('8689616635572', 'Arturo', 'Pastor Porras', 'pastor_arturo@creatica.com', '2Qa7Yi', '57364718', 'Guyana', '29/09/1932', NULL),
('8721159019482', 'Marcos', 'Huarcaya Quispe', 'huarcaya_marcos@creatica.com', '9Nl7Nh', '84514257', 'Dinamarca', '1/07/1999', NULL),
('8825706045463', 'Ruth Noricila', 'Vega Carreazo', 'vega_ruth@creatica.com', '7Uv7Xh', '45146337', 'Kuwait', '1/03/2013', NULL),
('8861589664797', 'Alejandro', 'Vera Silva', 'vera_alejandro@creatica.com', '9By5Iz', '45312872', 'Lesoto', '18/01/1961', NULL),
('8876977871259', 'Victor', 'Alva Campos', 'alva_victor@creatica.com', '7Yn8Ns', '42278552', 'Antigua y Barbuda', '18/05/1911', NULL),
('9029249139433', 'Sandra Monica', 'Maldonado Tinco', 'maldonado_sandra@creatica.com', '3Ph2Hx', '74143245', 'España', '7/10/2017', NULL),
('9041676992762', 'Martin', 'Martinez Marquez', 'martinez_martin@creatica.com', '2Xc9Gg', '45563185', 'Filipinas', '14/04/1979', NULL),
('9211127436756', 'Maria De Fatima', 'Rojas Valdivia', 'rojas_maria@creatica.com', '5As3Ch', '42648418', 'Irán', '15/03/1927', NULL),
('9334296295774', 'Raul Eduardo', 'Almora Hernandez', 'almora_raul@creatica.com', '3Mi3Nl', '42825515', 'Andorra', '25/03/1935', NULL),
('9334707235336', 'Carlos Jose', 'Rosas Bonifaz', 'rosas_carlos@creatica.com', '2Mg6Ll', '11424677', 'Islas Marshall', '8/11/1998', NULL),
('9519253166169', 'Miguel Angel', 'Torres Gaspar', 'torres_miguel@creatica.com', '3Xm4Yb', '11785744', 'Kirguistán', '16/07/1967', NULL),
('9525141272734', 'Santiago', 'Mamani Uchasara', 'mamani_santiago@creatica.com', '4Ep5Uz', '16148166', 'Estonia', '25/10/1983', NULL),
('9592724974729', 'Celin', 'Salcedo Del Pino', 'salcedo_celin@creatica.com', '3Rg3Pc', '48155363', 'Israel', '6/04/1984', NULL),
('9853067544943', 'Luz Marina', 'Bedregal Canales', 'bedregal_luz@creatica.com', '9Cd1Ec', '67544552', 'Bahamas', '15/12/1915', NULL),
('9954105586643', 'Enrique Godofredo', 'Vilgoso Alvarado', 'vilgoso_enrique@creatica.com', '1Gi6Bd', '23116316', 'Líbano', '25/03/1957', NULL);

--
-- Disparadores `ESTUDIANTE`
--
DELIMITER $$
CREATE TRIGGER `clave` BEFORE INSERT ON `ESTUDIANTE` FOR EACH ROW SET NEW.claveEstudiante = CONCAT ( CHAR(FLOOR(RAND()*10)+48), CHAR(FLOOR(RAND()*26)+65), CHAR(FLOOR(RAND()*26)+97), CHAR(FLOOR(RAND()*10)+48), CHAR(FLOOR(RAND()*26)+65), CHAR(FLOOR(RAND()*26)+97) )
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INSCRIPCION`
--

CREATE TABLE `INSCRIPCION` (
  `DPIEstudiante` char(13) NOT NULL,
  `idCurso` int NOT NULL,
  `idInscripcion` int NOT NULL,
  `estadoCurso` varchar(15) NOT NULL,
  `fechaInscripcion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `INSCRIPCION`
--

INSERT INTO `INSCRIPCION` (`DPIEstudiante`, `idCurso`, `idInscripcion`, `estadoCurso`, `fechaInscripcion`) VALUES
('4656494847231', 10, 100, 'Finalizado', '2020-07-23'),
('7743745233321', 12, 101, 'Sin finalizar', '2020-07-11'),
('1896249867175', 20, 102, 'Finalizado', '2020-01-12'),
('9334296295774', 21, 103, 'Sin finalizar', '2020-03-01'),
('5251898795196', 15, 104, 'Finalizado', '2020-01-15'),
('8876977871259', 10, 105, 'Sin finalizar', '2020-07-01'),
('2424663776274', 12, 106, 'Finalizado', '2020-07-24'),
('7201521865755', 20, 107, 'Sin finalizar', '2020-01-16'),
('8112458659379', 21, 108, 'Finalizado', '2020-02-23'),
('2673178712142', 15, 109, 'Finalizado', '2020-04-04'),
('8688308288682', 10, 110, 'Finalizado', '2020-07-10'),
('3362249215113', 12, 111, 'Sin finalizar', '2020-03-20'),
('4978274531379', 20, 112, 'Finalizado', '2020-08-07'),
('9853067544943', 21, 113, 'Sin finalizar', '2020-06-16'),
('6621473859294', 15, 114, 'Finalizado', '2020-04-02'),
('8012504195721', 10, 115, 'Finalizado', '2020-04-15'),
('3519985971756', 12, 116, 'Finalizado', '2020-02-29'),
('5324821702584', 20, 117, 'Sin finalizar', '2020-04-23'),
('8518106685845', 21, 118, 'Finalizado', '2020-04-17'),
('8505332448329', 15, 119, 'Sin finalizar', '2020-05-18'),
('8412682708922', 10, 120, 'Finalizado', '2020-08-19'),
('3166847164968', 12, 121, 'Sin finalizar', '2020-01-18'),
('4874727879562', 20, 122, 'Finalizado', '2020-05-02'),
('3785606711595', 21, 123, 'Sin finalizar', '2020-08-29'),
('7916067422954', 15, 124, 'Finalizado', '2020-01-05'),
('2794293466135', 10, 125, 'Finalizado', '2020-01-22'),
('5873195343149', 12, 126, 'Finalizado', '2020-01-06'),
('6029073589375', 20, 127, 'Sin finalizar', '2020-09-03'),
('4286454125131', 21, 128, 'Finalizado', '2020-01-25'),
('7055223514855', 15, 129, 'Sin finalizar', '2020-04-25'),
('7411491686688', 10, 130, 'Finalizado', '2020-07-24'),
('7869188725423', 12, 131, 'Finalizado', '2020-04-14'),
('3765822016389', 20, 132, 'Finalizado', '2020-08-28'),
('5161815689159', 21, 133, 'Sin finalizar', '2020-02-20'),
('3124416569842', 15, 134, 'Finalizado', '2020-09-07'),
('4222666404678', 10, 135, 'Sin finalizar', '2020-06-11'),
('4438874842227', 12, 136, 'Finalizado', '2020-09-23'),
('8673817033762', 20, 137, 'Sin finalizar', '2020-03-10'),
('1612164249924', 21, 138, 'Finalizado', '2020-06-21'),
('7324725432528', 15, 139, 'Sin finalizar', '2020-02-20'),
('1782502339663', 10, 140, 'Finalizado', '2020-01-31'),
('3753834438624', 12, 141, 'Finalizado', '2020-02-25'),
('4027531222546', 20, 142, 'Finalizado', '2020-06-23'),
('6678315852275', 21, 143, 'Sin finalizar', '2020-09-23'),
('3716125171883', 15, 144, 'Finalizado', '2020-01-15'),
('7099277915696', 10, 145, 'Sin finalizar', '2020-09-16'),
('5881997513429', 12, 146, 'Finalizado', '2020-08-20'),
('7194562786283', 20, 147, 'Finalizado', '2020-06-04'),
('7666181043141', 21, 148, 'Finalizado', '2020-03-07'),
('8721159019482', 15, 149, 'Sin finalizar', '2020-07-02'),
('2481797768231', 10, 150, 'Finalizado', '2020-04-21'),
('6267212025821', 12, 151, 'Sin finalizar', '2020-03-22'),
('7533516494879', 20, 152, 'Finalizado', '2020-09-01'),
('1245142205268', 21, 153, 'Sin finalizar', '2020-06-12'),
('6503708633545', 15, 154, 'Finalizado', '2020-04-20'),
('6438738614741', 10, 155, 'Sin finalizar', '2020-03-29'),
('3936123466855', 12, 156, 'Finalizado', '2020-09-22'),
('8517336186884', 20, 157, 'Finalizado', '2020-07-11'),
('9029249139433', 21, 158, 'Finalizado', '2020-09-02'),
('8278595896198', 15, 159, 'Sin finalizar', '2020-01-04'),
('9525141272734', 10, 160, 'Finalizado', '2020-09-06'),
('3173889023845', 12, 161, 'Sin finalizar', '2020-08-29'),
('9041676992762', 20, 162, 'Finalizado', '2020-05-20'),
('8189398836714', 21, 163, 'Finalizado', '2020-06-24'),
('6239264731714', 15, 164, 'Finalizado', '2020-09-24'),
('4336415935114', 10, 165, 'Sin finalizar', '2020-05-09'),
('6421015204948', 12, 166, 'Finalizado', '2020-04-16'),
('6952827964613', 20, 167, 'Sin finalizar', '2020-01-21'),
('3482468796238', 21, 168, 'Finalizado', '2020-04-21'),
('4343705962974', 15, 169, 'Sin finalizar', '2020-08-22'),
('5656462744969', 10, 170, 'Finalizado', '2020-08-10'),
('4956992981976', 12, 171, 'Sin finalizar', '2020-08-18'),
('4783141174172', 20, 172, 'Finalizado', '2020-07-21'),
('8689616635572', 21, 173, 'Finalizado', '2020-07-06'),
('5635525352854', 15, 174, 'Finalizado', '2020-06-23'),
('8479631904862', 10, 175, 'Sin finalizar', '2020-01-03'),
('4863431337833', 12, 176, 'Finalizado', '2020-09-30'),
('8285387785399', 20, 177, 'Sin finalizar', '2020-09-22'),
('6599622212522', 21, 178, 'Finalizado', '2020-02-11'),
('4312197233281', 15, 179, 'Finalizado', '2020-07-15'),
('1094444029478', 10, 180, 'Sin finalizar', '2020-07-10'),
('6864916904472', 12, 181, 'Finalizado', '2020-04-22'),
('4171244858185', 20, 182, 'Sin finalizar', '2020-07-31'),
('9211127436756', 21, 183, 'Finalizado', '2020-06-14'),
('3749962798716', 15, 184, 'Sin finalizar', '2020-10-01'),
('7764111691624', 10, 185, 'Finalizado', '2020-07-01'),
('9334707235336', 12, 186, 'Finalizado', '2020-06-30'),
('6121145471117', 20, 187, 'Finalizado', '2020-06-14'),
('9592724974729', 21, 188, 'Sin finalizar', '2020-06-19'),
('6547095719627', 15, 189, 'Finalizado', '2020-09-20'),
('7227378379449', 10, 190, 'Sin finalizar', '2020-02-22'),
('7915156396923', 12, 191, 'Finalizado', '2020-04-11'),
('2183239792732', 20, 192, 'Finalizado', '2020-07-11'),
('3406981042422', 21, 193, 'Sin finalizar', '2020-04-20'),
('5836513518265', 15, 194, 'Finalizado', '2020-08-30'),
('9519253166169', 10, 195, 'Sin finalizar', '2020-04-13'),
('1634793851838', 12, 196, 'Finalizado', '2020-09-25'),
('8825706045463', 20, 197, 'Sin finalizar', '2020-05-19'),
('2791319988362', 21, 198, 'Finalizado', '2020-03-18'),
('8861589664797', 15, 199, 'Finalizado', '2020-03-03'),
('5417786901685', 10, 200, 'Finalizado', '2020-04-26'),
('9954105586643', 12, 201, 'Sin finalizar', '2020-09-26'),
('', 21, 209, 'Sin Finalizar', '2020-11-02'),
('', 21, 210, 'Sin Finalizar', '2020-11-02'),
('4656494847231', 21, 211, 'Sin Finalizar', '2020-11-02');

--
-- Disparadores `INSCRIPCION`
--
DELIMITER $$
CREATE TRIGGER `estado` BEFORE INSERT ON `INSCRIPCION` FOR EACH ROW SET NEW.estadoCurso='Sin Finalizar'
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PAGOS`
--

CREATE TABLE `PAGOS` (
  `idInscripcion` int NOT NULL,
  `estadoPago` tinyint NOT NULL,
  `fechaPago` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `PAGOS`
--

INSERT INTO `PAGOS` (`idInscripcion`, `estadoPago`, `fechaPago`) VALUES
(100, 1, '2020-07-28'),
(101, 0, '2020-06-07'),
(102, 1, '2020-08-13'),
(103, 0, '2020-08-12'),
(104, 1, '2020-06-20'),
(105, 0, '2020-08-03'),
(106, 1, '2020-08-09'),
(107, 0, '2020-05-15'),
(108, 1, '2020-03-24'),
(109, 1, '2020-05-07'),
(110, 1, '2020-04-22'),
(111, 0, '2020-05-30'),
(112, 1, '2020-02-12'),
(113, 0, '2020-07-26'),
(114, 1, '2020-09-11'),
(115, 1, '2020-09-26'),
(116, 1, '2020-08-03'),
(117, 0, '2020-09-08'),
(118, 1, '2020-08-20'),
(119, 0, '2020-02-15'),
(120, 1, '2020-07-27'),
(121, 0, '2020-05-19'),
(122, 1, '2020-04-15'),
(123, 0, '2020-06-06'),
(124, 1, '2020-01-12'),
(125, 1, '2020-02-03'),
(126, 1, '2020-03-22'),
(127, 0, '2020-09-14'),
(128, 1, '2020-08-26'),
(129, 0, '2020-05-21'),
(130, 1, '2020-09-04'),
(131, 1, '2020-04-12'),
(132, 1, '2020-05-12'),
(133, 0, '2020-07-14'),
(134, 1, '2020-08-19'),
(135, 0, '2020-07-01'),
(136, 1, '2020-09-29'),
(137, 0, '2020-09-23'),
(138, 1, '2020-02-01'),
(139, 0, '2020-04-10'),
(140, 1, '2020-08-18'),
(141, 1, '2020-02-10'),
(142, 1, '2020-09-21'),
(143, 0, '2020-04-06'),
(144, 1, '2020-08-14'),
(145, 0, '2020-05-12'),
(146, 1, '2020-08-23'),
(147, 1, '2020-08-17'),
(148, 1, '2020-04-22'),
(149, 0, '2020-05-22'),
(150, 1, '2020-05-13'),
(151, 0, '2020-09-10'),
(152, 1, '2020-09-18'),
(153, 0, '2020-05-04'),
(154, 1, '2020-07-10'),
(155, 0, '2020-03-10'),
(156, 1, '2020-01-15'),
(157, 1, '2020-09-04'),
(158, 1, '2020-07-18'),
(159, 0, '2020-04-22'),
(160, 1, '2020-05-12'),
(161, 0, '2020-07-05'),
(162, 1, '2020-06-29'),
(163, 1, '2020-02-29'),
(164, 1, '2020-04-15'),
(165, 0, '2020-01-29'),
(166, 1, '2020-08-17'),
(167, 0, '2020-04-09'),
(168, 1, '2020-03-06'),
(169, 0, '2020-08-30'),
(170, 1, '2020-03-27'),
(171, 0, '2020-03-12'),
(172, 1, '2020-09-02'),
(173, 1, '2020-05-29'),
(174, 1, '2020-07-13'),
(175, 0, '2020-04-02'),
(176, 1, '2020-03-24'),
(177, 0, '2020-03-04'),
(178, 1, '2020-06-23'),
(179, 1, '2020-06-19'),
(180, 0, '2020-09-23'),
(181, 1, '2020-04-25'),
(182, 0, '2020-09-18'),
(183, 1, '2020-07-22'),
(184, 0, '2020-01-21'),
(185, 1, '2020-01-17'),
(186, 1, '2020-03-06'),
(187, 1, '2020-03-06'),
(188, 0, '2020-01-16'),
(189, 1, '2020-06-17'),
(190, 0, '2020-06-29'),
(191, 1, '2020-04-18'),
(192, 1, '2020-02-05'),
(193, 0, '2020-03-21'),
(194, 1, '2020-09-29'),
(195, 0, '2020-06-08'),
(196, 1, '2020-04-15'),
(197, 0, '2020-08-27'),
(198, 1, '2020-01-26'),
(199, 1, '2020-06-08'),
(200, 1, '2020-05-25'),
(201, 0, '2020-04-15'),
(210, 1, '2020-11-02'),
(211, 1, '2020-11-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PROFESOR`
--

CREATE TABLE `PROFESOR` (
  `DPI` char(13) NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `Telefono` varchar(13) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(25) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `PROFESOR`
--

INSERT INTO `PROFESOR` (`DPI`, `nombres`, `apellidos`, `Telefono`, `correo`, `password`, `descripcion`) VALUES
('1233446534564', 'Alicia Marta', 'Morales Mazariegos', '53097116', 'alicia_1233446534564@creatica.com', '1234 ', 'profesora de educacion superior'),
('3165111655595', 'Mariela Milagros', 'Zamalloa Vega', '45679809', 'yamawaki_cecilia@creatica', '3Dj5Uj', 'Programadora web de sistemas a medida, aplicaciones móviles android e IOS y appa PWA ,  Con  mas de 18 años de experiencia  y especialidad es el Desarrollo y Diseño de Sistemas Web y Aplicaciones Móviles a Medida.'),
('5503766902197', 'Monica', 'Zapata Chang', '12342367', 'zamalloa_mariela@creatica', '7Aw2Cy', 'Doctora en Filología Clásica y en Comunicación Audiovisual, autora de numerosas publicaciones en el ámbito de la Comunicación Audiovisual.'),
('6449366051988', 'Hilrich Mariela', 'Zu Flores', '13457654', 'zapata_monica@creatica.co', '7Qr4Gf', 'Licenciada en Administración de Empresas con experiencia en enseñanza de Inglés como segundo idioma a alumnos de todas las edades, certificada por Cambridge English Language Assessment a través del Teaching Knowlegde Test (TKT).'),
('8789052781495', 'Juan Carlos', 'Zegarra Salcedo', '43658765', 'zegarra_juan@creatica.com', '9Gj7By', 'Chef Mexicano,Egresado del Le Cordon Bleu México, recibido  hace 8 años, con experiencia en distintos países de Latinoamérica y con mucha pasión por los sabores y culturas culinarias, tu cocina es tu tarjeta de presentación!.'),
('9344847824485', 'Cecilia', 'Yamawaki Onaga', '45344578', 'zu_hilrich@creatica.com', '3Ww9Jn', 'Fotógrafo, Diseñador Gráfico y me dedicado a la creación de contenido en medios digitales, ha trabajado con marcas como Facebook, Universal Studios, Apple, Fox, entre otras.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `REGISTRO_NOTA`
--

CREATE TABLE `REGISTRO_NOTA` (
  `idInscripcion` int NOT NULL,
  `fecha` date NOT NULL,
  `nota` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `REGISTRO_NOTA`
--

INSERT INTO `REGISTRO_NOTA` (`idInscripcion`, `fecha`, `nota`) VALUES
(100, '2020-10-05', 65),
(101, '2020-10-05', 0),
(102, '2020-10-05', 93),
(103, '2020-10-05', 0),
(104, '2020-10-05', 68),
(105, '2020-10-05', 0),
(106, '2020-10-05', 97),
(107, '2020-10-05', 0),
(108, '2020-10-05', 98),
(109, '2020-10-05', 95),
(110, '2020-10-05', 78),
(111, '2020-10-05', 0),
(112, '2020-10-05', 72),
(113, '2020-10-05', 0),
(114, '2020-10-05', 85),
(115, '2020-10-05', 77),
(116, '2020-10-05', 77),
(117, '2020-10-05', 0),
(118, '2020-10-05', 75),
(119, '2020-10-05', 0),
(120, '2020-10-05', 70),
(121, '2020-10-05', 0),
(122, '2020-10-05', 62),
(123, '2020-10-05', 0),
(124, '2020-10-05', 74),
(125, '2020-10-05', 68),
(126, '2020-10-05', 100),
(127, '2020-10-05', 0),
(128, '2020-10-05', 88),
(129, '2020-10-05', 0),
(130, '2020-10-05', 83),
(131, '2020-10-05', 65),
(132, '2020-10-05', 80),
(133, '2020-10-05', 0),
(134, '2020-10-05', 69),
(135, '2020-10-05', 0),
(136, '2020-10-05', 97),
(137, '2020-10-05', 0),
(138, '2020-10-05', 94),
(139, '2020-10-05', 0),
(140, '2020-10-05', 80),
(141, '2020-10-05', 64),
(142, '2020-10-05', 67),
(143, '2020-10-05', 0),
(144, '2020-10-05', 76),
(145, '2020-10-05', 0),
(146, '2020-10-05', 82),
(147, '2020-10-05', 69),
(148, '2020-10-05', 68),
(149, '2020-10-05', 0),
(150, '2020-10-05', 80),
(151, '2020-10-05', 0),
(152, '2020-10-05', 77),
(153, '2020-10-05', 0),
(154, '2020-10-05', 71),
(155, '2020-10-05', 0),
(156, '2020-10-05', 78),
(157, '2020-10-05', 80),
(158, '2020-10-05', 99),
(159, '2020-10-05', 0),
(160, '2020-10-05', 95),
(161, '2020-10-05', 0),
(162, '2020-10-05', 78),
(163, '2020-10-05', 93),
(164, '2020-10-05', 98),
(165, '2020-10-05', 0),
(166, '2020-10-05', 86),
(167, '2020-10-05', 0),
(168, '2020-10-05', 70),
(169, '2020-10-05', 0),
(170, '2020-10-05', 82),
(171, '2020-10-05', 0),
(172, '2020-10-05', 71),
(173, '2020-10-05', 71),
(174, '2020-10-05', 61),
(175, '2020-10-05', 0),
(176, '2020-10-05', 93),
(177, '2020-10-05', 0),
(178, '2020-10-05', 93),
(179, '2020-10-05', 78),
(180, '2020-10-05', 0),
(181, '2020-10-05', 94),
(182, '2020-10-05', 0),
(183, '2020-10-05', 87),
(184, '2020-10-05', 0),
(185, '2020-10-05', 60),
(186, '2020-10-05', 81),
(187, '2020-10-05', 86),
(188, '2020-10-05', 0),
(189, '2020-10-05', 96),
(190, '2020-10-05', 0),
(191, '2020-10-05', 96),
(192, '2020-10-05', 67),
(193, '2020-10-05', 0),
(194, '2020-10-05', 70),
(195, '2020-10-05', 0),
(196, '2020-10-05', 64),
(197, '2020-10-05', 0),
(198, '2020-10-05', 69),
(199, '2020-10-05', 68),
(200, '2020-10-05', 70),
(201, '2020-10-05', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ADMINISTRADOR`
--
ALTER TABLE `ADMINISTRADOR`
  ADD PRIMARY KEY (`DPI`),
  ADD KEY `index2` (`correo`);

--
-- Indices de la tabla `AREA`
--
ALTER TABLE `AREA`
  ADD PRIMARY KEY (`idArea`);

--
-- Indices de la tabla `CURSO`
--
ALTER TABLE `CURSO`
  ADD PRIMARY KEY (`idCurso`);

--
-- Indices de la tabla `DETALLE_CURSO`
--
ALTER TABLE `DETALLE_CURSO`
  ADD KEY `fk_IDPROFESOR1` (`DPIProfesor`),
  ADD KEY `FK_IDCURSO_idx` (`idCurso`);

--
-- Indices de la tabla `ESTUDIANTE`
--
ALTER TABLE `ESTUDIANTE`
  ADD PRIMARY KEY (`DPI`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `INSCRIPCION`
--
ALTER TABLE `INSCRIPCION`
  ADD PRIMARY KEY (`idInscripcion`),
  ADD KEY `DPIEstudiante` (`DPIEstudiante`),
  ADD KEY `fk_IDCURSO_INS_idx` (`idCurso`);

--
-- Indices de la tabla `PAGOS`
--
ALTER TABLE `PAGOS`
  ADD PRIMARY KEY (`idInscripcion`);

--
-- Indices de la tabla `PROFESOR`
--
ALTER TABLE `PROFESOR`
  ADD PRIMARY KEY (`DPI`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `REGISTRO_NOTA`
--
ALTER TABLE `REGISTRO_NOTA`
  ADD KEY `index2` (`fecha`),
  ADD KEY `fk_ID_INSCRIPCION_idx` (`idInscripcion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `CURSO`
--
ALTER TABLE `CURSO`
  MODIFY `idCurso` int NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `INSCRIPCION`
--
ALTER TABLE `INSCRIPCION`
  MODIFY `idInscripcion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `DETALLE_CURSO`
--
ALTER TABLE `DETALLE_CURSO`
  ADD CONSTRAINT `FK_IDCURSO` FOREIGN KEY (`idCurso`) REFERENCES `CURSO` (`idCurso`),
  ADD CONSTRAINT `fk_IDPROFESOR1` FOREIGN KEY (`DPIProfesor`) REFERENCES `PROFESOR` (`DPI`);

--
-- Filtros para la tabla `INSCRIPCION`
--
ALTER TABLE `INSCRIPCION`
  ADD CONSTRAINT `fk_IDCURSO_INS` FOREIGN KEY (`idCurso`) REFERENCES `CURSO` (`idCurso`);

--
-- Filtros para la tabla `PAGOS`
--
ALTER TABLE `PAGOS`
  ADD CONSTRAINT `fk_IDINCRIPCION` FOREIGN KEY (`idInscripcion`) REFERENCES `INSCRIPCION` (`idInscripcion`);

--
-- Filtros para la tabla `REGISTRO_NOTA`
--
ALTER TABLE `REGISTRO_NOTA`
  ADD CONSTRAINT `fk_ID_INSCRIPCION` FOREIGN KEY (`idInscripcion`) REFERENCES `INSCRIPCION` (`idInscripcion`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
