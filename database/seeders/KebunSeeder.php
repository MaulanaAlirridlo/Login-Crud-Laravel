<?php

namespace Database\Seeders;

use App\Models\Kebun;
use Illuminate\Database\Seeder;

class KebunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kebun::create([
            'kode' => 'KB01-00123',
            'nama' => 'Wilangan 1.0 Ha',
            'luas' => '1000',
        ]);
        
        Kebun::create([
            'kode' => 'KB01-00231',
            'nama' => 'Madiun Selatan 0.9 Ha',
            'luas' => '900',
        ]);
        
        Kebun::create([
            'kode' => 'KB01-00221',
            'nama' => 'Ponorogo 2.9 Ha',
            'luas' => '2900',
        ]);  
    }
}
