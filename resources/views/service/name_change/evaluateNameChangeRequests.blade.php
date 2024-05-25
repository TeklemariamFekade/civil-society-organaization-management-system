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
                            {{ __('Organization Name Change Request Details') }}</div>
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
                                                            <td class="text-success"><i class="fa fa-user"></i> English Name
                                                            </td>
                                                            <td>{{ $cso->english_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-success"><i class="fa fa-language"></i> Amharic
                                                                Name</td>
                                                            <td>{{ $cso->amharic_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-success"><i class="fa fa-users"></i> Category
                                                            </td>
                                                            <td>{{ $cso->category }}</td>
                                                        </tr>
                                                        @foreach ($cso->nameChange as $csos)
                                                            <tr>
                                                                <td class="text-success"><i class="fa fa-user"></i> New
                                                                    English
                                                                    Name
                                                                </td>
                                                                <td>{{ $csos->new_english_name }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-success"><i class="fa fa-language"></i>New
                                                                    Amharic
                                                                    Name</td>
                                                                <td>{{ $csos->new_amharic_name }}</td>
                                                            </tr>
                                                            <tr>

                                                                <td class="text-success"><i class="fa fa-paper-plane"></i>
                                                                    Send
                                                                    Date</td>


                                                                <td>
                                                                    {{ Carbon\Carbon::parse($csos->send_date)->format('M d, Y') }}
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
                                        <form action="{{ route('service.name_change.approveNameChange', $cso->id) }}"
                                            method="POST">
                                            @csrf
                                            <!-- Your existing form content -->
                                            <div class="card-body text-center">
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </div>
                                        </form>
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
