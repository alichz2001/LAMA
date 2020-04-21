<?php


namespace App\Http\Controllers\Admin\Handler;


class Response
{
    public static function Handle($status, $data, $type, $messageCode) {
        return response(['status' => $status, 'data' => $data, 'type' => $type, 'messageCode' => $messageCode], 200/*$status == false ? 404 : 200*/);
    }
}
