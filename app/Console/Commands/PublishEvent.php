<?php

namespace App\Console\Commands;

use App\Event;
use Illuminate\Console\Command;
use Kreait\Firebase\Factory;

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
        $now = now('Africa/Cairo')->toDateTimeString();
        $events = Event::all();
        $factory = (new Factory)
            ->withServiceAccount(base_path().'/laravel-firebase.json')
            ->withDatabaseUri('https://laravel-dashboard-training.firebaseio.com/');

        $database = $factory->createDatabase();

        foreach($events as $event){
            if(strtotime($now) >= strtotime($event->start_date) 
                && strtotime($now) <= strtotime($event->end_date)
            ) {
                $event->update(['is_published' => true]);
                $database->getReference('events/')->push($event);

            }else{
                $event->update(['is_published' => false]);
            }
        }
        $this->info('Events published/unpublished check done');
    }

    /**
     * FireBase Operation
     */
    // public function fireBase($event)
    // {
    //     $factory = (new Factory)
    //         ->withServiceAccount(base_path().'/laravel-dashboard-training-firebase-adminsdk-ij059-17fae2b14a.json')
    //         ->withDatabaseUri('https://laravel-dashboard-training.firebaseio.com/');

    //     $database = $factory->createDatabase();
    //     $database->getReference('events/')->push($event);
    // }
}
