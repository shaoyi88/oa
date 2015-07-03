var user = function(){
	var form;
	var addFollowForm;
	
	var init = function(){
		addFollowForm = $("#addFollowForm").Validform({
			tiptype : 4,
			tipSweep : true
		});
		form = $(".Huiform").Validform({
			tiptype : 4,
			tipSweep : true,
			beforeSubmit:function(curform){
				var customer_language = $('.customer_language:checked').val();
				var other_language = $('#other_language').val();
				var customer_service_type = $('#customer_service_type').val();
				if(typeof customer_language == 'undefined'){
					layer.msg('常用语言不可为空');
					return false;
				}else if(customer_language == '其他' && other_language == ''){
					layer.msg('其他语言必须填写');
					return false;
				}
				if(customer_service_type == 4){
					return true;
				}
			},
		});
		$('#customer_type').change(customerTypeChange);
		$('#customer_service_type').change(customerServiceTypeChange);
		$('.del').click(del);
		$('#addFollow').click(addFollow);
		$('.delFollow').click(delFollow);
		$('#user_key').keyup(userChange);
		$('#customer_hospital').change(hospitalChange);
	};
	
	var addFollow = function(){
		addFollowForm.resetForm();
		$('.Validform_checktip').html('');
		$('#submitAddFollow').addClass('disabled');
		$('#relationship').val('');
		$('#user_key').val('');
		$('#user_id').val('');
		$.layer({
		    type: 1,
		    area: ['600px', '280px'],
		    title: [
		        '增加关注我的用户',
		        'border:none; background:#61BA7A; color:#fff;' 
		    ],
		    bgcolor: '#eee', //设置层背景色
		    page: {dom : '#addFollowWindow'}
		});
	};
	
	var delFollow = function(event){
		var fid = $(event.currentTarget).attr('fid');
		layer.confirm('确定删除该关注病人吗？',function(index){
		    window.location.href = $('#delFollowUrl').val()+'&fid='+fid;
		});
	};
	
	var hospitalChange = function(event){
		var changeTarget = $(event.currentTarget).attr('target');
		var pid = $(event.currentTarget).val();
		if(pid == ''){
			var template = Hogan.compile($('#departmentTpl').html(),{delimiters:'<% %>'});
			$('#'+changeTarget).html(template.render({departmentList:[]}));
		}else{
			var getDepartmentUrl = $('#getDepartmentUrl').val()+'?pid='+$(event.currentTarget).val();
			$.ajax({
	            type: "GET",
	            url: getDepartmentUrl,
	            dataType: "json",
	            success: function(data){
	            	 var template = Hogan.compile($('#departmentTpl').html(),{delimiters:'<% %>'});
	            	 $('#'+changeTarget).html(template.render({departmentList:data}));
	            }
	        });
		}
	};
	
	var userChange = function(event){		
		var userKey = $(event.currentTarget).val();
		var getUserUrl = $('#getUserUrl').val()+'?key='+userKey;
		$('.auto-complete-result').html('').hide();
		$('#user_id').val('');
		$('#submitAddFollow').addClass('disabled');
		if(userKey == ''){
			return;
		}
		$.ajax({
            type: "GET",
            url: getUserUrl,
            dataType: "json",
            success: function(data){
            	if(data.status == 1){
            		var template = Hogan.compile($('#userTpl').html(),{delimiters:'<% %>'});
            		$('.auto-complete-result').html(template.render({userList:data.userList})).show();
            		$('.auto-complete-result').find('li').hover(function(event){
            			$(event.currentTarget).addClass('focus');
            		},function(event){
            			$(event.currentTarget).removeClass('focus');
            		}).click(function(event){
            			$('#user_id').val($(event.currentTarget).attr('uid'));
            			$('#user_key').val($(event.currentTarget).html());
            			$('.auto-complete-result').hide();
            			$('#submitAddFollow').removeClass('disabled');
            		});
            	}
            }
        });
		
	};
	
	var customerServiceTypeChange = function(event){
		var type = $(event.currentTarget).val();
		if(type == 1 || type == 2 || type == 3){
			$('.tr_service_info_1').show();
			$('.tr_service_info_2').hide();
		}else if(type == 4){
			$('.tr_service_info_1').hide();
			$('.tr_service_info_2').show();
		}else{
			$('.tr_service_info_1').hide();
			$('.tr_service_info_2').hide();
		}
	};
	
	var customerTypeChange = function(event){
		var type = $(event.currentTarget).val();
		if(type == 1){
			$('#tr_customer_address').show().find('input').attr('ignore', '');
			$('#tr_customer_hospital').hide().find('input,select').attr('ignore', 'ignore');
		}else if(type == 2){
			$('#tr_customer_address').hide().find('input').attr('ignore', 'ignore');
			$('#tr_customer_hospital').show().find('input,select').attr('ignore', '');
		}else{
			$('#tr_customer_address').hide().find('input').attr('ignore', 'ignore');
			$('#tr_customer_hospital').hide().find('input,select').attr('ignore', 'ignore');
		}
	};
	
	var del = function(event){
		var cid = $(event.currentTarget).attr('cid');
		layer.confirm('确定删除吗？',function(index){
		    window.location.href = $('#delUrl').val()+'?cid='+cid;
		});
	};

	init();
}();