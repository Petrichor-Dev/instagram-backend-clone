<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{


//============================================INDEX============================================
    public function index()
    {
      try {
        $commentData = Comment::get(['id', 'user_id','post_id', 'comment_text']);
        return ApiResponse::response(true, 200, 'get all data berhasil', $commentData);
      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'get data gagal');
      }
    }


//============================================STORE============================================
    public function store()
    {
      $rules = ['post_id' => 'required|numeric',
                'user_id' => 'required|numeric',
                'comment_text' => 'required|max:255'];

      //validasi data
      $validator = Validator::make(request()->all(), $rules);

      //cek jika ada validasi yang gagal
      if ($validator->fails())
      {
        return ApiResponse::response(false, 400, $validator->errors());
      }

      try {
        Comment::create(request()->all());
        return ApiResponse::response(true, 200, 'comment berhasil di tambahkan');

      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'ups there is something wrong', $e);
      }
    }


//============================================SHOW============================================
    public function show($id)
    {

      //bisa get by id comment, get by id post, atau get by id user
      try {
        $commentData = Comment::where('id', $id)->get(['id', 'user_id','post_id', 'comment_text']);
        if(!$commentData->isEmpty()){
          return ApiResponse::response(true, 200, 'get data by id berhasil', $commentData);
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
                'user_id' => 'required|numeric',
                'comment_text' => 'required|max:255'];

      //validasi data
      $validator = Validator::make(request()->all(), $rules);

      //cek jika ada validasi yang gagal
      if ($validator->fails())
      {
        return ApiResponse::response(false, 400, $validator->errors());
      }

      try {
        Comment::where('id', $id)->update(request()->all());
        return ApiResponse::response(true, 200, 'comment berhasil di update');

      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'ups there is something wrong', $e);
      }
    }


//============================================DESTROY============================================
    public function destroy($id)
    {
      try {
        Comment::where('id', $id)->delete();
        return ApiResponse::response(true, 200, 'delete berhasil');

      } catch (\Exception $e) {
        return ApiResponse::response(false, 400, 'ups there is something wrong', $e);
      }
    }
}
