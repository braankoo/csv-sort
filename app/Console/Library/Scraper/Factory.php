<?php

namespace App\Console\Library\Scraper;

class Factory {

    /**
     * @return \App\Console\Library\Scraper\ScrapperInterface
     * @throws \Exception
     */
    public static function build(string $provider): ScrapperInterface
    {
        return match ($provider)
        {
            'mozzart' => Phanter::getInstance(),
            default => throw new \Exception('unknown data provider'),
        };
    }

}
