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
                <form action="{{ route('service.fillNameChangeForm') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="border">
                        <legend class="bg-secondary text-white text-center font-italic">Organizational Information</legend>
                        <div class="form-group row m-3">
                            <label for="old_english_name" class="col-sm-4 col-form-label">Former Name of the applicant
                                organization:</label>
                            <div class="col-sm-8">
                                <input type="text" id="old_english_name" name="old_english_name"
                                    class="form-control font-italic text-dark"
                                    placeholder="Former Name of the applicant organization" required>
                            </div>
                        </div>
                        <div class="form-group row m-3">
                            <label for="old_amharic_name" class="col-sm-4 col-form-label">የአመልካች ድርጅት የቀድሞው ስም':</label>
                            <div class="col-sm-8">
                                <input type="text" id="old_amharic_name" name="old_amharic_name"
                                    class="form-control font-italic" placeholder="የአመልካች ድርጅት የቀድሞው ስም" required>
                            </div>
                        </div>
                        <div class="form-group row m-3">
                            <label for="new_english_name" class="col-sm-4 col-form-label">New Name of the applicant
                                organization:</label>
                            <div class="col-sm-8">
                                <input type="text" id="new_english_name" name="new_english_name"
                                    class="form-control font-italic text-dark"
                                    placeholder="New Name of the applicant organization" required>
                            </div>
                        </div>
                        <div class="form-group row m-3">
                            <label for="new_amharic_name" class="col-sm-4 col-form-label">የአመልካች ድርጅት አዲስ ስም':</label>
                            <div class="col-sm-8">
                                <input type="text" id="new_amharic_name" name="new_amharic_name"
                                    class="form-control font-italic" placeholder="የአመልካች ድርጅት አዲስ ስም" required>
                            </div>
                        </div>
                        <legend class="bg-secondary text-center text-light font-italic">Organization File</legend>
                        <div class="form-group m-3">
                            <label for="cso_file">File:</label>
                            <input type="file" id="cso_file" name="cso_file" class="form-control font-italic" required>
                        </div>
                        <div class="form-group m-2 text-center d-flex justify-content-center">
                            <a href="{{ route('service.nameChangeRule') }}" class="btn btn-dark mx-2"> <i
                                    class="fas fa-arrow-left"></i>Back</a>
                            <button class="btn btn-dark mx-2">Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
