<?php
//if (isset($_POST['userjoin'])) {
//    $teamCode = $_POST['userjoin']; // 修正这里的变量名为 $teamCode
//    session_start();
//    $userSno = $_SESSION['userSno'];
//    // 进行进一步的处理，比如验证、数据库操作等
//    require_once('../Service/Team_Code.php');
//    require_once('../Service/JoinTeam.php');
//    $code = new Team_Code();
//    $codeFlag = $code->checkIfCodeIsUnique($teamCode);
//    // 输出结果
//    if (!$codeFlag) {
//        $Join = new JoinTeam();
//        if ($Join->CodeJoin($userSno, $teamCode)) {
//            echo '成功加入队伍';
//        } else {
//            echo '请勿重复参加';
//        }
//    } else {
//        echo '邀请码不存在';
//    }
//} else {
//    header("Location: login.php");
//    exit();
//}
// 判断是否存在 $_POST['userjoin'] 并且不为 null
if (isset($_POST['userjoin'])) {
    require_once('../Service/Team_Code.php');
    require_once('../Service/JoinTeam.php');
    // 获取 userjoin 数据
    $teamCode = $_POST['userjoin'];
    session_start();
    $userSno = $_SESSION['userSno'];
    $code = new Team_Code();
    $codeFlag = $code->checkIfCodeIsUnique($teamCode);
    if (!$codeFlag) {
        $number = new JoinTeam();
        if($number->joinFlag($teamCode)) {
            $Join = new JoinTeam();
            if ($Join->CodeJoin($userSno, $teamCode)) {
                echo '成功加入队伍';
            } else {
                echo '请勿重复参加';
            }
        }
        else {
            echo '队伍已满';
        }
    }else {
        echo '邀请码不存在';
    }
}
else {
    // 如果不存在 $_POST['userjoin']，可以返回错误信息或其他处理
    header("Location: error.php");
    exit();
}

?>
