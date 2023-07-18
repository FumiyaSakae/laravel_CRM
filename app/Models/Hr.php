<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase;

class Hr extends Model
{
    use HasFactory;

    public function scopeSearchHrs($query, $input = null){
        if(!empty($input)){
            if(Hr::where('name', 'like', $input . '%')
            ->orWhere('min_price', 'like', $input . '%')->exists())
            {
                return $query->where('name', 'like', $input . '%')
                ->orWhere('min_price', 'like', $input . '%');
            }
        }
    }

    protected $fillable = [
        'name',
        'memo',
        'min_price',
        'is_selling',
        'current_price',
    ];

    public function purchases(){
        return $this->belongsToMany(Purchase::class)
        ->withPivot('quantity');
    }
}
