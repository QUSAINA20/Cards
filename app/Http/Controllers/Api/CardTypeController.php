<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardTypeRequest;
use App\Models\CardType;
use Illuminate\Http\Request;


class CardTypeController extends Controller
{

    public function index()
    {
        $cardTypes = CardType::all();
        return response()->json($cardTypes);
    }

    public function store(CardTypeRequest $request)
    {
        $request->validated();
        CardType::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        return response()->json('Card Type stored successfully.', 200);
    }

    public function update(CardTypeRequest $request, CardType $cardType)
    {
       $request->validated();
        $cardType->update([
            'name' => $request->name,
            'status' => $request->status,
        ]);
        return response()->json('Card Type updated successfully.', 200);
    }
    
    public function destroy($id)
    {
        CardType::destroy($id);
        return response()->json('Card Type deleted successfully.', 200);
    }
    public function changeStatus($id)
    {
        $cardType = CardType::findOrFail($id);
        if ($cardType->status == 'Deactivated') {
            CardType::findOrFail($id)->update(['status' => 'Active']);
            return response()->json('Card Type Status Is Active Now', 200);
        } else {
            CardType::findOrFail($id)->update(['status' => 'Deactivated']);
            return response()->json('Card Type Status Is Deactivated Now', 200);
        }
    }
}
