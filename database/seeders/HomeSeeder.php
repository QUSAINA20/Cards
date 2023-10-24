<?php

namespace Database\Seeders;

use App\Models\Landing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class HomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
   {
       $files = [
           'image1.png',
           'image2.jpg',
           'image3.jpg',
           'video.mp4',
       ];

        $landing = new Landing();
        $landing->name = 'Landing 1';
        $landing->description = 'Description for Landing 1';
        $landing->section = 'slide_image';
        $landing->save();
        
        $landing->addMedia('storage/app/public/media/' . $files[0])->toMediaCollection('images');
        $landing->addMedia('storage/app/public/media/' . $files[1])->toMediaCollection('images');
        $landing->addMedia('storage/app/public/media/' . $files[2])->toMediaCollection('images');
        $landing->addMedia('storage/app/public/media/' . $files[3])->toMediaCollection('videos');
   }
}
