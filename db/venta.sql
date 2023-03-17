USE `venta_db`;


CREATE TABLE IF NOT EXISTS `venta_table` (
    `id` BIGINT,
    `id_cliente` BIGINT,
    `fecha` DATE DEFAULT NOW(),
    `total` DECIMAL(16,2),
    `estatus` enum('active', 'closed') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT NOW(),
    `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena las ventas';


ALTER TABLE `venta_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `venta_table`
  MODIFY `id` BIGINT NOT NULL AUTO_INCREMENT;

  ALTER TABLE `venta_table`
    CHANGE updated_at  
        updated_at TIMESTAMP NOT NULL
            DEFAULT CURRENT_TIMESTAMP
            ON UPDATE CURRENT_TIMESTAMP;