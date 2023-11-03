/*
Se ejecuta primero este script para crear la tabla invitacion
 */
CREATE TABLE
    `db_party_owner`.`invitacion` (
        `idInvitacion` VARCHAR(10) NOT NULL,
        `idEvento` VARCHAR(10) NOT NULL,
        `idUsuario` VARCHAR(10) CHARACTER
        SET
            utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
            `estadoInvitacion` VARCHAR(40) CHARACTER
        SET
            utf8 COLLATE utf8_general_ci NOT NULL,
            PRIMARY KEY (`idInvitacion` (5))
    ) ENGINE = InnoDB;

-- Se ejecuta este script para crear el indice unico
ALTER TABLE `invitacion` ADD UNIQUE (`idInvitacion`);

-- Se ejecuta este script para crear las llaves foraneas uno por uno
ALTER TABLE `invitacion` ADD CONSTRAINT `fk_idEventos` FOREIGN KEY (`idEvento`) REFERENCES `eventos` (`idEvento`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `invitacion` ADD CONSTRAINT `fk_idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`) ON DELETE RESTRICT ON UPDATE RESTRICT;