<?php

namespace Modules\Type\Console\Commands;

use Illuminate\Console\Command;

class TypeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:TypeCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Type Command description';

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
