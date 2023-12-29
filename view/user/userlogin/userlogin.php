<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>登录界面</title>
    <link rel="icon" href="../assets/images/原子40x40.png">
    <meta name="description" content="particles.js is a lightweight JavaScript library for creating particles.">
    <meta name="author" content="Vincent Garreau" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" media="screen" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css"/>
    <link rel="stylesheet" type="text/css" href="../alert/GAlert/iconfont/iconfont.css">
    <link href="../alert/GAlert/jqAlert.css" rel="stylesheet" type="text/css">
    <script src="../alert/GAlert/jquery.min.js"></script>
    <script src="../alert/GAlert/jqAlert.js"></script>
</head>
<body>

<div id="particles-js">
    <div class="login">
        <div class="login-top">
            登录
        </div>
        <form method="post" action="../../../PhpSrc/Controller/logintest.php" onsubmit="return validateForm()">
        <div class="login-center clearfix">
            <div class="login-center-img"><img src="img/name.png"/></div>
            <div class="login-center-input">
                <input type="text"  placeholder="请输入您的学号" id="userSno" name="userSno"/>
                <div class="login-center-input-text">用户名</div>
            </div>
        </div>
        <div class="login-center clearfix">
            <div class="login-center-img"><img src="img/password.png"/></div>
            <div class="login-center-input">
                <input type="password"  placeholder="请输入您的密码" id="userpassword" name="userpassword" />
                <div class="login-center-input-text">密码</div>
            </div>
        </div>
        <button class="login-button" style="position: relative;left: 40px;top: -30px;border: none" type="submit">
           登录
        </button>
        </form>
        <div style="position: relative;left: 20%;top:0">
         <a href="userretrieve.php">忘记密码</a>
            <a href="userregister.php" style="padding-left: 30%">注册账号</a>
        </div>
    </div>
</div>

<!-- scripts -->
<script src="js/particles.min.js"></script>
<script src="js/app.js"></script>
<script>
    function validateForm() {
        var username = document.getElementById('userSno').value;
        var password = document.getElementById('userpassword').value;

        if (username.trim() === '' || password.trim() === '') {
            var options = {
                content: "请输入你的学号和密码",
                type: 'warning',
            };
            $.jqAlert(options);
            return false; // 阻止表单提交
        } else {
            fetch('../../../PhpSrc/Controller/logintest.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'userSno=' + encodeURIComponent(username) + '&userpassword=' + encodeURIComponent(password),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        var options = {
                            content: "登录成功",
                            type: 'success',
                        };
                        $.jqAlert(options);
                        setTimeout(function () {
                            window.location.href = '../userindex.php';
                        }, 1000);
                        // 这里可以进行页面跳转或其他操作
                    } else {
                        var options = {
                            content: data.message,
                            type: 'error',
                        };
                        $.jqAlert(options);
                    }
                })
                .catch(error => console.error('Error:', error));

            return false; // 阻止表单提交
        }
    }

</script>
</body>
</html>