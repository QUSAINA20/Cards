<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ForSaleCard;
use App\Models\Landing;

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
}
