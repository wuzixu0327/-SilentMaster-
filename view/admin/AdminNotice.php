
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>公告管理 </title>
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
                <div class="nav">
                    <ul class="navRight">
                        <li class="M noLeft"><a href="JavaScript:void(0);">您好，admin</a>
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
                    <li class="cur"><a href="AdminNotice.php"><i class="product"></i><em>公告管理</em></a></li>
                    <li ><a href="AdminAffairs.php"><i class="product"></i><em>学生事务管理</em></a></li>
                    <li ><a href="AdminMatch.php"><i class="product"></i><em>比赛管理</em></a></li>
                </ul>
                <ul>
                    <li><a href="AdminTeam.php"><i class="theme"></i><em>参赛队伍</em></a></li>
                    <li><a href="inputTeam.php"><i class="article"></i><em>打印参赛表</em></a></li>
                </ul>
            </div></div>
        <div id="dcMain">
            <!-- 当前位置 -->
            <div id="urHere">管理中心<b>></b><strong>公告管理</strong> </div>   <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
                <h3>公告列表</h3>
                <div class="filter">
                    <input type="text" id="Select_News" placeholder="请输入公告名" size="50" class="inpMain" />
                    <input name="Select_botton" class="btnGray" type="button" value="搜索" onclick="checkSearchBox()"/>
                    <span>
        </span>
                </div>
                <div id="list">
                    <form method="post" action="../../PhpSrc/Controller/NoticeRevise.php?action=0" onsubmit="return validateForm()">
                        <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
                            <tr>
                                <th width="22" align="center"><input name='chkall' type='checkbox' id='chkall' onclick='selectcheckbox(this.form)' value='check'></th>
                                <th width="40" align="center">编号</th>
                                <th align="left">名称</th>
                                <th width="80" align="center">类型</th>
                                <th width="150" align="center">发布日期</th>
                                <th width="150" align="center">操作</th>
                            </tr>
                            <?php
                            use Show_News\Show_News;
                            use Show_News\Show_Notice;

                            require_once('../../PhpSrc/Service/Show_Notice.php');
                            if (isset($_GET['page'])) {
                                $page = $_GET['page'];
                            }
                            else {
                                $page = 1;
                            }
                            $show= new \Show_News\Show_Notice();
                            $showclass=$show->Show_Notice($page);
                            ?>
                        </table>
                        <div class="action">
                            <select name="News_choose1" onchange="douAction()">
                                <option value="0">请选择...</option>
                                <option value="del_all">删除</option>
                            </select>
                            <input name="submit" class="btn" type="submit" value="执行" />
                        </div>
                        <?php
                        require_once('G:\web\suse_web\PhpSrc\Service\Show_Notice.php');
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'];
                        }
                        else {
                            $page = 1;
                        }
                        $showPage = new Show_Notice();
                        $number = $showPage->Page();
                        echo '<div class="clear"></div>';
                        echo '<div class="pager">';
                        echo '总共有' . $number . '个记录,共' . intval(($number + 14) / 15) . '页,当前第' . $page . '页 |';

                        if ($page != 1) {
                            echo '    <a href="AdminNotice.php?page=1">第一页</a>';
                        }

                        if ( $page - 1 > 0) {
                            echo '    <a href="AdminNotice.php?page=' . ($page - 1) . '">上一页</a>';
                        }

                        if (intval(($number + 14) / 15) - $page > 0) {
                            echo '    <a href="AdminNotice.php?page=' . ($page + 1) . '">下一页</a>';
                        }

                        if ($page != intval(($number + 14) / 15)) {
                            echo '    <a href="AdminNotice.php?page=' . intval(($number + 14) / 15) . '">最后一页</a>';
                        }

                        ?>
                    </form>
                </div>
            </div>
            <div id="list2" style="display: none">
                <form method="post" action="../../PhpSrc/Controller/NoticeRevise.php?action=0" onsubmit="return validateForm()">
                    <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic" id="Ajax_respons">

                    </table>
                    <div class="action">
                        <select name="News_choose1" onchange="douAction()">
                            <option value="0">请选择...</option>
                            <option value="del_all">删除</option>
                        </select>
                        <input name="submit" class="btn" type="submit" value="执行" />
                    </div>
                </form>
            </div>
            <script type="text/javascript">
                window.onload = function () {
                    document.forms['action'].reset();
                };

                function douAction() {
                    var frm = document.forms['action'];
                    frm.elements['new_cat_id'].style.display = frm.elements['action'].value === 'category_move' ? '' : 'none';
                }

            </script>
            <script>
                function checkSearchBox() {
                    var searchBoxValue = document.getElementById('Select_News').value;
                    if (searchBoxValue.trim() === "") {
                        alert("搜索框不能为空！");
                    } else {
                        // 使用 jQuery 发送 Ajax 请求
                        $.ajax({
                            type: "POST",
                            url: "../../PhpSrc/Controller/NoticeRevise.php",
                            data: { data: searchBoxValue },
                            success: function(response) {
                                $('#Ajax_respons').html(response);
                                document.getElementById('list').style.display='none'
                                document.getElementById('list2').style.display='block'
                                document.getElementById("Select_News").value = null;
                            },

                            error: function(xhr, status, error) {
                                // 处理错误情况
                                console.error("请求失败：" + status + ", " + error);
                            }
                        });
                    }
                }

            </script>
            <script>
                function validateForm() {
                    // 获取所有名为 "checkbox" 的多选框
                    var checkboxes = document.getElementsByName('checkbox[]');

                    // 检查是否有至少一个多选框被选中
                    var atLeastOneChecked = false;
                    for (var i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].checked) {
                            atLeastOneChecked = true;
                            break;
                        }
                    }
                    // 如果没有多选框被选中，则弹出提示信息并阻止表单提交
                    if (!atLeastOneChecked) {
                        alert('请至少选择一个选项');
                        return false;
                    }

                    // 允许表单提交
                    return true;
                }
            </script>
</body>
</html>
