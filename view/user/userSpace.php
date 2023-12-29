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
    <link href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="Test/src/hystmodal.css">
    <link rel="stylesheet" href="Test/demos.css">
    <link rel="stylesheet" href="div.css">
    <link rel="stylesheet" type="text/css" href="alert/alert/mdialog.css">
</head>
<?php
session_start();
?>

<body class="innerpage">
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
                            <a class="logo-light" href="userindex.php" style="font-size: 80%"><img src="assets/images/原子40x40.png" alt="Echo">开放原子开源协会</a>
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
<!-- End Top Header Area -->

<!-- side bar for desktop -->
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
<!-- header style two End -->
<!-- End Top Header Area -->

<!-- start breadcrumb area -->
<!-- rts breadcrumba area start -->
<div class="echo-breadcrumb-area-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="echo-author-content">
                    <div class="echo-author-picture">
                        <img src="assets/images/团队.png" alt="Echo" style="width: 200px;height:200px;border-radius: 50px">
                    </div>
                    <div class="echo-author-info">
                        <h5 class="text-capitalize">我的团队</h5>
                        <p>你可以在下面进行查看我的队伍信息，查看队伍邀请码，退出队伍等相关信息</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- rts breadcrumba area end -->
<!-- end breadcrumb area -->


<section class="echo-hero-section inner">
    <div class="echo-hero">
        <div class="container">
            <div class="echo-full-hero-content">
                <div class="row gx-5 sticky-coloum-wrap">
                        <select id="selectBox_Show" class="form-select form-select-lg mb-6" style="width: 300px">
                            <option selected>请选择比赛</option>
                            <?php
                            if (isset($_SESSION['userSno'])) {
                                require_once('../../PhpSrc/Service/Match_infor.php');
                                $Match = new \Show_News\Match_infor();
                                $Match->selectMatch();
                                echo '<button type="button" style="width: 200px;left:80%;position:relative;background: #0a53be;height: 50px;"><p style="color: white" data-hystmodal="#modalForms">创建队伍</p></button>';
                            } else {
                                echo '<a href="userlogin/userlogin.php"><button type="button" style="width: 200px;left:80%;position:relative;background: #0a53be;height: 50px;"><p style="color: white" data-hystmodal="#modalForms">去登陆</p></button></a> ';
                            }
                            ?>
                        </select>
                </div>
            </div>
            <?php
            if (isset($_SESSION['userSno'])) {
                echo '<button type="button" style="width: 200px;left:60%;position:relative;background: #0a53be;height: 50px;top: -50px" data-hystmodal="#modalForms"><p style="color: white" data-hystmodal="#modalForms">创建队伍</p></button>';
                echo '<button type="button" style="width: 200px;left:60%;position:relative;background: #0a53be;height: 50px;top: -50px;margin-left: 20px" data-hystmodal="#modalForms2"><p style="color: white" data-hystmodal="#modalForms2">加入队伍</p></button>';
            } else {
                echo '<a href="userlogin/userlogin.php"><button type="button" style="width: 200px;left:60%;position:relative;background: #0a53be;height: 50px;top: -50px"><p style="color: white">请先登陆</p></button></a> ';
            }
            ?>
            <div id="resultContainer" style="display: flex; flex-direction: column; width: 1200px; background: #D9D9D9; margin-left: -30px;">
                <!-- 插入位置 -->
            </div>

        </div>
    </div>
</section>
<div class="hystmodal hystmodal--simple" id="modalForms" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window hystmodal__window--form" role="dialog" aria-modal="true">
            <button class="hystmodal__close" data-hystclose></button>
            <div class="hystmodal__styled">
                <div class="loginblock__h1">创建我的队伍</div>
                <form action="#" method="POST">
                    <div class="formitem">
                        <input type="text" name="TeamName" id="TeamName" placeholder="队伍名称" value="">
                    </div>
                    <div class="formitem">
                        <select id="selectBox_Join" class="form-select form-select-lg mb-6" style="width: 500px">
                            <option selected>请选择比赛</option>
                            <?php
                            require_once('../../PhpSrc/Service/Match_infor.php');
                            $Match = new \Show_News\Match_infor();
                            $Match->selectMatch();
                            ?>
                        </select>
                    </div>
                    <div class="formsubmit">
                        <button type="button" class="button" id="CreatButton">确定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="hystmodal hystmodal--simple" id="modalForms2" aria-hidden="true">
    <div class="hystmodal__wrap">
        <div class="hystmodal__window hystmodal__window--form" role="dialog" aria-modal="true">
            <button class="hystmodal__close" data-hystclose></button>
            <div class="hystmodal__styled">
                <div class="loginblock__h1">加入队伍</div>
                <form action="#" method="POST">
                    <div class="formitem">
                        <input type="text" name="Team_Code" placeholder="请输入队伍邀请码" value="">
                    </div>
                    <div class="formsubmit">
                        <button type="button" class="button" id="Joinbutton">确定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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
<button class="scroll-top-btn">
    <i class="fa-regular fa-angles-up"></i>
</button>
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
<!-- End Footer Area -->
<script src="Test/dist/hystmodal.min.js"></script>
<script type="text/javascript" src="alert/alert/zepto.min.js"></script>
<script type="text/javascript" src="alert/alert/mdialog.js"></script>

