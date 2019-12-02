@section('title', '订单管理')
@section('header')
    <div class="layui-inline">
        <button class="layui-btn layui-btn-small layui-btn-warm freshBtn"><i class="layui-icon">&#x1002;</i></button>
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['business_code'] or '' }}" name="business_code" placeholder="请输入商户号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['order_sn'] or '' }}" name="order_sn" placeholder="请输入平台订单号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['out_order_sn'] or '' }}" name="out_order_sn" placeholder="请输入商户订单号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['user_id'] or '' }}" name="user_id" placeholder="请输入码商号" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <select name="status">
            <option value="">请选择支付状态</option>
            <option value="0" {{isset($input['status'])&&$input['status']==0?'selected':''}}>未支付</option>
            <option value="1" {{isset($input['status'])&&$input['status']==1?'selected':''}}>支付成功</option>
            <option value="2" {{isset($input['status'])&&$input['status']==2?'selected':''}}>过期</option>
            <option value="3" {{isset($input['status'])&&$input['status']==3?'selected':''}}>取消</option>
        </select>
    </div>
    <div class="layui-inline">
        <input type="text"  value="{{ $input['creatime'] or '' }}" name="creatime" placeholder="创建时间" onclick="layui.laydate({elem: this, festival: true})" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="formDemo">搜索</button>
        <button id="res" class="layui-btn layui-btn-primary">重置</button>
    </div>
    <div class="layui-inline">
        <button class="layui-btn layui-btn-warm" name="excel" value="excel" lay-submit lay-filter="formDemo">导出EXCEL</button>
    </div>
@endsection
@section('table')
    <table class="layui-table" lay-even lay-skin="nob">
        <colgroup>
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="200">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="150">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="100">
            <col class="hidden-xs" width="250">
            <col class="hidden-xs" width="250">
        </colgroup>
        <thead>
        <tr>
            <th class="hidden-xs">序号</th>
            <th class="hidden-xs">商户标识</th>
            <th class="hidden-xs">平台订单号</th>
            <th class="hidden-xs">商户订单号</th>
            <th class="hidden-xs">码商ID</th>
            <th class="hidden-xs">码商状态</th>            
            <th class="hidden-xs">码商收款</th>
            <th class="hidden-xs">二维码ID</th>
            <th class="hidden-xs">订单金额</th>
            <th class="hidden-xs">收款金额</th>            
            <th class="hidden-xs">支付类型</th>
            <th class="hidden-xs">支付状态</th>
            <th class="hidden-xs">回调次数</th>
            <th class="hidden-xs">回调状态</th>
            <th class="hidden-xs">创建时间</th>
            <th class="hidden-xs">支付时间</th>
        </tr>
        </thead>
        <tbody>
        @foreach($list as $info)
            <tr>
                <td class="hidden-xs">{{$info['id']}}</td>
                <td class="hidden-xs">{{$info['business_code']}}</td>
                <td class="hidden-xs">{{$info['order_sn']}}</td>
                <td class="hidden-xs">{{$info['out_order_sn']}}</td>
                <td class="hidden-xs">{{$info['user_id']}}</td>
                <td class="hidden-xs">
                    @if($info['dj_status']==0)<span class="layui-btn layui-btn-small layui-btn-danger">资金冻结</span>
                    @elseif($info['dj_status']==1)<span class="layui-btn layui-btn-small layui-btn-warm">资金解冻</span>
                    @elseif($info['dj_status']==2)<span span class="layui-btn layui-btn-small layui-btn">资金扣除</span>
                    @endif
                </td>                
                <td class="hidden-xs">
                    @if($info['sk_status']==0)<span class="layui-btn layui-btn-small layui-btn-danger">未收款</span>
                    @elseif($info['sk_status']==1)<span class="layui-btn layui-btn-small">手动收款</span>
                    @elseif($info['sk_status']==2)<span span class="layui-btn layui-btn-small layui-btn-warm">自动收款</span>
                    @endif
                </td>
                <td class="hidden-xs">{{$info['erweima_id']}}</td>
                <td class="hidden-xs">{{$info['tradeMoney']/100}}</td>
                <td class="hidden-xs">{{$info['sk_money']/100}}</td>               
                <td class="hidden-xs">
                    @if($info['payType']==0)<span class="layui-btn layui-btn-small layui-btn-primary">默认</span>
                    @elseif($info['payType']==1)<span class="layui-btn layui-btn-small">微信</span>
                    @elseif($info['payType']==2)<span class="layui-btn layui-btn-small layui-btn-normal">支付宝</span>
                    @endif</td>
                <td class="hidden-xs">
                    @if($info['status']==0)<span class="layui-btn layui-btn-small layui-btn-warm">未支付</span>
                    @elseif($info['status']==1)<span span class="layui-btn layui-btn-small layui-btn">支付成功</span>
                    @elseif($info['status']==2)<span class="layui-btn layui-btn-small layui-btn-danger">过期</span>
                    @elseif($info['status']==3)<span class="layui-btn layui-btn-small layui-btn-danger">取消</span>
                    @elseif($info['status']==4)<span class="layui-btn layui-btn-small layui-btn-danger">异常</span>
                    @endif</td>
                <td class="hidden-xs"><span class="layui-btn layui-btn-small layui-btn-warm">回调{{$info['callback_num']}}次</span></td>    
                <td class="hidden-xs">
                    @if($info['callback_status']==0)<span class="layui-btn layui-btn-small layui-btn-primary">未处理</span>@elseif($info['callback_status']==1)<span span class="layui-btn layui-btn-small layui-btn">推送成功</span>@elseif($info['callback_status']==2)<span class="layui-btn layui-btn-small layui-btn-danger">推送失败</span>
                    @endif
                </td>
                <td class="hidden-xs">{{$info['creatime']}}</td>
                <td class="hidden-xs">@if($info['status']==1){{$info['pay_time']}}@endif</td>
            </tr>
        @endforeach
        @if(!$list[0])
            <tr><td colspan="6" style="text-align: center;color: orangered;">暂无数据</td></tr>
        @endif
        </tbody>
        <input type="hidden" id="token" value="{{csrf_token()}}">
    </table>
    <div class="page-wrap">
        {{$list->render()}}
    </div>
@endsection
@section('js')
    <script>
        layui.use(['form', 'jquery','laydate', 'layer'], function() {
            var form = layui.form(),
                $ = layui.jquery,
                laydate = layui.laydate,
                layer = layui.layer;
            laydate({istoday: true});
            form.render();
            form.on('submit(formDemo)', function(data) {
            });
            $('#res').click(function () {
                $("input[name='business_code']").val('');
                $("input[name='order_sn']").val('');
                $("input[name='user_id']").val('');
                $("input[name='creatime']").val('');
                $("select[name='status']").val('');
                $('form').submit();
            });
        });
    </script>
@endsection
@extends('common.list')
