<?php

namespace Modules\Store\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Tag\Entities\Store;

class StoreDatabaseSeeder extends Seeder
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
         * Stores Seed
         * ------------------
         */

        // DB::table('stores')->truncate();
        // echo "Truncate: stores \n";

        Store::factory()->count(20)->create();
        $rows = Store::all();
        echo " Insert: stores \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
