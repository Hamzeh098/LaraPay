@extends('layouts.admin')
@section('title','ثبت درخواست جدید')
@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6/css/select2.min.css" rel="stylesheet"/>
@endsection
@section('content')
    <div class="col-xs-12 col-md-9 col-lg-6">
        <div class="card">
            <div class="card-title">
                <h4>ثبت درخواست جدید</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @include('partials.error')
                        @include('partials.success')
                        <div class="basic-form p-10">
                            <form method="post" action="{{ route('admin.withdrawal.store') }}"
                                  enctype="multipart/form-data">
                                @include('admin.withdrawal.form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6/js/select2.min.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            $('#gateway').select2({
                closeOnSelect: true,

                theme: 'classic',
                minimumInputLength: 3,
                ajax: {
                    url: '{{route('admin.gateway.search')}}',
                    dataType: 'json',
                    data: function (params) {
                        return {
                            search: params.term,
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.items,
                        };
                    },
                },
            });
            $('#gateway').on('change', function (e) {
                let currentGateway = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: '{{route('admin.user.account.search')}}',
                    dataType: 'json',
                    data: {
                        gateway: currentGateway
                    },
                    success: function (response) {
                        let items = response.items;
                        items.forEach(function (items) {
                            $('#account').append('<option value="' + items.id + '">' + items.text + '</option>');
                        });
                    },
                    error: function (error) {
                    }
                });
            });
        });
    </script>
@endsection
