<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  系统管理 <span class="c-gray en">&gt;</span>知识库内容管理<span class="c-gray en">&gt;</span>{$type}</nav>
{if isset($msg)}
    <div class="header">
        <div class="Huialert Huialert-danger"><i class="icon-remove"></i>{$msg}</div>
    </div>
{/if}
<div class="pd-20">
	<form class="Huiform" id="form-role-add" action="{formatUrl('knowledge/contentAdd')}" method="post">
        {if isset($updateMsg)}
            <input name="info_id" type="hidden" value="{$updateMsg[0]['info_id']}">
            <input name="info_cat_id" type="hidden" value="{$updateMsg[0]['cat_id']}">
        {/if}
		<table class="table table-border table-bordered table-bg">
			<tbody>
				<tr>
          		     <th class="text-r" width="80">所属菜单选择：</th>
          			 <td>
          			 	<select class="select" id="cat_id" name="cat_id" nullmsg="部门不能为空！" datatype="*">
                            {if isset($updateMsgTitle)}
                                <option style="display: none" value="{$updateMsgTitle['cat_id']}">默认:{$updateMsgTitle['cat_name']}</option>
                            {/if}
                            {foreach $nav as $item}
      						<option value="{$item['cat_id']}">
      						{if $item['level'] > 0}{str_repeat('&nbsp', $item['level']*6)}├ {/if}{$item['cat_name']}
      						</option>
      						{/foreach}
    					</select>
          			 </td>
        		</tr>

      			<tr>
          		     <th class="text-r" width="80">标题：</th>
          			 <td><input name="info_title" type="text" class="input-text" id="infotitle" value="{if isset($updateMsg)}{$updateMsg[0]['info_title']}{/if}" nullmsg="请输入内容的标题！" datatype="s"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">排序：</th>
          			 <td><input name="info_order" type="text" class="input-text" id="info_order" value="{if isset($updateMsg)}{$updateMsg[0]['info_order']}{/if}" nullmsg="排序号不能为空！" datatype="s"></td>
        		</tr>
        		<tr>
          		     <th class="text-r" width="80">内容：</th>
          			 <td><textarea name="info_detail" type="textarea" class="textarea" style="height: 300px" id="info_detail" value=""  errormsg="请输入详细内容！" nullmsg="内容不能为空！" >{if isset($updateMsg)}{$updateMsg[0]['info_detail']}{/if}</textarea></td>
        		</tr>
        		<tr>
          			<th></th>
          			<td>
            			<button type="submit" class="btn btn-success radius"><i class="icon-ok"></i> {$type}</button>
          			</td>
        		</tr>
        	</tbody>
		</table>
	</form>
</div>
<script type="text/javascript" src="/public/oa_admin/js/knowledge/loreList.js"></script>