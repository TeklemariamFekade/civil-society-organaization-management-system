@extends('dataencoder.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header" style="background-color: dodgerBlue; color: white;">
                            {{ __('Organization Name Change Request Details') }}
                        </div>
                        <div class="row panel panel-success" style="margin-top:2%;margin-left:300px">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <ul class="nav nav-tabs" style="margin-bottom: 10px;">
                                            <li class="nav-item">
                                                <a class="nav-link active text-success" data-toggle="tab" href="#Summery">
                                                    <i class="fa fa-indent"></i> Name Info
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link text-success" data-toggle="tab" href="#General">
                                                    <i class="fa fa-info"></i> File Info
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content">
                                        <div id="Summery" class="tab-pane fade in active">
                                            <div class="table-responsive panel">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-success"><i class="fa fa-user"></i> Previous
                                                                Organization Name</td>
                                                            <td>{{ $cso->english_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-success"><i class="fa fa-language"></i> የቀድሞው
                                                                የተቋሙ /የድርጅቱ ስም</td>
                                                            <td>{{ $cso->amharic_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-success"><i class="fa fa-users"></i> Category
                                                            </td>
                                                            <td>{{ $cso->category }}</td>
                                                        </tr>
                                                        @if ($cso->nameChange && $cso->nameChange->isNotEmpty())
                                                            @foreach ($cso->nameChange as $change)
                                                                <tr>
                                                                    <td class="text-success"><i class="fa fa-user"></i> New
                                                                        Organization Name</td>
                                                                    <td>{{ $change->new_english_name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="text-success"><i class="fa fa-language"></i>
                                                                        አዲሱ የተቋሙ
                                                                        /የድርጅቱ ስም</td>
                                                                    <td>{{ $change->new_amharic_name }}</td>
                                                                </tr>
                                                            @endforeach
                                                        @else
                                                            <tr>
                                                                <td class="text-success"><i class="fa fa-user"></i> New
                                                                    Organization Name</td>
                                                                <td><span class="text-muted">Not available</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-success"><i class="fa fa-language"></i> አዲሱ
                                                                    የተቋሙ
                                                                    /የድርጅቱ ስም</td>
                                                                <td><span class="text-muted">Not available</span></td>
                                                            </tr>
                                                        @endif
                                                        <tr>
                                                            <td class="text-success"><i class="fa fa-paper-plane"></i> Send
                                                                Date</td>
                                                            <td>{{ Carbon\Carbon::parse($cso->send_date)->format('M d, Y') }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div id="General" class="tab-pane fade">
                                            @foreach ($cso->nameChange as $nameChange)
                                                @if ($nameChange->cso_file)
                                                    <div class="card card-body"
                                                        style="width: 800px; max-height: 3000px; overflow-y: scroll;">
                                                        <embed src="{{ asset('storage/' . $nameChange->cso_file) }}"
                                                            type="application/pdf" width="100%" height="300px">
                                                    </div>
                                                @else
                                                    <p class="text-muted">No file uploaded.</p>
                                                @endif
                                            @endforeach
                                        </div>
                                        <div class="card-body text-center">
                                            <form action="{{ route('service.name_change.approveNameChange', $cso->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </form>
                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#mdl-{{ $cso->id }}">
                                                Give Feedback
                                            </button>
                                        </div>
                                        <div class="modal fade" id="mdl-{{ $cso->id }}" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title text-center font-weight-bolder">Give
                                                            feedback for applicant</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form
                                                        action="{{ route('service.name_change.giveNameChangeFedBack', $cso->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="title">Title for feedback</label>
                                                                <input type="text" class="form-control font-italic w-100"
                                                                    placeholder="Enter Title" name="title" required>
                                                                @error('title')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="description">Description</label>
                                                                <textarea name="notification_detail" cols="30" rows="10" class="form-control w-100"
                                                                    placeholder="Enter Description"></textarea>
                                                                @error('description')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger bg-danger"
                                                                data-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success">Send</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.table-responsive -->
        </div>
    </div>
@endsection
