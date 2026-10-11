<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>JobsPortal | Find Your Next Opportunity</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/portal.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
	<!-- Fav Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="#" />
</head>
<body data-instant-intensity="mousedown">
<header class="site-header">
	<nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
		<div class="container">
			<a class="navbar-brand" href="{{ route('frontend.home') }}"><i class="fa fa-briefcase"></i> <span>Jobs</span>Portal</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="{{ route('frontend.home') }}">Home</a>
					</li>	
					<li class="nav-item">
						<a class="nav-link" href="{{ route('frontend.jobs') }}">Jobs</a>
					</li>										
                    <li class="nav-item"><a class="nav-link" href="{{ route('frontend.home') }}#companies">Employers</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('frontend.home') }}#categories">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('frontend.home') }}#career-advice">Career Advice</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('frontend.contact') }}">Contact Us</a></li>
				</ul>
				@if (Auth::user())
					<a class="account-chip mx-2" href="{{ route('account.profile') }}">
						{{ Auth::user()->name }}
					</a>
				@else
					<a class="btn btn-outline-primary me-2" href="{{ route('account.login') }}">Sign In</a>
				@endif			
				<a class="btn btn-primary" href="{{ route('account.create.job') }}">Post a Job</a>
			</div>
		</div>
	</nav>
</header>

@yield('content')


<div class="modal fade" id="updateImageModal" tabindex="-1" aria-labelledby="updateImageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title pb-0" id="updateImageModalLabel">Change Profile Picture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('account.updateProfilePic') }}" id="profilePicForm" name="profilePicForm">
			@csrf
            <div class="mb-3">
                <label for="image" class="form-label">Profile Image</label>
                <input type="file" class="form-control" id="image"  name="image">
				<div class="text-danger" id="image-error"></div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary mx-3" onclick="userProfileUpdate()">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<footer class="portal-footer"><div class="container footer-grid">
    <div><a class="footer-brand" href="{{ route('frontend.home') }}">JobsPortal</a><p>Your next chapter starts here.</p><a href="{{ route('account.registration') }}">Create an account</a></div>
    <div><h3>Quick Links</h3><a href="{{ route('frontend.home') }}#latest-jobs">Find Jobs</a><a href="{{ route('account.create.job') }}">Post a Job</a><a href="{{ route('frontend.home') }}#how-it-works">How It Works</a><a href="{{ route('frontend.contact') }}">Contact Us</a></div>
    <div><h3>Jobs By Functional Area</h3><a href="{{ route('frontend.home') }}#categories">Marketing</a><a href="{{ route('frontend.home') }}#categories">Software Development</a><a href="{{ route('frontend.home') }}#categories">Design & Creative</a><a href="{{ route('frontend.home') }}#categories">Engineering</a></div>
    <div><h3>Connect With Us</h3><p>Find opportunities. Meet great teams.<br>Build a career you love.</p><a href="{{ route('frontend.contact') }}"><i class="fa fa-envelope-o"></i> Get in touch</a></div>
</div></footer><div class="footer-bottom"><div class="container"><span>&copy; {{ date('Y') }} JobsPortal. All rights reserved.</span><span>Made for your next move.</span></div></div>
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<!-- SweetAlert CSS and JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
<script src="{{ asset('assets/js/instantpages.5.1.0.min.js') }}"></script>
<script src="{{ asset('assets/js/lazyload.17.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/js/lightbox.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });

	// user profile image update
	function userProfileUpdate() {
		var formData = new FormData(document.getElementById('profilePicForm')); // Corrected form ID
    	var url = "{{ route('account.updateProfilePic') }}";
		
		$.ajax({
			type: "POST",
			url: url,
			data: formData,
			dataType: "json",
			contentType: false,
			processData: false,
			success: function(response) {
				var errors = response.errors;
				// Handle success
				if (response.status === true) {
					$("#updateImageModal").modal("hide");
					window.location.reload();
				} else {
					$("#image-error").html(errors.image);
				}
			}
		});
	}

</script>
@yield('js')
</body>
</html>
