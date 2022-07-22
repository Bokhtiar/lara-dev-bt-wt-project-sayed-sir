@extends('layouts.admin.app')
@section('title',  @edit ? 'Product Update' : 'Product Create' )

@section('css')
    <style>
        .zoom:hover {
            transform: scale(2.5);
        }
    </style>
@endsection

@section('admin_content')

    <div class="pagetitle">
        <h1>Product {{ @$edit ? 'Update' : 'Create' }} Form</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="@route('admin.dashboard')">Home</a></li>
                <li class="breadcrumb-item">Product</li>
                <li class="breadcrumb-item active">Product {{ @$edit ? 'Update' : 'Create' }} Form</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->


    <div class="card">
        <div class="card-header">

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
        {{-- <form action="@route('admin.product.store')" method="POST">
            @csrf
            <input type="text" name="sku[name]" id="">
            <input type="text" name="sku[price]" id="">
        <input type="submit" name="" value="submit" id="">
        </form> --}}
        <div class="card-body">
            <h5 class="card-title">Product {{ @$edit ? 'Update' : 'Create' }} Form <a href="@route('admin.product.index')" class="btn btn-sm btn-success"><i class="ri-list-unordered"></i></a></h5>
            @if (@$edit)
                <form action="@route('admin.product.update', @$edit->product_id)" method="POST" enctype="multipart/form-data">
                    @method('put')
                @else
                    <form action="@route('admin.product.store')" method="post" enctype="multipart/form-data">
            @endif
            @csrf
            <section class="form-group row">
                <div class="col-md-6 col-lg-6 my-2">
                    <label for="" class="form-label">Product Name <span class="text-danger">*</span></label>
                    <input required type="text" class="form-control" name="name" value="{{ @$edit->name }}"
                        placeholder="type here Product Name">
                </div>

                <div class="col-md-6 col-lg-6 my-2">
                    <label for="" class="form-label">Product Generic <span class="text-danger">*</span></label>
                    <input required type="text" class="form-control" name="generic" value="{{ @$edit->generic }}"
                        placeholder="type here Product Generic">
                </div>

                <div class="col-md-6 col-lg-6 my-2">
                    <label for="" class="form-label">Product Sell Price <span class="text-danger">*</span></label>
                    <input required type="text" class="form-control" name="sell_price" value="{{ @$edit->sell_price }}"
                        placeholder="type here Product Sell Price">
                </div>

                <div class="col-md-6 col-lg-6 my-2">
                    <label for="" class="form-label">Product Discount % </label>
                    <input required type="text" class="form-control" name="discount_percentage" value="{{ @$edit->discount_percentage }}"
                        placeholder="type here Product Discount %">
                </div>

                <div class="col-md-6 col-lg-6 my-2">
                    <label for="" class="form-label">Product Images(multple Images) <span class="text-danger">*</span></label>
                    <input  type="file" name="images[]" multiple class="form-control">
                    @isset($edit)
                    <div class="my-2">
                        <label for="">Already Image Seleted</label>
                        <img src="{{ asset($edit->images) }}" height="40px" width="40px" alt="">
                    </div>
                    @endisset
                </div>


                <div class="col-md-6 col-lg-6 my-2">
                   <label class="form-label" for="">Select Category <span class="text-danger">*</span></label>
                   <select class="form-control" name="category_id" id="">
                       <option value="">Select Category</option>
                       @foreach ($categories as $cat)
                        <option value="{{ $cat->category_id }}" {{ $cat->category_id == @$edit->category_id ? 'selected' : "" }}> {{ $cat->name }}</option>
                       @endforeach
                   </select>
                </div>

                <div class="col-md-12 col-lg-12 my-2">
                    <label for="" class="form-label">Product Company <span class="text-danger">*</span></label>
                    <input required type="text" class="form-control" name="company" value="{{ @$edit->company }}"
                        placeholder="type here Product Company">
                </div>


                <div class="form-group">
                    <label for="sku">Product Sku</label>
                    <div class="row">
                        
                        <div class="col-md-4">
                            title:
                        </div>
                        <div class="col-md-4">
                            price:
                        </div>
                        <div class="col-md-4">
                            discount_price:
                        </div>
                    </div>
                    @for ($i=0; $i <= 4; $i++)
                    <div class="row">
                        
                        <input type="text" hidden name="sku[{{ $i }}][id]" class="form-control" value="{{$i}}">
                        <div class="col-md-4">
                            <input type="text" name="sku[{{ $i }}][title]" class="form-control" value="{{ @$edit->sku[$i]['title'] ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="sku[{{ $i }}][price]" class="form-control" value="{{ @$edit->sku[$i]['price'] ?? '' }}">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="sku[{{ $i }}][discount_price]" class="form-control" value="{{ @$edit->sku[$i]['discount_price'] ?? '' }}">
                        </div>
                    </div>
                    @endfor
                </div>



                <div class="col-md-12 col-lg-12 my-2">
                    <label for="">Product Body <span class="text-danger">*</span></label>
                    <textarea name="body" class="form-control" cols="10" rows="4">
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

