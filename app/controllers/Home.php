<?php
class Home extends Controller
{
    function demo()
    {
        //View
        $this->view("main", [
            "Number" => 5,
            "Page" => "writes",
            "SoThich" => ["A", "B", "C"],
        ]);
    }

    function getProducts($params)
    {
        //Model (gọi model và hàm trong model đó, nhớ gắn vào var)
        $products = $this->model("ProductsModel");

        //View
        $this->view("main", [
            "Number" => 5,
            "Page" => $params,
            "SoThich" => ["A", "B", "C"],
            "Products" => $products->getProducts()
        ]);
    }
}
