<?php
// 在 require 语句之前输出当前工作目录
// 尝试加载 PDOMysql.php
require_once('../PhpMysql/PDOMysql.php');
require_once('../../PhpSrc/interface/News_Edit.php');
// 其他代码...

class News_Revise implements News_Edit
{
    private mysqli $conn;
    private PDOMysql $database;

    public function __construct()
    {
        $this->database = new PDOMysql();
        $this->conn = $this->database->getConnection();
    }
    public function News_Delete($ID)
    {
        // TODO: Implement News_Delete() method.
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            $conn->begin_transaction();

            // 查询要删除的行的数据
            $query_select = "SELECT * FROM web_news WHERE News_ID = ? FOR UPDATE";
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
            $query_delete = "DELETE FROM web_news WHERE News_ID = ?";
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

    public function News_Edit($News_ID, $News_Title, $News_href, $News_massage)
    {
        $database = new PDOMysql();
        $conn = $database->getConnection();

        try {
            // 根据传递的参数构建动态的 UPDATE 语句
            $query_update = "UPDATE web_news SET News_Title = ?";

            // 如果 News_href 传递了值，将其包含在 UPDATE 语句中
            if (!empty($News_href)) {
                $query_update .= ", News_href = ?";
            }

            // 将 News_Massage 作为最后一个参数
            $query_update .= ", News_Massage = ? WHERE News_ID = ?";

            // 准备和绑定参数
            $stmt_update = $conn->prepare($query_update);

            // 构建参数数组
            $query_params = [$News_Title];

            // 如果 News_href 传递了值，将其添加到参数数组中
            if (!empty($News_href)) {
                $targetFile = 'News/' . basename($News_href["name"]);
                $query_params[] = $targetFile;
            }

            // 添加最后两个参数
            $query_params[] = $News_massage;
            $query_params[] = $News_ID;

            // 绑定参数
            $stmt_update->bind_param(str_repeat("s", count($query_params)), ...$query_params);

            if ($stmt_update->execute()) {
                // 更新成功
                return true;
            } else {
                // 更新失败
                return false;
            }
        } catch (PDOException $e) {
            // 捕获异常，处理错误
            return false;
        } finally {
            // 关闭连接
            $conn->close();
        }
    }
    public function News_getmassage($ID)
    {
        try {
            $query_select = "SELECT * FROM web_news WHERE News_ID = ?";
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