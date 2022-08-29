<?php

namespace PropaySystems\LaravelBaseRepositories\Commands;

use Illuminate\Console\Command;

class LaravelBaseRepositoriesCommand extends Command
{
    public $signature = 'laravel-base-repositories';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
