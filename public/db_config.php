<?php
$host = getenv('DB_HOST');
$db   = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');
$port = getenv('DB_PORT');

// Aiven yêu cầu SSL, thêm cấu hình này vào PDO
$options = [
    PDO::MYSQL_ATTR_SSL_CA => true, 
];

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass, $options);
} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
}