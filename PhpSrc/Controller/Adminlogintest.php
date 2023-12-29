<?php
require_once ('../Service/adminloginTest.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 接收前端传递的数据
    $username = $_POST["userSno"] ?? "";
    $password = $_POST["userpassword"] ?? "";
    $adminflag = new adminloginTest();
    if($adminflag->loginTest($username,$password)){
        $response = array('success' => true, 'message' => '../Adminindex.php');
        header('Content-Type: application/json');
        echo json_encode($response);
    }else{
        $response = array('success' => false, 'message' => '登录失败');
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    header("Location: error.php");
    exit();
}
?>
