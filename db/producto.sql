USE `venta_db`;


CREATE TABLE IF NOT EXISTS `producto_table` (
    `id` BIGINT,
    `codigo` VARCHAR(200),
    `nombre` VARCHAR(255),
    `descripcion` TEXT,
    `precio_unitario` DECIMAL(16,2),
    `precio_proveedor` DECIMAL(16,2),
    `imagen` BLOB,
    `estatus` enum('active', 'inactive') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT NOW(),
    `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE(codigo)
   
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena productos';


ALTER TABLE `producto_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `producto_table`
  MODIFY `id` BIGINT NOT NULL AUTO_INCREMENT;

  ALTER TABLE `producto_table`
    CHANGE updated_at  
        updated_at TIMESTAMP NOT NULL
            DEFAULT CURRENT_TIMESTAMP
            ON UPDATE CURRENT_TIMESTAMP;