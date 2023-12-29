<?php
require_once('../../PhpSrc/Service/Affairs_index.php');
// 获取传递过来的 page 值
if (isset($_GET['page'])) {
    $page = intval($_GET['page'])+1;

    $news = new Affairs_index();
    $news->ShowMassage($page);
    // 获取下一次点击所需的 page 值
    $nextPage = $page + 1;
    // 判断是否有下一页数据，如果有，返回下一页的 page 值和新闻数据
} else {
    header("Location: error.php");
    exit();
}

?>
<?php
