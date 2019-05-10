@extends('layouts.admin')
@section('title','ایجاد کاربر جدید')

@section('content')
    <div class="col-xs-12 col-md-6">
        <div class="card">
            <div class="card-title">
                <h4>ایجاد کاربر جدید</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('partials.error')
                        @include('partials.success')
                        @include('admin.user.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
