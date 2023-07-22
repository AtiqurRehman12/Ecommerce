<?php

namespace Modules\Type\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Tag\Entities\Type;

class TypeDatabaseSeeder extends Seeder
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
         * Types Seed
         * ------------------
         */

        // DB::table('types')->truncate();
        // echo "Truncate: types \n";

        Type::factory()->count(20)->create();
        $rows = Type::all();
        echo " Insert: types \n\n";

        // Enable foreign key checks!
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
