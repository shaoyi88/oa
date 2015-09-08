{include file="./header.tpl"}

<body ng-app="serviceApp" ng-controller="serviceCtrl">
<nav class="breadcrumb"><i class="iconfont">&#xf012b;</i>预约服务管理 <span class="c-gray en">&gt;</span> 预约单管理 <a class="btn btn-success radius r mr-20" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="icon-refresh"></i></a></nav>

    <nav class="mainnav cl">

    <ul class="cl">
            <li class="current"><a href="#" ng-click="clickLoadAppointment('all', $event)">全部</a></li>
            <li><a href="#" ng-click="clickLoadAppointment('unprocessed', $event)">未处理</a></li>
            <li><a href="#" ng-click="clickLoadAppointment('processed', $event)">完成</a></li>
        </ul>
    </nav>

    <table class="table table-border table-bg table-bordered ">
        <thead>
        <tr >
            <th  class="text-align-center">ID</th>
            <th class="text-align-center">联系人</th>
            <th class="text-align-center">服务类型</th>
            <th class="text-align-center">联系电话</th>
            <th class="text-align-center">服务地址</th>
            <th class="text-align-center">创建时间</th>
            <th class="text-align-center">联系时间</th>
            <th class="text-align-center">处理</th>
        </tr>
        </thead>
        {literal}
            <tbody  ng-repeat="appointment in appointments">
            <tr >
                <td>{{$index + 1}}</td>
                <td>{{appointment.name}}</td>
                <td>{{appointment.service_type_name}}</td>
                <td>{{appointment.phone}}</td>
                <td>{{appointment.address_str}}</td>
                <td>{{appointment.create_time_str}}</td>
                <td>{{appointment.contact_time}}</td>

                <td><div class="btn  radius" ng-click="changeStatus($index)" ng-class="appointment.btnClass">{{appointment.button}}</div></td>
            </tr>
            </tbody>
        {/literal}

    </table>

</body>


{include file="./footer.tpl"}