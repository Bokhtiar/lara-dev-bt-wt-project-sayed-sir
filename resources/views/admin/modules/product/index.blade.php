@extends('layouts.admin.app')
@section('title', 'List Of Medicine')
@section('css')
    <style>
        .zoom:hover {
            transform: scale(2.5);
        }
    </style>
@endsection

@section('admin_content')

    <div class="pagetitle">
        <h1>Medicine Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="@route('admin.dashboard')">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Medicine Table</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <x-notification></x-notification>
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Medicine Table  <a class="btn btn-sm btn-success" href="@route('admin.product.create')"> <i class="ri-add-box-line"></i> </a>  </h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">SL</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Sell Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->index + 1 }}</th>
                                        <td>{{ $item->name }}</td>

                                        
                                        <td>{{ $item->sell_price }}TK</td>

                                        <td>
                                            @if ($item->status == 1)
                                                <a class="btn btn-sm btn-success" href="@route('admin.product.status', $item->product_id)"><i
                                                        class="bi bi-check-circle"></i></a>
                                            @else
                                                <a class="btn btn-warning btn-sm" href="@route('admin.product.status', $item->product_id)"><i
                                                        class="bi bi-exclamation-triangle"></i></a>
                                            @endif
                                        </td>
                                        <td class="form-inline">
                                            <a class="btn btn-sm btn-info text-light" href="@route('admin.product.show', $item->product_id)"> <i
                                                    class="ri-eye-fill"></i></a>
                                            <a class="btn btn-sm btn-primary" href="@route('admin.product.edit', $item->product_id)"> <i
                                                    class="ri-edit-box-fill"></i></a>
                                            <form method="POST" action="@route('admin.product.destroy',$item->product_id)" class="mt-1">
                                                @csrf
                                                @method('Delete')
                                                <button class="btn btn-sm btn-danger" type="submit"> <i
                                                    class="ri-delete-bin-6-fill"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <h2 class="bg-danger text-light text-center">Product Is empty</h2>
                                @endforelse
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>

            </div>
        </div>
    </section>








    @section('js')
    @endsection

@endsection
