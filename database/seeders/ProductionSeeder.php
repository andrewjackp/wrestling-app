<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Promotion;
use App\Models\Wrestler;
use App\Models\Article;

class ProductionSeeder extends Seeder
{
    public function run(): void
    {
        // Small rosters for production test
        $rosters = [
            'WWE' => [
                'Cody Rhodes',
                'Seth FREAKIN Rollins',
                'Roman Reigns',
                'Rhea Ripley',
                'Becky Lynch',
            ],
            'AEW' => [
                'Kenny Omega',
                'Bryan Danielson',
                'Jon Moxley',
                'MJF',
                'Hangman Adam Page',
                'Swerve Strickland',
                'Toni Storm',
            ],
            'CMLL' => [
                'Mistico',
                'Soberano Jr.',
                'Atlantis Jr.',
                'Blue Panther',
                'Ultimo Guerrero'
            ],
            'NJPW' => [
                'Yota Tsuji',
                'Aaron Wolf',
                'Hirooki Goto',
                'Zack Sabre, Jr.',
                'Toru Yano',
            ]
        ];

        foreach ($rosters as $promotionName => $names) {
            $promotion = $this->upsertPromotionByName($promotionName);

            foreach ($names as $name) {
                $this->upsertWrestlerByNameAndPromotion($name, $promotion->id);
            }

            // A couple of deterministic articles (no Faker)
            $this->ensureArticlesForPromotion($promotion->id, $promotionName);
        }
    }

    /* get promotion for wrestler, create one if doesn't exist.
     */
    private function upsertPromotionByName(string $name): Promotion
    {
        $existing = Promotion::query()->where('name', $name)->first();

        if ($existing) {
            return $existing;
        }

        $promotion = new Promotion();
        $promotion->forceFill([
            'name' => $name,
        ])->save();

        return $promotion;
    }

    /* 
     * uniqueness here is wrestler name, this prevents wrestlers belonging to wrong promotion.
     */
    private function upsertWrestlerByNameAndPromotion(string $name, int $promotionId): Wrestler
    {
        $wrestler = Wrestler::query()->where('name', $name)->first();

        if ($wrestler) {
            $wrestler->promotion_id = $promotionId;
            $wrestler->save();

            return $wrestler;
        }

        $wrestler = new Wrestler();
        $wrestler->forceFill([
            'name' => $name,
            'promotion_id' => $promotionId,
        ])->save();

        return $wrestler;
    }

    /**
     * Adds a couple of simple articles per promotion if they don't exist.
     * Uses deterministic slugs in the title so it won't duplicate on re-run.
     */
    private function ensureArticlesForPromotion(int $promotionId, string $promotionName): void
    {
        $articles = [
            [
            'title' => "{$promotionName} Weekly Rundown",
            'content' => "A quick weekly recap for {$promotionName}.",
            ],
            [
            'title' => "{$promotionName} Roster Spotlight",
            'content' => "A spotlight on a few key names in {$promotionName}.",
            ],
        ];

        $columns = \Schema::getColumnListing('articles');
        $titleColumn = in_array('article_title', $columns) ? 'article_title' : 'title';

        foreach ($articles as $a) {
            $exists = Article::query()
                ->where('promotion_id', $promotionId)
                ->where($titleColumn, $a['title'])
                ->exists();

            if ($exists) {
                continue;
            }   

            $article = new Article();
            $article->forceFill([
                $titleColumn => $a['title'],
                'content' => $a['content'],
                'promotion_id' => $promotionId,
            ])->save();
        }
    }
}
