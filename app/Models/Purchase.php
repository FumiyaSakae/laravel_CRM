<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Customer;
use \App\Models\Hr;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'status',
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function hrs(){
        return $this->belongsToMany(Hr::class)
        ->withPivot('quantity');
    }
}
