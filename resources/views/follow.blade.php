@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @foreach ($followers as $follower)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$follower->first_name}} {{$follower->last_name}}</h5>
                    <p class="card-text">{{$follower->email}}</p>
                </div>
            </div>

        @endforeach
    </div>
</div>
@endsection
