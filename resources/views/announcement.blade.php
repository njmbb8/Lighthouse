@extends('layouts.app')

@section('title', $announcement->title)

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                {{$announcement->title}}
            </div>
            <div class="card-body" style="white-space: break-spaces;">{{$announcement->content}}</div>
            <div class="card-footer">
                <p>Updated: {{$announcement->updated_at}}</p>
            </div>
        </div>
    </div>
@endsection