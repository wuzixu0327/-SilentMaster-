<?php
function redirectTo($message) {
    if(isset($_SERVER['HTTP_REFERER'])){
        $url=$_SERVER['HTTP_REFERER'];
    }
    echo "<script>alert('$message');window.location.href='$url';</script>";
    exit();
}

if (isset($_POST["checkbox"])) {
    require_once('../../PhpSrc/Service/MatchUser.php');
    $selectedOptions = $_POST["checkbox"];
    if(isset($_POST['Teamop']))
    {
        $type=$_POST['Teamop'];
    }
    if ($type == 'del_all') {
        $deleteSuccess = true;
        foreach ($selectedOptions as $option) {
            $Delete = new \Show_News\MatchUser();
            if (!$Delete->Delete($option)) {
                $deleteSuccess = false;
            }
        }
        // 根据变量的值输出相应的 JavaScript 代码
        if ($deleteSuccess) {
            redirectTo("参赛用户删除成功!", "../../view/admin/inputTeam.php");
        } else {
            redirectTo("参赛用户删除失败，请联系管理员！", "../../view/admin/inputTeam.php");
        }
        // 根据变量的值输出相应的 JavaScript 代码
    }
    if($type == 'input'){
        $selectedIDs = isset($_POST['checkbox']) ? $_POST['checkbox'] : [];
        $selectedIDs = array_filter($selectedIDs, 'is_numeric');
        $cat_id=$_POST['cat_id'];
        $selectTeam = new \Show_News\MatchUser();  // 替换成实际的类名
        $selectTeam->inputcsv($cat_id,$selectedIDs);
        redirectTo("打印成功", "../../view/admin/inputTeam.php");
    }
    else{
        redirectTo("请选择操作内容", "../../view/admin/inputTeam.php");
    }
}
if(isset($_GET["id"])){
    require_once('../../PhpSrc/Service/MatchUser.php');
    $DeletdID = $_GET['id'];
    echo $DeletdID;
    $Delete2 = new \Show_News\MatchUser();
    if($Delete2->Delete($DeletdID)){
        redirectTo("参赛人员删除成功!", "../../view/admin/inputTeam.php");
    }
    else{
        redirectTo("参赛队员删除失败，请联系管理员！", "../../view/admin/inputTeam.php");
    }
}
else{
    redirectTo("请选择操作内容和操作对象", "../../view/admin/inputTeam.php");
}
?>