@extends('supervisor.layouts.app')

@section('content')
    <div class="content-wrapper">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger mb-1 mt-1">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <section class="py-8">
            <div class="container">
                <div class="bg-white rounded shadow">
                    <div class="px-6 pt-6 border-bottom border-secondary-light m-3">
                        <div class="d-flex mb-6 align-items-center justify-content-between">
                            <h4 class="mb-0">List of Support Letter Requests</h4>

                        </div>

                    </div>
                    <div class="pt-4 table-responsive">
                        <table class="table mb-0 table-borderless table-striped small">
                            <thead>
                                <tr>
                                    <th scope="col" class="py-4 px-6">ID</th>
                                    <th scope="col" class="py-4 px-6">Organization Name</th>
                                    <th scope="col" class="py-4 px-6">የተቋሙ ስም</th>
                                    <th scope="col" class="py-4 px-6">Request Date</th>
                                    <th scope="col" class="py-4 px-6">Status</th>
                                    <th scope="col" class="py-4 px-6">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 0;
                                    $users = App\Models\User::all();
                                    $csos = App\Models\CSO::all();
                                @endphp
                                @foreach ($csos as $cso)
                                    @if ($cso->supportLetters->count() > 0)
                                        @foreach ($cso->supportLetters as $supportLetter)
                                            <tr>
                                                <td>{{ ++$count }}</td>
                                                <td>{{ $cso->english_name }}</td>
                                                <td>{{ $cso->amharic_name }}</td>
                                                <td>{{ $supportLetter->send_date }}</td>
                                                <td>{{ $supportLetter->status ? 'Assigned' : 'Not Assigned' }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                                        data-target="#mdl-{{ $supportLetter->id }}">Assign</button>
                                                    <div class="modal fade" id="mdl-{{ $supportLetter->id }}"
                                                        role="dialog">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-center font-weight-bolder">
                                                                        Task assign page
                                                                    </h5>
                                                                    <button type="button" class="btn btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>

                                                                <form
                                                                    action="{{ route('service.letter.assignSupportLetterTask', ['id' => $supportLetter->id]) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="name">Task Name</label>
                                                                            <input value="" type="text"
                                                                                class="form-control font-italic"
                                                                                placeholder="Enter the name of Task"
                                                                                name="task_name" required>
                                                                            @error('task_name')
                                                                                <div class="text-danger">{{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="expert">Select Data
                                                                                Encoder</label>
                                                                            <select class="form-control" name="user_name"
                                                                                required placeholder="select the expert">
                                                                                @foreach ($users as $user)
                                                                                    @if ($user->role == 'dataencoder')
                                                                                        <option
                                                                                            value="{{ $user->name }}">
                                                                                            {{ $user->name }}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                            @error('expert')
                                                                                <div class="text-danger">{{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="form-group">
                                                                                <label for="due_date">Due date of the
                                                                                    task</label>
                                                                                <input value="" type="date"
                                                                                    class="form-control font-italic"
                                                                                    placeholder="Enter the due date of the task"
                                                                                    name="due_date" required>
                                                                                @error('due_date')
                                                                                    <div class="text-danger">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-danger bg-danger"
                                                                                data-dismiss="modal">Cancel</button>
                                                                            <button type="submit"
                                                                                class="btn btn-success">Assign</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>





    </div>
@endsection
