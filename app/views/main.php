<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <base href="http://localhost:8080/Scholar/">
    <link rel="stylesheet" href="public/styles/main.css">
</head>

<body>
    <div id="header">
        <?php require_once "./app/views/blocks/header.php" ?>
    </div>

    <div id="body">
        <?php require_once "./app/views/pages/" . $data["Page"] . ".php" ?>
    </div>

    <div id="footer">
        <?php require_once "./app/views/blocks/footer.php" ?>
    </div>

    <script>
        const currentPage = "<?php echo $data['Page']; ?>";
    </script>
    <script src="./public/script/main.js" type="module"></script>

    <?php
    unset($_SESSION['buy_now_item']);
    unset($_SESSION['selected_items']);
    ?>
</body>

</html>