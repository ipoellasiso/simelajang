<!doctype html>
<html lang="en">
  <head>
  	<title>Simelajang - Login</title>
    <link rel="shortcut icon" href="/theme/assets/images/logo244.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css " rel="stylesheet">
	
	<link rel="stylesheet" href="/login/css/style.css">

	</head>
	<body>


<div class="main-banner" id="top">
    <video autoplay muted loop id="bg-video">
        <source src="/login2/assets/images/212.mp4" type="video/mp4" />
    </video>

    <div class="video-overlay header-text">
        <div class="caption">
            <!-- <h6>Silahkan Login</h6> -->
            
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					{{-- <h2 class="heading-section">Login #10</h2> --}}
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Silahkan Login</h3>
		      	<form method="POST" class="my-login-validation" action="/cek_login">
                    @csrf
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="email.." required>
                </div>
	            <div class="form-group">
	              <input id="password-field" name="password" type="password" class="form-control" placeholder="Password.." required>
	              <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-primary submit px-3">Masuk</button>
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
		            	<label class="checkbox-wrap checkbox-primary">Remember Me
									  <input type="checkbox" checked>
									  <span class="checkmark"></span>
									</label>
								</div>
								{{-- <div class="w-50 text-md-right">
									<a href="#" style="color: #fff">Forgot Password</a>
								</div> --}}
	            </div>
	          </form>
	          {{-- <p class="w-100 text-center">Klik Tombol dibawah ini untuk kembali ke Halaman Depan</p> --}}
              <p class="w-100 text-center">>
                Klik Home untuk ke Halaman Depan  
                <a href="/" class="small" href=""> Home</a>
              </p>
	          {{-- <div class="social d-flex text-center"> --}}
	          	{{-- <a href="#" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Facebook</a> --}}
	          	{{-- <a href="/" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Home</a> --}}
	          </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

  <script src="/login/js/jquery.min.js"></script>
  <script src="/login/js/popper.js"></script>
  <script src="/login/js/bootstrap.min.js"></script>
  <script src="/login/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    @if (session('success'))
        Swal.fire({
          position: "top-center",
          text: "Success",
          icon: "success",
          title: "{{ Session::get('success') }}",
          showConfirmButton: false,
          timer: 3500
        });
    @endif
</script>

<script>
    @if (session('error'))
        Swal.fire({
          position: "top-center",
          text: "Upss Sorry !",
          icon: "error",
          title: "{{ Session::get('error') }}",
          showConfirmButton: false,
          timer: 5500
        });
    @endif
</script>

<script>
    @if (session('status'))
        Swal.fire({
          position: "top-center",
          text: "Success",
          icon: "success",
          title: "{{ Session::get('status') }}",
          showConfirmButton: false,
          timer: 3500
        });
    @endif
</script>

	</body>
</html>

