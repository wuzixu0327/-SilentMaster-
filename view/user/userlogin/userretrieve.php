<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>找回密码</title>
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
    <div class="login" style="height: 550px;top: 400px">
        <div class="login-top">
            找回密码
        </div>
        <form method="post" action="../../../PhpSrc/Controller/retrieve.php" onsubmit="return validateForm()">
            <div class="login-center clearfix">
                <div class="login-center-img"><img src="img/name.png"/></div>
                <div class="login-center-input">
                    <input type="text"  placeholder="请输入你的学号" id="userSno" name="userSno"/>
                    <div class="login-center-input-text">学号</div>
                </div>
            </div>
            <div class="login-center clearfix">
                <div class="login-center-img"><img src="img/yanzhengma.png"/></div>
                <div class="login-center-input" style="display: flex;align-items: center">
                    <input type="text"  placeholder="请输入验证码" id="code" name="code" />
                    <button type="button" style="display: flex; align-items: center; justify-content: center; position: relative; width: 50px; height: 30px; border: none; top: -25px" class="login-button" onclick="getEmailAddress()" id="getEmailButton">
                        获取
                    </button>
                    <div class="login-center-input-text">验证码</div>
                </div>
            </div>
            <div class="login-center clearfix">
                <div class="login-center-img"><img src="img/password.png"/></div>
                <div class="login-center-input">
                    <input type="password"  placeholder="输入密码" id="password" name="password" />
                    <div class="login-center-input-text">密码</div>
                </div>
            </div>
            <div class="login-center clearfix">
                <div class="login-center-img"><img src="img/password.png"/></div>
                <div class="login-center-input">
                    <input type="password"  placeholder="确认密码" id="Rpassword" name="Rpassword" />
                    <div class="login-center-input-text">确认密码</div>
                </div>
            </div>
            <button class="login-button" style="position: relative;left: 40px;top: -50px;border: none" type="submit">
                确定
            </button>
        </form>
        <div style="position: relative;left: 20%;top:0">
            <a href="userlogin.php">返回登录</a>
            <a href="userregister.php" style="padding-left: 30%">注册账号</a>
        </div>
    </div>
</div>

<!-- scripts -->
<script src="js/particles.min.js"></script>
<script src="js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../alert/GAlert/jqAlert.js"></script>
<script>
    function validateForm() {
        var userSno = document.getElementById('userSno').value;
        var code = document.getElementById('code').value;
        var password = document.getElementById('password').value;
        var Rpassword = document.getElementById('Rpassword').value;

        if (userSno.trim() === '') {
            var options1 = {
                content: "请输入你的学号",
                type: 'warning',
            };
            $.jqAlert(options1);
            return false;
        }
        if (password.trim().length < 10) {
            var options10 = {
                content: "密码至少需要包含10个字符",
                type: 'warning',
            };
            $.jqAlert(options10);
            return false;
        }
        if (password!==Rpassword) {
            var options2 = {
                content: "两次密码不同请检查",
                type: 'error',
            };
            $.jqAlert(options2);
            return false;
        }
        if (password.trim()===''||Rpassword.trim()==='') {
            var options3 = {
                content: "请输入密码和确认密码",
                type: 'warning',
            };
            $.jqAlert(options3);
            return false;
        }
        if (code.trim() === '') {
            var options4 = {
                content: "请输入验证码",
                type: 'warning',
            };
            $.jqAlert(options4);
            return false;
        }
        else {
            var formData = new URLSearchParams();
            formData.append('userSno', userSno);
            formData.append('code', code);
            formData.append('password', password);
            // 使用 fetch 发送 POST 请求
            fetch('../../../PhpSrc/Controller/retrieve.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        var options = {
                            content: "找回成功",
                            type: 'success',
                        };
                        $.jqAlert(options);
                        setTimeout(function () {
                            window.location.href = '../userlogin/userlogin.php';
                        }, 1000);
                    } else {
                        var options = {
                            content: data.message,
                            type: 'error',
                        };
                        $.jqAlert(options);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // 在这里处理错误，比如显示一个错误提示
                });

            return false; // 阻止表单提交
        }
        // 如果需要执行其他验证，可以在这里添加更多的条件
    }
</script>
<script>
    var canClick = true; // 在脚本开头声明一次
    var remainingTime = 60; // 初始剩余时间

    function getEmailAddress() {
        if (canClick) {
            var Sno = document.getElementById('userSno').value.trim();

            if (Sno !== '') {
                // 使用 fetch 发送数据
                fetch('../../../PhpSrc/Controller/yanzhengma.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ Sno }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            var optionss = {
                                content: "验证码发送成功，请查收",
                                type: 'success',
                            };
                            $.jqAlert(optionss);
                        } else {
                            var options2 = {
                                content: "验证码发送失败",
                                type: 'error',
                            };
                            $.jqAlert(options2);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });

                // 禁用按钮
                var optionss = {
                    content: "验证码发送成功，请查收",
                    type: 'success',
                };
                $.jqAlert(optionss);
                canClick = false;

                // 显示倒计时
                updateButtonText(remainingTime);

                // 1秒后开始计时
                var timer = setInterval(function () {
                    remainingTime--;

                    if (remainingTime <= 0) {
                        clearInterval(timer);
                        canClick = true;
                        remainingTime = 60;
                        document.getElementById('getEmailButton').innerText = '获取';
                    } else {
                        updateButtonText(remainingTime);
                    }
                }, 1000);
            } else {
                var options = {
                    content: "请输入学号",
                    type: 'error',
                };
                $.jqAlert(options);
            }
        }
    }

    function updateButtonText(time) {
        document.getElementById('getEmailButton').innerText = time + 's';
    }
</script>
</body>
</html>
