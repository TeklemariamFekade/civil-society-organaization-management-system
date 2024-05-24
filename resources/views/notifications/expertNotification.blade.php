@extends('expert.layout.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Notifications</div>

                    <div class="card-body">
                        @if ($notifications->count() > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Details</th>
                                        <th>Sent At</th>
                                        <th>Status
                                    </tr>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notifications as $notification)
                                        <tr>

                                            <td>{{ $notification->title }}</td>
                                            <td>{{ $notification->notification_detail }}</td>
                                            <td> {{ $notification->send_date }}</td>
                                            <td>{{ $notification->status ? 'Sean' : 'Not sean' }}</td>
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
@endsection
