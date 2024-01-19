<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntity extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'type', 'shipment_id'];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
    
}
