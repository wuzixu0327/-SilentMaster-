
<?php
session_start(); // 确保会话已启动
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>开放原子开源协会</title>
    <link rel="icon" href="../user/assets/images/原子40x40.png">
    <link rel="stylesheet preload" href="assets/css/plugins/fontawesome-5.css" as="style">
    <link rel="stylesheet preload" href="assets/css/vendor/bootstrap.min.css" as="style">
    <link rel="stylesheet preload" href="assets/css/vendor/swiper.css" as="style">
    <link rel="stylesheet preload" href="assets/css/vendor/metismenu.css" as="style">
    <link rel="stylesheet preload" href="assets/css/vendor/magnific-popup.css" as="style">
    <link rel="stylesheet preload" href="assets/css/style.css" as="style">
    <link rel="stylesheet" type="text/css" href="alert/GAlert/iconfont/iconfont.css">
    <link href="alert/GAlert/jqAlert.css" rel="stylesheet" type="text/css">
    <script src="alert/GAlert/jquery.min.js"></script>
    <script src="alert/GAlert/jqAlert.js"></script>
</head>
<body class="home-one">
<!-- Start Top Header Area -->
<!-- Start Top Header Area -->
<header class="echo-header-area">
    <!-- Start Home-1 Menu & Site Logo & Social Media -->
    <div class="echo-home-1-menu">
        <div class="echo-site-main-logo-menu-social">
            <div class="container">
                <div class="row align-items-center plr_md--30 plr_sm--30 plr--10">
                    <div class="col-xl-2 col-lg-2 col-md-7 col-sm-7 col-7">
                        <div class="echo-site-logo">
                            <a class="logo-light" href="userindex.php"><img src="assets/images/原子40x40.png" alt="Echo">开放原子开源协会</a>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 d-none d-lg-block">
                        <nav>
                            <div class="echo-home-1-menu">
                                <ul class="list-unstyled echo-desktop-menu">
                                        <a href="userindex.php" class="echo-dropdown-main-element active">首页</a>
                                        <!-- Start Dropdown Menu -->
                                        <!-- End Dropdown Menu -->
                                    <li class="menu-item"><a href="userNews.php" class="echo-dropdown-main-element">协会新闻</a></li>
                                    <li class="menu-item"><a href="userMatch.php" class="echo-dropdown-main-element">协会赛事</a></li>
                                    <li class="menu-item"><a href="userNotice.php" class="echo-dropdown-main-element">协会公告</a></li>
                                    <li class="menu-item"><a href="userAffairs.php" class="echo-dropdown-main-element">学生事务</a></li>
                                    <li class="menu-item"><a href="userSpace.php" class="echo-dropdown-main-element">参赛详情</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-5">
                        <div class="echo-home-1-social-media-icons">
                            <div class="echo-header-top-menu-bar menu-btn">
                                <a href="javascript:void(0)">
                                    登录
                                    <svg width="20" height="19" viewBox="0 0 20 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.526001 0.953461H20V3.11724H0.526001V0.953461ZM7.01733 8.52668H20V10.6905H7.01733V8.52668ZM0.526001 16.0999H20V18.2637H0.526001V16.0999Z" fill="#5E5E5E" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Home-1 Menu & Site Logo & Social Media -->
