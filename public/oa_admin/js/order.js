var order = function(){
	var form;
	
	var init = function(){
		form = $(".Huiform").Validform({
			tiptype : 4,
			tipSweep : true,
			datatype:{
				"collection_amount":function(gets,obj,curform,regxp){
					var	reg1=/^-?\d+$/;
					if(reg1.test(gets)){return true;}
					return false;
				}	
			}
		});
		$('#user_key').keyup(userChange);
		$('#customer_id').change(customerChange);
		$('#order_start_time').focus(function(){
			var myDate = new Date();
			var mytime=myDate.toLocaleDateString();  
			WdatePicker({readOnly:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:mytime});
		});
		$('#order_end_time').focus(function(){
			var myDate = new Date();
			var mytime=$('#order_start_time').html();  
			WdatePicker({
				readOnly:true,
				dateFmt:'yyyy-MM-dd HH:mm:ss',
				minDate:mytime,
				onpicked:calculateOrderCost
			});
		});
		$('.cancel').click(cancelOrder);
		$('.del').click(delOrder);
		$('#collection_type').change(collectionTypeChange);
	};
	
	var calculateOrderCost = function(dp){
		var endTime = Date.parse(new Date(dp.cal.getNewDateStr().replace(/-/g,'/')))/1000;
		var timeUnit = $('#timeUnit').val();
		var orderFee = $('#order_fee').val();
		var advancePayment = $('#order_advance_payment').val();
		var workerTime = 0;
		//统计每个护工的服务时间总和，服务中的护工以选择的结束时间作为服务截止时间
		$('.worker').each(function(index,element){
			var $worker = $(element).find('input');
			var workerStartTime = $worker.attr('start_time');
			var workerEndTime = $worker.attr('end_time') ? $worker.attr('end_time') : endTime;
			var time = workerEndTime-workerStartTime;
			if(time < 0){
				time = 0;
			}
			workerTime += time;
		});
		var balance = Math.round(workerTime/timeUnit*orderFee)-advancePayment; 
		$('#collection_amount_2').val(balance);
	};
	
	var collectionTypeChange = function(event){
		var type = $(event.currentTarget).val();
		$('.payment_1,.payment_2').find('input').val('');
		if(type == 1){
			$('.payment_1').show().find('input').attr('ignore', '');
			$('.payment_2').hide().find('input').attr('ignore', 'ignore');
		}else if(type == 2){
			$('.payment_1').hide().find('input').attr('ignore', 'ignore');
			$('.payment_2').show().find('input').attr('ignore', '');
		}else{
			$('.payment_1').hide().find('input').attr('ignore', 'ignore');
			$('.payment_2').hide().find('input').attr('ignore', 'ignore');
		}
	};
	
	var delOrder = function(event){
		var oid = $(event.currentTarget).attr('oid');
		layer.confirm('确定删除该订单吗？',function(index){
		    window.location.href = $('#delUrl').val()+'?oid='+oid;
		});
	};
	
	var cancelOrder = function(event){
		var oid = $(event.currentTarget).attr('oid');
		layer.confirm('确定取消该订单吗？',function(index){
		    window.location.href = $('#cancelUrl').val()+'?oid='+oid;
		});
	};
	
	var customerChange = function(event){
		var customer_id = $(event.currentTarget).val();
		if(customer_id == ''){
			$('#submitAddOrder').addClass('disabled');
		}else{
			$('#submitAddOrder').removeClass('disabled');
		}
	};
	
	var userChange = function(event){		
		var userKey = $(event.currentTarget).val();
		var getUserUrl = $('#getUserUrl').val()+'?key='+userKey;
		$('.auto-complete-result').html('').hide();
		$('#user_id').val('');
		$('#submitAddOrder').addClass('disabled');
		var template = Hogan.compile($('#customerTpl').html(),{delimiters:'<% %>'});
		$('#customer_id').html(template.render({customerList:[]}));
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
            			var getFollowCustomerUrl = $('#getFollowCustomerUrl').val()+'?uid='+$(event.currentTarget).attr('uid');
            			$.ajax({
            	            type: "GET",
            	            url: getFollowCustomerUrl,
            	            dataType: "json",
            	            success: function(data){
            	            	if(data.status == 1){
            	            		var template = Hogan.compile($('#customerTpl').html(),{delimiters:'<% %>'});
            	            		$('#customer_id').html(template.render({customerList:data.customerList}));
            	            	}
            	            }
            	        });
            			//$('#submitAddOrder').removeClass('disabled');
            		});
            	}
            }
        });
		
	};
	
	init();
}();