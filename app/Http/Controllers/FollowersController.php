<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follower;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Validator;

class FollowersController extends Controller
{

//============================================INDEX============================================
    public function index()
    {
      $userinput = request()->getContent();
      $toArray = explode('&', $userinput);
      foreach ($toArray as $toArr) {
        $arr1[] = explode('=', $toArr);
        $arr2 = [];
        foreach ($arr1 as $a1 ) {
          $arr2[$a1[0]] = $a1[1];
        }
      };
      
      try {
        $followerData = Follower::get(['id', 'follower_id', 'following_id', 'created_at']);
        return ApiResponse::response(true, 200, 'get all data berhasil', $followerData);
      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'get data gagal');
      }
    }


//============================================STORE============================================
    public function store()
    {
      $rules = ['follower_id' => 'required|numeric',
                'following_id' => 'required|numeric'];

      //validasi data
      $validator = Validator::make(request()->all(), $rules);

      //cek jika ada validasi yang gagal
      if ($validator->fails())
      {
        return ApiResponse::response(false, 400, $validator->errors());
      }

      try {
        Follower::create(request()->all());
        return ApiResponse::response(true, 200, 'berhasil menambahkan followers');

      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'ups there is something wrong', $e);
      }
    }


//============================================SHOW============================================
    public function show($id)
    {
      $userinput = request()->getContent();
      $toArray = explode('&', $userinput);
      foreach ($toArray as $toArr) {
        $arr1[] = explode('=', $toArr);
        $arr2 = [];
        foreach ($arr1 as $a1 ) {
          $arr2[$a1[0]] = $a1[1];
        }
      };

      try {
        $followerData = Follower::where('id', $id)->get(['id', 'follower_id', 'following_id', 'created_at']);
        if(!$followerData->isEmpty()){
          return ApiResponse::response(true, 200, 'get data by id berhasil', $followerData);
        } else {
          return ApiResponse::response(false, 404, 'data tidak di temukan');
        }
      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'get data by id gagal');
      }
    }


//============================================UPDATE============================================
    public function update($id)
    {
      $rules = ['follower_id' => 'required|numeric',
                'following_id' => 'required|numeric'];

      //validasi data
      $validator = Validator::make(request()->all(), $rules);

      //cek jika ada validasi yang gagal
      if ($validator->fails())
      {
        return ApiResponse::response(false, 400, $validator->errors());
      }

      try {
        Follower::where('id', $id)->update(request()->all());
        return ApiResponse::response(true, 200, 'update berhasil');

      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'ups there is something wrong', $e);
      }
    }


//============================================DESTROY============================================
    public function destroy($id)
    {
      try {
        Follower::where('id', $id)->delete();
        return ApiResponse::response(true, 200, 'delete berhasil');

      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'ups there is something wrong', $e);
      }
    }
}
