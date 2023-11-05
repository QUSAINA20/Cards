<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ForSaleCard;
use App\Models\Landing;

class HomeController extends Controller
{
    public function index()
    {
        $video = Landing::where('section', 'slide_video')->latest('created_at')->first();
        $images = Landing::where('section', 'slide_image')->latest('created_at')->first();
        $headSecondSection = Landing::where('section', 'head')->latest('created_at')->first();
        $bodyOfSecondSection = Landing::where('section', 'services')->get();
        $discount = Landing::where('section', 'discount')->latest('created_at')->first();

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
        ];

        return response()->json($data);
    }
}
