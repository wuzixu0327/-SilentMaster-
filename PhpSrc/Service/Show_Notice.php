<?php

namespace Show_News;

use PDOMysql;

class Show_Notice
{
    public function __construct()
    {
        // 构造函数用于初始化
    }

    public function Show_Notice($Page)
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
            $SQL = "SELECT COUNT(*) as total FROM web_notice";
            $resultTotal = $conn->query($SQL);
            $rowTotal = $resultTotal->fetch_assoc();
            $total_records = $rowTotal['total'];
            $start_index = ($Page - 1) * $Limit;
            $sqlData = "SELECT * FROM web_notice order by Notice_ID desc LIMIT $start_index, $Limit ";
            $resultData = $conn->query($sqlData);
            while ($row = $resultData->fetch_assoc()) {
                // 处理输出数据
                echo ' <tr><td><input type="checkbox" name="checkbox[]" value="';
                echo $row['Notice_ID'];
                echo '"/></td><td >';
                echo $row['Notice_ID'];
                echo '</td> <td><p>';
                echo $row['Notice_Title'];
                echo '</p></td><td ><a>协会公告</a></td><td >';
                echo date("Y-m-d", strtotime($row['Notice_Time']));
                echo '</td><td><a href="../../PhpSrc/Controller/NoticeRevise.php?&Eid=';
                echo  $row['Notice_ID'];
                echo '&action=1">编辑</a> | <a href="../../PhpSrc/Controller/NoticeRevise.php?id=';
                echo  $row['Notice_ID'];
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
            $SQL = "SELECT COUNT(*) as total FROM web_notice";
            $resultTotal = $conn->query($SQL);
            $rowTotal = $resultTotal->fetch_assoc();
            $total_records = $rowTotal['total'];
            return $total_records;

        } catch (PDOException $e) {
            echo '获取数据失败请联系管理员';
        }
    }
}