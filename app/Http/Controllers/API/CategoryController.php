<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function create(Request $request)
    {
        if (auth()->user()->cannot('unit.create')) {
            return response()->json([
                "message" => 'Unathorized, you don\'t have access'
            ], 403);
        }
        return 'Category created';
    }
}
