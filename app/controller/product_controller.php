<?php


class ProductController
{
    private $views_path = "app/views/product/";
    
    public function get_form_new()
    {
        require_once $this->views_path."new_product.php";
    }

    public function post_save_product(){
        $dat = ["message"=>$_REQUEST['codigo']];
        header("Content-Type: application/json");
        echo json_encode($dat);
        
    }
}
