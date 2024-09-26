@extends('layouts.app')
@section('title',"Profile")
@push('custom-css')

@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header ">
                            <div class="d-flex justify-content-between">
                                <h5 class="m-0">Profile</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('profile.partials.update-profile-information-form')

                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
                <!-- /.col-md-6 -->
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header ">
                            <div class="d-flex justify-content-between">
                                <h5 class="m-0">Password Update</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            @include('profile.partials.update-password-form')

                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endSection

@push('custom-js')

@endpush
