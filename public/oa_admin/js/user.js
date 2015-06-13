var user = function(){
	var init = function(){
		$(".Huiform").Validform({
			tiptype : 4
		});
		$('.del').click(del);
	};
	
	var del = function(event){
		var uid = $(event.currentTarget).attr('uid');
		layer.confirm('确定删除吗？',function(index){
		    window.location.href = $('#delUrl').val()+'?uid='+uid;
		});
	};
	
	init();
}();