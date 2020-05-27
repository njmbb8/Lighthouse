@extends('admin.app')

@section('title', 'Users')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h4>Non Authorized Users</h4>
                <ul class="list-group">
                    @foreach($nonAuthUsers as $nonAuthUser)
                        <li id="{{$nonAuthUser->id}}" class="list-group-item">{{$nonAuthUser->lname}}, {{$nonAuthUser->fname}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-4">
                <form action="/userFormAction" method="POST" enctype="multipart/form-data" id="userForm">
                    @csrf
                    <input type="hidden" id="userID" name="id">
                    <div class="form-row">
                        <label for="formfNameInput">First Name: </label>
                        <input type="text" class="form-control" id="formfNameInput" name="fname" placeholder="First Name">
                    </div>
                    <div class="form-row">
                        <label for="formlNameInput">Last Name: </label>
                        <input type="text" class="form-control" id="formlNameInput" name="lname" placeholder="Last Name">
                    </div>
                    <div class="form-row">
                        <label for="emailInput">Email: </label>
                        <input type="text" class="form-control" id="emailInput" name="email" placeholder="Email">
                    </div>
                    <div class="form-row">
                        <label for="passwdInput">Change Password: </label>
                        <input type="password" class="form-control" id="passwdInput" name="password" placeholder="Reset Password">
                    </div>
                    <div class="form-row">
                        <label for="roleSelect">Role: </label>
                        <select class="custom-select" id="roleSelect" name="role">
                            <option selected value="0">Roles</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-row" id="addBtnRow">
                        <button type="submit" name="action" value="add" class="btn btn-primary" id="newUserBtn">Add New User</button>
                    </div>
                    <div class="form-row d-none" id="updateRemoveBtnRow">
                        <button type="submit" class="btn btn-success" name="action" value="update" id="updateUserBtn">Update User</button>
                        <button type="submit" class="btn btn-danger" name="action" value="remove" id="removeUserBtn">Remove User</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
            <h4>Authorized Users</h4>
                <ul class="list-group">
                    @foreach($authUsers as $authUser)
                        <li id="{{$authUser->id}}" class="list-group-item">{{$authUser->lname}}, {{$authUser->fname}}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('pagescripts')
    <script src="{{asset('js/adminusers.js')}}"></script>
@endsection