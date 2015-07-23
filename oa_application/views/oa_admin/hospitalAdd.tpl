<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  机构医院管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('worker/index')}">医院管理</a> <span class="c-gray en">&gt;</span> {$typeMsg}</nav>
<div class="pd-20">
	<form class="Huiform" id="form-role-add" action="{formatUrl('hospital/doAdd')}" method="post">
		{if isset($info)}
		<input name="wb_id" type="hidden" value="{$info['wb_id']}">
		{/if}
		<table class="table table-border table-bordered table-bg">
      		<tbody>
      		    <tr>
          		     <th class="text-r" width="80">*医院：</th>
          			 <td>
          			 <input name="stationary_name" type="text" class="input-text" id="hospital" value="{if isset($info)}{$info['stationary_name']}{/if}" >
          			 </td>
        		</tr>
        		{if isset($info)}
        		<tr>
        		    <th class="text-r" width="80">科室：</th>
        		    <td>
        		    <ul id="sta">
        		    {if $nInfo}
        		    {foreach $nInfo as $item}
        		    <li style="margin-bottom:5px;"><input name="stationary[]" style="width:80%;" type="text" class="input-text" value="{$item['stationary_name']}" ><input type="hidden" name="staid[]" value="{$item['wb_id']}">&nbsp;<span><a href="javascript:void(0)" class="delsta">&times;</a></span></li>
          		    {/foreach}
          		    {else}
          		    <li style="margin-bottom:5px;"><input name="stationary[]" style="width:80%;" type="text" class="input-text" ></li>
          		    {/if}
          		    </ul>
          		    <p><a class="btn btn-primary radius addsta" href="javascript:void(0);"><i class="icon-plus"></i></a><span></p>
          		    </td>
        		</tr>
        		{/if}
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
<script type="text/javascript" src="/public/oa_admin/js/worker.js"></script>