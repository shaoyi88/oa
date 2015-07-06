var customerservice = function(){
	var form;

	var init = function(){
		form = $(".Huiform").Validform({
			tiptype : 4,
			tipSweep : true
		});
		$('.del').click(del);
	};

	var del = function(event){
		var wid = $(event.currentTarget).attr('id');
		layer.confirm('确定删除吗？',function(index){
		    window.location.href = $('#delUrl').val()+'?id='+wid;
		});
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