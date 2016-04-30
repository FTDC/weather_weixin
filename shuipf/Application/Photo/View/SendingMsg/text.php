<div class="data-table fl" style=" margin:0; width:100%">
  <div class="table-striped">
    <table cellpadding="0" cellspacing="1">
      <!-- 表头 -->
       <thead>
         <tr>
           <th width="10">选择</th>
           <th width="20%">标题</th>
           <th width="70%">内容</th>
         </tr>
       </thead>
       
       <!-- 列表 -->
      <tbody class="text_data">
        <volist name="text_data" id="vo">
          <tr>
          	<td><a href="javascript:void(0);" onClick="select_news({$vo.id})"><input type="radio" name="ids[]" value="{$vo.id}"></a></td>
            <td id="news_{$vo.id}" class="title">{$vo.keyword}</td>
            <td id="news_{$vo.id}" class="content">{$vo.content}</td>
          </tr>
        </volist>
      </tbody>
    </table>
  </div>
</div>