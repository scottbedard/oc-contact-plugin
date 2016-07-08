<?php namespace Bedard\Contact\Updates;

use Faker;
use Carbon\Carbon;
use Bedard\Contact\Models\Message;
use Bedard\Contact\Models\Subject;
use October\Rain\Database\Updates\Seeder;

class DevSeeder extends Seeder
{
    public function run()
    {
        if (app()->env !== 'dev') return;
        $this->seedSubjects(5);
        $this->seedMessages(20);
    }

    protected function seedSubjects($quantity)
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < $quantity; $i++)
            Subject::create(['name' => $faker->sentence(5)]);
    }

    protected function seedMessages($quantity)
    {
        $subjects = Subject::all();
        $faker = Faker\Factory::create();
        for ($i = 0; $i < $quantity; $i++) {
            $subject = $subjects->random();
            Message::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'subject_id' => $subject->id,
                'subject_text' => $subject->name,
                'body' => $faker->paragraph(5, true),
                'read_at' => rand(0, 1) ? Carbon::now()->subDays(rand(0, 30)) : null,
            ]);
        }
    }
}


