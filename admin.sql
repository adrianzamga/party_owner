CREATE TABLE
    `db_party_owner`.`admin` (
        `idAdmin` VARCHAR(10) NOT NULL,
        `nombre` VARCHAR(50) CHARACTER
        SET
            utf8 COLLATE utf8_general_ci NOT NULL,
            `correo` VARCHAR(50) CHARACTER
        SET
            utf8 COLLATE utf8_general_ci NOT NULL,
            `password` VARCHAR(50) CHARACTER
        SET
            utf8 COLLATE utf8_general_ci NOT NULL,
            PRIMARY KEY (`idAdmin` (5))
    )