{{ csrf_field() }}
<div class="form-group">
    <label for="owner">صاحب حساب :</label>
    <select name="owner" id="owner" class="form-control input-default js-data-example-ajax">
    </select>
</div>
<div class="form-group">
    <label for="title">عنوان حساب :</label>
    <input id="title" name="title" type="text"
           class="form-control input-default"
           value="{{ old('title',!is_null($userAccountItem) ? $userAccountItem->user_account_title:'') }}">
</div>
<div class="form-group">
    <label for="account_number">شماره حساب</label>
    <input id="account_number" name="account_number" type="text"
           class="form-control input-default input-number"
           value="{{ old('account_number',!is_null($userAccountItem) ? $userAccountItem->user_account_number:'') }}">
</div>
<div class="form-group">
    <label for="account_sheba">
        شماره شبا
        <span class="form-label-description">(بدون IR)</span>
    </label>
    <input id="account_sheba" name="account_sheba" type="text"
           class="form-control input-default input-number"
           value="{{ old('account_sheba',!is_null($userAccountItem) ? $userAccountItem->user_account_sheba_number : '') }}">
</div>
<div class="form-group">
    <label for="account_card">شماره کارت</label>
    <input id="account_card" name="account_card" type="text"
           class="form-control input-default input-number"
           value="{{ old('account_card',!is_null($userAccountItem) ? $userAccountItem->user_account_card_number : '') }}">
</div>
<div class="form-group">
    <label for="account_status">وضعیت :</label>
    <select name="account_status" id="account_status" class="form-control">
        @foreach($userAccountStatus as $status => $title)
            <option value="{{ $status }}" {{ !is_null($userAccountItem) && $userAccountItem->user_account_status == $status ? 'selected' : ''  }}>{{ $title }}</option>
        @endforeach
    </select>
</div>
<div class="form-group m-t-20">
    <button type="submit" class="btn btn-primary m-b-10 m-l-5">ثبت اطلاعات
    </button>
</div>
