<?php
require_once "app/controller/manejadores.php";
require_once "app/models/categorias.php";
require_once "app/models/producto.php";
class ProductController
{
    private $views_path = "app/views/product/";
    private $category;
    private $product;
    public function __construct()
    {
        $this->category = new Category();
        $this->product = new Product();
    }
    public function get_form_new()
    {
        $_SESSION['token'] =  bin2hex(random_bytes(35));
        $categorias = $this->category->get_all();
        require_once $this->views_path . "new_product.php";
    }

    public function post_save_product()
    {

        $token = $_REQUEST['token'];
        $imgContenido = null;

        EventManager::token_validation($token);

        if (isset($_FILES['imagen'])) {
            $image = $_FILES['imagen']['tmp_name'];
            $imgContenido = file_get_contents($image);
        }

        $nuevo_producto = new Product();
        $nuevo_producto->codigo = $_REQUEST['codigo'];
        $nuevo_producto->nombre = $_REQUEST['nombre'];
        $nuevo_producto->descripcion = $_REQUEST['descripcion'];
        $nuevo_producto->precio_unitario = $_REQUEST['precio_u'];
        $nuevo_producto->precio_proveedor = $_REQUEST['precio_p'];
        $nuevo_producto->imagen = $imgContenido;
        $nuevo_producto->id_categoria = $_REQUEST['categoria'];
        $nuevo_producto->nuevo();
        echo json_encode(array("message" => "Exito"));
        exit;
    }

    
}
