var stat = function(){
	var init = function(){
		$.Huitab(".HuiTab .tabBar span",".HuiTab .tabCon","current","click",$('#tabType').val());
		$(".Huiform").Validform({
			tiptype : 4,
			tipSweep : true
		});
		$('#customer_type').change(customerTypeChange);
	};
	
	var customerTypeChange = function(event){
		var type = $(event.currentTarget).val();
		if(type == 2){
			$('#hospitalInfo').show();
		}else{
			$('#hospitalInfo').hide();
		}
	};

	init();
}();