@extends('dataencoder.layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container mx-auto">
            <div class="mx-4">
                <div class="container mt-2">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left mb-2">
                                <h2>Change Password</h2>
                            </div>
                        </div>
                    </div>
                    @if (session('status'))
                        <div class="alert alert-success mb-1 mt-1">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('dataencoder.updatePassword') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="container mt-3">
                            <div class="mb-3 d-flex flex-column flex-lg-row align-items-lg-center">
                                <label for="old-password" class="mb-2 mb-lg-0 me-lg-2">Old Password:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="old-password"
                                        placeholder="Enter current password" name="old_password"
                                        style="background-color: #F0F0F0; color: black;" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="toggle-old-password"
                                                onclick="togglePasswordVisibility('old-password')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('old_password'))
                                <div class="alert alert-danger mt-1 d-block">
                                    {{ $errors->first('old_password') }}
                                </div>
                            @endif
                        </div>



                        <div class="container mt-3">
                            <div class="mb-3 d-flex flex-column flex-lg-row align-items-lg-center">
                                <label for="confirm-password" class="mb-2 mb-lg-0 me-lg-2">New Password:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="new-password"
                                        placeholder="Enter new password" name="new_password"
                                        style="background-color: #F0F0F0; color: black;" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="toggle-confirm-password"
                                                onclick="togglePasswordVisibility('confirm-password')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="container mt-3">
                            <div class="mb-3 d-flex flex-column flex-lg-row align-items-lg-center">
                                <label for="confirm-password" class="mb-2 mb-lg-0 me-lg-2">Confirm Password:</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="confirm-password"
                                        placeholder="Confirm password" name="confirm_password"
                                        style="background-color: #F0F0F0; color: black;" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <input type="checkbox" id="toggle-confirm-password"
                                                onclick="togglePasswordVisibility('confirm-password')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('password_mismatch'))
                                <div class="alert alert-danger mt-1 d-block">
                                    {{ $errors->first('password_mismatch') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group m-2 text-center d-flex justify-content-center">
                            <a href="{{ Route('dataencoder.dashboard') }}" class="btn btn-dark mx-2">
                                <i class="fas fa-arrow-left"></i>
                                Back
                            </a>
                            <button class="btn btn-dark mx-2">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        function togglePasswordVisibility(inputId) {
            var passwordInput = document.getElementById(inputId);

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
@endsection


@push('scripts')
    @if (session('password_updated'))
        <script>
            alert("Password updated successfully!");
        </script>
    @endif
@endpush
