<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'shipper', 'image', 'weight', 'description', 'status'];

    public function getPriceAttribute()
    {
        if ($this->weight <= 10) {
            return 10;
        } elseif ($this->weight > 10 && $this->weight <= 25) {
            return 100;
        } else {
            return 300;
        }
    }

    public function journalEntities()
    {
        return $this->hasMany(JournalEntity::class);
    }
    

}
