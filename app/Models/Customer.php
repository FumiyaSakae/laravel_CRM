<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchase;

class Customer extends Model
{
    use HasFactory;

    public function scopeSearchCustomers($query, $input = null){
        if(!empty($input)){
            if(Customer::where('company_name', 'like', $input . '%')
            ->exists())
            {
                return $query->where('company_name', 'like', $input . '%')
                ;
            }
        }
    }

    protected $fillable = [
        'company_name',
        'pic_name',
        'pic_kana',
        'gender',
        'tel',
        'email',
        'postcode',
        'address',
        'startDate',
        'memo',
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

}
