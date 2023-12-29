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


</head>
<?php
session_start(); // 确保会话已启动
?>
<body class="innerpage">
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
                <li class="menu-item"><a class="main mobile-menu-link" href="userlogin/userlogin.php">"登录账号</a></li>
            </ul>
        </nav>
    </div>
    <!-- mobile menu area end -->
</div>
<!-- header style two End -->
<!-- End Top Header Area -->

<div class="echo-breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- bread crumb inner wrapper -->
                <div class="breadcrumb-inner text-center">
                    <div class="meta">
                        <a href="userindex.php" class="prev">开放原子开源协会</a>
                    </div>
                    <h1 class="title">协会公告</h1>
                </div>
                <!-- bread crumb inner wrapper end -->
            </div>
        </div>
    </div>
</div>
<!-- rts breadcrumba area end -->
<!-- end breadcrumb area -->

<section class="echo-hero-section inner">
    <div class="echo-hero">
        <div class="container">
            <div class="echo-full-hero-content inner-category-1">
                <div class="row gx-5 sticky-coloum-wrap">
                    <div class="col-xl-8 col-lg-7 col-md-12">
                        <div class="echo-hero-baner">
                            <?php
                            if (!empty($_GET['id'])) {
                                // 'id' 参数存在且不为空
                                $id = $_GET['id'];
                                require_once('../../PhpSrc/Service/user_Notice.php');
                                $show= new user_Notice();
                                $showclass=$show->NoticeShow($id);
                            } else {
                                // 'id' 参数不存在或为空
                                echo '没有数据';
                            }

                            ?>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5 col-md-12 sticky-coloum-item">
                        <div class="echo-right-ct-1">
                            <div class="echo-popular-hl-img">
                                <div class="echo-home-2-title">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="echo-home-2-main-title">
                                                <h5 class="text-capitalize text-center">相关信息</h5>
                                                <div class="main">
                                                    <div class="main-box">
                                                        <?php
                                                        if (!empty($_GET['id'])) {
                                                            // 'id' 参数存在且不为空
                                                            $id = $_GET['id'];
                                                            require_once('../../PhpSrc/Service/user_Notice.php');
                                                            $show= new user_Notice();
                                                            $showclass=$show->Notice_Massage($id);
                                                        } else {
                                                            // 'id' 参数不存在或为空
                                                            echo '没有数据';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Start Footer Area -->
<!-- Start Footer Area -->
<footer class="echo-footer-area" id="footer">
    <div class="container">
        <div class="echo-row">
            <div class="echo-footer-content-1">
                <div class="echo-get-in-tuch">
                    <h4 class="text-capitalize">Get In Touch</h4>
                </div>
                <div class="echo-footer-address">
                    <span class="text-capitalize"><i class="fa-regular fa-map"></i> 255 Sheet, New Avanew, NY</span>
                    <span class="text-capitalize"><i class="fa-regular fa-phone"></i> (00) 236 123 456 88</span>
                    <span class="text-capitalize"><i class="fa-sharp fa-regular fa-envelope"></i>
                            info@demomail.com</span>
                    <div class="echo-footer-social-media">
                        <a href="#">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#">
                            <i class="fa-brands fa-twitter"></i>
                        </a>
                        <a href="#">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        <a href="#">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="echo-footer-content-2">
                <div class="echo-get-in-tuch">
                    <h4 class="text-capitalize">Most Popular</h4>
                </div>
                <div class="echo-footer-most-popular">
                    <ul class="list-unstyled">
                        <li><a href="#">Business</a></li>
                        <li><a href="#">Life Style</a></li>
                        <li><a href="#">Word</a></li>
                        <li><a href="#">Fashion</a></li>
                        <li><a href="#">Politics</a></li>
                        <li><a href="#">Travels</a></li>
                        <li><a href="#">Tech</a></li>
                        <li><a href="#">Sports</a></li>
                        <li><a href="#">Video</a></li>
                        <li><a href="#">Game</a></li>
                    </ul>
                </div>
            </div>
            <div class="echo-footer-content-3">
                <div class="echo-get-in-tuch">
                    <h4 class="text-capitalize">Help</h4>
                </div>
                <div class="echo-footer-help">
                    <ul class="list-unstyled">
                        <li><a href="about.html">About</a></li>
                        <li><a href="#">Media Kit</a></li>
                        <li><a href="#">Advertise</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="echo-footer-content-4">
                <div class="echo-get-in-tuch">
                    <h4 class="text-capitalize">Newsletter</h4>
                </div>
                <div class="echo-footer-news-text">
                    <p>Register now to get latest updates on promotion & coupons.</p>
                </div>
                <div class="echo-subscribe-box-button">
                    <form action="POST">
                        <div class="echo-subscribe-input-fill">
                            <svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.8" d="M14.4414 11.6674C14.4402 11.8345 14.3734 11.9944 14.2553 12.1127C14.1371 12.2309 13.9773 12.2979 13.8101 12.2993H2.34541C2.17792 12.2991 2.01736 12.2325 1.89899 12.114C1.78062 11.9955 1.71413 11.8348 1.71413 11.6674V11.0265H13.1687V3.58109L8.07777 8.16291L1.71413 2.43564V1.48109C1.71413 1.31232 1.78118 1.15045 1.90052 1.03111C2.01986 0.911772 2.18172 0.844727 2.3505 0.844727H13.805C13.9738 0.844727 14.1357 0.911772 14.255 1.03111C14.3744 1.15045 14.4414 1.31232 14.4414 1.48109V11.6674ZM3.26304 2.11745L8.07777 6.45109L12.8925 2.11745H3.26304ZM0.441406 8.48109H5.53232V9.75382H0.441406V8.48109ZM0.441406 5.29927H3.62322V6.572H0.441406V5.29927Z" fill="white" />
                            </svg>
                            <input type="email" placeholder="Enter your email" required>
                        </div>
                        <div class="echo-footer-area-subscribe-button">
                            <a href="#" class="echo-py-btn-border text-capitalize">subscribe</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="echo-footer-copyright-area">
            <div class="copyright-area-inner">
                <div class="footer-logo"><a href="index.html"><img src="assets/images/home-1/site-logo/footer-logo-1.svg" alt="logo"></a></div>
                <div class="copyright-content">
                    <h5 class="title">© Copyright 2023 By <a href="http://www.bootstrapmb.com">bootstrapMB</a></h5>
                </div>
                <div class="select-area">
                    <select name="lang" id="lang">
                        <option value="english">English</option>
                        <option value="bengali">Bengali</option>
                        <option value="arabic">Arabic</option>
                        <option value="hindi">Hindi</option>
                        <option value="urdu">Urdu</option>
                        <option value="french">French</option>
                        <option value="tamil">Tamil</option>
                        <option value="marathi">Marathi</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End Footer Area -->
<!-- End Footer Area -->

<!-- Start Scricpt Area -->

<!--scroll top button-->
<!--scroll top button end-->

<div id="anywhere-home"></div>

<script src="assets/js/vendor/jquery.min.js" defer></script>
<script src="assets/js/plugins/audio.js" defer></script>
<script src="assets/js/vendor/bootstrap.min.js" defer></script>
<script src="assets/js/vendor/swiper.js" defer></script>
<script src="assets/js/vendor/metisMenu.min.js" defer></script>
<script src="assets/js/plugins/audio.js" defer></script>
<script src="assets/js/plugins/magnific-popup.js" defer></script>
<script src="assets/js/plugins/resize-sensor.min.js" defer></script>
<script src="assets/js/plugins/theia-sticky-sidebar.min.js" defer></script>

<!-- main js file -->
<script src="assets/js/main.js" defer></script>
</body>
</html>

