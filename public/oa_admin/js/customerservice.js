var customerservice = function(){
	var form;

	var init = function(){
		form = $(".Huiform").Validform({
			tiptype : 4,
			tipSweep : true
		});
		$('.del').click(del);
		$('#cs_user_phone').blur(getorder);
	};

	var del = function(event){
		var wid = $(event.currentTarget).attr('id');
		layer.confirm('确定删除吗？',function(index){
		    window.location.href = $('#delUrl').val()+'?id='+wid;
		});
	};

	var getorder = function(event){
        var phone = $(event.currentTarget).val();
        if(phone!=''){
            var getUserOrder = $('#getUserOrder').val()+'?user_phone='+$(event.currentTarget).val();
            var orderDetail = $('#orderDetail').val();
			$.ajax({
	            type: "GET",
	            url: getUserOrder,
	            dataType: "json",
	            success: function(data){
	                 if($('#orderInfo')){
	                     $('#orderInfo').remove();
	                 }
	                 var text = '<tr id="orderInfo"><th class="text-r" width="80">相关订单：<br/>(最近5单)&nbsp;</th><td>';
	                 var len = data.length;
	                 if(len>0){
	                     text += '<table class="table table-bg table-border table-bordered"><tbody><tr class="text-c"><th>&nbsp;</th><th>订单编号</th><th>客户名字</th><th>服务类型</th><th>服务模式</th><th>收费</th><th>开始时间</th><th>截至时间</th><th>预收款</th><th>费用总额</th><th>订单状态</th></tr>';
	                     if(data[0]['user_name']){
	                         $('#cs_user_name').val(data[0]['user_name']);
	                     }
                         for(var i=0;i<len;i++){
                             if(i<5){ //对应上面只显示最近5单
                                 text += '<tr class="text-c"><td><input type="radio" name="cs_user_order" value="'+data[i]['order_id']+'"></td><td><a class="c-primary" title="详情" href="'+orderDetail+'?oid='+data[i]['order_id']+'"><u class="c-primar">'+data[i]['order_no']+'</u></a></td><td>客户名字</td><td>'+data[i]['service_type']+'</td><td>'+data[i]['service_mode']+'</td><td>'+data[i]['order_fee_unit']+'</td><td>'+data[i]['order_start_time']+'</td><td>'+data[i]['order_end_time']+'</td><td>'+data[i]['order_advance_payment']+'</td><td>'+data[i]['order_total_cost']+'</td><td>'+data[i]['order_status']+'</td><tr>';
                             }
                         }
	                 }else{
	                     text += '该用户还没有过订单';
	                     $('#cs_user_name').val('');
	                 }
	                 text += '</td></tr>';
	                 $('#username').after(text);
	            }
	        });
	        return;
        }
	};

	init();
}();
var chart = function(div,xset,yset){
            var chart = new Highcharts.Chart({
                chart: {
                    renderTo: div,
                    type: 'column',
                },
                credits: {
                    enabled: false
                },
                title: {
                    text: '客服问题统计分析'
                },
                xAxis: {
                    categories: xset,
                },
                yAxis: {
                    title: {
                        text: '数量'
                    },
                    stackLabels: {
                        enabled: true,
                        style: {
                            fontWeight: 'bold',
                            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                        }
                     },
                     max: null
                },
                plotOptions: {
                  column: {
                    stacking: 'normal',
                  },
                  series: {
                    dataLabels: {
                      enabled: true,
                      style:{"color": "#fff", "fontSize": "11px", "fontWeight": "bold", "textShadow": "0 0 6px contrast, 0 0 3px contrast" },
                    },
                  }
                },
                tooltip: {
                  enabled: false
                },
                series: yset
            });
    };