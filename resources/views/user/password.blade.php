@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="/user/password" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" />
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Password Confirmation</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection