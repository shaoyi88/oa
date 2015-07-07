var hospital = function(){
	var form;

	var init = function(){
		form = $(".Huiform").Validform({
			tiptype : 4,
			tipSweep : true
		});
        $('.dTree tr').click(changeHospital);
	};

	var changeHospital = function(event){
		var hid = $(event.currentTarget).attr('hid');
		window.location.href = $('#workerUrl').val()+'?pid='+hid;
	};

	init();
}();