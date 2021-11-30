<?php

namespace App\Console\Commands;

use App\Library\CSV;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;


class BestTeam extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'find:best {csvPath}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find best team match from CSV';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {

        $data = resolve(CSV::class, [ $this->argument('csvPath') ]);

        $this->info('Validating CSV...');
        if ($data->validate())
        {
            $columnToFilterBy = $this->choice('Select column to filter by: ', $data->filterOptions());
            $columnToFilterByValue = trim($this->ask('Please enter column value'));
            $this->info('Getting team...');
            $team = $data->setFilter($columnToFilterBy)->setFilterValue($columnToFilterByValue)->findBestMatch();
            print_r($team);
        }


        return CommandAlias::FAILURE;
    }
}

