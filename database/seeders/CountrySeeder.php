<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{

    private $countries = [
        [
            'code'=> 'PL',
            'daily_rate' => 10,
            'currency' => 'PLN'
        ],
        [
            'code'=> 'DE',
            'daily_rate' => 50,
            'currency' => 'PLN'
        ],
        [
            'code'=> 'GB',
            'daily_rate' => 75,
            'currency' => 'PLN'
        ]
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->countries as $country) {
            Country::query()
                ->create($country);
        }
    }
}
