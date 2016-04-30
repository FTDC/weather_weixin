<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{$config_siteurl}/statics/Scratch/mobile_module.css?v=1408699391" media="all">
    <script type="text/javascript" src="{$config_siteurl}/statics/Scratch/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="{$config_siteurl}/statics/Scratch/prefixfree.min.js"></script>
    <script type="text/javascript" src="{$config_siteurl}/statics/Scratch/dialog.js?v=1408689416"></script>
    </head>
<link href="{$config_siteurl}/statics/Scratch/scratch.css?v=1408523779" rel="stylesheet" type="text/css">
<body id="scratch">
	<div class="container body">
    	<div class="scr_top">
        	<img src="{$config_siteurl}/statics/Scratch/top.jpg"/>
    		<div class="area">
            	<img src="{$config_siteurl}/statics/Scratch//area.jpg"/>
                <div class="scratch_area">
                  <php> if ($error) { </php>
                	<div class="prize_text" style="font-size:16px; line-height:22px;">{$error}</div>   
                    <canvas style="display:none" /> 
                  <php> } else { </php>
                        <!-- 抽奖信息 -->
                        <div class="prize_text" style="display:none">{$prize.title}</div>
                        <canvas />             
                 <php> } </php> 
                </div>
            </div>
        </div>
        <div class="block_out">
        	<div class="block_inner">
            	<h6>活动说明</h6>
                <p>{$data.intro}</p>
            </div>
        </div>
        <!--奖项 -->
        <div class="block_out">
        	<div class="block_inner">
            	<h6>活动奖项</h6>
                <ul class="gift_list">
                <volist name="prizes" id="vo">
                	<li>
                    	<p>{$vo.title}:({$vo.num|intval}名)</p>
                        <img src="{$vo.img}" />
     					<span>{$vo.name}</span>                   
                    </li>
                 </volist>
                    </ul>
                </div>
            </div>
            <!--中将记录 -->
            <div class="block_out">
        		<div class="block_inner">
                    <h6>我的中奖记录</h6>
                    <if condition="$prize['count'] gt 0">
                    <p class="repeat_tips"><notempty name="data.max_num">您还有{$prize.count}次抽奖机会，</notempty><a href="{:U('Scratch/show',array('id'=>$data['id']))}">再刮一次</a></p>
                    </if>
                    <empty name="my_prizes">
                    <p class="empty-tips">您目前还没有中过奖</p>
                    <else />
                    <ul class="gift_history" id="my_gift_history">
                    <notempty name="prize.id">
                            <li id="now_my_prize" style="display:none">
                                <span class="col_1">刚刚</span>
                                <span class="col_2">{$prize.title}</span>
                            </li>  
                     </notempty>                      
                      	<volist name="my_prizes" id="vo">
                            <li>
                                <span class="col_1">{$vo.cTime|date="Y-m-d",###}</span>
                                <span class="col_2">{$vo.prize_title}</span>
                            </li>
                       </volist>
                     </ul>
                    </empty>
                </div>
            </div>
            <!--最新中将记录 -->
            <div class="block_out">
        		<div class="block_inner">
                    <h6>最新中奖记录</h6>
                    <if condition="$new_prizes gt 0">
                     <ul class="gift_history">
                      <volist name="new_prizes" id="vo">
                        <li>
                          	<span class="col_1">{$vo.cTime|date="Y-m-d",###}</span>
                            <span class="col_2">{$vo.username}</span>
                            <span class="col_3">{$vo.prize_title}</span>
                        </li>
                       </volist>
                     </ul>
                    <else />
                    <p class="empty-tips">暂还没有中奖记录</p>
                  </if>
                </div>
            </div>
            <p class="copyright">{$system_copy_right}</p>
        </div>
    </div>
<script type="text/javascript">  
$(function(){
	//try{ 
		initCanvas(document.body.style);
	//}catch(e){ 
		//alert('您的手机不支持刮刮卡效果哦~!'+e); 
	//} 
	
	});   
var is_set = 0;
function initCanvas(bodyStyle){ 
	var u = navigator.userAgent;
	var mobile = ''; 
	if(u.indexOf('iPhone') > -1 || u.indexOf('iPod') > -1 || u.indexOf('iPad') > -1) mobile = 'iphone'; 
	if(u.indexOf('Android') > -1 || u.indexOf('Linux') > -1 || u.indexOf('windows') > -1) mobile = 'Android';         
	bodyStyle.mozUserSelect = 'none';         
	bodyStyle.webkitUserSelect = 'none';           
	var img = new Image();         
	var canvas = $('canvas');         
	canvas.css({'background-color':'transparent'}); 
	var w = $('.container').width()/2; 
	var h =  w/2;      
	$('.prize_text').css({'width':w,'height':h,'margin-left':-w/2,'line-height':h+'px'});
	$('.scratch_area').css({'width':w,'height':h,'margin-left':-w/2}); 
	
	$('canvas').css({'margin-left':-w/2});
	//alert($('.container').width()+"="+w+"=="+h);
	canvas[0].width = w;
	canvas[0].height = h;  
	img.addEventListener('load',function(e){  
		var ctx;
		///var w = img.width, h = img.height;             
		var offsetX = canvas.offset().left, offsetY =  canvas.offset().top;             
		var mousedown = false;               
		function layer(ctx){                 
			ctx.fillStyle = 'gray';                 
			ctx.fillRect(0, 0, w, h);             
		}   
		function eventDown(e){                 
			e.preventDefault();                 
			mousedown=true;             
		}   
		function eventUp(e){                 
			e.preventDefault();                 
			mousedown = false;
			var data=ctx.getImageData(0,0,w,h).data;
			for(var i=0,j=0;i<data.length;i+=4){
				if(data[i] && data[i+1] && data[i+2] && data[i+3]){
					j++;
				}
			}
			//console.log(j+"=="+(w*h*0.7));
			if(j<=w*h*0.8 && is_set==0){
				set_sn_code(); //刮开记录中奖情况
				var prize_id = {$prize.id | intval
			}
				if(prize_id>0){
					//中奖
					openSuccessDialog();
					$('#now_my_prize').show();
				}else{
					openErrorDialog();
				}
				
				is_set = 1; //只能更新一次
			}             
		}    
		function eventMove(e){                 
			e.preventDefault();                 
			if(mousedown){       
				if(e.changedTouches){           
					e=e.changedTouches[e.changedTouches.length-1];                     
				}                     
				 
					var x = e.pageX - offsetX; 
					var y = e.pageY - offsetY; 
				
				//alert(x+"=="+y);
				with(ctx){  
					beginPath();
					arc(x, y, 5, 0, Math.PI * 2);   
					fill();     
					//var radius=20;
					//ctx.clearRect(x, y, radius, radius);
					$('canvas').css("opacity",0.99);  
					setTimeout(function(){
						$('canvas').css("opacity",1);  
						},5);
					             
				}                
			}             
		}               
		canvas.width=w;             
		canvas.height=h;    
		                
		ctx=canvas[0].getContext('2d');             
		ctx.fillStyle='transparent';             
		ctx.fillRect(0, 0, w, h);    
		layer(ctx);               
		ctx.globalCompositeOperation = 'destination-out';               
		canvas[0].addEventListener('touchstart', eventDown);             
		canvas[0].addEventListener('touchend', eventUp);             
		canvas[0].addEventListener('touchmove', eventMove);             
		canvas[0].addEventListener('mousedown', eventDown);             
		canvas[0].addEventListener('mouseup', eventUp);             
		canvas[0].addEventListener('mousemove', eventMove);    
		$('.prize_text').show();
		canvas.css({'background-image':'url('+img.src+')'});
		
	});
	
	img.src = '{$config_siteurl}/statics/Scratch/text_bg.png';

}
function openSuccessDialog(){
	var successHtml = "<div class='common_dialog lqcg'>"
		+"<h6>你的运气太好了！</h6><p class='p_10'>你获得了{$prize.title},奖品是{$prize.name}，请联系客服领取。</p>"
		+"<div class='tb'><a class='btn m_15 flex_1' href='###' onClick='$.Dialog.close();'>去领取</a></div>"
		+"</div>";
		$.Dialog.open(successHtml);
	}
function openErrorDialog(){
	var successHtml = "<div class='common_dialog lqcg'>"
		+"<h6>很抱歉！没有中奖，还需继续努力</h6><notempty name='data.max_num'><p class='p_10'>你还有{$prize.count|intval}次机会。</p></notempty>"
		+"<div class='tb'><a class='btn m_15 flex_1' href='###' onClick='$.Dialog.close();'>确 定</a></div>"
		+"</div>";
		$.Dialog.open(successHtml);
	}
function set_sn_code(){
	var url = "{:U('Scratch/set_sn_code')}";
	var id = "{$data.id}";
	var prize_id = "{$prize.id|intval}";
	$.post(url, {id:id, prize_id:prize_id});	
}
</script>	
</body>
</html>
