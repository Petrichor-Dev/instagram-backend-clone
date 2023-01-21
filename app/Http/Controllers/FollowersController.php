<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follower;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Validator;

class FollowersController extends Controller
{

    public function index()
    {
        //
    }


    public function store()
    {
      $rules = ['followers_id' => 'required|numeric',
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


    public function show($id)
    {
        //
    }


    public function update($id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
