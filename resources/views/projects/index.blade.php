@extends('adminlte::page')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-right">
           <create-element>
               
           </create-element>

        </div>
    </div>
</div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <projects :current_project="{{ $timeframe ? $timeframe : '{}' }}"></projects>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-6"><tasks></tasks></div>
                    <div class="col-md-6"><timeframes></timeframes></div>
                </div>
            </div>
        </div>
    </div>
@endsection