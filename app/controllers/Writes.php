<?php
class Writes extends Controller
{
    function default()
    {
        //Model
        $products = $this->model("ProductsModel");

        //View
        $this->view("main", [
            "Page" => "writes",
            "Products" => $products->getProducts()
        ]);
    }
}
