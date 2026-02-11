<?php

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;

class PostsUpdateTitle extends Command
{
    protected $signature = 'posts:update-title {title}';
    protected $description = 'Altera o título de todas as postagens (news)';

    public function handle(): int
    {
        $title = $this->argument('title');

        $count = News::query()->update(['title' => $title]);

        $this->info("OK! {$count} notícias atualizadas com o título: {$title}");

        return self::SUCCESS;
    }
}
