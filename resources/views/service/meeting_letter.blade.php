@extends('representative.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container mx-auto">
            <div class="mx-4">
                <div class="container border-1 mt-5">
                    <div class="col-sm-11 ml-1">
                        <h4 class="p-3 border-bottom mb-2 ms-4"><strong>Sending an invitation letter to invite the
                                Authority in General Assembly/Board meeting</strong></h4>
                        <p>Provision of Support on General Assembly or Board Meetings of Civil Society Organizations by
                            Authority for Civil Society Organizations</p>
                        <div class="bg-white  m-3  pb-5  text-justify">
                            <hr class="border-4 ">
                            <p class="border-top p-2 fw-bold"> <strong> Service Description </strong></p>
                            <p class="p-3 ">
                                During their General Assembly or Board Meetings, Civil Society Organizations can request for
                                and get technical support from Authority for Civil Society Organizations. The support. The
                                Authority for Civil Society Organizations receives request for the support and if service
                                requirements are met, the Authority participates in the general assembly or board meetings
                                and provides support.</p>

                            <p class="p-3"> <strong>Who Can Apply</strong> </p>
                            <ul>
                                <li>Any civil society organizations who want to invite the agency</li>
                            </ul>
                            <p class="p-3"> <strong>Prerequisite</strong> </p>


                            <ul class="">

                                <li> At the request of the Civil Society Organization</li>


                            </ul>

                            <p class="p-3"> <strong>File requirments</strong> </p>

                            <ol class="">
                                <li>Attach the request letter</li>
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
                                <a href="{{ Route('service.support_letter_meeting_form') }}" class="btn btn-dark">Agree and
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
