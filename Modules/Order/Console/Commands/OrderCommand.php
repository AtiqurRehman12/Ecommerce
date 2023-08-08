<?php

namespace Modules\Order\Console\Commands;

use Illuminate\Console\Command;

class OrderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:OrderCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Order Command description';

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
