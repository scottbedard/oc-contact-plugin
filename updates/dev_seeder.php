<?php namespace Bedard\Contact\Updates;

use Faker;
use Bedard\Contact\Models\Subject;
use October\Rain\Database\Updates\Seeder;

class DevSeeder extends Seeder
{
    public function run()
    {
        if (app()->env !== 'dev') return;
        $this->seedSubjects(5);
    }

    protected function seedSubjects($quantity)
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < $quantity; $i++)
            Subject::create(['name' => $faker->sentence(5)]);
    }
}


