<?php

class ImagesModel extends Database
{
    public function getImagesByProduct($productId)
    {
        $qr = "SELECT image_url FROM product_images WHERE product_id = $productId";
        $result = mysqli_query($this->con, $qr);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
