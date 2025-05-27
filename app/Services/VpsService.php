<?php 

namespace App\Services;

use App\Models\Transaction;
use App\Models\User;
use App\Models\VpsInstance;
use App\Models\VpsPackage;
use Illuminate\Support\Facades\DB;
use Log;

class VpsService
{
    public function createVps(User $user, array $data): VpsInstance
    {
        $package = VpsPackage::findOrFail($data['package_id']); 

        return DB::transaction(function () use ($user, $data, $package) {
            $vps = VpsInstance::create([
                'user_id' => $user->id,
                'package_id' => $package->id,
                'name' => $data['name'],
                'cpu' => $package->cpu,
                'ram' => $package->ram,
                'storage' => $package->storage,
                'started_at' => now(),
            ]);

            $vps->usages()->create([
                'billed_at' => now(),
                'cost' => $package->price_per_hour,
            ]);

            Transaction::create([
                'user_id' => $user->id,
                'amount' => -$package->price_per_hour,
                'description' => 'Biaya VPS awal ' . $vps->name,
            ]);

            return $vps;
        });
    }
}
