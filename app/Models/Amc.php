<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amc extends Model
{
    use HasFactory;
    protected $table = 'amc';

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'po_no');
    }
}
