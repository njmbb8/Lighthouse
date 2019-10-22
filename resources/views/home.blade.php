@extends('layouts.app')

@section('title', 'Home')

@section('content')
	<div class="jumbotron" id="banner">
		<div class="container text-center my-auto">
				<h1>Individualized learning options</h1>
				<h2>because all students are individuals.</h2>
		</div>
	</div>
	<div class="container">
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
	</div>
@endsection

@section('pagescripts')
	<script src="{{asset('js/home.js')}}"></script>
@endsection