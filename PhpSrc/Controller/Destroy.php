<?php
// 启动会话
session_start();

// 检查用户是否已登录，您可以根据您的会话逻辑进行调整
if (isset($_SESSION['userSno'])) {
    // 销毁会话
    session_destroy();

    // 可以在这里添加其他需要执行的操作

    // 重定向到其他页面或显示消息

// 输出 JavaScript 代码，实现历史记录回退
    echo '<script>';
    echo 'window.history.back();';
    echo '</script>';
    exit; // 确保脚本终止执行，避免继续输出其他内容


} else {
    // 用户未登录的处理逻辑
    // 可以重定向到登录页面或其他逻辑
    header("Location: login.php");
    exit();
}
?>
