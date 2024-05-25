@extends('representative.layouts.app')


@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header ">Notifications</div>
                        <div class="card-body">
                            @if (count($notifications) > 0)
                                <table class="table ">
                                    <tbody>
                                        @foreach ($notifications as $notification)
                                            <tr class="clickable-row"
                                                onclick="window.location='{{ route('notification.notificationDetail', $notification->id) }}'">
                                                <td>
                                                    @if (!$notification->status)
                                                        <strong>ACSO</strong>
                                                    @else
                                                        ACSO
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!$notification->status)
                                                        <strong>{{ $notification->title }}--</strong>
                                                    @else
                                                        {{ $notification->title }}--
                                                    @endif
                                                    {{ Str::limit($notification->notification_detail, 50) }}
                                                </td>
                                                <td>
                                                    @if (!$notification->status)
                                                        <strong>{{ $notification->send_date }}</strong>
                                                    @else
                                                        {{ $notification->send_date }}
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
            background-color: #f5f5f5;
        }
    </style>

@endsection
