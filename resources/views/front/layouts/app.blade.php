<!DOCTYPE html>
<html class="no-js" lang="en_AU" />
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>CareerVibe | Find Best Jobs</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
	<!-- Fav Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="#" />
</head>
<body data-instant-intensity="mousedown">
<header>
	<nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
		<div class="container">
			<a class="navbar-brand" href="{{ route('frontend.home') }}">CareerVibe</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="{{ route('frontend.home') }}">Home</a>
					</li>	
					<li class="nav-item">
						<a class="nav-link" aria-current="page" href="">Find Jobs</a>
					</li>										
				</ul>
				@if (Auth::user())
					<a class="border p-2 rounded-3 mx-2" href="{{ route('account.profile') }}">
						{{ Auth::user()->name }}
					</a>
				@else
					<a class="btn btn-outline-primary me-2" href="{{ route('account.login') }}">Login</a>
				@endif			
				<a class="btn btn-primary" href="">Post a Job</a>
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

<footer class="bg-dark py-3 bg-2">
<div class="container">
    <p class="text-center text-white pt-3 fw-bold fs-6">© 2023 xyz company, all right reserved</p>
</div>
</footer> 
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