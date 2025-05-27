<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VpsUsage extends Model
{
    protected $fillable = ['vps_instance_id', 'billed_at', 'cost'];

    public function vps()
    {
        return $this->belongsTo(VpsInstance::class, 'vps_instance_id');
    }
}

