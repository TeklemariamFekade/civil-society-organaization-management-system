@extends('expert.layout.app')
@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="card-header-actions">
                                <a href="{{ route('notification.viewExpertNotification') }}" class="btn btn-secondary btn-sm"
                                    data-toggle="tooltip" data-placement="bottom" title="Back">
                                    <i class="fa fa-arrow-left"></i>
                                </a>
                            </div>
                            <h4 class="mb-0 text-center">Notification</h4>
                            <div class="card-header-actions">
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="">
                                <i class="fas fa-user-circle mr-2"></i>
                                <strong>{{ $notification->sender }}</strong>
                            </h5>
                            <h5 class="card-title"><strong>{{ $notification->title }}</strong></h5>
                            <p class="card-text">{{ $notification->notification_detail }}</p>
                            <p class="card-text"><small class="text-muted">Sent on: {{ $notification->send_date }}</small>
                            </p>
                            <a href="#" class="btn btn-primary btn-sm">
                                <i class="fa fa-reply"></i> Reply
                            </a>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            {{-- <a href="{{ route('notification.deleteSupervisorNotification', $notification->id) }}"
                            class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Delete">
                            <i class="fa fa-trash"></i>
                        </a> --}}
                            <form action="{{ route('notification.deleteExpertNotification', $notification->id) }}"
                                method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip"
                                    data-placement="bottom" title="Delete"
                                    onclick="return confirm('Are you sure you want to delete this Message?')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
