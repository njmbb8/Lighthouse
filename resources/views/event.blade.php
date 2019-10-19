@extends('layouts.app')

@section('title', $event->name)

@section('content')
<div class="carousel slide text-center" data-ride="carousel">
    <div class="carousel-inner">
        @php
            $i = 0;
            $active = 'active';

            if(file_exists('storage/' . $event->id)){
                $directory = 'storage/' . $event->id;
                $scanned_directory = array_diff(scandir($directory), array('..', '.'));

                foreach($scanned_directory as $file){

                    if($i != 0){
                        $active = '';
                    }

                    echo "<div class='carousel-item $active'>
                            <img src='../$directory/$file' alt='...' style='max-height: 600px;'>
                        </div>\n";

                    $i++;
                }
            }
        @endphp
    </div>
</div>
<div class="container">
    <div class="card">
        <div class="card-header">
            {{$event->name}}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title">
                    Location: {{$event->location}}</br>
                    From: {{$event->eventStart}}</br>
                    Until: {{$event->eventEnd}}
                    </h5>
                </div>
                <div class="col text-right">
                    <img src="../images/calendar.png" class="img-thumbnail" style="max-height:200px;">
                </div>
            </div>
            <div class="row">
                <p>{{$event->about}}</p>
            </div>
        </div>
    </div>
</div>
@endsection