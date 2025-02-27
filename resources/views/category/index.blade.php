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
                <h1 class="display-5 fw-bold">Data Category</h1>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
                    + Create Category
                </button>
            </div>
    
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Total Product</th>
                        @role('admin')
                        <th scope="col">Action</th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $c)
                    <tr>
                        <th scope="row">{{$key + 1}}</th>
                        <td>{{$c->name}}</td>
                        <td>{{$c->description}}</td>
                        <td>{{$c->products->count()}}</td>
                        @role('admin')
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{$c->id}}">
                                Edit
                            </button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$c->id}}">
                                Delete
                            </button>
                        </td>
                        @endrole
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Modal Create Category -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryModalLabel">Create Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.category.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection