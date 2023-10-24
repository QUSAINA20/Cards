<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ForSaleCard;
use App\Models\Landing;
use App\Models\Method;
use App\Models\Payment;
use App\Models\Upload;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class HomeController extends Controller
{
    public function index()
    {
        $video = Landing::where('section', 'slide_video')->first();
        $images = Landing::where('section', 'slide_image')->first();
        $headSecondSection = Landing::where('section', 'head')->first();
        $bodyOfSecondSection = Landing::where('section', 'services')->get();
        $discount = Landing::where('section', 'discount')->first();
        $cardsForSale = ForSaleCard::where('status', '1')->get();
 
        $images->loadMedia('images'); 
        $images->path = $images->getMedia('images')->pluck('url'); 
 
        $video->loadMedia('videos'); 
        $video->path = $video->getMedia('videos')->pluck('url'); 
 
        $data = [
            'video' => $video,
            'images' => $images,
            'headSecondSection' => $headSecondSection,
            'bodyOfSecondSection' => $bodyOfSecondSection,
            'discount' => $discount,
            'cardsForSale' => $cardsForSale,
        ];
 
        return response()->json($data);
    }

    public function isAdmin()
    {
        $data = [
            'message' => 'You are an admin',
        ];

        return response()->json($data);
    }

    public function isUser()
    {
        $countPenddingUploadedCards = Upload::where('user_id', auth()->user()->id)->count();
        $methods = Method::where('status', 1)->get();
        
        $data = [
            'countPenddingUploadedCards' => $countPenddingUploadedCards,
            'methods' => $methods,
        ];

        return response()->json($data);
    }

    public function buyCard($id)
    {
        $card = ForSaleCard::findOrFail($id);
        $discounts =  $card->discounts;

        $data = [
            'card' => $card,
            'discounts' => $discounts,
        ];

        return response()->json($data);
    }

    public function getTransectionNumber(Request $request)
    {
        $tr = Payment::findOrFail($request->country_id);

        $data = [
            'transaction_number' => $tr->transaction_number,
            'amount' => $tr->amount,
            // Include any other relevant data from the Payment model
        ];

        return response()->json($data);
    }
}
