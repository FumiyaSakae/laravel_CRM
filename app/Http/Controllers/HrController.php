<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHrRequest;
use App\Http\Requests\UpdateHrRequest;
use App\Models\Hr;
use Inertia\Inertia;

class HrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hrs = Hr::select('id', 'name', 'min_price', 'is_selling')->get();
        return Inertia::render('Hrs/index', [
            'hrs' => $hrs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Hrs/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHrRequest $request)
    {
        $request->validate([
            'name' => ['required', 'max:20'],
            'min_price' =>['required'],
        ]);

        Hr::create([
            'name' => $request->name,
            'memo' => $request->memo,
            'min_price' => $request->min_price,
        ]);

        return to_route('hrs.index')
        ->with([
            'message' => '登録しました。',
            'status' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hr $hr)
    {
        return Inertia::render('Hrs/show', [
            'hr' => $hr
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hr $hr)
    {
        return Inertia::render('Hrs/edit',[
            'hr' => $hr
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHrRequest $request, Hr $hr)
    {
        $hr->name = $request->name;
        $hr->memo = $request->memo;
        $hr->min_price = $request->min_price;
        $hr->is_selling = $request->is_selling;
        $hr->save();

        return to_route('hrs.index')
        ->with([
            'message' => '更新が完了しました。',
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hr $hr)
    {
        $hr->delete();

        return to_route('hrs.index')
        ->with([
            'message' => '削除が完了しました',
            'status' => 'danger'
        ]);
    }
}
