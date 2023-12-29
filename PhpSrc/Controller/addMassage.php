<?php
namespace PhpSrc;

use Add_Affairs;
use Add_Match;
use Add_News;
use Add_Notice;

// 获取POST数据
$site_name = $_POST['site_name'];
$site_title = $_POST['site_title'];
$site_newtime = $_POST['site_newtime'];
$site_oldtime = $_POST['site_oldtime'];
$site_file = $_FILES['site_file'];
$site_closed = $_POST['site_closed'];
$site_person = $_POST['site_person'];
$site_massage = $_POST['site_massage'];
$news_title = $_POST['news_title'];
$news_href = $_FILES['news_href'];
$news_massage = $_POST['news_massage'];
$AnountTiltle = $_POST['AnountTiltle'];
$AnounMassage = $_POST['AnounMassage'];
$student_title = $_POST['student_title'];
$student_massage = $_POST['student_massage'];
// 函数用于显示警告并进行页面重定向
function showAlertAndRedirect($message) {
    if(isset($_SERVER['HTTP_REFERER'])){
        $url=$_SERVER['HTTP_REFERER'];
    }
    echo "<script>alert('$message');window.location.href='$url';</script>";
    exit();
}

// 检查输入是否为中文
function isChinese($input) {
    return preg_match("/^[\x{4e00}-\x{9fa5}]+$/u", $input);
}

// 检查输入是否为数字
function isNumeric($input) {
    return preg_match("/^[0-9]+$/", $input);
}

// 检查日期格式
function isValidDate($date) {
    return preg_match("/^\d{4}-\d{2}-\d{2}$/", $date);
}

// 执行添加比赛信息
function addCompetition($site_name, $site_title, $site_closed, $site_person,$site_file,$site_newtime, $site_oldtime, $site_massage) {
    // 添加比赛信息的逻辑
        require_once('../PhpMysql/Add_Match.php');
        $newsclass = new Add_Match();
        $newsclass->addMatch($site_name,$site_title,$site_newtime,$site_oldtime,$site_file,$site_closed,$site_person,$site_massage);

}

// 执行添加新闻操作
function addNews($news_title, $news_href, $news_massage) {
    // 获取上传的临时文件路径
    require_once('../PhpMysql/Add_News.php');
    // 调用添加新闻的方法
    $newsclass = new Add_News();
    $newsclass->addNews($news_title, $news_href, $news_massage);
}

function addNotice($AnountTiltle, $AnounMassage)
{
    require_once('../PhpMysql/Add_Notice.php');
    $noticeclass = new Add_Notice();
    $noticeclass->addNotice($AnountTiltle,$AnounMassage);
}

function addStudentAffairs($student_title, $student_massage) {
    // 添加学生事务操作的逻辑
    require_once('../PhpMysql/Add_Affairs.php');
    $affairsclass = new Add_Affairs();
    $affairsclass->addNotice($student_title,$student_massage);
}

// 主逻辑开始

if (!isChinese($site_title) && $site_title != null) {
    showAlertAndRedirect("输入的机构名只能中文，请检查信息", "/../../suse_web/view/admin/Adminindex.php");
}

if (!isValidDate($site_newtime) && $site_newtime != null) {
    showAlertAndRedirect("输入的起始时间只能为年月日，请检查信息", "/../../suse_web/view/admin/Adminindex.php");
}

if (!isValidDate($site_oldtime) && $site_oldtime != null) {
    showAlertAndRedirect("输入的截止时间只能为年月日，请检查信息", "/../../suse_web/view/admin/Adminindex.php");
}
if(!isNumeric(trim($site_person))&&$site_person!=null)
{
    showAlertAndRedirect("人数只能为小于10的数","/../../suse_web/view/admin/Adminindex.php");
}


if ($site_person != null && $site_newtime != null && $site_oldtime != null && $site_name != null && $site_title != null && $site_closed != null) {
    if ($site_massage != null&&$site_closed==1) {
        addCompetition($site_name, $site_title, $site_closed, $site_person, $site_file,$site_newtime, $site_oldtime, $site_massage);
    }
    if($site_massage !=null&&$site_closed==0)
    {
        addCompetition($site_name, $site_title, $site_closed, 1, $site_file,$site_newtime, $site_oldtime, $site_massage);
    }
} elseif ($news_title != null && $news_massage != null) {
    addNews($news_title,$news_href,$news_massage);
} elseif ($AnountTiltle != null && $AnounMassage != null) {
    addNotice($AnountTiltle, $AnounMassage);
} elseif ($student_title != null && $student_massage != null) {
    addStudentAffairs($student_title, $student_massage);
} else {
    showAlertAndRedirect("请输入完整信息", "/../../suse_web/view/admin/Adminindex.php");
}
?>
