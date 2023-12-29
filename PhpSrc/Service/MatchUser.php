<?php

namespace Show_News;


use PDOException;
use PDOMysql;

class MatchUser
{
    public function User_Nokey($Page)
    {
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            $Limit = 15;
            $SQL = "SELECT COUNT(*) as total FROM web_ranksuser ";
            $resultTotal = $conn->query($SQL);
            $rowTotal = $resultTotal->fetch_assoc();
            $total_records = $rowTotal['total'];
            $start_index = ($Page - 1) * $Limit;
            $sql = "SELECT * FROM suser_web.web_ranksuser LIMIT $start_index, $Limit";
            $resultData = $conn->query($sql);
            while ($row = $resultData->fetch_assoc()) {
                echo '<tr> <td align="center"><input type="checkbox" name="checkbox[]" value="';
                echo $row['Ranks_User_ID'];
                echo '"></td><td align="center">';
                $Match_ID = $row['Ranks_Team'];
                $Name = "SELECT * FROM web_ranks join web_match on Match_ID=Ranks_Match where Ranks_ID = $Match_ID ";
                $resultDataMatchName = $conn->query($Name);
                if ($resultDataMatchName) {
                    $matchData = $resultDataMatchName->fetch_assoc();
                    $Ranks_Name = $matchData['Ranks_Name'];
                    $Match_Name = $matchData['Match_Name'];
                }
                echo $row['Ranks_User_ID'];
                echo '</td><td><a>';
                echo $Match_Name . '----' . $Ranks_Name . '队';
                echo '</a></td><td align="center"><a>';
                $User_ID = $row['User_ID'];
                $Name = "SELECT * FROM web_ranksuser join web_user on User_ID=userID where userID = $User_ID";
                $resultDataName = $conn->query($Name);
                if ($resultDataName) {
                    $matchData = $resultDataName->fetch_assoc();
                    $User_Name = $matchData['userName'];
                } else {
                    // 查询失败或没有结果，设置默认值或处理错误
                    $User_Name = 'N/A';
                }

                echo $User_Name;
                echo '</a></td> <td align="center">';
                if ($row['Ranks_Type'] == 0) {
                    echo '队长';
                } else echo '队员';
                echo '</td><td align="center">';
                $timestamp = strtotime($row['Ranks_JoinTime']);
                $formattedDate = date("Y-m-d", $timestamp);
                echo $formattedDate;
                echo '</td><td align="center">';
                echo '<a href="Rank_User.php?id=';
                echo $row['Ranks_User_ID'];
                echo '">删除</a>';


            }
        } catch (PDOException $e) {
            echo '数据库连接失败';
        }
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
            $SQL = "SELECT COUNT(*) as total FROM web_ranksuser";
            $resultTotal = $conn->query($SQL);
            $rowTotal = $resultTotal->fetch_assoc();
            $total_records = $rowTotal['total'];
            return $total_records;

        } catch (PDOException $e) {
            echo '获取数据失败请联系管理员';
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
            $SQL = "DELETE FROM web_ranksuser WHERE Ranks_User_ID = ?";

            // 获取数据库锁
            $conn->query("SELECT * FROM web_ranksuser WHERE Ranks_User_ID = ? FOR UPDATE");

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

    public function iSelectinfo_keyword($Name, $Page)
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
            $stmt = $conn->prepare("SELECT * FROM web_ranksuser join web_ranks on Ranks_Team=Ranks_ID WHERE Ranks_Name LIKE ? LIMIT ?, ?");

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
                    echo $row['Ranks_User_ID'];
                    echo '"></td><td align="center">';
                    $Match_ID = $row['Ranks_Team'];
                    $Name = "SELECT * FROM web_ranks join web_match on Match_ID=Ranks_Match where Ranks_ID = $Match_ID ";
                    $resultDataMatchName = $conn->query($Name);
                    if ($resultDataMatchName) {
                        $matchData = $resultDataMatchName->fetch_assoc();
                        $Ranks_Name = $matchData['Ranks_Name'];
                        $Match_Name = $matchData['Match_Name'];
                    }
                    echo $row['Ranks_User_ID'];
                    echo '</td><td><a>';
                    echo $Match_Name . '----' . $Ranks_Name . '队';
                    echo '</a></td><td align="center"><a>';
                    $User_ID = $row['User_ID'];
                    $Name = "SELECT * FROM web_ranksuser join web_user on Ranks_User_ID=userID where userID = $User_ID";
                    $resultDataName = $conn->query($Name);
                    if ($resultDataName) {
                        $matchData = $resultDataName->fetch_assoc();
                        $User_Name = $matchData['userName'];
                    }
                    echo $User_Name;
                    echo '</a></td> <td align="center">';
                    if ($row['Ranks_Type'] == 0) {
                        echo '队长';
                    } else echo '队员';
                    echo '</td><td align="center">';
                    $timestamp = strtotime($row['Ranks_JoinTime']);
                    $formattedDate = date("Y-m-d", $timestamp);
                    echo $formattedDate;
                    echo '</td><td align="center">';
                    echo '<a href="Rank_User.php?id=';
                    echo $row['Ranks_User_ID'];
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

    public function iSelectinfo_Nokeyword($Name, $Page)
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
            $stmt = $conn->prepare("SELECT * FROM web_ranksuser join web_ranks on Ranks_Team=Ranks_ID WHERE web_ranks.Ranks_Match = ? LIMIT ?, ?");

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
                    echo $row['Ranks_User_ID'];
                    echo '"></td><td align="center">';
                    $Match_ID = $row['Ranks_Team'];
                    $Name = "SELECT * FROM web_ranks join web_match on Match_ID=Ranks_Match where Ranks_ID = $Match_ID ";
                    $resultDataMatchName = $conn->query($Name);
                    if ($resultDataMatchName) {
                        $matchData = $resultDataMatchName->fetch_assoc();
                        $Ranks_Name = $matchData['Ranks_Name'];
                        $Match_Name = $matchData['Match_Name'];
                    }
                    echo $row['Ranks_User_ID'];
                    echo '</td><td><a>';
                    echo $Match_Name . '----' . $Ranks_Name . '队';
                    echo '</a></td><td align="center"><a>';
                    $User_ID = $row['User_ID'];
                    $Name = "SELECT * FROM web_ranksuser join web_user on User_ID=userID where userID = $User_ID";
                    $resultDataName = $conn->query($Name);
                    if ($resultDataName) {
                        $matchData2 = $resultDataName->fetch_assoc();
                        $User_Name = $matchData2['userName'];
                    }
                    echo $User_Name;
                    echo '</a></td> <td align="center">';
                    if ($row['Ranks_Type'] == 0) {
                        echo '队长';
                    } else echo '队员';
                    echo '</td><td align="center">';
                    $timestamp = strtotime($row['Ranks_JoinTime']);
                    $formattedDate = date("Y-m-d", $timestamp);
                    echo $formattedDate;
                    echo '</td><td align="center">';
                    echo '<a href="Rank_User.php?id=';
                    echo $row['Ranks_User_ID'];
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

    public function iPage_keyword($Name)
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
            $SQL = "SELECT COUNT(*) as total FROM web_ranksuser join web_ranks on Ranks_Team=Ranks_ID WHERE Ranks_Name LIKE ?";
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

    public function iPage_Nokeyword($ID)
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
            $SQL = "SELECT COUNT(*) as total FROM web_ranksuser join web_ranks on Ranks_Team=Ranks_ID WHERE web_ranks.Ranks_Match = ?";
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
    public function inputcsv($Name, $selectedIDs) {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";

        $servername = $Mysqlservername;
        $username = $Mysqlusername;
        $password = $Mysqlpassword;
        $dbname = $Mysqldbname;

        $database = new PDOMysql();
        $conn = $database->getConnection();

        try {
            $sql = "SELECT * FROM suser_web.web_match where Match_ID=$Name";
            $resultData = $conn->query($sql);

            while ($row = $resultData->fetch_assoc()) {
                $MatchName = $row['Match_Name'];
            }
            // 为防止中文乱码，设置字符集为 UTF-8
            header('Content-Type: text/csv; charset=UTF-8');
            // 设置文件名，使用查询结果中的比赛名
            header('Content-Disposition: attachment; filename="' . urlencode(trim($MatchName)) . '.csv"');
            // 使用 IN 子句匹配所有选定的 ID
            $idList = implode(',', $selectedIDs);

            $sql = "
            SELECT Ranks_User_ID as 参赛人员ID,userSno as 学号, Ranks_Name as 队伍名, Match_Name as 比赛名, userName as 用户名, Ranks_JoinTime as 加入时间
            FROM web_match
            INNER JOIN web_ranks ON Match_ID = Ranks_Match
            INNER JOIN web_ranksuser ON Ranks_ID = Ranks_Team
            INNER JOIN web_user ON User_ID = userID 
            WHERE Ranks_User_ID IN ($idList);
        ";

            $result = $conn->query($sql);

            // 打开 CSV 文件，写入列名
            $csvFile = fopen('php://output', 'w');
            $columnNames = ['参赛人员序号', '学号','队伍名', '比赛名', '用户名', '加入时间'];
            fputcsv($csvFile, $columnNames);

            // 逐行写入数据，并在写入日期字段时进行格式化
            while ($row = $result->fetch_assoc()) {
                // 格式化日期字段（假设 Ranks_JoinTime 是日期字段）
                $row['加入时间'] = date('Y-m-d', strtotime($row['加入时间']));
                $row['比赛名'] = trim($row['比赛名']);
                fputcsv($csvFile, $row);
            }

            fclose($csvFile);

            // 关闭连接
            $conn->close();

            // 停止脚本执行，确保只输出 CSV 文件
            exit();
        } catch (PDOException $e) {
            // 将异常信息存储在变量中，而不是直接输出
            $errorMessage = "导出失败: " . $e->getMessage();
        }

        // 如果没有异常信息，则输出异常信息
        if (isset($errorMessage)) {
            echo $errorMessage;
        }
    }

}