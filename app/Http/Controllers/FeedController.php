<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Post;
use App\PostImage;
use Illuminate\Http\Request;

class FeedController extends Controller
{

    public function follow(Request $request)
    {
        try{

            $authUser = User::find(Auth::user()->id);
            $followerUser = User::find($request->user_id);

            $userfollow = $authUser->follow($followerUser);
            return back()->with('success','follow Successfull');
        }
        catch(\Exception $e)
        {
            throw new HttpException(401, $e->getMessage());
        }
        return back()->with('error','Please Try After Some Time');

    }

    public function unFollow(Request $request)
    {
        try{

            $authUser = User::find(Auth::user()->id);
            $followerUser = User::find($request->user_id);
            $userfollow = $authUser->unfollow($followerUser);
            return back()->with('success','unfollow Successfull');
        }
        catch(\Exception $e)
        {
            throw new HttpException(401, $e->getMessage());
        }
        return back()->with('error','Please Try After Some Time');
    }

    public function getFollower(){

        $followers = User::followedBy(Auth::user())->get();

        return view('follow',['followers' => $followers]);
    }

}
