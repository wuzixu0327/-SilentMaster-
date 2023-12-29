<?php
require_once('../PhpMysql/SelectAffairs.php');
require_once('../../PhpSrc/interface/Affairs_Edit.php');
require_once('../../PhpSrc/Controller/Affairs_Revise.php');
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
                $Delete = new Affairs_Revise();
                if (!$Delete->Affairs_Delete($option)) {
                    $deleteSuccess = false;
                }
            }
            // 根据变量的值输出相应的 JavaScript 代码
            if ($deleteSuccess) {
                redirectTo("学生事务删除成功！", "../../view/admin/AdminAffairs.php");
            } else {
                redirectTo("学生事务删除失败，请联系管理员！", "../../view/admin/AdminAffairs.php");
            }
        }
        else{
            redirectTo("请选择需要执行的操作", "../../view/admin/AdminAffairs.php");
        }
    }
    if (isset($_POST["Affairs_Edittitle"])|| isset($_POST["Affairs_Editmassage"])) {
        // 表单包含数据，执行相应的操作
        $Edit=$_COOKIE['EidCookie'];
        $editedTitle = $_POST["Affairs_Edittitle"];
        $editedMassage = $_POST["Affairs_Editmassage"];
        $obj=new Affairs_Revise();
        if($obj->Affairs_Edit($Edit,$editedTitle,$editedMassage)){
            redirectTo("数据更新成功", "../../view/admin/AdminAffairs.php");
        }
        else{
            redirectTo("数据更新失败", "../../view/admin/AdminAffairs.php");
        }
    }
    if (isset($_POST['data'])) {
        $SelectName = $_POST['data'];
        $Select = new SelectAffairs();
        $ShowSelectNews =$Select->Show_Affairs($SelectName);
    }


}

// 处理 GET 请求
if (isset($_GET['id'])) {
    try {
        $DeleteID = $_GET['id'];
        $Delete = new Affairs_Revise();
        if ($Delete->Affairs_Delete($DeleteID)) {
            redirectTo("学生事务删除成功！", "../../view/admin/AdminAffairs.php");
        }
    } catch (Exception $e) {
        echo "接口调用失败：" . $e->getMessage();
    }
}

if (isset($_GET['Eid'])) {
    $cookieValue = $_GET['Eid'];
    setcookie("EidCookie", $cookieValue, time() + 3600, "/", "", true, true); // 设置为只能通过 HTTPS 连接传输
    header("Location: ../../view/admin/Affairs_Edit.php");
    exit;
}

