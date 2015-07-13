$(document).ready(function() {
	$('.add-but').on('click',function(){// 展示添加信息的窗口
	    var get_form=document.getElementById("add-detail");
	    if(get_form.style.display=="none"){
	        get_form.style.display="block"
	    }else
	    {   
	       get_form.style.display="none"
	    }
	});

	$("#select-nav").change(function(){//下拉框选着
		var checkValue=$("#select-nav").val();
		var showSelect = "#choose" +  checkValue;
		$(".twoChoose").hide();
		$('.threeChoose').hide();
		$('.lastChoose').hide();
		$(showSelect).show();
	});

	$(".selectNavSecond").change(function(){// 第三级菜单显示
		var checkValue=$(this).val();
		var res = "#other" +  checkValue;
		$(".threeChoose").hide();
		$(res).show();
	});

	$('.selectNavTree').change(function(){// 第4级菜单显示
		var lastValue=$(this).val();
		$.ajax({url: '/oa_admin/knowledge/gettopNav',type: 'POST',data: {'cat_pid':lastValue},dataType:'json',async: true,timeout: 3000,
			success: function (data) { 
			if(data!=''){
				var options_str = '';
				$.each(data,function(i, item){
					options_str += '"<option class ="select-type" value="' + item.cat_id + '">"' + item.cat_name + '"</option>';
				});
				$('.lastChoose').show();
				$("#lastNav").append(options_str);
			}else(
				alert('last nav')
			)
			}
		});
	})


	$("#ww1").show();//打开页面时，默认让第一个显示
	$('.oneNav').on('click',function(){
		var acction_id = $(this).attr('value');
		var shwoView = "#ww"+acction_id;
		$(".showtwoNav").hide();		
		$(shwoView).show();
	})
	
	$('.but-one').on('click',function(){// content显示内容--按钮
		var cat_pid = $(this).attr('id');
		$.ajax({url: '/oa_admin/knowledge/gettopNav',type: 'POST',data: {'cat_pid':cat_pid },dataType:'json',async: true,timeout: 3000,
				success: function (data) { 
					var _html = ''; 
					$.each(data, function(index, catPid){
					_html += '<input type="button" class="btn btn-default radius thirdNav" style="line-height:1.6em;margin-top:3px" id="' +catPid.cat_id+ '" value="' +catPid.cat_name+ '" >&nbsp;&nbsp;';
					}); 
				$('#shownavThird').html(_html);
				$('.thirdNav').on('click',function(){
					var info_id = $(this).attr('id');
					$.ajax({
						url: '/oa_admin/knowledge/detail',type: 'POST',data: {'cat_pid':info_id },dataType:'json',async: true,
						success: function (data) {
							console.log(data)
							if(data.msg == 'nav'){
								var _html = '';
								$.each(data.navdata, function(index, butOne){
								_html += '<input type="button" class="btn btn-default round thirdNav" id="' +butOne.cat_id+ '" style="line-height:1.6em;margin-top:3px" value="' +butOne.cat_name+ '">&nbsp;&nbsp;';
								}); 
								$('#nav-four').html(_html);
							}
							else if(data.msg == 'content'){
								var html = '';
								$.each(data.kenwledge_detail, function(index, knowledgeContent){
									_html += '';
									_html += '<tr class="text-c" id ="knowledgeValue">';
									_html += '  <td><input type="checkbox" value="2" name=""></td>';
									_html += '  <td>"' +knowledgeContent.info_id+ '"</td>';
									_html += '  <td>"' +knowledgeContent.info_title+ '"</td>';
									_html += '  <td>"' +knowledgeContent.info_detail+ '"</td>';
									_html += '  <td>"' +knowledgeContent.add_time+ '"</td>';
									_html += '  <td class="admin-status"><span class="label radius">"' +knowledgeContent.info_order+ '"</span></td>';
									_html += '  <td class="f-14 admin-manage"> ';
									_html += '    <a href="/oa_admin/knowledge/changeMsg/'+knowledgeContent.info_id+ '" title="编辑" class="ml-5 hahaha" style="text-decoration:none"><i class="icon-edit"></i></a>';
									_html += ' 	  <a href="/oa_admin/knowledge/deleteMsg/'+knowledgeContent.info_id+ '" title="删除" class="ml-5" style="text-decoration:none"><i class="icon-trash"></i></a>';
									_html += '  </td>';
								});
								$('#knowledgeValue').html(_html);
							}
						}
					})
				})
				}
			});
	})
	$('#addNewcontent').on('click',function(){
		var infoTitle = $('#addContentTitle').val();
		var infoDetail = $('.AddContentDetail').val();
		var infoCatid = $('.selectNavTree').val();
		alert(infoCatid);
		alert(infoTitle);
		alert(infoDetail);
	});
}); 





