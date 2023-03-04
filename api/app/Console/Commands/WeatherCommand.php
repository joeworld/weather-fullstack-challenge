<?php

namespace App\Console\Commands;

use App\Jobs\WeatherJob;
use Illuminate\Console\Command;

class WeatherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle(): void
    {
        WeatherJob::dispatch();
    }
}
