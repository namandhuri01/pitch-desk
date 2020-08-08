<?php

namespace App\Http\Controllers\Api;

Use Image;
use App\User;
use Validator;
use App\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use Intervention\Image\Exception\NotReadableException;

class AuthController extends Controller
{
    public $successStatus = 200;
/**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')-> accessToken;
            return response()->json(['success' => $success], $this-> successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }
/**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(ProfileRequest $request)
    {
        // dd($request->all());
        $settingData = $request->profile;

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;

        if($request->file('photo')) {
            $settingData['photo'] = $this->saveImage($request, $user->id);
        }
        if($request->profile) {
            $user->profile()->updateOrCreate(['user_id' => $user->id], $settingData);
        }

        return response()->json(['success'=>$success], $this-> successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    }

    protected function saveImage($request, $id) {
        request()->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($files = $request->file('photo')) {
            $desinationFolder = 'public/avatar/'.$id;
            // for save original image
            $path = $request->file('photo')
                ->storeAs($desinationFolder, $files->getClientOriginalName());

            // for save thumnail image
            $ImageUpload = Image::make($files);
            $thumbnailPath = storage_path().'/app/'.$desinationFolder.'/thumb_';

            // Creating thumbnail for image;
            $ImageUpload->resize(250,250);
            $ImageUpload = $ImageUpload->save($thumbnailPath.$files->getClientOriginalName());

            //updating image in profile table profile table
            return $files->getClientOriginalName();
        }
    }

    // protected function saveProfile($settingData, $id) {

    //     $profile = UserProfile::updateOrCreate(['user_id' => $id], $settingData);

    //     return $profile;
    // }
}
