USE `venta_db`;
CREATE TABLE IF NOT EXISTS `cliente_table` (
    `id` INT,
    `nombre` varchar(255) NOT NULL,
    `apellidos` varchar(255),
    `direccion` varchar(255),
    `telefono` VARCHAR(200),
    `estatus` enum('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT NOW(),
    `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_spanish_ci COMMENT = 'almacena clientes';
ALTER TABLE `cliente_table`
ADD PRIMARY KEY (`id`);
ALTER TABLE `cliente_table`
MODIFY `id` BIGINT NOT NULL AUTO_INCREMENT;
ALTER TABLE `cliente_table` CHANGE updated_at updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP;