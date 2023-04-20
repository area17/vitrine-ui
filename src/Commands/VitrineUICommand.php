<?php

namespace A17\VitrineUI\Commands;

use Illuminate\Console\Command;

class VitrineUICommand extends Command
{
    public $signature = 'vitrine-ui';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
