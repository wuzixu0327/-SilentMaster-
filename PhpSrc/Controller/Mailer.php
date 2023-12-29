<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require_once ('../../PHPMailer-master/src/Exception.php');
require_once ('../../PHPMailer-master/src/PHPMailer.php');
require_once ('../../PHPMailer-master/src/SMTP.php');
$mail = new PHPMailer(true);
try {
    // 服务器设置
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // 可以设置为 0 关闭调试输出
    $mail->isSMTP();
    $mail->Host = 'smtp.qq.com';  // SMTP 服务器地址
    $mail->SMTPAuth = true;
    $mail->Username = '1273774216@qq.com'; // SMTP 账号
    $mail->Password = 'lmvcluwqtwpcjidd'; // SMTP 密码
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // 启用 TLS 加密，也可以使用 'PHPMailer::ENCRYPTION_SMTPS'
    $mail->Port = 587; // SMTP 端口号

    // 收件人
    $mail->setFrom('1273774216@qq.com', '伍涛'); // 发件人邮箱和姓名
    $mail->addAddress('3081441660@qq.com', '王志强'); // 收件人邮箱和姓名

    // 邮件内容
    $mail->isHTML(true); // 设置邮件格式为 HTML
    $mail->Subject = '你好';
    $mail->Body = '我是大帅比';

    $mail->send();
    echo '邮件发送成功';
} catch (Exception $e) {
    echo "邮件发送失败：{$mail->ErrorInfo}";
}
?>
