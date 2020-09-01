@extends('layouts.app')

@section('title', 'Videos')

@section('content')
    <div class="container">
        @for($i = 0; $i < count($videos)/2; $i++)
            <div class="row">
                @for($j = 0; $j < 2; $j++)
                    <div class="col-lg-4">
                        <div class="card" id="{{$videos[$i+$j]->id}}">
                            <div class="card-header" id={{$videos[$i+$j]->id}}>
                                {{$videos[$i+$j]->title}}
                            </div>
                            <div class="card-body">
                                <img class="card-img-top" src="{{$videos[$i+$j]->thumbnail}}">
                            </div>
                            <div class="card-footer">
                                {{$videos[$i+$j]->about}}
                            </div>
                        </div>
                    </div>
                    @if($i == 0)
                        <div class="col-lg-4"></div>
                    @endif
                    @if(sizeof($videos) == 1)
                        @break
                    @endif
                @endfor
            </div>
        @endfor
    </div>

    <div class="modal fade" id="VideoModal">
	    <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modaltitle"></h4>                                                             
                    <button type="button" class="close" data-dismiss="modal">&times;</button> 
                </div> 
                <div class="modal-body">
                    <video controls id="videoPlayer">

                    </video>
                </div>   
                <div class="modal-footer" id="about">
                                                  
                </div>
            </div>                                                                       
        </div>                                          
    </div>
@endsection

@section('pagescripts')
    <script src="{{asset('js/videos.js')}}"></script>
@endsection