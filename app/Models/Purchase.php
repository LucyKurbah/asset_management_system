<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $table = 'purchase';
    
    public $timestamps = false;
    protected $fillable = [
        'po_no',
        'installation_date',
        'delivery_date',
        'warranty_from',
        'warranty_to',
        'purchased_by'
    ];



}
