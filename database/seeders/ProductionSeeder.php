<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

use App\Models\Promotion;
use App\Models\Wrestler;
use App\Models\Article;
use App\Models\Event;
use App\Models\Bout;
use App\Models\BoutWrestler;
use App\Models\Result;

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

        $events = [
            'WWE' => [
                ['name' => 'Royal Rumble 2025',  'event_date' => '2025-02-01', 'venue' => 'Lucas Oil Stadium',      'city' => 'Indianapolis',   'country' => 'USA'],
                ['name' => 'WrestleMania 41',     'event_date' => '2025-04-19', 'venue' => 'Allegiant Stadium',      'city' => 'Las Vegas',      'country' => 'USA'],
                ['name' => 'SummerSlam 2025',     'event_date' => '2025-08-02', 'venue' => 'MetLife Stadium',        'city' => 'East Rutherford','country' => 'USA'],
            ],
            'AEW' => [
                ['name' => 'Dynasty 2025',        'event_date' => '2025-04-06', 'venue' => 'Enterprise Center',      'city' => 'St. Louis',      'country' => 'USA'],
                ['name' => 'Double or Nothing 2025','event_date'=>'2025-05-25', 'venue' => 'MGM Grand Garden Arena', 'city' => 'Las Vegas',      'country' => 'USA'],
                ['name' => 'All In London 2025',  'event_date' => '2025-08-24', 'venue' => 'Wembley Stadium',        'city' => 'London',         'country' => 'UK'],
            ],
            'NJPW' => [
                ['name' => 'Wrestle Kingdom 19',  'event_date' => '2025-01-04', 'venue' => 'Tokyo Dome',             'city' => 'Tokyo',          'country' => 'Japan'],
                ['name' => 'New Beginning 2025',  'event_date' => '2025-02-09', 'venue' => 'Ota City General Gymnasium','city'=>'Tokyo',          'country' => 'Japan'],
                ['name' => 'G1 Climax 35',        'event_date' => '2025-07-19', 'venue' => 'Osaka-jo Hall',          'city' => 'Osaka',          'country' => 'Japan'],
            ],
            'CMLL' => [
                ['name' => 'Homenaje a Dos Leyendas 2025','event_date'=>'2025-03-14','venue'=>'Arena Mexico',        'city' => 'Mexico City',    'country' => 'Mexico'],
                ['name' => 'CMLL Anniversary 2025','event_date'=>'2025-09-19', 'venue' => 'Arena Mexico',            'city' => 'Mexico City',    'country' => 'Mexico'],
            ],
        ];

        $bouts = [
            'WWE' => [
                ['title' => 'Royal Rumble Match (Men\'s)',   'event' => 'Royal Rumble 2025',   'winner' => 'Cody Rhodes',       'finish_type' => 'Last Elimination', 'duration' => '58:24'],
                ['title' => 'Undisputed WWE Championship',   'event' => 'WrestleMania 41',      'winner' => 'Cody Rhodes',       'finish_type' => 'Pinfall',          'duration' => '22:11'],
                ['title' => 'World Heavyweight Championship','event' => 'WrestleMania 41',      'winner' => 'Seth FREAKIN Rollins','finish_type' => 'Pinfall',         'duration' => '18:45'],
                ['title' => 'Women\'s World Championship',  'event' => 'SummerSlam 2025',      'winner' => 'Rhea Ripley',       'finish_type' => 'Submission',       'duration' => '14:32'],
            ],
            'AEW' => [
                ['title' => 'AEW World Championship',        'event' => 'Dynasty 2025',         'winner' => 'Jon Moxley',        'finish_type' => 'Pinfall',          'duration' => '24:08'],
                ['title' => 'AEW World Championship',        'event' => 'Double or Nothing 2025','winner' => 'Swerve Strickland','finish_type' => 'Pinfall',          'duration' => '31:17'],
                ['title' => 'Owen Hart Cup Final',           'event' => 'Double or Nothing 2025','winner' => 'Bryan Danielson',  'finish_type' => 'Submission',       'duration' => '19:44'],
                ['title' => 'AEW World Championship',        'event' => 'All In London 2025',   'winner' => 'MJF',               'finish_type' => 'Pinfall',          'duration' => '27:52'],
            ],
            'NJPW' => [
                ['title' => 'IWGP World Heavyweight Championship','event'=>'Wrestle Kingdom 19','winner' => 'Zack Sabre, Jr.',   'finish_type' => 'Submission',       'duration' => '26:33'],
                ['title' => 'NEVER Openweight Championship', 'event' => 'Wrestle Kingdom 19',  'winner' => 'Hirooki Goto',      'finish_type' => 'Pinfall',          'duration' => '15:20'],
                ['title' => 'IWGP Junior Heavyweight Championship','event'=>'New Beginning 2025','winner'=>'Yota Tsuji',         'finish_type' => 'Pinfall',          'duration' => '21:05'],
                ['title' => 'G1 Climax 35 Final',           'event' => 'G1 Climax 35',         'winner' => 'Aaron Wolf',        'finish_type' => 'Pinfall',          'duration' => '34:18'],
            ],
            'CMLL' => [
                ['title' => 'NWA Historic Middleweight Championship','event'=>'Homenaje a Dos Leyendas 2025','winner'=>'Soberano Jr.','finish_type'=>'Pinfall','duration'=>'18:42'],
                ['title' => 'CMLL World Heavyweight Championship','event'=>'CMLL Anniversary 2025','winner'=>'Ultimo Guerrero',  'finish_type' => 'Pinfall',          'duration' => '22:10'],
                ['title' => 'CMLL World Light Heavyweight Championship','event'=>'CMLL Anniversary 2025','winner'=>'Atlantis Jr.','finish_type'=>'Pinfall',           'duration' => '19:55'],
            ],
        ];

        foreach ($rosters as $promotionName => $names) {
            $promotion = $this->upsertPromotionByName($promotionName);

            foreach ($names as $name) {
                $this->upsertWrestlerByNameAndPromotion($name, $promotion->id);
            }

            $this->ensureArticlesForPromotion($promotion->id, $promotionName);
            $this->ensureEventsForPromotion($promotion->id, $events[$promotionName] ?? []);
            $this->ensureBoutsForPromotion($promotion->id, $bouts[$promotionName] ?? []);
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
    private function ensureEventsForPromotion(int $promotionId, array $events): void
    {
        foreach ($events as $data) {
            $exists = Event::query()
                ->where('promotion_id', $promotionId)
                ->where('name', $data['name'])
                ->exists();

            if ($exists) {
                continue;
            }

            $event = new Event();
            $event->forceFill([
                'promotion_id' => $promotionId,
                'name'         => $data['name'],
                'event_date'   => $data['event_date'],
                'venue'        => $data['venue'],
                'city'         => $data['city'],
                'country'      => $data['country'],
            ])->save();
        }
    }

    private function ensureBoutsForPromotion(int $promotionId, array $bouts): void
    {
        foreach ($bouts as $data) {
            $exists = Bout::query()
                ->where('promotion_id', $promotionId)
                ->where('title', $data['title'])
                ->whereHas('event', fn ($q) => $q->where('name', $data['event']))
                ->exists();

            if ($exists) {
                continue;
            }

            $event = Event::query()
                ->where('promotion_id', $promotionId)
                ->where('name', $data['event'])
                ->first();

            if (!$event) {
                continue;
            }

            $bout = new Bout();
            $bout->forceFill([
                'title'        => $data['title'],
                'promotion_id' => $promotionId,
                'event_id'     => $event->id,
            ])->save();

            // Attach the winner as a participant
            $winner = Wrestler::query()
                ->where('name', $data['winner'])
                ->where('promotion_id', $promotionId)
                ->first();

            if ($winner) {
                BoutWrestler::firstOrCreate([
                    'bout_id'    => $bout->id,
                    'wrestler_id'=> $winner->id,
                ]);

                $result = new Result();
                $result->forceFill([
                    'bout_id'     => $bout->id,
                    'winner_id'   => $winner->id,
                    'finish_type' => $data['finish_type'],
                    'duration'    => $data['duration'],
                ])->save();
            }
        }
    }

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
