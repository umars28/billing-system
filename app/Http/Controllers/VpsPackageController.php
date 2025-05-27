<?php

namespace App\Http\Controllers;

use App\Models\VpsPackage;
use Illuminate\Http\JsonResponse;

class VpsPackageController extends Controller
{
    public function index(): JsonResponse
    {
        $packages = VpsPackage::all();
        return response()->json($packages);
    }
}
