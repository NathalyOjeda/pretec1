CREATE TABLE `permiso_justif` (
 `id_permiso_justif` int(11) NOT NULL,
 `con_id` int(11) NOT NULL,
 `fecha` int(11) NOT NULL,
 `jus_per_id` int(11) NOT NULL,
 `observacion` text COLLATE utf8_unicode_ci NOT NULL,
 `file` longblob NOT NULL,
 `estado` tinyint(1) NOT NULL
);

ALTER TABLE `permiso_justif` CHANGE `file` `file` LONGBLOB NULL;
ALTER TABLE `permiso_justif` ADD PRIMARY KEY(`id_permiso_justif`);
ALTER TABLE `permiso_justif` CHANGE `id_permiso_justif` `id_permiso_justif` INT(11) NOT NULL AUTO_INCREMENT;