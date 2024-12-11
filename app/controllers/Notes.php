<?php
class Notes extends Controller
{
    function default()
    {
        //Model
        $products = $this->model("ProductsModel");

        //View
        $this->view("main", [
            "Page" => "notes",
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
