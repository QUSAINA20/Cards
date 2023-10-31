<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardValueRequest;
use App\Models\CardValue;
use Illuminate\Http\Request;

class CardValueController extends Controller
{
    
    public function __construct()
    {
        \Config::set('auth.defaults.guard' , 'admin-api');
    }

    public function store(CardValueRequest $request)
    {
        $request->validated();
        CardValue::create([
            'value' => $request->value,
            'daily_price' => $request->daily_price,
            'placeholder' => $request->placeholder,
            'status' => $request->status,
            'card_type_id' => $request->card_type_id,
        ]);
        return response()->json('Card Value stored successfully.', 200);
    }

    public function update(CardValueRequest $request, CardValue $cardValue)
    {
     $data=  $request->validated();
        $cardValue->update($data);
        return response()->json('Card Value updated successfully.', 200);
    }
    
    public function destroy($id)
    {
        CardValue::destroy($id);
        return response()->json('Card Value deleted successfully.', 200);
    }
    public function changeStatus($id)
    {
        $cardValue = CardValue::findOrFail($id);
        if ($cardValue->status == 'Deactivated') {
            CardValue::findOrFail($id)->update(['status' => 'Active']);
            return response()->json('Card Value Status Is Active Now', 200);
        } else {
            CardValue::findOrFail($id)->update(['status' => 'Deactivated']);
            return response()->json('Card Value Status Is Deactivated Now', 200);
        }
    }
}
