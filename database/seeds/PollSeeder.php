<?php

use Illuminate\Database\Seeder;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Poll::class,20)->create()->each(function ($data) {
            $data->save();
        });
    }
}
