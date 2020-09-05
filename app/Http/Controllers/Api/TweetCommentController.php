<?php

namespace App\Http\Controllers\Api;

use App\Post;
use App\PostComment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class TweetCommentController extends Controller
{

    public $successStatus = 200;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'user_id' => 'bail|required|integer',
            'post_user_id' => 'bail|required|integer',
            'post_id' => 'bail|required|integer',
            'comment' => 'bail|required|string',
        ]);
        try {

            $comment = PostComment::create([
                'user_id' =>   $request->user_id,
                'post_id' =>  $request->post_id,
                'post_user_id' => $request->post_user_id,
                'comment' => $request->comment
            ]);
            return response()->json(['success'=>true, 'message' => 'Comment Done', 'data' => $comment], $this->successStatus);
        }catch(\Exception $e)
        {
            $comment = [];
            throw new HttpException(401, $e->getMessage());
        }
        return response()->json(['success'=>false, 'message' => 'Error', 'data' => $comment], 401);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
