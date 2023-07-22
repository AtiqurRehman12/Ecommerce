<?php

namespace Modules\Store\Console\Commands;

use Illuminate\Console\Command;

class StoreCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:StoreCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
