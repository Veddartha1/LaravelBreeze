<?php

namespace Database\Seeders;

use App\Models\Ganga;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use function Symfony\Component\String\u;

class GangaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $users->each(function($user) {
            Ganga::factory()->count(5)->create(['user_id' => $user->id]);
        });

        $gangas = Ganga::all();
        foreach ($users as $user) {
            foreach ($gangas as $ganga) {
                if (random_int(1,2) % 2 === 0) {
                    $ganga->likes()->attach($user->id);
                    $ganga->likes()->updateExistingPivot($user->id, [
                        'liked' => 1,
                    ]);
                    $ganga->likes ++;
                    $ganga->save();
                } else {
                    if ((random_int(1, 3) % 3 === 0)) {
                        $ganga->likes()->attach($user->id);
                        $ganga->likes()->updateExistingPivot($user->id, [
                            'unliked' => 1,
                        ]);
                        $ganga->unlikes++;
                        $ganga->save();
                    }
                }
            }
        }
    }
}
