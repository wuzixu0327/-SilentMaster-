<?php

require_once('../PhpMysql/PDOMysql.php');
require_once('../../PhpSrc/interface/Match_Edit.php');

class Match_Revise implements Match_Edit
{
    private mysqli $conn;
    private PDOMysql $database;

    public function __construct()
    {
        $this->database = new PDOMysql();
        $this->conn = $this->database->getConnection();
    }
    public function Match_Delete($ID)
    {
        $database = new PDOMysql();
        $conn = $database->getConnection();
        // TODO: Implement News_Delete() method.

        try {
            $query_select = "SELECT * FROM web_match WHERE Match_ID = ? FOR UPDATE";
            $stmt_select = $conn->prepare($query_select);
            $stmt_select->bind_param("i", $ID);
            $stmt_select->execute();
            $result_select = $stmt_select->get_result();

            // 获取要删除的行的数据
            $deleted_rows = [];
            while ($row = $result_select->fetch_assoc()) {
                $deleted_rows[] = $row;
            }

            // 执行删除操作
            $query_delete = "DELETE FROM web_match WHERE Match_ID = ?";
            $stmt_delete = $conn->prepare($query_delete);
            $stmt_delete->bind_param("i", $ID);
            $stmt_delete->execute();

            // 提交事务
            if ($conn->commit()) {
                // 处理被删除的行数据
                $conn->close();
                return true;
            } else {
                // 事务提交失败，执行回滚
                $conn->rollback();
                $conn->close();
                return false;
            }
        } catch (PDOException $e) {
            // 捕获异常，执行回滚
            $conn->rollback();
            $conn->close();
            return false;
        }

    }

    public function Match_Edit($Match_ID, $Match_Name, $Match_Organ, $Match_StartTime, $Match_EndTime, $Match_Annex, $Match_Type, $Match_NumberLimit, $Match_Massage)
    {
        $database = new PDOMysql();
        $conn = $database->getConnection();


        try {
            // 检查连接是否成功
            if ($conn->connect_error) {
                throw new Exception('Failed to connect to the database: ' . $conn->connect_error);
            }

            // 开启事务
            $conn->autocommit(false);

            // 对目标行进行上锁并执行动态的 UPDATE 语句
            $stmt = $conn->prepare("SELECT * FROM web_match WHERE Match_ID = ? FOR UPDATE");
            $stmt->bind_param('i', $Match_ID);
            $stmt->execute();
            $stmt->close();

            // 判断 $Match_Annex 是否为空
            $annexValue = empty($Match_Annex) ? '' : 'Match_Annex = ?, ';

            // 注意 SET 子句中末尾的逗号
            $updateStmt = $conn->prepare("UPDATE web_match SET Match_Name = ?, Match_Organ = ?, Match_StartTime = ?, Match_EndTime = ?, $annexValue Match_Type = ?, Match_NumberLimit = ?, Match_Massage = ? WHERE Match_ID = ?");

            // 绑定参数，确保与占位符的顺序和类型一致
            if (!empty($Match_Annex)) {
                $updateStmt->bind_param('sssssiisi', $Match_Name, $Match_Organ, $Match_StartTime, $Match_EndTime, $Match_Annex, $Match_Type, $Match_NumberLimit, $Match_Massage, $Match_ID);
            } else {
                $updateStmt->bind_param('ssssiisi', $Match_Name, $Match_Organ, $Match_StartTime, $Match_EndTime, $Match_Type, $Match_NumberLimit, $Match_Massage, $Match_ID);
            }

            $updateStmt->execute();

            // 提交事务
            $conn->commit();
            return true;
        } catch (Exception $e) {
            // 回滚事务
            $conn->rollback();
            // 输出错误信息
            echo 'Error: ' . $e->getMessage();
            return false;
        } finally {
            // 关闭连接
            $conn->close();
        }
    }
    public function DeleteFlag($ID): bool
    {
        $database = new PDOMysql();
        $conn = $database->getConnection();

        try {
            $SQL = "SELECT COUNT(*)  FROM web_ranks WHERE web_ranks.Ranks_Match = ?";
            $stmt = $conn->prepare($SQL);
            $stmt->bind_param('s', $ID);
            $stmt->execute();
            $resultTotal = $stmt->get_result();
            // 根据业务逻辑决定返回结果
            if ($resultTotal->num_rows > 0) {
                $row1 = $resultTotal->fetch_assoc(); // 获取一行数据
                $countValue = $row1['COUNT(*)']; // 获取COUNT(*)的值
            }
            if($countValue>0)
            {
                return false;
            }else return true;
        } catch (PDOException $e) {
            // 记录异常信息，便于排查问题
            error_log("DeleteFlag Exception: " . $e->getMessage());
            return false;
        }
    }

}