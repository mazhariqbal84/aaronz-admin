@extends('layouts.master')
@section('title', 'Document Types')
@section('first', 'Document Types')
@section('second', 'Settings')
@section('third', 'Document Types')
@section('fourth', 'Create')

@section('content')

<div class="content d-flex flex-column flex-column-fluid">
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container-fluid">
            <div class="card card-custom gutter-b">
                {{-- <div class="card-body"> --}}
                    <div class="card-header">
                        <h3 class="card-title">
                         Add Document Type
                        </h3>
                        <div class="card-toolbar">
                           <div class="example-tools justify-content-center">
                               <a href="{{ route('admin.settings.document-types.index') }}" class="btn btn-cherwell float-right"><span class="fa fa-mail-reply"></span> Back</a>
                           </div>
                          </div>
                       </div>
                    <div class="card-body">
                        <fieldset>
                            <legend>Document Type Details:</legend>
                            <div class="row">
                            <div class="col-md-12 col-lg-6 mb-4 ">
                                  <label for="description_english" class="d-block">Name</label>
                                  <input type="text" name="title_english" id="title_english" class="form-control" placeholder="Document Type Name">
                                  <span id="title_english_error" class="text-danger"></span>
                              </div>
                            </div>
                        </fieldset>
                        <button type="button" class="btn btn-cherwell font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3 btn-block" id="add_language">
                            <span class="svg-icon svg-icon-md fa fa-floppy-o"></span>
                                @lang('translation.save')
                        </button>
                    </div>

                {{-- </div> --}}
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@include('admin.settings.document-types.js.create');
@endsection
