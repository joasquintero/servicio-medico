<?php

use Illuminate\Database\Seeder;
use App\Models\Illness;

class IllnessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $illness = new Illness();
        $illness->name = 'Diabetes';
        $illness->type = 'Melitus';
        $illness->save();

        $illness2 = new Illness();
        $illness2->name = 'Migraña';
        $illness2->type = 'Dolor';
        $illness2->save();

        $illness = new Illness();
        $illness->name = 'Gastritis';
        $illness->type = 'Dolor';
        $illness->save();

        $illness = new Illness();
        $illness->name = 'Fiebre';
        $illness->type = 'Infección';
        $illness->save();
    }
}
