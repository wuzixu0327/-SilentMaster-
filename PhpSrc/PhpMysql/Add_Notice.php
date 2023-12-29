<?php

use function PhpSrc\showAlertAndRedirect;

class Add_Notice
{
    public function __construct()
    {
        // 构造函数用于初始化
    }

    public function addNotice($Notice_Title, $Notice_Massage){
        $redirectUrl = "../../suse_web/view/admin/Adminindex.php";
        // 其他逻辑
        global $Mysqlservername, $Mysqlusername, $Mysqlpassword, $Mysqldbname;
        require_once "PDOMysql.php";
        require_once "MysqlMassage.php";
        $servername = $Mysqlservername;
        $username = $Mysqlusername;
        $password = $Mysqlpassword;
        $dbname = $Mysqldbname;
        $database = new PDOMysql($servername, $username, $password, $dbname);
        $conn = $database->getConnection();

        try {
            // 获取最大 News_ID
            $query = "SELECT MAX(Notice_ID) as max_id FROM web_notice";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $max_id = $row['max_id']+1;
            $result->free_result();

            // 插入新闻
            $currentDateTime = date('Y-m-d');
            $AddNews = "INSERT INTO web_notice (Notice_ID,Notice_Massage, Notice_Title, Notice_Time) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($AddNews);
            $stmt->bind_param("isss", $max_id, $Notice_Massage, $Notice_Title, $currentDateTime);
            $stmt->execute();
            showAlertAndRedirect("发布成功", $redirectUrl);
            if ($stmt->errno) {
                echo "插入数据时发生错误：" . $stmt->error;
                showAlertAndRedirect("发布失败", $redirectUrl);
            }
        } catch (PDOException $e) {
            echo "插入数据时发生错误：" . $e->getMessage();
            showAlertAndRedirect("连接数据库失败", $redirectUrl);
        } finally {
            // 关闭数据库连接
            $conn->close();
        }
    }
}

?>
