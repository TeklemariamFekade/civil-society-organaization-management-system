@extends('representative.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <h2 class="b border-bottom m-3">F.D.R.E AUTHORITY FOR CIVIL SOCIETY ORGANIZATIONS</h2>
                    <div>
                        <p class="text-justfy m-2">The Agency for Civil Society Organizations is established to ensure
                            maximum public benefit by
                            supervising
                            whether organizations carry on their activities in accordance with their registered
                            objectives and encourage
                            and support organizations to make sure that they have internal governance systems which
                            ensure transparency,
                            accountability and participation.</p>

                    </div>

                    <div class="col-sm-11">
                        <h4 class="p-3 border-bottom mb-2 ms-4"><strong>Service Lists</strong></h4>
                        <div class="bg-white  m-3  pb-5  text-justify">
                            <p class="border-bottom p-2 fw-bold"> <strong> Verification of Name Change for Civil Society
                                    Organization </strong></p>
                            <p class="pb-4 pl-3">Verification of Name Change for Civil Society Organization by Authority for
                                Civil Society Organizations.</p>
                            <hr class="border-4 ">
                            <div class="mt-auto text-end float-right mr-3">
                                <a href="{{ route('service.nameChangeRule') }}" class="btn btn-dark">Apply</a>
                            </div>
                        </div>

                        <div class="bg-white  m-3  pb-5  text-justify">
                            <h5 class="border-bottom p-2 fw-bold"> <strong> Notify Address Change </strong></h5>
                            <p class="pb-4 pl-4 ">Announce of head office Address Change or other address change like email,
                                phone number,</p>
                            <hr class="border-4 ">
                            <div class="mt-auto text-end float-right mr-3">
                                <a href="{{ route('service.addressChangeRule') }}" class="btn btn-dark">Apply</a>
                            </div>
                        </div>

                        <div class="bg-white  m-3  pb-5  text-justify">
                            <h5 class="border-bottom p-2 fw-bold"> <strong> Issuance of Letter for Announcement of Civil
                                    Society Organization Logo </strong></h5>
                            <p class="p-4 ">Issuance of Letter for Announcement of Civil Society Organization Logo by
                                Authority for Civil Society Organizations</p>
                            <hr class="border-4 ">
                            <div class="mt-auto text-end float-right mr-3">
                                <a href="{{ route('service.support_letter_logo_rule') }}" class="btn btn-dark">Apply</a>
                            </div>
                        </div>
                        <div class="bg-white  m-3  pb-5  text-justify">
                            <h5 class="border-bottom p-2 fw-bold"> <strong> Sending an invitation letter to invite the
                                    Authority in General Assembly/Board meeting </strong></h5>
                            <p class="p-4 ">Provision of Support on General Assembly or Board Meetings of Civil Society
                                Organizations by Authority for Civil Society Organizations</p>
                            <hr class="border-4 ">
                            <div class="mt-auto text-end float-right mr-3">
                                <a href="{{ route('service.support_letter_meeting_rule') }}" class="btn btn-dark">Apply</a>
                            </div>
                        </div>
                    </div><!-- /.col -->

                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
@endsection
