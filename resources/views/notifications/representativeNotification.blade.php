@extends('representative.layouts.app')


@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Notifications</div>
                        <div class="card-body">
                            @if (count($notifications) > 0)
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Details</th>
                                            <th>Sent At</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notifications as $notification)
                                            <tr>

                                                <td>{{ $notification->title }}</td>
                                                <td>{{ $notification->notification_detail }}</td>
                                                <td> {{ $notification->send_date }}</td>
                                                <td>{{ $notification->status ? 'Seen' : 'Not Seen' }}</td>
                                                <td><button class="btn btn-outline-primary bg-primary">View</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>You have no notifications.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
