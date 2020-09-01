@extends('layouts.app')

@section('title', 'Home')

@section('content')
	<div id="carouselExampleIndicators" class="carousel slide bg-secondary" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
		</ol>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img class="d-block mx-auto" src="/images/0.jpeg" alt="First slide">
				<div class="carousel-caption d-none d-md-block">
					<h1>Individualized learning options</h1>
					<h2>because all students are individuals.</h2>
  				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block mx-auto" src="/images/0-1.jpeg" alt="Second slide">
				<div class="carousel-caption d-none d-md-block">
					<h1>Individualized learning options</h1>
					<h2>because all students are individuals.</h2>
  				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block mx-auto" src="/images/0-2.jpeg" alt="Third slide">
				<div class="carousel-caption d-none d-md-block">
					<h1>Individualized learning options</h1>
					<h2>because all students are individuals.</h2>
  				</div>
			</div>
			<div class="carousel-item">
				<img class="d-block mx-auto" src="/images/0-3.jpeg" alt="Third slide">
				<div class="carousel-caption d-none d-md-block">
					<h1>Individualized learning options</h1>
					<h2>because all students are individuals.</h2>
  				</div>
			</div>
		</div>
		<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-4" id="events">
				<div class="card">
					<div class="card-title">
						Upcoming Events:
					</div>
				</div>
				@foreach($events as $event)
					<div class="card">
						<div class="card-header">
							<div class="card-title">
								{{$event->name}}
							</div>
						</div>
						<div class="card-body">
							<div class="container">
								<div class="card-text mb-2">
									{{$event->eventStart . ' - ' . $event->eventEnd}}
								</div>
								<a href="/event/{{$event->id}}" class="stretched-link"></a>
							</div>
						</div>
					</div>
				@endforeach
				<a href="/events">View all events</a>
			</div>
			<div class="col" id="announcements">
				<div class="card">
					<div class="card-title">
						Announcements:
					</div>
				</div>
				@foreach($announcements as $announcement)
					<div class="card">
						<div class="card-header">
							<div class="card-title">
								{{$announcement->title}}
							</div>
						</div>
						<div class="card-body">
							<div class="container">
								<div class="card-text mb-2">
									{{$announcement->sample}}
								</div>
								<a href="/announcement/{{$announcement->id}}" class="stretched-link"></a>
							</div>
						</div>
					</div>
				@endforeach
				<a href="/announcements">View all announcements</a>
			</div>
		</div>
	</div>
@endsection

@section('pagescripts')
	<script src="{{asset('js/home.js')}}"></script>
@endsection