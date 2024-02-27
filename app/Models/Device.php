<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $table = 'device';
    public $timestamps = false;
    protected $fillable = [
        'category',
        'item_type',
        'oem'
    ];

    public function categoryRelation()
    {
        return $this->belongsTo(Category::class,'category');
    }

    public function itemType()
    {
        return $this->belongsTo(ItemType::class,'item_type');
    }

    public function oemRelation()
    {
        return $this->belongsTo(Oem::class,'oem');
    }

    public function allocation()
    {
        return $this->hasOne(Allocation::class);
    }
}
