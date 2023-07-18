<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Purchase;
use App\Models\Customer;
use App\Models\Hr;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $customers = Customer::select('id', 'company_name', 'startDate')->get();
        $hrs = Hr::select('id', 'name', 'min_price')
        ->where('is_selling', 1)
        ->get();

        return Inertia::render('Purchases/create', [
            // 'customers' => $customers,
            'hrs' => $hrs,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request)
    {
        DB::beginTransaction();

        $request->validate([
            'customer_id' => ['required'],
            'hr_id' => ['required'],
            'current_price' => ['required'],
            'quantity' => ['required'],
        ]);

        try{
            Hr::where('id', $request->hr_id)
            ->update([
                'current_price' => $request->current_price
            ]);
            $purchase = Purchase::create([
                'customer_id' => $request->customer_id,
                'status' => $request->status,
            ]);
            foreach($request->hrs as $hr){
                $purchase->hrs()->attach($purchase->id, [
                    'hr_id' => $hr['id'],
                    'quantity' => $hr['quantity']
                ]);
            }

            DB::commit();

            return to_route('dashboard');

            } catch(\Exception $d){
            DB::rollback();
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
