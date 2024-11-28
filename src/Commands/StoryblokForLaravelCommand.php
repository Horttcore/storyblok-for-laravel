<?php

namespace RalfHortt\StoryblokForLaravel\Commands;

use Illuminate\Console\Command;

class StoryblokForLaravelCommand extends Command
{
    public $signature = 'storyblok-for-laravel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
