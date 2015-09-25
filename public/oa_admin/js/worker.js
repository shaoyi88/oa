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
        $("#getcity").keyup(getcity);
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
	            	 if(changeTarget=='worker_domicile_city'){
	            	     $('#getcity').val('');
	            	     $('.cityselect').hide();
                         $('.cityselect li').remove();
	            	     $('#citysearch').show();
	            	 }
	            	 if(changeTarget=='worker_domicile_district'){
	            	     $('#citysearch').hide();
	            	 }
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

    var getcity = function(event){
        if($(event.currentTarget).val().length==0){
            $('.cityselect').hide();
            $('.cityselect li').remove();
			return;
		}else{
		    $('.cityselect').show();
		    $('.cityselect li').remove();
		    var getCityUrl = $('#getCityUrl').val()+'?pid='+$('#worker_domicile_province').val()+'&k='+$(event.currentTarget).val();
			getCityUrl=encodeURI(getCityUrl);
			$.ajax({
	            type: "GET",
	            url: getCityUrl,
	            dataType: "json",
	            success: function(data){
	                 if(data.length>0){
	                     $('.cityselect li').remove();
	            	     for(var i=0;i<data.length;i++){
	            	         $('.cityselect').append('<li id="'+data[i]['area_id']+'">'+data[i]['area_name']+'</li>');
	            	     }
	            	     $('.cityselect li').click(goarea);
	            	 }
	            }
	        });
		    return;
		}
    };

    var goarea = function(event){
        var areaid = $(event.currentTarget).attr('id');
        $('#worker_domicile_city').val(areaid);
		$('#worker_domicile_city').trigger('change');
		$('#citysearch').hide();
		$('.cityselect').hide();
        $('.cityselect li').remove();
    }

	init();
}();