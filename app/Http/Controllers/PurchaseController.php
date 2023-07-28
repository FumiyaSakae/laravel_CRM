<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Purchase;
use App\Models\Customer;
use App\Models\Hr;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Order;

class PurchaseController extends Controller
{

    public function processCalc($startProcess, $endProcess) : string {
        switch ($startProcess) {
            case '要件定義':
                switch ($endProcess) {
                    case '基本設計':
                        $process = '要件定義,基本設計';
                        break;
                    case '詳細設計':
                        $process = '要件定義,基本設計,詳細設計';
                        break;
                    case '開発':
                        $process = '要件定義,基本設計,詳細設計,開発';
                        break;
                    case 'テスト':
                        $process = '要件定義,基本設計,詳細設計,開発,テスト';
                        break;
                    case '保守・運用':
                        $process = '要件定義,基本設計,詳細設計,開発,テスト,保守運用';
                        break;
                    default:
                        $process = '要件定義';
                        break;
                }
                break;
            case '基本設計':
                    switch ($endProcess) {
                        case '詳細設計':
                            $process = '基本設計,詳細設計';
                            break;
                        case '開発':
                            $process = '基本設計,詳細設計,開発';
                            break;
                        case 'テスト':
                            $process = '基本設計,詳細設計,開発,テスト';
                            break;
                        case '保守・運用':
                            $process = '基本設計,詳細設計,開発,テスト,保守・運用';
                            break;
                        default:
                            $process = '基本設計';
                            break;
                }
                break;
            case '詳細設計':
                    switch ($endProcess) {
                        case '開発':
                            $process = '詳細設計,開発';
                            break;
                        case 'テスト':
                            $process = '詳細設計,開発,テスト';
                            break;
                        case '保守・運用':
                            $process = '詳細設計,開発,テスト,保守・運用';
                            break;
                        default:
                            $process = '詳細設計';
                            break;
                }
                break;
            case '開発':
                    switch ($endProcess) {
                        case 'テスト':
                            $process = '開発,テスト';
                            break;
                        case '保守・運用':
                            $process = '開発,テスト,保守・運用';
                            break;
                        default:
                            $process = '開発';
                            break;
                }
                break;
            case 'テスト':
                    switch ($endProcess) {
                        case '保守・運用':
                            $process = 'テスト,保守・運用';
                            break;
                        default:
                            $process = 'テスト';
                            break;
                }
                break;
            case '保守・運用':
                $process = '保守・運用';
                break;
        default:
            $process = $startProcess;
             break;
        }

        return $process;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = Order::searchCustomers($request->search)
        ->groupBy('id')
        ->selectRaw('id, sum(subtotal) as total, contr_detail ,customer_name, status, created_at')
        ->orderByRaw('updated_at desc')
        ->paginate(50);

        return Inertia::render('Purchases/index', [
            'orders' => $orders
        ]);
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
            'start_process' => ['required'],
        ]);

        $process = PurchaseController::processCalc($request->start_process, $request->end_process);

        try{
            foreach($request->hrs as $hr){
                Hr::where('id', $hr['id'])
                ->update([
                    'current_price' => $hr['current_price'],
                    'current_process' => $process,
                    'is_selling' => 0,
                ]);
            }

            $purchase = Purchase::create([
                'startDate' => $request->startDate,
                'endDate' => $request->endDate,
                'start_process' => $request->start_process,
                'end_process' => $request->end_process,
                'customer_id' => $request->customer_id,
                'status' => false,
                'contr_detail' => $request->contr_detail,
            ]);

            foreach($request->hrs as $hr){
                $purchase->hrs()->attach($purchase->id, [
                    'hr_id' => $hr['id'],
                    'store_price' =>  $hr['store_price'],
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
        $hrs = Order::orderBy('hr_id','asc')
        ->where('id', $purchase->id)->get();

        $order = Order::groupBy('id')
        ->where('id', $purchase->id)
        ->selectRaw('id, sum(subtotal) as total, startDate, endDate, customer_name, status, created_at')
        ->get();

        return Inertia::render('Purchases/show', [
            'hrs' => $hrs,
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        $purchase = Purchase::find($purchase->id);

        $allHrs = Hr::select('id', 'name', 'current_price')->get();

        $hrs = [];

        foreach($allHrs as $allHr){
            $quantity = 0;
            foreach($purchase->hrs as $hr){
                if($allHr->id === $hr->id){
                    $quantity = $hr->pivot->quantity;
                }
            }

            if($quantity !== 0){
                array_push($hrs, [
                    'id' => $allHr->id,
                    'name' => $allHr->name,
                    'current_price' => $allHr->current_price,
                    'quantity' => $quantity,
                ]);
            }
        }


        $order = Order::groupBy('id')
        ->where('id', $purchase->id)
        ->selectRaw('id, customer_id, startDate, endDate, start_process, end_process, contr_detail, customer_name, status, created_at')
        ->get();

        return Inertia::render('Purchases/edit', [
            'hrs' => $hrs,
            'order' => $order,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        DB::beginTransaction();

        try {
        $purchase->status = $request->status;
        $purchase->contr_detail = $request->contr_detail;
        $purchase->start_process = $request->start_process;
        $purchase->end_process = $request->end_process;
        $purchase->save();

        $hrs = [];

        $process = PurchaseController::processCalc($request->start_process, $request->end_process);

        foreach($request->hrs as $hr){
            Hr::where('id', $hr['id'])
            ->update([
                'current_process' => $process,
                'current_price' => $hr['current_price']
            ]);

            $hrs = $hrs + [
                $hr['id'] => [
                    'quantity' => $hr['quantity'],
                    'store_price' => $hr['store_price']
                ]
            ];
        }

        $purchase->hrs()->sync($hrs);

        DB::commit();
        return to_route('dashboard');

        } catch (\Exception $d){
            DB::rollback();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
