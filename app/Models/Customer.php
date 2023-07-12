<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public function scopeSearchCustomers($query, $input = null){
        if(!empty($input)){
            if(Customer::where('pic_kana', 'like', $input . '%')
            ->orWhere('tel', 'like', $input . '%')->exists())
            {
                return $query->where('pic_kana', 'like', $input . '%')
                ->orWhere('tel', 'like', $input . '%');
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

}
