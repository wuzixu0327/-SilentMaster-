<?php

class adminloginTest
{
    public function loginTest($Sno, $password)
    {
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try{
            $sql = "SELECT * FROM web_admin WHERE AdminSno = ?";
            $stmt = $conn->prepare($sql);

            // 参数绑定
            $stmt->bind_param('s', $Sno);
            $stmt->execute();

            // 获取结果集
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user) {
                // 检查哈希加密密码是否匹配
                if ($password == $user['AdminPassword']) {
                    // 密码匹配，可以进行登录操作
                    // ...
                    return true;
                } else {
                    // 密码不匹配
                    // ...
                    return false;
                }
            } else {
                // 用户不存在
                // ...
                return false;

            }
        }catch (PDOException $e)
        {
            return false;
        }
    }

}