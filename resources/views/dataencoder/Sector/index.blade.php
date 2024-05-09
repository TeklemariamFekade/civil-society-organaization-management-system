@extends('dataencoder.layouts.app')

@section('content')
    <div class="content-wrapper bg-light">
        <div class="container mx-auto ">
            <button type="button" class="btn btn-info mt-3" data-toggle="modal" data-target="#myModal">+Add New Sector</button>
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center font-weight-bolder">Create New Sector</h5>
                            <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger mb-1 mt-1">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ Route('dataencoder.Sector.addSector') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="name">Name of Sector</label>
                                    <input type="text" class="form-control font-italic"
                                        placeholder="enter the name of sector" name="sector_name" required>
                                    @error('sector_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Name of Sub sector</label>
                                    <input type="text" class="form-control font-italic"
                                        placeholder="enter the name of sector" name="sub_sector_name" required>
                                    @error('sub_sector_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sub sector name</th>
                    <th scope="col">Sector name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 0;
                @endphp
                @foreach ($sectors as $sector)
                    <tr>
                        <td>{{ ++$count }}</td>
                        <td>{{ $sector->sub_sector_name }}</td>
                        <td>{{ $sector->sector_name }}</td>
                        <td>
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#mdl{{ $sector->id }}">Update</button>
                            <div class="modal fade" id="mdl{{ $sector->id }}" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center font-weight-bolder">Update users (ID:
                                                {{ $sector->id }})</h5>
                                            <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        @if ($errors->any())
                                            <div class="alert alert-danger mb-1 mt-1">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <form
                                            action="{{ route('dataencoder.Sector.updateSector', ['id' => $sector->id]) }}"
                                            method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Name of Sector</label>
                                                    <input value="{{ $sector->sector_name }}" type="text"
                                                        class="form-control font-italic"
                                                        placeholder="Enter the name of sector" name="sector_name" required>
                                                    @error('sector_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Name of Sub sector</label>
                                                    <input value="{{ $sector->sub_sector_name }}" type="text"
                                                        class="form-control font-italic"
                                                        placeholder="enter the name of sector" name="sub_sector_name"
                                                        required>
                                                    @error('sub_sector_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
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
