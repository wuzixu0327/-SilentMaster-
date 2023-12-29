<?php
use function PhpSrc\showAlertAndRedirect;
class Add_Match
{
    public function __construct()
    {
        // 构造函数用于初始化
    }

    public function addMatch($Match_Name, $Match_Organ, $Match_StartTime,$Match_EndTime,$Match_Annex,$Match_Type,$Match_NumberLimit,$Match_Massage)
    {
        $redirectUrl = "../../suse_web/view/admin/Adminindex.php";
        // 其他逻辑
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "PDOMysql.php";
        require_once "MysqlMassage.php";
        $servername = $Mysqlservername;
        $username = $Mysqlusername;
        $password = $Mysqlpassword;
        $dbname = $Mysqldbname;
        $database = new PDOMysql();
        $conn = $database->getConnection();

        try {
            $query = "SELECT MAX(Match_ID) as max_id FROM web_match";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $max_id = $row['max_id']+1;
            $result->free_result();
            $AddNews = "INSERT INTO web_match (Match_ID,Match_Name, Match_Organ, Match_StartTime,Match_EndTime,Match_Annex,Match_Type,Match_NumberLimit,Match_Massage) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($AddNews);
            $targetFile =basename($Match_Annex["name"]);
            $stmt->bind_param("issssssis", $max_id,$Match_Name, $Match_Organ, $Match_StartTime,$Match_EndTime,$targetFile,$Match_Type,$Match_NumberLimit,$Match_Massage);
            $stmt->execute();
            move_uploaded_file($Match_Annex["tmp_name"], 'Match/'.$targetFile);
            showAlertAndRedirect("发布成功", $redirectUrl);

            if ($stmt->errno) {
                showAlertAndRedirect("发布失败", $redirectUrl);
            }
        } catch (PDOException $e) {
            showAlertAndRedirect("数据库连接失败", $redirectUrl);
        } finally {
            // 关闭数据库连接
            $conn->close();
        }
    }
}

?>
