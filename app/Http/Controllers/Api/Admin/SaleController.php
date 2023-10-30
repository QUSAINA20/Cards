<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function __construct()
    {
        \Config::set('auth.defaults.guard', 'admin-api');
    }
    public function index()
    {
        $sales = Sale::with('media', 'discount')->paginate(10);
        if ($sales->isEmpty()) {
            return response()->json(['sales' => []]);
        }
        return response()->json(['sales' => $sales]);
    }

    public function changeStatus($id)
    {
        $card = Sale::findOrFail($id);

        $newStatus = $card->status === 'Deactivated' ? 'Active' : 'Deactivated';

        $card->update(['status' => $newStatus]);

        return response()->json(['message' => 'Sale Status Is ' . $newStatus . ' Now'], 200);
    }

    public function destroy($id)
    {
        $card = Sale::findOrFail($id);
        $card->delete();
        return response()->json(['message' => 'Sale has been deleted'], 200);
    }
}
