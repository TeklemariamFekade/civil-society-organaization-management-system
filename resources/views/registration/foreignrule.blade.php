@extends('representative.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <h3 class="b border-bottom m-3 pl-3"><strong> Registration of Civil Society Organization For
                            foreign</strong></h3>
                    <div>
                        <p class="text-justfy m-2 pl-5">Registration of Foreign Civil Society Organization by Authority for
                            Civil
                            Society Organizations</p>

                    </div>
                    <div class="col-sm-11 ml-1">
                        <div class="bg-white  m-3  pb-5  text-justify">
                            <hr class="border-4 ">
                            <p class="border-top p-2 fw-bold"> <strong> Service Description </strong></p>
                            <p class="p-3 ">
                                Authority for Civil Society Organizations provides the service of registration of foreign
                                civil society organization which is a non-governmental organization formed under the laws of
                                foreign countries and registered to operate in Ethiopia. Such organization can submit
                                service request and if service requirements are met, the foreign civil society organization
                                will be registered and a registration certificate will be provided.</p>
                            <p class="p-3"> <strong>Who can apply</strong> </p>

                            <ol class="">
                                <li>Foreign Enterprise Civil Society</li>

                            </ol>
                            <p class="p-1"> <strong>Prerequisite</strong> </p>

                            <ol class="">
                                <li>Foreign Enterprise Civil Society</li>
                                <ul>
                                    <li>Constitution</li>
                                    <li>Letter to the Homeland Security Representative</li>
                                    <li>Certificate</li>
                                    <li>Decision made by the governing body of the organization</li>
                                    <li>2-year work plan</li>
                                    <li>Educational credentials of the domestic representative</li>
                                    <li>Curriculum Vitae (CV)</li>
                                    <li>Passport</li>
                                    <li>Photo 3 by 4</li>
                                    <li>Letter of application</li>
                                </ul>
                                <li>File requirments
                                    <p><i class="fas fa-exclamation-triangle"></i> Your file should include the following
                                        documents in one PDF when submitted:</p>
                                    <ul>
                                        <li>Authenticated Registration Certificate </li>
                                        <li>Bylaw</li>
                                        <li>Duly Authenticated Resolution</li>
                                        <li>Authenticated Power of attorney. </li>
                                        <li>2 year action plan</li>
                                        <li>Educational credentials of the domestic representative</li>
                                        <li>Curriculum Vitae(CV)</li>
                                        <li>Letter of recommendation</li>
                                        <li>Passport</li>
                                        <li>Request letter</li>
                                </li>
                                </ul>

                                <li>Name check requirments</li>
                                <p><i class="fas fa-exclamation-triangle"></i> Your organaization name must be unique when
                                    you register in Authority for Civil Society organization. click in the following link
                                    and check your organization name is siezed or not by
                                    searching</p>
                                <a href="{{ route('representative.csoList') }}" class="btn btn-primary">Go to CSO List</a>
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
                                <a href="{{ Route('registration.registrationform') }}" class="btn btn-dark">Agree and
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
