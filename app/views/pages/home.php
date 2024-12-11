<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
</head>

<body>
    <h1>Trang chủ</h1>
    <?php
    while ($row = mysqli_fetch_array($data["Products"])) {
        echo $row["name"];
    }
    ?>
</body>

</html>