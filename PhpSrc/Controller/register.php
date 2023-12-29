
<?php
// register.php
require_once ('../Service/register.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取表单数据
    $userSno = $_POST["userSno"];
    $userName = $_POST["userName"];
    $useremail = $_POST["useremail"];
    $code = $_POST["code"];
    $password = $_POST["password"];
    session_start();
// 获取存储在会话中的验证码
    $verificationCode = $_SESSION['verificationCode'];
    // 在这里可以进行进一步的验证和处理
    // 例如，检查密码是否匹配，验证验证码等等
    if($code==$verificationCode)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $flag= new \Show_News\register();
        if($flag->Test($userSno,$useremail)) {
            $register = new \Show_News\register();
            $userid = $register->register($userName, $userSno, $useremail, $hashedPassword);
            if ($userid != 0) {
                $_SESSION['userSno'] = $userSno;
// 设置过期时间为1小时（3600秒）
                $_SESSION['expire_time'] = time() + 3600;
                echo json_encode(["success" => true, "message" => "注册成功"]);

            }
        }
        else
        {
            echo json_encode(["success" => false, "message" => "用户已经存在，请登录或者找回密码"]);
            exit();
        }
    }
    else
    {
        echo json_encode(["success" => false, "message" => "验证码有误"]);
    }
} else {
    // 如果不是通过 POST 请求访问，可以做一些处理，比如跳转到错误页面
    header("Location: error.php");
    exit();
}
?>
