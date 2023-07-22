<?php

namespace Modules\Slide\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Tag\Entities\Slide;

class SlideDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Disable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        /*
         * Slides Seed
         * ------------------
         */

        // DB::table('slides')->truncate();
        // echo "Truncate: slides \n";

        Slide::factory()->count(20)->create();
        $rows = Slide::all();
        echo " Insert: slides \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
