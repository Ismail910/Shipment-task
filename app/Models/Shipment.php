<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'shipper', 'image', 'weight', 'description', 'status', 'price'];


    public function journalEntities()
    {
        return $this->hasMany(JournalEntity::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($shipment) {
            $shipment->code = static::generateUniqueCode();
            $shipment->setPriceBasedOnWeight();
            $shipment->status = 'Pending';
        });
    }

    protected static function generateUniqueCode()
    {
        do {
            $code = random_int(100000, 999999);
        } while (static::where('code', $code)->exists());

        return $code;
    }
    public function setPriceBasedOnWeight()
    {
        if ($this->weight <= 10) {
            $this->price = 10;
        } elseif ($this->weight > 10 && $this->weight <= 25) {
            $this->price = 100;
        } else {
            $this->price = 300;
        }
    }
}
