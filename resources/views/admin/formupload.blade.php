@extends('admin.app')

@section('title', 'Forms')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            @foreach($forms as $form)
            <div class="card" id="{{$form->id}}">
                <div class="card-header">
                    <div class="card-title">
                        {{$form->title}}
                    </div>
                </div>
                <div class="card-body">
                    <img class="card-img-top" src="{{$form->thumbnail}}" alt="Card image">
                    <div class="card-text mb-2">
                        {{$form->description}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col">
            <form action="/userFormAction" method="POST" enctype="multipart/form-data" id="formForm">
                @csrf
                <input type="hidden" id="formID" name="id">
                <div class="form-row">
                    <label for="formTitleInput">Document Title</label>
                    <input type="text" class="form-control" id="formTitleInput" name="title" placeholder="Document Title">
                </div>
                <div class="form-row">
                    <label for="formDescriptionInput">Document Description</label>
                    <input type="text" class="form-control" id="formDescriptionInput" name="description" placeholder="Document Description">
                </div>
                <div class="form-row">
                    <label for="formUpload">Document to upload</label>
                    <input type="file" class="form-control" id="formUpload" name="formUpload">
                </div>
                <div class="form-row" id="addBtnRow">
                    <button type="submit" name="action" value="add" class="btn btn-primary" id="newFormBtn">Add New Form</button>
                </div>
                <div class="form-row d-none" id="updateRemoveBtnRow">
                    <button type="submit" class="btn btn-success" name="action" value="update" id="updateFormBtn">Update Form</button>
                    <button type="submit" class="btn btn-danger" name="action" value="remove" id="removeFormBtn">Remove Form</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('pagescripts')
    <script src="{{asset('js/adminforms.js')}}"></script>
@endsection