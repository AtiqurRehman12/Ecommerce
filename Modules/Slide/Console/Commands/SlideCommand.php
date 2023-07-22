<?php

namespace Modules\Slide\Console\Commands;

use Illuminate\Console\Command;

class SlideCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SlideCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Slide Command description';

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
