<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="{{ asset('css/tiny-slider.css') }}" rel="stylesheet">
		<link href="{{ asset('css/style.css') }}" rel="stylesheet">


		<title>View Item</title>
	</head>

	<body>



    <!-- Start Header/Navigation -->
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark mb-4" arial-label="Furni navigation bar">
            <div class="container">
                <a class="navbar-brand" href="index.html">Furni<span>.</span></a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarsFurni">
                    <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.html">Home</a>
                        </li>
                        <li><a class="nav-link" href="{{ route('visitor.shop') }}">Shop</a></li>
                        <li><a class="nav-link" href="about.html">About us</a></li>
                        <li><a class="nav-link" href="services.html">Services</a></li>
                        <li><a class="nav-link" href="blog.html">Blog</a></li>
                        <li><a class="nav-link" href="contact.html">Contact us</a></li>
                    </ul>

                    
                </div>
            </div>
        </nav>
            <!-- End Header/Navigation -->

		
       <!-- Left Section -->
       <div class="container">
    <div class="row">
        <!-- Left Section: Facilities (70%) -->
        <div class="col-md-8">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="row">
                @foreach ($facilities as $facility)
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div id="carouselFacility{{ $facility->id }}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($facility->images as $index => $image)
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('images/' . $image) }}" class="d-block w-100 img-fluid rounded shadow-sm" alt="Image">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselFacility{{ $facility->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselFacility{{ $facility->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $facility->facility_name }}</h5>
                                <p class="card-text"><strong>Price:</strong> ₱{{ number_format($facility->total_price, 2) }}</p>
                                <p class="card-text"><strong>Discount:</strong> {{ $facility->discount }}%</p>
                                <p class="card-text"><strong>Amenities:</strong> {{ $facility->amenities }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- Right Section: Booking Form (30%) -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Book Now</h5>
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="cellphone" class="form-label">Cell Phone Number</label>
                            <input type="tel" id="cellphone" name="cellphone" class="form-control" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="checkin" class="form-label">Check-In Date</label>
                            <input type="date" id="checkin" name="checkin" class="form-control" required>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="checkout" class="form-label">Check-Out Date</label>
                            <input type="date" id="checkout" name="checkout" class="form-control" required>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



        <!-- right -->
               

        <link href="{{ asset('js/bootstrap.bundle.min.js') }}" rel="stylesheet">
		<link href="{{ asset('js/tiny-slider.js') }}" rel="stylesheet">
        <link href="{{ asset('js/custom.js') }}" rel="stylesheet">
	</body>

</html>
