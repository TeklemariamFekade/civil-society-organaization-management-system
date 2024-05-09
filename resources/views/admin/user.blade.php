@extends('adminlayouts.app')

@section('content')
    <div class="content-wrapper bg-light">
        <div class="container mx-auto ">
            <button type="button" class="btn btn-info mt-3" data-toggle="modal" data-target="#myModal">+Add New User</button>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center font-weight-bolder">Create New Users</h5>
                            <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>

                        </div>
                        @if (session('status'))
                            <div class="alert alert-success mb-1 mt-1">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('admin.addUser') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control font-italic" placeholder="enter the user name"
                                        name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control font-italic" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control font-italic" name="password" required
                                        min="6">
                                </div>
                                <div class="form-group">
                                    <label for="password">Confirm Password</label>
                                    <input type="password" class="form-control font-italic" name="confirm_password"
                                        autocomplete="password" required min="6">
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select class="form-select w-100 h-16 border p-2" aria-label="Default select example"
                                        style="border-color: transparent" name="role">
                                        @foreach ($users as $user)
                                            <option class="">{{ $user->role }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger bg-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success bg-success">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <table class="table table-striped">

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count = 0;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ ++$count }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('admin.status', ['id' => $user->id]) }}"
                                    class="btn bg-{{ $user->status ? 'info' : 'danger' }}">
                                    {{ $user->status ? 'Active' : 'Deactive' }}
                                </a>
                            </td>

                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#mdl{{ $user->id }}">Update</button>
                                <div class="modal fade" id="mdl{{ $user->id }}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-center font-weight-bolder">Update users (ID:
                                                    {{ $user->id }})</h5>
                                                <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            @if (session('status'))
                                                <div class="alert alert-success mb-1 mt-1">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                            <form action="{{ route('admin.updateUser', ['id' => $user->id]) }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" value="{{ $user->name }}"
                                                            class="form-control font-italic"
                                                            placeholder="Enter the user name" name="name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" value="{{ $user->email }}"
                                                            class="form-control font-italic" name="email" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="role">Role</label>
                                                        <select class="form-select w-100 h-16 border p-2"
                                                            aria-label="Default select example"
                                                            style="border-color: transparent" name="role">
                                                            <option value="dataencoder">Data Encoder</option>
                                                            <option value="expert">Expert</option>
                                                            <option value="admin">Admin</option>
                                                            <option value="supervisor">Supervisor</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger bg-danger"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success bg-success">Save
                                                        changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
