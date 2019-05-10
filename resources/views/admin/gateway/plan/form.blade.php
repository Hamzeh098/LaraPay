{{ csrf_field() }}
<div class="form-group">
    <label for="title">عنوان طرح :</label>
    <input id="title" name="title" type="text"
           class="form-control input-default"
           value="{{ old('title',!is_null($gatewayPlanItem) ? $gatewayPlanItem->gateway_plan_title:'') }}">
</div>
<div class="form-group">
    <label for="commission">کمیسیون :</label>
    <input id="commission" name="commission" type="text"
           class="form-control input-default"
           value="{{ old('title',!is_null($gatewayPlanItem) ? $gatewayPlanItem->gateway_plan_commission:'') }}">
</div>

<div class="form-group">
    <label for="rate">محدودیت درخواست :</label>
    <input id="rate" name="rate" type="text"
           class="form-control input-default"
           value="{{ old('title',!is_null($gatewayPlanItem) ? $gatewayPlanItem->gateway_plan_withdrawal_rate:'') }}">
</div>

<div class="form-group">
    <label for="withdrawalMax">سقف برداشت:</label>
    <input id="withdrawalMax" name="withdrawalMax" type="text"
           class="form-control input-default"
           value="{{ old('title',!is_null($gatewayPlanItem) ? $gatewayPlanItem->gateway_plan_withdrawal_max	:'') }}">
</div>


<div class="form-group m-t-20">
    <button type="submit" class="btn btn-primary m-b-10 m-l-5">ثبت اطلاعات
    </button>
</div>
