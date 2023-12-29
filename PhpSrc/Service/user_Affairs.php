<?php

class user_Affairs
{
    public function AffairsShow($ID){
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try{
            $sqlData = "SELECT * FROM web_affairs where Affairs_ID= $ID";
            $resultData = $conn->query($sqlData);
            while ($row = $resultData->fetch_assoc()) {

                echo '<div class="echo-inner-img-ct-1  img-transition-scale">';
                echo '<a><img src="';
                echo '../../PhpSrc/Controller/News/Affairs.png"';
                echo 'class="echo-ct-style-1-banner-images" alt="Echo" style="width: 800px;height: 400px">';
                echo '</a></div>';
                echo '<div class="echo-hero-baner-text-heading-info-ct-1"><h2 class="echo-hero-title text-capitalize font-weight-bold"><a  class="title-hover">';
                echo $row['Affairs_Title'];
                echo '</a></h2>';
                echo ' <hr> <p class="echo-hero-discription">';
                echo $row['Affairs_Massage'];
                echo '</p></div>';

            }


        }catch (PDOException $e){
            echo '没有相关数据';
        }

    }
    public function Affairs_Massage($ID){
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            $sqlData = "SELECT * FROM web_affairs where Affairs_ID= $ID ";
            $resultData = $conn->query($sqlData);
            while ($row = $resultData->fetch_assoc()) {
                // 处理输出数据
                echo '标题：';
                echo $row['Affairs_Title'];
                echo '<br>';
                echo '时间:';
                echo date("Y-m-d", strtotime($row['Affairs_Time']));
            }
        } catch (PDOException $e) {
            echo '没有相关数据';
        }

    }
    public function Show_Affairs(){
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try{
            $News_sql = "SELECT * FROM web_affairs order by Affairs_ID desc limit 0,3";
            $resultData = $conn->query($News_sql);
            while ($row = $resultData->fetch_assoc()) {
                echo '<div class="echo-de-category-content-img-title">';
                echo '<div class="echo-de-category-content-img img-transition-scale">';
                echo '<a href="userAffairs_show.php?id=';
                echo $row['Affairs_ID'];
                echo '">';
                echo ' <img src="';
                echo '../../PhpSrc/Controller/News/Affairs.png"';
                echo 'alt="Echo" class="img-hover" style="width: 120px;height: 120px">';
                echo '</a> </div> <div class="echo-de-category-content-title">';
                echo '<h6><a href="userAffairs_show.php?id=';
                echo $row['Affairs_ID'];
                echo '"class="title-hover">';
                echo $row['Affairs_Title'];
                echo '</a></h6>';
                echo ' <div class="echo-de-category-read">';
                echo ' <a href="#" class="pe-none"><i class="fa-light fa-clock"></i>';
                echo date("Y-m-d", strtotime($row['Affairs_Time']));
                echo '</a></div></div></div>';



            }
//            <div class="echo-de-category-content-img-title">
//                                <div class="echo-de-category-content-img img-transition-scale">
//                                    <a href="post-details.html">
//                                        <img src="assets/images/home-1/de-category/item-1.png" alt="Echo" class="img-hover" style="width: 120px;height: 120px">
//                                    </a>
//                                </div>
//                                <div class="echo-de-category-content-title">
//                                    <h6><a href="post-details.html" class="title-hover">Everyone’s talking about
//                                            Credit Sui...</a></h6>
//                                    <div class="echo-de-category-read">
//                                        <a href="#" class="pe-none"><i class="fa-light fa-clock"></i> 06 minute
//                                            read</a>
//                                    </div>
//                                </div>
//                            </div>


        }catch (PDOException $e){

            echo '连接失败，请联系管理员';
        }

    }
}