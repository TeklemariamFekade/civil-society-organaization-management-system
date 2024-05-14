@extends('representative.layouts.app')

@section('content')
    <div class="content-wrapper bg-light">
        <div class="container mx-auto">
            <div class="col-md-12 border">

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('service.fill_support_letter_logo_form') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <fieldset class="border">
                        <fieldset class="border">
                            <legend class="bg-secondary text-white text-center font-italic">Organization Information
                            </legend>
                            <div class="form-group m-1 row">
                                <label for="english_name" class="col-sm-4 col-form-label">Name of the applicant
                                    organization:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="app_english_name" name="app_english_name"
                                        class="form-control font-italic text-dark"
                                        placeholder="Name of the applicant organization" required>
                                </div>
                            </div>
                            <div class="form-group m-1 row">
                                <label for="amharic_name" class="col-sm-4 col-form-label">የአመልካች ድርጅት ስም:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="app_amharic_name" name="app_amharic_name"
                                        class="form-control font-italic" placeholder="የአመልካች ድርጅት  ስም" required>
                                </div>
                            </div>

                        </fieldset>
                        <fieldset class="border">
                            <legend class="bg-secondary text-center text-light font-italic">Organization Letter File
                            </legend>
                            <div class="form-group m-3">
                                <label for="cso_file">File:</label>
                                <input type="file" id="cso_file" name="cso_file" class="form-control font-italic"
                                    required>
                            </div>
                        </fieldset>
                        <div class="form-group m-2 text-center d-flex justify-content-center">
                            <a href="{{ route('service.support_letter_logo_rule') }}" class="btn btn-dark mx-2">
                                <i class="fas fa-arrow-left"></i>
                                Back
                            </a>
                            <button class="btn btn-dark mx-2">Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
