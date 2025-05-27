<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Models\VpsInstance;
use App\Notifications\LowBalanceNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Log;

class ProcessVpsBilling extends Command
{
    protected $signature = 'billing:run';
    protected $description = 'Proses billing VPS per jam dan pengecekan saldo';

    public function handle()
    {
        $vpsList = VpsInstance::with('package', 'user')
            ->where('is_suspended', false)
            ->get();

        foreach ($vpsList as $vps) {
            DB::transaction(function () use ($vps) {
                $user = $vps->user;
                $package = $vps->package;

                if (!$package) {
                    return;
                }
               
                $costPerHour = $package->price_per_hour;

                if ($user->balance < $costPerHour) {
                    $vps->update(['is_suspended' => true]);
                    return;
                }

                Transaction::create([
                    'user_id' => $user->id,
                    'amount' => -$costPerHour,
                    'description' => 'Biaya VPS ' . $vps->name
                ]);

                $monthlyCost = $user->transactions()
                    ->where('description', 'like', '%Biaya VPS%')
                    ->whereMonth('created_at', now()->month)
                    ->sum('amount') * -1;

                if ($monthlyCost > 0 && $user->balance < 0.1 * $monthlyCost) {
                    $user->notify(new LowBalanceNotification($user->balance));
                }
            });
        }

        $this->info('Billing VPS berhasil dijalankan.');
    }
}
