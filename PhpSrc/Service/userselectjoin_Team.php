<?php

class userselectjoin_Team
{
public function selectjoin_Team($Sno,$MatchID)
{
    global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
    require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
    require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
    $database = new PDOMysql();
    $conn = $database->getConnection();
    try {
        $sql = "SELECT * FROM web_ranksuser
                JOIN web_ranks ON Ranks_Team = Ranks_ID
                JOIN web_user ON User_ID = userID
                Join web_match on Ranks_Match = Match_ID 
                WHERE userSno = ? AND Ranks_Match = ?";

        // 创建预处理语句
        $stmt = $conn->prepare($sql);

        // 绑定参数
        $stmt->bind_param('ii', $Sno, $MatchID);

        // 执行查询
        $stmt->execute();

        // 获取结果
        $result = $stmt->get_result();
        $numRows = $result->num_rows;
        if($numRows === 0)
        {
            echo '没有相关数据';
        }
        else {
            // 如果需要，处理结果
            while ($row = $result->fetch_assoc()) {
                // 处理每一行数据
                // $row 包含每一行的关联数组
                echo '<div style="display: flex; justify-content: space-between;width: 1150px;background: #D9D9D9;margin-left:-30px">';
                echo '  <input  id="hiddenInput" style="display: none" value="';
                echo $row['Ranks_User_ID'];
                echo '"/>';
                echo '<div class="div">';
                echo '<p>';
                echo $row['Match_Name'];
                echo '</p> </div>';
                echo '<div class="div"><p>队伍名：';
                echo $row['Ranks_Name'];
                echo '</p> </div>';
                echo '<div class="div"><p>姓名：';
                echo $row['userName'];
                echo '</p> </div>';
                echo '<div class="div"><p>身份：';
                if ($row['Ranks_Type'] == 0) {
                    echo '队长';
                } else echo '队员';
                echo '</p> </div>';
                echo '<div class="div"><button onclick="';
                echo 'getHiddenInputValue_Delete()">';
                echo '[退出队伍]</button></div>';
                if ($row['Ranks_Type'] == 0) {
                    echo '<div class="div"><button onclick="';
                    echo 'getHiddenInputValue_Code()">';
                    echo '[复制邀请码]</button></div>';
                }
                echo '<div class="div"><button onclick="';
                echo 'getHiddenInputValue_User()">';
                echo '[查看队伍信息]</button>';
                echo ' </div> </div>';
            }
        }
        // 关闭预处理语句
        $stmt->close();

    } catch (Exception $e) {
        // 处理异常
        // 记录或显示错误消息
        error_log("MySQLi Exception: " . $e->getMessage());
    } finally {
        // 关闭数据库连接
        $conn->close();
    }

}
}