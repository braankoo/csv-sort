<?php

namespace App\Console\Commands;

use App\Jobs\GetOffers;
use App\Models\Bookie;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class Offers extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:offers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape offers';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Bookie::each(function ($bookie) {
            $bookie->categories()->each(function ($category) use ($bookie) {
                dispatch(new GetOffers($bookie, $category));
            });
        });
        return CommandAlias::SUCCESS;
    }
}
