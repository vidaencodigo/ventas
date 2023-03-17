USE `venta_db`;


CREATE TABLE IF NOT EXISTS `categoria_table` (
    `id` BIGINT,
    `nombre` VARCHAR(255) NOT NULL,
    
    `estatus` enum('active', 'closed') DEFAULT 'active',
    `created_at` TIMESTAMP DEFAULT NOW(),
    `updated_at` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE(nombre)
   
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='almacena las ventas';


ALTER TABLE `categoria_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `categoria_table`
  MODIFY `id` BIGINT NOT NULL AUTO_INCREMENT;

  ALTER TABLE `categoria_table`
    CHANGE updated_at  
        updated_at TIMESTAMP NOT NULL
            DEFAULT CURRENT_TIMESTAMP
            ON UPDATE CURRENT_TIMESTAMP;