@extends('supervisor.layouts.app')
@section('content')
    <div class="content-wrapper">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Notifications</div>
                        <div class="card-body">
                            @if (count($notifications) > 0)
                                <table class="table">
                                    <tbody>
                                        @foreach ($notifications as $notification)
                                            <tr class="clickable-row" role="button" aria-label="{{ $notification->title }}"
                                                onclick="window.location='{{ route('notification.supervisorNotificationDetail', $notification->id) }}'">
                                                <td>
                                                    @if (!$notification->status)
                                                        <strong>{{ substr($notification->sender, 0, 8) }}--</strong>
                                                    @else
                                                        {{ substr($notification->sender, 0, 8) }}--
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!$notification->status)
                                                        <strong>{{ $notification->title }} --</strong>
                                                    @else
                                                        {{ $notification->title }} --
                                                    @endif
                                                    {{ substr($notification->notification_detail, 0, 35) }}--
                                                </td>
                                                <td>
                                                    @if (!$notification->status)
                                                        <strong>{{ Carbon\Carbon::parse($notification->send_date)->format('M d, Y') }}</strong>
                                                    @else
                                                        {{ Carbon\Carbon::parse($notification->send_date)->format('M d, Y') }}
                                                    @endif
                                                </td>
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

    <style>
        .clickable-row {
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .clickable-row:hover {
            background-color: #dbf10fe5;
        }
    </style>

@endsection
