@extends('layouts.app')
@section('content')
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            @if (session('success'))
                <div class="alert alert-success" role="alert"> 
                    {{ session('success') }}
                </div>
            @endif
            
            @if (session('error'))
                <div class="alert alert-danger" role="alert"> 
                    {{ session('error') }}
                </div>
            @endif
    
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="display-5 fw-bold">Data User</h1>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
                    + Create User
                </button>
            </div>
    
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        @role('admin')
                        <th scope="col">Action</th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key => $u)
                    <tr>
                        <th scope="row">{{$key + 1}}</th>
                        <td>{{$u->name}}</td>
                        <td>{{$u->email}}</td>
                        <td>{{$u->roles->pluck('name')->implode(', ')}}</td>
                        @role('admin')
                        <td>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{$u->id}}">
                                Edit
                            </button>
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{$u->id}}">
                                Delete
                            </button>
                        </td>
                        @endrole
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal{{$u->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus data user ini?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form id="deleteForm" method="POST" action="{{route('admin.user.destroy',$u->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal update -->
                    <div class="modal fade" id="updateModal{{$u->id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="updateModalLabel">Edit User</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('admin.user.update',$u->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="userName" class="form-label">User Name</label>
                                            <input type="text" class="form-control" id="userName" name="name" value="{{$u->name}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="userEmail" class="form-label">Email</label>
                                            <input type="text" class="form-control" id="userEmail" name="email" value="{{$u->email}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="userPassword" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="userPassword" name="password" value="{{$u->password}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="userRole" class="form-label">Role</label>
                                            <select class="form-select" id="userRole" name="role" required>
                                                @foreach ($roles as $id => $role)
                                                <option value="{{ $role }}" @if($u->roles->pluck('name')->contains($role)) selected @endif>
                                                {{ $role }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Save User</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Modal Create User -->
    <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Create User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.user.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="userName" class="form-label">User Name</label>
                            <input type="text" class="form-control" id="userName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email</label>
                            <input type="text" class="form-control" id="userEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="userPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="userPassword" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="userRole" class="form-label">Role</label>
                            <select class="form-select" id="userRole" name="role" required>
                                <option value="" selected disabled>Pilih Role</option>
                                @foreach ($roles as $id => $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection