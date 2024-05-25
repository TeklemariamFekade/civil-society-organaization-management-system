@extends('representative.layouts.app')
@section('content')
    <div class="content-wrapper bg-light">
        <div class="container mx-auto">
            <div class="col-md-12 border">
                @php
                    $count = 0;
                    $sectors = App\Models\Sector::all();
                @endphp

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-error">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('registration.request') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="border">
                        <legend class="bg-secondary text-white text-center font-italic">Organizational Information</legend>
                        <div class="form-row m-3">
                            <div class="col-md-6">
                                <div class="form-group d-flex">
                                    <label for="english_name" class="flex-grow-1">English Name:</label>
                                    <input type="text" id="english_name" name="english_name"
                                        class="form-control font-italic text-dark"
                                        placeholder="Enter organization English name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group d-flex">
                                    <label for="amharic_name" class="flex-grow-1">የአማርኛ ስም:</label>
                                    <input type="text" id="amharic_name" name="amharic_name"
                                        class="form-control font-italic" placeholder="የአመልካች ተቋም ስም በአማርኛ" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row m-3">
                            <div class="col-md-6">
                                <div class="form-group d-flex">
                                    <label for="date_of_established" class="flex-grow-1">Date of Established:</label>
                                    <input type="date" id="date_of_established" name="date_of_established"
                                        class="form-control font-italic" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group d-flex">
                                    <label for="type" class="flex-grow-1">Type:</label>
                                    <select name="type" class="form-select border p-2 font-italic"
                                        style="width: 100%; border-color: transparent;" required>
                                        <option value="" disabled selected>Open this select menu</option>
                                        <option value="Board-Lead organization">Board-Lead organization</option>
                                        <option value="Board-Lead Consortium">Board-Lead Consortium</option>
                                        <option value="Charitable Association">Charitable Association</option>
                                        <option value="Mass_based Association">Mass_based Association</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row m-3">
                            <div class="col-md-6">
                                <div class="form-group d-flex">
                                    <label for="category" class="flex-grow-1">Category:</label>
                                    <select name="category" class="form-select border p-2 font-italic"
                                        style="width: 100%; border-color: transparent;" required>
                                        <option value="" disabled selected>Open this select menu</option>
                                        <option value="Foreign">Foreign</option>
                                        <option value="Local">Local</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group d-flex">
                                    <label for="place_of_work" class="flex-grow-1">Place Of Work:</label>
                                    <input type="text" id="place_of_work" name="place_of_work"
                                        class="form-control font-italic" placeholder="Enter place of work" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row m-3">
                            <div class="col-md-6">
                                <div class="form-group d-flex">
                                    <label for="country" class="flex-grow-1">Country of origin:</label>
                                    <input type="text" id="country" name="country_of_origin"
                                        class="form-control font-italic" placeholder="Enter the country" required>
                                </div>
                            </div>
                        </div>
                        <fieldset class="border">
                            <legend class="bg-secondary text-light text-center font-italic">Sector Information</legend>
                            <div class="form-row m-3">
                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center">
                                        <label for="sector">Sector Name:</label>
                                        <select name="sector_name" class="form-select border p-2 font-italic"
                                            style="width: 100%; border-color: transparent;" required>
                                            @foreach ($sectors as $sector)
                                                <option value="{{ $sector->sector_name }}">{{ $sector->sector_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center">
                                        <label for="sector_type">Sub sector:</label>
                                        <select name="sub_sector_name" class="form-select border p-2 font-italic"
                                            style="width: 100%; border-color: transparent;" required>
                                            <option value="" disabled selected>Open this select menu</option>
                                            <option value="Foreign">child</option>
                                            <option value="Local">Local</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="border">
                            <legend class="bg-secondary text-light text-center font-italic">Head Office Address Information
                            </legend>
                            <div class="form-row m-3">
                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center">
                                        <label for="country" class="col-form-label">Country:</label>
                                        <input type="text" id="country" name="country"
                                            class="form-control font-italic" placeholder="Enter the country" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center">
                                        <label for="region" class="col-form-label">Region:</label>
                                        <input type="text" id="region" name="region"
                                            class="form-control font-italic" placeholder="Enter the region" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row m-3">
                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center">
                                        <label for="zone" class="col-form-label">Zone:</label>
                                        <input type="text" id="zone" name="zone"
                                            class="form-control font-italic" placeholder="Enter zone" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center">
                                        <label for="woreda" class="col-form-label">Woreda:</label>
                                        <input type="text" id="woreda" name="woreda"
                                            class="form-control font-italic" placeholder="Enter woreda" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row m-3">
                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center">
                                        <label for="kebele" class="col-form-label">Kebele:</label>
                                        <input type="text" id="kebele" name="kebele"
                                            class="form-control font-italic" placeholder="Enter kebele" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center">
                                        <label for="district" class="col-form-label">District:</label>
                                        <input type="text" id="district" name="district"
                                            class="form-control font-italic" placeholder="Enter district" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row m-3">
                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center">
                                        <label for="phone_no" class="col-form-label">Phone Number:</label>
                                        <input type="text" id="phone_no" name="phone_no"
                                            class="form-control font-italic" placeholder="Enter phone number" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group d-flex align-items-center">
                                        <label for="po_box" class="col-form-label">P.O.BOX:</label>
                                        <input type="text" id="po_box" name="po_box"
                                            class="form-control font-italic" placeholder="Enter P.O.BOX" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group m-3">
                                <label for="email" class="col-form-label">Email:</label>
                                <div class="col-md-6 d-inline-flex">
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
                            <a href="{{ Route('registration.localrule') }}" class="btn btn-dark mx-2"> <i
                                    class="fas fa-arrow-left"></i>Back</a>
                            <button class="btn btn-dark mx-2">Submit</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
@endsection
