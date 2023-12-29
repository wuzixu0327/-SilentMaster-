<?php

class SelectMatch
{

    public function __construct()
    {
        // 构造函数用于初始化
    }

    public function Show_Match($Name)
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "PDOMysql.php";
        require_once "MysqlMassage.php";
        $servername = $Mysqlservername;
        $username = $Mysqlusername;
        $password = $Mysqlpassword;
        $dbname = $Mysqldbname;
        $database = new PDOMysql($servername, $username, $password, $dbname);
        $conn = $database->getConnection();
        try {
            $Select_Name = '%' . $Name . '%';
            $sqlData = "SELECT * FROM web_match   WHERE Match_Name LIKE ? order by Match_ID desc ";
            $stmt = $conn->prepare($sqlData);
            $stmt->bind_param('s', $Select_Name); // 's' 表示参数类型为字符串
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows === 0)
            {
                echo "没有相关信息";
            }
            else {
                echo '  <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                            <tr>
                            <th></th>
                            <th width="40" align="center">编号</th>
                            <th align="left">名称</th>
                            <th width="80" align="center">类型</th>
                            <th width="150" align="center">日期</th>
                            <th width="150" align="center">操作</th>
                        </tr>';
                while ($row = $result->fetch_assoc()) {
                    // 处理输出数据
                    echo ' <tr><td><input type="checkbox" name="checkbox[]" value="';
                    echo $row['Match_ID'];
                    echo '"/></td><td>';
                    echo  $row['Match_ID'];
                    echo '</td> <td><p>';
                    echo $row['Match_Name'];
                    echo '</p></td><td><a>协会赛事</a></td><td>';
                    echo date("Y-m-d", strtotime($row['Match_StartTime']));
                    echo '-';
                    echo date("Y-m-d", strtotime($row['Match_EndTime']));
                    echo '</td><td><a href="../../PhpSrc/Controller/MatchRevise.php?Eid=';
                    echo $row['Match_ID'];
                    echo '&action=1">编辑</a> | <a href="../../PhpSrc/Controller/MatchRevise.php?id=';
                    echo $row['Match_ID'];
                    echo '&action=0">删除</a></td></tr>';

                }
                echo '</table>';
            }

        }
        catch (PDOException $e) {
            echo '数据库连接失败，请联系管理员';
        }

    }
}