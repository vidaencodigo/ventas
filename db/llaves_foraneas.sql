USE `venta_db`;
ALTER TABLE `venta_table`
ADD FOREIGN KEY (id_cliente) REFERENCES `cliente_table` (id);

ALTER TABLE `conceptos_table`
ADD FOREIGN KEY (id_venta) REFERENCES `venta_table` (id);

ALTER TABLE `conceptos_table`
ADD FOREIGN KEY (id_producto) REFERENCES `producto_table` (id);


ALTER TABLE `producto_table`
ADD FOREIGN KEY (id_categoria) REFERENCES `categoria_table` (id);