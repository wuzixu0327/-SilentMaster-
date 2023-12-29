<?php
require_once('../../PhpSrc/Service/News_index.php');
// 获取传递过来的 page 值
if (isset($_GET['page'])) {
    $page = intval($_GET['page'])+1;

    $news = new News_index();
    $news->ShowMassage($page);

    // 获取下一次点击所需的 page 值
    $nextPage = $page + 1;
} else {
    header("Location: error.php");
    exit();
}

?>
