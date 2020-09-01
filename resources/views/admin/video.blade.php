@extends('admin.app')

@section('title', 'Videos')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @foreach($videos as $video)
                    <div class="card" id="{{$video->id}}">
                        <div class="card-header">
                            <div class="card-title">
                                {{$video->title}}
                            </div>
                        </div>
                        <div class="card-body">
                            <img class="card-img-top" src="{{$video->thumbnail}}" alt="Video Thumbnail">
                            <div class="card-text mb-2">
                                {{$video->about}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col">
                <video width=320 height=240 controls class="d-none" id="videoPlayer">

                </video>
                <form action="/videoformaction" method="POST" enctype="multipart/form-data" id="videoForm">
                    @csrf
                    <input type="hidden" id="videoID" name="id">
                    <div class="form-row">
                        <label for="videoTitleInput">Video Title</label>
                        <input type="text" class="form-control" id="videoTitleInput" name="title" placeholder="Video Title">
                    </div>
                    <div class="form-row">
                        <label for="videoDescriptionInput">Document Description</label>
                        <input type="text" class="form-control" id="videoDescriptionInput" name="about" placeholder="Video Description">
                    </div>
                    <div class="form-row">
                        <label for="videoUpload">Document to upload</label>
                        <input type="file" class="form-control" id="videoUpload" name="videoUpload">
                    </div>
                    <div class="form-row" id="addBtnRow">
                        <button type="submit" name="action" value="add" class="btn btn-primary" id="newVideoBtn">Add New Video</button>
                    </div>
                    <div class="form-row d-none" id="updateRemoveBtnRow">
                        <button type="submit" class="btn btn-success" name="action" value="update" id="updateVideoBtn">Update Video</button>
                        <button type="submit" class="btn btn-danger" name="action" value="remove" id="removeVideoBtn">Remove Video</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('pagescripts')
    <script src="{{asset('js/adminvideos.js')}}"></script>
@endsection