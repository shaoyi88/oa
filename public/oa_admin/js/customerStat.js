var stat = function(){
	var init = function(){
		$.Huitab(".HuiTab .tabBar span",".HuiTab .tabCon","current","click",$('#tabType').val());
		$(".Huiform").Validform({
			tiptype : 4,
			tipSweep : true
		});
		$('#customer_type').change(customerTypeChange);
		$('#customer_hospital').change(hospitalChange);
	};
	
	
	var customerTypeChange = function(event){
		var type = $(event.currentTarget).val();
		if(type == 2){
			$('#hospitalInfo').show();
		}else{
			$('#hospitalInfo').hide();
		}
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

	init();
}();