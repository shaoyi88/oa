var user = function(){
	var form;
	
	var init = function(){
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
				var customer_hobby = $('.customer_hobby:checked').val();
				var other_hobby = $('#other_hobby').val();
				if(typeof customer_hobby == 'undefined'){
					layer.msg('个人特殊嗜好不可为空');
					return false;
				}else if(customer_hobby == '其他' && other_hobby == ''){
					layer.msg('其他个人特殊嗜好必须填写');
					return false;
				}
				var customer_state = $('.customer_state:checked').val();
				var other_state = $('#other_state').val();
				if(typeof customer_state == 'undefined'){
					layer.msg('意识状态不可为空');
					return false;
				}else if(customer_state == '其他' && other_state == ''){
					layer.msg('其他意识状态必须填写');
					return false;
				}
			},
		});
		$('#customer_type').change(customerTypeChange);
		$('#customer_service_type').change(customerServiceTypeChange);
	};
	
	var customerServiceTypeChange = function(event){
		var type = $(event.currentTarget).val();
		if(type == 1 || type == 2 || type == 3){
			$('.tr_service_info_1').show().find('input,select').attr('ignore', '');
			$('.tr_service_info_2').hide().find('input').attr('ignore', 'ignore');
		}else if(type == 4){
			$('.tr_service_info_1').hide().find('input,select').attr('ignore', 'ignore');
			$('.tr_service_info_2').show().find('input').attr('ignore', '');
		}else{
			$('.tr_service_info_1').hide().find('input,select').attr('ignore', 'ignore');
			$('.tr_service_info_2').hide().find('input').attr('ignore', 'ignore');
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

	init();
}();