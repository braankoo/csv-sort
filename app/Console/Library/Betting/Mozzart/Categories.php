<?php

namespace App\Console\Library\Betting\Mozzart;

use App\Console\Library\Scraper\ScrapperInterface;
use App\Models\Bookie;
use App\Models\Category;

/**
 *
 */
class Categories {

    /**
     * @var \App\Models\Category[]
     */
    private array $categories;
    /**
     * @var \App\Console\Library\Scraper\ScrapperInterface
     */
    private ScrapperInterface $scrapper;

    /**
     * @return array
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @return \App\Console\Library\Scraper\ScrapperInterface
     */
    private function getScrapper(): ScrapperInterface
    {
        return $this->scrapper;
    }

    /**
     * @param \App\Console\Library\Scraper\ScrapperInterface $scrapper
     */
    public function __construct(ScrapperInterface $scrapper)
    {
        $this->scrapper = $scrapper;
    }


    /**
     * @param \App\Models\Bookie $bookie
     * @return $this
     */
    public function __invoke(Bookie $bookie): Categories
    {
        $this->scrape($bookie);

        return $this;
    }


    /**
     * @param \App\Models\Bookie $bookie
     * @return void
     */
    private function scrape(Bookie $bookie): void
    {
        $this->getScrapper()->getClient()->request('GET', $bookie->url);
        $crawler = $this->getScrapper()->getClient()->waitFor('.sports-left-menu', 600);
        $menu = $crawler->filter('div.regular-filter-holder:last-child ul:first-child li.main-item:not(:first-child)');
        $nodeIndex = 2;
        $menu->each(function ($node) use (&$client, &$nodeIndex, $bookie) {
            $item = "div.regular-filter-holder:last-child ul:first-child li.main-item:nth-of-type($nodeIndex) div";
            $this->getScrapper()->getClient()->executeScript("document.querySelector('$item').click()");
            $this->getScrapper()->getClient()->waitFor('div.sportsoffer');
            $name = $node->filter('span')->eq(1)->getText(true);
            $nodeIndex ++;
            $category = new Category(
                [
                    'name'      => $name,
                    'url'       => $this->getScrapper()->getClient()->getCurrentUrl(),
                    'bookie_id' => $bookie->id
                ]
            );
            $this->categories[] = $category;
        });

    }
}
