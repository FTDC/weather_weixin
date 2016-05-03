<Admintemplate file="Common/Head"/>
<body class="J_scroll_fixed">
<div class="wrap J_check_wrap">
    <Admintemplate file="Common/Nav"/>
    <link type="text/css" rel="stylesheet" href="{$config_siteurl}/statics/css/Base.css" />
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
    <div class="table_list">
        <table width="100%" cellspacing="0">
            <thead>
            <tr>
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
                    <td>{$vo.id}</td>
                    <td>{$vo['username']}</td>
                    <td>{$vo['title']}</td>
                    <td><img src="{$vo['img_path']}" alt="{$vo['title']}" title="{$vo['title']}"/> </td>
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
                        <a target="_self" href="{:U('Weather/del',array('id'=>$vo['id']))}">删除</a>
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
</div>
<script src="{$config_siteurl}/statics/js/common.js?v"></script>
<script type="text/javascript">

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