<?php

namespace App\Jobs;

use App\Console\Library\Scraper\Factory;
use App\Models\Bookie;
use App\Models\Category;
use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GetOffers implements ShouldQueue {

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var \App\Models\Category
     */
    private Category $category;
    /**
     * @var \App\Models\Bookie
     */
    private Bookie $bookie;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Bookie $bookie, Category $category)
    {
        $this->bookie = $bookie;
        $this->category = $category;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Exception
     */
    public function handle(): void
    {
        $offers = (new \App\Console\Library\Betting\Mozzart\Offers(Factory::build($this->bookie->name)))($this->category)->getOffers();
        Offer::upsert(
            array_map(fn($offer) => $offer->toArray(), $offers),
            [ 'first', 'second', 'time' ],
            [ 'final_1', 'final_2', 'draw' ]
        );
    }
}
