<?php

class Copy_Code
{
public function CopyCode($ID){
    global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
    require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
    require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
    $database = new PDOMysql();
    $conn = $database->getConnection();
    try {
        $Code= "SELECT * FROM web_ranksuser join web_ranks on Ranks_Team = Ranks_ID WHERE Ranks_User_ID = $ID";
        $result = $conn->query($Code);

        if ($result) {
            $row = $result->fetch_assoc();
            $Code = $row['Ranks_Code'];
            echo $Code;
        } else {
            throw new Exception("查询失败: " . $conn->error);
        }
    }catch (PDOException $e)
    {
        echo "数据库操作失败: " . $e->getMessage();
    }
}
}