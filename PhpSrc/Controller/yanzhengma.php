<?php
// your_backend_endpoint.php
use Show_News\Mailer;

require_once ('../../PhpSrc/Service/Mailer.php');
require_once ('../../PhpSrc/Service/retrieveTest.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取前端发送的数据
    $requestData = json_decode(file_get_contents("php://input"), true);
    if ($requestData && isset($requestData['useremail'])) {
        $useremail = $requestData['useremail'];
        $sessionTimeout = 10 * 60; // 10min
        session_set_cookie_params($sessionTimeout);
        ini_set('session.gc_maxlifetime', $sessionTimeout);
        session_start();
        // 在这里可以添加生成验证码和发送邮件的逻辑
        // 以下为示例代码
        $verificationCode = generateVerificationCode();
        $_SESSION['verificationCode'] = $verificationCode;
        $Mailer = new Mailer();
//    $success = sendVerificationEmail($useremail, $verificationCode);
        $success = $Mailer->Mailer($useremail, $verificationCode);
        // 返回结果给前端
        echo json_encode(['success' => $success]);;

    }
    if($requestData && isset($requestData['Sno'])){
        $userSno = $requestData['Sno'];
        $flag= new retrieveTest();
        $email=$flag->selectUserEmail($userSno);
        $sessionTimeout = 10 * 60; // 10min
        session_set_cookie_params($sessionTimeout);
        ini_set('session.gc_maxlifetime', $sessionTimeout);
        session_start();
        // 在这里可以添加生成验证码和发送邮件的逻辑
        // 以下为示例代码
        $verificationCode = generateVerificationCode();
        $_SESSION['verificationCode'] = $verificationCode;
        $Mailer = new Mailer();
        $success = $Mailer->Mailer($email, $verificationCode);
    }
    else {
        // 如果不是通过 POST 请求访问，可以做一些处理，比如跳转到错误页面
        header("Location: error.php");
        exit();
    }
}
function generateVerificationCode() {
    // 生成验证码的逻辑，例如随机生成一个数字或字符串
    return rand(1000, 9999);
}
?>
