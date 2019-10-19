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
                </div>
            </div>
        @endforeach
    </div>
@endsection