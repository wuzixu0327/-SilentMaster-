<?php
// 检查是否存在 $_POST['hiddenInputValue'] 并且不为 null
if (isset($_POST['hiddenInputValue'])) {
    // 获取隐藏输入字段的值
    $hiddenInputValue = $_POST['hiddenInputValue'];
    require_once ('../Service/LookTeam.php');
    $lookTeam = new LookTeam();
    $lookTeam->look_Team($hiddenInputValue);
    // 在这里处理 $hiddenInputValue，可以进行进一步的操作，比如存入数据库等
    // 假设你想返回一些数据给前端

} else {
    // 如果 $_POST['hiddenInputValue'] 不存在或为 null，可以返回错误信息
    header("Location: error.php");
    exit();

}
?>
