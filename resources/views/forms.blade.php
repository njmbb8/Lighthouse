@extends('layouts.app')

@section('title', 'forms')

@section('content')
    <div class="container">
        @for ($i = 0; $i < sizeof($forms)/2; $i++)
            <div class="row">
                @for ($j = 0; $j < 2; $j++)
                    <div class="col-lg-4">
                        <div class="card" id="{{$forms[$i+$j]->id}}">
                            <div class = "card-header">
                                <div class="card-title">
                                    {{$forms[$i+$j]->title}}
                                </div>
                            </div>
                            <div class="card-body">
                                <img class="card-img-top" src="{{$forms[$i+$j]->thumbnail}}" alt="Card image">
                                <div class="card-text mb-2">
                                    {{$forms[$i+$j]->description}}
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($i == 0)
                        <div class="col-lg-4"></div>
                    @endif
                @endfor
            </div>
        @endfor
    </div>
@endsection