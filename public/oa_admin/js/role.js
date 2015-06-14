var role = function(){
	var init = function(){
		$(".Huiform").Validform({
			tiptype : 1,
			tipSweep : true
		});
		$('.del').click(del);
		$('.allSelect').click(allSelect);
	};
	
	var allSelect = function(){
		var inputNum = $('input[type=checkbox]').length;
		var checkNum = $('input[type=checkbox]:checked').length;
		if(checkNum < inputNum){
			$('input[type=checkbox]').prop("checked", true); 
		}else{
			$('input[type=checkbox]').prop("checked", false); 
		}
	};
	
	var del = function(event){
		var id = $(event.currentTarget).attr('rid');
		layer.confirm('确定删除吗？',function(index){
		    window.location.href = $('#delUrl').val()+'?id='+id;
		});
	};
	
	init();
}();