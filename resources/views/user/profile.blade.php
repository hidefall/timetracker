@extends('adminlte::page')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <form action="/user/profile" method="post">
                    @csrf
                    <div class="form-group">
                        <change-avatarka :profile="{{ auth()->user()->profile }}"></change-avatarka>
                    </div>
                <div class="form-group">
                    <label for="firstname" class="control-label">First Name</label>
                    <input name="firstname" type="text" class="form-control" id="firstname" value="{{ auth()->user()->profile->firstname }}">
                    @if($errors->has('lastname'))
                        <span class="text-danger">{{ $errors->get('firstname') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="lastname" class="control-label">Last Name</label>
                    <input name="lastname" type="text" class="form-control" id="lastname" value="{{ auth()->user()->profile->lastname }}">
                    @if($errors->has('lastname'))
                        <span class="text-danger">{{ $errors->get('lastname') }}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="phone" class="control-label">Phone</label>
                    <input name="phone" type="text" class="form-control" id="phone" value="{{ auth()->user()->profile->phone }}">
                    @if($errors->has('phone'))
                        <span class="text-danger">{{ $errors->get('phone') }}</span>
                    @endif
                    </div>
                    <div class="form-group">
                         <button type="submit" class="btn btn-success btn-lg">Update Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection