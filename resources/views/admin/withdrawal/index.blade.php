@extends('layouts.admin')
@section('title')لیست درخواست های واریز@endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-title">
                <h4>لیست درخواست های واریز </h4>
            </div>
            <div class="card-body">
                @include('partials.error')
                @include('partials.success')
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            @include('admin.withdrawal.columns')
                        </thead>
                        <tbody>
                           @each('admin.withdrawal.item',$withdrawals,'withdrawal')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection