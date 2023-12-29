<?php
// 确保请求是通过 POST 方法发送的
if (isset($_POST['userCreat']) && $_POST['userCreat'] !== null) {
    // 获取通过 AJAX 发送的数据
    session_start();
    $userSno=$_SESSION['userSno'];
    $TeamName = $_POST["userCreat"];
    $selectedMatch = $_POST["selectedMatch"];
    if (is_numeric($selectedMatch)) {
        // $selectedMatch 是一个数字
        require_once ('../Service/JoinTeam.php');
        require_once ('../Service/Team_Code.php');
        require_once ('../Service/CreatTeam.php');
        // 进行处理...
        $EXist=new JoinTeam();
        $flag=$EXist->isExist($userSno,$selectedMatch);
        if($flag){
            $code= new Team_Code();
            $Creat_Code=$code->generateUniqueInvitationCode();
            $Creat = new CreatTeam();
            $Creat->Creat_Team($userSno,$selectedMatch,$TeamName,$Creat_Code,0);
            if($Creat){
                echo '队伍创建成功';
            }
            else{
                echo'队伍创建失败';
            }
        }
        else{
        echo '请先退出当前队伍';
        }
    } else {
        // $selectedMatch 不是一个数字
        // 进行错误处理或其他操作...
        echo '错误';
    }

    // 在这里可以对获取到的数据进行处理
    // 例如，可以将数据插入数据库，进行验证，等等

    // 返回一些响应给前端
} else {
    header("Location: error.php");
    exit();
    // 如果不是通过 POST 方法发送的请求，返回错误信息
}
?>

