<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'storage_building_id'];

    // Define relationship to storage building
    public function storageBuilding()
    {
        return $this->belongsTo(StorageBuilding::class);
    }
}
