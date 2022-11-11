<?php

namespace App\Console\Library\Betting;

use App\Console\Library\Betting\Mozzart\Categories;
use App\Console\Library\Scraper\ScrapperInterface;

/**
 *
 */
class Factory {


    /**
     * @param string $name
     * @return
     */
    public static function category(string $name, ScrapperInterface $scrapper)
    {
        switch ( $name )
        {
            case 'mozzart':
                return new Categories($scrapper);
            default:
                break;
        }
    }

}

