<?php
require_once('../PhpMysql/PDOMysql.php');
require_once('../../PhpSrc/interface/Notice_Edit.php');
class Notice_Revise implements Notice_Edit
{
    private mysqli $conn;
    private PDOMysql $database;

    public function __construct()
    {
        $this->database = new PDOMysql();
        $this->conn = $this->database->getConnection();
    }
    public function Notice_Delete($ID)
    {
        $database = new PDOMysql();
        $conn = $database->getConnection();
        // TODO: Implement News_Delete() method.

        try {

            $query_select = "SELECT * FROM web_notice WHERE Notice_ID = ? FOR UPDATE";
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
            $query_delete = "DELETE FROM web_notice WHERE Notice_ID = ?";
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
    public function Notice_Edit($Notice_ID, $Notice_Title, $Notice_massage)
    {
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            // 开启事务
            $conn->begin_transaction();
            // 对目标行进行上锁并执行动态的UPDATE语句
            $stmt = $conn->prepare("SELECT * FROM web_notice WHERE Notice_ID = ? FOR UPDATE");
            $stmt->bind_param('i', $Notice_ID);  // 假设 Notice_ID 是整数，请根据实际情况调整类型
            $stmt->execute();
            $stmt->close();
            $updateStmt = $conn->prepare("UPDATE web_notice SET Notice_Title = ?, Notice_Massage = ? WHERE Notice_ID = ?");
            $updateStmt->bind_param('ssi', $Notice_Title, $Notice_massage, $Notice_ID);
            $updateStmt->execute();

            // 提交事务
            $conn->commit();
            return true;
        } catch (PDOException $e) {
            // 回滚事务
            $conn->rollback();
            // 捕获异常，处理错误
            return false;
        } finally {
            // 关闭连接
            $conn->close();
        }
    }

    public function Notice_getmassage($ID)
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "G:\web\suse_web\PhpSrc\PhpMysql\PDOMysql.php";
        require_once "G:\web\suse_web\PhpSrc\PhpMysql\MysqlMassage.php";
        $servername = $Mysqlservername;
        $username = $Mysqlusername;
        $password = $Mysqlpassword;
        $dbname = $Mysqldbname;
        $database = new PDOMysql($servername, $username, $password, $dbname);
        $conn = $database->getConnection();
        try {
            $query_select = "SELECT * FROM web_notice WHERE Notice_ID = ?";
            $stmt_select = $this->conn->prepare($query_select);
            $stmt_select->bind_param("i", $ID);
            $stmt_select->execute();

            // 获取查询结果集
            $result = $stmt_select->get_result();

            // 获取结果集的第一行
            $row = $result->fetch_assoc();

            // 获取特定的值
            $TitleValue = $row['News_Title'] ?? null;
            $MassageValue = $row['News_Massage'] ?? null;
            $hrefValue = $row['News_href'] ?? null;

            // 将特定的值放入数组中
            $values = [
                'Title' => $TitleValue,
                'Massage' => $MassageValue,
                'href' => $hrefValue,
            ];

            // 返回包含多个值的数组
            return $values;
        } catch (PDOException $e) {
        }
    }
}