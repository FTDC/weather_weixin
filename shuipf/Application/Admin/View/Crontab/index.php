<?php if (!defined('SHUIPF_VERSION')) exit(); ?>
<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
    <Admintemplate file="Common/Nav"/>
    <a href="{:U('Crontab/add')}" target="mainContent"  class="btn">添加路径</a>
    <a href="{:U('Crontab/index')}" target="mainContent"  class="btn">采集列表</a>
    <br />
    <div class="table_list">
        <table width="100%" cellspacing="0">
            <thead>
            <tr>
                <td width="100" align="center">名称</td>
                <td width="100" align="center">命名规则</td>
                <td align="center">时间间隔</td>
                <td align="center">采集路径</td>
                <td align="center">采集方法</td>
                <td width="100" align="center">状态</td>
                <td width="230" align="center">管理操作</td>
            </tr>
            </thead>
            <tbody>
            <volist name="list" id="vo">
                <tr>
                    <td align='center'>{$vo.name}</td>
                    <td align='center'>{$vo.namerul}</td>
                    <td align='center'>{$vo.second}</td>
                    <td align='center'>{$vo.path}</td>
                    <td align='center'>{$vo.action}</td>
                    <td align='center'><font color="red">
                            <if condition="$vo['status'] eq '0' ">╳
                                <else/>
                                √
                            </if>
                        </font></td>
                    <td align='center'>
                        <?php
                        $operate = array();
                        $operate[] = '<a href="' . U("edit", array("id" => $vo['id'])) . '">修改</a>';
//                        if ($vo['status'] == 1) {
//                            $operate[] = '<a href="' . U("disabled", array("id" => $vo['id'], "disabled" => 0)) . '">禁用</a>';
//                        } else {
//                            $operate[] = '<a href="' . U("disabled", array("id" => $vo['id'], "disabled" => 1)) . '"><font color="#FF0000">启用</font></a>';
//                        }
                        $operate[] = '<a class="J_ajax_del" href="' . U("delete", array("id" => $vo['id'])) . '">删除</a>';
                        echo implode(' | ', $operate);
                        ?>
                    </td>
                </tr>
            </volist>
            </tbody>
        </table>
    </div>
</div>
<script src="{$config_siteurl}/statics/js/common.js?v"></script>
<script type="text/javascript">

</script>
</body>
</html>