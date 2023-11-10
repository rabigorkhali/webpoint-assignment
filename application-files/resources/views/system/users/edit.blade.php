@extends('system.layouts.master')

@section('content')
    <form action="{{ URL::to($indexUrl.'/'.$users->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="firstname">First Name:*</label>
                <input type="text" value="{{$users->firstname}}" class="form-control @if ($errors->first('firstname'))is-invalid @endif" id="firstname" name="firstname" >
                <div class="invalid-feedback">{{ $errors->first('firstname') }}</div>

            </div>
            <div class="form-group col-md-6">
                <label for="lastname">Last Name:*</label>
                <input type="text" value="{{$users->lastname}}" class="form-control @if ($errors->first('lastname')) is-invalid @endif" id="lastname" name="lastname" >
                <div class="invalid-feedback">{{ $errors->first('lastname') }}</div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="username">Username:*</label>
                <input type="text" value="{{$users->username}}" class="form-control @if ($errors->first('username')) is-invalid @endif" id="username" name="username" >
                <div class="invalid-feedback">{{ $errors->first('username') }}</div>
            </div>
            <div class="form-group col-md-6">
                <label for="email">Email:*</label>
                <input type="email" value="{{$users->email}}" class="form-control @if ($errors->first('email')) is-invalid @endif" id="email" name="email" >
                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            </div>
        </div>
        <hr>
        <h5>Details</h5>
        <hr>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="bio">Bio:</label>
                <textarea class="form-control @if ($errors->first('bio')) is-invalid @endif" id="bio" name="bio">{{$users?->detail?->bio}}</textarea>
                <div class="invalid-feedback">{{ $errors->first('bio') }}</div>
            </div>
            <div class="form-group col-md-6">
                <label>Status:</label>
                <div class="form-check">
                    <input type="radio" id="active" name="status" value="1" @if(old('status', optional($users->detail)->status) == '1') checked @endif class="form-check-input">
                    <label class="form-check-label" for="active">Active</label>
                </div>
                <div class="form-check">
                    <input type="radio" id="inactive" name="status" value="0" @if(old('status', optional($users->detail)->status) == '0') checked @endif class="form-check-input">
                    <label class="form-check-label" for="inactive">Inactive</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    @endsection
