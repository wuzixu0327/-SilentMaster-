<?php

namespace Show_News;

use PDOException;
use PDOMysql;

class user_News
{
    public function index_News($ID)
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            $sqlData = "SELECT * FROM web_news where  News_ID = $ID ";
            $resultData = $conn->query($sqlData);
            while ($row = $resultData->fetch_assoc()) {
                // 处理输出数据
                echo '<div class="echo-inner-img-ct-1  img-transition-scale">';
                echo '<a><img src="';
                if($row['News_href']!=null)
                {
                    echo '../../PhpSrc/Controller/';
                    echo $row['News_href'];
                    echo '"';
                }
                else{
                    echo '../../PhpSrc/Controller/News/新闻.png"';
                }
                echo 'class="echo-ct-style-1-banner-images" alt="Echo" style="width: 800px;height: 400px">';
                echo '</a></div>';
                echo '<div class="echo-hero-baner-text-heading-info-ct-1"><h2 class="echo-hero-title text-capitalize font-weight-bold"><a  class="title-hover">';
                echo $row['News_Title'];
                echo '</a></h2>';
                echo ' <hr> <p class="echo-hero-discription">';
                echo $row['News_Massage'];
                echo '</p></div>';
            }
        } catch (PDOException $e) {
            echo '没有相关数据';
        }
    }
    public function News_Massage($ID)
    {
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            $sqlData = "SELECT * FROM web_news where  News_ID = $ID ";
            $resultData = $conn->query($sqlData);
            while ($row = $resultData->fetch_assoc()) {
                // 处理输出数据
                echo '标题：';
                echo $row['News_Title'];
                echo '<br>';
                echo '时间:';
                echo date("Y-m-d", strtotime($row['News_Time']));
            }
        } catch (PDOException $e) {
            echo '没有相关数据';
        }
    }
}