<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorageBuilding extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'capacity', 'location'];

    // Define relationships if needed (e.g., items in the storage building)
    public function items()
    {
        return $this->hasMany(Storage::class); // If storage items are linked to storage buildings
    }
}
