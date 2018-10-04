@extends('layouts.app')

@section('title')
All Pin of {{ Auth::user() }}

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Pins</div>

                

                <div class="card-body">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection