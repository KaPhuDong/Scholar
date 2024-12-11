<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <style>
        .header,
        .footer {
            height: 30px;
            background-color: red;
        }
    </style>
</head>

<body>
    <div class="header"></div>
    <div class="body">
        <?php require_once "./app/views/pages/" . $data["Page"] . ".php" ?>
    </div>
    <div class="footer"></div>
</body>

</html>