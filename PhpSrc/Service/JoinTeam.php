<?php
class JoinTeam
{
    public function isExist($Sno,$Match_ID){
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            $sql = "SELECT * FROM web_ranksuser
        JOIN web_ranks ON Ranks_Team = Ranks_ID
        JOIN web_user ON User_ID = userID
        JOIN web_match ON Ranks_Match = Match_ID 
        WHERE userSno = ? AND Ranks_Match = ?";
            $stmt = $conn->prepare($sql);

            // 绑定参数
            $stmt->bind_param('ii', $Sno, $Match_ID);

            // 执行查询
            $stmt->execute();

            // 获取结果
            $result = $stmt->get_result();
            $numRows = $result->num_rows;
            if ($numRows === 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return false;
        } finally {
            // 无论是否发生异常，都会执行
            if ($stmt) {
                $stmt->close();
            }
        }
    }
    public function CodeJoin($Sno,$Code)
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        $conn->begin_transaction();
        try {
            // 查询匹配信息
            $select = "SELECT * FROM web_ranks WHERE Ranks_Code = ?";
            $stmtSelect = $conn->prepare($select);
            $stmtSelect->bind_param('s', $Code);
            $stmtSelect->execute();
            $resultSelect = $stmtSelect->get_result();

            if ($resultSelect) {
                $row = $resultSelect->fetch_assoc();
                $MatchID=$row['Ranks_Match'];
                $Ranks_Team=$row['Ranks_ID'];
            } else {
                throw new Exception("查询失败: " . $stmtSelect->error);
            }
            // 检查是否存在
            if ($this->isExist($Sno, $MatchID)) {
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
                $Ranks_type=1;
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
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            // 处理异常
            echo $e->getMessage();
        }

// 关闭数据库连接
        $conn->close();

    }
    public function joinFlag($Code){
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        $selectLimit = "SELECT * FROM web_ranks WHERE Ranks_Code = ?";
        $stmtLimit = $conn->prepare($selectLimit);
        $stmtLimit->bind_param('s', $Code);
        $stmtLimit->execute();
        $resultLimit = $stmtLimit->get_result();

        if ($resultLimit) {
            $rowLimit = $resultLimit->fetch_assoc();
            $number = $rowLimit['Ranks_Limit'];

            // 查询符合条件的记录数量
            $selectCount = "SELECT COUNT(*) AS userCount FROM web_ranksuser JOIN web_ranks ON Ranks_ID = Ranks_Team WHERE Ranks_Code = ?";
            $stmtCount = $conn->prepare($selectCount);
            $stmtCount->bind_param('s', $Code);
            $stmtCount->execute();
            $resultCount = $stmtCount->get_result();

            if ($resultCount) {
                $rowCount = $resultCount->fetch_assoc();
                $count = $rowCount['userCount'];

                // 比较 number 和 count
                $resultComparison = $number > $count;
                // 输出结果
                if ($resultComparison) {
                    return true;// number 大于 count

                } else {
                   return  false;
                }
            } else {
                throw new Exception("查询失败: " . $stmtCount->error);
            }
        } else {
            throw new Exception("查询失败: " . $stmtLimit->error);
        }
// 关闭数据库连接
        $conn->close();
    }

}