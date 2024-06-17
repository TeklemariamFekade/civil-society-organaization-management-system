@extends('dataencoder.layouts.app')

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
                            <h4 class="mb-0">List of Tasks Assigned for you</h4>
                        </div>
                    </div>
                    <div class="pt-4 table-responsive">
                        <table class="table mb-0 table-borderless table-striped small">
                            <thead>
                                <tr>
                                    <th scope="col" class="py-4 px-6">ID</th>
                                    <th scope="col" class="py-4 px-6">Task Name</th>
                                    <th scope="col" class="py-4 px-6">Due Date</th>
                                    <th scope="col" class="py-4 px-6">Status</th>
                                    <th scope="col" class="py-4 px-6">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @if ($tasks->isNotEmpty())
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td>{{ ++$count }}</td>
                                            <td>{{ $task->task_name }}</td>
                                            <td>{{ Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}</td>
                                            <td>{{ $task->status }}</td>
                                            <td>
                                                <a href="{{ route('service.address_change.evaluateAddressChangeRequest', $task->id) }}"
                                                    style="display: inline-block; padding: 12px 15px; background-color: DodgerBlue; color: white; text-decoration: none; border-radius: 4px;">Evaluate</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" class="text-center">No tasks found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
