<div class="data-table fl" style=" margin:0; width:100%">
  <div class="table-striped">
    <table cellpadding="0" cellspacing="1">
      <!-- 表头 -->
       <thead>
         <tr>
           <th width="10">选择</th>
           <th width="20%">标题</th>
           <th width="50%">简介</th>
		   <th width="20">封面图片</th>
         </tr>
       </thead>
       
       <!-- 列表 -->
      <tbody class="">
        <volist name="list_data" id="vo">
          <tr>
          	<td><a href="javascript:void(0);"><input type="radio" name="ids[]" value="{$vo.id}"></a></td>
            <td id="news_{$vo.id}" class="title">{$vo.title}<input type="hidden" name="ids[]" value="{$vo.id}"></td>
            <td id="news_{$vo.id}" class="intro">{$vo.intro}</td>
		 	<td class="cover">{$vo.cover|get_img_html}</td>
          </tr>
        </volist>
      </tbody>
    </table>
  </div>
</div>