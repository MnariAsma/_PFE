<?php

namespace Database\Seeders;

use App\Models\LocationState;
use Database\Factories\LocationStateFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['id' => 1, 'name' => 'Ariana'],
            ['id' => 2, 'name' => 'Béja'],
            ['id' => 3, 'name' => 'Bizerte'],
            ['id' => 4, 'name' => 'Ben Arous'],
            ['id' => 5, 'name' => 'Gabès'],
            ['id' => 6, 'name' => 'Gafsa'],
            ['id' => 7, 'name' => 'Jendouba'],
            ['id' => 8, 'name' => 'Kebili'],
            ['id' => 9, 'name' => 'Kairouan'],
            ['id' => 10, 'name' => 'Kasserine'],
            ['id' => 11, 'name' => 'Kef'],
            ['id' => 12, 'name' => 'Médenine'],
            ['id' => 13, 'name' => 'Mahdia'],
            ['id' => 14, 'name' => 'Manouba'],
            ['id' => 15, 'name' => 'Monastir'],
            ['id' => 16, 'name' => 'Nabeul'],
            ['id' => 17, 'name' => 'Sfax'],
            ['id' => 18, 'name' => 'Sidi Bouzid'],
            ['id' => 19, 'name' => 'Siliana'],
            ['id' => 20, 'name' => 'Sousse'],
            ['id' => 21, 'name' => 'Tataouine'],
            ['id' => 22, 'name' => 'Tozeur'],
            ['id' => 23, 'name' => 'Tunis'],
            ['id' => 24, 'name' => 'Zaghouan'],
        ];

        foreach ($states as $state) {
            LocationState::factory()->create([
                'id' => $state['id'],
                'name' => $state['name'],
            ]);
        }
    }
}
