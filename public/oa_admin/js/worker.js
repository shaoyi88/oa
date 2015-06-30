var worker = function(){
	var form;

	var init = function(){
		form = $(".Huiform").Validform({
			tiptype : 4,
			tipSweep : true
		});
		$('.del').click(del);
		$('#worker_domicile_province,#worker_domicile_city').change(areaChange);
        $('#worker_hospital').change(hospitalChange);
        $('.delsta').click(delsta);
        $('.addsta').click(addsta);
	};

	var del = function(event){
		var wid = $(event.currentTarget).attr('wid');
		layer.confirm('确定删除吗？',function(index){
		    window.location.href = $('#delUrl').val()+'?wid='+wid;
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

    var delsta = function(event){
        var index = $("#sta li span a").index(event.currentTarget);
        $("#sta li").eq(index).remove();
    };

    var addsta = function(){
        var html = '<li style="margin-bottom:5px;"><input name="stationary[]" style="width:80%;" type="text" class="input-text" >&nbsp;<span><a href="javascript:void(0)" class="delsta">&times;</a></span></li>';
        $("#sta").append(html);
        $('.delsta').unbind('click');
        $('.delsta').click(delsta);
    };

	init();
}();