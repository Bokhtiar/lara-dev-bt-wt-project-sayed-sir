@extends('layouts.admin.app')
@section('title',  @edit ? 'Medicine Update' : 'Medicine Create' )

@section('css')
    <style>
        .zoom:hover {
            transform: scale(2.5);
        }
    </style>
@endsection

@section('admin_content')

    <div class="pagetitle">
        <h1>Medicine {{ @$edit ? 'Update' : 'Create' }} Form</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="@route('admin.dashboard')">Home</a></li>
                <li class="breadcrumb-item">Medicine</li>
                <li class="breadcrumb-item active">Medicine {{ @$edit ? 'Update' : 'Create' }} Form</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <div class="card">
        <div class="card-header">
            {{-- form validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            {{-- form validation errors end --}}
        </div>
        <div class="card-body">
            <h5 class="card-title">Medicine {{ @$edit ? 'Update' : 'Create' }} Form <a href="@route('admin.medicine.index')" class="btn btn-sm btn-success"><i class="ri-list-unordered"></i></a></h5>
            @if (@$edit)
                <form action="@route('admin.medicine.update', @$edit->medicine_id)" method="POST" enctype="multipart/form-data">
                    @method('put')
                @else
                    <form action="@route('admin.medicine.store')" method="post" enctype="multipart/form-data">
            @endif
            @csrf
            <section class="form-group row">
                <div class="col-md-6 col-lg-6 my-2">
                    <label for="" class="form-label">Medicine Name <span class="text-danger">*</span></label>
                    <input required type="text" class="form-control" name="name" value="{{ @$edit->name }}"
                        placeholder="type here Medicine Name">
                </div>

                <div class="col-md-6 col-lg-6 my-2">
                    <label for="" class="form-label">Medicine Generic <span class="text-danger">*</span></label>
                    <input required type="text" class="form-control" name="generic" value="{{ @$edit->generic }}"
                        placeholder="type here Medicine Generic">
                </div>


                <div class="col-md-6 col-lg-6 my-2">
                   <label class="form-label" for="">Select Category</label>
                   <select class="form-control" name="category_id" id="">
                       <option value="">Select Category</option>
                       @foreach ($categories as $cat)
                        <option value="{{ $cat->category_id }}" {{ $cat->category_id == @$edit->category_id ? 'selected' : "" }}> {{ $cat->name }}</option>
                       @endforeach
                   </select>
                </div>

                <div class="col-md-6 col-lg-6 my-2">
                    <label for="" class="form-label">Medicine Company <span class="text-danger">*</span></label>
                    <input required type="text" class="form-control" name="company" value="{{ @$edit->company }}"
                        placeholder="type here Medicine Company">
                </div>

                <div class="col-md-12 col-lg-12">
                    <label for="">Medicine Body <span class="text-danger">*</span></label>
                    <textarea name="body" class="tinymce-editor">
                       {!! @$edit->body !!}
                      </textarea><!-- End TinyMCE Editor -->
                </div>
            </section>
            <br><br><br>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
            </form><!-- End Multi Columns Form -->

        </div>
    </div>


@section('js')
@endsection
@endsection

