@extends('layouts.app')

@section('title', 'Announcements')

@section('content')
    <div class="container">
        @foreach($announcements as $announcement)
            <div class="card">
                <div class="card-header">
                    {{$announcement->title}}
                </div>
                <div class="card-body">
                    {{$announcement->sample}}
                </div>
                <div class="card-footer">
                    Created on: {{$announcement->created_at}}
                </div>
                <a href = "/announcement/{{$announcement->id}}" class="stretched-link"></a>
            </div>
        @endforeach
        <div class="row">
            @if(!$pageNum < 1 )
                <div class="col justify-content-start">
                    <a href="/announcements/{{$pageNum-1}}">Previous Page</a>
                </div>
            @endif
            <div class="col justify-content-start text-right">
                <a href="/announcements/{{$pageNum+1}}">Next Page</a>
            </div>
        </div>
    </div>
@endsection