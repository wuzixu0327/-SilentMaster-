
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>参赛人员</title>
    <link rel="icon" href="images/原子22x22.png">
    <meta name="Copyright" content="Douco Design." />
    <link href="css/public.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/global.js"></script>
    <script type="text/javascript" src="js/jquery.autoTextarea.js"></script>
</head>
<body>
<div id="dcWrap">
    <div id="dcHead">
        <div id="head">
            <div class="logo"><a><img src="images/原子22x22.png" alt="logo"></a>开放原子协会</div>
            <div class="nav">
                <ul class="navRight">
                    <li class="M noLeft"><a href="JavaScript:void(0);">您好，admin</a>
                    </li>
                    <li class="noRight"><a href="login.php?rec=logout">退出</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- dcHead 结束 -->
    <div id="dcLeft"><div id="menu">
            <ul>
                <li ><a href="Adminindex.php"><i class="system"></i><em>信息发布</em></a></li>

            </ul>
            <ul>
                <li ><a href="AdminNews.php"><i class="product"></i><em>新闻管理</em></a></li>
                <li ><a href="AdminNotice.php"><i class="product"></i><em>公告管理</em></a></li>
                <li ><a href="AdminAffairs.php"><i class="product"></i><em>学生事务管理</em></a></li>
                <li ><a href="AdminMatch.php"><i class="product"></i><em>比赛管理</em></a></li>
            </ul>
            <ul>
                <li><a href="AdminTeam.php"><i class="theme"></i><em>参赛队伍</em></a></li>
                <li class="cur"><a href="inputTeam.php"><i class="article"></i><em>打印参赛表</em></a></li>
            </ul>
        </div></div>
    <div id="dcMain">
        <!-- 当前位置 -->
        <div id="urHere">管理中心<b>></b><strong>打印参赛表</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
            <h3>参赛人员管理</h3>
            <div class="filter">
                <form action="SelectinputTeam.php" method="post" onsubmit="return getFormValues()">
                    <select name="cat_id" id="cat_id">
                        <option value="0">未分类</option>
                        <?php
                        require_once('../../PhpSrc/Service/Match_infor.php');
                        $Match = new \Show_News\Match_infor();
                        $Match->selectMatch();
                        ?>
                    </select>
                    <input name="keyword" type="text" class="inpMain" value="" size="20" id="Select_Match"/>
                    <input name="submit" class="btnGray" type="submit"/>
                </form>
            </div>
            <div id="list">
                <form name="action" method="post" action="Rank_User.php">
                    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                        <tr>
                            <th width="22" align="center"><input name='chkall' type='checkbox' id='chkall' onclick='selectcheckbox(this.form)' value='check'></th>
                            <th width="40" align="center">参赛ID</th>
                            <th align="left" width="300">所属赛事</th>
                            <th width="150" align="center">用户名称</th>
                            <th width="80" align="center">身份</th>
                            <th width="80" align="center">参加时间</th>
                            <th width="80" align="center">操作</th>
                        </tr>
                        <?php
                        require_once('../../PhpSrc/Service/MatchUser.php');
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        }
                        else {
                            $page = 1;
                        }
                        $Match = new \Show_News\MatchUser();
                        $Match->User_Nokey($page);
                        ?>
                    </table>
                    <div class="action">
                        <select name="Teamop" onchange="douAction()">
                            <option value="0">请选择...</option>
                            <option value="del_all">删除</option>
                        </select>
                        <input name="submit" class="btn" type="submit" value="执行" />
                    </div>
                </form>
            </div>
            <div class="clear"></div>
            <?php
            require_once('../../PhpSrc/Service/Match_infor.php');
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            }
            else {
                $page = 1;
            }
            $Match = new \Show_News\MatchUser();
            $number=$Match->Page();
            echo '<div class="clear"></div>';
            echo '<div class="pager">';
            echo '总共有' . $number . '个记录,共' . intval(($number + 14) / 15) . '页,当前第' . $page . '页 |';

            if ($page != 1) {
                echo '    <a href="inputTeam.php?page=1">第一页</a>';
            }

            if ( $page - 1 > 0) {
                echo '    <a href="inputTeam.php?page=' . ($page - 1) . '">上一页</a>';
            }

            if (intval(($number + 14) / 15) - $page > 0) {
                echo '    <a href="inputTeam.php?page=' . ($page + 1) . '">下一页</a>';
            }

            if ($page != intval(($number + 14) / 15)) {
                echo '    <a href="inputTeam.php?page=' . intval(($number + 14) / 15) . '">最后一页</a>';
            }

            ?>
        </div>
        <script type="text/javascript">

            onload = function()
            {
                document.forms['action'].reset();
            }

            function douAction()
            {
                var frm = document.forms['action'];
                frm.elements['new_cat_id'].style.display = frm.elements['action'].value == 'category_move' ? '' : 'none';
            }

        </script>
</body>
<script>
    function getFormValues() {
        // 获取<select>的值
        var catId = document.getElementById('cat_id').value;

        // 获取<input>的值
        var keyword = document.getElementById('Select_Match').value;

        // 在这里可以使用 catId 和 keyword 进行进一步的处理
        if(catId == 0){
            alert("请选择查询赛事！");
            return false;
        }
        else return true;
    }
</script>

</html>
