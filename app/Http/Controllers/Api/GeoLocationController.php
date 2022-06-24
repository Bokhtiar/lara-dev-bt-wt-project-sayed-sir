<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeoLocationController extends Controller
{
    use ApiResponseTrait;

    public function division()
    {
        try {
            $resuls = DB::table('divisions')->where('status',1)->get();
            return $this->SuccessResponse($resuls);
        } catch (\Throwable $th) {
            return $this->ErrorResponse($th->getMessage());
        }
    }

    public function district()
    {
        try {
            $resuls = DB::table('districts')->where('status',1)->get();
            return $this->SuccessResponse($resuls);
        } catch (\Throwable $th) {
            return $this->ErrorResponse($th->getMessage());
        }
    }

    public function thana()
    {
        try {
            $resuls = DB::table('thanas')->where('status',1)->get();
            return $this->SuccessResponse($resuls);
        } catch (\Throwable $th) {
            return $this->ErrorResponse($th->getMessage());
        }
    }

    public function union()
    {
        try {
            $resuls = DB::table('unions')->where('status',1)->get();
            return $this->SuccessResponse($resuls);
        } catch (\Throwable $th) {
            return $this->ErrorResponse($th->getMessage());
        }
    }


}
