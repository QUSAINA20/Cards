<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SaleRequest;
use App\Models\Sale;

class SaleController extends Controller
{
    public function store(SaleRequest $request)
    {
        $request->validated();
        $sale = Sale::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'discount_id'  => $request->discount_id,
            'transaction_number' => $request->transaction_number,
        ]);
        if ($request->hasFile('photo')) {
            $sale->addMediaFromRequest('photo')->toMediaCollection('transactions');
        }
        return response()->json('Sale Request stored successfully.',200);
    }
}
