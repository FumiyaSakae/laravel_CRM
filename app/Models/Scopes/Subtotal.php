<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class Subtotal implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $sql = 'select purchases.id as id
        , hrs.id as hr_id
        , hr_purchase.id as pivot_id
        , hr_purchase.store_price * hr_purchase.quantity as subtotal
        , customers.company_name as customer_name
        , customers.id as customer_id
        , hrs.name as hr_name
        , hr_purchase.quantity
        , hr_purchase.store_price
        , purchases.status
        , purchases.startDate
        , purchases.endDate
        , purchases.start_process
        , purchases.end_process
        , purchases.contr_detail
        , purchases.created_at
        , purchases.updated_at
        from purchases
        left join hr_purchase on purchases.id = hr_purchase.purchase_id
        left join hrs on hr_purchase.hr_id = hrs.id
        left join customers on purchases.customer_id = customers.id
        ';
        $builder->fromSub($sql, 'order_subtotals');
    }
}
