<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{

//============================================INDEX============================================
    public function index()
    {
      try {
        $likesData = Like::get(['id', 'user_id','post_id', 'created_at']);
        if(!$likesData->isEmpty()){
          return ApiResponse::response(true, 200, 'get all data berhasil', $likesData);
        } else {
          return ApiResponse::response(true, 200, 'get all data berhasil - [data masih kosong]', $likesData);
        }
      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'get data gagal');
      }
    }


//============================================STORE============================================
    public function store()
    {
      $rules = ['post_id' => 'required|numeric',
                'user_id' => 'required|numeric'];

      //validasi data
      $validator = Validator::make(request()->all(), $rules);

      //cek jika ada validasi yang gagal
      if ($validator->fails())
      {
        return ApiResponse::response(false, 400, $validator->errors());
      }

      try {
        Like::create(request()->all());
        return ApiResponse::response(true, 200, 'berhasil menambahkan like');

      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'ups there is something wrong', $e);
      }
    }


//============================================SHOW============================================
    public function show($id)
    {
      try {
        $likesData = Like::where('id', $id)->get(['id', 'user_id','post_id', 'created_at']);
        if(!$likesData->isEmpty()){
          return ApiResponse::response(true, 200, 'get data by id berhasil', $likesData);
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
      $rules = ['post_id' => 'required|numeric',
                'user_id' => 'required|numeric'];

      //validasi data
      $validator = Validator::make(request()->all(), $rules);

      //cek jika ada validasi yang gagal
      if ($validator->fails())
      {
        return ApiResponse::response(false, 400, $validator->errors());
      }

      try {
        Like::where('id', $id)->update(request()->all());
        return ApiResponse::response(true, 200, 'update berhasil');

      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'ups there is something wrong', $e);
      }
    }


//============================================DESTROY============================================
    public function destroy($id)
    {
      try {
        Like::where('id', $id)->delete();
        return ApiResponse::response(true, 200, 'delete berhasil');
      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'ups there is something wrong', $e);
      }
    }
}
