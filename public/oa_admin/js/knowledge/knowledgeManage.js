$(document).ready(function(){
	$('#addcontent').on('click',function(){
		var cat_pid = $('.key_id').attr('id');
		var cat_name = $('.textarea').val();
		$.post("/oa_admin/knowledge/navdata",{'cat_pid':cat_pid,'cat_name':cat_name},function(result){
			if(result.msg ='ok'){
				location.href = "/oa_admin/knowledge/add_title"
			}else(
				alert('false')
			)
		  });
	})
	$('.subValue').on('click',function(){
	  var cat_id = $('.changeNav').attr('id');
	  var cat_name = $('.changeNav').val();
	  var cat_pid = $("#changeNtip").find("option:selected").attr("name");
	 	$.post("/oa_admin/knowledge/navupdate",{'cat_id':cat_id,'cat_pid':cat_pid,'cat_name':cat_name},function(result){
	 	if(result.msg ='ok'){
	 		location.href = "/oa_admin/knowledge/add_title"
	 	}else(
	 		alert('The same data')
	 	)
	    });
	});
	$('.delValue').on('click',function(){
	  var cat_id = $('.changeNav').attr('id');
	  	alert(cat_id)
	  	$.post("/oa_admin/knowledge/navdel",{'cat_id':cat_id},function(result){
		  	if(result.msg ='ok'){
		  		location.href = "/oa_admin/knowledge/add_title";
		  	}else{
		  		alert('false');
		  	}
		  	
	  	});
	});
})