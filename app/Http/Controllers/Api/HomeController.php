<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ForSale;
use App\Models\Landing;
use App\Models\Method;
use App\Models\Payment;
use App\Models\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $video = Landing::where('section', 'slide_video')->first();
        $images = Landing::where('section', 'slide_image')->get();
        $headSecondSecion = Landing::where('section', 'head')->first();
        $bodyOfSecondSection = Landing::where('section', 'services')->get();
        $discount = Landing::where('section', 'discount')->first();
        $cardsForSale = ForSale::where('status', '1')->get();
        $data = [
            'video' => '',
            'images' => [],
            'headSecondSection' => $headSecondSecion,
            'bodyOfSecondSection' => $bodyOfSecondSection,
            'discount' => $discount,
            'cardsForSale' => $cardsForSale,
        ];
    
        // Add image URLs to the response
        foreach ($images as $image) {
            $data['images'][] = Storage::url($image->name);
        }
    
        // Add video URL to the response
        if ($video) {
            $data['video'] = Storage::url($video->name);
        }
    
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
        $card = ForSale::findOrFail($id);
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
