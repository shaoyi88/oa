var admin = function(){
	var init = function(){
		$(".Huiform").Validform({
			tiptype : 4
		});
		$('.dTree tr').click(changeDepartment);
		$('.del').click(del);
	};
	
	var changeDepartment = function(event){
		var did = $(event.currentTarget).attr('did');
		window.location.href = $('#indexUrl').val()+'?pid='+did;
	};
	
	var del = function(event){
		var id = $(event.currentTarget).attr('aid');
		var pid = $(event.currentTarget).attr('pid');
		layer.confirm('确定删除吗？',function(index){
		    window.location.href = $('#delUrl').val()+'?id='+id+'&pid='+pid;
		});
	};
	
	init();
}();