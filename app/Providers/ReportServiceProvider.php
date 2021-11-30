<?php

namespace App\Providers;

use App\Library\CSV;
use Illuminate\Support\ServiceProvider;
use League\Csv\Reader;
use League\Csv\Statement;

class ReportServiceProvider extends ServiceProvider {

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Register services.
         *
         * @return \League\Csv\Reader;
         */

        $this->app->bind(CSV::class,
            function ($app, $params) {
                return new CSV(
                    Reader::createFromPath($params[0], 'r'),
                    Statement::create()
                );
            });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
