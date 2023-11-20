CREATE TABLE
    `db_party_owner`.`eventos` (
        `idEvento` VARCHAR(10) NOT NULL,
        `nombreEvento` VARCHAR(50) NOT NULL,
        `fechaEvento` DATE NOT NULL,
        `ubicacionEvento` TEXT NOT NULL,
        `idUsuario` VARCHAR(10) CHARACTER
        SET
            utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
            PRIMARY KEY (`idEvento`)
    ) ENGINE = InnoDB;

ALTER TABLE `eventos` ADD UNIQUE (`idEvento`);

ALTER TABLE `eventos` ADD CONSTRAINT `fk_idUsuario_evento` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `eventos` ADD `hora_evento` TIME NOT NULL AFTER `fechaEvento`;