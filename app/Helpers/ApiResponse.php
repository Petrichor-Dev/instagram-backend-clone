<?php

namespace App\Helpers;

class ApiResponse
{
  public static function response($success, $status_code, $detail_message, $data = null)
  {
    return response([
      "success" => $success,
      "status_code" => $status_code,
      "detail_message" => $detail_message,
      "data" => $data
    ], $status_code);
  }
}
