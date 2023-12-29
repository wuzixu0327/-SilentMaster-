<?php

namespace Show_News;

use PDOException;
use PDOMysql;
class Show_News
{
    public function __construct()
    {
        // 构造函数用于初始化
    }

    public function Show_News($Page)
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
            $SQL = "SELECT COUNT(*) as total FROM web_news";
            $resultTotal = $conn->query($SQL);
            $rowTotal = $resultTotal->fetch_assoc();
            $total_records = $rowTotal['total'];
            $start_index = ($Page - 1) * $Limit;
            $sqlData = "SELECT * FROM web_news order by News_ID desc LIMIT $start_index, $Limit ";
            $resultData = $conn->query($sqlData);
            while ($row = $resultData->fetch_assoc()) {
                // 处理输出数据
                echo ' <tr><td><input type="checkbox" name="checkbox[]" value="';
                echo $row['News_ID'];
                echo '"/></td><td >';
                echo $row['News_ID'];
                echo '</td> <td><p>';
                echo $row['News_Title'];
                echo '</p></td><td ><a>协会新闻</a></td><td >';
                echo date("Y-m-d", strtotime($row['News_Time']));
                echo '</td><td><a href="../../PhpSrc/Controller/NewsRevise.php?&Eid=';
                $News_ID = $row['News_ID'];
                echo $News_ID;
                echo '&action=1">编辑</a> | <a href="../../PhpSrc/Controller/NewsRevise.php?id=';
                echo $News_ID;
                echo '&action=0">删除</a></td></tr>';
            }
        } catch (PDOException $e) {
            echo '没有相关数据';
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
            $Limit = 15;
            $SQL = "SELECT COUNT(*) as total FROM web_news";
            $resultTotal = $conn->query($SQL);
            $rowTotal = $resultTotal->fetch_assoc();
            $total_records = $rowTotal['total'];
            return $total_records;

        } catch (PDOException $e) {
            echo '获取数据失败请联系管理员';
        }
    }
}