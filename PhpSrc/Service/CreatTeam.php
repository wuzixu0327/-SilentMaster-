<?php

class CreatTeam
{
    public function Creat_Team($Usno,$MatchID,$Ranks_Name,$Team_Code,$Ranks_Type)
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        $conn->begin_transaction();

        try {
            // 查询匹配信息
            $selectLimit = "SELECT * FROM web_match WHERE Match_ID = $MatchID";
            $result = $conn->query($selectLimit);

            if ($result) {
                $row = $result->fetch_assoc();
                $Limit = $row['Match_NumberLimit'];
            } else {
                throw new Exception("查询失败: " . $conn->error);
            }

            // 构建查询语句获取最大ID
            $maxIDQuery = "SELECT MAX(Ranks_ID) AS MaxID FROM web_ranks";
            $result = $conn->query($maxIDQuery);

            if ($result) {
                $row = $result->fetch_assoc();
                $maxID = $row['MaxID'] + 1;
            } else {
                throw new Exception("查询失败: " . $conn->error);
            }

            // 构建插入语句
            $AddranksSQL = "INSERT INTO web_ranks (Ranks_ID, Ranks_Match, Ranks_Name, Ranks_Limit, Ranks_Code) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($AddranksSQL);

            // 参数绑定
            $stmt->bind_param('issis', $maxID, $MatchID, $Ranks_Name, $Limit, $Team_Code);
            $RanksUser=$this->CreatRank_User($Usno,$Ranks_Type,$maxID);
            // 执行插入
            if ($stmt->execute()) {
                // 提交事务
                $conn->commit();

            } else {
                // 回滚事务
                $conn->rollback();
                throw new Exception("插入失败: " . $stmt->error);
            }

            // 关闭预处理语句
            $stmt->close();
        } catch (Exception $e) {
            // 处理异常
            echo $e->getMessage();
        }

// 关闭数据库连接
        $conn->close();


    }
    public static function  CreatRank_User($Sno,$Ranks_type,$Ranks_Team){
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        $conn->begin_transaction();

        try {
            // 查询匹配信息
            $selectLimit = "SELECT * FROM web_user WHERE userSno = $Sno";
            $result = $conn->query($selectLimit);

            if ($result) {
                $row = $result->fetch_assoc();
                $UserID = $row['userID'];
            } else {
                throw new Exception("查询失败: " . $conn->error);
            }

            // 构建查询语句获取最大ID
            $maxIDQuery = "SELECT MAX(Ranks_User_ID) AS MaxID FROM web_ranksuser";
            $result = $conn->query($maxIDQuery);

            if ($result) {
                $row = $result->fetch_assoc();
                $maxID = $row['MaxID'] + 1;
            } else {
                throw new Exception("查询失败: " . $conn->error);
            }
            $JoinTime= date("Y-m-d H:i:s");
            // 构建插入语句
            $AddranksSQL = "INSERT INTO web_ranksuser (Ranks_User_ID, Ranks_Team, Ranks_Type,User_ID,Ranks_JoinTime) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($AddranksSQL);

            // 参数绑定
            $stmt->bind_param('issis', $maxID, $Ranks_Team,$Ranks_type, $UserID, $JoinTime);

            // 执行插入
            if ($stmt->execute()) {
                // 提交事务
                $conn->commit();
            } else {
                // 回滚事务
                $conn->rollback();
                throw new Exception("插入失败: " . $stmt->error);
            }
            // 关闭预处理语句
            $stmt->close();
        } catch (Exception $e) {
            // 处理异常
            echo $e->getMessage();
        }

        $conn->close();

    }
}