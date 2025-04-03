<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Notifications\EventReminderNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SendEventReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-event-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends Notifications for Attendees when events starts';
    

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = Event::with('attendees.user')->whereBetween('start_time', [now(), now()->addDay()])->get();

        $eventCount = $events->count();
        $eventLabel = Str::plural('event', $eventCount);

        $events->each(
            fn ($event) => $event->attendees->each(
                fn ($attendee) => $attendee->user->notify(
                    new EventReminderNotification($event)
                )
            )
        );

                
                // Another Solution the same

                // foreach ($events as $event) {
                //     foreach ($event->attendees as $attendee) {
                //         $this->info("Notify the user {$attendee->user_id}");
                //     }
                // }



        // $this->info("Found {$eventCount} {$eventLabel}.");
    }
}
