<?php

// database/seeders/MockTestSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MockTest;

class MockTestSeeder extends Seeder
{
    public function run()
    {
        $tests = [
            [
                'skill' => 'listening',
                'title' => 'Listening Test 1',
                'json_path' => 'private/listening/1/1.json',
            ],
            [
                'skill' => 'listening',
                'title' => 'Listening Test 2',
                'json_path' => 'private/listening/2/1.json',
            ],
            [
                'skill' => 'reading',
                'title' => 'Reading Test 1',
                'json_path' => 'private/reading/1/1.json',
            ],
        ];

        foreach ($tests as $test) {
            MockTest::create($test);
        }
    }
}
