<?php
require_once('../Service/retrieveTest.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取表单数据
    $userSno = $_POST["userSno"];
    $code = $_POST["code"];
    $password = $_POST["password"];
    session_start();
// 获取存储在会话中的验证码
    $verificationCode = $_SESSION['verificationCode'];
    // 在这里可以进行进一步的验证和处理
    // 例如，检查密码是否匹配，验证验证码等等
    if($code==$verificationCode)
    {
            $retrieve= new retrieveTest();
            $retrieveflag = $retrieve->retrieve($userSno,$password);
            if ($retrieveflag) {
                $_SESSION['userSno'] = $userSno;
// 设置过期时间为1小时（3600秒）
                $_SESSION['expire_time'] = time() + 3600;
                echo json_encode(["success" => true, "message" => "操作成功"]);
            }
           else
           {
            echo json_encode(["success" => false, "message" => "操作失败"]);
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