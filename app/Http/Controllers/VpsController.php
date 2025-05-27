<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateVpsRequest;
use App\Models\VpsPackage;
use App\Services\VpsService;
use Illuminate\Http\JsonResponse;

class VpsController extends Controller
{
    public function __construct(private VpsService $vpsService) {}

    public function create(CreateVpsRequest $request): JsonResponse
    {
        $user = auth()->user();
        $data = $request->validated();
        $package = VpsPackage::findOrFail($data['package_id']);
    
        if ($user->balance < $package->price_per_hour) {
            return response()->json([
                'message' => 'Saldo tidak cukup untuk membuat VPS'
            ], 400);
        }
    
        $vps = $this->vpsService->createVps(auth()->user(), $request->validated());
        return response()->json(['message' => 'VPS berhasil dibuat', 'data' => $vps]);
    }

    public function index(): JsonResponse
    {
        $vpsList = auth()->user()->vpsInstances()->with('usages', 'package')->get();
        return response()->json($vpsList);
    }
}
