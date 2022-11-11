<?php

namespace App\Console\Library\Betting\Mozzart;

use App\Console\Library\Scraper\ScrapperInterface;
use App\Models\Category;
use App\Models\Offer;

/**
 *
 */
class Offers {


    /**
     * @var \App\Console\Library\Scraper\ScrapperInterface
     */
    private ScrapperInterface $scrapper;


    /**
     * @var \App\Models\Offer[]
     */
    private array $offers;

    /**
     * @return array
     */
    public function getOffers(): array
    {
        return $this->offers;
    }

    /**
     * @param \App\Console\Library\Scraper\ScrapperInterface $scrapper
     */
    public function __construct(ScrapperInterface $scrapper)
    {
        $this->scrapper = $scrapper;
    }


    /**
     * @param \App\Models\Category $category
     * @return $this
     */
    public function __invoke(Category $category): static
    {
        $this->scrape($category);

        return $this;
    }

    /**
     * @param \App\Models\Category $category
     * @return void
     */
    public function scrape(Category $category): void
    {
        $this->scrapper->getClient()->request('GET', $category->url);
        $crawler = $this->scrapper->getClient()->waitFor('.sportsoffer', 120);
        $this->scrapper->getClient()->wait(10);
        do
        {
            $this->scrapper->getClient()->executeScript("document.querySelector('.loadMore .buttonLoad:last-of-type').click()");
            $this->scrapper->getClient()->wait(30);
            print_r(1);
            echo PHP_EOL;
        } while ( $crawler->filter('.paginator')->eq(0)->getAttribute('style') !== 'display: none;' );

//        $offers = $crawler->filter('.competition');
        $this->scrapper->getClient()->takeScreenshot('teatete.png');
        die();
        //        $offers->each(function ($node) use ($category) {
//            $details = $node->filter('article a.pairs span');
//            $time = $details->eq(0)->getText(true);
//            $first = $details->eq(1)->getText(true);
//            $second = $details->eq(2)->getText(true);
//            $final_1 = explode("\n", $node->filter("[title='$first will win the match']")->eq(0)->getText(true));
//            $final_1 = $final_1[1];
//            $final_2 = explode("\n", $node->filter("[title='$second will win the match']")->eq(0)->getText(true));
//            $final_2 = $final_2[1];
//            $draw = null;
//            if (count($node->filter("[title='The match will end with draw result']")))
//            {
//                $draw = explode("\n", $node->filter("[title='The match will end with draw result']")->eq(0)->getText(true));
//                $draw = $draw[1];
//            }
//            $offer = new  Offer(
//                [
//                    'category_id' => $category->id,
//                    'first'       => $first,
//                    'second'      => $second,
//                    'time'        => $time,
//                    'final_1'     => $final_1,
//                    'final_2'     => $final_2,
//                    'draw'        => $draw
//                ]
//            );
//            $this->offers[] = $offer;
//        });
    }

}
