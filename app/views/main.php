<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="stylesheet" href="./public/styles/main.css">
</head>

<body>
    <div class="header">
        <?php require_once "./app/views/layout/header.php" ?>
    </div>
    <div class="body">
        <?php require_once "./app/views/pages/" . $data["Page"] . ".php" ?>
    </div>
    <div class="footer">
        <?php require_once "./app/views/layout/footer.php" ?>
    </div>
</body>

</html>