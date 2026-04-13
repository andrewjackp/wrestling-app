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
                // Royal Rumble 2025
                ['title' => 'Undisputed WWE Championship',        'event' => 'Royal Rumble 2025',    'winner' => 'Roman Reigns',          'opponent' => 'Cody Rhodes',         'finish_type' => 'Pinfall',          'duration' => '28:14', 'notes' => 'Roman retained after outside interference.'],
                ['title' => 'Royal Rumble Match (Men\'s)',        'event' => 'Royal Rumble 2025',    'winner' => 'Cody Rhodes',           'opponent' => 'Seth FREAKIN Rollins', 'finish_type' => 'Last Elimination', 'duration' => '58:24', 'notes' => 'Cody eliminated Rollins last to earn his WrestleMania shot.'],
                ['title' => 'World Heavyweight Championship',     'event' => 'Royal Rumble 2025',    'winner' => 'Seth FREAKIN Rollins',  'opponent' => 'Roman Reigns',        'finish_type' => 'Pinfall',          'duration' => '19:02'],
                // WrestleMania 41
                ['title' => 'Undisputed WWE Championship',        'event' => 'WrestleMania 41',      'winner' => 'Cody Rhodes',           'opponent' => 'Roman Reigns',        'finish_type' => 'Pinfall',          'duration' => '22:11', 'notes' => 'Cody finally finishes his story.'],
                ['title' => 'World Heavyweight Championship',     'event' => 'WrestleMania 41',      'winner' => 'Seth FREAKIN Rollins',  'opponent' => 'Becky Lynch',         'finish_type' => 'Pinfall',          'duration' => '18:45'],
                ['title' => 'Women\'s World Championship',        'event' => 'WrestleMania 41',      'winner' => 'Rhea Ripley',           'opponent' => 'Becky Lynch',         'finish_type' => 'Submission',       'duration' => '16:30'],
                // SummerSlam 2025
                ['title' => 'Undisputed WWE Championship',        'event' => 'SummerSlam 2025',      'winner' => 'Cody Rhodes',           'opponent' => 'Seth FREAKIN Rollins', 'finish_type' => 'Pinfall',         'duration' => '24:50'],
                ['title' => 'Women\'s World Championship',        'event' => 'SummerSlam 2025',      'winner' => 'Rhea Ripley',           'opponent' => 'Becky Lynch',         'finish_type' => 'Submission',       'duration' => '14:32'],
                ['title' => 'Singles Match',                      'event' => 'SummerSlam 2025',      'winner' => 'Roman Reigns',          'opponent' => 'Seth FREAKIN Rollins', 'finish_type' => 'Pinfall',         'duration' => '20:17', 'notes' => 'Roman\'s return match after months away.'],
            ],
            'AEW' => [
                // Dynasty 2025
                ['title' => 'AEW World Championship',             'event' => 'Dynasty 2025',         'winner' => 'Jon Moxley',            'opponent' => 'Hangman Adam Page',   'finish_type' => 'Pinfall',          'duration' => '24:08'],
                ['title' => 'Singles Match',                      'event' => 'Dynasty 2025',         'winner' => 'Kenny Omega',           'opponent' => 'MJF',                 'finish_type' => 'Pinfall',          'duration' => '31:55', 'notes' => 'Long-awaited rematch between former best friends.'],
                ['title' => 'Singles Match',                      'event' => 'Dynasty 2025',         'winner' => 'Swerve Strickland',     'opponent' => 'Bryan Danielson',     'finish_type' => 'Pinfall',          'duration' => '18:22'],
                // Double or Nothing 2025
                ['title' => 'AEW World Championship',             'event' => 'Double or Nothing 2025','winner' => 'Swerve Strickland',    'opponent' => 'Jon Moxley',          'finish_type' => 'Pinfall',          'duration' => '31:17'],
                ['title' => 'Owen Hart Cup Final',                'event' => 'Double or Nothing 2025','winner' => 'Bryan Danielson',      'opponent' => 'Kenny Omega',         'finish_type' => 'Submission',       'duration' => '19:44'],
                ['title' => 'Singles Match',                      'event' => 'Double or Nothing 2025','winner' => 'Toni Storm',           'opponent' => 'Swerve Strickland',   'finish_type' => 'DQ',               'duration' => '09:11'],
                // All In London 2025
                ['title' => 'AEW World Championship',             'event' => 'All In London 2025',   'winner' => 'MJF',                   'opponent' => 'Swerve Strickland',   'finish_type' => 'Pinfall',          'duration' => '27:52', 'notes' => 'MJF wins the title in front of 90,000 fans at Wembley.'],
                ['title' => 'Singles Match',                      'event' => 'All In London 2025',   'winner' => 'Kenny Omega',           'opponent' => 'Jon Moxley',          'finish_type' => 'Pinfall',          'duration' => '22:37'],
                ['title' => 'Singles Match',                      'event' => 'All In London 2025',   'winner' => 'Hangman Adam Page',     'opponent' => 'Bryan Danielson',     'finish_type' => 'Pinfall',          'duration' => '17:09'],
            ],
            'NJPW' => [
                // Wrestle Kingdom 19
                ['title' => 'IWGP World Heavyweight Championship','event' => 'Wrestle Kingdom 19',   'winner' => 'Zack Sabre, Jr.',       'opponent' => 'Hirooki Goto',        'finish_type' => 'Submission',       'duration' => '26:33'],
                ['title' => 'NEVER Openweight Championship',      'event' => 'Wrestle Kingdom 19',   'winner' => 'Hirooki Goto',          'opponent' => 'Toru Yano',           'finish_type' => 'Pinfall',          'duration' => '15:20'],
                ['title' => 'Singles Match',                      'event' => 'Wrestle Kingdom 19',   'winner' => 'Yota Tsuji',            'opponent' => 'Aaron Wolf',          'finish_type' => 'Pinfall',          'duration' => '18:44', 'notes' => 'A hard-hitting breakout performance from Tsuji.'],
                // New Beginning 2025
                ['title' => 'IWGP World Heavyweight Championship','event' => 'New Beginning 2025',   'winner' => 'Zack Sabre, Jr.',       'opponent' => 'Yota Tsuji',          'finish_type' => 'Submission',       'duration' => '23:58', 'notes' => 'ZSJ submitted Tsuji with a new hold he debuted on this night.'],
                ['title' => 'IWGP Junior Heavyweight Championship','event'=> 'New Beginning 2025',   'winner' => 'Yota Tsuji',            'opponent' => 'Aaron Wolf',          'finish_type' => 'Pinfall',          'duration' => '21:05'],
                ['title' => 'Singles Match',                      'event' => 'New Beginning 2025',   'winner' => 'Toru Yano',             'opponent' => 'Hirooki Goto',        'finish_type' => 'Rollup',           'duration' => '04:22', 'notes' => 'Yano steals the win with his trademark rollup.'],
                // G1 Climax 35
                ['title' => 'G1 Climax 35 Final',                 'event' => 'G1 Climax 35',         'winner' => 'Aaron Wolf',            'opponent' => 'Zack Sabre, Jr.',     'finish_type' => 'Pinfall',          'duration' => '34:18', 'notes' => 'Wolf ends ZSJ\'s dominant run in a match of the year candidate.'],
                ['title' => 'G1 Climax 35 Block A Final',         'event' => 'G1 Climax 35',         'winner' => 'Zack Sabre, Jr.',       'opponent' => 'Hirooki Goto',        'finish_type' => 'Submission',       'duration' => '19:01'],
                ['title' => 'G1 Climax 35 Block B Final',         'event' => 'G1 Climax 35',         'winner' => 'Aaron Wolf',            'opponent' => 'Yota Tsuji',          'finish_type' => 'Pinfall',          'duration' => '22:44'],
            ],
            'CMLL' => [
                // Homenaje a Dos Leyendas 2025
                ['title' => 'NWA Historic Middleweight Championship',       'event' => 'Homenaje a Dos Leyendas 2025', 'winner' => 'Soberano Jr.',   'opponent' => 'Mistico',         'finish_type' => 'Pinfall',    'duration' => '18:42'],
                ['title' => 'Lucha de Apuestas (Mask vs. Mask)',            'event' => 'Homenaje a Dos Leyendas 2025', 'winner' => 'Atlantis Jr.',   'opponent' => 'Blue Panther',    'finish_type' => 'Pinfall',    'duration' => '24:10', 'notes' => 'Blue Panther unmasked in an emotional moment.'],
                ['title' => 'Trios Match',                                   'event' => 'Homenaje a Dos Leyendas 2025', 'winner' => 'Ultimo Guerrero','opponent' => 'Soberano Jr.',    'finish_type' => 'Pinfall',    'duration' => '14:55'],
                // CMLL Anniversary 2025
                ['title' => 'CMLL World Heavyweight Championship',          'event' => 'CMLL Anniversary 2025',        'winner' => 'Ultimo Guerrero','opponent' => 'Atlantis Jr.',    'finish_type' => 'Pinfall',    'duration' => '22:10'],
                ['title' => 'CMLL World Light Heavyweight Championship',    'event' => 'CMLL Anniversary 2025',        'winner' => 'Atlantis Jr.',   'opponent' => 'Blue Panther',    'finish_type' => 'Pinfall',    'duration' => '19:55'],
                ['title' => 'Singles Match',                                 'event' => 'CMLL Anniversary 2025',        'winner' => 'Mistico',        'opponent' => 'Soberano Jr.',    'finish_type' => 'Pinfall',    'duration' => '16:30', 'notes' => 'A high-flying classic between two of CMLL\'s best.'],
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

            $winner = Wrestler::query()
                ->where('name', $data['winner'])
                ->where('promotion_id', $promotionId)
                ->first();

            $opponent = Wrestler::query()
                ->where('name', $data['opponent'])
                ->where('promotion_id', $promotionId)
                ->first();

            foreach (array_filter([$winner, $opponent]) as $participant) {
                BoutWrestler::firstOrCreate([
                    'bout_id'     => $bout->id,
                    'wrestler_id' => $participant->id,
                ]);
            }

            if ($winner) {
                $result = new Result();
                $result->forceFill([
                    'bout_id'     => $bout->id,
                    'winner_id'   => $winner->id,
                    'finish_type' => $data['finish_type'],
                    'duration'    => $data['duration'],
                    'notes'       => $data['notes'] ?? null,
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
