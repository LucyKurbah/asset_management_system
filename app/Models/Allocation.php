<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    use HasFactory;
    protected $table = 'allocation';
    public $timestamps = false;
    public function employee()
    {
        return $this->belongsTo(User::class, 'emp_code');
    }

    public function assignedTo()
    {
        return $this->belongsTo(Assigned::class, 'assigned_to');
    }

    public function device()
    {
        return $this->belongsTo(Device::class,'device_id');
    }

}
