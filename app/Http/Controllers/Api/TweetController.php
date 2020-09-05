<?php

namespace App\Http\Controllers\Api;

use Auth;
use App\User;
use App\Tweet;
use App\TweetImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TweetController extends Controller
{
    public $successStatus = 200;

    // public function index(){

    //     try {

    //         $tweets = Tweet::with('tweetImage')->where('user_id', auth()->user()->id)->paginate(15);
    //         return response()->json(['success'=>true, 'message' => 'Tweet Get Successfull', 'data' => $tweets], $this-> successStatus);
    //     }catch(\Exception $e)
    //     {
    //         throw new HttpException(401, $e->getMessage());
    //     }
    //     return response()->json(['success'=>False, 'message' => 'No Tweet Found', 'data' => []], 401);
    // }



    public function store(Request $request){

        $user_id = Auth::user()->id;
        // dd($user_id);
        $tweet = Tweet::create([
            'user_id' => $user_id,
            'body'    => $request->body
        ]);

        if($request->file('image')){
            $this->saveImage($request, $tweet);
        }
        return response()->json(['success'=>true, 'message' => 'Tweet Submit successfull', 'data' => $tweet],$this-> successStatus);

    }

    protected function saveImage($request, $tweet){
        $message = [
            'image.required' => 'The image field is required',
        ];

        $request->validate([
            'image' => 'bail|required',
            'image.*' => 'bail|required'
        ], $message);
        $user_id = Auth::user()->id;
        $imageData = $request->image;
        $tweet_id = $tweet->id;
        if(isset($imageData) && !empty($imageData)){

            foreach ($imageData as $index => $image) {
                $fileNameWithExt = $image->getClientOriginalName();
                $imageName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $imageExt = $image->getClientOriginalExtension();
                $originalName = $imageName.'_'.time().'.'.$imageExt;
                $desinationFolder = 'tweetImage/'.$user_id.'/'.$tweet_id;
                $image->move($desinationFolder, $originalName);
                $photo = TweetImage::create([
                    'tweet_id' => $tweet_id,
                    'name'     => $originalName,
                    'path'     => $desinationFolder,
                ]);
            }
        }
    }
}
