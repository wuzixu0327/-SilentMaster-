<?php
use function PhpSrc\showAlertAndRedirect;
class Add_News
{
    public function __construct()
    {
        // 构造函数用于初始化
    }

    public function addNews($New_Title, $New_Files, $New_Massage)
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
        $database = new PDOMysql($servername, $username, $password, $dbname);
        $conn = $database->getConnection();

        try {
            // 获取最大 News_ID
            $query = "SELECT MAX(News_ID) as max_id FROM web_news";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $max_id = $row['max_id']+1;
            $result->free_result();

            // 插入新闻
            $currentDateTime = date('Y-m-d');
            if (isset($New_Files) && !empty($New_Files["name"])) {
                // 有附件时的插入逻辑
                $AddNews = "INSERT INTO web_news (News_ID, News_Title, News_Massage, News_Time, News_href) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($AddNews);
                $targetFile = 'News/' . basename($New_Files["name"]);
                $stmt->bind_param("issss", $max_id, $New_Title, $New_Massage, $currentDateTime, $targetFile);
                $stmt->execute();
                move_uploaded_file($New_Files["tmp_name"], $targetFile);
                showAlertAndRedirect("发布成功", $redirectUrl);
            } else {
                // 没有附件时的插入逻辑
                $AddNews = "INSERT INTO web_news (News_ID, News_Title, News_Massage, News_Time, News_href) VALUES (?, ?, ?, ?, null)";
                $stmt = $conn->prepare($AddNews);
                $stmt->bind_param("isss", $max_id, $New_Title, $New_Massage, $currentDateTime);
                $stmt->execute();
                showAlertAndRedirect("发布成功", $redirectUrl);
            }

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
