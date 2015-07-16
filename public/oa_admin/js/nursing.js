var nursing = function(){
	var form;
	
	var init = function(){
		form = $(".Huiform").Validform({
			tiptype : 4,
			tipSweep : true
		});
		
		$('#customer_name').keyup(customerChange);
		$('.delPlan').click(delPlan);
		$('.delReturn').click(delReturn);
		$('.orderDetail').click(orderDetail);
		$('.customerDetail').click(customerDetail);
		$('.workerDetail').click(workerDetail);
		$('.planDetail').click(planDetail);
		$('#return_time').focus(function(){
			var myDate = new Date();
			var mytime=myDate.toLocaleDateString();  
			WdatePicker({readOnly:true,dateFmt:'yyyy-MM-dd HH:mm:ss',minDate:mytime});
		});
		$('#executive_admin_id').change(executiveAdminChange);
	};
	
	var executiveAdminChange = function(event){
		if($(event.currentTarget).val() == ''){
			var adminName = '';
		}else{
			var adminName = $(event.currentTarget).find('option:selected').text();
		}
		$('#executive_admin_name').val(adminName);
	};
	
	var planDetail = function(event){
		var pid = $(event.currentTarget).attr('pid');
		$.layer({
		    type: 2,
		    shadeClose: true,
		    title: '护理计划详情',
		    closeBtn: [0, true],
		    shade: [0.8, '#000'],
		    border: [0],
		    offset: ['20px',''],
		    area: ['1000px', ($(window).height() - 50) +'px'],
		    iframe: {src: $('#planDetailUrl').val()+'?hideTitle=1&pid='+pid}
		});
	};
	
	var orderDetail = function(event){
		var oid = $(event.currentTarget).attr('oid');
		$.layer({
		    type: 2,
		    shadeClose: true,
		    title: '订单详情',
		    closeBtn: [0, true],
		    shade: [0.8, '#000'],
		    border: [0],
		    offset: ['20px',''],
		    area: ['1000px', ($(window).height() - 50) +'px'],
		    iframe: {src: $('#orderDetailUrl').val()+'?hideTitle=1&oid='+oid}
		});
	};
	
	var customerDetail = function(event){
		var cid = $(event.currentTarget).attr('cid');
		$.layer({
		    type: 2,
		    shadeClose: true,
		    title: '客户详情',
		    closeBtn: [0, true],
		    shade: [0.8, '#000'],
		    border: [0],
		    offset: ['20px',''],
		    area: ['1000px', ($(window).height() - 50) +'px'],
		    iframe: {src: $('#customerDetailUrl').val()+'?hideTitle=1&cid='+cid}
		});
	};
	
	var workerDetail = function(event){
		var wid = $(event.currentTarget).attr('wid');
		$.layer({
		    type: 2,
		    shadeClose: true,
		    title: '护工详情',
		    closeBtn: [0, true],
		    shade: [0.8, '#000'],
		    border: [0],
		    offset: ['20px',''],
		    area: ['1000px', ($(window).height() - 50) +'px'],
		    iframe: {src: $('#workerDetailUrl').val()+'?hideTitle=1&wid='+wid}
		});
	};
	
	var delPlan = function(event){
		var pid = $(event.currentTarget).attr('pid');
		layer.confirm('确定删除该护理计划吗？',function(index){
		    window.location.href = $('#delPlanUrl').val()+'?pid='+pid;
		});
	};
	
	var delReturn = function(event){
		var rid = $(event.currentTarget).attr('rid');
		layer.confirm('确定删除该回访记录吗？',function(index){
		    window.location.href = $('#delReturnUrl').val()+'?rid='+rid;
		});
	};
	
	var customerChange = function(event){		
		var customerName = $(event.currentTarget).val();
		var getInfoUrl = $('#getInfoUrl').val()+'?customerName='+customerName;
		$('.auto-complete-result').html('').hide();
		$('#customer_id').val('');
		$('#worker_id').val('');
		$('#order_id').val('');
		$('#order_no').val('');
		$('#worker_name').val('');
		$('#submitAddPlan').addClass('disabled');
		if(customerName == ''){
			return;
		}
		$.ajax({
            type: "GET",
            url: getInfoUrl,
            dataType: "json",
            success: function(data){
            	if(data.status == 1){
            		var template = Hogan.compile($('#customerTpl').html(),{delimiters:'<% %>'});
            		$('.auto-complete-result').html(template.render({infoList:data.infoList})).show();
            		$('.auto-complete-result').find('li').hover(function(event){
            			$(event.currentTarget).addClass('focus');
            		},function(event){
            			$(event.currentTarget).removeClass('focus');
            		}).click(function(event){
            			$('#customer_id').val($(event.currentTarget).attr('cid'));
            			$('#worker_id').val($(event.currentTarget).attr('wid'));
            			$('#order_id').val($(event.currentTarget).attr('oid'));
            			$('#order_no').val($(event.currentTarget).attr('order_no'));
            			$('#worker_name').val($(event.currentTarget).attr('worker_name'));
            			$('.auto-complete-result').hide();
            			$('#submitAddPlan').removeClass('disabled');
            		});
            	}
            }
        });
		
	};
	
	init();
}();