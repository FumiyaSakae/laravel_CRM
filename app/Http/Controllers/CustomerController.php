<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Inertia\Inertia;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $customers = Customer::searchCustomers($request->search)
        ->select('id', 'company_name','pic_name', 'pic_kana', 'tel')->paginate(50);


        return Inertia::render('Customers/index', [
            'customers' => $customers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Customers/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        Customer::create([
            'company_name' => $request->company_name,
            'pic_name' => $request->pic_name,
            'pic_kana'=> $request->pic_kana,
            'gender'=> $request->gender,
            'tel' => $request->tel,
            'email' => $request->email,
            'postcode' => $request->postcode,
            'address' => $request->address,
            'startDate' => $request->startDate,
            'memo' => $request->memo,
        ]);

        return to_route('customers.index')
        ->with([
            'message' => '登録しました。',
            'status' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
