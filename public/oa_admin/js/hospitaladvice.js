var hospitaladvice = function(){
	var form;

	var init = function(){
		form = $(".Huiform").Validform({
			tiptype : 4,
			tipSweep : true
		});
		$('#hospital_id').change(hospitalChange);
		$('.del').click(del);
	};

	var del = function(event){
		var wid = $(event.currentTarget).attr('id');
		layer.confirm('确定删除吗？',function(index){
		    window.location.href = $('#delUrl').val()+'?id='+wid;
		});
	};

	var hospitalChange = function(event){
		var changeTarget = $(event.currentTarget).attr('target');
		var pid = $(event.currentTarget).val();
		if(pid == ''){
			var template = Hogan.compile($('#hospitalTpl').html(),{delimiters:'<% %>'});
			$('#'+changeTarget).html(template.render({hospitalList:[]}));
			$('#'+changeTarget).change();
		}else{
			var getHospitalsUrl = $('#getHospitalsUrl').val()+'?pid='+$(event.currentTarget).val();
			$.ajax({
	            type: "GET",
	            url: getHospitalsUrl,
	            dataType: "json",
	            success: function(data){
	            	 var template = Hogan.compile($('#hospitalTpl').html(),{delimiters:'<% %>'});
	            	 $('#'+changeTarget).html(template.render({hospitalList:data}));
	            }
	        });
		}
	};

	init();
}();