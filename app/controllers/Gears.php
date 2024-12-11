<?php
class Gears extends Controller
{
    function default()
    {
        //Model
        $products = $this->model("ProductsModel");

        //View
        $this->view("main", [
            "Page" => "gears",
            "Products" => $products->getProducts()
        ]);
    }

    function getProducts($params)
    {
        //Model
        $products = $this->model("ProductsModel");

        //View
        $this->view("main", [
            "Page" => $params,
            "Products" => $products->getProducts()
        ]);
    }
}
