<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Recycle;
use Carbon\Carbon;

class TruncateOldItems extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'items:truncate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete items when duration expires';

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
     * @return mixed
     */
    public function handle()
    {
        Recycle::where('duration', '<', Carbon::now())->each(function ($item) {
            $item->delete();
        });
    }
}
