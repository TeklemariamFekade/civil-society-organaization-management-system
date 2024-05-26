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
                <form action="{{ route('service.fillAddressChangeForm') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="border">
                        <fieldset class="border">
                            <legend class="bg-secondary text-white text-center font-italic">Organizational Information
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
                            <div class="form-group m-1 row">
                                <label for="category" class="col-sm-4 col-form-label">Category:</label>
                                <div class="col-sm-8">
                                    <select name="category" id="category" class="form-select border p-2 font-italic"
                                        style="border-color: transparent;" required>
                                        <option value="" disabled selected>Open this select menu</option>
                                        <option value="Foreign">Foreign</option>
                                        <option value="Local">Local</option>
                                    </select>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset class="border">
                            <legend class="bg-secondary text-white text-center font-italic">New Organizational Address
                                Information</legend>
                            <div class="form-group m-1 row">
                                <label for="country" class="col-sm-4 col-form-label mt-2">place of work:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="place_of_work" name="place_of_work"
                                        class="form-control font-italic" placeholder="Enter place of work" required>
                                </div>
                            </div>
                            <div class="form-group m-1 row">
                                <label for="country" class="col-sm-4 col-form-label mt-2">Country:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="country" name="country" class="form-control font-italic"
                                        placeholder="Enter the country" required>
                                </div>
                            </div>
                            <div class="form-group m-1 row">
                                <label for="region" class="col-sm-4 col-form-label mt-2">Region/ City:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="region" name="region" class="form-control font-italic"
                                        placeholder="Enter the region" required>
                                </div>
                            </div>
                            <div class="form-group m-1 row">
                                <label for="zone" class="col-sm-4 col-form-label mt-2">Zone/ Sub_City:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="zone" name="zone" class="form-control font-italic"
                                        placeholder="Enter zone" required>
                                </div>
                            </div>
                            <div class="form-group m-1 row">
                                <label for="woreda" class="col-sm-4 col-form-label mt-2">Woreda:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="woreda" name="woreda" class="form-control font-italic"
                                        placeholder="Enter woreda" required>
                                </div>
                            </div>
                            <div class="form-group m-1 row">
                                <label for="kebele" class="col-sm-4 col-form-label mt-2">Kebele:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="kebele" name="kebele" class="form-control font-italic"
                                        placeholder="Enter kebele" required>
                                </div>
                            </div>
                            <div class="form-group m-1 row">
                                <label for="district" class="col-sm-4 col-form-label mt-2">District:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="district" name="district" class="form-control font-italic"
                                        placeholder="Enter district" required>
                                </div>
                            </div>

                            <div class="form-group m-1 row">
                                <label for="phone_no" class="col-sm-4 col-form-label mt-2">Phone Number:</label>
                                <div class="col-sm-8">
                                    <input type="text" id="phone_no" name="phone_no"
                                        class="form-control font-italic" placeholder="Enter phone number" required>
                                </div>
                            </div>
                            <div class="form-group m-1 row">
                                <label for="po_box" class="col-sm-4 col-form-label mt-2">P.O.BOX:</label>
                                <div class="col-sm-8">

                                    <input type="text" id="po_box" name="po_box" class="form-control font-italic"
                                        placeholder="Enter P.O.BOX" required>
                                </div>
                            </div>
                            <div class="form-group m-1 row">
                                <label for="email" class="col-sm-4 col-form-label mt-2">Email:</label>
                                <div class="col-sm-8">
                                    <input type="email" id="email" name="email" class="form-control font-italic"
                                        placeholder="Enter your email" required>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border">
                            <legend class="bg-secondary text-center text-light font-italic">Organization File</legend>
                            <div class="form-group m-3">
                                <label for="cso_file">File:</label>
                                <input type="file" id="cso_file" name="cso_file" class="form-control font-italic"
                                    required>
                            </div>
                        </fieldset>
                        <div class="form-group m-2 text-center d-flex justify-content-center">
                            <a href="{{ route('service.addressChangeRule') }}" class="btn btn-dark mx-2">
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
