<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;

class GenerateArticleSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:generate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs for articles that don\'t have one';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating slugs for articles...');

        $articles = Article::whereNull('slug')->orWhere('slug', '')->get();

        if ($articles->isEmpty()) {
            $this->info('All articles already have slugs!');
            return 0;
        }

        $progressBar = $this->output->createProgressBar($articles->count());

        foreach ($articles as $article) {
            $article->slug = Article::generateUniqueSlug($article->title, $article->id);
            $article->save();
            $progressBar->advance();
        }

        $progressBar->finish();

        $this->newLine();
        $this->info("Successfully generated slugs for {$articles->count()} articles!");

        return 0;
    }
}
