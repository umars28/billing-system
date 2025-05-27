<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VpsPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpu',
        'ram',
        'storage',
        'price_per_hour',
    ];

    public function vpsInstances()
    {
        return $this->hasMany(VpsInstance::class, 'package_id');
    }
}

