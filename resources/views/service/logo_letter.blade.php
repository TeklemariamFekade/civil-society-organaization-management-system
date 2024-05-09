@extends('representative.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container mx-auto">
            <div class="mx-4">
                <div class="container border-1 mt-5">
                    <div class="col-sm-11 ml-1">
                        <h4 class="p-3 border-bottom mb-2 ms-4"><strong>Issuance of Letter for Announcement of Civil
                                Society Organization Logo</strong></h4>
                        <p>Issuance of Letter for Announcement of Civil Society Organization Logo by Authority for Civil
                            Society Organizations</p>
                        <div class="bg-white  m-3  pb-5  text-justify">
                            <hr class="border-4 ">
                            <p class="border-top p-2 fw-bold"> <strong> Service Description </strong></p>
                            <p class="p-3 ">
                                Civil Society Organizations are required to announce their names by press before use. The
                                authority for Civil Society Organizations provides Civil Society Organizations with letter
                                of press announcement of civil society organization’s name and logo after reviewing and
                                verifying the fulfillment of service requirements.</p>
                            <p class="p-3"> <strong>Prerequisite</strong> </p>

                            <ol class="">
                                <li>Attach minutes approved by the decision-making body of the organization. </li>
                                <li>Provide hard and soft copy of the logo</li>
                            </ol>

                            <p class="p-3"> <strong>File requirments</strong> </p>
                            <ol class="">
                                <li>Minutes approved by a board or general assembly</li>
                                <li>Cover letter which is signed by the president/executive director</li>
                                <li>Soft copy of the logo</li>
                                <p> N.B. your documents must merged in one PDF</p>
                            </ol>

                            <hr class="border-4 ">
                            <div class=" alert alert-info mt-2  ml-1">
                                <p> <i class="fas fa-exclamation-circle fa-3x"></i>
                                    By continuing to use the system, you certify that you have read the above service
                                    requests
                                    instructions
                                    and accept the applicable terms and conditions.</p>
                                <strong class="ml-3">Terms and Conditions</strong>
                            </div>
                            <div class="mt-auto border text-end float-right mr-3">
                                <a href="{{ Route('service.support_letter_logo_form') }}" class="btn btn-dark">Agree and
                                    Continue <i class="fas fa-arrow-right"></i></a>
                            </div>
                            <div class="mt-auto border text-end float-right mr-3">
                                <a href="{{ route('service.index') }}" class="btn btn-dark">
                                    <i class="fas fa-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
