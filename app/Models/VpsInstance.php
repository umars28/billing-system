<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VpsInstance extends Model
{
    protected $fillable = ['user_id', 'name', 'cpu', 'ram', 'storage', 'started_at', 'is_suspended', 'suspended_at', 'package_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function usages()
    {
        return $this->hasMany(VpsUsage::class);
    }
    
    public function package()
    {
        return $this->belongsTo(VpsPackage::class, 'package_id');
    }
}

