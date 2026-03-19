<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DebugArticlesSchema extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:debug-articles-schema';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Default DB: ' . config('database.default'));
        $this->info('Connection DB name: ' . DB::connection()->getDatabaseName());

        $columns = Schema::getColumnListing('articles');
        $this->info('Articles columns: ' . implode(', ', $columns));

        return self::SUCCESS;
    }
}
