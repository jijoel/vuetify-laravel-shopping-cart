<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        factory(App\Product::class,100)->create();
        factory(App\Profile::class,5)->create();
        factory(App\Promotion::class,4)->create();
    }
}
