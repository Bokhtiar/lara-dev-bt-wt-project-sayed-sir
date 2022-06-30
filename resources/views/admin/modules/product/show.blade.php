@extends('layouts.admin.app')
@section('title', 'Medicine Details')
@section('css')
@endsection

@section('admin_content')

    <div class="pagetitle">
        <h1>Medicine Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="@route('admin.dashboard')">Home</a></li>
                <li class="breadcrumb-item">Medicine Show</li>
                <li class="breadcrumb-item active">Medicine Details</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="card">
        <div class="card-header">
            <span class="font-weight-bold">Medicine Name :</span> {{ $show->name }}
        </div>
        <div class="card-body">
            <div class="row my-3">
                <div class="col-sm-12 col-md-5 col-lg-5 text-center">
                   <h3 class="text-center">Medicine Info</h3>
                   <p>
                       <span> <b>Medicine Name :</b> {{ $show->name }} </span> <br>
                       <span> <b>Medicine Category :</b> {{ $show->category ? $show->category->name : "" }} </span>
                   </p>
                </div>
                <div class="col-sm-12 col-md-7 col-lg-7">
                    <h3>Company Info</h3>
                    <p>
                        <span> <b>Medicine Company :</b> {{ $show->company }} </span> <br>
                        <span> <b>Medicine Generic :</b> {{ $show->generic}} </span>
                    </p>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <label for=""> <b>Description:</b> </label>
                    {!! $show->body !!}
                </div>
            </div>
        </div>
    </div>

@section('js')
@endsection

@endsection
