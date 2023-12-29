<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (isset($_POST['selectedValues'])) {
        $selectedValues = $_POST['selectedValues'];
        // Process $selectedValues as needed
        require_once('../../PhpSrc/Service/userselectjoin_Team.php');
        $redata=new userselectjoin_Team();
        $Sno = $_SESSION['userSno'];
        $data=$redata->selectjoin_Team($Sno,$selectedValues);
        if($data!=null)
        {
            echo $data;
        }
    } else {
        echo "No selected values received.";
    }
} else {
    header("Location: error.php");
    exit();
}
?>

