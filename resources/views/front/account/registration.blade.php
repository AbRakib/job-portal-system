@extends('front.layouts.app')
@section('content')
<section class="section-5 auth-section registration-section">
    <div class="container">
        <div class="auth-compact">
            <div class="auth-panel">
                <div class="auth-card">
                    <div class="auth-heading">
                        <h2>Register</h2>
                    </div>
                    <form action="" id="registrationForm">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name*</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name">
                            <p></p>
                        </div> 
                        <div class="mb-3">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email">
                            <p></p>
                        </div> 
                        <div class="mb-3">
                            <label for="password" class="form-label">Password*</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password">
                            <p></p>
                        </div> 
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password*</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
                            <p></p>
                        </div> 
                        <button class="btn btn-primary auth-submit" type="submit">Register</button>
                    </form>                    
                </div>
                <div class="auth-switch">
                    <p>Have an account? <a  href="{{ route('account.login') }}">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
    <script>
        $("#registrationForm").submit(function (e) { 
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "{{ route('account.registration.process') }}",
                data: $("#registrationForm").serializeArray(),
                dataType: "json",
                success: function (response) {
                    var errors = response.errors;
                    if (errors) {
                        if(errors.name) {
                            $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name);
                        }else {
                            $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        }

                        if(errors.email) {
                            $('#email').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.email);
                        }else {
                            $('#email').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        }

                        if(errors.password) {
                            $('#password').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.password);
                        }else {
                            $('#password').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        }

                        if(errors.confirm_password) {
                            $('#confirm_password').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.confirm_password);
                        }else {
                            $('#confirm_password').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        }
                    }
                    
                    // success 
                    if(response.status == true) {
                        window.location.href='{{ route('account.login') }}';
                    }
                }
            });
        });
    </script>
@endsection
