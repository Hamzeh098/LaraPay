{{ csrf_field() }}
<div class="form-group">
    <label for="gateway"> درگاه :</label>
    <select name="gateway" id="gateway" class="form-control input-default"></select>
</div>
<div class="form-group">
    <label for="account"> حساب :</label>
    <select name="account" id="account" class="form-control input-default"></select>
</div>

<div class="form-group">
    <label for="amount">مبلغ :</label>
    <input id="amount" name="amount" type="text"
           class="form-control input-default"
           value="{{ old('amount',!is_null($withdrawalItem) ? $withdrawalItem->user_account_title:'') }}">
</div>
<div class="form-group">
    <label for="status">وضعیت :</label>
    <select name="status" id="status" class="form-control">
        @foreach($statuses as $status => $title)
            <option value="{{ $status }}" {{ !is_null($withdrawalItem) && $withdrawalItem->user_account_status == $status ? 'selected' : ''  }}>{{ $title }}</option>
        @endforeach
    </select>
</div>
<div class="form-group m-t-20">
    <button type="submit" class="btn btn-primary m-b-10 m-l-5">ثبت اطلاعات
    </button>
</div>
