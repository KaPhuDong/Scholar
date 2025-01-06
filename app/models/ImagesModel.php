<?php

class ImagesModel extends Database
{
    public function getImagesByProduct($productId)
    {
        $qr = "SELECT image_url FROM product_images WHERE product_id = ?";
        $stmt = $this->con->prepare($qr);
        $stmt->bind_param("i", $productId);
        $stmt->execute();

        $result = $stmt->get_result();
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    function addProductImage($product_id, $image_url)
    {
        $qr = "INSERT INTO product_images (product_id, image_url)
               VALUES ($product_id, '$image_url')";

        return mysqli_query($this->con, $qr);
    }
}
