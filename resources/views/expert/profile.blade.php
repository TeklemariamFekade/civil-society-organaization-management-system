@extends('expert.layout.app')

@section('content')
    <?php
    $user = Auth::user();
    
    ?>
    <div class="content-wrapper">
        <div class="container mx-auto">
            <div class="mx-4">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- Added "ml-auto ml-2" classes here -->
                <form action="{{ route('expert.updateProfile', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-12 border-right">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right">Profile Management</h4>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-2">
                                        <strong>Name:</strong>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" name="name" value="{{ $user->name }}"
                                            class="form-control" placeholder="User name">
                                        @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-2">
                                        <strong>Email:</strong>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="email" name="email" class="form-control" placeholder="Email"
                                            value="{{ $user->email }}">
                                        @error('email')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label for="photo" class="col-md-2 col-form-label">Photo:</label>
                                    <div class="col-md-10">
                                        <input type="file" name="photo" class="form-control-file" accept="image/*">
                                        @error('photo')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                        @if ($user->photo)
                                            <img src="{{ asset($user->photo) }}" alt="Profile Photo" width="100">
                                        @else
                                            <span>No photo available</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="form-group m-2 text-center d-flex justify-content-center">
                        <a href="{{ Route('expert.dashboard') }}" class="btn btn-dark mx-2">
                            <i class="fas fa-arrow-left"></i>
                            Back
                        </a>
                        <button class="btn btn-dark mx-2">Update
                        </button>
                    </div>
                </form>
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
