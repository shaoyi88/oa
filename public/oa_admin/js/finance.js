var finance = function(){
	var form;

	var init = function(){
		form = $(".Huiform").Validform({
			tiptype : 4,
			tipSweep : true
		});
        $('.del').click(del);
        $('.canbill').click(canbill);
        $('.cancollect').click(cancollect);
        $('.goprint').click(goprint);
        $('.confirmbill').click(confirmbill);
        $('#prn_bill_no').click(billnoinput);
	};

	var del = function(event){
		var bid = $(event.currentTarget).attr('bid');
		layer.confirm('确定删除吗？',function(index){
		    window.location.href = $('#delUrl').val()+'?bid='+bid;
		});
	};

	var canbill = function(event){
		var bid = $(event.currentTarget).attr('bid');
		var num = parseInt($("#canceled"+bid).val(),10);
		if(isNaN(num)||num<=0){
		    layer.alert('作废数量必须大于0');
		    return false;
		}
		layer.confirm('确定要作废'+num+'张吗？',function(index){
		    var canBill = $('#canBill').val()+'?bid='+bid+'&num='+num;
		    layer.close(index);
			$.ajax({
	            type: "GET",
	            url: canBill,
	            dataType: "json",
	            success: function(data){
	                 if(data.status==2){
	                     layer.alert('没有这么多数量可作废');
	                     return false;
	                 }else if(data.status==1){
	                     $("#bill"+bid).html(data.canceled_num);
	                     $(event.currentTarget).unbind();
	                     return false;
	                 }else{
	                     return false;
	                 }
	            }
	        });
		});
	};

	var confirmbill = function(event){
		var coid = $(event.currentTarget).attr('coid');
		var billno = $("#bill_no_input").val();
		if(!billno){
		    layer.alert('票据单号不能为空');
		    return false;
		}
		layer.confirm('是否已确定打印出票？',function(index){
		    window.location.href = $('#billConfirm').val()+'?coid='+coid+'&billno='+billno;
		});
	};

	var goprint = function(){
	    var billno = $("#bill_no_input").val();
	    $("#bill_no_input").hide();
		$("#prn_bill_no").html(billno);
		$("#prn_bill_no").show();
	    $("#print_area").printArea();
	};

	var billnoinput = function(){
	    $("#prn_bill_no").empty();
		$("#prn_bill_no").hide();
		$("#bill_no_input").show().focus();
	};

	var cancollect = function(event){
		var coid = $(event.currentTarget).attr('coid');
		layer.confirm('确定要取消吗？',function(index){
		    var cancollect = $('#canCollect').val()+'?coid='+coid;
		    layer.close(index);
			$.ajax({
	            type: "GET",
	            url: cancollect,
	            dataType: "json",
	            success: function(data){
	                 if(data.status==1){
	                     $("#collect"+coid).html(data.collection_status);
	                     $(event.currentTarget).remove();
	                     return false;
	                 }else{
	                     return false;
	                 }
	            }
	        });
		});
	};

	init();
}();

var getnum = function(){
	var sno = parseInt($('#bill_no_start').val(),10);
	var eno = parseInt($('#bill_no_end').val(),10);
	if(eno<sno){
	    layer.alert('末尾票号小于起始票号');
	    $('#bill_no_end').val('');
		return false;
	}
	if(!isNaN(eno-sno)){
	   $('#bill_num').val(eno-sno+1);
	}
};