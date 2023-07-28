<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\Subtotal;
use \App\Models\Customer;

class Order extends Model
{
    use HasFactory;

    public function scopeSearchCustomers($query, $input = null){
        if(!empty($input)){
            if(Order::where('customer_name', 'like', '%' . $input . '%')
            ->exists())
            {
                return $query->where('customer_name', 'like', '%' . $input . '%');
            } else if(Order::where('contr_detail', 'like', '%' . $input . '%')
            ->exists())
            {
                return $query->where('contr_detail', 'like', '%' . $input . '%');
            } else if(Order::where('hr_name', 'like', '%' . $input . '%')
            ->exists())
            {
                return $query->where('hr_name', 'like', '%' . $input . '%');
            }
        }
    }

    protected $fillable = [
        'customer_name',
    ];


    protected static function booted(){
        static::addGlobalScope(new Subtotal);
    }
}
