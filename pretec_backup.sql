-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-02-2023 a las 02:17:01
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pretec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aguinaldo`
--

CREATE TABLE `aguinaldo` (
  `agui_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `agui_nic` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `agui_ruc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `agui_di_trab` int(11) NOT NULL,
  `agui_sal_bas` int(11) NOT NULL,
  `agui_q_horas` int(11) NOT NULL,
  `agui_bnf_fli` int(11) NOT NULL,
  `agui_tot_ing` int(11) NOT NULL,
  `agui_ips` int(11) NOT NULL,
  `agui_anticip` int(11) NOT NULL,
  `agui_tot_egr` int(11) NOT NULL,
  `agui_sal_net` int(11) NOT NULL,
  `agui_estado` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `agui_fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `aguinaldo`
--

INSERT INTO `aguinaldo` (`agui_id`, `con_id`, `agui_nic`, `agui_ruc`, `agui_di_trab`, `agui_sal_bas`, `agui_q_horas`, `agui_bnf_fli`, `agui_tot_ing`, `agui_ips`, `agui_anticip`, `agui_tot_egr`, `agui_sal_net`, `agui_estado`, `agui_fecha`) VALUES
(1, 2, '33', '6356672-3', 8, 4500000, 19, 45000, 120000, 1215000, 0, 550000, 125000, 'ANULADO', '2021-11-03'),
(2, 2, '123', '6356672-3', 8, 4500000, 19, 45000, 120000, 1215000, 10000, 550000, 115000, 'ANULADO', '2021-11-03'),
(3, 2, '1231', '6356672-3', 8, 4500000, 19, 45000, 120000, 1215000, 20000, 550000, 105000, 'ACTIVO', '2021-11-03'),
(4, 2, '0', '6356672-3', 4, 4500000, 1, 235600, 45000, 0, 0, 450000, 62500, 'ACTIVO', '2023-02-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `asi_id` int(11) NOT NULL,
  `asi_hor_entr` time DEFAULT NULL,
  `asi_hor_sali` time DEFAULT NULL,
  `asi_fech` date NOT NULL,
  `asi_descri` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `con_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`asi_id`, `asi_hor_entr`, `asi_hor_sali`, `asi_fech`, `asi_descri`, `con_id`) VALUES
(1, '17:50:00', '20:57:00', '2021-10-21', 'MARCACION NORMAL', 1),
(2, '18:00:00', '19:00:00', '2021-10-21', 'MARCACION NORMAL', 1),
(3, '19:00:00', '19:01:00', '2021-10-21', 'MARCACION NORMAL', 1),
(4, '21:34:00', '17:50:00', '2021-10-21', 'MARCACION NORMAL', 1),
(5, '16:20:00', '16:20:00', '2021-10-24', 'MARCACION NORMAL', 1),
(6, '21:23:00', '21:24:00', '2021-10-25', 'MARCACION NORMAL', 1),
(7, '15:45:00', '21:46:00', '2021-11-03', 'MARCACION NORMAL', 2),
(8, '15:46:00', '16:46:00', '2021-11-03', 'MARCACION NORMAL', 2),
(9, '15:46:00', '15:47:00', '2021-11-03', 'MARCACION NORMAL', 2),
(10, '15:47:00', '15:47:00', '2021-11-03', 'MARCACION NORMAL', 2),
(11, '15:47:00', '15:47:00', '2021-11-03', 'MARCACION NORMAL', 2),
(12, '15:47:00', '15:47:00', '2021-11-03', 'MARCACION NORMAL', 2),
(13, '17:59:00', '17:59:00', '2021-11-03', 'MARCACION NORMAL', 2),
(14, '17:59:00', '17:59:00', '2021-11-03', 'MARCACION NORMAL', 2),
(19, '16:11:00', '16:11:00', '2023-01-08', 'MARCACION NORMAL', 2),
(20, '16:11:00', '16:11:00', '2023-01-08', 'MARCACION NORMAL', 2),
(21, '01:11:00', '01:11:00', '2023-01-27', 'MARCACION NORMAL', 2),
(22, '20:52:00', '21:52:00', '2023-02-01', 'MARCACION NORMAL', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bonif_filia`
--

CREATE TABLE `bonif_filia` (
  `bon_id` int(11) NOT NULL,
  `bon_monto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bon_estad` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bon_cant` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bon_fec_pg` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `con_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `bonif_filia`
--

INSERT INTO `bonif_filia` (`bon_id`, `bon_monto`, `bon_estad`, `bon_cant`, `bon_fec_pg`, `con_id`) VALUES
(1, '0', 'ACTIVO', '0', '2023-01-15', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `car_id` int(11) NOT NULL,
  `car_descri` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `salario` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`car_id`, `car_descri`, `salario`, `estado`) VALUES
(2, 'GERENTE', 4500000, 1),
(3, 'CONTADORA', 3400000, 1),
(4, 'EL MEJOR', 4500000, 1),
(5, 'nuevo', 34000, 1),
(6, 'cargo 2', 6700000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concepto`
--

CREATE TABLE `concepto` (
  `id_concepto` int(11) NOT NULL,
  `descripcion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `monto` int(11) NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `concepto`
--

INSERT INTO `concepto` (`id_concepto`, `descripcion`, `monto`, `estado`) VALUES
(3, 'Asuntos de la empresa', 20000, 1),
(4, 'Motivos personales', 45000, 1),
(5, 'Hora Extra 2', 45000, 1),
(6, 'Hora Extra 5', 74000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato`
--

CREATE TABLE `contrato` (
  `con_id` int(11) NOT NULL,
  `con_emis` date NOT NULL,
  `contrat_clau` longtext COLLATE utf8_unicode_ci NOT NULL,
  `con_fin` date NOT NULL,
  `con_salario` int(11) NOT NULL,
  `con_estado` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `dep_id` int(11) NOT NULL,
  `func_id` int(11) NOT NULL,
  `motivo_salida` varchar(10) COLLATE utf8_unicode_ci DEFAULT '''-''',
  `profesion` set('EMPLEADO','OBRERO','','') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `contrato`
--

INSERT INTO `contrato` (`con_id`, `con_emis`, `contrat_clau`, `con_fin`, `con_salario`, `con_estado`, `car_id`, `dep_id`, `func_id`, `motivo_salida`, `profesion`) VALUES
(1, '2021-10-19', '<h2>CONTRATO DE TRABAJO</h2>\r\n\r\n<p>En la ciudad de Capiatá, República del Paraguay, a los <span id=\"dia\">19</span> días del mes de <span id=\"mes\">OCTUBRE</span> del año <span id=\"anio\">2021</span> entre:\r\n \r\nPor una parte, la empresa PRETEC S.A., con dirección en km 16 Ruta 2 de la ciudad de Capiatá ;\r\nPor la otra, <span id=\"nombre\">LUCERO OJEDA</span>, de <span id=\"edad\">0</span> años de edad, de sexo <span id=\"sexo\">FEMENINO</span>, de estado <span id=\"estado\">CASADO</span>, de nacionalidad <span id=\"nacionalidad\">PARAGUAYA</span>, \r\ncon C.I. N° <span id=\"cedula_con\">4444</span> con domicilio, sobre la <span id=\"direccion\">CAPIATA EN ALGUN LUGAR</span> de la ciudad de <span id=\"ciudad\">CAPIATA</span>, en adelante \"EL EMPLEADO\" o “EL TRABAJADOR;</p>\r\n<p> \r\n\r\nDenominadas conjuntamente las partes, convienen en celebrar el presente contrato individual de trabajo, que se regirá por las cláusulas y condiciones siguientes. -\r\n</p>\r\n\r\n<h4>1.  MODALIDADES</h4>\r\n<p>1.1.  Cargo: <span id=\"cargo\">CONTADORA</span>.  </p>\r\n<p>\r\n1.1.1. El TRABAJADOR se obliga a prestar el servicio contratado en la forma y tiempo estipulados en este contrato, siendo estas cláusulas enunciativas y no limitativas, y a desempeñar las labores que tienen relación directa e indirecta con su cargo.\r\n</p>\r\n<p>\r\n1.1.2. Queda convenido entre las partes que la EMPRESA, por razones de mejor servicio, podrá asignar al TRABAJADOR otras tareas complementarias y/o diferentes a las mencionadas en el presente contrato, dentro de un régimen de polivalencia de funciones, en un anexo donde se establecerán dichas funciones adicionales.\r\n</p>\r\n<p>\r\n1.2.  Lugar de la prestación:  En todos los locales de la empresa, ya sea en la Casa Central o en cualquiera de las Agencias o Sucursales que el empleador tiene o tuviere en el futuro en el Paraguay, quedando a criterio del empleador designar el local donde cumplirá sus labores.\r\n</p>\r\n\r\n<h4>2.  FORMA DEL CONTRATO</h4>\r\n<p>2.1. Por unidad de tiempo. </p>	\r\n\r\n<h4>3.  REMUNERACIÓN CONVENIDA</h4>\r\n<p>3.1. Monto del sueldo mensual: <span id=\"sueldo_con\">340.000</span> GS. </p>\r\n<h4>4.  PLAZO DEL CONTRATO</h4>\r\n<p>4.1. Indeterminado, desde la fecha de su firma\r\n</p>\r\n<p>4.2. Fecha de inicio del trabajo: <span id=\"inicio_fecha\">2021-10-19</span>\r\n</p>\r\n<p>4.3. Periodo de prueba: 60 días</p>\r\n<h4>5.  DURACIÓN Y DIVISIÓN DE LA JORNADA</h4>\r\n<p>5.1.  El horario de trabajo será de 8 (ocho) horas diarias o de 48 (cuarenta y ocho) horas semanales, pudiendo ampliarse la jornada diaria, sin que se considere extraordinaria a los efectos de suplir el trabajo los días sábados, sin que se considere horas extraordinarias a los efectos de su remuneración.\r\n</p>\r\n<p>5.2. Horario básico de trabajo:</p>\r\n<ul>\r\n    <li>De lunes a viernes: de 7:00  a 15:00 horas con un periodo de descanso. </li>\r\n    <li>Sábados 7:00  a 12:00 horas.</li>\r\n</ul>\r\n<p>5.3. El horario podrá ser modificado en función a la época del año y a la necesidad del servicio, así como del local al cual fue destinado. Cualquier cambio de horario, si no hubiere una emergencia, será comunicado con 48 horas de anticipación por lo menos. El horario será anunciado por medio de avisos bien visibles.  Los horarios además se adecuarán a las necesidades de la empresa, por razones de mejor servicio.\r\n</p>\r\n<p>5.4. El descanso semanal será preferentemente los días domingos.  Si se trabaja en domingos o feriados se establece un día o medio día compensatorio de descanso.\r\n</p>\r\n<h4>6.  PERIODO DE PAGO</h4>\r\n<p>6.1. Mensual: cada 30 días.\r\n</p>\r\n<p>6.2. Época: del 1 al 5 de cada mes\r\n</p>\r\n<p>6.3. Lugar de pago: En las oficinas de la empresa o donde ésta designe.\r\n</p>\r\n\r\n<h4>7.- DISPOSICIONES GENERALES</h4>\r\n<p>7.1.  El TRABAJADOR desde el momento que acepta el cargo se obliga a observar las políticas, procedimientos y demás instrucciones de la empresa.\r\n</p>\r\n<p> 7.2.  El TRABAJADOR se compromete a comunicar a la empresa, por nota con acuse de recibo o por telegrama colacionado, el cambio de su domicilio.  Mientras éste no se registre, por el aviso efectuado en la forma antedicha, serán válidas todas las comunicaciones dirigidas al último domicilio denunciado, con todos los efectos legales.\r\n</p>\r\n<p> 7.3.  El TRABAJADOR deberá poner el mayor cuidado y atención en la utilización de los bienes de la empresa.  La violación de esta norma es particularmente grave y podrá ser causal de terminación del contrato con justa causa (art. 83 inc. h del C.T.)\r\n</p>\r\n<p> 7.4.  El TRABAJADOR deberá guardar la mayor reserva sobre costos, precios, nómina de clientes, productos, proveedores, y en general todo lo relacionado con los productos y servicios que la empresa comercializa.  La violación de esta norma es particularmente grave y podrá ser causal de terminación del contrato con justa causa (art. 83 inc. h) del C.T.)\r\n</p>\r\n<p> 7.5.  El TRABAJADOR podrá ser trasladado de Departamentos, Secciones, puestos o funciones, sin reducción de la remuneración y siempre que no constituya menoscabo a su dignidad. Para el efecto la EMPRESA notificará al TRABAJADOR con cuarenta y ocho horas de antelación.\r\n</p>\r\n<p>7.6.  Si el TRABAJADOR realiza viajes al interior y al exterior para la realización de sus tareas, el mismo debe respetar las instrucciones que en ese sentido imparta la empresa, siendo los gastos de traslado y viático por cuenta de ésta.  El incumplimiento de esta disposición será causal de despido con causa justificada.\r\n </p>\r\n <p> 7.7.  A todos los efectos de este contrato se considerará información confidencial toda información relativa a las actividades técnicas, comerciales, de procedimiento u otras de cualquier tipo que sea proporcionada al trabajador en razón de su trabajo o que por cualquier medio legue a sus sentidos, aunque sea fortuitamente, a excepción de aquella que fuera del dominio público. \r\n</p>\r\n<p>7.8. Queda terminantemente prohibido vender, enajenar o regalar equipos, elementos de seguridad o ropa de trabajo que sean proporcionados por la empresa para ser usados en el desempeño de sus funciones.\r\n</p>\r\n<p>7.9. El TRABAJADOR se compromete a ser absolutamente responsable en el cumplimiento de los horarios de trabajo, incluyendo aquellos fijados para reuniones de trabajo, de información o instrucción.  El incumplimiento de horarios y la impuntualidad son sumamente graves.  Registradas las impuntualidades, facultan a la empresa a la aplicación de las sanciones correspondientes de acuerdo a lo establecido por el Código del Trabajo.\r\n</p>\r\n<p> 7.10. El TRABAJADOR deberá cumplir puntualmente con las obligaciones dinerarias contraídas y la promoción de demandas contra el mismo, será considerada particularmente grave.\r\n</p>\r\n<p>En prueba de conformidad y aceptación suscriben las partes en tres ejemplares de un mismo tenor y efecto, quedando uno en poder de cada parte y el tercero para la Autoridad Administrativa del Trabajo, si lo exigiere.\r\n</p>\r\n\r\n<h4>8. CLAUSULA OCTAVA: DOMICILIOS</h4>\r\n<p>8.1 Las partes fijan domicilio en las direcciones enunciadas en el encabezado del presente Contrato, para cualquier comunicación judicial o extrajudicial que surgiere durante la vigente de este Contrato. \r\n</p>\r\n<p>8.2 El TRABAJADOR se compromete a comunicar el cambio de su domicilio dentro de las cuarenta y ocho horas siguientes, por nota con acuse de recibo o telegrama colacionado. Mientras esta comunicación no se haya realizado.\r\n</p>\r\n \r\n<h4>9. CLAUSULA NOVENA: JURISDICCION </h4>\r\n<p>9.1 A todos los efectos derivados del presente contrato individual de trabajo, las partes se someten a las Jurisdicción de los Tribunales Ordinarios de la Ciudad de Asunción, constituyendo sus domicilios en los lugares indicados en el encabezamiento del presente Contrato. \r\n</p>\r\n<p>En prueba de conformidad y aceptación, las partes firman en dos ejemplares del mismo tenor y a un solo efecto. \r\n</p>\r\n<br>\r\n<br>\r\n<br>\r\n<div class=\"row\">\r\n    <div class=\"col-md-6\" style=\"text-align: center;\">\r\n        <span>............................................................</span><br> \r\nEL TRABAJADOR	\r\n    </div>\r\n    <div class=\"col-md-6\" style=\"text-align: center;\">\r\n        <span>............................................................</span><br> \r\nLA EMPRESA	\r\n    </div>\r\n</div>\r\n					   \r\n', '2022-05-28', 340000, 0, 3, 1, 1, '\'-\'', 'EMPLEADO'),
(2, '2021-10-24', '<h2>CONTRATO DE TRABAJO</h2>\r\n\r\n<p>En la ciudad de Capiatá, República del Paraguay, a los <span id=\"dia\">24</span> días del mes de <span id=\"mes\">OCTUBRE</span> del año <span id=\"anio\">2021</span> entre:\r\n \r\nPor una parte, la empresa PRETEC S.A., con dirección en km 16 Ruta 2 de la ciudad de Capiatá ;\r\nPor la otra, <span id=\"nombre\">LUCAS GOMEZ</span>, de <span id=\"edad\">0</span> años de edad, de sexo <span id=\"sexo\">MASCULINO</span>, de estado <span id=\"estado\">SOLTERO</span>, de nacionalidad <span id=\"nacionalidad\">PARAGUAYA</span>, \r\ncon C.I. N° <span id=\"cedula_con\">33112</span> con domicilio, sobre la <span id=\"direccion\">CAPIATA EN ALGUN LUGAR</span> de la ciudad de <span id=\"ciudad\">CAPIATA</span>, en adelante \"EL EMPLEADO\" o “EL TRABAJADOR;</p>\r\n<p> \r\n\r\nDenominadas conjuntamente las partes, convienen en celebrar el presente contrato individual de trabajo, que se regirá por las cláusulas y condiciones siguientes. -\r\n</p>\r\n\r\n<h4>1.  MODALIDADES</h4>\r\n<p>1.1.  Cargo: <span id=\"cargo\">GERENTE</span>.  </p>\r\n<p>\r\n1.1.1. El TRABAJADOR se obliga a prestar el servicio contratado en la forma y tiempo estipulados en este contrato, siendo estas cláusulas enunciativas y no limitativas, y a desempeñar las labores que tienen relación directa e indirecta con su cargo.\r\n</p>\r\n<p>\r\n1.1.2. Queda convenido entre las partes que la EMPRESA, por razones de mejor servicio, podrá asignar al TRABAJADOR otras tareas complementarias y/o diferentes a las mencionadas en el presente contrato, dentro de un régimen de polivalencia de funciones, en un anexo donde se establecerán dichas funciones adicionales.\r\n</p>\r\n<p>\r\n1.2.  Lugar de la prestación:  En todos los locales de la empresa, ya sea en la Casa Central o en cualquiera de las Agencias o Sucursales que el empleador tiene o tuviere en el futuro en el Paraguay, quedando a criterio del empleador designar el local donde cumplirá sus labores.\r\n</p>\r\n\r\n<h4>2.  FORMA DEL CONTRATO</h4>\r\n<p>2.1. Por unidad de tiempo. </p>	\r\n\r\n<h4>3.  REMUNERACIÓN CONVENIDA</h4>\r\n<p>3.1. Monto del sueldo mensual: <span id=\"sueldo_con\">4.500.000</span> GS. </p>\r\n<h4>4.  PLAZO DEL CONTRATO</h4>\r\n<p>4.1. Indeterminado, desde la fecha de su firma\r\n</p>\r\n<p>4.2. Fecha de inicio del trabajo: <span id=\"inicio_fecha\">2021-10-24</span>\r\n</p>\r\n<p>4.3. Periodo de prueba: 60 días</p>\r\n<h4>5.  DURACIÓN Y DIVISIÓN DE LA JORNADA</h4>\r\n<p>5.1.  El horario de trabajo será de 8 (ocho) horas diarias o de 48 (cuarenta y ocho) horas semanales, pudiendo ampliarse la jornada diaria, sin que se considere extraordinaria a los efectos de suplir el trabajo los días sábados, sin que se considere horas extraordinarias a los efectos de su remuneración.\r\n</p>\r\n<p>5.2. Horario básico de trabajo:</p>\r\n<ul>\r\n    <li>De lunes a viernes: de 7:00  a 15:00 horas con un periodo de descanso. </li>\r\n    <li>Sábados 7:00  a 12:00 horas.</li>\r\n</ul>\r\n<p>5.3. El horario podrá ser modificado en función a la época del año y a la necesidad del servicio, así como del local al cual fue destinado. Cualquier cambio de horario, si no hubiere una emergencia, será comunicado con 48 horas de anticipación por lo menos. El horario será anunciado por medio de avisos bien visibles.  Los horarios además se adecuarán a las necesidades de la empresa, por razones de mejor servicio.\r\n</p>\r\n<p>5.4. El descanso semanal será preferentemente los días domingos.  Si se trabaja en domingos o feriados se establece un día o medio día compensatorio de descanso.\r\n</p>\r\n<h4>6.  PERIODO DE PAGO</h4>\r\n<p>6.1. Mensual: cada 30 días.\r\n</p>\r\n<p>6.2. Época: del 1 al 5 de cada mes\r\n</p>\r\n<p>6.3. Lugar de pago: En las oficinas de la empresa o donde ésta designe.\r\n</p>\r\n\r\n<h4>7.- DISPOSICIONES GENERALES</h4>\r\n<p>7.1.  El TRABAJADOR desde el momento que acepta el cargo se obliga a observar las políticas, procedimientos y demás instrucciones de la empresa.\r\n</p>\r\n<p> 7.2.  El TRABAJADOR se compromete a comunicar a la empresa, por nota con acuse de recibo o por telegrama colacionado, el cambio de su domicilio.  Mientras éste no se registre, por el aviso efectuado en la forma antedicha, serán válidas todas las comunicaciones dirigidas al último domicilio denunciado, con todos los efectos legales.\r\n</p>\r\n<p> 7.3.  El TRABAJADOR deberá poner el mayor cuidado y atención en la utilización de los bienes de la empresa.  La violación de esta norma es particularmente grave y podrá ser causal de terminación del contrato con justa causa (art. 83 inc. h del C.T.)\r\n</p>\r\n<p> 7.4.  El TRABAJADOR deberá guardar la mayor reserva sobre costos, precios, nómina de clientes, productos, proveedores, y en general todo lo relacionado con los productos y servicios que la empresa comercializa.  La violación de esta norma es particularmente grave y podrá ser causal de terminación del contrato con justa causa (art. 83 inc. h) del C.T.)\r\n</p>\r\n<p> 7.5.  El TRABAJADOR podrá ser trasladado de Departamentos, Secciones, puestos o funciones, sin reducción de la remuneración y siempre que no constituya menoscabo a su dignidad. Para el efecto la EMPRESA notificará al TRABAJADOR con cuarenta y ocho horas de antelación.\r\n</p>\r\n<p>7.6.  Si el TRABAJADOR realiza viajes al interior y al exterior para la realización de sus tareas, el mismo debe respetar las instrucciones que en ese sentido imparta la empresa, siendo los gastos de traslado y viático por cuenta de ésta.  El incumplimiento de esta disposición será causal de despido con causa justificada.\r\n </p>\r\n <p> 7.7.  A todos los efectos de este contrato se considerará información confidencial toda información relativa a las actividades técnicas, comerciales, de procedimiento u otras de cualquier tipo que sea proporcionada al trabajador en razón de su trabajo o que por cualquier medio legue a sus sentidos, aunque sea fortuitamente, a excepción de aquella que fuera del dominio público. \r\n</p>\r\n<p>7.8. Queda terminantemente prohibido vender, enajenar o regalar equipos, elementos de seguridad o ropa de trabajo que sean proporcionados por la empresa para ser usados en el desempeño de sus funciones.\r\n</p>\r\n<p>7.9. El TRABAJADOR se compromete a ser absolutamente responsable en el cumplimiento de los horarios de trabajo, incluyendo aquellos fijados para reuniones de trabajo, de información o instrucción.  El incumplimiento de horarios y la impuntualidad son sumamente graves.  Registradas las impuntualidades, facultan a la empresa a la aplicación de las sanciones correspondientes de acuerdo a lo establecido por el Código del Trabajo.\r\n</p>\r\n<p> 7.10. El TRABAJADOR deberá cumplir puntualmente con las obligaciones dinerarias contraídas y la promoción de demandas contra el mismo, será considerada particularmente grave.\r\n</p>\r\n<p>En prueba de conformidad y aceptación suscriben las partes en tres ejemplares de un mismo tenor y efecto, quedando uno en poder de cada parte y el tercero para la Autoridad Administrativa del Trabajo, si lo exigiere.\r\n</p>\r\n\r\n<h4>8. CLAUSULA OCTAVA: DOMICILIOS</h4>\r\n<p>8.1 Las partes fijan domicilio en las direcciones enunciadas en el encabezado del presente Contrato, para cualquier comunicación judicial o extrajudicial que surgiere durante la vigente de este Contrato. \r\n</p>\r\n<p>8.2 El TRABAJADOR se compromete a comunicar el cambio de su domicilio dentro de las cuarenta y ocho horas siguientes, por nota con acuse de recibo o telegrama colacionado. Mientras esta comunicación no se haya realizado.\r\n</p>\r\n \r\n<h4>9. CLAUSULA NOVENA: JURISDICCION </h4>\r\n<p>9.1 A todos los efectos derivados del presente contrato individual de trabajo, las partes se someten a las Jurisdicción de los Tribunales Ordinarios de la Ciudad de Asunción, constituyendo sus domicilios en los lugares indicados en el encabezamiento del presente Contrato. \r\n</p>\r\n<p>En prueba de conformidad y aceptación, las partes firman en dos ejemplares del mismo tenor y a un solo efecto. \r\n</p>\r\n<br>\r\n<br>\r\n<br>\r\n<div class=\"row\">\r\n    <div class=\"col-md-6\" style=\"text-align: center;\">\r\n        <span>............................................................</span><br> \r\nEL TRABAJADOR	\r\n    </div>\r\n    <div class=\"col-md-6\" style=\"text-align: center;\">\r\n        <span>............................................................</span><br> \r\nLA EMPRESA	\r\n    </div>\r\n</div>\r\n					   \r\n', '2021-10-24', 4500000, 1, 2, 1, 2, '\'-\'', 'OBRERO'),
(3, '2021-11-01', '<h2>CONTRATO DE TRABAJO</h2>\r\n\r\n<p>En la ciudad de Capiatá, República del Paraguay, a los <span id=\"dia\">01</span> días del mes de <span id=\"mes\">NOVIEMBRE</span> del año <span id=\"anio\">2021</span> entre:\r\n \r\nPor una parte, la empresa PRETEC S.A., con dirección en km 16 Ruta 2 de la ciudad de Capiatá ;\r\nPor la otra, <span id=\"nombre\">LUCERO OJEDA</span>, de <span id=\"edad\">0</span> años de edad, de sexo <span id=\"sexo\">FEMENINO</span>, de estado <span id=\"estado\">CASADO</span>, de nacionalidad <span id=\"nacionalidad\">PARAGUAYA</span>, \r\ncon C.I. N° <span id=\"cedula_con\">4444</span> con domicilio, sobre la <span id=\"direccion\">CAPIATA EN ALGUN LUGAR</span> de la ciudad de <span id=\"ciudad\">CAPIATA</span>, en adelante \"EL EMPLEADO\" o “EL TRABAJADOR;</p>\r\n<p> \r\n\r\nDenominadas conjuntamente las partes, convienen en celebrar el presente contrato individual de trabajo, que se regirá por las cláusulas y condiciones siguientes. -\r\n</p>\r\n\r\n<h4>1.  MODALIDADES</h4>\r\n<p>1.1.  Cargo: <span id=\"cargo\">CONTADORA</span>.  </p>\r\n<p>\r\n1.1.1. El TRABAJADOR se obliga a prestar el servicio contratado en la forma y tiempo estipulados en este contrato, siendo estas cláusulas enunciativas y no limitativas, y a desempeñar las labores que tienen relación directa e indirecta con su cargo.\r\n</p>\r\n<p>\r\n1.1.2. Queda convenido entre las partes que la EMPRESA, por razones de mejor servicio, podrá asignar al TRABAJADOR otras tareas complementarias y/o diferentes a las mencionadas en el presente contrato, dentro de un régimen de polivalencia de funciones, en un anexo donde se establecerán dichas funciones adicionales.\r\n</p>\r\n<p>\r\n1.2.  Lugar de la prestación:  En todos los locales de la empresa, ya sea en la Casa Central o en cualquiera de las Agencias o Sucursales que el empleador tiene o tuviere en el futuro en el Paraguay, quedando a criterio del empleador designar el local donde cumplirá sus labores.\r\n</p>\r\n\r\n<h4>2.  FORMA DEL CONTRATO</h4>\r\n<p>2.1. Por unidad de tiempo. </p>	\r\n\r\n<h4>3.  REMUNERACIÓN CONVENIDA</h4>\r\n<p>3.1. Monto del sueldo mensual: <span id=\"sueldo_con\"></span> GS. </p>\r\n<h4>4.  PLAZO DEL CONTRATO</h4>\r\n<p>4.1. Indeterminado, desde la fecha de su firma\r\n</p>\r\n<p>4.2. Fecha de inicio del trabajo: <span id=\"inicio_fecha\">2021-11-01</span>\r\n</p>\r\n<p>4.3. Periodo de prueba: 60 días</p>\r\n<h4>5.  DURACIÓN Y DIVISIÓN DE LA JORNADA</h4>\r\n<p>5.1.  El horario de trabajo será de 8 (ocho) horas diarias o de 48 (cuarenta y ocho) horas semanales, pudiendo ampliarse la jornada diaria, sin que se considere extraordinaria a los efectos de suplir el trabajo los días sábados, sin que se considere horas extraordinarias a los efectos de su remuneración.\r\n</p>\r\n<p>5.2. Horario básico de trabajo:</p>\r\n<ul>\r\n    <li>De lunes a viernes: de 7:00  a 15:00 horas con un periodo de descanso. </li>\r\n    <li>Sábados 7:00  a 12:00 horas.</li>\r\n</ul>\r\n<p>5.3. El horario podrá ser modificado en función a la época del año y a la necesidad del servicio, así como del local al cual fue destinado. Cualquier cambio de horario, si no hubiere una emergencia, será comunicado con 48 horas de anticipación por lo menos. El horario será anunciado por medio de avisos bien visibles.  Los horarios además se adecuarán a las necesidades de la empresa, por razones de mejor servicio.\r\n</p>\r\n<p>5.4. El descanso semanal será preferentemente los días domingos.  Si se trabaja en domingos o feriados se establece un día o medio día compensatorio de descanso.\r\n</p>\r\n<h4>6.  PERIODO DE PAGO</h4>\r\n<p>6.1. Mensual: cada 30 días.\r\n</p>\r\n<p>6.2. Época: del 1 al 5 de cada mes\r\n</p>\r\n<p>6.3. Lugar de pago: En las oficinas de la empresa o donde ésta designe.\r\n</p>\r\n\r\n<h4>7.- DISPOSICIONES GENERALES</h4>\r\n<p>7.1.  El TRABAJADOR desde el momento que acepta el cargo se obliga a observar las políticas, procedimientos y demás instrucciones de la empresa.\r\n</p>\r\n<p> 7.2.  El TRABAJADOR se compromete a comunicar a la empresa, por nota con acuse de recibo o por telegrama colacionado, el cambio de su domicilio.  Mientras éste no se registre, por el aviso efectuado en la forma antedicha, serán válidas todas las comunicaciones dirigidas al último domicilio denunciado, con todos los efectos legales.\r\n</p>\r\n<p> 7.3.  El TRABAJADOR deberá poner el mayor cuidado y atención en la utilización de los bienes de la empresa.  La violación de esta norma es particularmente grave y podrá ser causal de terminación del contrato con justa causa (art. 83 inc. h del C.T.)\r\n</p>\r\n<p> 7.4.  El TRABAJADOR deberá guardar la mayor reserva sobre costos, precios, nómina de clientes, productos, proveedores, y en general todo lo relacionado con los productos y servicios que la empresa comercializa.  La violación de esta norma es particularmente grave y podrá ser causal de terminación del contrato con justa causa (art. 83 inc. h) del C.T.)\r\n</p>\r\n<p> 7.5.  El TRABAJADOR podrá ser trasladado de Departamentos, Secciones, puestos o funciones, sin reducción de la remuneración y siempre que no constituya menoscabo a su dignidad. Para el efecto la EMPRESA notificará al TRABAJADOR con cuarenta y ocho horas de antelación.\r\n</p>\r\n<p>7.6.  Si el TRABAJADOR realiza viajes al interior y al exterior para la realización de sus tareas, el mismo debe respetar las instrucciones que en ese sentido imparta la empresa, siendo los gastos de traslado y viático por cuenta de ésta.  El incumplimiento de esta disposición será causal de despido con causa justificada.\r\n </p>\r\n <p> 7.7.  A todos los efectos de este contrato se considerará información confidencial toda información relativa a las actividades técnicas, comerciales, de procedimiento u otras de cualquier tipo que sea proporcionada al trabajador en razón de su trabajo o que por cualquier medio legue a sus sentidos, aunque sea fortuitamente, a excepción de aquella que fuera del dominio público. \r\n</p>\r\n<p>7.8. Queda terminantemente prohibido vender, enajenar o regalar equipos, elementos de seguridad o ropa de trabajo que sean proporcionados por la empresa para ser usados en el desempeño de sus funciones.\r\n</p>\r\n<p>7.9. El TRABAJADOR se compromete a ser absolutamente responsable en el cumplimiento de los horarios de trabajo, incluyendo aquellos fijados para reuniones de trabajo, de información o instrucción.  El incumplimiento de horarios y la impuntualidad son sumamente graves.  Registradas las impuntualidades, facultan a la empresa a la aplicación de las sanciones correspondientes de acuerdo a lo establecido por el Código del Trabajo.\r\n</p>\r\n<p> 7.10. El TRABAJADOR deberá cumplir puntualmente con las obligaciones dinerarias contraídas y la promoción de demandas contra el mismo, será considerada particularmente grave.\r\n</p>\r\n<p>En prueba de conformidad y aceptación suscriben las partes en tres ejemplares de un mismo tenor y efecto, quedando uno en poder de cada parte y el tercero para la Autoridad Administrativa del Trabajo, si lo exigiere.\r\n</p>\r\n\r\n<h4>8. CLAUSULA OCTAVA: DOMICILIOS</h4>\r\n<p>8.1 Las partes fijan domicilio en las direcciones enunciadas en el encabezado del presente Contrato, para cualquier comunicación judicial o extrajudicial que surgiere durante la vigente de este Contrato. \r\n</p>\r\n<p>8.2 El TRABAJADOR se compromete a comunicar el cambio de su domicilio dentro de las cuarenta y ocho horas siguientes, por nota con acuse de recibo o telegrama colacionado. Mientras esta comunicación no se haya realizado.\r\n</p>\r\n \r\n<h4>9. CLAUSULA NOVENA: JURISDICCION </h4>\r\n<p>9.1 A todos los efectos derivados del presente contrato individual de trabajo, las partes se someten a las Jurisdicción de los Tribunales Ordinarios de la Ciudad de Asunción, constituyendo sus domicilios en los lugares indicados en el encabezamiento del presente Contrato. \r\n</p>\r\n<p>En prueba de conformidad y aceptación, las partes firman en dos ejemplares del mismo tenor y a un solo efecto. \r\n</p>\r\n<br>\r\n<br>\r\n<br>\r\n<div class=\"row\">\r\n    <div class=\"col-md-6\" style=\"text-align: center;\">\r\n        <span>............................................................</span><br> \r\nEL TRABAJADOR	\r\n    </div>\r\n    <div class=\"col-md-6\" style=\"text-align: center;\">\r\n        <span>............................................................</span><br> \r\nLA EMPRESA	\r\n    </div>\r\n</div>\r\n					   \r\n', '2021-11-01', 3400000, 0, 3, 2, 1, '\'-\'', 'EMPLEADO'),
(4, '2023-01-25', '\n<h2>CONTRATO DE TRABAJO</h2>\n\n<p>En la ciudad de Capiatá, República del Paraguay, a los <span id=\"dia\">25</span> días del mes de <span id=\"mes\">abril</span> del año <span id=\"anio\">2023</span> entre:\n \nPor una parte, la empresa PRETEC S.A., con dirección en km 16 Ruta 2 de la ciudad de Capiatá ;\nPor la otra, <span id=\"nombre\">BLAS MANCUELLO</span>, de <span id=\"edad\">29</span> años de edad, de sexo <span id=\"sexo\">MASCULINO</span>, de estado <span id=\"estado\">SOLTERO</span>, de nacionalidad <span id=\"nacionalidad\">PARAGUAYA</span>, \ncon C.I. N° <span id=\"cedula_con\">331121</span> con domicilio, sobre la <span id=\"direccion\">ITAUGUA</span> de la ciudad de <span id=\"ciudad\">CAPIATA</span>, en adelante \"EL EMPLEADO\" o “EL TRABAJADOR;</p>\n<p> \n\nDenominadas conjuntamente las partes, convienen en celebrar el presente contrato individual de trabajo, que se regirá por las cláusulas y condiciones siguientes. -\n</p>\n\n<h4>1.  MODALIDADES</h4>\n<p>1.1.  Cargo: <span id=\"cargo\">CONTADORA</span>.  </p>\n<p>\n1.1.1. El TRABAJADOR se obliga a prestar el servicio contratado en la forma y tiempo estipulados en este contrato, siendo estas cláusulas enunciativas y no limitativas, y a desempeñar las labores que tienen relación directa e indirecta con su cargo.\n</p>\n<p>\n1.1.2. Queda convenido entre las partes que la EMPRESA, por razones de mejor servicio, podrá asignar al TRABAJADOR otras tareas complementarias y/o diferentes a las mencionadas en el presente contrato, dentro de un régimen de polivalencia de funciones, en un anexo donde se establecerán dichas funciones adicionales.\n</p>\n<p>\n1.2.  Lugar de la prestación:  En todos los locales de la empresa, ya sea en la Casa Central o en cualquiera de las Agencias o Sucursales que el empleador tiene o tuviere en el futuro en el Paraguay, quedando a criterio del empleador designar el local donde cumplirá sus labores.\n</p>\n\n<h4>2.  FORMA DEL CONTRATO</h4>\n<p>2.1. Por unidad de tiempo. </p>	\n\n<h4>3.  REMUNERACIÓN CONVENIDA</h4>\n<p>3.1. Monto del sueldo mensual: <span id=\"sueldo_con\">4.500.000</span> GS. </p>\n<h4>4.  PLAZO DEL CONTRATO</h4>\n<p>4.1. Indeterminado, desde la fecha de su firma\n</p>\n<p>4.2. Fecha de inicio del trabajo: <span id=\"inicio_fecha\">2023-01-25</span>\n</p>\n<p>4.3. Periodo de prueba: 60 días</p>\n<h4>5.  DURACIÓN Y DIVISIÓN DE LA JORNADA</h4>\n<p>5.1.  El horario de trabajo será de 8 (ocho) horas diarias o de 48 (cuarenta y ocho) horas semanales, pudiendo ampliarse la jornada diaria, sin que se considere extraordinaria a los efectos de suplir el trabajo los días sábados, sin que se considere horas extraordinarias a los efectos de su remuneración.\n</p>\n<p>5.2. Horario básico de trabajo:</p>\n<ul>\n    <li>De lunes a viernes: de 7:00  a 15:00 horas con un periodo de descanso. </li>\n    <li>Sábados 7:00  a 12:00 horas.</li>\n</ul>\n<p>5.3. El horario podrá ser modificado en función a la época del año y a la necesidad del servicio, así como del local al cual fue destinado. Cualquier cambio de horario, si no hubiere una emergencia, será comunicado con 48 horas de anticipación por lo menos. El horario será anunciado por medio de avisos bien visibles.  Los horarios además se adecuarán a las necesidades de la empresa, por razones de mejor servicio.\n</p>\n<p>5.4. El descanso semanal será preferentemente los días domingos.  Si se trabaja en domingos o feriados se establece un día o medio día compensatorio de descanso.\n</p>\n<h4>6.  PERIODO DE PAGO</h4>\n<p>6.1. Mensual: cada 30 días.\n</p>\n<p>6.2. Época: del 1 al 5 de cada mes\n</p>\n<p>6.3. Lugar de pago: En las oficinas de la empresa o donde ésta designe.\n</p>\n\n<h4>7.- DISPOSICIONES GENERALES</h4>\n<p>7.1.  El TRABAJADOR desde el momento que acepta el cargo se obliga a observar las políticas, procedimientos y demás instrucciones de la empresa.\n</p>\n<p> 7.2.  El TRABAJADOR se compromete a comunicar a la empresa, por nota con acuse de recibo o por telegrama colacionado, el cambio de su domicilio.  Mientras éste no se registre, por el aviso efectuado en la forma antedicha, serán válidas todas las comunicaciones dirigidas al último domicilio denunciado, con todos los efectos legales.\n</p>\n<p> 7.3.  El TRABAJADOR deberá poner el mayor cuidado y atención en la utilización de los bienes de la empresa.  La violación de esta norma es particularmente grave y podrá ser causal de terminación del contrato con justa causa (art. 83 inc. h del C.T.)\n</p>\n<p> 7.4.  El TRABAJADOR deberá guardar la mayor reserva sobre costos, precios, nómina de clientes, productos, proveedores, y en general todo lo relacionado con los productos y servicios que la empresa comercializa.  La violación de esta norma es particularmente grave y podrá ser causal de terminación del contrato con justa causa (art. 83 inc. h) del C.T.)\n</p>\n<p> 7.5.  El TRABAJADOR podrá ser trasladado de Departamentos, Secciones, puestos o funciones, sin reducción de la remuneración y siempre que no constituya menoscabo a su dignidad. Para el efecto la EMPRESA notificará al TRABAJADOR con cuarenta y ocho horas de antelación.\n</p>\n<p>7.6.  Si el TRABAJADOR realiza viajes al interior y al exterior para la realización de sus tareas, el mismo debe respetar las instrucciones que en ese sentido imparta la empresa, siendo los gastos de traslado y viático por cuenta de ésta.  El incumplimiento de esta disposición será causal de despido con causa justificada.\n </p>\n <p> 7.7.  A todos los efectos de este contrato se considerará información confidencial toda información relativa a las actividades técnicas, comerciales, de procedimiento u otras de cualquier tipo que sea proporcionada al trabajador en razón de su trabajo o que por cualquier medio legue a sus sentidos, aunque sea fortuitamente, a excepción de aquella que fuera del dominio público. \n</p>\n<p>7.8. Queda terminantemente prohibido vender, enajenar o regalar equipos, elementos de seguridad o ropa de trabajo que sean proporcionados por la empresa para ser usados en el desempeño de sus funciones.\n</p>\n<p>7.9. El TRABAJADOR se compromete a ser absolutamente responsable en el cumplimiento de los horarios de trabajo, incluyendo aquellos fijados para reuniones de trabajo, de información o instrucción.  El incumplimiento de horarios y la impuntualidad son sumamente graves.  Registradas las impuntualidades, facultan a la empresa a la aplicación de las sanciones correspondientes de acuerdo a lo establecido por el Código del Trabajo.\n</p>\n<p> 7.10. El TRABAJADOR deberá cumplir puntualmente con las obligaciones dinerarias contraídas y la promoción de demandas contra el mismo, será considerada particularmente grave.\n</p>\n<p>En prueba de conformidad y aceptación suscriben las partes en tres ejemplares de un mismo tenor y efecto, quedando uno en poder de cada parte y el tercero para la Autoridad Administrativa del Trabajo, si lo exigiere.\n</p>\n\n<h4>8. CLAUSULA OCTAVA: DOMICILIOS</h4>\n<p>8.1 Las partes fijan domicilio en las direcciones enunciadas en el encabezado del presente Contrato, para cualquier comunicación judicial o extrajudicial que surgiere durante la vigente de este Contrato. \n</p>\n<p>8.2 El TRABAJADOR se compromete a comunicar el cambio de su domicilio dentro de las cuarenta y ocho horas siguientes, por nota con acuse de recibo o telegrama colacionado. Mientras esta comunicación no se haya realizado.\n</p>\n \n<h4>9. CLAUSULA NOVENA: JURISDICCION </h4>\n<p>9.1 A todos los efectos derivados del presente contrato individual de trabajo, las partes se someten a las Jurisdicción de los Tribunales Ordinarios de la Ciudad de Asunción, constituyendo sus domicilios en los lugares indicados en el encabezamiento del presente Contrato. \n</p>\n<p>En prueba de conformidad y aceptación, las partes firman en dos ejemplares del mismo tenor y a un solo efecto. \n</p>\n<br>\n<br>\n<br>\n<div class=\"row\">\n    <div class=\"col-md-6\" style=\"text-align: center;\">\n        <span>............................................................</span><br> \nEL TRABAJADOR	\n    </div>\n    <div class=\"col-md-6\" style=\"text-align: center;\">\n        <span>............................................................</span><br> \nLA EMPRESA	\n    </div>\n</div>\n					   \n', '2023-01-25', 3400000, 0, 3, 1, 3, '\'-\'', 'EMPLEADO'),
(5, '2023-01-25', '<h2>CONTRATO DE TRABAJO</h2>\r\n\r\n<p>En la ciudad de Capiatá, República del Paraguay, a los <span id=\"dia\">25</span> días del mes de <span id=\"mes\">abril</span> del año <span id=\"anio\">2023</span> entre:\r\n \r\nPor una parte, la empresa PRETEC S.A., con dirección en km 16 Ruta 2 de la ciudad de Capiatá ;\r\nPor la otra, <span id=\"nombre\">LUCERO MEZA</span>, de <span id=\"edad\">2</span> años de edad, de sexo <span id=\"sexo\">FEMENINO</span>, de estado <span id=\"estado\">CASADO</span>, de nacionalidad <span id=\"nacionalidad\">PARAGUAYA</span>, \r\ncon C.I. N° <span id=\"cedula_con\">4444</span> con domicilio, sobre la <span id=\"direccion\">CAPIATA EN ALGUN LUGAR</span> de la ciudad de <span id=\"ciudad\">CAPIATA</span>, en adelante \"EL EMPLEADO\" o “EL TRABAJADOR;</p>\r\n<p> \r\n\r\nDenominadas conjuntamente las partes, convienen en celebrar el presente contrato individual de trabajo, que se regirá por las cláusulas y condiciones siguientes. -\r\n</p>\r\n\r\n<h4>1.  MODALIDADES</h4>\r\n<p>1.1.  Cargo: <span id=\"cargo\">cargo 2</span>.  </p>\r\n<p>\r\n1.1.1. El TRABAJADOR se obliga a prestar el servicio contratado en la forma y tiempo estipulados en este contrato, siendo estas cláusulas enunciativas y no limitativas, y a desempeñar las labores que tienen relación directa e indirecta con su cargo.\r\n</p>\r\n<p>\r\n1.1.2. Queda convenido entre las partes que la EMPRESA, por razones de mejor servicio, podrá asignar al TRABAJADOR otras tareas complementarias y/o diferentes a las mencionadas en el presente contrato, dentro de un régimen de polivalencia de funciones, en un anexo donde se establecerán dichas funciones adicionales.\r\n</p>\r\n<p>\r\n1.2.  Lugar de la prestación:  En todos los locales de la empresa, ya sea en la Casa Central o en cualquiera de las Agencias o Sucursales que el empleador tiene o tuviere en el futuro en el Paraguay, quedando a criterio del empleador designar el local donde cumplirá sus labores.\r\n</p>\r\n\r\n<h4>2.  FORMA DEL CONTRATO</h4>\r\n<p>2.1. Por unidad de tiempo. </p>	\r\n\r\n<h4>3.  REMUNERACIÓN CONVENIDA</h4>\r\n<p>3.1. Monto del sueldo mensual: <span id=\"sueldo_con\"></span> GS. </p>\r\n<h4>4.  PLAZO DEL CONTRATO</h4>\r\n<p>4.1. Indeterminado, desde la fecha de su firma\r\n</p>\r\n<p>4.2. Fecha de inicio del trabajo: <span id=\"inicio_fecha\">2023-01-25</span>\r\n</p>\r\n<p>4.3. Periodo de prueba: 60 días</p>\r\n<h4>5.  DURACIÓN Y DIVISIÓN DE LA JORNADA</h4>\r\n<p>5.1.  El horario de trabajo será de 8 (ocho) horas diarias o de 48 (cuarenta y ocho) horas semanales, pudiendo ampliarse la jornada diaria, sin que se considere extraordinaria a los efectos de suplir el trabajo los días sábados, sin que se considere horas extraordinarias a los efectos de su remuneración.\r\n</p>\r\n<p>5.2. Horario básico de trabajo:</p>\r\n<ul>\r\n    <li>De lunes a viernes: de 7:00  a 15:00 horas con un periodo de descanso. </li>\r\n    <li>Sábados 7:00  a 12:00 horas.</li>\r\n</ul>\r\n<p>5.3. El horario podrá ser modificado en función a la época del año y a la necesidad del servicio, así como del local al cual fue destinado. Cualquier cambio de horario, si no hubiere una emergencia, será comunicado con 48 horas de anticipación por lo menos. El horario será anunciado por medio de avisos bien visibles.  Los horarios además se adecuarán a las necesidades de la empresa, por razones de mejor servicio.\r\n</p>\r\n<p>5.4. El descanso semanal será preferentemente los días domingos.  Si se trabaja en domingos o feriados se establece un día o medio día compensatorio de descanso.\r\n</p>\r\n<h4>6.  PERIODO DE PAGO</h4>\r\n<p>6.1. Mensual: cada 30 días.\r\n</p>\r\n<p>6.2. Época: del 1 al 5 de cada mes\r\n</p>\r\n<p>6.3. Lugar de pago: En las oficinas de la empresa o donde ésta designe.\r\n</p>\r\n\r\n<h4>7.- DISPOSICIONES GENERALES</h4>\r\n<p>7.1.  El TRABAJADOR desde el momento que acepta el cargo se obliga a observar las políticas, procedimientos y demás instrucciones de la empresa.\r\n</p>\r\n<p> 7.2.  El TRABAJADOR se compromete a comunicar a la empresa, por nota con acuse de recibo o por telegrama colacionado, el cambio de su domicilio.  Mientras éste no se registre, por el aviso efectuado en la forma antedicha, serán válidas todas las comunicaciones dirigidas al último domicilio denunciado, con todos los efectos legales.\r\n</p>\r\n<p> 7.3.  El TRABAJADOR deberá poner el mayor cuidado y atención en la utilización de los bienes de la empresa.  La violación de esta norma es particularmente grave y podrá ser causal de terminación del contrato con justa causa (art. 83 inc. h del C.T.)\r\n</p>\r\n<p> 7.4.  El TRABAJADOR deberá guardar la mayor reserva sobre costos, precios, nómina de clientes, productos, proveedores, y en general todo lo relacionado con los productos y servicios que la empresa comercializa.  La violación de esta norma es particularmente grave y podrá ser causal de terminación del contrato con justa causa (art. 83 inc. h) del C.T.)\r\n</p>\r\n<p> 7.5.  El TRABAJADOR podrá ser trasladado de Departamentos, Secciones, puestos o funciones, sin reducción de la remuneración y siempre que no constituya menoscabo a su dignidad. Para el efecto la EMPRESA notificará al TRABAJADOR con cuarenta y ocho horas de antelación.\r\n</p>\r\n<p>7.6.  Si el TRABAJADOR realiza viajes al interior y al exterior para la realización de sus tareas, el mismo debe respetar las instrucciones que en ese sentido imparta la empresa, siendo los gastos de traslado y viático por cuenta de ésta.  El incumplimiento de esta disposición será causal de despido con causa justificada.\r\n </p>\r\n <p> 7.7.  A todos los efectos de este contrato se considerará información confidencial toda información relativa a las actividades técnicas, comerciales, de procedimiento u otras de cualquier tipo que sea proporcionada al trabajador en razón de su trabajo o que por cualquier medio legue a sus sentidos, aunque sea fortuitamente, a excepción de aquella que fuera del dominio público. \r\n</p>\r\n<p>7.8. Queda terminantemente prohibido vender, enajenar o regalar equipos, elementos de seguridad o ropa de trabajo que sean proporcionados por la empresa para ser usados en el desempeño de sus funciones.\r\n</p>\r\n<p>7.9. El TRABAJADOR se compromete a ser absolutamente responsable en el cumplimiento de los horarios de trabajo, incluyendo aquellos fijados para reuniones de trabajo, de información o instrucción.  El incumplimiento de horarios y la impuntualidad son sumamente graves.  Registradas las impuntualidades, facultan a la empresa a la aplicación de las sanciones correspondientes de acuerdo a lo establecido por el Código del Trabajo.\r\n</p>\r\n<p> 7.10. El TRABAJADOR deberá cumplir puntualmente con las obligaciones dinerarias contraídas y la promoción de demandas contra el mismo, será considerada particularmente grave.\r\n</p>\r\n<p>En prueba de conformidad y aceptación suscriben las partes en tres ejemplares de un mismo tenor y efecto, quedando uno en poder de cada parte y el tercero para la Autoridad Administrativa del Trabajo, si lo exigiere.\r\n</p>\r\n\r\n<h4>8. CLAUSULA OCTAVA: DOMICILIOS</h4>\r\n<p>8.1 Las partes fijan domicilio en las direcciones enunciadas en el encabezado del presente Contrato, para cualquier comunicación judicial o extrajudicial que surgiere durante la vigente de este Contrato. \r\n</p>\r\n<p>8.2 El TRABAJADOR se compromete a comunicar el cambio de su domicilio dentro de las cuarenta y ocho horas siguientes, por nota con acuse de recibo o telegrama colacionado. Mientras esta comunicación no se haya realizado.\r\n</p>\r\n \r\n<h4>9. CLAUSULA NOVENA: JURISDICCION </h4>\r\n<p>9.1 A todos los efectos derivados del presente contrato individual de trabajo, las partes se someten a las Jurisdicción de los Tribunales Ordinarios de la Ciudad de Asunción, constituyendo sus domicilios en los lugares indicados en el encabezamiento del presente Contrato. \r\n</p>\r\n<p>En prueba de conformidad y aceptación, las partes firman en dos ejemplares del mismo tenor y a un solo efecto. \r\n</p>\r\n<br>\r\n<br>\r\n<br>\r\n<div class=\"row\">\r\n    <div class=\"col-md-6\" style=\"text-align: center;\">\r\n        <span>............................................................</span><br> \r\nEL TRABAJADOR	\r\n    </div>\r\n    <div class=\"col-md-6\" style=\"text-align: center;\">\r\n        <span>............................................................</span><br> \r\nLA EMPRESA	\r\n    </div>\r\n</div>\r\n					   \r\n', '2023-01-25', 6700000, 1, 6, 1, 1, '\'-\'', 'EMPLEADO');
INSERT INTO `contrato` (`con_id`, `con_emis`, `contrat_clau`, `con_fin`, `con_salario`, `con_estado`, `car_id`, `dep_id`, `func_id`, `motivo_salida`, `profesion`) VALUES
(6, '2023-01-27', '\n<h2>CONTRATO DE TRABAJO</h2>\n\n<p>En la ciudad de Capiatá, República del Paraguay, a los <span id=\"dia\">27</span> días del mes de <span id=\"mes\">abril</span> del año <span id=\"anio\">2023</span> entre:\n \nPor una parte, la empresa PRETEC S.A., con dirección en km 16 Ruta 2 de la ciudad de Capiatá ;\nPor la otra, <span id=\"nombre\">BLAS MANCUELLO</span>, de <span id=\"edad\">29</span> años de edad, de sexo <span id=\"sexo\">MASCULINO</span>, de estado <span id=\"estado\">SOLTERO</span>, de nacionalidad <span id=\"nacionalidad\">PARAGUAYA</span>, \ncon C.I. N° <span id=\"cedula_con\">331121</span> con domicilio, sobre la <span id=\"direccion\">ITAUGUA</span> de la ciudad de <span id=\"ciudad\">CAPIATA</span>, en adelante \"EL EMPLEADO\" o “EL TRABAJADOR;</p>\n<p> \n\nDenominadas conjuntamente las partes, convienen en celebrar el presente contrato individual de trabajo, que se regirá por las cláusulas y condiciones siguientes. -\n</p>\n\n<h4>1.  MODALIDADES</h4>\n<p>1.1.  Cargo: <span id=\"cargo\">CONTADORA</span>.  </p>\n<p>\n1.1.1. El TRABAJADOR se obliga a prestar el servicio contratado en la forma y tiempo estipulados en este contrato, siendo estas cláusulas enunciativas y no limitativas, y a desempeñar las labores que tienen relación directa e indirecta con su cargo.\n</p>\n<p>\n1.1.2. Queda convenido entre las partes que la EMPRESA, por razones de mejor servicio, podrá asignar al TRABAJADOR otras tareas complementarias y/o diferentes a las mencionadas en el presente contrato, dentro de un régimen de polivalencia de funciones, en un anexo donde se establecerán dichas funciones adicionales.\n</p>\n<p>\n1.2.  Lugar de la prestación:  En todos los locales de la empresa, ya sea en la Casa Central o en cualquiera de las Agencias o Sucursales que el empleador tiene o tuviere en el futuro en el Paraguay, quedando a criterio del empleador designar el local donde cumplirá sus labores.\n</p>\n\n<h4>2.  FORMA DEL CONTRATO</h4>\n<p>2.1. Por unidad de tiempo. </p>	\n\n<h4>3.  REMUNERACIÓN CONVENIDA</h4>\n<p>3.1. Monto del sueldo mensual: <span id=\"sueldo_con\"></span> GS. </p>\n<h4>4.  PLAZO DEL CONTRATO</h4>\n<p>4.1. Indeterminado, desde la fecha de su firma\n</p>\n<p>4.2. Fecha de inicio del trabajo: <span id=\"inicio_fecha\">2023-01-27</span>\n</p>\n<p>4.3. Periodo de prueba: 60 días</p>\n<h4>5.  DURACIÓN Y DIVISIÓN DE LA JORNADA</h4>\n<p>5.1.  El horario de trabajo será de 8 (ocho) horas diarias o de 48 (cuarenta y ocho) horas semanales, pudiendo ampliarse la jornada diaria, sin que se considere extraordinaria a los efectos de suplir el trabajo los días sábados, sin que se considere horas extraordinarias a los efectos de su remuneración.\n</p>\n<p>5.2. Horario básico de trabajo:</p>\n<ul>\n    <li>De lunes a viernes: de 7:00  a 15:00 horas con un periodo de descanso. </li>\n    <li>Sábados 7:00  a 12:00 horas.</li>\n</ul>\n<p>5.3. El horario podrá ser modificado en función a la época del año y a la necesidad del servicio, así como del local al cual fue destinado. Cualquier cambio de horario, si no hubiere una emergencia, será comunicado con 48 horas de anticipación por lo menos. El horario será anunciado por medio de avisos bien visibles.  Los horarios además se adecuarán a las necesidades de la empresa, por razones de mejor servicio.\n</p>\n<p>5.4. El descanso semanal será preferentemente los días domingos.  Si se trabaja en domingos o feriados se establece un día o medio día compensatorio de descanso.\n</p>\n<h4>6.  PERIODO DE PAGO</h4>\n<p>6.1. Mensual: cada 30 días.\n</p>\n<p>6.2. Época: del 1 al 5 de cada mes\n</p>\n<p>6.3. Lugar de pago: En las oficinas de la empresa o donde ésta designe.\n</p>\n\n<h4>7.- DISPOSICIONES GENERALES</h4>\n<p>7.1.  El TRABAJADOR desde el momento que acepta el cargo se obliga a observar las políticas, procedimientos y demás instrucciones de la empresa.\n</p>\n<p> 7.2.  El TRABAJADOR se compromete a comunicar a la empresa, por nota con acuse de recibo o por telegrama colacionado, el cambio de su domicilio.  Mientras éste no se registre, por el aviso efectuado en la forma antedicha, serán válidas todas las comunicaciones dirigidas al último domicilio denunciado, con todos los efectos legales.\n</p>\n<p> 7.3.  El TRABAJADOR deberá poner el mayor cuidado y atención en la utilización de los bienes de la empresa.  La violación de esta norma es particularmente grave y podrá ser causal de terminación del contrato con justa causa (art. 83 inc. h del C.T.)\n</p>\n<p> 7.4.  El TRABAJADOR deberá guardar la mayor reserva sobre costos, precios, nómina de clientes, productos, proveedores, y en general todo lo relacionado con los productos y servicios que la empresa comercializa.  La violación de esta norma es particularmente grave y podrá ser causal de terminación del contrato con justa causa (art. 83 inc. h) del C.T.)\n</p>\n<p> 7.5.  El TRABAJADOR podrá ser trasladado de Departamentos, Secciones, puestos o funciones, sin reducción de la remuneración y siempre que no constituya menoscabo a su dignidad. Para el efecto la EMPRESA notificará al TRABAJADOR con cuarenta y ocho horas de antelación.\n</p>\n<p>7.6.  Si el TRABAJADOR realiza viajes al interior y al exterior para la realización de sus tareas, el mismo debe respetar las instrucciones que en ese sentido imparta la empresa, siendo los gastos de traslado y viático por cuenta de ésta.  El incumplimiento de esta disposición será causal de despido con causa justificada.\n </p>\n <p> 7.7.  A todos los efectos de este contrato se considerará información confidencial toda información relativa a las actividades técnicas, comerciales, de procedimiento u otras de cualquier tipo que sea proporcionada al trabajador en razón de su trabajo o que por cualquier medio legue a sus sentidos, aunque sea fortuitamente, a excepción de aquella que fuera del dominio público. \n</p>\n<p>7.8. Queda terminantemente prohibido vender, enajenar o regalar equipos, elementos de seguridad o ropa de trabajo que sean proporcionados por la empresa para ser usados en el desempeño de sus funciones.\n</p>\n<p>7.9. El TRABAJADOR se compromete a ser absolutamente responsable en el cumplimiento de los horarios de trabajo, incluyendo aquellos fijados para reuniones de trabajo, de información o instrucción.  El incumplimiento de horarios y la impuntualidad son sumamente graves.  Registradas las impuntualidades, facultan a la empresa a la aplicación de las sanciones correspondientes de acuerdo a lo establecido por el Código del Trabajo.\n</p>\n<p> 7.10. El TRABAJADOR deberá cumplir puntualmente con las obligaciones dinerarias contraídas y la promoción de demandas contra el mismo, será considerada particularmente grave.\n</p>\n<p>En prueba de conformidad y aceptación suscriben las partes en tres ejemplares de un mismo tenor y efecto, quedando uno en poder de cada parte y el tercero para la Autoridad Administrativa del Trabajo, si lo exigiere.\n</p>\n\n<h4>8. CLAUSULA OCTAVA: DOMICILIOS</h4>\n<p>8.1 Las partes fijan domicilio en las direcciones enunciadas en el encabezado del presente Contrato, para cualquier comunicación judicial o extrajudicial que surgiere durante la vigente de este Contrato. \n</p>\n<p>8.2 El TRABAJADOR se compromete a comunicar el cambio de su domicilio dentro de las cuarenta y ocho horas siguientes, por nota con acuse de recibo o telegrama colacionado. Mientras esta comunicación no se haya realizado.\n</p>\n \n<h4>9. CLAUSULA NOVENA: JURISDICCION </h4>\n<p>9.1 A todos los efectos derivados del presente contrato individual de trabajo, las partes se someten a las Jurisdicción de los Tribunales Ordinarios de la Ciudad de Asunción, constituyendo sus domicilios en los lugares indicados en el encabezamiento del presente Contrato. \n</p>\n<p>En prueba de conformidad y aceptación, las partes firman en dos ejemplares del mismo tenor y a un solo efecto. \n</p>\n<br>\n<br>\n<br>\n<div class=\"row\">\n    <div class=\"col-md-6\" style=\"text-align: center;\">\n        <span>............................................................</span><br> \nEL TRABAJADOR	\n    </div>\n    <div class=\"col-md-6\" style=\"text-align: center;\">\n        <span>............................................................</span><br> \nLA EMPRESA	\n    </div>\n</div>\n					   \n', '2023-01-27', 3400000, 1, 3, 1, 3, '\'-\'', 'EMPLEADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato_perfil`
--
-- Error leyendo la estructura de la tabla pretec.contrato_perfil: #1932 - Table 'pretec.contrato_perfil' doesn't exist in engine
-- Error leyendo datos de la tabla pretec.contrato_perfil: #1064 - Algo está equivocado en su sintax cerca 'FROM `pretec`.`contrato_perfil`' en la linea 1

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curriculum`
--

CREATE TABLE `curriculum` (
  `cur_id` int(11) NOT NULL,
  `cur_fecha` date NOT NULL,
  `cur_des` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `per_id` int(11) NOT NULL,
  `estado` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curriculum`
--

INSERT INTO `curriculum` (`cur_id`, `cur_fecha`, `cur_des`, `per_id`, `estado`) VALUES
(1, '2021-09-01', 'ESTA PERSONA LLEGO PUNTUALMENTE CON LA VESTIMENTA ADECUADA', 1, 'APROVADO'),
(2, '2021-09-01', 'NUEVO', 2, 'RECHAZADO'),
(3, '2021-09-01', 'NUEVOS', 3, 'REVISION'),
(4, '2021-10-12', 'NO ANDA ', 5, 'PENDIENTE'),
(5, '2021-10-12', 'NUEVO FUNCIONARIO APROVADOR', 7, 'ANULADO'),
(6, '2021-11-04', 'TODO BIEN\n', 6, 'ANULADO'),
(7, '2021-11-04', 'ASDASD', 8, 'PENDIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curriculum_academico`
--

CREATE TABLE `curriculum_academico` (
  `id_curriculum_academico` int(11) NOT NULL,
  `cur_id` int(11) NOT NULL,
  `lugar` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `periodo` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(900) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curriculum_academico`
--

INSERT INTO `curriculum_academico` (`id_curriculum_academico`, `cur_id`, `lugar`, `periodo`, `descripcion`) VALUES
(7, 7, 'ASDA', 'ASD', 'ASD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curriculum_ref_laboral`
--

CREATE TABLE `curriculum_ref_laboral` (
  `id_curriculum_ref_laboral` int(11) NOT NULL,
  `cur_id` int(11) NOT NULL,
  `nombre_apellido` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(900) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `curriculum_ref_laboral`
--

INSERT INTO `curriculum_ref_laboral` (`id_curriculum_ref_laboral`, `cur_id`, `nombre_apellido`, `telefono`, `descripcion`) VALUES
(4, 7, 'nuevo', 'asdas', 'ssss'),
(5, 7, 'nuevo', 'asdas', 'ssss');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `dep_id` int(11) NOT NULL,
  `dep_descri` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dep_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`dep_id`, `dep_descri`, `dep_estado`) VALUES
(1, 'CONTA2', 1),
(2, 'informatica', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuento`
--

CREATE TABLE `descuento` (
  `des_id` int(11) NOT NULL,
  `des_motiv_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `des_fec` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `des_monto` int(11) NOT NULL,
  `estado` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `descuento`
--

INSERT INTO `descuento` (`des_id`, `des_motiv_id`, `con_id`, `des_fec`, `des_monto`, `estado`) VALUES
(1, 3, 1, '2021-10-27', 500000, 'ACTIVO'),
(2, 2, 1, '2021-10-27', 25000, 'ANULADO'),
(3, 3, 2, '2021-11-02', 45000, 'ACTIVO'),
(4, 2, 2, '2021-11-02', 100000, 'ACTIVO'),
(5, 3, 2, '2023-01-13', 123, 'ANULADO'),
(6, 2, 2, '2023-01-13', 123, 'ANULADO'),
(7, 2, 2, '2023-01-31', 45000, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desc_motiv`
--

CREATE TABLE `desc_motiv` (
  `des_motiv_id` int(11) NOT NULL,
  `des_mot_desci` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `desc_motiv`
--

INSERT INTO `desc_motiv` (`des_motiv_id`, `des_mot_desci`, `estado`) VALUES
(2, 'algo mas', 1),
(3, 'otra cosa', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `desvinculacion`
--

CREATE TABLE `desvinculacion` (
  `id_desvinculacion` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `fecha_desvinculacion` date NOT NULL,
  `justiticado` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `total_liquidacion` int(11) NOT NULL,
  `preaviso` int(11) NOT NULL,
  `indemnizacion` int(11) NOT NULL,
  `ips` int(11) NOT NULL,
  `aguinaldo` int(11) NOT NULL,
  `salario` int(11) NOT NULL,
  `estado` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `desvinculacion`
--

INSERT INTO `desvinculacion` (`id_desvinculacion`, `con_id`, `fecha_desvinculacion`, `justiticado`, `descripcion`, `total_liquidacion`, `preaviso`, `indemnizacion`, `ips`, `aguinaldo`, `salario`, `estado`) VALUES
(2, 2, '2023-02-01', 0, '', 6240000, 225000, 1170000, 405000, 750000, 4500000, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_bonif`
--

CREATE TABLE `det_bonif` (
  `id_def_bonif` int(11) NOT NULL,
  `bon_id` int(11) NOT NULL,
  `nombre_apellido` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `det_bonif`
--

INSERT INTO `det_bonif` (`id_def_bonif`, `bon_id`, `nombre_apellido`, `fecha_nacimiento`, `estado`) VALUES
(4, 1, 'JOSE MEZA', '2012-06-12', 1),
(9, 1, 'KUMARK LOPEZ', '2008-10-14', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_ips`
--

CREATE TABLE `det_ips` (
  `det_ips_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `det_ips_fe_pg` date NOT NULL,
  `det_ips_des` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `det_ips_aport` int(100) NOT NULL,
  `det_ips_estado` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `det_ips`
--

INSERT INTO `det_ips` (`det_ips_id`, `con_id`, `det_ips_fe_pg`, `det_ips_des`, `det_ips_aport`, `det_ips_estado`) VALUES
(1, 1, '2021-10-01', 'ingreso actual del mes', 30600, 'ANULADO'),
(2, 1, '2021-10-01', 'actualizacion', 30600, 'ANULADO'),
(3, 2, '2021-10-01', 'Sin problemas', 405000, 'ANULADO'),
(4, 1, '2021-11-01', 'DECLARACION DEL MES DE NOVIEMBRE IPS', 30600, 'ANULADO'),
(5, 2, '2021-11-01', 'DECLARACION CORRECTA', 405000, 'ANULADO'),
(6, 2, '2021-11-01', 'ACTUALIZACION DEL APORTE', 405000, 'ANULADO'),
(7, 2, '2021-12-01', 'Todo bien', 405000, 'ANULADO'),
(8, 2, '2021-11-01', 'Renovado', 405000, 'ANULADO'),
(9, 2, '2021-12-01', 'correcto', 405000, 'ANULADO'),
(10, 2, '2021-11-01', 'asd', 405000, 'ANULADO'),
(11, 2, '2021-11-01', 'asdasd', 405000, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_min_trab`
--

CREATE TABLE `det_min_trab` (
  `det_min_trab_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `det_mjt_patrl` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `det_mjt_fe_pla` date NOT NULL,
  `det_mjt_esta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `det_min_trab_desc` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `det_min_trab`
--

INSERT INTO `det_min_trab` (`det_min_trab_id`, `con_id`, `det_mjt_patrl`, `det_mjt_fe_pla`, `det_mjt_esta`, `det_min_trab_desc`) VALUES
(1, 1, 'B3333', '2021-10-28', 'ACTIVO', 'ALGO MAS A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `det_salario`
--

CREATE TABLE `det_salario` (
  `det_salario_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `bon_flia` int(11) NOT NULL,
  `sal_id` int(11) NOT NULL,
  `sal_mes` int(11) NOT NULL,
  `total_extra` int(11) NOT NULL,
  `total_descuento` int(11) NOT NULL,
  `sal_fec_emis` date NOT NULL,
  `ips` int(11) NOT NULL,
  `estado` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `det_salario`
--

INSERT INTO `det_salario` (`det_salario_id`, `con_id`, `bon_flia`, `sal_id`, `sal_mes`, `total_extra`, `total_descuento`, `sal_fec_emis`, `ips`, `estado`) VALUES
(1, 2, 0, 4500000, 3950000, 120000, 550000, '2021-11-02', 8, 'ANULADO'),
(2, 2, 45000, 4500000, 3950000, 120000, 550000, '2021-11-03', 8, 'ACTIVO'),
(3, 2, 235600, 4500000, 4330600, 45000, 450000, '2023-01-31', 405000, 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `func_id` int(11) NOT NULL,
  `func_ingreso` date NOT NULL,
  `func_baja` date DEFAULT NULL,
  `cur_id` int(11) NOT NULL,
  `suc_id` int(11) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`func_id`, `func_ingreso`, `func_baja`, `cur_id`, `suc_id`, `estado`) VALUES
(1, '2021-09-01', NULL, 1, 1, 1),
(2, '2021-09-01', NULL, 2, 2, 1),
(3, '2021-09-01', '2022-03-18', 3, 1, 0),
(4, '2021-10-14', NULL, 5, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hora_extra`
--

CREATE TABLE `hora_extra` (
  `hor_id` int(11) NOT NULL,
  `hor_fech` date NOT NULL,
  `hor_total` time NOT NULL,
  `hor_mont` int(11) NOT NULL,
  `asi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos`
--

CREATE TABLE `ingresos` (
  `id_ingreso` int(11) NOT NULL,
  `cantidad_horas` int(11) NOT NULL,
  `monto` int(11) NOT NULL,
  `id_concepto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `estado` varchar(11) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ingresos`
--

INSERT INTO `ingresos` (`id_ingreso`, `cantidad_horas`, `monto`, `id_concepto`, `fecha`, `id_usuario`, `con_id`, `estado`) VALUES
(1, 1, 20000, 3, '2023-01-19', 1, 2, 'ANULADO'),
(2, 2, 45000, 5, '2023-01-20', 1, 2, 'ACTIVO'),
(3, 1, 20000, 3, '2023-02-01', 1, 2, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `justi_perm`
--

CREATE TABLE `justi_perm` (
  `jus_per_id` int(11) NOT NULL,
  `just_per_de` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `just_estado` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `justi_perm`
--

INSERT INTO `justi_perm` (`jus_per_id`, `just_per_de`, `just_estado`) VALUES
(2, 'POR KAIGUE', '1'),
(3, 'algo', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `legajo_funcionario`
--

CREATE TABLE `legajo_funcionario` (
  `id_legajo_fun` int(11) NOT NULL,
  `func_id` int(11) NOT NULL,
  `per_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `minis_trabaj`
--

CREATE TABLE `minis_trabaj` (
  `min_trab_id` int(11) NOT NULL,
  `min_descrii` varchar(900) COLLATE utf8_unicode_ci NOT NULL,
  `min_fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motiv_perm`
--

CREATE TABLE `motiv_perm` (
  `mot_perm_id` int(11) NOT NULL,
  `mot_per_des` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mot_sancion`
--

CREATE TABLE `mot_sancion` (
  `mot_san_id` int(11) NOT NULL,
  `mot_san` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `mot_sancion`
--

INSERT INTO `mot_sancion` (`mot_san_id`, `mot_san`, `estado`) VALUES
(3, 'ENFERMEDAD OTRO', 1),
(4, 'algo mas', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_cargo`
--

CREATE TABLE `perfil_cargo` (
  `id_per_carg` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `perfil_cargo`
--

INSERT INTO `perfil_cargo` (`id_per_carg`, `car_id`, `descripcion`, `estado`) VALUES
(1, 3, 'AUXILIAR BASICO', 1),
(5, 6, 'experiencia', 1),
(6, 6, 'proactivo', 1),
(7, 6, 'rapido', 1),
(10, 2, 'otro mas', 1),
(11, 2, 'probando', 1),
(12, 2, 'otro por si', 1),
(13, 3, 'MANEJO DE EXCEL', 1),
(14, 3, 'TRABAJA BAJO PRESION', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `perm_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `jus_per_id` int(11) NOT NULL,
  `perm_descri` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `perm_fec_solic` date NOT NULL,
  `perm_estado` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `perm_fec_desde` date NOT NULL,
  `perm_fec_hasta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`perm_id`, `con_id`, `jus_per_id`, `perm_descri`, `perm_fec_solic`, `perm_estado`, `perm_fec_desde`, `perm_fec_hasta`) VALUES
(1, 1, 3, 'por algo AS', '2021-10-26', 'ANULADO', '2021-10-26', '2021-10-31'),
(3, 2, 0, 'aasc', '2023-01-08', 'ACTIVO', '2023-01-08', '2023-01-08'),
(4, 2, 0, 'ya', '2023-01-08', 'ANULADO', '2023-01-08', '2023-01-25'),
(5, 2, 0, 'mejor', '2023-01-08', 'PENDIENTE', '2023-01-08', '2023-01-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `per_id` int(11) NOT NULL,
  `per_apell` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `per_nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `cedula` int(11) NOT NULL,
  `per_nacim` date NOT NULL,
  `per_direc` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `per_genero` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `per_ciud` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `per_nacion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `per_est_civ` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `per_correo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `per_telfono` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`per_id`, `per_apell`, `per_nom`, `cedula`, `per_nacim`, `per_direc`, `per_genero`, `per_ciud`, `per_nacion`, `per_est_civ`, `per_correo`, `per_telfono`) VALUES
(1, 'MEZA', 'LUCERO', 4444, '2021-09-07', 'CAPIATA EN ALGUN LUGAR', 'FEMENINO', 'CAPIATA', 'PARAGUAYA', 'CASADO', 'ARIEL@GMAIL.COM', '09128312'),
(2, 'MEZA', 'JUAN', 123, '2021-09-07', 'CAPIATA EN ALGUN LUGAR', 'MASCULINO', 'CAPIATA', 'PARAGUAYA', 'SOLTERO', 'JOSE@GMAIL.COM', '09128312'),
(3, 'MANCUELLO', 'BLAS', 331121, '1994-01-07', 'ITAUGUA', 'MASCULINO', 'CAPIATA', 'PARAGUAYA', 'SOLTERO', 'BLAS@GMAIL.COM', '09128312');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salario`
--

CREATE TABLE `salario` (
  `sal_id` int(11) NOT NULL,
  `sal_descri` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sal_monto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sancion`
--

CREATE TABLE `sancion` (
  `san_id` int(11) NOT NULL,
  `con_id` int(11) NOT NULL,
  `mot_san_id` int(11) NOT NULL,
  `sanc_descri` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `sanc_fec` date NOT NULL,
  `sanc_estado` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sancion`
--

INSERT INTO `sancion` (`san_id`, `con_id`, `mot_san_id`, `sanc_descri`, `sanc_fec`, `sanc_estado`) VALUES
(1, 1, 3, 'nuevo descripcion', '2021-10-26', 'ANULADO'),
(2, 1, 4, 'Hola', '2021-10-26', 'ACTIVO'),
(3, 1, 3, 'NO LO HIZO EN FORMA', '2021-10-26', 'ACTIVO'),
(4, 2, 3, 'NONA\n', '2023-01-08', 'ACTIVO'),
(5, 2, 3, '', '2023-01-08', 'ACTIVO'),
(6, 2, 4, '', '2023-01-08', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `suc_id` int(11) NOT NULL,
  `suc_descri` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`suc_id`, `suc_descri`, `estado`) VALUES
(1, 'LUQUE', 1),
(2, 'CAACUPE', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usu_id` int(11) NOT NULL,
  `usu_log` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usu_pass` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usu_nivel` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `usu_estado` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `func_id` int(11) NOT NULL,
  `usu_intentos` int(11) NOT NULL,
  `usu_limite_intentos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usu_id`, `usu_log`, `usu_pass`, `usu_nivel`, `usu_estado`, `func_id`, `usu_intentos`, `usu_limite_intentos`) VALUES
(1, 'lucero', '202cb962ac59075b964b07152d234b70', 'ADMINISTRADOR', 'ACTIVO', 1, 0, 3),
(2, 'juan', '202cb962ac59075b964b07152d234b70', 'RECURSOS HUMANOS', 'ACTIVO', 2, 0, 3),
(3, 'blas', '202cb962ac59075b964b07152d234b70', 'INFORMES', 'ACTIVO', 3, 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacaciones`
--

CREATE TABLE `vacaciones` (
  `vac_id` int(11) NOT NULL,
  `vac_dias` int(11) NOT NULL,
  `vac_salida` date NOT NULL,
  `vac_fin` date NOT NULL,
  `vac_estado` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `con_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `vacaciones`
--

INSERT INTO `vacaciones` (`vac_id`, `vac_dias`, `vac_salida`, `vac_fin`, `vac_estado`, `con_id`) VALUES
(1, 5, '2023-01-22', '2023-01-28', 'CONFIRMADO', 2),
(3, 15, '2023-01-23', '2023-02-10', 'CONFIRMADO', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aguinaldo`
--
ALTER TABLE `aguinaldo`
  ADD PRIMARY KEY (`agui_id`),
  ADD KEY `contrato_aguinaldo_fk` (`con_id`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`asi_id`),
  ADD KEY `con_id` (`con_id`);

--
-- Indices de la tabla `bonif_filia`
--
ALTER TABLE `bonif_filia`
  ADD PRIMARY KEY (`bon_id`),
  ADD KEY `contrato_bonif_filia_fk` (`con_id`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`car_id`);

--
-- Indices de la tabla `concepto`
--
ALTER TABLE `concepto`
  ADD PRIMARY KEY (`id_concepto`);

--
-- Indices de la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD PRIMARY KEY (`con_id`),
  ADD KEY `funcionarios_contrato_fk` (`func_id`),
  ADD KEY `dep_id` (`dep_id`),
  ADD KEY `cargo_contrarto` (`car_id`);

--
-- Indices de la tabla `curriculum`
--
ALTER TABLE `curriculum`
  ADD PRIMARY KEY (`cur_id`),
  ADD KEY `personal_curriculum_fk` (`per_id`);

--
-- Indices de la tabla `curriculum_academico`
--
ALTER TABLE `curriculum_academico`
  ADD PRIMARY KEY (`id_curriculum_academico`),
  ADD KEY `cur_id` (`cur_id`);

--
-- Indices de la tabla `curriculum_ref_laboral`
--
ALTER TABLE `curriculum_ref_laboral`
  ADD PRIMARY KEY (`id_curriculum_ref_laboral`),
  ADD KEY `cur_id` (`cur_id`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`dep_id`),
  ADD UNIQUE KEY `dep_id` (`dep_id`);

--
-- Indices de la tabla `descuento`
--
ALTER TABLE `descuento`
  ADD PRIMARY KEY (`des_id`,`des_motiv_id`,`con_id`),
  ADD KEY `contrato_descuento_fk` (`con_id`),
  ADD KEY `des_motiv_id` (`des_motiv_id`);

--
-- Indices de la tabla `desc_motiv`
--
ALTER TABLE `desc_motiv`
  ADD PRIMARY KEY (`des_motiv_id`) USING BTREE;

--
-- Indices de la tabla `desvinculacion`
--
ALTER TABLE `desvinculacion`
  ADD PRIMARY KEY (`id_desvinculacion`);

--
-- Indices de la tabla `det_bonif`
--
ALTER TABLE `det_bonif`
  ADD PRIMARY KEY (`id_def_bonif`);

--
-- Indices de la tabla `det_ips`
--
ALTER TABLE `det_ips`
  ADD PRIMARY KEY (`det_ips_id`),
  ADD KEY `contrato_det_ips_fk` (`con_id`);

--
-- Indices de la tabla `det_min_trab`
--
ALTER TABLE `det_min_trab`
  ADD PRIMARY KEY (`det_min_trab_id`) USING BTREE,
  ADD KEY `con_id` (`con_id`);

--
-- Indices de la tabla `det_salario`
--
ALTER TABLE `det_salario`
  ADD PRIMARY KEY (`det_salario_id`),
  ADD KEY `con_id` (`con_id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`func_id`),
  ADD KEY `curriculum_funcionarios_fk` (`cur_id`),
  ADD KEY `sucursal_funcionarios_fk` (`suc_id`);

--
-- Indices de la tabla `hora_extra`
--
ALTER TABLE `hora_extra`
  ADD PRIMARY KEY (`hor_id`),
  ADD KEY `asi_id` (`asi_id`);

--
-- Indices de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD PRIMARY KEY (`id_ingreso`),
  ADD KEY `id_concepto` (`id_concepto`),
  ADD KEY `con_id` (`con_id`);

--
-- Indices de la tabla `justi_perm`
--
ALTER TABLE `justi_perm`
  ADD PRIMARY KEY (`jus_per_id`);

--
-- Indices de la tabla `legajo_funcionario`
--
ALTER TABLE `legajo_funcionario`
  ADD PRIMARY KEY (`id_legajo_fun`),
  ADD KEY `personal_legajo_funcionario_fk` (`per_id`),
  ADD KEY `empleados_legajo_funcionario_fk` (`func_id`),
  ADD KEY `contrato_legajo_funcionario_fk` (`con_id`);

--
-- Indices de la tabla `minis_trabaj`
--
ALTER TABLE `minis_trabaj`
  ADD PRIMARY KEY (`min_trab_id`);

--
-- Indices de la tabla `motiv_perm`
--
ALTER TABLE `motiv_perm`
  ADD PRIMARY KEY (`mot_perm_id`);

--
-- Indices de la tabla `mot_sancion`
--
ALTER TABLE `mot_sancion`
  ADD PRIMARY KEY (`mot_san_id`);

--
-- Indices de la tabla `perfil_cargo`
--
ALTER TABLE `perfil_cargo`
  ADD PRIMARY KEY (`id_per_carg`),
  ADD KEY `car_id` (`car_id`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`perm_id`,`con_id`,`jus_per_id`) USING BTREE,
  ADD KEY `contrato_det_perm_fk` (`con_id`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`per_id`);

--
-- Indices de la tabla `salario`
--
ALTER TABLE `salario`
  ADD PRIMARY KEY (`sal_id`);

--
-- Indices de la tabla `sancion`
--
ALTER TABLE `sancion`
  ADD PRIMARY KEY (`san_id`,`con_id`,`mot_san_id`),
  ADD KEY `contrato_det_sancion_fk` (`con_id`),
  ADD KEY `motivo_sancion_fkpk` (`mot_san_id`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`suc_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `empleados_usuario_fk` (`func_id`);

--
-- Indices de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD PRIMARY KEY (`vac_id`),
  ADD KEY `contrato_vacaciones_fk` (`con_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aguinaldo`
--
ALTER TABLE `aguinaldo`
  MODIFY `agui_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `asi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `bonif_filia`
--
ALTER TABLE `bonif_filia`
  MODIFY `bon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `car_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `concepto`
--
ALTER TABLE `concepto`
  MODIFY `id_concepto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `curriculum_academico`
--
ALTER TABLE `curriculum_academico`
  MODIFY `id_curriculum_academico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `curriculum_ref_laboral`
--
ALTER TABLE `curriculum_ref_laboral`
  MODIFY `id_curriculum_ref_laboral` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `dep_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `descuento`
--
ALTER TABLE `descuento`
  MODIFY `des_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `desc_motiv`
--
ALTER TABLE `desc_motiv`
  MODIFY `des_motiv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `desvinculacion`
--
ALTER TABLE `desvinculacion`
  MODIFY `id_desvinculacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `det_bonif`
--
ALTER TABLE `det_bonif`
  MODIFY `id_def_bonif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `det_ips`
--
ALTER TABLE `det_ips`
  MODIFY `det_ips_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `det_min_trab`
--
ALTER TABLE `det_min_trab`
  MODIFY `det_min_trab_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `det_salario`
--
ALTER TABLE `det_salario`
  MODIFY `det_salario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ingresos`
--
ALTER TABLE `ingresos`
  MODIFY `id_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `justi_perm`
--
ALTER TABLE `justi_perm`
  MODIFY `jus_per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `legajo_funcionario`
--
ALTER TABLE `legajo_funcionario`
  MODIFY `id_legajo_fun` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mot_sancion`
--
ALTER TABLE `mot_sancion`
  MODIFY `mot_san_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `perfil_cargo`
--
ALTER TABLE `perfil_cargo`
  MODIFY `id_per_carg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `perm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `sancion`
--
ALTER TABLE `sancion`
  MODIFY `san_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `suc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  MODIFY `vac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aguinaldo`
--
ALTER TABLE `aguinaldo`
  ADD CONSTRAINT `contrato_aguinaldo_fk` FOREIGN KEY (`con_id`) REFERENCES `contrato` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`con_id`) REFERENCES `contrato` (`con_id`),
  ADD CONSTRAINT `contrato_asistencia_fk` FOREIGN KEY (`con_id`) REFERENCES `contrato` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `bonif_filia`
--
ALTER TABLE `bonif_filia`
  ADD CONSTRAINT `contrato_bonif_filia_fk` FOREIGN KEY (`con_id`) REFERENCES `contrato` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `contrato`
--
ALTER TABLE `contrato`
  ADD CONSTRAINT `cargo_contrarto` FOREIGN KEY (`car_id`) REFERENCES `cargos` (`car_id`),
  ADD CONSTRAINT `contrato_ibfk_1` FOREIGN KEY (`dep_id`) REFERENCES `departamento` (`dep_id`),
  ADD CONSTRAINT `funcionarios_contrato_fk` FOREIGN KEY (`func_id`) REFERENCES `empleados` (`func_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `curriculum_academico`
--
ALTER TABLE `curriculum_academico`
  ADD CONSTRAINT `curriculum_academico_ibfk_1` FOREIGN KEY (`cur_id`) REFERENCES `curriculum` (`cur_id`);

--
-- Filtros para la tabla `curriculum_ref_laboral`
--
ALTER TABLE `curriculum_ref_laboral`
  ADD CONSTRAINT `curriculum_ref_laboral_ibfk_1` FOREIGN KEY (`cur_id`) REFERENCES `curriculum` (`cur_id`);

--
-- Filtros para la tabla `descuento`
--
ALTER TABLE `descuento`
  ADD CONSTRAINT `contrato_descuento_fk` FOREIGN KEY (`con_id`) REFERENCES `contrato` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `descuento_ibfk_1` FOREIGN KEY (`des_motiv_id`) REFERENCES `desc_motiv` (`des_motiv_id`);

--
-- Filtros para la tabla `det_ips`
--
ALTER TABLE `det_ips`
  ADD CONSTRAINT `contrato_det_ips_fk` FOREIGN KEY (`con_id`) REFERENCES `contrato` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `det_min_trab`
--
ALTER TABLE `det_min_trab`
  ADD CONSTRAINT `det_min_trab_ibfk_1` FOREIGN KEY (`con_id`) REFERENCES `contrato` (`con_id`);

--
-- Filtros para la tabla `det_salario`
--
ALTER TABLE `det_salario`
  ADD CONSTRAINT `det_salario_ibfk_1` FOREIGN KEY (`con_id`) REFERENCES `contrato` (`con_id`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `curriculum_funcionarios_fk` FOREIGN KEY (`cur_id`) REFERENCES `curriculum` (`cur_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sucursal_funcionarios_fk` FOREIGN KEY (`suc_id`) REFERENCES `sucursal` (`suc_id`);

--
-- Filtros para la tabla `hora_extra`
--
ALTER TABLE `hora_extra`
  ADD CONSTRAINT `hora_extra_ibfk_1` FOREIGN KEY (`asi_id`) REFERENCES `asistencia` (`asi_id`);

--
-- Filtros para la tabla `ingresos`
--
ALTER TABLE `ingresos`
  ADD CONSTRAINT `ingresos_ibfk_1` FOREIGN KEY (`id_concepto`) REFERENCES `concepto` (`id_concepto`),
  ADD CONSTRAINT `ingresos_ibfk_2` FOREIGN KEY (`con_id`) REFERENCES `contrato` (`con_id`);

--
-- Filtros para la tabla `legajo_funcionario`
--
ALTER TABLE `legajo_funcionario`
  ADD CONSTRAINT `contrato_legajo_funcionario_fk` FOREIGN KEY (`con_id`) REFERENCES `contrato` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `empleados_legajo_funcionario_fk` FOREIGN KEY (`func_id`) REFERENCES `empleados` (`func_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `personal_legajo_funcionario_fk` FOREIGN KEY (`per_id`) REFERENCES `personal` (`per_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `perfil_cargo`
--
ALTER TABLE `perfil_cargo`
  ADD CONSTRAINT `perfil_cargo_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `cargos` (`car_id`);

--
-- Filtros para la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD CONSTRAINT `contrato_det_perm_fk` FOREIGN KEY (`con_id`) REFERENCES `contrato` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sancion`
--
ALTER TABLE `sancion`
  ADD CONSTRAINT `contrato_det_sancion_fk` FOREIGN KEY (`con_id`) REFERENCES `contrato` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `motivo_sancion_fkpk` FOREIGN KEY (`mot_san_id`) REFERENCES `mot_sancion` (`mot_san_id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `empleados_usuario_fk` FOREIGN KEY (`func_id`) REFERENCES `empleados` (`func_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vacaciones`
--
ALTER TABLE `vacaciones`
  ADD CONSTRAINT `contrato_vacaciones_fk` FOREIGN KEY (`con_id`) REFERENCES `contrato` (`con_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
