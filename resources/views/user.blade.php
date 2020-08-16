@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        @foreach ($users as $user)
            <div class="card" style="width: 18rem;">
                <img src="{{$user->thumb_image}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$user->first_name}} {{$user->last_name}}</h5>
                    <p class="card-text">{{$user->email}}</p>
                    <div class="col-md-6">
                        <form action="{{route('follow')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{$user->id}}" name="user_id">
                            <button type="submit">Follow</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form action="{{route('unfollow')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{$user->id}}" name="user_id">
                            <button type="submit">unFollow</button>
                        </form>
                    </div>
                </div>
            </div>

        @endforeach
    </div>
</div>
@endsection
