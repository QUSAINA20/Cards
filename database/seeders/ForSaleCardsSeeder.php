<?php

namespace Database\Seeders;

use App\Models\ForSaleCard;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForSaleCardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Card 1',
                'description' => 'Description for Card 1',
                'status' => 'Active',
            ],
            [
                'name' => 'Card 2',
                'description' => 'Description for Card 2',
                'status' => 'Active',
            ],
            // Add more records as needed
        ];

        foreach ($data as $record) {
            $ForSaleCard = ForSaleCard::create($record);
            $ForSaleCard->addMediaFromUrl('https://www.w3schools.com/w3images/lights.jpg')->toMediaCollection('images');
        }
    }
}
