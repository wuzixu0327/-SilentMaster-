<?php

class index implements indexshow
{
    public function __construct()
    {
        // 构造函数的实现
    }

    public function indexshowNews()
    {
        require_once ("../PhpMysql/PDOMysql.php");
        $database = new PDOMysql();
        $conn = $database->getConnection();
        try{
            $indexnewssql = "SELECT * FROM suser_web.web_news ";
            $resultData = $conn->query($indexnewssql);
            while ($row = $resultData->fetch_assoc()){
                echo '<div class="swiper-slide"><div class="echo-latest-news-main-content">
                       <div class="echo-latest-news-img img-transition-scale">
                         <a>';
                echo ' <img src="';
                echo $row['News_href'];
                echo '" alt="Echo" class="img-hover" style="height: 200px;width: 300px">';

            }

        }catch (PDOException $e){


        }
        // TODO: Implement index() method.
    }
}
//<div class="swiper-slide">
//                            <div class="echo-latest-news-main-content">
//                                <div class="echo-latest-news-img img-transition-scale">
//                                    <a href="post-details.html">
//                                        <img src="assets/images/原子40x40.png" alt="Echo" class="img-hover" style="height: 200px;width: 300px">
//                                    </a>
//                                </div>
//                                <div class="echo-latest-news-single-title">
//                                    <h5><a href="post-details.html" class="text-capitalize title-hover">Xi, Putin
//                                            hail 'new era' of ties in united...</a></h5>
//                                </div>
//                                <div class="echo-latest-news-time-views">
//                                    <a href="#" class="pe-none"><i class="fa-light fa-clock"></i> 06 minute read</a>
//                                    <a href="#" class="pe-none"><i class="fa-light fa-eye"></i> 3.5k Views</a>
//                                </div>
//                            </div>
//                        </div>