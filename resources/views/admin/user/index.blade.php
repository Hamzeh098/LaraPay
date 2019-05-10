@extends('layouts.admin')
@section('content')

    <div class="container-fluid">
        <!-- Start Page Content -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-title">
                        <h4>لیست کاربران </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                @include('admin.user.columns')
                                <tbody>
                                @each('admin.user.item',$users,'user')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /# row -->
        <!-- End PAge Content -->
    </div>
    <!-- End Container fluid  -->


@endsection