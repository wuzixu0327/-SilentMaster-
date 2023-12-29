<?php

class retrieveTest
{
    public function retrieve($userSno, $userPassword){
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            // 步骤 1: 查询用户是否存在
            $checkUserQuery = "SELECT userID FROM web_user WHERE userSno = ?";
            $stmtCheck = $conn->prepare($checkUserQuery);
            $stmtCheck->bind_param('s', $userSno);
            $stmtCheck->execute();
            $stmtCheck->store_result();

            if ($stmtCheck->num_rows > 0) {
                // 用户存在，获取 userID
                $stmtCheck->bind_result($userID);
                $stmtCheck->fetch();
                // 步骤 2: 利用 userID 更新用户密码
                $updatePasswordQuery = "UPDATE web_user SET userPassword = ? WHERE userID = ?";
                $stmtUpdate = $conn->prepare($updatePasswordQuery);
                $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);
                $stmtUpdate->bind_param('si', $hashedPassword, $userID);
                $stmtUpdate->execute();
                return true; // 密码更新成功
            } else {
                return false; // 用户不存在
            }
        }catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0;
        }
    }
    public function selectUserEmail($userSno)
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();

        try {
            // 步骤 1: 查询用户是否存在
            $checkUserQuery = "SELECT userEmail FROM web_user WHERE userSno = ?";
            $stmtCheck = $conn->prepare($checkUserQuery);
            $stmtCheck->bind_param('s', $userSno);
            $stmtCheck->execute();

            // 步骤 2: 绑定结果
            $stmtCheck->bind_result($userEmail);

            // 步骤 3: 抓取结果
            $stmtCheck->fetch();

            // 步骤 4: 判断用户是否存在
            if (!empty($userEmail)) {
                // 在这里执行你需要的逻辑，比如返回邮箱
                return $userEmail;
            } else {
                return false; // 用户不存在
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return 0;
        } finally {
            // 无论如何都要关闭数据库连接
            $conn->close();
        }
    }

}