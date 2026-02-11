<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Tecnologia', 'Esportes', 'Negócios', 'Saúde', 'Mundo'];

        foreach ($names as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
