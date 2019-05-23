{{ csrf_field() }}
<input name="owner" id="owner" type="hidden" value="{{$gatewayItem->gateway_user_id}}">
<div class="form-group">
    <label for="plan">طرح درگاه :</label>
    <select name="plan" id="plan" class="form-control">
        @foreach($plans as $plan)
            <option value="{{ $plan->gateway_plan_id }}" {{ !is_null($gatewayItem) && $gatewayItem->gateway_plan == $plan->gateway_plan_id  ? 'selected' : ''  }}>{{ $plan->gateway_plan_title }}</option>
            </option>
        @endforeach
    </select>

</div>
<div class="form-group">
    <label for="title">عنوان درگاه :</label>
    <input id="title" name="title" type="text"
           class="form-control input-default"
           value="{{ old('title',!is_null($gatewayItem) ? $gatewayItem->gateway_title:'') }}">
</div>

{{--<div class="form-group">
    <label for="website">وب سایت :</label>
    <input id="website" name="website" type="text"
           class="form-control input-default"
           value="{{ old('title',!is_null($gatewayItem) ? $gatewayItem->gateway_title:'') }}">
</div>--}}
<div class="form-group">
    <label for="status">وضعیت :</label>
    <select name="status" id="status" class="form-control">
        @foreach($statuses as $status => $title)
            <option value="{{ $status }}" {{ !is_null($gatewayItem) && $gatewayItem->gateway_status == $status ? 'selected' : ''  }}>{{ $title }}</option>
        @endforeach
    </select>
</div>
<div class="form-group m-t-20">
    <button type="submit" class="btn btn-primary m-b-10 m-l-5">ثبت اطلاعات
    </button>
</div>
