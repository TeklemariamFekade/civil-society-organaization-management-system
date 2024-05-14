@extends('supervisor.layouts.app')

@section('content')
    <div class="content-wrapper">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Organization name</th>
                    <th scope="col">የተቋሙ ስም</th>
                    <th scope="col">Request Date</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 0;
                    $users = App\Models\User::all();

                @endphp
                @foreach ($csos as $cso)
                    <tr>
                        <td>{{ ++$count }}</td>
                        <td>{{ $cso->english_name }}</td>
                        <td>{{ $cso->amharic_name }}</td>
                        <td>
                            @foreach ($cso->addresschange as $addresschange)
                                {{ $addresschange->send_date }}
                            @endforeach
                        </td>
                        <td>
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                data-target="#mdl-{{ $cso->id }}">Assign</button>
                        </td>
                    </tr>

                    <div class="modal fade" id="mdl-{{ $cso->id }}" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-center font-weight-bolder">Task assign page</h5>
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
                                <form action="{{ route('registration.assign', ['id' => $cso->id]) }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">Task Name</label>
                                            <input value="" type="text" class="form-control font-italic"
                                                placeholder="Enter the name of Task" name="task_name" required>
                                            @error('task_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="expert">Select Data Encoder</label>
                                            <select class="form-control" name="user_name" required
                                                placeholder="select the expert">
                                                @foreach ($users as $user)
                                                    @if ($user->role == 'dataencoder')
                                                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            @error('expert')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="due_date">Due date of the task</label>
                                                <input value="" type="date" class="form-control font-italic"
                                                    placeholder="Enter the due date of the task" name="due_date" required>
                                                @error('due_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger bg-danger"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success bg-success">Save changes</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- <div class="modal fade" id="mdl-{{ $csos->id }}" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center font-weight-bolder">Task assign page </h5>
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
                                    <form action="{{ route('registration.assign', ['id' => $csos->id]) }}"
                                        method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Task Name</label>
                                                <input value="" type="text" class="form-control font-italic"
                                                    placeholder="Enter the name of Task" name="task_name" required>
                                                @error('task_name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="expert">Select Expert</label>
                                                <select class="form-control" name="user_name" required
                                                    placeholder="select the expert">
                                                    @foreach ($users as $user)
                                                        @if ($user->role == 'expert')
                                                            <option value="{{ $user->name }}">{{ $user->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('expert')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="due_date">Due date of the task</label>
                                                    <input value="" type="date"
                                                        class="form-control font-italic"
                                                        placeholder="Enter the due date of the task" name="due_date"
                                                        required>
                                                    @error('due_date')
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
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> --}}
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var buttons = document.querySelectorAll('[id^="assign-btn-"]');
            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var buttonId = button.getAttribute('id');
                    var id = buttonId.split('-')[2];
                    var assignBtn = document.getElementById('assign-btn-' + id);
                    assignBtn.innerHTML = 'Assigned';
                });
            });
        });
    </script>
@endsection
