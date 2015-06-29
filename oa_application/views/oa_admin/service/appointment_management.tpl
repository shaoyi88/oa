{include file="./header.tpl"}

<body ng-app="serviceApp" ng-controller="serviceCtrl">
    <nav class="mainnav cl">
        <ul class="cl">
            <li class="current"><a href="#" ng-click="loadAppointment('all')">全部</a></li>
            <li><a href="#" ng-click="loadAppointment('unprocessed')">未处理</a></li>
            <li><a href="#">准备派遣</a></li>
            <li><a href="#">服务中</a></li>
            <li><a href="#" ng-click="loadAppointment('processed')">完成</a></li>
        </ul>
    </nav>

    <table class="table table-border table-bg table-bordered ">
        <thead>
        <tr >
            <th  class="text-align-center">ID</th>
            <th class="text-align-center">联系人</th>
            <th class="text-align-center">联系电话</th>
            <th class="text-align-center">与被服务者的关系</th>
            <th class="text-align-center">方便联系的时间段</th>
            <th class="text-align-center">服务地址</th>
            <th class="text-align-center">订单状态</th>
            <th class="text-align-center">处理</th>
        </tr>
        </thead>
        {literal}
            <tbody  ng-repeat="appointment in appointments">
            <tr class="active">
                <td>{{appointment.id}}</td>
                <td>{{appointment.name}}</td>
                <td>{{appointment.phone}}</td>
                <td>{{appointment.relationship}}</td>
                <td>{{appointment.easy_time}}</td>
                <td>{{appointment.address}}</td>
                <td>{{appointment.state}}</td>
                <td><div class="btn  radius" ng-click="changeStatus($index)" ng-class="appointment.btnClass">{{appointment.button}}</div></td>
            </tr>
            </tbody>
        {/literal}

    </table>

    <div id="page1">sdafdsa</div>
</body>


{include file="./footer.tpl"}