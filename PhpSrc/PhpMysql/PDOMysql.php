<?php
require_once('MysqlMassage.php');

class PDOMysql {
    private $conn;
    private $servername;
    private $username;
    private $password;
    private $dbname;

    public function __construct() {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;

        $this->servername = $Mysqlservername;
        $this->username = $Mysqlusername;
        $this->password = $Mysqlpassword;
        $this->dbname = $Mysqldbname;

        // 建立数据库连接
        $this->conn = new mysqli("localhost", "root", "root", "suser_web");

        // 检查连接是否成功
        if ($this->conn->connect_error) {
            die("连接数据库失败: " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8mb4");
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
