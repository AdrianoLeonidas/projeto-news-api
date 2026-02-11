<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    protected static ?string $locale = 'pt_BR';

    public function definition(): array
{
    $titles = [
        'Governo anuncia nova medida econômica',
        'Tecnologia avança no setor de saúde',
        'Mercado financeiro fecha em alta',
        'Descoberta científica surpreende pesquisadores',
        'Novo aplicativo promete facilitar o dia a dia'
    ];

    $summaries = [
        'Especialistas analisam impactos da decisão.',
        'Mudança pode afetar milhões de pessoas.',
        'Estudo aponta crescimento significativo.',
        'Projeto traz inovação para o setor.',
        'Expectativa é de melhorias nos próximos meses.'
    ];

    $contents = [
        'Autoridades informaram que a medida começa a valer ainda este ano e deve gerar impacto positivo na economia.',
        'Pesquisadores destacam que a inovação pode transformar a forma como serviços são oferecidos à população.',
        'Analistas afirmam que o cenário é promissor, mas ainda exige cautela dos investidores.',
        'O projeto foi desenvolvido ao longo de anos e contou com a colaboração de especialistas internacionais.',
        'A população aguarda os próximos passos e possíveis benefícios trazidos pela novidade.'
    ];

    return [
        'user_id' => User::factory(),
        'category_id' => Category::factory(),
        'title' => fake()->randomElement($titles),
        'tag' => fake()->randomElement(['Tecnologia', 'Saúde', 'Economia', 'Ciência']),
        'summary' => fake()->randomElement($summaries),
        'content' => fake()->randomElement($contents),
    ];
}

    }

