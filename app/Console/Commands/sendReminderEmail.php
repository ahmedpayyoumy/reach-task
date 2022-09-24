<?php

namespace App\Console\Commands;

use App\Mail\SendReminderToAdevertisers;
use App\Models\Ad;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class sendReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:sendReminderEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $ads = Ad::query()->whereDate('starts_date', '=', \Carbon\Carbon::tomorrow())->get();
        foreach ($ads as $ad) {
            Mail::to($ad->advertiser->email)->send(new SendReminderToAdevertisers($ad->advertiser));
        }
        return 0;
    }
}
