@extends('expert.layout.app')
@section('content')
    <div class="content-wrapper">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Due Date</th>
                    <th scope="col">Registration</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($tasks->isNotEmpty())
                    @foreach ($tasks as $key => $task)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $task->task_name }}</td>
                            <td>
                                {{ Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}</td>
                            <td>{{ $task->registration_id }}</td>
                            <td>{{ $task->status }}</td>
                            <td>
                                <a href="{{ route('registration.evaluateRegistration', $task->id) }}"
                                    class="btn btn-primary">Evaluate</a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">No tasks found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
{{-- //{{ route('registration.evaluate', ['id' => $task->registration_id]) }} --}}
