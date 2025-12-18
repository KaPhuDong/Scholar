<?php
class Database
{
    public $con;
    // Đổi từ giá trị cứng sang getenv() để nhận thông tin từ Aiven
    protected $servername = "";
    protected $username = "";
    protected $password = "";
    protected $dbname = "";
    protected $port = "";

    function __construct()
    {
        $this->servername = getenv('DB_HOST');
        $this->username = getenv('DB_USERNAME');
        $this->password = getenv('DB_PASSWORD');
        $this->dbname = getenv('DB_DATABASE');
        $this->port = getenv('DB_PORT');

        // Kết nối đến Aiven cần có port và nên sử dụng mysqli_connect với port
        $this->con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname, $this->port);
        
        if (!$this->con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        mysqli_set_charset($this->con, "utf8");
    }
}