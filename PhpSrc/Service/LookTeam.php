<?php

class LookTeam
{
    public function look_Team($Ranks)
    {
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            $getRanks = "SELECT * FROM web_ranksuser where Ranks_User_ID=$Ranks";
            $result = $conn->query($getRanks);
            if ($result) {
                $row = $result->fetch_assoc();
                $RanksID = $row['Ranks_Team'];
            } else {
                throw new Exception("查询失败: " . $conn->error);
            }
            $sql = "SELECT * FROM web_ranksuser
                JOIN web_ranks ON Ranks_Team = Ranks_ID
                JOIN web_user ON User_ID = userID
                Join web_match on Ranks_Match = Match_ID 
                WHERE  Ranks_Team = ?";

            // 创建预处理语句
            $stmt = $conn->prepare($sql);

            // 绑定参数
            $stmt->bind_param('i',  $RanksID);

            // 执行查询
            $stmt->execute();

            // 获取结果
            $result = $stmt->get_result();
            $numRows = $result->num_rows;
            if($numRows === 0)
            {
                echo '没有相关数据';
            }
            else{
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
                    echo '<div class="div"><p>学号:';
                    echo $row['userSno'];
                    echo '</p></div>';
                    echo '<div class="div"><p>加入时间:';
                    echo date("Y-m-d", strtotime($row['Ranks_JoinTime']));
                    echo '</p></div></div>';

                }
            }

        }catch (PDOException $e)
        {
            echo 'PDO Exception: ' . $e->getMessage();
        }
    }
}