@extends('front.layouts.app')
@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Account Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('front.account.sidebar') 
                </div>
                <div class="col-lg-9">
                    <div class="card border-0 shadow mb-4">
                        <form action="{{ route('account.update.profile') }}" method="POST" id="userForm">
                            @csrf
                            <div class="card-body p-4">
                                <h3 class="fs-4 mb-1">My Profile</h3>
                                
                                <div class="mb-4">
                                    <label for="name" class="mb-2">Name*</label>
                                    <input type="text" 
                                           placeholder="Enter Name" 
                                           class="form-control" 
                                           id="name"
                                           name="name"
                                           value="{{ $user->name }}">
                                    <p></p>
                                </div>
                        
                                <div class="mb-4">
                                    <label for="email" class="mb-2">Email*</label>
                                    <input type="email" 
                                           placeholder="Enter Email" 
                                           class="form-control"
                                           id="email"
                                           name="email"
                                           value="{{ $user->email }}">
                                    <p></p>
                                </div>
                        
                                <div class="mb-4">
                                    <label for="designation" class="mb-2">Designation</label>
                                    <input type="text" 
                                           placeholder="Designation" 
                                           class="form-control"
                                           id="designation"
                                           name="designation"
                                           value="{{ $user->designation ?? '' }}">
                                </div>
                        
                                <div class="mb-4">
                                    <label for="mobile" class="mb-2">Mobile</label>
                                    <input type="text" 
                                           placeholder="Mobile" 
                                           class="form-control"
                                           id="mobile"
                                           name="mobile"
                                           value="{{ $user->mobile ?? '' }}">
                                </div>
                            </div>
                        
                            <div class="card-footer p-4">
                                <button type="button" class="btn btn-primary" onclick="updateUserSubmit()">Update</button>
                            </div>
                        </form>
                        
                    </div>

                    <div class="card border-0 shadow mb-4">
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">Change Password</h3>
                            <div class="mb-4">
                                <label for="" class="mb-2">Old Password*</label>
                                <input type="password" placeholder="Old Password" class="form-control">
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">New Password*</label>
                                <input type="password" placeholder="New Password" class="form-control">
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Confirm Password*</label>
                                <input type="password" placeholder="Confirm Password" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer  p-4">
                            <button type="button" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
       function updateUserSubmit() {
            var data = $("#userForm").serialize();
            $.ajax({
                url: "{{ route('account.update.profile') }}",
                type: "POST",  // Change to POST
                data: data,
                success: function(response) {
                    // Handle success
                    if (response.status == true) {
                        Swal.fire({
                            title: 'Profile Updated!',
                            text: 'Your profile was updated successfully!',
                            icon: null,
                            width: '300px',
                            customClass: {
                                popup: 'small-swal',
                            },
                            confirmButtonText: 'OK',
                        });

                    } else {
                        var errors = response.errors;
                        if(errors.name) {
                            $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name);
                        } else {
                            $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        }

                        if(errors.email) {
                            $('#email').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.email);
                        } else {
                            $('#email').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                        }
                    }
                }
            });
        }

    </script>
@endsection