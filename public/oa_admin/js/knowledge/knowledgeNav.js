$(document).ready(function() {
	$("#two1").show();//打开页面时，默认让第一个显示
	$('.chooseOne').on('click',function(){
		var acction_id = $(this).attr('value');
		var shwoView = "#two"+acction_id;
		$(".threeChoose").hide();		
		$(".showNav").hide();
		$(".endnav").hide();
		$(shwoView).show();
	})
	
	$('.chooseTwo').on('click',function(){// content显示内容--按钮
		var cat_pid = $(this).attr('value');
		var shwoViewT = "#third"+ cat_pid;
		$(".threeChoose").hide();
		$(".endnav").hide();
		$(shwoViewT).show();		
	})
	$('.nextNav').on('click',function(){
		var cat_id = $(this).attr('value');
		$.ajax({url: '/oa_admin/knowledge/gettopNav',type: 'POST',data: {'cat_pid':cat_id},dataType:'json',async: true,timeout: 3000,
			success: function (data) { 
			if(data!=''){
				var options_str = '';
				$.each(data,function(i, item){
					options_str += '<button type="button" class="btn btn-default nextNav" value="' + item.cat_id + '"><a href="/oa_admin/knowledge/navManagement/' + item.cat_id + '" class=" icon-pencil"></a>"'+ item.cat_name + '"</button>&nbsp;&nbsp;&nbsp;';
				});
				$('.lastChoose').show();
				$("#lastNav").html(options_str);
			}
			}
		});
	})
}); 


