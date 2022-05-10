@extends('layouts.master')
@section('title', 'User Role')
@section('first', 'User Role')
@section('second', 'Administrator')
@section('third', 'User Role')

@section('content')

<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                            <!--begin::Search Form-->
                            <div class="mb-4">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-6">
                                        <div class="row align-items-center">
                                            <div class="col-md-4 my-2 my-md-0">
                                                <div class="input-icon">
                                                    {{-- <input type="text" class="form-control input-search" placeholder="Search..." />
                                                    <span>
                                                        <i class="flaticon2-search-1 text-muted"></i>
                                                    </span> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-6 d-flex justify-content-end">
                                            @if ($add_permission == 1)
                                                <a href="#" class="btn btn-danger font-weight-bolder mr-1" id="OpenAddModel">
                                                <span class="svg-icon svg-icon-md fa fa-plus">
                                                </span>@lang('translation.create')
                                            </a>
                                            @endif
                                            <!--end::Button-->
                                            <!--begin::Button-->
                                            <a href="#" class="btn btn-danger font-weight-bolder" id="reload">
                                                <span class="svg-icon svg-icon-md fa fa-refresh">
                                                </span>@lang('translation.reload')</a>
                                                <!--end::Button-->

                                    </div>
                                </div>
                            </div>
                            <!--end::Search Form-->
                            <!--begin: Datatable-->
                            <div>
                                <table id="users-table" class="table">
                                    <thead>
                                        <tr>
                                            <th width="10%">Id</th>
                                            <th>Name</th>
                                            <th>Is Default</th>
                                            <th class="text-center" width="10%">Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!--end: Datatable-->

                    <!--end::Card-->

                </div>
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('admin.administrator.user-role.modals');
@include('admin.administrator.user-role.js.index');
@endsection
