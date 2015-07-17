<!DOCTYPE html>
<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>  财务管理 <span class="c-gray en">&gt;</span> <a href="{formatUrl('finance/collect')}">收款管理</a> <span class="c-gray en">&gt;</span> 打印</nav>
<div class="pd-20">
  {if $collectInfo['collection_amount']>0}
  <!--可以扫描要打印的单据作为背景图方便位置对比 -->
  <div style="position:relative;width:800px;height:400px;background:url();left:50%;margin-left:-400px;">
  <div id="print_area">
  <!--打印区域需自带样式 -->
  <style type="text/css">
  {literal}p{position:absolute;}{/literal}
  {literal}p input{border:0;}{/literal}
  {literal}.top0{top:0;right:80px;}{/literal}
  {literal}.top1{top:30px;left:0px;}{/literal}
  {literal}.top2{top:80px;left:60px;}{/literal}
  {literal}.top3{top:130px;left:120px;}{/literal}
  {literal}.top4{top:200px;left:60px;}{/literal}
  {literal}.top5{top:320px;left:200px;}{/literal}
  {literal}.top6{top:360px;left:200px;}{/literal}
  </style>
  <p class="top0"><input type="text" placeholder="请输入票据号" id="bill_no"></p>

  <p class="top1">{date('Y',time()+8*60*60)}</p>
  <p class="top1" style="left:50px;">{date('m',time()+8*60*60)}</p>
  <p class="top1" style="left:80px;">{date('d',time()+8*60*60)}</p>
  <p class="top1" style="left:110px;">{date('H:i',time()+8*60*60)}</p>

  <p class="top1" style="left:400px;">{$order_payment_type[$collectInfo['payment_type']]}</p>

  <p class="top2">【病房】</p>
  <p class="top2" style="left:350px">【住院号】</p>
  <p class="top2" style="left:600px">{$collectInfo['customer_name']}</p>

  <p class="top3">{if $collectInfo['order_start_time']>0}{date('Y-m-d',$collectInfo['order_start_time'])}{/if}</p>
  <p class="top3" style="left:250px">{if $collectInfo['order_end_time']>0}{date('Y-m-d',$collectInfo['order_end_time'])}{/if}</p>

  <p class="top4">{$customer_service_type[$collectInfo['service_type']]}</p>
  <p class="top4" style="left:250px;">{$collectInfo['order_fee']}元/{$order_fee_unit[$collectInfo['order_fee_unit']]}</p>
  <p class="top4" style="left:450px;">{if $collectInfo['order_end_time']>0}{if $collectInfo['order_fee_unit']==1}{round(($collectInfo['order_end_time']-$collectInfo['order_start_time'])/(86400*30),1)}{/if}{if $collectInfo['order_fee_unit']==2}{round(($collectInfo['order_end_time']-$collectInfo['order_start_time'])/86400,1)}{/if}{if $collectInfo['order_fee_unit']==3}{round(($collectInfo['order_end_time']-$collectInfo['order_start_time'])/3600,1)}{/if}{/if}</p>
  <p class="top4" style="left:600px;">{$collectInfo['collection_amount']}{if $collectInfo['collection_type']==1}<br/>（预付款）{/if}</p>

  <p class="top5">{if isset($amount_capitalized[7])}{$amount_capitalized[7]}<!--含角分，万是第7位 -->{else}零{/if}</p>
  <p class="top5" style="left:230px;">{if isset($amount_capitalized[6])}{$amount_capitalized[6]}{else}零{/if}</p>
  <p class="top5" style="left:260px;">{if isset($amount_capitalized[5])}{$amount_capitalized[5]}{else}零{/if}</p>
  <p class="top5" style="left:290px;">{if isset($amount_capitalized[4])}{$amount_capitalized[4]}{else}零{/if}</p>
  <p class="top5" style="left:320px;">{$amount_capitalized[3]}</p>
  <p class="top5" style="left:350px;">{$amount_capitalized[2]}</p>
  <p class="top5" style="left:380px;">{$amount_capitalized[1]}</p>
  <p class="top5" style="left:600px;">{sprintf("%.2f",$collectInfo['collection_amount'])}</p>

  <p class="top6">【收费单位】</p>
  <p class="top6" style="left:600px;">【收费员】</p>
  </div>
  </div>
  {else}
  <!--退款单 -->
  <!--可以扫描要打印的单据作为背景图方便位置对比 -->
  <div style="position:relative;width:800px;height:400px;background:url()">
  <div id="print_area">
  <!--打印区域需自带样式 -->
  <style type="text/css">
  </style>
  <p></p>
  </div>
  </div>
  {/if}
  <div class="text-c"><button type="button" class="btn btn-success radius goprint"><i class="icon-ok"></i> {$typeMsg}</button>&nbsp;&nbsp;&nbsp;&nbsp;<a coid="{$collectInfo['collection_id']}" href="javascript:void(0);" class="btn btn-success radius confirmbill">开票确认</a></div>
</div>
<input type="hidden" id="billConfirm" value="{formatUrl('finance/confirmBill')}"></input>
<script type="text/javascript" src="/public/common/js/jquery.jPrintArea.js"></script>
<script type="text/javascript" src="/public/oa_admin/js/finance.js"></script>