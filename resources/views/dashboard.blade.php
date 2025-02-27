@extends('layouts.app')
@section('content')
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            @if (session('success'))
                <div class="alert alert-success" role="alert"> 
                    {{ session('success') }}
                </div>
            @endif
    
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="display-5 fw-bold">Data Product</h1>
                @role('admin')
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductModal">
                    + Create Product
                </button>
                @endrole
            </div>
    
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Category</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Total Price</th>
                        @role('admin')
                        <th scope="col">Action</th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $p)
                    <tr>
                        <th scope="row">{{$key + 1}}</th>
                        <td>{{$p->category->name}}</td>
                        <td>{{$p->name}}</td>
                        <td>{{$p->description}}</td>
                        <td>Rp{{number_format($p->price,2)}}</td>
                        <td>{{$p->quantity}}</td>
                        <td>Rp{{number_format($p->price * $p->quantity,2)}}</td>
                        @role('admin')
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{$p->id}}">
                                Edit
                            </button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$p->id}}">
                                Delete
                            </button>
                        </td>
                        @endrole
                        <!-- Modal -->
                        <div class="modal fade" id="deleteModal{{$p->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus data produk ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <form id="deleteForm" method="POST" action="{{route('admin.product.destroy',$p->id)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal update -->
                        <div class="modal fade" id="updateModal{{$p->id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateModalLabel">Edit Produk</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('admin.product.update',$p->id)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label for="productName" class="form-label">Product Name</label>
                                                <input type="text" class="form-control" id="productName" name="name" value="{{$p->name}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="category" class="form-label">Category</label>
                                                <select class="form-select" id="category" name="category_id" required>
                                                    @foreach ($categories as $c)
                                                        <option value="{{$c->id}}" @if($c->id == $p->category_id) selected @endif
                                                        >{{$c->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" id="description" name="description" required>{{$p->description}}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="price" class="form-label">Price</label>
                                                <input type="number" class="form-control" id="price" name="price" value="{{$p->price}}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="quantity" class="form-label">Quantity</label>
                                                <input type="number" class="form-control" id="quantity" name="quantity" value="{{$p->quantity}}" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Save Produk</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Modal Create Product -->
    <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProductModalLabel">Create Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.product.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="productName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="productName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="productName" class="form-label">Category</label>
                            <select class="form-select" id="productName" name="category_id" required>
                                <option value="" selected disabled>Pilih Produk</option>
                                @foreach ($categories as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" class="form-control" id="price" name="price" required>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection