<?php

require_once "core/crud.php";
class producto
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
}
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
    public function get_all()
    {
        /** reescribe get_all */
        try {
            //code...
            $sql = "SELECT * FROM " . self::TABLE . " WHERE estatus=?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute(array("active"));
            $result= $stm->fetchall(\PDO::FETCH_OBJ);
            /**
             * convert obj to array for use as json response
             */
            $data = array();
            foreach ($result as $producto) :
                $data[] = array(
                    "id" => $producto->id,
                    "codigo"=>$producto->codigo,
                    "nombre" => $producto->nombre,
                    "descripcion" => $producto->descripcion,
                    "precio_unitario" => $producto->precio_unitario,
                    "precio_proveedor" => $producto->precio_proveedor,
                    "id_categoria" => $producto->id_categoria,
                    "estatus" => $producto->estatus,
                    "created" => $producto->created_at,
                    "updated" => $producto->updated_at,
                    "imagen" => base64_encode($producto->imagen)
                );
            endforeach;
            return $data;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function nuevo()
    {
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
