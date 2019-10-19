@extends('admin.app')

@section('title', 'Events')

@section('pagecss')
    <link rel="stylesheet" type="text/css" href="{{asset('css/lib/jquery.datetimepicker.css')}}"/>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @foreach($initEvents as $event)
                <div class="card" id="#{{$event->id}}">
					<div class="card-header">
						<div class="card-title">
							{{$event->name}}
						</div>
					</div>
					<div class="card-body">
						<div class="card-text mb-2">
							{{date('m/d/Y H:i', strtotime($event->eventStart)) . ' - ' . date('m/d/Y H:i', strtotime($event->eventEnd))}}
						</div>
					</div>
				</div>
                @endforeach
            </div>
            <div class="col">
                <form action="/addevent" method="POST" enctype="multipart/form-data" id="eventForm">
                    @csrf
                    <input type="hidden" id="eventID" name="eventID">
                    <div class="form-row">
                        <div class="col">
                            <label for="eventNameInput">Event Name</label>
                            <input type="text" class="form-control" id="eventNameInput" placeholder="Event Name" name="name">
                        </div>
                        <div class="col">
                            <label for="locationInput">Location</label>
                            <input type="text" class="form-control" id="locationInput" placeholder="Location" name="location">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                            <label for="eventStartPicker">Start Date</label>
                            <input type="text" class="dtpick form-control" id="eventStartPicker" name="eventStart">
                        </div>
                        <div class="col">
                            <label for="eventEndPicker">End Date</label>
                            <input type="text" class="dtpick form-control" id="eventEndPicker" name="eventEnd">
                        </div>
                    </div>
                    <div class="form-row" id="browseFiles">
                        <div class="col">
                            <label for="imagePathsInput">Images</label>
                            <div class="row">
                                <input type="file" class="col-sm-10" id="imagePathsInput" name="photos[]" multiple>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="aboutTextArea">Event Description</label>
                        <textarea class="form-control" id="aboutTextArea" rows="10" name="about"></textarea>
                    </div>
                    <div class="form-row" id="addBtnRow">
                        <button type="submit" name="action" value="add" class="btn btn-primary" id="newEvtBtn">Add New Event</button>
                    </div>
                    <div class="form-row d-none" id="updateRemoveBtnRow">
                        <button type="submit" class="btn btn-success" name="action" value="update" id="updateEvtBtn">Update Event</button>
                        <button type="submit" class="btn btn-danger" name="action" value="remove" id="removeEvtBtn">Remove Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('pagescripts')
    <script src="{{asset('js/lib/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="{{asset('js/adminevents.js')}}"></script>
@endsection