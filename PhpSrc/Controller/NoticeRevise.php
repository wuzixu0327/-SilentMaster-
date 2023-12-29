<?php
require_once('../PhpMysql/SelectNotice.php');
require_once('../../PhpSrc/interface/Notice_Edit.php');
require_once('../../PhpSrc/Controller/Notice_Revise.php');
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
                $Delete = new Notice_Revise();
                if (!$Delete->Notice_Delete($option)) {
                    $deleteSuccess = false;
                }
            }
            // 根据变量的值输出相应的 JavaScript 代码
            if ($deleteSuccess) {
                redirectTo("公告删除成功！", "../../view/admin/AdminNotice.php");
            } else {
                redirectTo("公告删除失败，请联系管理员！", "../../view/admin/AdminNotice.php");
            }
        }
        else{
            redirectTo("请选择需要执行的操作", "../../view/admin/AdminNotice.php");
        }
    }
    if (isset($_POST["Notice_Edittitle"])|| isset($_POST["Notice_Editmassage"])) {
        // 表单包含数据，执行相应的操作
        $Edit=$_COOKIE['EidCookie'];
        $editedTitle = $_POST["Notice_Edittitle"];
        $editedMassage = $_POST["Notice_Editmassage"];
        $obj=new Notice_Revise();
        if($obj->Notice_Edit($Edit,$editedTitle,$editedMassage)){
            redirectTo("数据更新成功", "../../view/admin/AdminNotice.php");
        }
        else{
            redirectTo("数据更新失败", "../../view/admin/AdminNotice.php");
        }
    }
    if (isset($_POST['data'])) {
        $SelectName = $_POST['data'];
        $Select = new SelectNotice();
        $ShowSelectNews = $Select->Show_Notice($SelectName);
    }


}

// 处理 GET 请求
if (isset($_GET['id'])) {
    try {
        $DeleteID = $_GET['id'];
        $Delete = new Notice_Revise();
        if ($Delete->Notice_Delete($DeleteID)) {
            redirectTo("公告删除成功！", "../../view/admin/AdminNotice.php");
        }
    } catch (Exception $e) {
        echo "接口调用失败：" . $e->getMessage();
    }
}

if (isset($_GET['Eid'])) {
    $cookieValue = $_GET['Eid'];
    setcookie("EidCookie", $cookieValue, time() + 3600, "/", "", true, true); // 设置为只能通过 HTTPS 连接传输
    header("Location: ../../view/admin/Notice_Edit.php");
    exit;
}

