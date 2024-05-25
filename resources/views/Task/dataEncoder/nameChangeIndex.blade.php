@extends('dataencoder.layouts.app')
@section('content')
    <div class="content-wrapper">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Due date</th>
                    <th scope="col">NameChange</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count = 0;
                @endphp
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ ++$count }}</td>
                        <td>{{ $task->task_name }}</td>
                        <td>{{ Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                        </td>
                        <td>{{ $task->name_changes_id }}</td>
                        <td>{{ $task->status }}</td>
                        <td>
                            <a href=" {{ route('service.name_change.evaluateNameChangeRequest', ['id' => $task->name_changes_id]) }}"
                                style="display: inline-block; padding: 12px 15px; background-color: DodgerBlue; color: white; text-decoration: none; border-radius: 4px;">Evaluate</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


{{-- //{{ route('registration.evaluate', ['id' => $task->registration_id]) }} --}}
