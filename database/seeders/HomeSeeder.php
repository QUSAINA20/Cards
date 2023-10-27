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
           'video.mp4',
           'image1.png',        
       ];

       $landing_video = Landing::create([
            'name' => 'Taste the Creativity',
            'description' => 'We make awesome graphic and web design',
            'section' => 'slide_video',
        ]);

        $landing_images = Landing::create([
            'name' => 'Taste the Creativity',
            'description' => 'We make awesome graphic and web design',
            'section' => 'slide_image',
        ]);

        Landing::create([
            'name' => 'We are Good at',
            'description' => 'Some Of These Stuff Under',
            'section' => 'head',
        ]);
        Landing::create([
            'name' => 'graphic Design',
            'description' => 'Pellentesque in ipsum id orci porta. vivamus magna
            justo,lacinia eget
            consectetur sed,convallis at tellus.',
            'section' => 'services',
        ]);
        Landing::create([
            'name' => 'graphic Design',
            'description' => 'Pellentesque in ipsum id orci porta. vivamus magna
            justo,lacinia eget
            consectetur sed,convallis at tellus.',
            'section' => 'services',
        ]);
        Landing::create([
            'name' => 'graphic Design',
            'description' => 'Pellentesque in ipsum id orci porta. vivamus magna
            justo,lacinia eget
            consectetur sed,convallis at tellus.',
            'section' => 'services',
        ]);
        Landing::create([
            'name' => 'We Have A Discount',
            'description' => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iste quidem, voluptatum facilis officiis nostrum adrepellat soluta corrupti, possimus accusantium in nesciunt, molestias minus illum aliquam sequi quod autem quia!',
            'section' => 'discount',
        ]);
        
        $landing_video->addMedia('storage/app/public/media/' . $files[0])->toMediaCollection('videos');
        $landing_images->addMedia('storage/app/public/media/' . $files[1])->toMediaCollection('images');
   }
}
