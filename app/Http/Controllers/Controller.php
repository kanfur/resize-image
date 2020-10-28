<?php

namespace App\Http\Controllers;

use App\Models\Http\Status;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function returnJsonException(\Throwable $e){
        $result =  [
            "status" => $e->getCode()>0 ? $e->getCode():500,
            "error" => $e->getMessage()
        ];
        return response()->json($result);
    }
    public function returnSuccess($message = null){
        $result =  [
            "status" => Status::CODE["Success"],
            "message" => $message
        ];
        return response()->json($result,Status::CODE["Success"]);
    }
}
