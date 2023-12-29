<?php

namespace Show_News;

use PDOException;
use PDOMysql;

class Match_infor
{
    public function selectMatch()
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $servername = $Mysqlservername;
        $username = $Mysqlusername;
        $password = $Mysqlpassword;
        $dbname = $Mysqldbname;
        $database = new PDOMysql($servername, $username, $password, $dbname);
        $conn = $database->getConnection();
        try {
            $sql = "SELECT * FROM suser_web.web_match";
            $resultData = $conn->query($sql);
            while ($row = $resultData->fetch_assoc()) {
                echo '<option value="';
                echo $row['Match_ID'];
                echo '">';
                echo $row['Match_Name'];
                echo '</option>';
//                <option value="1"> 国信安网页设计大赛</option>
            }
        } catch (PDOException $e) {
            echo '数据库连接失败';
        }
        // TODO: Implement selectMatch() method.
    }

    public function MatchMassage($Page)
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $servername = $Mysqlservername;
        $username = $Mysqlusername;
        $password = $Mysqlpassword;
        $dbname = $Mysqldbname;
        $database = new PDOMysql($servername, $username, $password, $dbname);
        $conn = $database->getConnection();
        try {
            $Limit = 15;
            $SQL = "SELECT COUNT(*) as total FROM web_ranks ";
            $resultTotal = $conn->query($SQL);
            $rowTotal = $resultTotal->fetch_assoc();
            $total_records = $rowTotal['total'];
            $start_index = ($Page - 1) * $Limit;
            $sql = "SELECT * FROM suser_web.web_ranks LIMIT $start_index, $Limit";
            $resultData = $conn->query($sql);
            while ($row = $resultData->fetch_assoc()) {
                echo '<tr> <td align="center"><input type="checkbox" name="checkbox[]" value="';
                echo $row['Ranks_ID'];
                echo '"></td><td align="center">';
                echo $row['Ranks_ID'];
                echo '</td><td><a>';
                echo $row['Ranks_Name'];
                echo '</a></td><td align="center"><a>';
                $ID = $row['Ranks_Match'];
                $Name = "SELECT * FROM suser_web.web_match where Match_ID = $ID";
                $resultDataName = $conn->query($Name);
                if ($resultDataName) {
                    $matchData = $resultDataName->fetch_assoc();
                    $Match_Name = $matchData['Match_Name'];
                    $Match_Type = $matchData['Match_Type'];
                }
                echo $Match_Name;
                echo '</a></td> <td align="center">';
                if ($Match_Type == 0) {
                    echo '个人赛';
                } else echo '团体赛';
                echo '</td><td align="center">';
                echo $row['Ranks_Limit'];
                echo '</td><td align="center">';
                echo '<a href="RankDelete.php?id=';
                echo $row['Ranks_ID'];
                echo '">删除</a>';
            }
        } catch (PDOException $e) {
            echo '数据库连接失败';
        }
        // TODO: Implement selectMatch() method.
    }

    public function Page()
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $servername = $Mysqlservername;
        $username = $Mysqlusername;
        $password = $Mysqlpassword;
        $dbname = $Mysqldbname;
        $database = new PDOMysql($servername, $username, $password, $dbname);
        $conn = $database->getConnection();
        try {
            $SQL = "SELECT COUNT(*) as total FROM web_ranks";
            $resultTotal = $conn->query($SQL);
            $rowTotal = $resultTotal->fetch_assoc();
            $total_records = $rowTotal['total'];
            return $total_records;

        } catch (PDOException $e) {
            echo '获取数据失败请联系管理员';
        }
    }

    public function Selectinfo_keyword($Name, $Page,$ID)
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";

        $servername = $Mysqlservername;
        $username = $Mysqlusername;
        $password = $Mysqlpassword;
        $dbname = $Mysqldbname;

        $database = new PDOMysql($servername, $username, $password, $dbname);
        $conn = $database->getConnection();
        try {
            $Limit = 15;

            // 使用预处理语句
            $stmt = $conn->prepare("SELECT * FROM suser_web.web_ranks WHERE Ranks_Name LIKE ? and Ranks_Match=$ID LIMIT ?, ?");

            // 设置起始索引
            $start_index = ($Page - 1) * $Limit;

            // 绑定参数
            $NameParam = "%" . $Name . "%";
            $stmt->bind_param('sii', $NameParam, $start_index, $Limit);

            // 执行查询
            $stmt->execute();

            // 获取结果
            $resultData = $stmt->get_result();

            // 检查是否有结果
            if ($resultData) {
                while ($row = $resultData->fetch_assoc()) {
                    // 处理每一行的数据
                    echo '<tr> <td align="center"><input type="checkbox" name="checkbox[]" value="';
                    echo $row['Ranks_ID'];
                    echo '"></td><td align="center">';
                    echo $row['Ranks_ID'];
                    echo '</td><td><a>';
                    echo $row['Ranks_Name'];
                    echo '</a></td><td align="center"><a>';
                    $ID = $row['Ranks_Match'];
                    $Name = "SELECT * FROM suser_web.web_match where Match_ID = $ID";
                    $resultDataName = $conn->query($Name);
                    if ($resultDataName) {
                        $matchData = $resultDataName->fetch_assoc();
                        $Match_Name = $matchData['Match_Name'];
                        $Match_Type = $matchData['Match_Type'];
                    }
                    echo $Match_Name;
                    echo '</a></td> <td align="center">';
                    if ($Match_Type == 0) {
                        echo '个人赛';
                    } else echo '团体赛';
                    echo '</td><td align="center">';
                    echo $row['Ranks_Limit'];
                    echo '</td><td align="center">';
                    echo '<a href="RankDelete.php?id=';
                    echo $row['Ranks_ID'];
                    echo '">删除</a>';
                }
            } else {
                echo "查询失败：" . $conn->error;
            }

            // 关闭语句和连接
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            echo '发生异常：' . $e->getMessage();
        }

    }

    public function Selectinfo_Nokeyword($Name, $Page)
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";

        $servername = $Mysqlservername;
        $username = $Mysqlusername;
        $password = $Mysqlpassword;
        $dbname = $Mysqldbname;

        $database = new PDOMysql($servername, $username, $password, $dbname);
        $conn = $database->getConnection();
        try {
            $Limit = 15;

            // 使用预处理语句
            $stmt = $conn->prepare("SELECT * FROM suser_web.web_ranks WHERE web_ranks.Ranks_Match = ? LIMIT ?, ?");

            // 设置起始索引
            $start_index = ($Page - 1) * $Limit;

            // 绑定参数
            $stmt->bind_param('sii', $Name, $start_index, $Limit);

            // 执行查询
            $stmt->execute();

            // 获取结果
            $resultData = $stmt->get_result();

            // 检查是否有结果
            if ($resultData) {
                while ($row = $resultData->fetch_assoc()) {
                    // 处理每一行的数据
                    echo '<tr> <td align="center"><input type="checkbox" name="checkbox[]" value="';
                    echo $row['Ranks_ID'];
                    echo '"></td><td align="center">';
                    echo $row['Ranks_ID'];
                    echo '</td><td><a>';
                    echo $row['Ranks_Name'];
                    echo '</a></td><td align="center"><a>';
                    $ID = $row['Ranks_Match'];
                    $Name = "SELECT * FROM suser_web.web_match where Match_ID = $ID";
                    $resultDataName = $conn->query($Name);
                    if ($resultDataName) {
                        $matchData = $resultDataName->fetch_assoc();
                        $Match_Name = $matchData['Match_Name'];
                        $Match_Type = $matchData['Match_Type'];
                    }
                    echo $Match_Name;
                    echo '</a></td> <td align="center">';
                    if ($Match_Type == 0) {
                        echo '个人赛';
                    } else echo '团体赛';
                    echo '</td><td align="center">';
                    echo $row['Ranks_Limit'];
                    echo '</td><td align="center">';
                    echo '<a href="RankDelete.php?id=';
                    echo $row['Ranks_ID'];
                    echo '">删除</a>';
                }
            } else {
                echo "查询失败：" . $conn->error;
            }

            // 关闭语句和连接
            $stmt->close();
            $conn->close();
        } catch (Exception $e) {
            echo '发生异常：' . $e->getMessage();
        }

    }

    public function Page_keyword($Name)
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";

        $servername = $Mysqlservername;
        $username = $Mysqlusername;
        $password = $Mysqlpassword;
        $dbname = $Mysqldbname;

        $database = new PDOMysql($servername, $username, $password, $dbname);
        $conn = $database->getConnection();

        try {
            // 使用预处理语句
            $SQL = "SELECT COUNT(*) as total FROM web_ranks WHERE Ranks_Name LIKE ?";
            $stmt = $conn->prepare($SQL);

            // 提供模糊匹配的模式
            $searchPattern = '%' . $Name . '%';

            // 绑定参数
            $stmt->bind_param('s', $searchPattern);

            // 执行查询
            $stmt->execute();

            // 获取结果
            $resultTotal = $stmt->get_result();
            $rowTotal = $resultTotal->fetch_assoc();
            $total_records = $rowTotal['total'];
            return $total_records;
        } catch (PDOException $e) {
            echo '获取数据失败请联系管理员';
        } finally {
            // 最终始终确保关闭数据库连接
            $conn->close();
        }
    }

    public function Page_Nokeyword($ID)
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";

        $servername = $Mysqlservername;
        $username = $Mysqlusername;
        $password = $Mysqlpassword;
        $dbname = $Mysqldbname;

        $database = new PDOMysql($servername, $username, $password, $dbname);
        $conn = $database->getConnection();

        try {
            // 使用预处理语句
            $SQL = "SELECT COUNT(*) as total FROM web_ranks WHERE web_ranks.Ranks_Match = ?";
            $stmt = $conn->prepare($SQL);

            // 提供模糊匹配的模式

            // 绑定参数
            $stmt->bind_param('s', $ID);

            // 执行查询
            $stmt->execute();

            // 获取结果
            $resultTotal = $stmt->get_result();
            $rowTotal = $resultTotal->fetch_assoc();
            $total_records = $rowTotal['total'];
            return $total_records;
        } catch (PDOException $e) {
            echo '获取数据失败请联系管理员';
        } finally {
            // 最终始终确保关闭数据库连接
            $conn->close();
        }
    }

    public function Delete($ID)
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";

        $servername = $Mysqlservername;
        $username = $Mysqlusername;
        $password = $Mysqlpassword;
        $dbname = $Mysqldbname;

        $database = new PDOMysql($servername, $username, $password, $dbname);
        $conn = $database->getConnection();

        try {
            // 使用预处理语句
            $conn->begin_transaction();

            // 使用预处理语句
            $SQL = "DELETE FROM web_ranks WHERE Ranks_ID = ?";

            // 获取数据库锁
            $conn->query("SELECT * FROM web_ranks WHERE Ranks_ID = ? FOR UPDATE");

            $stmt = $conn->prepare($SQL);

            // 绑定参数
            $stmt->bind_param('i', $ID);

            // 执行删除操作
            $stmt->execute();

            // 提交事务
            $conn->commit();
            return true;
        } catch (PDOException $e) {
            // 发生错误时回滚事务
            $conn->rollback();
            echo '删除失败，请联系管理员';
        } finally {
            // 最终始终确保关闭数据库连接
            $conn->close();
        }

    }
    public function DeleteFlag($ID)
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";

        $servername = $Mysqlservername;
        $username = $Mysqlusername;
        $password = $Mysqlpassword;
        $dbname = $Mysqldbname;

        $database = new PDOMysql($servername, $username, $password, $dbname);
        $conn = $database->getConnection();

        try {
            $SQL = "SELECT COUNT(*) AS total FROM web_ranksuser 
            JOIN web_ranks ON Ranks_ID = Ranks_Team 
            WHERE Ranks_ID = ?";
            $stmt = $conn->prepare($SQL);
            $stmt->bind_param('i', $ID);
            $stmt->execute();
            $resultTotal = $stmt->get_result();
            // 根据业务逻辑决定返回结果
                $row = $resultTotal->fetch_assoc(); // 获取一行数据
                if ($row['total'] > 0) {
                    return false;
                } else {
                    return true;
                }
        } catch (PDOException $e) {
            // 记录异常信息，便于排查问题
            error_log("DeleteFlag Exception: " . $e->getMessage());
            return false;
        }
    }
}