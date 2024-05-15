@extends('dataencoder.layouts.app')
@section('content')
    <div class="content-wrapper">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Due date</th>
                    <th scope="col">Registration</th>
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
                        <td>{{ $task->due_date }}</td>
                        <td>{{ $task->registration_id }}</td>
                        <td>{{ $task->status }}</td>
                        <td>
                            <a href=""
                                style="display: inline-block; padding: 12px 15px; background-color: DodgerBlue; color: white; text-decoration: none; border-radius: 4px;">Evaluate</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
{{-- //{{ route('registration.evaluate', ['id' => $task->registration_id]) }} --}}
