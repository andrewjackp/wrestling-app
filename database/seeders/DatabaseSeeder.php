<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
use App\Models\Wrestler;
use App\Models\Bout;
use App\Models\Promotion;
use App\Models\BoutWrestler;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        // Promotion::factory()
        //     ->count(4)
        //     ->has(Wrestler::factory()->count(rand(3,7)))
        //     ->create();

        Article::factory()
            ->count(10)
            ->create();            

        $wwe = Promotion::factory()->create(['name' => 'WWE']);
        foreach (config('rosters.WWE') as $name) {
            Wrestler::factory()->forPromotion($wwe)->create(['name' => $name]);
        }
        Article::factory()->count(1)->forPromotion($wwe)->create();

        $aew = Promotion::factory()->create(['name' => 'AEW']);
        foreach (config('rosters.AEW') as $name) {
            Wrestler::factory()->forPromotion($aew)->create(['name' => $name]);
        }
        Article::factory()->count(5)->forPromotion($aew)->create();

        $njpw = Promotion::factory()->create(['name' => 'NJPW']);
         foreach (config('rosters.NJPW') as $name) {
            Wrestler::factory()->forPromotion($njpw)->create(['name' => $name]);
        }
        Article::factory()->count(5)->forPromotion($njpw)->create();

        $cmll = Promotion::factory()->create(['name' => 'CMLL']);
        foreach(config('rosters.CMLL') as $name) {
            Wrestler::factory()->forPromotion($cmll)->create(['name' => $name]);
        }
        Article::factory()->count(5)->forPromotion($cmll)->create();

        Wrestler::factory()->create([
            'name' => 'Steve Austin',
            'promotion_id' => 1,
        ]);

        $bouts = Bout::factory()
            ->count(6)
            ->create();


        foreach($bouts as $bout) {
            BoutWrestler::factory()->count(2)->create([
                'bout_id' => $bout->id,
                'wrestler_id' => Wrestler::factory()
            ]);
        };  
    }
}