<script>
    const myModal = new HystModal({
        // for dynamic init() of modals
        // linkAttributeName: false,
        catchFocus: true,
        closeOnEsc: true,
        backscroll: true,
        beforeOpen: function(modal){
            console.log('Message before opening the modal');
            console.log(modal); //modal window object
        },
        afterClose: function(modal){
            console.log('Message after modal has closed');
            console.log(modal); //modal window object

            //If Youtube video inside Modal, close it on modal closing
            let videoframe = modal.openedWindow.querySelector('iframe');
            if(videoframe){
                videoframe.contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}', '*');
            }
        },
    });
    // for dynamic init() of modals
    // myModal.config.linkAttributeName = 'data-hystmodal';
    // myModal.init();
</script>
<script>
    // 获取<select>元素
    var selectBox = document.getElementById("selectBox_Show");

    // 监听多选框的变化事件
    selectBox.addEventListener("change", function() {
        // 获取所有选中的选项
        var selectedOptions = [];
        for (var i = 0; i < selectBox.options.length; i++) {
            if (selectBox.options[i].selected) {
                selectedOptions.push(selectBox.options[i].value);
            }
        }

        // 使用 AJAX 发送请求到服务器
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // 请求成功，可以在这里处理返回的数据
                // 将返回的数据插入到页面中
                var responseData = xhr.responseText;
                insertDataIntoPage(responseData);
            }
        };

        // 假设后端接口为 "process_selected_values.php"
        xhr.open("POST", "../../PhpSrc/Controller/userselectjointeam.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // 将选中的值作为参数发送到服务器
        xhr.send("selectedValues=" + encodeURIComponent(selectedOptions.join(',')));
    });

    // 插入数据到页面的函数
    function insertDataIntoPage(data) {
        // 假设有一个具有 id 为 "resultContainer" 的元素用于插入数据
        var resultContainer = document.getElementById("resultContainer");

        // 将返回的数据插入到页面中
        resultContainer.innerHTML = data;
    }
</script>

<script>
    function getHiddenInputValue_Delete() {
        var hiddenInputValue = document.getElementById('hiddenInput').value;
        fetch('../../PhpSrc/Controller/Exit_Team.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'hiddenInputValue=' + encodeURIComponent(hiddenInputValue),
        })
            .then(response => response.text())
            .then(data => {
                // 将返回的数据直接复制到剪贴板
                new TipBox({ type: 'tip', str: data, hasBtn: true });
            })
            .catch(error => {
                // 处理错误
                console.error(error);
            });
    }
</script>
<script>
    function getHiddenInputValue_Code() {
        var hiddenInputValue = document.getElementById('hiddenInput').value;
        fetch('../../PhpSrc/Controller/Copy_Code.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'hiddenInputValue=' + encodeURIComponent(hiddenInputValue),
        })
            .then(response => response.text())
            .then(data => {
                // 将返回的数据直接复制到剪贴板
                copyToClipboard(data);
                new TipBox({ type: 'tip', str: '已复制到粘贴板', hasBtn: true });
            })
            .catch(error => {
                // 处理错误
                console.error(error);
            });
    }

    function copyToClipboard(text) {
        // 创建一个临时的textarea元素，并将要复制的内容放入其中
        var tempTextarea = document.createElement("textarea");
        tempTextarea.value = text;

        // 将textarea添加到文档中
        document.body.appendChild(tempTextarea);

        // 选中textarea中的内容
        tempTextarea.select();
        tempTextarea.setSelectionRange(0, 99999); /* For mobile devices */

        // 将内容复制到剪贴板
        document.execCommand("copy");

        // 移除临时创建的textarea元素
        document.body.removeChild(tempTextarea);

        // 提示用户已成功复制（可选）
    }
</script>

<script>
    function getHiddenInputValue_User() {
        var hiddenInputValue = document.getElementById('hiddenInput').value;
        fetch('../../PhpSrc/Controller/userSpace_lookTeam.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'hiddenInputValue=' + encodeURIComponent(hiddenInputValue),
        })
            .then(response => response.text())
            .then(data => {
                // 处理后端返回的数据
                var resultContainer = document.getElementById("resultContainer");

                // 将返回的数据插入到页面中
                resultContainer.innerHTML = data;
            })
            .catch(error => {
                // 处理错误
                console.error(error);
            });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 监听“创建”按钮的点击事件
        document.getElementById('CreatButton').addEventListener('click', function () {
            var formData = new FormData();
            formData.append('userCreat', document.querySelector('input[name="TeamName"]').value);
            formData.append('selectedMatch', document.getElementById('selectBox_Join').value);

            // 使用 fetch 发送数据到服务器
            fetch('../../PhpSrc/Controller/CreatTeam.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    // 请求成功，可以在这里处理返回的数据
                    new TipBox({ type: 'tip', str: data, hasBtn: true });
                })
                .catch(error => {
                    // 处理错误
                    new TipBox({ type: 'error', str: data, hasBtn: true });
                });
        });

        // 监听“加入”按钮的点击事件
        document.getElementById('Joinbutton').addEventListener('click', function () {
            // 获取输入的队伍邀请码
            var teamCode = document.querySelector('input[name="Team_Code"]').value;

            // 使用 Fetch API 发送 AJAX 请求
            fetch('../../PhpSrc/Controller/JoinTeam.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'userjoin=' + encodeURIComponent(teamCode),
            })
                .then(response => response.text())
                .then(data => {
                    // 处理返回的数据，这里可以根据实际需求进行操作
                    new TipBox({ type: 'tip', str: data, hasBtn: true });
                })
                .catch(error => {
                    // 处理错误
                    new TipBox({ type: 'error', str: data, hasBtn: true });
                });
        });
    });
</script>

</body>

</html>

