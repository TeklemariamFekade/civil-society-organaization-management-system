<!-- resources/views/cso/login.blade.php -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>
<section class="vh-100 bg-image"
    style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
    <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body p-5">
                            <h2 class="text-uppercase text-center mb-5">Create an account</h2>
                            <form method="POST" action="{{ route('representative.SignUp') }}">
                                @csrf
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example1cg">Your Name</label>
                                    <input type="text" id="form3Example1cg" class="form-control form-control-lg"
                                        name="name" required value="{{ old('name') }}" />
                                </div>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="form3Example3cg">Your Email</label>
                                    <input type="email" id="form3Example3cg" class="form-control form-control-lg"
                                        name="email" required value="{{ old('email') }}" />
                                    @if ($errors->has('email'))
                                        <div style="color: red">{{ $errors->first('email') }}</div>
                                    @endif
                                    @if ($errors->has('registered'))
                                        <div style="color: red">{{ $errors->first('registered') }}</div>
                                    @endif
                                </div>
                                <div>
                                    <label class="form-label" for="form3Example4cdg">Password</label>
                                </div>

                                <div class="form-outline d-flex align-items-center mb-4">
                                    <input type="password" id="pwd" class="form-control form-control-lg"
                                        name="password" required />

                                    @if ($errors->has('password'))
                                        <div class="invalid-feedback" style="color: red;">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif

                                    <div class="input-group-append">
                                        <div class="input-group-text p-3">
                                            <input type="checkbox" id="toggle-new-password"
                                                onclick="togglePasswordVisibility('pwd')">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label class="form-label" for="form3Example4cdg">Repeat your password</label>
                                </div>

                                <div class="form-outline d-flex align-items-center mb-4">
                                    <input type="password" id="pwdd" class="form-control form-control-lg"
                                        name="confirm_password" />
                                    <div class="input-group-append">
                                        <div class="input-group-text p-3">
                                            <input type="checkbox" id="toggle-confirm-password"
                                                onclick="togglePasswordVisibility('pwdd')">
                                        </div>
                                    </div>
                                </div>
                                @if ($errors->has('password_mismatch'))
                                    <div class="invalid-feedback" style="color: red;">
                                        {{ $errors->first('password_mismatch') }}
                                    </div>
                                @endif

                                <div class="d-flex justify-content-center mt-2">
                                    <button type="submit"
                                        class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                                </div>
                                <p class="text-center text-muted mt-5 mb-0">Already have an account? <a
                                        href="{{ route('representative.login') }}" class="fw-bold text-body"><u>Login
                                            here</u></a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
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
<script>
    function togglePasswordVisibility2(inputId) {
        var passwordInput = document.getElementById(inputId);

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        } else {
            passwordInput.type = "password";
        }
    }
</script>
