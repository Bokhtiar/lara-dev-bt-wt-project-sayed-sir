@extends('layouts.admin.app')
@section('title', 'Banner Details')
@section('css')
@endsection

@section('admin_content')

    <div class="pagetitle">
        <h1>Banner Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="@route('admin.dashboard')">Home</a></li>
                <li class="breadcrumb-item">Banner Show</li>
                <li class="breadcrumb-item active">Banner Details</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-header">
            <span class="font-weight-bold">Banner Name :</span> {{ $show->title }}
        </div>
        <div class="card-body">
            <div class="row my-3">
                <div class="col-sm-12 col-md-5 col-lg-5 text-center">
                    <img src="{{ asset($show->image) }}" height="auto" width="100%" alt="">
                </div>
                <div class="col-sm-12 col-md-7 col-lg-7">
                    {!! $show->body !!}
                </div>
            </div>
        </div>
    </div>

@section('js')
@endsection

@endsection
