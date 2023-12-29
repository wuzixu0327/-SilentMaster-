<?php

namespace Show_News;

use PDOException;
use PDOMysql;

class index_Massage
{
    public function index_News(){
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            $News_sql = "SELECT * FROM web_news order by News_Time desc limit 10";
            $resultData = $conn->query($News_sql);
            while ($row = $resultData->fetch_assoc()) {
                echo ' <div class="swiper-slide">';
                echo ' <div class="echo-latest-news-main-content">';
                echo '<div class="echo-latest-news-img img-transition-scale">';
                echo '<a href="usershow.php?id=';
                echo $row['News_ID'];
                echo '"> <img src="';
                if($row['News_href']!=null)
                {
                    echo '../../PhpSrc/Controller/';
                    echo $row['News_href'];
                    echo '"';
                }
                else{
                    echo '../../PhpSrc/Controller/News/新闻.png"';
                }
                echo ' alt="Echo" class="img-hover" style="height: 250px;width: 300px">';
                echo ' </a> </div> <div class="echo-latest-news-single-title"> <h5><a href="usershow.php?id=';
                echo $row['News_ID'];
                echo '" class="text-capitalize title-hover">';
                echo $row['News_Title'];
                echo '</a></h5> </div>';
                echo ' <div class="echo-latest-news-time-views">';
                echo ' <a href="#" class="pe-none"><i class="fa-light fa-clock"></i> ';
                echo  date("Y-m-d", strtotime($row['News_Time']));
                echo '</a></div> </div> </div>';
            }


        }catch (PDOException $e)
        {
            echo '连接失败，请联系管理员';
        }


    }
    public function index_MatchSmall(){
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            $News_sql = "SELECT * FROM web_match order by Match_ID desc limit 3,4";
            $resultData = $conn->query($News_sql);
            while ($row = $resultData->fetch_assoc()) {
                echo '<div class="echo-trending-left-site-post"> <div class="echo-trending-left-site-post-img img-transition-scale">';
                echo '<a href="userMatchShow.php?id=';
                echo $row['Match_ID'];
                echo '"> <img src="';
                if($row['Match_Annex']!="")
                {
                    echo'../../PhpSrc/Controller/Match/';
                    echo $row['Match_Annex'];
                    echo '"';
                }
                else
                {
                    echo '../../PhpSrc/Controller/Match/比赛.png"';
                }
                echo 'alt="Echo" class="img-hover">';
                echo ' </a> </div>';
                echo ' <div class="echo-trending-right-site-post-title"> <h5><a href="userMatchShow.php?id=';
                echo $row['Match_ID'];
                echo '"';
                echo 'class="text-capitalize title-hover">';
                echo $row['Match_Name'];
                echo '</a></h5>';
                echo '<div class="echo-trending-post-bottom-icons">';
                echo ' <a href="#" class="pe-none"><i class="fa-light fa-clock"></i> ';
                echo '发布时间：';
                echo date("Y-m-d", strtotime($row['Match_StartTime']));
                echo '</a>';
                echo ' <a href="#" class="pe-none">举办机构：';
                echo $row['Match_Organ'];
                echo '</a></div></div></div>';

//                <div class="echo-trending-left-site-post">
//                            <div class="echo-trending-left-site-post-img img-transition-scale">
//                                <a href="post-details.html">
//                                    <img src="assets/images/home-1/trending-left/item-1.png" alt="Echo" class="img-hover">
//                                </a>
//                            </div>
//                            <div class="echo-trending-right-site-post-title">
//                                <h5><a href="post-details.html" class="text-capitalize title-hover">Iran's Raisi
//                                        'welcomes' invitation by Saudi king</a></h5>
//                                <div class="echo-trending-post-bottom-icons">
//                                    <a href="#" class="pe-none"><i class="fa-light fa-clock"></i> 06 minute read</a>
//                                    <a href="#" class="pe-none"><i class="fa-light fa-eye"></i> 3.5k Views</a>
//                                </div>
//                            </div>
//                        </div>
            }


        }catch (PDOException $e)
        {
            echo '连接失败，请联系管理员';
        }
    }
    public function index_MatchMax(){
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try {
            $News_sql = "SELECT * FROM web_match order by Match_ID desc limit 0,3";
            $resultData = $conn->query($News_sql);
            while ($row = $resultData->fetch_assoc()) {
               echo ' <div class="echo-trending-right-site-post"><div class="echo-trending-right-site-post-img img-transition-scale">';
               echo ' <a href="userMatchShow.php?id=';
               echo $row['Match_ID'];
               echo '"><img src="';
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
                echo 'alt="Echo" class="img-hover" style="height: 250px;width: 700px">';
                echo '</a></div>';
                echo '<div class="echo-trending-right-site-post-title"><h4 class="text-capitalize"><a href="userMatchShow.php?id=';
                echo $row['Match_ID'];
                echo '" class="title-hover">';
                echo $row['Match_Name'];
                echo '</a></h4></div>';
                echo ' <div class="echo-trending-right-site-like-comment-share-icons"> <div class="echo-trending-right-like-comment-content">';
                echo '  <a href="#" class="pe-none"><i class="fa-light fa-clock"></i> 发布时间： ';
                echo date("Y-m-d", strtotime($row['Match_StartTime']));
                echo '</a> </div>';
                echo ' <div class="echo-trending-right-like-comment-content"><a href="#" class="pe-none"> 举办机构:';
                echo  $row['Match_Organ'];
                echo '</a></div></div>';

//                <div class="echo-trending-right-site-post">
//                            <div class="echo-trending-right-site-post-img img-transition-scale">
//                                <a href="post-details.html">
//                                    <img src="assets/images/home-1/trending-right/item-1.png" alt="Echo" class="img-hover">
//                                </a>
//                            </div>
//                            <div class="echo-trending-right-site-post-title">
//                                <h4 class="text-capitalize"><a href="post-details.html" class="title-hover">World
//                                        Happiness Report 2023: What's the highway to happiness?</a></h4>
//                            </div>
//                            <div class="echo-trending-right-site-like-comment-share-icons">
//                                <div class="echo-trending-right-like-comment-content">
//                                    <a href="#" class="pe-none"><i class="fa-light fa-clock"></i> 06 minute read</a>
//                                </div>
//                                <div class="echo-trending-right-like-comment-content">
//                                    <a href="#" class="pe-none"><i class="fa-light fa-eye"></i> 3.5k Views</a>
//                                </div>
//                                <div class="echo-trending-right-like-comment-content">
//                                    <a href="#" class="pe-none"><i class="fa-light fa-comment-dots"></i> 05
//                                        Comment</a>
//                                </div>
//                                <div class="echo-trending-right-like-comment-content">
//                                    <a href="#" class="pe-none"><i class="fa-light fa-arrow-up-from-bracket"></i>
//                                        1.5k Share</a>
//                                </div>
//                            </div>
//                        </div>
            }


        }catch (PDOException $e)
        {
            echo '连接失败，请联系管理员';
        }
    }
    public function Show_News(){
        require_once "../../PhpSrc/PhpMysql/PDOMysql.php";
        require_once "../../PhpSrc/PhpMysql/MysqlMassage.php";
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try{
            $News_sql = "SELECT * FROM web_news order by News_ID desc limit 0,3";
            $resultData = $conn->query($News_sql);
            while ($row = $resultData->fetch_assoc()) {
                echo '<div class="echo-de-category-content-img-title">';
                echo '<div class="echo-de-category-content-img img-transition-scale">';
                echo '<a href="usershow.php?id=';
                echo $row['News_ID'];
                echo '">';
                echo ' <img src="';
                if($row['News_href']!=null){
                    echo '../../PhpSrc/Controller/';
                    echo $row['News_href'];
                    echo '"';
                }
                else{
                    echo '../../PhpSrc/Controller/News/新闻.png"';
                }
                echo 'alt="Echo" class="img-hover" style="width: 120px;height: 120px">';
                echo '</a> </div> <div class="echo-de-category-content-title">';
                echo '<h6><a href="usershow.php?id=';
                echo $row['News_ID'];
                echo '"class="title-hover">';
                echo $row['News_Title'];
                echo '</a></h6>';
                echo ' <div class="echo-de-category-read">';
                echo ' <a href="#" class="pe-none"><i class="fa-light fa-clock"></i>';
                echo date("Y-m-d", strtotime($row['News_Time']));
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