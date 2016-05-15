<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
    <Admintemplate file="Common/Nav"/>
    <link type="text/css" rel="stylesheet" href="{$config_siteurl}/statics/css/Base.css" />
    <link type="text/css" rel="stylesheet" href="{$config_siteurl}/statics/photo/jquery.fancybox/fancybox.css" />
    <form method="post" action="{:U('Weixin/Weather/tucao')}">
        <div class="search_type cc mb10">
            <div class="mb10"> <span class="mr20">

      时间：
      <input type="text" name="start_time" class="input length_2 J_date" value="{$_GET.start_time}" style="width:80px;">
      -
      <input type="text" class="input length_2 J_date" name="end_time" value="{$_GET.end_time}" style="width:80px;">
      <button class="btn">搜索</button>
      </span> </div>
        </div>
    </form>
    <form class="J_ajaxForm" action="" method="post">
    <div class="table_list">
        <table width="100%" cellspacing="0">
            <thead>
            <tr>
                <td width="3%"><label><input type="checkbox" class="J_check_all" data-direction="x" data-checklist="J_check_x"></label></td>
                <td width="5%" >编号</td>
                <td width="10%" >用户</td>
                <td width="10%" >标题</td>
                <td width="10%" >图片</td>
                <td width="10%" >城市</td>
                <td width="10%" >上传时间</td>
                <td width="10%" >是否审核</td>
                <td width="10%" >操作</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <foreach name="list" item="vo">

                    <td><input type="checkbox" class="J_check" data-yid="J_check_y" data-xid="J_check_x" name="ids[]" value="{$vo.id}"></td>
                    <td>{$vo.id}</td>
                    <td>{$vo['username']}</td>
                    <td>{$vo['title']}</td>
                    <td><a href="{$vo['img_path']}" class="mosaic-images-fancybox" rel="group" ><img  style="width: 125px;" src="{$vo['img_path_small']}" alt="{$vo['title']}" title="{$vo['title']}"/></a></td>
                    <td>
                        {$vo.city}
                    </td>
                    <td>
                        {$vo.addtime|date="Y-m-d H:i",###}
                    </td>
                    <td>
                        {$vo.is_validate}
                    </td>
                    <td>
                        <a target="_self" href="{:U('photo/del',array('id'=>$vo['id']))}">修改</a>
                        <a target="_self" href="{:U('photo/edit',array('id'=>$vo['id']))}">删除</a>
                    </td>
            </tr><tr>
                </foreach>
            </tr>
            </tbody>
        </table>
        <div class="p10">
            <div class="pages"> {$Page} </div>
        </div>
    </div>
    <div class="btn_wrap">
        <div class="btn_wrap_pd">
            <label class="mr20"><input type="checkbox" class="J_check_all" data-direction="y" data-checklist="J_check_y">全选</label>
            <button class="btn J_ajax_submit_btn" type="submit" data-action="{:U('Photo/listorder')}">排序</button>
            <button class="btn J_ajax_submit_btn" type="submit" data-action="{:U('Photo/public_check')}">审核</button>
            <button class="btn J_ajax_submit_btn" type="submit" data-action="{:U('Photo/public_nocheck')}">取消审核</button>
            <button class="btn J_ajax_submit_btn" type="submit" data-action="{:U('Photo/delete')}">删除</button>
        </div>
    </div>
    </form>
</div>
<script src="{$config_siteurl}/statics/js/common.js?v"></script>
<script src="{$config_siteurl}/statics/photo/jquery.fancybox/jquery.fancybox-1.3.1.pack.js?v"></script>
<script type="text/javascript">
    // 财产公示效果
    $('.mosaic-images-fancybox').fancybox({cyclic: false});

    function generates(genid){
        //生成静态
        if(genid == 1){
            $("#index_ruleid_1").show();
            $("#index_ruleid_1 select").attr("disabled",false);
            $("#index_ruleid_0").hide();
            $("#index_ruleid_0 select").attr("disabled","disabled");
        }else{
            $("#index_ruleid_0").show();
            $("#index_ruleid_0 select").attr("disabled",false);
            $("#index_ruleid_1").hide();
            $("#index_ruleid_1 select").attr("disabled","disabled");
        }
    }
</script>
</body>
</html>