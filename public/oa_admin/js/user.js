var user = function(){
	var form;
	
	var init = function(){
		form = $(".Huiform").Validform({
			tiptype : 4,
			tipSweep : true
		});
		$('.del').click(del);
		$('#user_province,#province,#city').change(areaChange);
		$('#addAddress').click(addAddress);
		$('.delAddress').click(delAddress);
		$('.setAddressIsDefault').click(setAddressIsDefault);
		$('#addCoupon').click(addCoupon);
		$('.delCoupon').click(delCoupon);
		$('#coupon_expire').focus(function(){
			var myDate = new Date();
			var mytime=myDate.toLocaleDateString();  
			WdatePicker({readOnly:true,dateFmt:'yyyy-MM-dd',minDate:mytime});
		});
		$('#addFollow').click(addFollow);
		$('.delFollow').click(delFollow);
		$('#customer_key').keyup(customerChange);
	};
	
	var customerChange = function(event){		
		var customerKey = $(event.currentTarget).val();
		var getCustomerUrl = $('#getCustomerUrl').val()+'?key='+customerKey;
		$('.auto-complete-result').html('').hide();
		$('#customer_id').val('');
		$('#submitAddFollow').addClass('disabled');
		if(customerKey == ''){
			return;
		}
		$.ajax({
            type: "GET",
            url: getCustomerUrl,
            dataType: "json",
            success: function(data){
            	if(data.status == 1){
            		var template = Hogan.compile($('#customerTpl').html(),{delimiters:'<% %>'});
            		$('.auto-complete-result').html(template.render({customerList:data.customerList})).show();
            		$('.auto-complete-result').find('li').hover(function(event){
            			$(event.currentTarget).addClass('focus');
            		},function(event){
            			$(event.currentTarget).removeClass('focus');
            		}).click(function(event){
            			$('#customer_id').val($(event.currentTarget).attr('cid'));
            			$('#customer_key').val($(event.currentTarget).html());
            			$('.auto-complete-result').hide();
            			$('#submitAddFollow').removeClass('disabled');
            		});
            	}
            }
        });
		
	};
	
	var delFollow = function(event){
		var fid = $(event.currentTarget).attr('fid');
		layer.confirm('确定删除该关注病人吗？',function(index){
		    window.location.href = $('#delFollowUrl').val()+'&fid='+fid;
		});
	};
	
	var delAddress = function(event){
		var aid = $(event.currentTarget).attr('aid');
		layer.confirm('确定删除该地址吗？',function(index){
		    window.location.href = $('#delAddressUrl').val()+'&aid='+aid;
		});
	};
	
	var delCoupon = function(event){
		var cid = $(event.currentTarget).attr('cid');
		layer.confirm('确定删除该红包吗？',function(index){
		    window.location.href = $('#delCouponUrl').val()+'&cid='+cid;
		});
	};
	
	var setAddressIsDefault = function(event){
		var aid = $(event.currentTarget).attr('aid');
		layer.confirm('确定设置该地址为默认地址吗？',function(index){
		    window.location.href = $('#setAddressIsDefaultUrl').val()+'&aid='+aid;
		});
	};
	
	var del = function(event){
		var uid = $(event.currentTarget).attr('uid');
		layer.confirm('确定删除吗？',function(index){
		    window.location.href = $('#delUrl').val()+'?uid='+uid;
		});
	};
	
	var areaChange = function(event){
		var changeTarget = $(event.currentTarget).attr('target');
		var pid = $(event.currentTarget).val();
		if(pid == ''){
			var template = Hogan.compile($('#areaTpl').html(),{delimiters:'<% %>'});
			$('#'+changeTarget).html(template.render({areaList:[]}));
			$('#'+changeTarget).change();
		}else{
			var getAreasUrl = $('#getAreasUrl').val()+'?pid='+$(event.currentTarget).val();
			$.ajax({
	            type: "GET",
	            url: getAreasUrl,
	            dataType: "json",
	            success: function(data){
	            	 var template = Hogan.compile($('#areaTpl').html(),{delimiters:'<% %>'});
	            	 $('#'+changeTarget).html(template.render({areaList:data}));
	            }
	        });
		}
	};
	
	var addAddress = function(){
		form.resetForm();
		$('.Validform_checktip').html('');
		$('#province').val('').change();
		$('#address').val('');
		$('#is_default').attr('checked', false);
		$.layer({
		    type: 1,
		    area: ['600px', '350px'],
		    title: [
		        '增加地址',
		        'border:none; background:#61BA7A; color:#fff;' 
		    ],
		    bgcolor: '#eee', //设置层背景色
		    page: {dom : '#addAddressWindow'}
		});
	};
	
	var addCoupon = function(){
		form.resetForm();
		$('.Validform_checktip').html('');
		$('#coupon_amount').val('');
		$('#coupon_condition').val('');
		$('#coupon_expire').val('');
		$.layer({
		    type: 1,
		    area: ['600px', '330px'],
		    title: [
		        '增加红包',
		        'border:none; background:#61BA7A; color:#fff;' 
		    ],
		    bgcolor: '#eee', //设置层背景色
		    page: {dom : '#addCouponWindow'}
		});
	};
	
	var addFollow = function(){
		form.resetForm();
		$('.Validform_checktip').html('');
		$('#submitAddFollow').addClass('disabled');
		$('#relationship').val('');
		$('#customer_key').val('');
		$('#customer_id').val('');
		$.layer({
		    type: 1,
		    area: ['600px', '280px'],
		    title: [
		        '增加关注病人',
		        'border:none; background:#61BA7A; color:#fff;' 
		    ],
		    bgcolor: '#eee', //设置层背景色
		    page: {dom : '#addFollowWindow'}
		});
	};
	
	init();
}();