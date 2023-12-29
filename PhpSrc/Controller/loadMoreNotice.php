<?php
require_once('../../PhpSrc/Service/Notice_index.php');
// 获取传递过来的 page 值
$response = array();
if (isset($_GET['page'])) {
    $page = intval($_GET['page'])+1;
    $news = new Notice_index();
    $news->ShowMassage($page);
} else {
    header("Location: error.php");
    exit();
}
?>