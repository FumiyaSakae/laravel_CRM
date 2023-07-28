<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \App\Models\Customer;
use \App\Models\Hr;

class Purchase extends Model
{
    use HasFactory;

    public function scopeSearchCustomers($query, $input = null){
        if(!empty($input)){
            if(Customer::where('company_name', 'like', '%' . $input . '%')
            ->exists())
            {
                return $query->where('company_name', 'like', '%' . $input . '%')
                ;
            }
        }
    }

    protected $fillable = [
        'startDate',
        'endDate',
        'start_process',
        'end_process',
        'customer_id',
        'contr_detail',
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
