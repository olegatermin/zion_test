<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Video;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = factory(User::class)->create([
            'name' => 'User1'
        ]);

        $user2 = factory(User::class)->create([
            'name' => 'User2'
        ]);

        $user3 = factory(User::class)->create([
            'name' => 'User3'
        ]);

        Video::create([
            'id' => 'Video1',
            'size' => 120,
            'viewers' => 1100,
            'created_by' => $user1->id
        ]);

        Video::create([
            'id' => 'Video2',
            'size' => 80,
            'viewers' => 2000,
            'created_by' => $user1->id
        ]);

        Video::create([
            'id' => 'Video3',
            'size' => 250,
            'viewers' => 900,
            'created_by' => $user1->id
        ]);

        Video::create([
            'id' => 'Video4',
            'size' => 90,
            'viewers' => 600,
            'created_by' => $user2->id
        ]);

        Video::create([
            'id' => 'Video5',
            'size' => 75,
            'viewers' => 700,
            'created_by' => $user2->id
        ]);

        Video::create([
            'id' => 'Video6',
            'size' => 300,
            'viewers' => 3000,
            'created_by' => $user2->id
        ]);

        Video::create([
            'id' => 'Video7',
            'size' => 200,
            'viewers' => 2200,
            'created_by' => $user3->id
        ]);
    }
}
