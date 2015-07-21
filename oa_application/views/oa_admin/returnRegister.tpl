<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  服务跟踪管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('nursing/returnList')}">回访管理</a> <span class="c-gray en">&gt;</span> 回访登记</nav>
<div class="pd-20">
	<form class="Huiform" id="form-role-add" action="{formatUrl('nursing/returnDoRegister')}" method="post">
		<input name="return_id" type="hidden" value="{$info['return_id']}">		
		<input name="plan_id" type="hidden" value="{$info['plan_id']}">
		<input name="customer_id" type="hidden" value="{$info['customer_id']}">
		<input name="customer_name" type="hidden" value="{$info['customer_name']}">
		<input name="customer_address" type="hidden" value="{$info['customer_address']}">
		<input name="executive_admin_id" type="hidden" value="{$info['executive_admin_id']}">
		<input name="executive_admin_name" type="hidden" value="{$info['executive_admin_name']}">
		<input name="admin_id" type="hidden" value="{$info['admin_id']}">
		<input name="admin_name" type="hidden" value="{$info['admin_name']}">
		<table class="table table-border table-bordered table-bg">
      		<tbody>
      			<tr>
          		     <th class="text-r" width="200">客户名字:</th>
          			 <td>
          			 	{$info['customer_name']}
          			 </td>
        		</tr>
      			<tr>
          		     <th class="text-r" width="200">客户地址：</th>
          			 <td>
          			 	{$info['customer_address']}
          			 </td>
        		</tr>
        		<tr>
          		     <th class="text-r">*回访记录：</th>
          		     <td>
          		     	 <textarea cols="" rows="" class="textarea" name="return_record" nullmsg="回访记录不能为空！" datatype="s"></textarea>
          		     </td>
          		</tr>  
          		<tr>
          		     <th class="text-r">*推送内容：</th>
          		     <td>
          		     <textarea cols="" rows="" class="textarea" name="push_content" nullmsg="推送内容不能为空！" datatype="s"></textarea>
          		     </td>
          		</tr>  
          		<tr>
          		     <th class="text-r">下次回访时间：</th>
          		     <td>
          		     <input style="width:200px" name="return_time" type="text" class="input-text" id="return_time" value="">
          		     </td>
          		</tr> 
        		<tr>
        			<th></th>
      				<td colspan="2">
      					<button id="submitAddPlan" type="submit" class="btn btn-success radius"><i class="icon-ok"></i>登记</button>
      				</td>
      		</tr>
        	</tbody>
        </table>
	</form>
</div>
<script type="text/javascript" src="/public/common/js/date/WdatePicker.js"></script>
<script type="text/javascript" src="/public/oa_admin/js/nursing.js"></script>