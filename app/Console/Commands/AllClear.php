<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class AllClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'all:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Will Clear (config, cache, view, route) And Does Composer dump-autoload.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Artisan::call('config:clear');
        echo "Config Clear ".PHP_EOL;
        Artisan::call('cache:clear');
        echo "Cache Clear ".PHP_EOL;
        Artisan::call('route:clear');
        echo "Route Clear ".PHP_EOL;
        Artisan::call('view:clear');
        echo "View Clear ".PHP_EOL;
        exec('composer dump-autoload');
        echo "Composer dump-autoload ".PHP_EOL;
    }
}
