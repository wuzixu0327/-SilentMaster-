<?php
function redirectTo($message) {
    if(isset($_SERVER['HTTP_REFERER'])){
        $url=$_SERVER['HTTP_REFERER'];
    }
    echo "<script>alert('$message');window.location.href='$url';</script>";
    exit();
}

if (isset($_POST["checkbox"])) {
    require_once('../../PhpSrc/Service/Match_infor.php');
    $selectedOptions = $_POST["checkbox"];
   if(isset($_POST['Teamop']))
   {
       $type=$_POST['Teamop'];
   }
    if ($type == 'del_all') {
        $deleteSuccess = true;
        foreach ($selectedOptions as $option) {
            $Delete = new \Show_News\Match_infor();
            $Deleteflag=$Delete->DeleteFlag($option);
            $deleteSuccess = $Deleteflag ? $Delete->Delete($option) : false;
        }
        // 根据变量的值输出相应的 JavaScript 代码
        if ($deleteSuccess) {
            redirectTo("队伍删除成功!", "../../view/admin/AdminTeam.php");
        } else {
            redirectTo("队伍删除失败，请删除队伍内所有参赛人员！", "../../view/admin/AdminTeam.php");
        }
        // 根据变量的值输出相应的 JavaScript 代码
    }
    else{
        redirectTo("请选择操作内容", "../../view/admin/AdminTeam.php");
    }
}
if(isset($_GET["id"])){
    require_once('../../PhpSrc/Service/Match_infor.php');
    try {
        $DeleteID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $Delete = new \Show_News\Match_infor();
        $Deleteflag=$Delete->DeleteFlag($DeleteID);
        if ($Deleteflag) {
            $Delete->Delete($DeleteID);
            redirectTo("队伍删除成功！", "../../view/admin/AdminMatch.php");
        }else{
        redirectTo("队伍删除失败，请先删除所有与赛事相关的参赛人员", "../../view/admin/AdminMatch.php");}
    } catch (Exception $e) {
        echo "接口调用失败：" . $e->getMessage();
        // 可以在此处记录异常信息到日志文件或者进行其他处理
    }
}
else{
    redirectTo("请选择操作内容和操作对象", "../../view/admin/AdminTeam.php");
}
?>