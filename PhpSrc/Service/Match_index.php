<?php

class Match_index
{
    public function ShowMassage($Page)
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
            $Limit = 5;
            $SQL = "SELECT COUNT(*) as total FROM web_match";
            $resultTotal = $conn->query($SQL);
            $rowTotal = $resultTotal->fetch_assoc();
            $total_records = $rowTotal['total'];
            $start_index = ($Page - 1) * $Limit;
            $sqlData = "SELECT * FROM web_match order by Match_ID desc LIMIT $start_index, $Limit ";
            $resultData = $conn->query($sqlData);
            while ($row = $resultData->fetch_assoc()) {
                // 处理输出数据
                echo '<div class="echo-hero-baner">';
                echo '<div class="echo-inner-img-ct-1  img-transition-scale">';
                echo '<a href="userMatchShow.php?id=';
                echo $row['Match_ID'];
                echo '">';
                echo '<img src="';
                if ($row['Match_Annex'] != null) {
                    echo '../../PhpSrc/Controller/Match/';
                    echo $row['Match_Annex'];
                    echo '"';
                } else {
                    echo '../../PhpSrc/Controller/Match/热点比赛.png"';
                }
                echo 'alt="Echo" ';
                echo '></a></div>';
                echo ' <div class="echo-banner-texting">';
                echo '<h3 class="echo-hero-title text-capitalize font-weight-bold">';
                echo '<a href="userMatchShow.php?id=';
                echo $row['Match_ID'];
                echo '" class="title-hover">';
                echo $row['Match_Name'];
                echo '</a></h3>';
                echo ' <div class="echo-hero-area-titlepost-post-like-comment-share">';
                echo '<div class="echo-hero-area-like-read-comment-share">';
                echo '<a href="#"><i class="fa-light fa-clock"></i>时间:';
                echo date("Y-m-d", strtotime($row['Match_StartTime']));
                echo '------';
                echo date("Y-m-d", strtotime($row['Match_EndTime']));
                echo '</a></div></div></div></div>';

//                <div class="echo-hero-baner">
//                            <div class="echo-inner-img-ct-1  img-transition-scale">
//                                <a href="post-details.html"><img src="assets/images/category-style-2/item-1.png" alt="Echo"></a>
//                            </div>
//                            <div class="echo-banner-texting">
//                                <h3 class="echo-hero-title text-capitalize font-weight-bold"><a href="post-details.html" class="title-hover">26% of world lacks clean drinking...</a></h3>
//                                <div class="echo-hero-area-titlepost-post-like-comment-share">
//                                    <div class="echo-hero-area-like-read-comment-share">
//                                        <a href="#"><i class="fa-light fa-clock"></i> 06 minute read</a>
//                                    </div>
//                                </div>
//                                <hr>
//                                <p class="echo-hero-discription">Mauris ultrices eros in cursus turpis massa the tincidunt dui ut. Quam vulputate dignissim over suspendisse in est ante in nibh mauris. </p>
//                            </div>
//                        </div>
            }
        } catch (PDOException $e) {
            echo '没有相关数据';
        }

    }
    public function Now_Massage(){
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

            $sqlData = "SELECT * FROM web_match order by Match_ID desc LIMIT 0, 4";
            $resultData = $conn->query($sqlData);
            while ($row = $resultData->fetch_assoc()) {
                // 处理输出数据
                echo '<div class="echo-top-story">';
                echo '  <div class="echo-story-picture img-transition-scale">';
                echo '<a href="userMatchshow.php?id=';
                echo $row['Match_ID'];
                echo '">';
                echo '<img src="';
                if ($row['Match_Annex'] != null) {
                    echo '../../PhpSrc/Controller/Match/';
                    echo $row['Match_Annex'];
                    echo '"';
                } else {
                    echo '../../PhpSrc/Controller/Match/热点比赛.png"';
                }
                echo 'alt="Echo" ';
                echo 'class="img-hover">';
                echo '</a>';
                echo ' </div>';
                echo '<div class="echo-story-text">';
                echo '<h6><a href="';
                echo 'userMatchshow.php?id=';
                echo $row['Match_ID'];
                echo '"class="title-hover">';
                echo $row['Match_Name'];
                echo '</a></h6>';
                echo '<a href="#" class="pe-none"><i class="fa-light fa-clock"></i>';
                echo date("Y-m-d", strtotime($row['Match_StartTime']));
                echo '</a> </div> </div>';
//                <div class="echo-top-story">
//                                    <div class="echo-story-picture img-transition-scale">
//                                        <a href="post-details.html"><img src="assets/images/category-style-1/item-9.png" alt="Echo" class="img-hover"></a>
//                                    </div>
//                                    <div class="echo-story-text">
//                                        <h6><a href="#" class="title-hover">14 Tight Samurai Games You...</a></h6>
//                                        <a href="#" class="pe-none"><i class="fa-light fa-clock"></i> 06 minute read</a>
//                                    </div>
//                                </div>
            }
        } catch (PDOException $e) {
            echo '没有相关数据';
        }

    }
    public function Count(){
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $servername = $Mysqlservername;
        $username = $Mysqlusername;
        $password = $Mysqlpassword;
        $dbname = $Mysqldbname;
        $database = new PDOMysql($servername, $username, $password, $dbname);
        $conn = $database->getConnection();
        $sql = "SELECT COUNT(*) as total FROM web_match";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // 获取查询结果
            $row = $result->fetch_assoc();
            $totalRecords = $row['total'];

            // 输出记录总数
            echo $totalRecords;
        } else {
            echo 0;
        }
// 关闭连接
        $conn->close();
    }
}