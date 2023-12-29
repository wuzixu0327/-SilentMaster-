<?php

class user_Match
{
    public function index_Match($ID){
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            $sqlData = "SELECT * FROM suser_web.web_match where  Match_ID = $ID ";
            $resultData = $conn->query($sqlData);
            while ($row = $resultData->fetch_assoc()) {
                // 处理输出数据
                echo '<div class="echo-inner-img-ct-1  img-transition-scale">';
                echo '<a><img src="';
                if($row['Match_Annex']!="")
                {
                    echo '../../PhpSrc/Controller/Match/';
                    echo $row['Match_Annex'];
                    echo '"';
                }
                else
                {
                    echo '../../PhpSrc/Controller/Match/热点比赛.png"';
                }
                echo 'class="echo-ct-style-1-banner-images" alt="Echo" style="width: 800px;height: 400px">';
                echo '</a></div>';
                echo '<div class="echo-hero-baner-text-heading-info-ct-1"><h2 class="echo-hero-title text-capitalize font-weight-bold"><a  class="title-hover">';
                echo $row['Match_Name'];
                echo '</a></h2>';
                echo ' <hr> <p class="echo-hero-discription">比赛内容：';
                echo $row['Match_Massage'];
                echo '</p>';
                echo '</div>';
            }
        } catch (PDOException $e) {
            echo '没有相关数据';
        }
    }
    public function Match_Massage($ID)
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            $sqlData = "SELECT * FROM suser_web.web_match where Match_ID = $ID ";
            $resultData = $conn->query($sqlData);
            while ($row = $resultData->fetch_assoc()) {
                // 处理输出数据
                echo '举办机构：';
                echo $row['Match_Organ'];
                echo '<br>';
                echo '开始时间:';
                echo date("Y-m-d", strtotime($row['Match_StartTime']));
                echo '<br>';
                echo '结束时间:';
                echo date("Y-m-d", strtotime($row['Match_EndTime']));
                echo '<br>';
                echo '比赛类别:';
                if($row['Match_Type']==0)
                {
                    echo '个人赛';
                }
                else
                {
                    echo '团体赛';
                }
                echo '<br>';
                echo '限制人数:';
                if($row['Match_Type']==0)
                {
                    echo '1人';
                }
                else
                {
                    echo $row['Match_NumberLimit'];
                }
            }
        } catch (PDOException $e) {
            echo '没有相关数据';
        }
    }
    public function Select_Join($Match_ID, $Sno)
    {
        $sqlData = "SELECT * FROM web_user
            JOIN web_ranksuser ON userID = User_ID
            JOIN web_ranks ON Ranks_ID = Ranks_Team
            WHERE Ranks_Match = ? AND userSno = ?";

        $database = new PDOMysql();  // 使用了 PDO，可能应该修改成对应的 mysqli 连接方式
        $conn = $database->getConnection();

        try {
            // 准备并执行参数化查询
            $stmt = $conn->prepare($sqlData);

            if (!$stmt) {
                // 输出详细的错误信息
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }

            $stmt->bind_param('ii', $Match_ID, $Sno); // 'ii' 表示两个参数都是整数
            $success = $stmt->execute();

            if ($success) {
                // 查询执行成功
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    // 有结果返回
                    return true;
                } else {
                    // 查询结果为空
                    return false;
                }
            } else {
                // 查询执行失败
                echo '查询失败';
            }

            // 关闭语句
            $stmt->close();

        } catch (Exception $e) {
            // 记录错误或采取适当的安全措施
            echo '没有相关数据';
        } finally {
            // 关闭连接
            $conn->close();
        }

    }


}