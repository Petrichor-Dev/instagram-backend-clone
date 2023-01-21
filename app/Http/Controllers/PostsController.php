<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
//============================================INDEX============================================
    public function index()
    {
      try {
        $postData = Post::get(['id', 'user_id','caption', 'post_date']);
        return ApiResponse::response(true, 200, 'get all data berhasil', $postData);
      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'get data gagal');
      }
    }


//============================================STORE============================================
    public function store()
    {
      $rules = ['user_id' => 'required|numeric|max:5',
                'caption' => 'required|max:100',
                'post_date' => 'required'];

      //validasi data
      $validator = Validator::make(request()->all(), $rules);

      //cek jika ada validasi yang gagal
      if ($validator->fails())
      {
        return ApiResponse::response(false, 400, $validator->errors());
      }

      try {
        Post::create(request()->all());
        return ApiResponse::response(true, 200, 'postingan berhasil di tambahkan');

      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'ups there is something wrong', $e);
      }
    }


//============================================SHOW============================================
    public function show($id)
    {
      try {
        $postData = Post::where('id', $id)->get(['id', 'user_id','caption', 'post_date']);
        if(!$postData->isEmpty()){
          return ApiResponse::response(true, 200, 'get data by id berhasil', $postData);
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
      $rules = ['caption' => 'max:100',
                'post_date' => 'date_format:Y-m-d'];

      //validasi data
      $validator = Validator::make(request()->all(), $rules);

      //cek jika ada validasi yang gagal
      if ($validator->fails())
      {
        return ApiResponse::response(false, 400, $validator->errors());
      }

      try {
        Post::where('id', $id)->update(request()->all());
        return ApiResponse::response(true, 200, 'update berhasil');

      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'ups there is something wrong', $e);
      }
    }


  //============================================DESTROY============================================
    public function destroy($id)
    {
      try {
        Post::where('id', $id)->delete();
        return ApiResponse::response(true, 200, 'delete berhasil');

      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'ups there is something wrong', $e);
      }
    }
}
