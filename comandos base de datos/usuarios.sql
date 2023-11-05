CREATE TABLE
    `db_party_owner`.`usuarios` (
        `idUsuario` VARCHAR(10) NOT NULL,
        `nombre` VARCHAR(50) CHARACTER
        SET
            utf8 COLLATE utf8_general_ci NOT NULL,
            `correo` VARCHAR(30) CHARACTER
        SET
            utf8 COLLATE utf8_general_ci NOT NULL,
            `password` VARCHAR(40) CHARACTER
        SET
            utf8 COLLATE utf8_general_ci NOT NULL,
            `telefono` INT NOT NULL,
            `fechaNacimiento` DATE NOT NULL,
            `foto` LONGBLOB,
            PRIMARY KEY (`idUsuario` (5))
    ) ENGINE = InnoDB;

ALTER TABLE `usuarios` ADD UNIQUE (`idUsuario`);

ALTER TABLE `usuarios` CHANGE `telefono` `telefono` VARCHAR(11) NOT NULL;