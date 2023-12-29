<?php

class Team_Code
{
    function generateUniqueInvitationCode(): string
    {
        $length = 16;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';

        do {
            // 生成邀请码
            for ($i = 0; $i < $length; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }

            // 检查邀请码是否唯一
            $isUnique = $this->checkIfCodeIsUnique($code);
        } while (!$isUnique);
        return $code;
    }

    function checkIfCodeIsUnique($code): bool
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        // 在数据库中检查邀请码是否已存在
        $sql = "SELECT COUNT(*) as count FROM web_ranks WHERE Ranks_Code = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];
        // 如果邀请码不存在，返回true；否则返回false
        return ($count == 0);
    }
}