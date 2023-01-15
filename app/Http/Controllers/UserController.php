<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

  // function response(success, status_code, detail_message, data) {
  //     return {
  //       "success": true,
  //       "status_code" : 200,
  //       "detail_message" : "Get data berhasil",
  //       data};
  // }

  public function signin()
  {
    $data = User::all();
    return $data;
  }  

  public function signup(Request $request)
  {
    // $data = [
    //   "nama"=>$request->nama,
    //   "umur"=>$request->umur
    // ];

    return response(request(), 200);
    // return request();
  }

  public function get($id = null)
  {
    if($id){
      return response($id, 200);
    }

    return response('get', 200);
  }

  public function delete()
  {
    return true;
  }

  public function update()
  {
    return true;
  }

}
