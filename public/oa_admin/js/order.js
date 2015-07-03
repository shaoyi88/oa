var order = function(){
	var form;
	
	var init = function(){
		form = $(".Huiform").Validform({
			tiptype : 4,
			tipSweep : true
		});
		$('#user_key').keyup(userChange);
		$('#customer_id').change(customerChange);
		$('#order_start_time').focus(function(){
			var myDate = new Date();
			var mytime=myDate.toLocaleDateString();  
			WdatePicker({readOnly:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:mytime});
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