@extends('layouts.admin')
@section('title') لیست گزارش کارکرد درگاه ها @endsection
@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-title">
                <h4>لیست گزارش کارکرد درگاه ها</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            @include('admin.gateway.report.columns')
                        </thead>
                        <tbody>
                            @each('admin.gateway.report.item',$reports,'report')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection