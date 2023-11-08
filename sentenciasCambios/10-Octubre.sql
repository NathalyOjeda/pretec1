/*CURRICULUM*/
CREATE TABLE `curriculum_exp_laboral` (
 `id_curriculum_exp_laboral` int(11) NOT NULL AUTO_INCREMENT,
 `cur_id` int(11) NOT NULL,
 `empresa` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
 `telefono` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
 `descripcion` varchar(900) COLLATE utf8_unicode_ci NOT NULL,
 PRIMARY KEY (`id_curriculum_exp_laboral`),
 KEY `cur_id` (`cur_id`),
 CONSTRAINT `curriculum_exp_laboral_ibfk_1` FOREIGN KEY (`cur_id`) REFERENCES `curriculum` (`cur_id`)
) 
