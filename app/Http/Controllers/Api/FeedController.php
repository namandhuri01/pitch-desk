<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\User;
use App\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FeedController extends Controller
{
    public $successStatus = 200;

    public function index() {
        $userId = Auth::user()->id;

        $tweets = Post::with([
            'user' => function($query) {
                return $query->with([
                    'profile'
                ]);
            },
            'postComments.user.profile',
            'postImages',
            'postLikes.user.profile',
        ])->where('user_id', '=', $userId)->get();

        return response()->json([
            'status'=> true,
            'message' => 'all records',
            'data'=>$tweets
        ], $this-> successStatus);
    }

    public function follow(Request $request)
    {
        // dd($request->user_id);
        try{
            $authUser = User::find(Auth::user()->id);
            $followerUser = User::find($request->user_id);
            $userfollow = $authUser->follow($followerUser);
            return response()->json(['success'=>$userfollow, 'message' => 'User follow successfull'], $this-> successStatus);
        }
        catch(\Exception $e)
        {
            throw new HttpException(401, $e->getMessage());
        }
        return response()->json(['error'=>'Unauthorised'], 401);
    }

    public function unfollow(Request $request)
    {
        try{
            $authUser = User::find(Auth::user()->id);
            $followerUser = User::find($request->user_id);
            $userfollow = $authUser->unfollow($followerUser);
            return response()->json(['success'=>$userfollow, 'message' => 'User unfollow successfull'],$this-> successStatus);
        }
        catch(\Exception $e)
        {
            throw new HttpException(401, $e->getMessage());
        }
        return response()->json(['error'=>'Unauthorised'], 401);
    }
}
