<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{

    public function index()
    {
      try {
        $LikesData = Like::get(['id', 'user_id','post_id', 'created_at']);
        return ApiResponse::response(true, 200, 'get all data berhasil', $LikesData);
      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'get data gagal');
      }
    }


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


    public function show($id)
    {
      try {
        $LikesData = Like::where('id', $id)->get(['id', 'user_id','post_id', 'created_at']);
        return ApiResponse::response(true, 200, 'get data by id berhasil', $LikesData);
      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'get data by id gagal');
      }
    }


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
