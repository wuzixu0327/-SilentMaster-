
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>管理中心 </title>
    <link rel="icon" href="images/原子22x22.png">
    <meta name="Copyright" content="Douco Design." />
    <link href="css/public.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/global.js"></script>
    <script type="text/javascript" src="js/jquery.tab.js"></script>
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
                <li class="cur"><a href="Adminindex.php"><i class="system"></i><em>信息发布</em></a></li>

            </ul>
            <ul>
                <li ><a href="AdminNews.php"><i class="product"></i><em>新闻管理</em></a></li>
                <li ><a href="AdminNotice.php"><i class="product"></i><em>公告管理</em></a></li>
                <li ><a href="AdminAffairs.php"><i class="product"></i><em>学生事务管理</em></a></li>
                <li ><a href="AdminMatch.php"><i class="product"></i><em>比赛管理</em></a></li>
            </ul>
            <ul>
                <li><a href="AdminTeam.php"><i class="theme"></i><em>参赛队伍</em></a></li>
                <li><a href="inputTeam.php"><i class="article"></i><em>打印参赛表</em></a></li>
            </ul>>
        </div></div>
    <div id="dcMain">
        <!-- 当前位置 -->
        <div id="urHere">管理中心<b>></b><strong>信息发布</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
            <h3>信息修改</h3>
            <script type="text/javascript">

                $(function(){ $(".idTabs").idTabs(); });

            </script>
            <div class="idTabs">
                <ul class="tab">
                    <li><a href="#main">比赛修改</a></li>
                </ul>
                <?php
                require_once('../../PhpSrc/PhpMysql/PDOMysql.php');
                $connect = new PDOMysql();
                $conn = $connect->getConnection();
                $Eid = $_COOKIE['EidCookie'];
                $query_select = "SELECT * FROM web_match WHERE Match_ID = ?";
                $stmt_select = $conn->prepare($query_select);
                $stmt_select->bind_param("i", $Eid);
                $stmt_select->execute();
                // 获取查询结果集
                $result = $stmt_select->get_result();
                // 获取结果集的第一行
                $row = $result->fetch_assoc();
                $name = $row['Match_Name'] ?? null;
                $organ = $row['Match_Organ'] ?? null;
                $start = date("Y-m-d", strtotime($row['Match_StartTime'])) ?? null;
                $end = date("Y-m-d", strtotime($row['Match_EndTime'])) ?? null;
                $href = $row['Match_Annex'] ?? null;
                $type = $row['Match_Type'] ?? null;
                $limit = $row['Match_NumberLimit'] ?? null;
                $massage = $row['Match_Massage'] ?? null;
                ?>
                <div class="items">
                    <form action="../../PhpSrc/Controller/MatchRevise.php?rec=update" method="post" enctype="multipart/form-data">
                        <div id="main">
                            <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                                <tr>
                                    <th width="131">名称</th>
                                    <th>内容</th>
                                </tr>
                                <tr>
                                    <td align="right">比赛名称</td>
                                    <td>
                                        <input type="text" name="site_name" placeholder="请输入比赛信息" size="80" class="inpMain" value="

                                        <?php
                                        echo $name;
                                        ?>
                                        " />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">比赛机构</td>
                                    <td>
                                        <input type="text" name="site_title" placeholder="请输入比赛机构" size="80" class="inpMain" value="
                                   <?php
                                   echo $organ;
                                   ?>
                                    " />
                                    </td>
                                </tr>

                                <tr>
                                    <td align="right">报名开始时间</td>
                                    <td>
                                        <input type="text" name="site_newtime" placeholder="年月日" size="80" class="inpMain" value="
                                        <?php
                                        echo $start;
                                        ?>
                                        " />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">报名截止时间</td>
                                    <td>
                                        <input type="text" name="site_oldtime" placeholder="年月日" size="80" class="inpMain" value="
                                   <?php
                                        echo $end;
                                        ?>
                                         " />
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">附件</td>
                                    <td>
                                        <input type="file" name="site_file" size="18">
                                        <a target="_blank"></a></td>
                                </tr>

                                <tr>
                                    <td align="right">比赛类型</td>
                                    <td>
                                        <?php
                                        if($type==0){
                                        echo ' <label for="site_closed_0">
                                            <input type="radio" name="site_closed" id="site_closed_0" value="0" checked="true">
                                            个人赛</label>';
                                        echo ' <label for="site_closed_1">
                                            <input type="radio" name="site_closed" id="site_closed_1" value="1">
                                            团体赛</label>';
                                        }
                                        else{
                                            echo ' <label for="site_closed_0">
                                            <input type="radio" name="site_closed" id="site_closed_0" value="0">
                                            个人赛</label>
                                        <label for="site_closed_1">
                                            <input type="radio" name="site_closed" id="site_closed_1" value="1" checked="true">
                                            团体赛</label>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">参赛人数限制</td>
                                    <td>
                                        <input type="text" name="site_person"  size="80" class="inpMain" value="
                                          <?php
                                        echo $limit;
                                        ?>
                                         " />
                                    </td>
                                </tr>

                                <td align="right">比赛信息</td>
                                <td>
                                    <!-- KindEditor -->
                                    <link rel="stylesheet" href="js/kindeditor/themes/default/default.css" />
                                    <link rel="stylesheet" href="js/kindeditor/plugins/code/prettify.css" />
                                    <script charset="utf-8" src="js/kindeditor/kindeditor.js"></script>
                                    <script charset="utf-8" src="js/kindeditor/lang/zh_CN.js"></script>
                                    <script charset="utf-8" src="js/kindeditor/plugins/code/prettify.js"></script>
                                    <script>
                                        KindEditor.ready(function(K) {
                                            var editor1 = K.create('textarea[name="site_massage"]', {
                                                cssPath : '../plugins/code/prettify.css',
                                                uploadJson : '../php/upload_json.php',
                                                fileManagerJson : '../php/file_manager_json.php',
                                                allowFileManager : true,
                                                afterCreate : function() {
                                                    var self = this;
                                                    K.ctrl(document, 13, function() {
                                                        self.sync();
                                                        K('form[name=example]')[0].submit();
                                                    });
                                                    K.ctrl(self.edit.doc, 13, function() {
                                                        self.sync();
                                                        K('form[name=example]')[0].submit();
                                                    });
                                                }
                                            });
                                            prettyPrint();
                                        });
                                    </script>
                                    <!-- /KindEditor -->
                                    <textarea id="content" name="site_massage" style="width:780px;height:400px;" class="textArea">
                                        <?php
                                        echo $massage;
                                        ?>
                                    </textarea>
                                </td>
                                </tr>
                            </table>
                        </div>
                        <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                            <tr>
                                <td width="131"></td>
                                <td>
                                    <input type="hidden" name="token" value="24760807" />
                                    <input name="submit" class="btn" type="submit" value="提交" />
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="clear"></div>
    <div id="dcFooter">
        <div id="footer">
            <div class="line"></div>
        </div>
    </div><!-- dcFooter 结束 -->
    <div class="clear"></div> </div>
</body>
</html>
