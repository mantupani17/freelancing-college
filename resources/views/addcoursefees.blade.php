@extends('layout.collegeLayout.design_layout')
@section('title','Add College |')

@section('content')
	<div class="main-wrapper">
		<!-- HEADER -->
		<nav class="navbar navbar-expand-md navbar-dark">
			<div class="container">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item">
							<a class="nav-link active" href="dashboard-list-admin.html">
							<i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle " href="javascript:void(0)" id="navbarDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-list-ul" aria-hidden="true"></i> Listing
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="">Add College Information</a>
								<a class="dropdown-item" href="">Add College Details</a>
								<a class="dropdown-item" href="">URL</a>
							</div>
						</li>
					</ul>
					<form class="form-inline my-2 my-lg-0 position-relative d-none d-md-block">
						<input class="form-control-sm" placeholder="Search" aria-label="Search">
						<i class="fa fa-search" aria-hidden="true"></i>
					</form>
				</div>
			</div>
		</nav>
		<section class="bg-light py-5 height100vh">
			<div class="container">
				<nav class="bg-transparent breadcrumb breadcrumb-2 px-0 mb-5" aria-label="breadcrumb">
					<h2 class="font-weight-normal mb-4 mb-md-0">Dashboard</h2>
					<ul class="list-unstyled d-flex p-0 m-0">
						<li class="breadcrumb-item"><a href="/">Home</a></li>
					</ul>
				</nav>
				<!-- About -->
				<div class="card">
					<div class="card-body px-6 pt-6 pb-1">
						<h3 class="h4 mb-4">Course Details</h3>
						{{-- @if ($errors->any())
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
						@endif --}}
						<form action="{{route('add-coursefees')}}" method="POST" >
							@csrf
							<div class="row">
								<div class="form-group col-md-6 mb-6">
									<label for="listingTitle">College List</label>
									<select name="college_id" id="college_id" class="form-control @error('college_id') is-invalid @enderror"  >
										<option value="">Select College</option>
										@foreach($collegeList as $college)
											<option value="{{$college->id}}" {{old('college_id') != null && old('college_id') == $college->id ? 'selected' : '' }}>{{$college->collegeName}}</option>
										@endforeach
									</select>
									@error('college_id')
										<div class="invalid-feedback">
											{{$message}}
									  	</div>
									@enderror
								</div>
								<div class="form-group col-md-6 mb-6">
									<label for="listingTitle">Course List</label>
									<select name="course_id" id="course_id" class="form-control @error('course_id') is-invalid @enderror"  >
										<option value="">Select Course</option>
										@foreach($courseList as $course)
											<option value="{{$course->id}}" {{old('course_id') != null && old('course_id') == $course->id ? 'selected' : '' }}>{{$course->courseName}}</option>
										@endforeach
									</select>
									@error('course_id')
										<div class="invalid-feedback">
											{{$message}}
									  	</div>
									@enderror
								</div>
                            
								
								<div class="form-group col-md-6 mb-6">
									<label for="listingTitle">Course Fees</label>
									<input type="text" name="course_fees" value="{{old('course_fees')}}" class="form-control @error('course_fees') is-invalid @enderror" placeholder="Enter Course Fees" >
									@error('course_fees')
										<div class="invalid-feedback">
											{{$message}}
									  	</div>
									@enderror
								</div>
								
								<div class="form-group col-md-6 mb-6">
									<label for="listingTitle">Course Type</label>
									<input type="text" name="course_type" value="{{old('course_type')}}" class="form-control @error('course_type') is-invalid @enderror" placeholder="Enter course type" >
									@error('course_type')
										<div class="invalid-feedback">
											{{$message}}
									  	</div>
									@enderror
								</div>
								<div class="form-group col-md-6 mb-6">
									<label for="listingTitle">Course Duration</label>
									<input type="text" name="course_duration" value="{{old('course_duration')}}" class="form-control @error('course_duration') is-invalid @enderror" placeholder="Enter Course Duration" >
									@error('course_duration')
										<div class="invalid-feedback">
											{{$message}}
									  	</div>
									@enderror
								</div>
							</div>
							<div class="form-group row mb-0">
								<div class="col-md-6 offset-md-4">
									<button type="submit" class="btn btn-primary">
									{{ __('Register') }}
									</button>
									<a href="/" class="btn btn-secondary"> Go Back</a>
								</div>
							</div>
						</form>
					</div>
				</div>
				<!-- Gallery -->
			</div>
		</section>
	</div>
@endsection

