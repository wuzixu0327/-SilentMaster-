<?php

namespace Show_News;

use PDOException;
use PDOMysql;

class register
{
    public function register($username,$userSno,$userEmail,$userPassword){
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            $maxIdQuery = "SELECT MAX(userID) as maxId FROM web_user";
            $result = $conn->query($maxIdQuery);

            // 获取最大值并加 1
            $maxId = $result->fetch_assoc()['maxId'] + 1;
            $sql = "INSERT INTO web_user (userID,username, userSno, userEmail, userPassword,userFlag) 
            VALUES (?, ?, ?, ?,?,?)";
            $flag = '1';
            // 使用预处理语句，防止 SQL 注入攻击
            $stmt = $conn->prepare($sql);
            // 绑定参数
            $stmt->bind_param("issssi",$maxId, $username,$userSno, $userEmail, $userPassword,$flag);
            $stmt->execute();
            return $maxId;
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0;
        }
    }
    public function Test($userSno,$useremail) {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            $maxIdQuery = "SELECT count(userID) as userCount FROM web_user where userSno = ? or userEmail = ?";
            $stmt = $conn->prepare($maxIdQuery);
            $stmt->bind_param('ss', $userSno,$useremail);
            $stmt->execute();
            $stmt->store_result(); // 存储结果以获取行数
            $rowCount = $stmt->num_rows;
            if ($rowCount > 0) {
                $stmt->bind_result($userCount); // 绑定结果变量
                $stmt->fetch(); // 获取结果

                // 判断 userCount 是否为 0
                if ($userCount == 0) {
                    // userCount 为 0，执行相应的逻辑
                    return true;
                } else {
                    // userCount 不为 0，执行相应的逻辑
                    return false;
                }
            } else {
                // 查询结果为空
                return true;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn->close();
    }

}