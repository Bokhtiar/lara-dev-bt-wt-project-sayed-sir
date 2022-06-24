<?php

namespace App\Traits;

trait ApiResponseTrait
{
    public function SuccessResponse($data)
    {
        return response()->json([
            "status" => true,
            "data" => $data
        ],200);
    }

    public function ErrorResponse($error)
    {
        return response()->json([
            "status" => false,
            "error" => $error
        ],404);
    }


}
