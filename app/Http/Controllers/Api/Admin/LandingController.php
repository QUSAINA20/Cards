<?php

namespace App\Http\Controllers;

use App\Http\Requests\LandingRequest;
use App\Models\Landing;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class LandingController extends Controller implements HasMedia
{
    use InteractsWithMedia;

    public function __construct()
    {
        \Config::set('auth.defaults.guard' , 'admin-api');
    }

    public function index()
    {
        $landings = Landing::all();

        foreach ($landings as $landing) {
            $landing->loadMedia('images'); 
            $landing->image_url = $landing->getMedia('images')->pluck('url');

            $landing->loadMedia('videos'); 
            $landing->video_url = $landing->getMedia('videos')->pluck('url'); 

            // $landing->loadMedia('images'); 
            // $landing->image_url = $landing->getMedia('images')->pluck('url')->first();
            // $landing->has_images = $landing->getMedia('images')->isNotEmpty();

            // $landing->loadMedia('videos'); 
            // $landing->video_url = $landing->getMedia('videos')->pluck('url')->first();
            // $landing->has_videos = $landing->getMedia('videos')->isNotEmpty();
        }

        return response()->json($landings);
    }

    public function store(LandingRequest $request)
    {
        $request->validated();
        $landing = Landing::create([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->icon,
            'section'  => $request->section,
        ]);
        if ($request->hasFile('image')) {
            $landing->addMediaFromRequest('image')->toMediaCollection('images');
        }

        if ($request->hasFile('video')) {
            $landing->addMediaFromRequest('video')->toMediaCollection('videos');
        }
        return response()->json('Landing Request stored successfully.',200);
    }

    public function show(Landing $landing)
    {
        return response()->json($landing);
    }

    public function update(LandingRequest $request, Landing $landing)
    {
        $data = $request->validated();
        
        $landing->update($data);

        return response()->json($landing);
    }

    public function destroy(Landing $landing)
    {
        $landing->delete();

        return response()->json(null, 204);
    }
}
