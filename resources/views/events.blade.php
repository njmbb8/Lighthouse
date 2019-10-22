@extends('layouts.app')

@section('title', 'events')

@section('content')
    <div class="container">
        @foreach($events as $event)
            <div class="card">
                <div class="card-header">
                    {{$event->name}}
                </div>
                <div class="card-body">
                    {{$event->about}}
                    <a href="/event/{{$event->id}}" class="stretched-link"></a>
                </div>
            </div>
        @endforeach
        <div class="row">
            @if(!$pageNum < 1 )
                <div class="col justify-content-start">
                    <a href="/events/{{$pageNum-1}}">Previous Page</a>
                </div>
            @endif
            <div class="col justify-content-start text-right">
                <a href="/events/{{$pageNum+1}}">Next Page</a>
            </div>
        </div>
    </div>
@endsection