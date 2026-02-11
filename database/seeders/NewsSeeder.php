<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        // cria um usuário fixo pro teste
        $user = User::firstOrCreate(
            ['email' => 'admin@email.com'],
           ['name' => 'Admin', 'password' => \Illuminate\Support\Facades\Hash::make('123456')]

        );

        // garantir categorias criadas
        $categories = Category::all();

        // cria 20 notícias pro usuário fixo, distribuídas nas categorias
        News::factory()
            ->count(20)
            ->create([
                'user_id' => $user->id,
                'category_id' => $categories->random()->id,
            ]);
    }
}
