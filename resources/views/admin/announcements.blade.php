@extends('admin/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                @foreach($announcements as $announcement)
                    <div class="card" id="{{$announcement->id}}">
                        <div class="card-header">
                            {{$announcement->title}}
                        </div>
                        <div class="card-body">
                            <div class="card-text">
                                {{$announcement->sample}}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col">
                <form action="/announcementsAction" method="POST" enctype="multipart/form-data" id="announcementForm">
                    @csrf
                    <input type="hidden" id="announcementID" name="id">
                    <div class="form-row">
                        <label for="announcementTitle">Title:</label>
                        <input type="text" class="form-control" id="announcementTitle" placeholder="Announcement Title" name="title">
                    </div>
                    <div class="form-row">
                        <label for="announcementText">Announcement:</label>
                        <textarea class="form-control" id="announcementText" rows="10" name="content" style="white-space: pre-line; white-space: pre-wrap;"></textarea>
                    </div>
                    <div class="form-row" id="addBtnRow">
                        <button type="submit" name="action" value="add" class="btn btn-primary" id="newAnnouncementBtn">Add New Event</button>
                    </div>
                    <div class="form-row d-none" id="updateRemoveBtnRow">
                        <button type="submit" class="btn btn-success" name="action" value="update" id="updateAnnouncementBtn">Update Event</button>
                        <button type="submit" class="btn btn-danger" name="action" value="remove" id="removeAnnouncementBtn">Remove Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('pagescripts')
<script src="{{asset('js/adminannouncements.js')}}"></script>
@endsection