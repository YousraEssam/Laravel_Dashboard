<?php

namespace App\Console\Commands;

use App\Event;
use Illuminate\Console\Command;

class PublishEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish or unpublish events hourly based on their dates';

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
        $now = now()->toDateTimeString();
        $events = Event::all();
        foreach($events as $event){
            if(strtotime($now) >= strtotime($event->start_date) 
                && strtotime($now) <= strtotime($event->end_date)
            ) {
                $event->update(['is_published' => true]);
            }else{
                $event->update(['is_published' => false]);
            }
        }
        $this->info('Events published/unpublished check done');
    }
}
