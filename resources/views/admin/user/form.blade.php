<div class="basic-form p-10">
    <form method="post" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">نام کامل :</label>
            <input id="name" name="name" type="text"
                   class="form-control input-default"
                   value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="postContent">ایمیل:</label>
            <input id="userEmail" name="userEmail" type="email"
                   class="form-control input-default"
                   value="{{ old('userEmail') }}">
        </div>
        <div class="form-group">
            <label for="postContent">کلمه عبور:</label>
            <input id="userPassword" name="userPassword" type="password"
                   class="form-control input-default"
                   value="{{ old('userPassword') }}">
        </div>
        {{--<div class="form-group">--}}
        {{--<label for="postStatus">وضعیت :</label>--}}
        {{--<select name="postStatus" id="postStatus" class="form-control">--}}
        {{----}}
        {{--</select>--}}
        {{--</div>--}}
        <div class="form-group m-t-20">
            <button type="submit" class="btn btn-primary m-b-10 m-l-5">ثبت اطلاعات
            </button>
        </div>
    </form>
</div>
