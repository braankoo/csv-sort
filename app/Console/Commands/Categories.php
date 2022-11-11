<?php

namespace App\Console\Commands;

use App\Console\Library\Scraper\Factory;
use App\Models\Bookie;
use App\Models\Category;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;


/**
 *
 */
class Categories extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape booking categories';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Exception
     */
    public function handle()
    {
        Bookie::each(function ($bookie) {
            $categories = \App\Console\Library\Betting\Factory::category($bookie->name, Factory::build($bookie->name))($bookie);
            Category::upsert(
                array_map(fn($category) => $category->toArray(), $categories->getCategories()),
                [ 'name' ], [ 'url' ]
            );
        });

        return CommandAlias::SUCCESS;
    }
}
