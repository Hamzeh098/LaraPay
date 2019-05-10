@extends('layouts.admin')
@section('title')
    لیست حساب های کاربران
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-title">
                <h4>لیست حساب های کاربران </h4>
            </div>
            <div class="card-body">
                @include('admin.user.account.notifications')
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        @include('admin.user.account.columns')
                        </thead>
                        <tbody>
                        @each('admin.user.account.item',$userAccounts,'account')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection