@extends('layouts.clean')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#login" aria-controls="login" role="tab" data-toggle="tab">Login</a></li>
                    <li role="presentation"><a href="#register" aria-controls="register" role="tab" data-toggle="tab">Register</a></li>
                </ul>

                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="login">
                        <login></login>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="register">
                        <register-handler></register-handler>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('adminlte_js')
    <script src="https://js.stripe.com/v3/"></script>
@endsection



















