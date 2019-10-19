@extends('admin.app')

@section('content')
	<div class="row">
		<div class="col-sm-6">
			<div class="card">
				<h5 class="card-header">Users</h5>
				@foreach($userStats as $key => $stat)
					<p class="card-text">{{$key}}: {{$stat}}</p>
				@endforeach
			</div>
		</div>
		<div class="col-sm-6">
			<div class="card">
				<h5 class="card-header">Events:</h5>
				@foreach($eventStats as $key => $stat)
					<p class="card-text">{{$key}}: {{$stat}}</p>
				@endforeach
			</div>
		</div>
	</div>
@endsection