</header>
<div id="side-bar" class="side-bar header-one">
    <div class="inner">
        <button class="close-icon-menu"><i class="far fa-times"></i></button>
        <!-- inner menu area desktop start -->
        <div class="inner-main-wrapper-desk d-none d-lg-block">
            <div class="inner-content">
                <div class="category-menu-area">
                </div>
                <div class="newsletter-form">
                    <div class="form-inner">
                        <?php
                        // 检查用户是否已登录
                        if (isset($_SESSION['userSno'])) {
                            // 用户已登录，显示欢迎消息
                            $username = $_SESSION['userSno'];
                            echo '
                     <div class="content">
                     <h3 class="title">当前账号：';
                     echo $username;
                     echo '
                     </h3>
                      <a href="../../PhpSrc/Controller/Destroy.php"><button type="button" class="subscribe-btn" style="width: 300px;position: relative;top: 20px">退出账号</button></a>
                      </div>
                        ';
                        } else {
                            // 用户未登录，显示登录表单
                            echo '
                     <div class="content">
                     <h3 class="title">暂未登录</h3>
                      <a href="userlogin/userlogin.php"><button type="button" class="subscribe-btn" style="width: 300px;position: relative;top: 20px">登录账号</button></a>
                      </div>
                        ';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile menu area start -->
    <div class="mobile-menu d-block d-lg-none">
        <nav class="nav-main mainmenu-nav mt--30">
            <ul class="mainmenu" id="mobile-menu-active">
                <li class="menu-item"><a class="main mobile-menu-link" href="userindex.php">首页</a></li>
                <li class="menu-item"><a class="main mobile-menu-link" href="userNews.php">协会新闻</a></li>
                <li class="menu-item"><a class="main mobile-menu-link" href="userMatch.php">协会赛事</a></li>
                <li class="menu-item"><a class="main mobile-menu-link" href="userNotice.php">协会公告</a></li>
                <li class="menu-item"><a class="main mobile-menu-link" href="userAffairs.php">学生事务</a></li>
                <li class="menu-item"><a class="main mobile-menu-link" href="userSpace.php">参赛详情</a></li>
                <li class="menu-item"><a class="main mobile-menu-link" href="userlogin/userlogin.php">登录账号</a></li>
            </ul>
        </nav>
    </div>
    <!-- mobile menu area end -->
</div>
<!-- End Top Header Area -->

<!-- side bar for desktop -->
<!-- header style two End -->
<!-- End Top Header Area -->

<!-- Top To Scroll -->
<!-- End Top scroll -->
<!-- Start Hero Area -->
<section class="echo-hero-section">
    <div class="echo-hero">
        <div class="container">
            <div class="echo-full-hero-content">
                <div class="row gx-5">
                    <div class="col-xl-8 col-lg-7 col-md-12">
                        <div class="echo-hero-baner">
                            <div class="echo-hero-banner-main-img  img-transition-scale">
                                <a><img class="banner-image-one img-hover" src="assets/images/团队-4.png" alt="Echo" style="height: 600px"></a>
                            </div>
                            <h1 class="echo-hero-title text-capitalize font-weight-bold"><a class="title-hover">计算机科学与工程学院开放原子开源协会</a></h1>
                            <hr>
                            <p class="echo-hero-discription">
                                “在大学的时光里，追求你的激情和兴趣。发现并培养你热爱的事物，因为这将成为你前进道路上最强大的动力。”
                                “不要害怕面对挑战。每一次挑战都是成长的机会，能够帮助你发现自己更多的潜力。”
                                “大学生活注重自我管理，从时间管理到情绪调控，都是培养自律性格的关键。这将成为你事业成功的基石。”</p>
                            “与人为善，建立强大的社交网络。同学、教授、导师都是你未来发展道路上的重要资源。”
                            “最重要的一点是相信自己。你拥有无限的潜力和可能性，只要你愿意去追求和努力，未来必定光明而辉煌。”
                              --by Silent W </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-12">
                        <div class="echo-home-1-hero-area-top-story">
                            <h6>协会内涵</h6>
                            <div class="echo-top-story first">
                                <div class="echo-story-picture img-transition-scale">
                                    <a><img src="assets/images/团队-15.png" alt="Echo" class="img-hover"></a>
                                </div>
                                <div class="echo-story-text">
                                    <h4><a  class="title-hover">青春！永无止境，迎难而上</a></h4>
                                </div>
                            </div>
                            <div class="echo-top-story">
                                <div class="echo-story-picture img-transition-scale">
                                    <a ><img src="assets/images/团队合作理念.png" alt="Echo" class="img-hover" style="height: 100px"></a>
                                </div>
                                <div class="echo-story-text">
                                    <h4><a  class="title-hover">团队合作，默契交锋！</a></h4>
                                </div>
                            </div>
                            <div class="echo-top-story">
                                <div class="echo-story-picture img-transition-scale">
                                    <a ><img src="assets/images/团队合作难题.png" alt="Echo" class="img-hover" style="height: 100px"></a>
                                </div>
                                <div class="echo-story-text">
                                    <h4><a href="#" class="title-hover">共克实艰，砥砺前行！</a></h4>
                                </div>
                            </div>
                            <div class="echo-top-story">
                                <div class="echo-story-picture img-transition-scale">
                                    <a ><img src="assets/images/团队合作饼图.png" alt="Echo" class="img-hover" style="height: 100px"></a>
                                </div>
                                <div class="echo-story-text">
                                    <h4><a class="title-hover">培养身心，放飞自我！</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Hero Area -->

<!-- Start Latest News Slider (using Slick Slider version 1.8.1) -->
<section class="echo-latest-news-area">
    <div class="echo-latest-news-content">
        <div class="container">
            <div class="echo-be-slider-btn">
                <div class="echo-latest-nw-title">
                    <h4>协会新闻</h4>
                </div>
                <div class="echo-latest-news-next-prev-btn">
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
            <div class="echo-latest-news-full-content">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <?php
                        require_once('../../PhpSrc/Service/index_Massage.php');
                        $show= new \Show_News\index_Massage();
                        $showclass=$show->index_News();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Latest News Slider (using Slick Slider version 1.8.1) -->

<!-- Start Trending News Area -->
<section class="echo-trending-area">
    <div class="echo-trending-content">
        <div class="container">
            <h6>协会赛事</h6>
            <div class="echo-trending-full-content">
                <div class="row gx-6">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                       <?php
                       require_once('../../PhpSrc/Service/index_Massage.php');
                       $show= new \Show_News\index_Massage();
                       $showclass=$show->index_MatchSmall();
                       ?>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <?php
                        require_once('../../PhpSrc/Service/index_Massage.php');
                        $show= new \Show_News\index_Massage();
                        $showclass=$show->index_MatchMax();
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="echo-de-category-area">
    <div class="echo-de-category-area-content">
        <div class="container">
            <div class="echo-de-category-full-content">
                <div class="echo-de-category-title-btn">
                    <h4 class="text-capitalize">近期概要</h4>
                </div>
                <div class="row gx-5">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="echo-de-category-content echo-responsive-wd">
                            <h5 class="text-capitalize">协会新闻</h5>
                            <hr>
                            <?php
                            require_once('../../PhpSrc/Service/index_Massage.php');
                            $show= new \Show_News\index_Massage();
                            $showclass=$show->Show_News();
                            ?>
                            <div class="echo-de-category-show-more-btn">
                                <a href="userNews.php" class="text-capitalize echo-py-btn">Show more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="echo-de-category-content">
                            <h5 class="text-capitalize">协会公告</h5>
                            <hr>
                            <?php
                            require_once('../../PhpSrc/Service/user_Notice.php');
                            $show= new user_Notice();
                            $showclass=$show->Show_Notice();
                            ?>
                            <div class="echo-de-category-show-more-btn">
                                <a href="userNotice.php" class="text-capitalize echo-py-btn">Show more</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="echo-de-category-content">
                            <h5 class="text-capitalize">学生事务</h5>
                            <hr>
                            <?php
                            require_once('../../PhpSrc/Service/user_Affairs.php');
                            $show= new user_Affairs();
                            $showclass=$show->Show_Affairs();
                            ?>
                            <div class="echo-de-category-show-more-btn">
                                <a href="userAffairs.php" class="text-capitalize echo-py-btn">Show more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Trending News Area -->
<!-- End Popular News Area -->

<!-- Start Our Software Download -->

<!-- End Our Software Download -->


<!-- Start Footer Area -->
<!-- Start Footer Area -->
<footer class="echo-footer-area" id="footer">
    <div class="container">
        <div class="echo-row">
            <div class="echo-footer-content-1">
                <div class="echo-get-in-tuch">
                    <h4 class="text-capitalize">联系我们</h4>
                </div>
                <div class="echo-footer-address">
                    <span class="text-capitalize"><i class="fa-regular fa-phone"></i>110</span>
                    <span class="text-capitalize"><i class="fa-sharp fa-regular fa-envelope"></i>
                           1273774216@qq.com   </span>
                    <div class="echo-footer-social-media">
                    </div>
                </div>
            </div>
            <div class="echo-footer-content-2">
                <div class="echo-get-in-tuch">
                    <h4 class="text-capitalize">主要</h4>
                </div>
                <div class="echo-footer-most-popular">
                    <ul class="list-unstyled">
                        <li><a href="userNews.php">协会新闻</a></li>
                        <li><a href="userMatch.php">协会比赛</a></li>
                        <li><a href="userNotice.php">协会公告</a></li>
                        <li><a href="userAffairs.php">学生事务</a></li>
                        <li><a href="userSpace.php">参赛详情</a></li>
                    </ul>
                </div>
            </div>
            <div class="echo-footer-content-3">
                <div class="echo-get-in-tuch">
                    <h4 class="text-capitalize">帮助</h4>
                </div>
                <div class="echo-footer-help">
                    <ul class="list-unstyled">
                        <li><a href="userlogin/userlogin.php">登录账号</a></li>
                        <li><a href="userlogin/userretrieve.php">找回账号</a></li>
                        <li><a href="userlogin/userregister.php">注册账号</a></li>
                    </ul>
                </div>
            </div>
            </div>
        </div>
        <div class="echo-footer-copyright-area">
            <div class="copyright-area-inner" style="display: flex;justify-content: center">
                <div class="footer-logo"><a ><img src="assets/images/logo.png" alt="logo"></a></div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer Area -->
<!-- End Footer Area -->

<!-- Start Scricpt Area -->

<!--scroll top button-->
<button class="scroll-top-btn">
    <i class="fa-regular fa-angles-up"></i>
</button>
<!--scroll top button end-->

<div id="anywhere-home"></div>

<script src="assets/js/vendor/jquery.min.js" ></script>
<script src="assets/js/plugins/audio.js" ></script>
<script src="assets/js/vendor/bootstrap.min.js" ></script>
<script src="assets/js/vendor/swiper.js" ></script>
<script src="assets/js/vendor/metisMenu.min.js" ></script>
<script src="assets/js/plugins/audio.js" ></script>
<script src="assets/js/plugins/magnific-popup.js" ></script>
<script src="assets/js/plugins/resize-sensor.min.js" ></script>
<script src="assets/js/plugins/theia-sticky-sidebar.min.js" ></script>
<!-- main js file -->
<script src="assets/js/main.js" ></script>
<!-- End Footer Area -->

</body>

</html>
