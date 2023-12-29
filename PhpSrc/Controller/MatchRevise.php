<?php
require_once('../PhpMysql/SelectMatch.php');
require_once('../../PhpSrc/interface/Match_Edit.php');
require_once('../../PhpSrc/Controller/Match_Revise.php');
// 将相同的代码块提取为函数
function redirectTo($message) {
    if(isset($_SERVER['HTTP_REFERER'])){
        $url=$_SERVER['HTTP_REFERER'];
    }
    echo "<script>alert('$message');window.location.href='$url';</script>";
    exit();
}

// 处理 POST 请求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["checkbox"])) {
        $selectedOptions = $_POST["checkbox"];
        $type = $_POST['News_choose1'];
        if ($type == 'del_all') {
            $deleteSuccess = true;
            foreach ($selectedOptions as $option) {
                $Delete = new Match_Revise();
                $Deleteflag=$Delete->DeleteFlag($option);
                $deleteSuccess = $Deleteflag ? $Delete->Match_Delete($option) : false;
            }
            // 根据变量的值输出相应的 JavaScript 代码
            if ($deleteSuccess) {
                redirectTo("赛事删除成功！", "../../view/admin/AdminMatch.php");
            } else {
                redirectTo("赛事删除失败，请先删除所有与赛事相关的参赛队伍", "../../view/admin/AdminMatch.php");
            }
        }
        else{
            redirectTo("请选择需要执行的操作", "../../view/admin/AdminMatch.php");
        }
    }
    if (isset($_POST["site_name"])&&isset($_POST["site_massage"])) {
        // 表单包含数据，执行相应的操作
        $Edit=$_COOKIE['EidCookie'];
        $site_name = $_POST['site_name'];
        $site_title = $_POST['site_title'];
        $site_newtime = $_POST['site_newtime'];
        $site_oldtime = $_POST['site_oldtime'];
        $site_file = $_FILES['site_file'];
        $site_closed = $_POST['site_closed'];
        $site_person = $_POST['site_person'];
        $site_massage = $_POST['site_massage'];
        if($_FILES['site_file']['error'] === UPLOAD_ERR_OK){
            $targetFile = 'matchinformation/' . basename($site_file["name"]);
            move_uploaded_file($site_file["tmp_name"], $targetFile);
        }
        else{
            $targetFile=null;
        }
        if($site_closed==0)
        {
            $site_person=1;
        }
        $obj=new Match_Revise();
        if($obj->Match_Edit($Edit,trim($site_name),trim($site_title),$site_newtime,$site_oldtime,$targetFile,$site_closed,$site_person,$site_massage)){
            redirectTo("数据更新成功！", "../../view/admin/AdminMatch.php");
        }
        else{
             redirectTo("数据更新失败", "../../view/admin/AdminMatch.php");
        }
    }
    if (isset($_POST['data'])) {
        $SelectName = $_POST['data'];
        $Select = new SelectMatch();
        $ShowSelectNews = $Select->Show_Match($SelectName);
    }


}

// 处理 GET 请求
// 处理 GET 请求
if (isset($_GET['id'])) {
    try {
        $DeleteID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $Delete = new Match_Revise();
        // 处理异常
        $Deleteflag=$Delete->DeleteFlag($DeleteID);
        if ($Deleteflag) {
            $Delete->Match_Delete($DeleteID);
            redirectTo("赛事删除成功！", "../../view/admin/AdminMatch.php");
        }
        redirectTo("赛事删除失败，请先删除所有与赛事相关的参赛队伍", "../../view/admin/AdminMatch.php");
    } catch (Exception $e) {
        echo "接口调用失败：" . $e->getMessage();
        // 可以在此处记录异常信息到日志文件或者进行其他处理
    }
}


if (isset($_GET['Eid'])) {
    $cookieValue = $_GET['Eid'];
    setcookie("EidCookie", $cookieValue, time() + 3600, "/", "", true, true); // 设置为只能通过 HTTPS 连接传输
    header("Location: ../../view/admin/Match_Edit.php");
    exit;
}

