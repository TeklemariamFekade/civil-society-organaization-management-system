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
                            {{ __('Organization Support Letter Request Details') }}</div>
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
                                                            <td class="text-success"><i class="fa fa-user"></i>
                                                                Organaization Name
                                                            </td>
                                                            <td>{{ $cso->english_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-success"><i class="fa fa-language"></i> የተቋሙ
                                                                /የድርጅቱ ስም</td>
                                                            <td>{{ $cso->amharic_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-success"><i class="fa fa-users"></i> Category
                                                            </td>
                                                            <td>{{ $cso->category }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-success"><i class="fa fa-paper-plane"></i> Send
                                                                Date</td>
                                                            @foreach ($cso->supportLetters as $csos)
                                                                <td>{{ Carbon\Carbon::parse($csos->send_date)->format('M d, Y') }}
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        {{-- <div id="General" class="tab-pane fade">
                                            @if ($cso->cso_file)
                                                <div class="card card-body scrollable-box"
                                                    style="margin-right: 20px; overflow-x: auto;">
                                                    <iframe src="{{ asset('storage/' .  $cso ->cso_file) }}"
                                                        style="width:600px; height: 400px; margin-right: -20px;"></iframe>
                                                </div>
                                            @else
                                                <p class="text-muted">No file uploaded.</p>
                                            @endif
                                        </div> --}}

                                        <div id="General" class="tab-pane fade">
                                            @if ($cso->cso_file)
                                                <div class="card card-body"
                                                    style="width: 800px; max-height: 2000px; overflow-y: scroll;">
                                                    <embed src="{{ asset('storage/' . $cso->cso_file) }}"
                                                        type="application/pdf" width="100%" height="100%">
                                                </div>
                                            @else
                                                <p class="text-muted">No file uploaded.</p>
                                            @endif
                                        </div>
                                        {{-- {{ route('expert.approval.post',  $cso ->id) }} --}}
                                        <form action="" method="POST">
                                            @csrf
                                            <!-- Your existing form content -->

                                            <div class="card-body text-center">
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </div>
                                        </form>
                                        <div class="card-body text-center">
                                            <button type="button" class="btn btn-success" data-toggle="modal"
                                                data-target="#mdl-{{ $cso->id }}">
                                                Give Feedback
                                            </button>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="mdl-{{ $cso->id }}" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-center font-weight-bolder">Give
                                                        feedback
                                                        for applicant</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('service.letter.replySupportLetter', $cso->id) }}"
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
            <!-- /.table-responsive -->
        </div>
    </div>
    </div>
@endsection
