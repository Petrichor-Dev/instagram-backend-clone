<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


//============================================SIGNUP============================================
  public function signup()
  {
    $rules = ['username' => 'required|alpha|min:2|max:32',
              'first_name' => 'required|alpha|min:2|max:16',
              'last_name' => 'required|alpha|min:2|max:16',
              'phone_number' => 'required|numeric|min_digits:10|max_digits:12',
              'image_path' => '',
              'date_of_birth' => 'required|date_format:Y-m-d',
              'password' => 'required|min:5'];

    //validasi data
    $validator = Validator::make(request()->all(), $rules);

    //cek jika ada validasi yang gagal
    if ($validator->fails())
    {
      return ApiResponse::response(false, 400, $validator->errors());
    }


    //cek apakah username sudah pernah di guanakan atau belum
    $user = User::where('username', $request->username)->first();
    if($user){
      return ApiResponse::response(false, 400, 'username sudah terdaftar, silahkan gunakan nama lain');
    }

    //hashing data
    $request['password'] = Hash::make($request['password']);

    //insert data
    try {
      $user = User::create(request()->all());
      return ApiResponse::response(true, 200, 'signin berhasil. silahkan login');

    } catch (\Exception $e) {
      return ApiResponse::response(false, 400, 'ups there is something');
    }

  }


//============================================SIGNIN============================================
  public function signin()
  {
    $rules = ['username' => 'required|alpha_dash|min:2|max:32',
              'password' => 'required|min:5'];

    //validasi data
    $validator = Validator::make(request()->all(), $rules);

    //cek jika ada validasi yang gagal
    if ($validator->fails())
    {
      return ApiResponse::response(false, 400, 'ups there is something wrong', $validator->errors());
    }

    //cek username sudah terdaftar
    $user = User::where('username', $request->username)->first();
    if($user)
    {
      //cek apakah password yang di inputkan benar
      if (Hash::check($request->password, $user->password)) {
        $token = $user->createToken('API Token')->accessToken;
        return ApiResponse::response(true, 200, 'login berhasil', ['token' => $token]);
      }

      return ApiResponse::response(false, 400, 'password salah');
    }
    return ApiResponse::response(false, 400, 'login gagal');
  }


//============================================INDEX============================================
  public function index()
  {
    try {
      $usersData = User::get(['id', 'username','password', 'first_name', 'last_name', 'phone_number', 'image_path', 'date_of_birth', 'password']);
      if(!$usersData->isEmpty()){
        return ApiResponse::response(true, 200, 'get all data berhasil', $usersData);
      } else {
        return ApiResponse::response(true, 200, 'get all data berhasil - [data masih kosong]', $usersData);
      }
    } catch (\Exception $e) {
      return ApiResponse::response(false, 400, 'get data by id gagal');
    }
  }



//============================================SHOW============================================
  public function show($id)
  {
    try {
      $usersData = User::where('id', $id)->get(['id', 'username','password', 'first_name', 'last_name', 'phone_number', 'image_path', 'date_of_birth', 'password']);
      return ApiResponse::response(true, 200, 'get all data berhasil', $usersData);
    } catch (\Exception $e) {
      return ApiResponse::response(false, 400, 'get data by id gagal');
    }
  }


//============================================UPDATE============================================
  public function update($id)
  {
    $rules = ['username' => 'alpha|min:2|max:32',
              'first_name' => 'alpha|min:2|max:16',
              'last_name' => 'alpha|min:2|max:16',
              'phone_number' => 'numeric|min_digits:10|max_digits:12',
              'image_path' => '',
              'date_of_birth' => 'date_format:Y-m-d',
              'password' => 'min:5'];

    //validasi data
    $validator = Validator::make(request()->all(), $rules);

    //cek jika ada validasi yang gagal
    if ($validator->fails())
    {
      return ApiResponse::response(false, 400, $validator->errors());
    }

    try {
      User::where('id', $id)->update(request()->all());
      return ApiResponse::response(true, 200, 'update berhasil');

    } catch (\Exception $e) {
      return ApiResponse::response(false, 400, 'ups there is something wrong', $e);
    }
  }


//============================================DESTROY============================================
  public function destroy($id)
  {
    try {
      User::where('id', $id)->delete();
      return ApiResponse::response(true, 200, 'delete berhasil');

    } catch (\Exception $e) {
      return ApiResponse::response(false, 400, 'ups there is something wrong', $e);
    }
  }
}
