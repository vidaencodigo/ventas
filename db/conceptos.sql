USE `venta_db`;


CREATE TABLE IF NOT EXISTS `conceptos_table` (
    `id` BIGINT,
    `id_venta` BIGINT,
    `id_producto` BIGINT,
    `cantidad` INT,
    `precio_unitario` DECIMAL(16,2),
    `importe` DECIMAL(16,2),
    `created_at` TIMESTAMP DEFAULT NOW(),
    `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena conceptos de ventas';


ALTER TABLE `conceptos_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `conceptos_table`
  MODIFY `id` BIGINT NOT NULL AUTO_INCREMENT;

  ALTER TABLE `conceptos_table`
    CHANGE updated_at  
        updated_at TIMESTAMP NOT NULL
            DEFAULT CURRENT_TIMESTAMP
            ON UPDATE CURRENT_TIMESTAMP;