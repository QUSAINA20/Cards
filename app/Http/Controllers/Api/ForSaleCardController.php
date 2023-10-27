<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ForSaleCard;

class ForSaleCardController extends Controller
{
    
    public function index()
    {
        $forSaleCards = ForSaleCard::all(); 

        foreach ($forSaleCards as $card) {
            $card->loadMedia('cards-photos'); 
            $card->photo_url = $card->getMedia('cards-photos')->pluck('url'); 
        }
    
        return response()->json($forSaleCards);
    }

    public function show(ForSaleCard $forSaleCard)
    {
        return $forSaleCard->load('discounts');
    }
}
