<?php

require_once "core/crud.php";

class Product extends Crud
{
    public $id;
    public $codigo;
    public $nombre;
    public $descripcion;
    public $precio_unitario;
    public $precio_proveedor;
    public $imagen;
    public $id_categoria;
    public $estatus;
    const TABLE = 'producto_table';
    private $pdo;
    public function __construct()
    {
        parent::__construct(self::TABLE);
        $this->pdo = parent::connect();
    }

    public function nuevo(){
        try {
            $sql = "INSERT INTO " . self::TABLE . " (codigo, nombre, descripcion, precio_unitario, precio_proveedor, imagen, id_categoria) 
            VALUES(?,?,?,?,?,?,?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array(
                $this->codigo,
                $this->nombre,
                $this->descripcion, 
                $this->precio_unitario,
                $this->precio_proveedor, 
                $this->imagen, 
                $this->id_categoria
            ));
        } catch (PDOException $e) {
            echo $e->getMessage();
          }
    }

    public function create()
    {
        return;
    }
    public function update()
    {
        return;
    }
}
