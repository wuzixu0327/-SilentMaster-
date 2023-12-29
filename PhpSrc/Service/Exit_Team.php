<?php

class Exit_Team
{
    public function DestoryFlag($ID){
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            $selectLimit = "SELECT * FROM web_ranksuser WHERE Ranks_User_ID = $ID";
            $result = $conn->query($selectLimit);

            if (!$result) {
                throw new Exception("查询失败: " . $conn->error);
            }

            $row = $result->fetch_assoc();
            return (bool) ($row['Ranks_Type'] == 1);
        } catch (PDOException $e) {
            // 处理异常，如果需要的话
            // 这里可以添加适当的异常处理逻辑
            // 如果不需要处理异常，可以不做任何操作
            echo $e->getMessage();
        }

// 如果查询失败或发生异常，到这里返回 false
        return false;
    }
    public function Team_Member($ID){
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            // 开始事务
            $conn->begin_transaction();

            // 使用预处理语句
            $stmt = $conn->prepare("DELETE FROM web_ranksuser WHERE Ranks_User_ID = ?");
            $stmt->bind_param("i", $ID); // "i" 表示整数类型，绑定参数

            // 执行预处理语句
            $stmt->execute();

            // 检查删除是否成功
            if ($stmt->affected_rows < 1) {
                throw new Exception("删除失败，可能找不到匹配的记录.");
            }

            // 提交事务
            $conn->commit();
        } catch (PDOException $e) {
            // 如果发生异常，回滚事务
            $conn->rollBack();
            // 处理异常，如果需要的话
            // 这里可以添加适当的异常处理逻辑
            // 如果不需要处理异常，可以不做任何操作
            echo $e->getMessage();
        } finally {
            // 释放预处理语句
            if (isset($stmt)) {
                $stmt->close();
            }
        }
    }
    public function Team_Leader($ID){
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            $Destroy = "SELECT * FROM web_ranksuser WHERE Ranks_User_ID = $ID";
            $result = $conn->query($Destroy);

            if ($result) {
                $row = $result->fetch_assoc();
                $Team = $row['Ranks_Team'];
            } else {
                throw new Exception("查询失败: " . $conn->error);
            }

            // 开始事务
            $conn->begin_transaction();

            // 删除第一个表
            $stmt1 = $conn->prepare("DELETE FROM web_ranksuser WHERE Ranks_Team = ?");
            $stmt1->bind_param("i", $Team);
            $stmt1->execute();

            // 检查删除是否成功
            if ($stmt1->affected_rows < 1) {
                throw new Exception("删除失败，可能找不到匹配的记录.");
            }

            // 删除第二个表
            $stmt2 = $conn->prepare("DELETE FROM web_ranks WHERE Ranks_ID = ?");
            $stmt2->bind_param("i", $Team);
            $stmt2->execute();

            // 检查删除是否成功
            if ($stmt2->affected_rows < 1) {
                throw new Exception("删除失败，可能找不到匹配的记录.");
            }

            // 提交事务
            $conn->commit();

        } catch (PDOException $e) {
            // 如果发生异常，回滚事务
            $conn->rollBack();
            // 处理异常，如果需要的话
            // 这里可以添加适当的异常处理逻辑
            // 如果不需要处理异常，可以不做任何操作
            echo $e->getMessage();
        } finally {
            // 释放预处理语句
            if (isset($stmt1)) {
                $stmt1->close();
            }
            if (isset($stmt2)) {
                $stmt2->close();
            }
        }
    }
}