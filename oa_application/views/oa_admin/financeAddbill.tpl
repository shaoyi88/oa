<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  财务管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('finance/bill')}">票据管理</a> <span class="c-gray en">&gt;</span> {$typeMsg}</nav>
<div class="pd-20">
	<form class="Huiform" id="form-role-add" action="{formatUrl('finance/doAddbill')}" method="post">
		<table class="table table-border table-bordered table-bg">
      		<tbody>
      		    <tr>
          		     <th class="text-r" width="80">*领取医院：</th>
          			 <td>
          			 <select style="width:98%" class="select-box" id="received" name="received" nullmsg="领取医院不能为空！" datatype="*">
          	             <option value="">请选择</option>
          		         {foreach $hospitalInfo as $item}
      			         <option value="{$item['wb_id']}">
      			         {$item['stationary_name']}
      			         </option>
      			         {/foreach}
          	         </select>
          			 </td>
        		</tr>
                <tr>
          		     <th class="text-r" width="80">领取人：</th>
          			 <td><input name="receiptor" type="text" class="input-text" id="receiptor" value="" nullmsg="领取人不能为空！" datatype="*"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">领取时间：</th>
          			 <td><input style="width:30%" name="received_date" type="text" class="input-text" id="received_date" value="" onfocus="WdatePicker()" nullmsg="领取时间不能为空！" datatype="*"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">起始票号：</th>
          			 <td><input name="bill_no_start" type="text" class="input-text" id="bill_no_start" value="" nullmsg="起始票号不能为空！" datatype="*"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">末尾票号：</th>
          			 <td><input name="bill_no_end" type="text" class="input-text" id="bill_no_end" value="" nullmsg="末尾票号不能为空！" datatype="*" onblur="getnum()"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">数量：</th>
          			 <td><input name="bill_num" type="text" class="input-text" id="bill_num" value="" nullmsg="数量不能为空！" datatype="*"></td>
        		</tr>
                <tr>
          			<th></th>
          			<td>
            			<button type="submit" class="btn btn-success radius"><i class="icon-ok"></i> {$typeMsg}</button>
          			</td>
        		</tr>
      		</tbody>
      	</table>
	</form>
</div>
<script type="text/javascript" src="/public/common/js/hogan-2.0.0.min.js"></script>
<script type="text/javascript" src="/public/common/js/date/WdatePicker.js"></script>
<script type="text/javascript" src="/public/oa_admin/js/finance.js"></script>