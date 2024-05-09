@extends('representative.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="container mx-auto">
            <div class="mx-4">
                <div class="container border-1 mt-5">
                    <div class="col-sm-11 ml-1">
                        <h4 class="p-3 border-bottom mb-2 ms-4"><strong>Verification of Name Change for Civil Society
                                Organization</strong></h4>
                        <p>Verification of Name Change for Civil Society Organization by Authority for Civil Society
                            Organizations</p>


                        <div class="bg-white  m-3  pb-5  text-justify">
                            <hr class="border-4 ">
                            <p class="border-top p-2 fw-bold"> <strong> Service Description </strong></p>
                            <p class="p-3 ">
                                Civil Society Organizations that want to change their name are required to have verification
                                of their new name by the authority for Civil Society Organizations. The authority for Civil
                                Society Organizations verifies the fulfillment of service requirements and provides new
                                certificate for the Civil Society Organizations.

                            </p>

                            <p class="p-3"> <strong>Prerequisite</strong> </p>

                            <ol class="">
                                <li>Notice approved by the governing body / Letter from the parent organization</li>
                                <li>Return the previous certificate</li>

                            </ol>

                            <p class="p-3"> <strong>File requirments</strong> </p>

                            <ol class="">
                                <li>Cover letter which is signed by the president/executive director</li>
                                <li>Minutes approved by a board or general assembly</li>
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
                                <a href="{{ Route('service.viewNameChangeForm') }}" class="btn btn-dark">Agree and
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
