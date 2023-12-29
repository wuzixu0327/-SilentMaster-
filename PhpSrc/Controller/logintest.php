<?php
require_once('../Service/Testlogin.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["userSno"]) ? $_POST["userSno"] : "";
    $password = isset($_POST["userpassword"]) ? $_POST["userpassword"] : "";
        // ...
    $login=new Testlogin();
    $loginflag=$login->loginTest($username,$password);
        // 假设验证成功
        // 返回成功信息
    $userFlag=$login->userFlag($username);
    if($userFlag) {
        if ($loginflag) {
            session_start();
            $_SESSION['userSno'] = $username;
            // 设置过期时间为1小时（3600秒）
            $_SESSION['expire_time'] = time() + 3600;
            echo json_encode(["success" => $loginflag, "message" => "登录成功", "username" => $username]);

        }
        else{
            echo json_encode(["success" => $loginflag, "message" => "密码错误", "username" => $username]);
        }
    }
    else{

        echo json_encode(["success" => $userFlag, "message" => "账号已被冻结，请联系管理员", "username" => $username]);
    }


}
else{
    header("Location: error.php");
    exit();
}
?>
