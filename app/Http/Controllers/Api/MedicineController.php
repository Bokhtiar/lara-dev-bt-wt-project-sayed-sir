<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        try {
            $results = Medicine::query()->Active()->get();
            return response()->json([
                "status" => true,
                "data" => $results,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "error" => $th->getMessage()
            ]);
        }
    }
}
