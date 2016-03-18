

//60秒倒计时
var wait=60; 
function time(o) { 
	if (wait == 0) { 
		o.removeAttribute("disabled");
		o.value="提交";
		$("#content").attr("readonly",false);
		wait = 60;
	} else { 
		o.setAttribute("disabled", true);
		//o.value=wait+"秒后可以重新提交";
		o.value="正在提交";
		$("#content").attr("readonly",true);
		//$("#content").val("");
		wait--;
		setTimeout(function() {
			time(o)
		},
		1000)
	} 
}

//
$(document).ready(function() {
	
	//提交评论、留言
	$(".subFrom").click(function(){
		var newid = $("#newid").val();
		var content = $("#content").val();
		if(content == ''){
			alert("内容不能为空");
			return false;
		}
		if(newid > 0){
			var data = "content="+content+"&newid="+newid;
		}else{
			var data = "content="+content;
		}
		time(this);
		document.getElementById("FromID").submit();
		/*$.ajax({
			type: "POST",
			url: Fromurl,
			data: data,
			success: function(msg){
				var dataObj=eval("("+msg+")");
				if(dataObj["status"] == 1){
					window.location.reload();
				}else{
					alert("网络错误，请重新填写提交");
					window.location.reload();
				}
			}
		})*/
	});
});

function txtit(num){
	if(num>0){
		var subcon = $(".more_"+num);
		var status = $(".more_"+num).css("display");
		if (status == "block") {
			subcon.fadeOut();
		} else {
			subcon.fadeIn();
		}
	}
}

