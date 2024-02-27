<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oem extends Model
{
    use HasFactory;
    protected $table = 'oem';
    public $timestamps = false;

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
}
