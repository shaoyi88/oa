var department = function(){
	var init = function(){
		$(".Huiform").Validform({
			tiptype : 4
		});
		
		$('.edit').click(edit);
		$('.del').click(del);
	};
	
	var edit = function(event){
		var id = $(event.currentTarget).parent().attr('did');
		var name = $(event.currentTarget).parent().attr('dname');
		$('#editId').val(id);
		$('#editName').val(name);
		$.layer({
		    type: 1,
		    area: ['600px', 'auto'],
		    title: [
		        '编辑',
		        'border:none; background:#61BA7A; color:#fff;' 
		    ],
		    bgcolor: '#eee', //设置层背景色
		    page: {dom : '#editWindow'}
		});
	};
	
	var del = function(event){
		var did = $(event.currentTarget).parent().attr('did');
		layer.confirm('确定删除吗？',function(index){
		    window.location.href = $('#delUrl').val()+'?did='+did;
		});

	};

	init();
}();